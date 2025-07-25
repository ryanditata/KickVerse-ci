<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class TransaksiController extends BaseController
{
    protected $cart;
    protected $client;
    protected $apiKey;
    protected $transaction;
    protected $transaction_detail;
    protected $product;

    function __construct()
    {
        helper(['number', 'form']);
        $this->cart = \Config\Services::cart();
        $this->client = new \GuzzleHttp\Client();
        $this->apiKey = env('COST_KEY');
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
        $this->product = new ProductModel();
    }

    public function index()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        return view('v_keranjang', $data);
    }

    public function cart_add()
    {
        $this->cart->insert([
            'id'      => $this->request->getPost('id'),
            'qty'     => 1,
            'price'   => $this->request->getPost('harga'),
            'name'    => $this->request->getPost('nama'),
            'options' => ['foto' => $this->request->getPost('foto')]
        ]);
        session()->setFlashdata('success','Produk berhasil ditambahkan ke keranjang.');
        return redirect()->to(base_url('/'));
    }

    public function cart_clear()
    {
        $this->cart->destroy();
        session()->setFlashdata('success', 'Keranjang dikosongkan.');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_edit()
    {
        $i = 1;
        foreach ($this->cart->contents() as $value) {
            $this->cart->update([
                'rowid' => $value['rowid'],
                'qty'   => $this->request->getPost('qty' . $i++)
            ]);
        }
        session()->setFlashdata('success', 'Keranjang diperbarui.');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_delete($rowid)
    {
        $this->cart->remove($rowid);
        session()->setFlashdata('success', 'Produk dihapus dari keranjang.');
        return redirect()->to(base_url('keranjang'));
    }

    public function checkout()
    {
        $items = $this->cart->contents();
        $errors = [];

        foreach ($items as $item) {
            $product = $this->product->find($item['id']);
            if ($item['qty'] > $product['jumlah']) {
                $errors[] = "Stok produk <strong>{$product['nama']}</strong> hanya tersedia <strong>{$product['jumlah']}</strong>.";
            }
        }

        if (!empty($errors)) {
            session()->setFlashdata('error', implode('<br>', $errors));
            return redirect()->to(base_url('keranjang'));
        }

        session()->setFlashdata('success', 'Silakan lanjut ke pembayaran.');
    
        $data['items'] = $items;
        $data['total'] = $this->cart->total();
        return view('v_checkout', $data);
    }

    public function getLocation()
    {
        $search = $this->request->getGet('search');

        $response = $this->client->request('GET', 
            'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=' . $search . '&limit=50', [
            'headers' => [
                'accept' => 'application/json',
                'key'    => $this->apiKey,
            ],
        ]);

        $body = json_decode($response->getBody(), true); 
        return $this->response->setJSON($body['data']);
    }

    public function getCost()
    {
        $destination = $this->request->getGet('destination');

        $response = $this->client->request('POST',
            'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
            'multipart' => [
                ['name' => 'origin', 'contents' => '64999'],
                ['name' => 'destination', 'contents' => $destination],
                ['name' => 'weight', 'contents' => '1000'],
                ['name' => 'courier', 'contents' => 'jne']
            ],
            'headers' => [
                'accept' => 'application/json',
                'key'    => $this->apiKey,
            ],
        ]);

        $body = json_decode($response->getBody(), true); 
        return $this->response->setJSON($body['data']);
    }

    public function buy()
    {
        if ($this->request->isAJAX()) {
            // Konfigurasi Midtrans
            MidtransConfig::$serverKey = env('MIDTRANS_SERVER_KEY');
            MidtransConfig::$isProduction = false;
            MidtransConfig::$isSanitized = true;
            MidtransConfig::$is3ds = true;

            // Ambil data dari frontend
            $username = $this->request->getPost('username');
            $email    = $this->request->getPost('email');
            $phone    = $this->request->getPost('phone');
            $alamat   = $this->request->getPost('alamat');
            $ongkir   = (int) $this->request->getPost('ongkir');
            $total    = (int) $this->request->getPost('total_harga');

            // Simpan transaksi
            $dataForm = [
                'username' => $username,
                'phone' => $phone,
                'total_harga' => $total,
                'alamat' => $alamat,
                'ongkir' => $ongkir,
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $this->transaction->insert($dataForm);
            $order_id = $this->transaction->getInsertID();

            $items = [];

            foreach ($this->cart->contents() as $item) {
                $this->transaction_detail->insert([
                    'transaction_id' => $order_id,
                    'product_id'     => $item['id'],
                    'jumlah'         => $item['qty'],
                    'diskon'         => 0,
                    'subtotal_harga' => $item['qty'] * $item['price'],
                    'created_at'     => date("Y-m-d H:i:s"),
                    'updated_at'     => date("Y-m-d H:i:s")
                ]);

                $produk = $this->product->find($item['id']);
                if ($produk) {
                    $jumlahBaru = $produk['jumlah'] - $item['qty'];
                    if ($jumlahBaru < 0) {
                        $jumlahBaru = 0;
                    }
                    $this->product->update($item['id'], ['jumlah' => $jumlahBaru]);
                }

                $items[] = [
                    'id' => $item['id'],
                    'price' => $item['price'],
                    'quantity' => $item['qty'],
                    'name' => $item['name']
                ];
            }

            // Tambahkan biaya ongkir sebagai item terpisah
            $items[] = [
                'id' => 'ONG-' . $order_id,
                'price' => $ongkir,
                'quantity' => 1,
                'name' => 'Ongkos Kirim'
            ];

            $params = [
                'transaction_details' => [
                    'order_id' => 'KV-' . $order_id,
                    'gross_amount' => $total
                ],
                'customer_details' => [
                    'first_name' => $username,
                    'email'      => $email,
                    'phone'      => $phone,
                    'billing_address' => [
                        'first_name' => $username,
                        'email'      => $email,
                        'phone'      => $phone,
                        'address'    => $alamat,
                ],
                'shipping_address' => [
                    'first_name' => $username,
                    'email'      => $email,
                    'phone'      => $phone,
                    'address'    => $alamat,
                ]
            ],
            'item_details' => $items
            ];

            $snapToken = Snap::getSnapToken($params);

            $this->cart->destroy();

            return $this->response->setJSON(['snap_token' => $snapToken]);
        }
    }
}