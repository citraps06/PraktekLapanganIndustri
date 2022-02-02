<?php $this->extend('layout/admin') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Permohonan PLI</h3>
                    <div class="card-tools">
                        <form action="" method="post">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="Search">

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
                <form>
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
                                                <th>Tempat PLI</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php $i = 1 + (($currentPage - 1) * 10); ?>
                                        <?php foreach ($info as $datapli) : ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $i; ?> </td>
                                                    <td><?php echo $datapli['NIM']; ?></td>
                                                    <td><?php echo $datapli['Nama_Mhs']; ?></td>
                                                    <td><?php echo $datapli['Nama_Perusahaan']; ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="/admin/surat_permohonan/<?php echo $datapli['Id_Pli']; ?>" type="button" target="_blank" class="btn btn-default">
                                                                <i class="fas fa-print"></i>
                                                            </a>
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
                            <?php echo $pager->links('pli', 'pli_pagination'); ?>
                        </div>
                    </div><!-- /.card-body -->
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>
