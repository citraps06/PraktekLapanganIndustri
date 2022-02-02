<?php $this->extend('layout/admin') ?>
<?php $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <a class="btn-group" href="<?php echo base_url('/admin/add_informasi') ?>">
                    <button type="button" class="btn btn-default">
                        <i class="fas fa-plus"></i> &ensp; Tambah Informasi
                    </button>
                </a><br><br>
                <?php $i=0; ?>
                <?php foreach ($iklan as $berita) : ?>
                    <div class="card card-pink collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-bullhorn"></i> &ensp; <?php echo $berita['Judul']; ?> </h3>
                            <?php if ($berita['id_info']==$info['id_info']): ?>
                            <span class="badge badge-warning navbar-badge"><b>New</b></span>
                            <?php endif; ?>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo $berita['Keterangan']; ?>
                            <div class="col-ma-15">
                                <a href="/admin/pdf/<?= $berita['id_info'] ?>" type="button" target="_blank" class="btn btn-default">Download</a>
                                <a href="/admin/ubah/<?= $berita['id_info']; ?>" type="button" class="btn btn-default"> <i class="fas fa-pen"></i></a>
                                <form action="/admin/delete_informasi/" onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $berita['Judul'] ?> ')" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_hapus" value="<?= $berita['id_info']; ?>">
                                    <button type="submit" class="btn btn-default"> <i class="fas fa-trash"></i></button>
                                </form>

                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php $i++ ?>
                <?php endforeach; ?>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card-footer">
        <div class="float-right">
            <?php echo $pager->links('status', 'pli_pagination'); ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.content -->
</div>

<?php $this->endSection() ?>
