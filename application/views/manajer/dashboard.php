                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Manajer Panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('manajer') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?= count($penilaian) ?> <!-- <sup style="font-size: 20px">%</sup> -->
                                    </h3>
                                    <p>
                                        Beri Nilai Karyawan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="<?= base_url('manajer/penilaian') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php if (isset($id_departemen) && $id_departemen == 2): ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>-</h3>
                                    <p>
                                        Input Penilaian
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="<?= base_url('manajer/input-penilaian') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>-</h3>
                                    <p>
                                        Input Kriteria Penilaian
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="<?= base_url('manajer/input-kriteria') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <!-- <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>-</h3>
                                    <p>
                                        Pengaturan Bobot Gap
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cog"></i>
                                </div>
                                <a href="<?= base_url('manajer/bobot-gap') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div> --><!-- ./col -->
                        <?php endif; ?>
                    </div><!-- /.row -->
                </section><!-- /.content -->
