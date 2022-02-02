<?php $this->extend('layout/admin') ?>
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
                <form action='/admin/edit_coaching' method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value='PATCH'>
                    <?php csrf_field(); ?>
                    <!-- Cross Site Request Forgery (keamanan halaman website) -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM</label>
                            <input class="form-control" type="text" name="nim" value="<?= $info['NIM'] ?>" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input class="form-control" type="text" name="nama" value="<?= $info['Nama_Mhs'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jurusan</label>
                            <input class="form-control" type="text" name="jurusan" value="<?= $info['Jurusan'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" type='text' name="status">
                                <option>Pending</option>
                                <option>Lulus</option>
                                <option>Tidak Lulus</option>
                            </select>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?= $info['Id_Coaching'] ?>">
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