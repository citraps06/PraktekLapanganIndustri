<?php $this->extend('layout/koor') ?>
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
                <form action="/koordinator/edit_nilai" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama </label>
                            <input class="form-control" type="text" name="nama" value="<?= $info['Nama_Mhs']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM </label>
                            <input class="form-control" type="text" name="nim" value="<?= $info['NIM'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jurusan </label>
                            <input class="form-control" type="text" name="jurusan" value="<?= $info['Jurusan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat PLI </label>
                            <input class="form-control" type="text" name="tempat" value="<?= $info['Nama_Perusahaan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nilai Supervisor</label>
                            <input class="form-control" type="text" name="surv" value="<?= $info['Nilai_surv'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nilai Dosen Pembimbing </label>
                            <input class="form-control" type="text" name="dpl" value="<?= $info['Nilai_Dpl'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nilai Akhir </label>
                            <input class="form-control" type="text" name="total" value="<?= $info['Nilai_Akhir'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Verifikasi</label>
                            <select name="status" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Verified">Verified</option>
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
