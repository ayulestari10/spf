                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Karyawan Panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('karyawan') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?= count($daftar_penilaian) ?></h3>
                                    <p>
                                        Daftar Penilaian
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="<?= base_url('karyawan/daftar-penilaian') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php if (isset($id_departemen) && $id_departemen == 2): ?>
                        <!-- <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?= count($penilaian) ?>
                                    </h3>
                                    <p>
                                        Penilaian Karyawan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="<?= base_url('karyawan/penilaian') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div> --><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?= count($penilaian) ?> <!-- <sup style="font-size: 20px">%</sup> -->
                                    </h3>
                                    <p>
                                        Kelola Data Karyawan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="<?= base_url('karyawan/karyawan') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        - <!-- <sup style="font-size: 20px">%</sup> -->
                                    </h3>
                                    <p>
                                        Input Penilaian
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="<?= base_url('karyawan/input-penilaian') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        - <!-- <sup style="font-size: 20px">%</sup> -->
                                    </h3>
                                    <p>
                                        Input Kriteria
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="<?= base_url('karyawan/input-kriteria') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        - <!-- <sup style="font-size: 20px">%</sup> -->
                                    </h3>
                                    <p>
                                        Kelola Data Departemen
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="<?= base_url('karyawan/departemen') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        - <!-- <sup style="font-size: 20px">%</sup> -->
                                    </h3>
                                    <p>
                                        Kelola Data Jabatan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="<?= base_url('karyawan/jabatan') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        - <!-- <sup style="font-size: 20px">%</sup> -->
                                    </h3>
                                    <p>
                                        Pengaturan Bobot Gap
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cog"></i>
                                </div>
                                <a href="<?= base_url('karyawan/bobot-gap') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php endif; ?>
                    </div><!-- /.row -->
                </section><!-- /.content -->
