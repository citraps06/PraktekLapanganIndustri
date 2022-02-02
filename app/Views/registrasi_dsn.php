<?php $this->extend('layout/login') ?>
<?php $this->section('content') ?>

<section class="mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <h3 class="text-center mb-2">Buat Akun Dosen</h3>
                    <form action="/login/regis_dsnsave" class="login-form" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="NID" name="nid" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Nama Lengkap" name="nama">
                        </div>
                        <div class="form-group">
                            <select name="jurusan" class="form-control">
                                <option value="">Plih Jurusan </option>
                                <option value="Ilmu Kesejahteraan Keluarga">Ilmu Kesejahteraan Keluarga</option>
                                <option value="Tata Rias dan Kecantikan">Tata Rias dan Kecantikan</option>
                                <option value="Pariwisata">Pariwisata</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Nomor HP" name="hp">
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
