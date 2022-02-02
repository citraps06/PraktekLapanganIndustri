<?php $this->extend('layout/login') ?>
<?php $this->section('content') ?>

<section class="mt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="login-wrap p-4 p-md-5">
          <div class="icon d-flex align-items-center justify-content-center">
            <span><img src="/login/img/fpp.jpg" class="img-circle elevation-2" alt="User Image" height="90px" width="90px"></span>
          </div>
          <h3 class="text-center mb-4">Sistem Informasi <br> Praktek Lapangan Industri</h3>

          <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>
                <?= session()->getFlashdata('pesan'); ?>
              </div>
            </div>
          <?php endif; ?>

          <form action="/login/cek_login" class="login-form" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <input type="text" class="form-control rounded-left" placeholder="Username" name="username" autofocus> <!-- required=""-->
            </div>
            <div class="form-group ">
              <input type="password" class="form-control rounded-left" placeholder="Password" name="password"><!-- required=""-->
            </div>
            <div class="row">
              <div class="col col-md-12">
                <div class="form-group ">
                  <button style="width: 350px;" type="submit" class="btn btn-primary rounded submit p-2">Login</button>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col col-md-12 mt-5 text-center">
              <a type="buton" href="/login/pilihan">Buat akun</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->endSection() ?>
