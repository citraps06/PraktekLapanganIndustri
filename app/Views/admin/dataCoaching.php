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
                                <input type="text" name="keyword" class="form-control float-right" placeholder="NIM">

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
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Total SKS</th>
                                            <th>Lembar Hasil Studi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                    <?php foreach ($info as $infokocing) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $i; ?> </td>
                                                <td><?php echo $infokocing['NIM']; ?></td>
                                                <td><?php echo $infokocing['Nama_Mhs']; ?></td>
                                                <td><?php echo $infokocing['Total_sks']; ?></td>
                                                <td><a href="/admin/download_coaching/<?= $infokocing['NIM']; ?>"><?php echo $infokocing['File_Lhs']; ?></a></td>
                                                <td><?php echo $infokocing['Status']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="/admin/ubah_coaching/<?= $infokocing['Id_Coaching']; ?>" type="button" class="btn btn-default">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <form action="/admin/delete_mhscoaching" onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $infokocing['Nama_Mhs'] ?> dalam data Coaching?')">
                                                            <button type="submit" type="button" class="btn btn-default">
                                                                <input type="hidden" value="<?= $infokocing['Id_Coaching']; ?>" name="id">
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
                        <?php echo $pager->links('coaching', 'coaching_pagination'); ?>
                    </div>
                    <!-- /.card-body -->

                    <a href="<?php echo base_url('/admin/absensi') ?>" type="submit" class="btn btn-primary">Cetak Absensi</a>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>