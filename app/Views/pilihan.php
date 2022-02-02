<?php $this->extend('layout/login') ?>
<?php $this->section('content') ?>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="login-wrap p-4 p-md-5">
          <h3 class="text-center mb-4">Sistem Informasi <br> Praktek Lapangan Industri</h3>
          <div class="row">
            <div class="col col-md-4 ">
              <a style="width: 100px;" href="/login/regis_dsn" type="button" class="btn btn-primary rounded submit ">Dosen</a>
            </div>
            <div class="col col-md-4">
              <a href="/login/regis_mhs" type="button" class="btn btn-primary rounded submit ">Mahasiswa</a>
            </div>
            <div class="col col-md-4 ">
              <a href="/login/regis_perusahaan" type="button" class="btn btn-primary rounded submit  ">Perusahaan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->endSection() ?>
