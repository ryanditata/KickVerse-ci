<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('NiceAdmin/assets/css/custom.css') ?>" rel="stylesheet">

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm rounded" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Product Grid -->
<div class="container py-2 mt-4" id="produk">
    <div class="row g-4">

        <?php if (empty($product)) : ?>
            <div class="alert alert-info alert-dismissible fade show mt-2 shadow-sm rounded" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>
                Tidak ada produk yang ditemukan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php else : ?>

            <?php
            usort($product, function ($a, $b) {
                return $b['id'] <=> $a['id'];
            });
            ?>

            <?php foreach ($product as $key => $item) : ?>
                <div class="col-md-6 col-lg-4">
                    <?= form_open('keranjang') ?>
                    <?= form_hidden('id', $item['id']) ?>
                    <?= form_hidden('nama', $item['nama']) ?>
                    <?= form_hidden('harga', $item['harga']) ?>
                    <?= form_hidden('foto', $item['foto']) ?>

                    <div class="card">
                        <img src="<?= base_url("img/" . $item['foto']) ?>" class="card-img-top" alt="<?= $item['nama'] ?>">
                        <div class="card-body">
                            <p class="fw-semibold text-black fs-5 mt-4" style="margin: 0;"><?= $item['nama'] ?></p>
                            <p class="fw-normal text-secondary" style="margin: 0;">Men's Shoe</p>
                            <p class="fw-normal text-secondary" style="margin: 0;">Stok <?= $item['jumlah'] ?></p>
                            <p class="fw-semibold text-black mt-2" style="margin: 0;">IDR <?= number_format($item['harga'], 0, ',', '.') ?></p>
                            <div class="d-flex mt-4">
                                <button type="submit" class="btn btn-outline-dark w-100 rounded-pill fw-semibold">Beli</button>
                            </div>
                        </div>
                    </div>

                    <?= form_close() ?>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>
<!-- End Product Grid -->

<?= $this->endSection() ?>