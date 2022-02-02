<?php $this->extend('layout/admin') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Daftar Coaching</h3>
                    <div class="card-tools">
                        <form action="" method="post">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="Nama Perusahaan">

                                <div class="input-group-append">
                                    <button type="submit" name="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NID</th>
                                            <th>Nama Dosen</th>
                                            <th>Jurusan</th>
                                            <th>No.Telp</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 1; ?>
                                    <?php foreach ($info as $dosen) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $i; ?> </td>
                                                <td><?php echo $dosen['NID']; ?></td>
                                                <td><?php echo $dosen['Nama_Dsn']; ?></td>
                                                <td><?php echo $dosen['Jurusan_Dsn']; ?></td>
                                                <td><?php echo $dosen['No_hp']; ?></td>
                                                <td><?php echo $dosen['Status']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="/admin/update_dosen/<?= $dosen['NID']; ?>" type="button" class="btn btn-default">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <form action="/admin/delete_dosen" onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $dosen['Nama_Dsn'] ?> dalam data dosen ?')">
                                                            <button type="submit" type="button" class="btn btn-default">
                                                                <input type="hidden" value="<?= $dosen['NID']; ?>" name="id">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <div class="card-footer">
                    <div class="float-right">
                    </div>
                    <!-- /.card-body -->

                    
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>
