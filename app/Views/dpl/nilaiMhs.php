<?php $this->extend('layout/dpl') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Nilai Mahasiswa PLI</h3>
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
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Jurusan</th>
                                                <th>Tempat PLI</th>
                                                <th>Laporan</th>
                                                <th>File Nilai Supervisor</th>
                                                <th>File Nilai DPL</th>
                                                <th>Nilai Supervisor</th>
                                                <th>Nilai DPL</th>
                                                <th>Total Nilai</th>
                                                <th>Nilai Akhir</th>
                                                <th>Akred</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($info as $nilai) : ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $nilai['NIM'] ?></td>
                                                    <td><?php echo $nilai['Nama_Mhs'] ?></td>
                                                    <td><?php echo $nilai['Jurusan'] ?></td>
                                                    <td><?php echo $nilai['Nama_Perusahaan'] ?></td>
                                                    <td><a href="/dpl/download_laporan/<?= $nilai['NIM']; ?>"><?php echo $nilai['Laporan']; ?></a></td>
                                                    <td><a href="/dpl/download_surv/<?= $nilai['NIM']; ?>"><?php echo $nilai['File_surv']; ?></a></td>
                                                    <td><a href="/dpl/download_dpl/<?= $nilai['NIM']; ?>"><?php echo $nilai['File_Dpl']; ?></a></td>
                                                    <td><?php echo $nilai['Nilai_surv'] ?></td>
                                                    <td><?php echo $nilai['Nilai_Dpl'] ?></td>
                                                    <td><?php echo $nilai['Total_Nilai'] ?></td>
                                                    <td><?php echo $nilai['Nilai_Akhir'] ?></td>
                                                    <td><?php echo $nilai['Akred'] ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="/dpl/update_nilai/<?= $nilai['Id_Pli']; ?>" type="button" class="btn btn-default">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
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
