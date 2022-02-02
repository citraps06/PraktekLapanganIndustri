<?php $this->extend('layout/usaha') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Status Coaching</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action='/perusahaan/edit_datamhs' method="POST" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    <!-- Cross Site Request Forgery (keamanan halaman website) -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM</label>
                            <input class="form-control" type="text" name="nim" value="<?= $info['NIM'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input class="form-control" type="text" name="nama" value="<?= $info['Nama_Mhs'] ?> " disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jurusan</label>
                            <input class="form-control" type="text" name="jurusan" value="<?= $info['Jurusan'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Departement</label>
                            <input class="form-control" type="text" name="bidang" value="<?= $info['Bidang'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">File Nilai</label>
                            <input class="form-control" type="file" name="surv" required>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?= $info['Id_Pli'] ?>">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>
