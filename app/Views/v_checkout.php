<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
.select2-container .select2-selection--single {
    height: 36px !important;
    padding: 5px 4px !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 24px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 35px !important;
}

</style>
<div class="container py-2 mt-4 mb-4">
    <div class="row">
    <!-- KIRI - Form Delivery -->
    <div class="col-lg-6">
        <h4 class="fw-bold mb-3">Informasi Pengiriman</h4>

        <?= form_open('buy') ?>
        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga']) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'ongkir', 'id' => 'ongkir', 'value' => 0]) ?>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" class="form-control" value="<?= esc(session()->get('username')) ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Contoh: Jl. Gajah Mada No.1, RT 02 RW 03"></textarea>
        </div>

        <div class="mb-3">
            <label for="kelurahan" class="form-label">Alamat Lengkap</label>
            <select class="form-select" id="kelurahan" name="kelurahan" required>
                <option selected disabled>Cari Kelurahan/Desa</option>
            </select>
        </div>

        <div>
            <label for="layanan" class="form-label">Layanan Pengiriman</label>
            <select class="form-select" id="layanan" name="layanan" required>
                <option selected disabled>Pilih Layanan</option>
            </select>
        </div>
    </div>

    <!-- KANAN - Order Summary -->
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

        <!-- List Produk -->
        <?php foreach ($items as $item): ?>
            <div class="d-flex mt-4 align-items-start">
                <img src="<?= base_url('img/' . $item['options']['foto']) ?>" class="me-3" width="90">
                <div>
                    <strong><?= $item['name'] ?></strong><br>
                    <small>Qty <?= $item['qty'] ?></small><br>
                    <small>IDR <?= number_format($item['price'], 0, ',', '.') ?></small>
                </div>
            </div>
        <?php endforeach ?>

        <button type="submit" class="btn btn-dark w-100 mt-4 rounded-pill fw-semibold">Checkout</button>
        <?= form_close() ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    var ongkir = 0;
    var total = 0; 

    hitungTotal();

    $('#kelurahan').select2({
        ajax: {
            url: '<?= base_url('get-location') ?>',
            dataType: 'json',
            delay: 1500,
            data: function (params) {
                return { search: params.term };
            },
            processResults: function (data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.subdistrict_name + ", " + item.district_name + ", " + item.city_name + ", " + item.province_name + ", " + item.zip_code
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 3,
        placeholder: 'Cari Kelurahan/Desa',
        width: '100%'
    });

    $('#layanan').select2({
        placeholder: 'Pilih Layanan',
        width: '100%'
    });

    $("#kelurahan").on('change', function() {
        var id_kelurahan = $(this).val(); 
        $("#layanan").empty().trigger('change');

        ongkir = 0;

        $.ajax({
            url: "<?= site_url('get-cost') ?>",
            type: 'GET',
            data: { 'destination': id_kelurahan },
            dataType: 'json',
            success: function(data) {
                var dataOptions = data.map(function(item) {
                    return {
                        id: item["cost"],
                        text: item["description"] + " (" + item["service"] + ") : estimasi " + item["etd"]
                    };
                });

                $("#layanan").select2({
                    data: dataOptions,
                    placeholder: 'Pilih layanan',
                    width: '100%',
                });

                hitungTotal();
            },
        });
    });

    $("#layanan").on('change', function() {
        ongkir = parseInt($(this).val()) || 0;
        hitungTotal();
    });  

    function hitungTotal() {
        total = ongkir + <?= $total ?>;

        $("#ongkir").val(ongkir);
        $("#ongkir_display").html("IDR " + ongkir.toLocaleString('id-ID'));
        $("#total_display").html("IDR " + total.toLocaleString('id-ID'));
        $("#total_harga").val(total);
    }
});
</script>
<?= $this->endSection() ?>