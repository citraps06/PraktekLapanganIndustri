<?php $this->extend('layout/admin') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Update Informasi</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action='/admin/edit_usaha' method="POST" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    <!-- Cross Site Request Forgery (keamanan halaman website) -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Perusahaan</label>
                            <input class="form-control " type="text" autofocus value="<?= $info['Nama_Perusahaan']; ?>">
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Alamat Perusahaan</label>
                            <input class="form-control" type="text" value="<?= $info['Alamat_Perusahaan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama CEO</label>
                            <input class="form-control" type="text" value="<?= $info['Nama_Ceo']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" type='text' name="status">
                                <option value="">Pending</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $info['Id_Perusahaan']; ?>">
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button name="submit" type="submit" class="btn btn-primary">Update</button>
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
