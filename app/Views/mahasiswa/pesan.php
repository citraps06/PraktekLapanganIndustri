<?php $this->extend('layout/mhs') ?>
<?php $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="card card-pink">
                    <div class="card-header">
                        <h3 class="card-title">Pesan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <h4><?= session()->getFlashdata('pesan') ?></h4>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content -->
</div>
<?php $this->endSection() ?>