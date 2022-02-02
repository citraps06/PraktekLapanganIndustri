<?php $this->extend('layout/admin') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                  <h3 class="card-title">Status Coaching </h3>
                      &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                      <?php echo $info2; ?>


                    <div class="card-tools d-inline">
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
                                            <th>Jurusan</th>
                                            <th>Periode</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                    <?php foreach ($info as $infokocing) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $i; ?> </td>
                                                <td><?php echo $infokocing['NIM']; ?></td>
                                                <td><?php echo $infokocing['Nama_Mhs']; ?></td>
                                                <td><?php echo $infokocing['Jurusan']; ?></td>
                                                <td><?php echo $infokocing['periode']; ?></td>
                                                <td><?php echo $infokocing['Status']; ?></td>

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

<script type="text/javascript">
$(document).ready( function () {
  $('#myTable').DataTable();
} );
</script>
<?php $this->endSection() ?>
