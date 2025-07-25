<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('NiceAdmin/assets/css/custom.css') ?>" rel="stylesheet">

<?php
$username = [
    'name'  => 'username',
    'id'    => 'username',
    'class' => 'form-control' . (session('errors.username') ? ' is-invalid' : ''),
    'value' => old('username'),
    'placeholder' => 'Username atau Email'
];

$password = [
    'name'  => 'password',
    'id'    => 'password',
    'class' => 'form-control' . (session('errors.password') ? ' is-invalid' : ''),
    'placeholder' => 'Password'
];
?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <!-- Logo -->
        <div class="d-flex justify-content-center py-4">
          <a href="<?= base_url('/') ?>" class="logo d-flex align-items-center w-auto">
            <img src="<?= base_url('NiceAdmin/assets/img/logo.png') ?>" alt="Kickverse">
          </a>
        </div>
        <!-- End Logo -->

        <div class="card mb-3">
          <div class="card-body">
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4 text-black">Login to Your Account</h5>
              <p class="text-center small">Enter your username & password to login</p>
            </div>

            <!-- Login Form -->
            <?= form_open('login', ['class' => 'row g-3 needs-validation', 'novalidate' => true]) ?>
              
              <div class="col-12">
                <label for="username" class="form-label">Username atau Email</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                  <?= form_input($username) ?>
                  <?php if (session('errors.username')): ?>
                    <div class="invalid-feedback"><?= session('errors.username') ?></div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <?= form_password($password) ?>
                <?php if (session('errors.password')): ?>
                  <div class="invalid-feedback"><?= session('errors.password') ?></div>
                <?php endif; ?>
              </div>
              
              <div class="col-12">
                <?= form_submit('submit', 'Login', ['class' => 'btn btn-dark w-100 fw-semibold rounded-pill mt-3']) ?>
              </div>

              <p class="text-center mt-3">
                Belum punya akun? <a href="<?= base_url('register') ?>" class="text-black">Daftar Sekarang</a>
              </p>

            <?= form_close() ?>
          </div>
        </div>

        <div class="credits text-center mt-2 text-muted small">
          &copy; <?= date('Y') ?> Kickverse Login
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>