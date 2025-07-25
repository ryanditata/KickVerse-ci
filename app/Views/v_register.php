<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('NiceAdmin/assets/css/custom.css') ?>" rel="stylesheet">

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
              <h5 class="card-title text-center pb-0 fs-4 text-black">Daftar Akun</h5>
              <p class="text-center small">Silakan isi data untuk membuat akun</p>
            </div>

            <?= form_open('register/process', ['class' => 'row g-3 needs-validation', 'novalidate' => true]) ?>

              <!-- Username -->
              <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" value="<?= old('username') ?>" required>
                <?php if (session('errors.username')): ?>
                  <div class="invalid-feedback"><?= session('errors.username') ?></div>
                <?php endif; ?>
              </div>

              <!-- Email -->
              <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" required>
                <?php if (session('errors.email')): ?>
                  <div class="invalid-feedback"><?= session('errors.email') ?></div>
                <?php endif; ?>
              </div>

              <!-- Phone -->
              <div class="col-12">
                <label for="phone" class="form-label">Nomor HP</label>
                <input type="text" name="phone" class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>" value="<?= old('phone') ?>" required>
                <?php if (session('errors.phone')): ?>
                  <div class="invalid-feedback"><?= session('errors.phone') ?></div>
                <?php endif; ?>
              </div>

              <!-- Password -->
              <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" required>
                <?php if (session('errors.password')): ?>
                  <div class="invalid-feedback"><?= session('errors.password') ?></div>
                <?php endif; ?>
              </div>

              <!-- Password Confirm -->
              <div class="col-12">
                <label for="password_confirm" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirm" class="form-control <?= session('errors.password_confirm') ? 'is-invalid' : '' ?>" required>
                <?php if (session('errors.password_confirm')): ?>
                  <div class="invalid-feedback"><?= session('errors.password_confirm') ?></div>
                <?php endif; ?>
              </div>

              <!-- Submit -->
              <div class="col-12">
                <button class="btn btn-dark w-100 fw-semibold rounded-pill mt-3" type="submit">Daftar</button>
              </div>

              <p class="text-center mt-3">
                Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-black">Login</a>
              </p>

            <?= form_close() ?>
          </div>
        </div>

        <div class="credits text-center mt-2 text-muted small">
          &copy; <?= date('Y') ?> Kickverse Register
        </div>

      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>