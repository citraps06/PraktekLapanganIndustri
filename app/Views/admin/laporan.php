<?php $this->extend('layout/admin') ?>
<?php $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Periode <?php echo $info2; ?></h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
              <div class="col-auto float-right">
                <a type="button" class="btn btn-primary" href="/admin/excel/<?php echo $info2; ?>">
                  <i class="fas fa-file-invoice"></i>&ensp;Excel
                </a>
              </div>
            </form>
            <br>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h5>Ilmu Kesejahteraan Keluarga</h5>
                <h3><?= $jurusan_1; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a class="small-box-footer"><i class=""></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h5>Tata Rias dan Kecantikan</h5>
                <h3><?= $jurusan_3; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a class="small-box-footer"><i class=""></i></a>
            </div>
          </div><div class="col col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>Pariwisata</h5>
                <h3><?= $jurusan_2; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a class="small-box-footer"><i class=""></i></a>
            </div>
          </div>
        </div>

        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php $this->endSection() ?>
