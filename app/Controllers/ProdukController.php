<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

use App\Models\ProductModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProdukController extends BaseController
{
    protected $product; 

    function __construct()
    {
        $this->product = new ProductModel();
    }

    public function index()
    {
        $product = $this->product->findAll();
        $data['product'] = $product;

        return view('v_produk', $data);
    }

    // Fungsi create
    public function create()
    {
    $dataFoto = $this->request->getFile('foto');

    $dataForm = [
        'nama' => $this->request->getPost('nama'),
        'harga' => $this->request->getPost('harga'),
        'jumlah' => $this->request->getPost('jumlah'),
        'created_at' => date("Y-m-d H:i:s")
    ];

    if ($dataFoto->isValid()) {
        $fileName = $dataFoto->getRandomName();
        $dataForm['foto'] = $fileName;
        $dataFoto->move('img/', $fileName);
    }

    $this->product->insert($dataForm);

    return redirect('produk')->with('success', 'Data Berhasil Ditambah.');
    }
    
    // Fungsi edit
    public function edit($id)
    {
    $dataProduk = $this->product->find($id);

    $dataForm = [
        'nama' => $this->request->getPost('nama'),
        'harga' => $this->request->getPost('harga'),
        'jumlah' => $this->request->getPost('jumlah'),
        'updated_at' => date("Y-m-d H:i:s")
    ];

    if ($this->request->getPost('check') == 1) {
        if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'] . "")) {
            unlink("img/" . $dataProduk['foto']);
        }

        $dataFoto = $this->request->getFile('foto');

        if ($dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataFoto->move('img/', $fileName);
            $dataForm['foto'] = $fileName;
        }
    }

    $this->product->update($id, $dataForm);

    return redirect('produk')->with('success', 'Data Berhasil Diubah.');
    }

    // Fungsi hapus
    public function delete($id)
    {
    $dataProduk = $this->product->find($id);

    if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'] . "")) {
        unlink("img/" . $dataProduk['foto']);
    }

    $this->product->delete($id);

    return redirect('produk')->with('success', 'Data Berhasil Dihapus.');
    }

    // Fungsi download
    public function download()
    {
    date_default_timezone_set('Asia/Jakarta');
    $product = $this->product->findAll();
    $html = view('v_produkPDF', ['product' => $product]);
    $filename = date('y-m-d_H-i-s') . '_produk';
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'potrait');
    $dompdf->render();
    $dompdf->stream($filename);
    }
}