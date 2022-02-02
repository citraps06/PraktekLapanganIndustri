<?php $this->extend('layout/admin') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Pengiriman PLI</h3>
                    &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                    <?php echo $info2; ?>

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
                      <br>
                            <form class="row g-2" action="" method="post">
                              <div class="col-auto">
                                <select class="form-control" style="width:200px;" name="keyword1" >
                                  <option value="">--Pilih Periode--</option>
                                  <?php foreach ($info1 as $infokocing) : ?>
                                    <option value="<?php echo $infokocing['periode']; ?>"><?php echo $infokocing['periode']; ?>  </option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="col-auto">
                                <button class="btn btn-primary d-inline" type="submit" name="button">Kirim</button>
                              </div>
                            </form>

                        <div class="row mt-3">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Tempat PLI</th>
                                            <th>Periode</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                    <?php foreach ($info as $datapli) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $i; ?> </td>
                                                <td><?php echo $datapli['NIM']; ?></td>
                                                <td><?php echo $datapli['Nama_Mhs']; ?></td>
                                                <td><?php echo $datapli['Nama_Perusahaan']; ?></td>
                                                <td><?php echo $datapli['periode']; ?></td>
                                                <td><?php echo $datapli['Status']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="/admin/surat_pengantar/<?php echo $datapli['Id_Pli']; ?>" type="button" target="_blank" class="btn btn-default">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                        <form action="/admin/hapus_pli" method="POST" onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $datapli['Nama_Mhs'] ?> ')">
                                                            <input type="hidden" name="id" value="<?php echo $datapli['Id_Pli']; ?>">
                                                            <button type="submit" class="btn btn-default">
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
                        <?php echo $pager->links('status', 'coaching_pagination'); ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>
