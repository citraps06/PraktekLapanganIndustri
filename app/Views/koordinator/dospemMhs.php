<?php $this->extend('layout/koor') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Dosen Pembimbing Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/koordinator/edit_dospem" method="POST">
                    <?php csrf_field(); ?>
                    <!-- Cross Site Request Forgery (keamanan halaman website) -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM </label>
                            <input class="form-control" type="text" name="nim" value="<?= $info['NIM']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama </label>
                            <input class="form-control" type="text" name="nama" value="<?= $info['Nama_Mhs']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat PLI </label>
                            <input class="form-control" type="text" name="tempat" value="<?= $info['Nama_Perusahaan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing</label>
                            <select class="form-control" name="dospem">
                                <?php foreach ($dosen as $dospem) : ?>
                                    <option value="<?= $dospem['NID'] ?>"><?= $dospem['Nama_Dsn'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="hidden" value="<?= $info['Id_Pli']; ?>" name="id">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
