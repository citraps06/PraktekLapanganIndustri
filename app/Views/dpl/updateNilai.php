<?php $this->extend('layout/dpl') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Nilai Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/dpl/edit_nilai" method="POST" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    <!-- Cross Site Request Forgery (keamanan halaman website) -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM </label>
                            <input class="form-control" type="text" value="<?= $info['NIM'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama </label>
                            <input class="form-control" type="text" value="<?= $info['Nama_Mhs'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jurusan </label>
                            <input class="form-control" type="text" value="<?= $info['Jurusan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat PLI </label>
                            <input class="form-control" type="text" value="<?= $info['Nama_Perusahaan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">File Nilai Supervisor</label>
                            <input class="form-control" type="text" value="<?= $info['File_surv'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">File Nilai Dosen Pembimbing </label>
                            <input class="form-control" type="file" name="file_dpl" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nilai Supervisor</label>
                            <input class="form-control" type="text" name="nilai_surv">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nilai Dosen Pembimbing </label>
                            <input class="form-control" type="text" name="nilai_dpl">
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
