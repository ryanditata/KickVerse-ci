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
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded mt-3" role="alert">
        <i class="bi bi-x-circle-fill me-2"></i>
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php echo form_open('keranjang/edit') ?>

<div class="container py-2 mt-4">
    <div class="row g-4"> <!-- Tambahkan g-4 agar sama seperti product grid -->

        <!-- Daftar Keranjang -->
        <div class="col-md-8">
            <?php
            $i = 1;
            if (!empty($items)) :
                foreach ($items as $index => $item) :
            ?>
                <div class="card mb-4 shadow-sm rounded p-3 d-flex flex-row">
                    <div style="width: 150px;">
                        <img src="<?= base_url('img/' . $item['options']['foto']) ?>" alt="<?= $item['name'] ?>" class="img-fluid rounded">
                    </div>
                    <div class="ms-4 flex-grow-1">
                        <h5 class="fw-bold mb-1"><?= $item['name'] ?></h5>
                        <p class="fw-semibold mb-1">IDR <?= number_format($item['price'], 0, ',', '.') ?></p>

                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-outline-dark btn-sm rounded-circle" onclick="changeQty('qty<?= $i ?>', -1)">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="input" min="1" name="qty<?= $i ?>" id="qty<?= $i ?>" class="form-control text-center" style="width: 60px;" value="<?= $item['qty'] ?>">
                            <button type="button" class="btn btn-outline-dark btn-sm rounded-circle" onclick="changeQty('qty<?= $i ?>', 1)">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>

                        <p class="mt-2 mb-0">Subtotal: <strong>IDR <?= number_format($item['subtotal'], 0, ',', '.') ?></strong></p>
                        <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" class="btn btn-dark btn-sm rounded-pill mt-2 fw-semibold">
                            <i class="bi bi-trash"></i> Hapus
                        </a>
                    </div>
                </div>
            <?php
                $i++;
                endforeach;
            endif;
            ?>
        </div>

        <!-- Ringkasan -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4 rounded">
                <h5 class="fw-bold mb-4">Ringkasan</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>IDR <?= number_format($total, 0, ',', '.') ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Estimasi Pengiriman</span>
                    <span>IDR 50.000</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3 fw-bold">
                    <span>Total</span>
                    <span>IDR <?= number_format($total + 50000, 0, ',', '.') ?></span>
                </div>
                <button type="submit" class="btn btn-outline-dark w-100 rounded-pill mb-2 fw-semibold">Perbarui Keranjang</button>
                <a href="<?= base_url('keranjang/clear') ?>" class="btn btn-outline-dark w-100 rounded-pill fw-semibold">Kosongkan Keranjang</a>
                <?php if (!empty($items)) : ?>
                    <a href="<?= base_url('checkout') ?>" class="btn btn-dark w-100 mt-2 rounded-pill fw-semibold">Checkout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('NiceAdmin/assets/js/custom.js') ?>"></script>

<?php echo form_close() ?>

<?= $this->endSection() ?>