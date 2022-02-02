<?php $this->extend('layout/mhs') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Status PLI</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <section class="content">

                    <div class="row">
                        <div class="col-12">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Jurusan</th>
                                            <th>Tempat PLI</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $info['NIM'] ?></td>
                                            <td><?php echo $info['Nama_Mhs'] ?></td>
                                            <td><?php echo $info['Jurusan'] ?></td>
                                            <td><?php echo $info['Nama_Perusahaan'] ?></td>
                                            <td><?php echo $info['Status'] ?></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>
