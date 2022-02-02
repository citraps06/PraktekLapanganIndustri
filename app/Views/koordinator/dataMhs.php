<?php $this->extend('layout/koor') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa </h3>

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
                                            <th>Departement</th>
                                            <th>Total SKS</th>
                                            <th>Lembar Hasil Studi</th>
                                            <th>Proposal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 1 + (($currentPage - 1) * 10); ?>
                                    <?php foreach ($info as $pli) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $i ?> </td>
                                                <td><?php echo $pli['NIM'] ?></td>
                                                <td><?php echo $pli['Nama_Mhs'] ?></td>
                                                <td><?php echo $pli['Nama_Perusahaan'] ?></td>
                                                <td><?php echo $pli['Bidang'] ?></td>
                                                <td><?php echo $pli['Total_sks'] ?></td>
                                                <td><a href="/koordinator/download_lhs/<?= $pli['NIM']; ?>"><?php echo $pli['File_Lhs']; ?></a></td>
                                                <td><a href="/koordinator/download_proposal/<?= $pli['NIM']; ?>"><?php echo $pli['Proposal']; ?></a></td>
                                                <td><?php echo $pli['Status'] ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="/koordinator/update_datamhs/<?= $pli['Id_Pli']; ?>" type="button" class="btn btn-default">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php $i++; ?>
                                    <?php endforeach ?>
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

                <!-- /.card-body -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>
