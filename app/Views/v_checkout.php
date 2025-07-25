<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('NiceAdmin/assets/css/custom.css') ?>" rel="stylesheet">

<div class="container py-2 mt-4 mb-4">
    <div class="row">
        <!-- KIRI -->
        <div class="col-lg-6">
            <h4 class="fw-bold mb-3">Informasi Pengiriman</h4>
            <form id="checkout-form">
                <input type="hidden" name="username" value="<?= session()->get('username') ?>">
                <input type="hidden" name="email" value="<?= session()->get('email') ?>">
                 <input type="hidden" name="phone" value="<?= session()->get('phone') ?>">
                <input type="hidden" name="total_harga" id="total_harga">
                <input type="hidden" name="ongkir" id="ongkir" value="0">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" value="<?= esc(session()->get('username')) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" value="<?= esc(session()->get('email')) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" value="<?= esc(session()->get('phone')) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required placeholder="Contoh: Jl. Senopati No. 74, RT 008/RW 003, Kel. Selong, Kec. Kebayoran Baru, Kota Jakarta Selatan, DKI Jakarta, 12110"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <select class="form-select" name="kelurahan" id="kelurahan" style="width: 100%" required>
                        <option disabled selected>Cari Kelurahan/Desa</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Layanan Pengiriman</label>
                    <select class="form-select" name="layanan" id="layanan" style="width: 100%" required>
                        <option disabled selected>Pilih Layanan Pengiriman</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- KANAN -->
        <div class="col-lg-6 ps-lg-5 mt-5 mt-lg-0">
            <h4 class="fw-bold mb-3">Ringkasan Order</h4>

            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal</span>
                <span>IDR <?= number_format($total, 0, ',', '.') ?></span>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <span>Pengiriman</span>
                <span id="ongkir_display">IDR 0</span>
            </div>

            <div class="d-flex justify-content-between border-top pt-3 fw-bold fs-5">
                <span>Total</span>
                <span id="total_display">IDR <?= number_format($total, 0, ',', '.') ?></span>
            </div>

            <!-- Produk -->
            <?php foreach ($items as $item): ?>
                <div class="d-flex mt-4 align-items-start">
                    <img src="<?= base_url('img/' . $item['options']['foto']) ?>" width="90" class="me-3">
                    <div>
                        <strong><?= $item['name'] ?></strong><br>
                        <small>Qty <?= $item['qty'] ?></small><br>
                        <small>IDR <?= number_format($item['price'], 0, ',', '.') ?></small>
                    </div>
                </div>
            <?php endforeach ?>

            <!-- Tombol Checkout -->
            <button type="button" id="btn-checkout" class="btn btn-dark w-100 mt-4 rounded-pill fw-semibold">Checkout</button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= env('MIDTRANS_CLIENT_KEY') ?>"></script>

<script>
$(document).ready(function() {
    var ongkir = 0;
    var total = 0;

    function hitungTotal() {
        total = ongkir + <?= $total ?>;
        $("#ongkir").val(ongkir);
        $("#total_harga").val(total);
        $("#ongkir_display").html("IDR " + ongkir.toLocaleString('id-ID'));
        $("#total_display").html("IDR " + total.toLocaleString('id-ID'));
    }

    // Select2 Kelurahan
    $('#kelurahan').select2({
        ajax: {
            url: '<?= base_url('get-location') ?>',
            dataType: 'json',
            delay: 500,
            data: params => ({ search: params.term }),
            processResults: data => ({
                results: data.map(item => ({
                    id: item.id,
                    text: `${item.subdistrict_name}, ${item.district_name}, ${item.city_name}, ${item.province_name}, ${item.zip_code}`
                }))
            }),
            cache: true
        },
        minimumInputLength: 3,
        placeholder: 'Cari Kelurahan/Desa',
        width: '100%'
    });

    $('#layanan').select2({
        placeholder: 'Pilih Layanan Pengiriman',
        width: '100%'
    });

    // Load ongkir saat kelurahan dipilih
    $('#kelurahan').on('change', function () {
        let id_kelurahan = $(this).val();
        $("#layanan").empty().trigger('change');
        ongkir = 0;

        $.ajax({
            url: "<?= site_url('get-cost') ?>",
            type: 'GET',
            data: { destination: id_kelurahan },
            dataType: 'json',
            success: function(data) {
                let options = data.map(item => ({
                    id: item.cost,
                    text: `${item.description} (${item.service}) - Estimasi ${item.etd}`
                }));
                $("#layanan").select2({ data: options });
                hitungTotal();
            }
        });
    });

    $('#layanan').on('change', function () {
        ongkir = parseInt($(this).val()) || 0;
        hitungTotal();
    });

    // Tombol Bayar
    $('#btn-checkout').on('click', function () {
        let data = $('#checkout-form').serialize();

        $.ajax({
            url: '<?= base_url('buy') ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (res) {
                if (res.snap_token) {
                    snap.pay(res.snap_token, {
                        onSuccess: function() {
                            alert("Pembayaran berhasil");
                            window.location.href = "<?= base_url('profile') ?>";
                        },
                        onPending: function() {
                            alert("Menunggu pembayaran");
                            window.location.href = "<?= base_url('profile') ?>";
                        },
                        onError: function() {
                            alert("Pembayaran gagal");
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token pembayaran");
                }
            },
            error: function () {
                alert("Gagal memproses transaksi");
            }
        });
    });

    hitungTotal(); // Inisialisasi total
});
</script>
<?= $this->endSection() ?>