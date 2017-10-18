                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Direktur
                        <small>Kategori Departemen</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('direktur') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Kategori Departemen</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <?php foreach ($departemen as $row): ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        -
                                    </h3>
                                    <p>
                                        <?= $row->nama ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="<?= base_url('direktur/kategori-jabatan?id_departemen=' . $row->id_departemen . '&id_penilaian=' . $id_penilaian) ?>" class="small-box-footer">
                                    Lihat <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php endforeach; ?>
                    </div><!-- /.row -->
                </section><!-- /.content -->
