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
<?php if (session()->getFlashdata('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded mt-3" role="alert">
        <i class="bi bi-x-circle-fill me-2"></i>
        <?= session()->getFlashdata('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Action Buttons -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-dark btn-sm rounded-pill fw-semibold" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-circle-fill me-1"></i> Tambah
        </button>
        <a class="btn btn-outline-dark btn-sm rounded-pill fw-semibold" href="<?= base_url() ?>produk/download">
            <i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF
        </a>
    </div>
</div>

<!-- Product Grid -->
<div class="container mt-2 mb-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        usort($product, function ($a, $b) {
            return $b['id'] <=> $a['id'];
        });
        ?>
        <?php foreach ($product as $produk) : ?>
            <div class="col">
                <div class="card">
                    <?php if ($produk['foto'] != '' && file_exists("img/" . $produk['foto'])) : ?>
                        <img src="<?= base_url() . "img/" . $produk['foto'] ?>" class="card-img-top" alt="<?= $produk['nama'] ?>">
                    <?php else : ?>
                        <img src="https://via.placeholder.com/300x300?text=No+Image" class="card-img-top" alt="No image">
                    <?php endif; ?>
                    <div class="card-body">
                        <p class="fw-semibold text-black fs-5 mt-4" style="margin: 0;"><?= $produk['nama'] ?></p>
                        <p class="fw-normal text-secondary" style="margin: 0;">Stok: <?= $produk['jumlah'] ?></p>
                        <p class="fw-semibold text-black mt-2" style="margin: 0;">Harga: <?= number_format($produk['harga'], 0, ',', '.') ?></p>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-dark btn-sm rounded-pill fw-semibold" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>">
                                <i class="bi bi-pencil-square me-1"></i> Ubah
                            </button>
                            <button type="button" class="btn btn-dark btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $produk['id'] ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?= $produk['nama'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Harga</label>
                                    <input type="text" name="harga" class="form-control" value="<?= $produk['harga'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" value="<?= $produk['jumlah'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <img src="<?= base_url() . "img/" . $produk['foto'] ?>" width="145px" class="img-fluid rounded">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                                        <label class="form-check-label">Ceklis untuk ganti foto</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Foto Baru</label>
                                    <input type="file" class="form-control" name="foto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark btn-sm rounded-pill fw-semibold" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-dark btn-sm rounded-pill fw-semibold">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal-<?= $produk['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel-<?= $produk['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="<?= base_url('produk/delete/' . $produk['id']) ?>" method="get">
                            <?= csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel-<?= $produk['id'] ?>">Hapus Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-4 text-center">
                                        <?php if ($produk['foto'] != '' && file_exists("img/" . $produk['foto'])) : ?>
                                            <img src="<?= base_url() . "img/" . $produk['foto'] ?>" alt="<?= $produk['nama'] ?>" class="img-fluid rounded">
                                        <?php else : ?>
                                            <img src="https://via.placeholder.com/120x120?text=No+Image" alt="No image" class="img-fluid rounded">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-8">
                                        <p class="fw-semibold text-black fs-5" style="margin: 0;"><?= $produk['nama'] ?></p>
                                        <p class="fw-normal text-secondary" style="margin: 0;">Stok: <?= $produk['jumlah'] ?></p>
                                        <p class="fw-semibold text-black" style="margin: 0;">Harga: <?= number_format($produk['harga'], 0, ',', '.') ?></p>
                                    </div>
                                </div>
                                    <hr>
                                    <p class="text-center text-muted mb-0 mt-2">Yakin ingin menghapus produk ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark btn-sm rounded-pill fw-semibold" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-dark btn-sm rounded-pill fw-semibold">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Produk" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control" placeholder="Harga" required>
                    </div>
                    <div class="mb-3">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Stok" required>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark btn-sm rounded-pill fw-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>