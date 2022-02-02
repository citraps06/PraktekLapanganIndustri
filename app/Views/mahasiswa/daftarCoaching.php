<?php $this->extend('layout/mhs') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Daftar Coaching</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?php echo base_url('/mahasiswa/savecoaching') ?>" method="POST" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    <!-- Cross Site Request Forgery (keamanan halaman website) -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM </label>
                            <input class="form-control" type="text" placeholder="NIM" name="nim">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NAMA </label>
                            <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total SKS </label>
                            <input class="form-control" type="text" placeholder="Total SKS" name="sks" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Lembar LHS</label>
                            <input class="form-control" type="text" placeholder="Total SKS" name="lhs">
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lembar LHS</label>
                            <input class="form-control" type="File" name="File" required>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button href="" type="submit" class="btn btn-primary">Submit</button>
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
