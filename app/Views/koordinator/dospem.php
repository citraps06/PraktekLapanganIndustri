<?php $this->extend('layout/koor') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Dosen Pembimbing</h3>
                    &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                    <?php echo $info2; ?>

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
                                                <th>Dosen Pembimbing</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php $i = 1; ?>
                                        <?php foreach ($info as $dospem) : ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $i ?> </td>
                                                    <td><?php echo $dospem['NIM'] ?></td>
                                                    <td><?php echo $dospem['Nama_Mhs'] ?></td>
                                                    <td><?php echo $dospem['Nama_Perusahaan'] ?></td>
                                                    <td><?php echo $dospem['Nama_Dsn'] ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="/koordinator/update_dospem/<?= $dospem['Id_Pli']; ?>" type="button" class="btn btn-default">
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
                    <!-- /.card-body -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>
