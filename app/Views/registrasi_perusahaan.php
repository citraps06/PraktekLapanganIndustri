<?php $this->extend('layout/login') ?>
<?php $this->section('content') ?>

<section class="mt-5 mb-5">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <h3 class="text-center mb-2">Buat Akun Perusahaan</h3>
                    <form action="/login/regis_perusahaansave" class="login-form" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Nama Prusahaan" name="nama" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Alamat Perusahaan" name="alamat">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Nama CEO" name="ceo">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Nama Supervisor" name="surv">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control rounded-left" placeholder="Berkas" name="berkas">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control rounded-left" placeholder="Tanggal Berdiri" name="tanggal">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Username" name="username">
                        </div>
                        <div class="form-group d-flex">
                            <input type="password" class="form-control rounded-left" placeholder="Password" name="password">
                        </div>
                        <div class="row">
                          <div class="col col-md-12">
                            <div class="form-group mb-5">
                              <button style="width: 350px;" type="submit" class="btn btn-primary rounded submit p-2 ">Daftar</button>
                            </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection() ?>
