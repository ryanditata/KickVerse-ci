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

<!-- Carousel -->
<div class="container py-2">
<div id="homeCarousel" class="carousel slide mb-4 mt-4" data-bs-ride="carousel" data-bs-interval="3000" style="max-width: 100%; margin: auto;">
  <div class="carousel-inner rounded-2">
    <div class="carousel-item active">
      <img src="<?= base_url('img/banner1.png') ?>" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('img/banner2.png') ?>" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('img/banner3.png') ?>" class="d-block w-100" alt="Banner 3">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('img/banner4.png') ?>" class="d-block w-100" alt="Banner 4">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true" style=" filter: invert(100%);"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true" style=" filter: invert(100%);"></span>
  </button>
  <div class="carousel-indicators" style=" filter: invert(100%);">
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2"></button>
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="3"></button>
  </div>
</div>
</div>
<!-- End Carousel -->

<!-- Card1 -->
<div class="container text-center mb-4">
  <img src="<?= base_url('img/nike-just-do-it.avif') ?>" alt="3 Days of Drops" class="img-fluid rounded-2 mb-4">
  <h1 class="fw-bold display-5">3 DAYS OF DROPS</h1>
  <p class="mx-auto" style="max-width: 600px;">
    Score must-have sneakers over three days. Stay tuned on the Nike App at 9:00AM from 29 Jun – 1 Jul. Turn on notifications so you don't miss a drop.
  </p>
  <a href="#produk" class="btn btn-dark rounded-pill px-4 fw-semibold">Shop</a>
</div>
<!-- End Card1 -->

<!-- Vertical Auto Scroll Card -->
<div class="container mt-5 mb-5">
  <div class="row g-4">
    <div class="col-md-3">
      <div class="border rounded p-3 text-center h-100">
        <h5 class="fw-bold">SNEAKERS</h5>
        <a href="#produk" class="text-muted small text-decoration-none d-block mb-2">View All</a>
        <div class="scroll-container mx-auto">
          <div class="scroll-content">
            <img src="<?= base_url('img/sneaker1.png') ?>" class="img-fluid category-img" alt="Sneaker 1">
            <img src="<?= base_url('img/sneaker2.png') ?>" class="img-fluid category-img" alt="Sneaker 2">
            <img src="<?= base_url('img/sneaker3.png') ?>" class="img-fluid category-img" alt="Sneaker 3">
            <img src="<?= base_url('img/sneaker4.png') ?>" class="img-fluid category-img" alt="Sneaker 4">
            <img src="<?= base_url('img/sneaker5.png') ?>" class="img-fluid category-img" alt="Sneaker 5">
            <img src="<?= base_url('img/sneaker6.png') ?>" class="img-fluid category-img" alt="Sneaker 6">
            <img src="<?= base_url('img/sneaker7.png') ?>" class="img-fluid category-img" alt="Sneaker 7">
            <img src="<?= base_url('img/sneaker8.png') ?>" class="img-fluid category-img" alt="Sneaker 8">
            <img src="<?= base_url('img/sneaker9.png') ?>" class="img-fluid category-img" alt="Sneaker 9">
            <img src="<?= base_url('img/sneaker10.jpeg') ?>" class="img-fluid category-img" alt="Sneaker 10">

            <img src="<?= base_url('img/sneaker1.png') ?>" class="img-fluid category-img" alt="Sneaker 1">
            <img src="<?= base_url('img/sneaker2.png') ?>" class="img-fluid category-img" alt="Sneaker 2">
            <img src="<?= base_url('img/sneaker3.png') ?>" class="img-fluid category-img" alt="Sneaker 3">
            <img src="<?= base_url('img/sneaker4.png') ?>" class="img-fluid category-img" alt="Sneaker 4">
            <img src="<?= base_url('img/sneaker5.png') ?>" class="img-fluid category-img" alt="Sneaker 5">
            <img src="<?= base_url('img/sneaker6.png') ?>" class="img-fluid category-img" alt="Sneaker 6">
            <img src="<?= base_url('img/sneaker7.png') ?>" class="img-fluid category-img" alt="Sneaker 7">
            <img src="<?= base_url('img/sneaker8.png') ?>" class="img-fluid category-img" alt="Sneaker 8">
            <img src="<?= base_url('img/sneaker9.png') ?>" class="img-fluid category-img" alt="Sneaker 9">
            <img src="<?= base_url('img/sneaker10.jpeg') ?>" class="img-fluid category-img" alt="Sneaker 10">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="border rounded p-3 text-center h-100">
        <h5 class="fw-bold">APPAREL</h5>
        <a href="#produk" class="text-muted small text-decoration-none d-block mb-2">View All</a>
        <div class="scroll-container mx-auto">
          <div class="scroll-content">
            <img src="<?= base_url('img/apparel1.png') ?>" class="img-fluid category-img" alt="Apparel 1">
            <img src="<?= base_url('img/apparel2.png') ?>" class="img-fluid category-img" alt="Apparel 2">
            <img src="<?= base_url('img/apparel3.png') ?>" class="img-fluid category-img" alt="Apparel 3">
            <img src="<?= base_url('img/apparel4.jpeg') ?>" class="img-fluid category-img" alt="Apparel 4">
            <img src="<?= base_url('img/apparel5.png') ?>" class="img-fluid category-img" alt="Apparel 5">
            <img src="<?= base_url('img/apparel6.png') ?>" class="img-fluid category-img" alt="Apparel 6">
            <img src="<?= base_url('img/apparel7.png') ?>" class="img-fluid category-img" alt="Apparel 7">
            <img src="<?= base_url('img/apparel8.png') ?>" class="img-fluid category-img" alt="Apparel 8">
            <img src="<?= base_url('img/apparel9.png') ?>" class="img-fluid category-img" alt="Apparel 9">
            <img src="<?= base_url('img/apparel10.png') ?>" class="img-fluid category-img" alt="Apparel 10">

            <img src="<?= base_url('img/apparel1.png') ?>" class="img-fluid category-img" alt="Apparel 1">
            <img src="<?= base_url('img/apparel2.png') ?>" class="img-fluid category-img" alt="Apparel 2">
            <img src="<?= base_url('img/apparel3.png') ?>" class="img-fluid category-img" alt="Apparel 3">
            <img src="<?= base_url('img/apparel4.jpeg') ?>" class="img-fluid category-img" alt="Apparel 4">
            <img src="<?= base_url('img/apparel5.png') ?>" class="img-fluid category-img" alt="Apparel 5">
            <img src="<?= base_url('img/apparel6.png') ?>" class="img-fluid category-img" alt="Apparel 6">
            <img src="<?= base_url('img/apparel7.png') ?>" class="img-fluid category-img" alt="Apparel 7">
            <img src="<?= base_url('img/apparel8.png') ?>" class="img-fluid category-img" alt="Apparel 8">
            <img src="<?= base_url('img/apparel9.png') ?>" class="img-fluid category-img" alt="Apparel 9">
            <img src="<?= base_url('img/apparel10.png') ?>" class="img-fluid category-img" alt="Apparel 10">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="border rounded p-3 text-center h-100">
        <h5 class="fw-bold">LUXURY</h5>
        <a href="#produk" class="text-muted small text-decoration-none d-block mb-2">View All</a>
        <div class="scroll-container mx-auto">
          <div class="scroll-content">
            <img src="<?= base_url('img/luxury1.jpeg') ?>" class="img-fluid category-img" alt="Luxury 1">
            <img src="<?= base_url('img/luxury2.png') ?>" class="img-fluid category-img" alt="Luxury 2">
            <img src="<?= base_url('img/luxury3.jpeg') ?>" class="img-fluid category-img" alt="Luxury 3">
            <img src="<?= base_url('img/luxury4.png') ?>" class="img-fluid category-img" alt="Luxury 4">
            <img src="<?= base_url('img/luxury5.png') ?>" class="img-fluid category-img" alt="Luxury 5">
            <img src="<?= base_url('img/luxury6.png') ?>" class="img-fluid category-img" alt="Luxury 6">
            <img src="<?= base_url('img/luxury7.jpeg') ?>" class="img-fluid category-img" alt="Luxury 7">
            <img src="<?= base_url('img/luxury8.png') ?>" class="img-fluid category-img" alt="Luxury 8">
            <img src="<?= base_url('img/luxury9.png') ?>" class="img-fluid category-img" alt="Luxury 9">
            <img src="<?= base_url('img/luxury10.jpeg') ?>" class="img-fluid category-img" alt="Luxury 10">

            <img src="<?= base_url('img/luxury1.jpeg') ?>" class="img-fluid category-img" alt="Luxury 1">
            <img src="<?= base_url('img/luxury2.png') ?>" class="img-fluid category-img" alt="Luxury 2">
            <img src="<?= base_url('img/luxury3.jpeg') ?>" class="img-fluid category-img" alt="Luxury 3">
            <img src="<?= base_url('img/luxury4.png') ?>" class="img-fluid category-img" alt="Luxury 4">
            <img src="<?= base_url('img/luxury5.png') ?>" class="img-fluid category-img" alt="Luxury 5">
            <img src="<?= base_url('img/luxury6.png') ?>" class="img-fluid category-img" alt="Luxury 6">
            <img src="<?= base_url('img/luxury7.jpeg') ?>" class="img-fluid category-img" alt="Luxury 7">
            <img src="<?= base_url('img/luxury8.png') ?>" class="img-fluid category-img" alt="Luxury 8">
            <img src="<?= base_url('img/luxury9.png') ?>" class="img-fluid category-img" alt="Luxury 9">
            <img src="<?= base_url('img/luxury10.jpeg') ?>" class="img-fluid category-img" alt="Luxury 10">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="border rounded p-3 text-center h-100">
        <h5 class="fw-bold">SLIDES</h5>
        <a href="#produk" class="text-muted small text-decoration-none d-block mb-2">View All</a>
        <div class="scroll-container mx-auto">
          <div class="scroll-content">
            <img src="<?= base_url('img/slides1.png') ?>" class="img-fluid category-img" alt="Slides 1">
            <img src="<?= base_url('img/slides2.png') ?>" class="img-fluid category-img" alt="Slides 2">
            <img src="<?= base_url('img/slides3.png') ?>" class="img-fluid category-img" alt="Slides 3">
            <img src="<?= base_url('img/slides4.png') ?>" class="img-fluid category-img" alt="Slides 4">
            <img src="<?= base_url('img/slides5.png') ?>" class="img-fluid category-img" alt="Slides 5">
            <img src="<?= base_url('img/slides6.png') ?>" class="img-fluid category-img" alt="Slides 6">
            <img src="<?= base_url('img/slides7.png') ?>" class="img-fluid category-img" alt="Slides 7">
            <img src="<?= base_url('img/slides8.png') ?>" class="img-fluid category-img" alt="Slides 8">
            <img src="<?= base_url('img/slides9.png') ?>" class="img-fluid category-img" alt="Slides 9">
            <img src="<?= base_url('img/slides10.png') ?>" class="img-fluid category-img" alt="Slides 10">

            <img src="<?= base_url('img/slides1.png') ?>" class="img-fluid category-img" alt="Slides 1">
            <img src="<?= base_url('img/slides2.png') ?>" class="img-fluid category-img" alt="Slides 2">
            <img src="<?= base_url('img/slides3.png') ?>" class="img-fluid category-img" alt="Slides 3">
            <img src="<?= base_url('img/slides4.png') ?>" class="img-fluid category-img" alt="Slides 4">
            <img src="<?= base_url('img/slides5.png') ?>" class="img-fluid category-img" alt="Slides 5">
            <img src="<?= base_url('img/slides6.png') ?>" class="img-fluid category-img" alt="Slides 6">
            <img src="<?= base_url('img/slides7.png') ?>" class="img-fluid category-img" alt="Slides 7">
            <img src="<?= base_url('img/slides8.png') ?>" class="img-fluid category-img" alt="Slides 8">
            <img src="<?= base_url('img/slides9.png') ?>" class="img-fluid category-img" alt="Slides 9">
            <img src="<?= base_url('img/slides10.png') ?>" class="img-fluid category-img" alt="Slides 10">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Vertical Auto Scroll Card -->

<!-- Product Grid -->
<div class="container py-2" id="produk">
    <div class="row g-4">
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
                  <img src="<?= base_url() . "img/" . $item['foto'] ?>" class="card-img-top" alt="<?= $item['nama'] ?>">
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
    </div>
</div>
<!-- End Product Grid -->

<?= $this->endSection() ?>