<?php $this->extend('layout/admin') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Tambah Informasi</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action='/admin/save' method="POST" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    <!-- Cross Site Request Forgery (keamanan halaman website) -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input class="form-control <?= ($validation->hasError('Judul')) ? 'is-invalid' : ''; ?>" type="text" placeholder="Nama" name="Judul" autofocus value="<?= old('judul'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('Judul'); ?>
                            </div>
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea id="ckeditor" class="form-control" rows="3" placeholder="Keterangan..." name="Ket" value="" required></textarea>
                        </div>
                        <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                        <script> CKEDITOR.replace( 'ckeditor' ); </script>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal</label>
                            <input class="form-control" type="date" placeholder="Tanggal" name="Tanggal" value="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Upload File</label>
                            <p style="font-size: x-small;" class="d-inline">*.pdf</p>
                            <input class="form-control" type="File" name="File" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
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
