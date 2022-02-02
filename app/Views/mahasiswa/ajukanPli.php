<?php $this->extend('layout/mhs') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Daftar PLI</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?php echo base_url('/mahasiswa/savepli') ?>" method="POST" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    <!-- Cross Site Request Forgery (keamanan halaman website) -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM </label>
                            <input class="form-control" type="text" placeholder="NIM" autofocus name="nim">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama </label>
                            <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total SKS </label>
                            <input class="form-control" type="text" placeholder="Total SKS" name="sks"required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lembar LHS</label>
                            <p style="font-size: x-small;" class="d-inline">*LHS_NIM_Nama</p>
                            <input class="form-control" type="File" name="lhs" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Proposal</label>
                            <p style="font-size: x-small;" class="d-inline">*Proposal_NIM_Nama</p>
                            <input class="form-control" type="File" name="proposal" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat PLI </label>
                            <select class="form-control" name="usaha" id="" required>
                                <option value="" >Pilih Perusahaan</option>
                                <?php foreach ($info as $usaha) : ?>
                                    <option value="<?= $usaha['Id_Perusahaan']; ?>"><?= $usaha['Nama_Perusahaan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Departement</label>
                            <input class="form-control" type="text" placeholder="Departement" name="bidang" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Mulai</label>
                            <input class="form-control" type="date" placeholder="Tanggal Mulai" name="mulai" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Selesai</label>
                            <input class="form-control" type="date" placeholder="Tanggal Selesai" name="selesai" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
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
