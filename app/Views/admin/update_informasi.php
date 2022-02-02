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
                <form action='/admin/edit' method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value='PATCH'>

                        <?php csrf_field(); ?>
                        <!-- Cross Site Request Forgery (keamanan halaman website) -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input class="form-control " type="text" placeholder="Nama" name="Judul"  value="<?= $info['Judul']; ?>">
                            </div>
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea id="ckeditor" class="form-control" rows="3" placeholder="Keterangan..." name="Ket"><?= $info['Keterangan']; ?></textarea>
                                <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                                <script> CKEDITOR.replace( 'ckeditor' ); </script>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label>
                                <input class="form-control" type="date" placeholder="Tanggal" name="Tanggal" value="<?= $tgl; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Files</label>
                                <input class="form-control" type="text" disabled placeholder="File" name="File" value="<?= $info['File']; ?>" >
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $info['id_info']; ?>">

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
