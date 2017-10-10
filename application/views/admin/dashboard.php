                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Admin Panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                                    <h3><?= count($karyawan) ?></h3>
                                    <p>
                                        Daftar Karyawan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="<?= base_url('admin/karyawan') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?= count($departemen) ?> <!-- <sup style="font-size: 20px">%</sup> -->
                                    </h3>
                                    <p>
                                        Data Departemen
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-archive"></i>
                                </div>
                                <a href="<?= base_url('admin/departemen') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <!-- <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?= count($kriteria) ?>
                                    </h3>
                                    <p>
                                        Data kriteria
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?= base_url('admin/kriteria') ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div> --><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?= count($subkriteria) ?>
                                    </h3>
                                    <p>
                                        Data Sub Kriteria
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-pencil"></i>
                                </div>
                                <a href="<?= base_url('admin/subkriteria') ?>" class="small-box-footer">
                                    Selengkapnya<i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>
                                        <?= count($jabatan) ?>
                                    </h3>
                                    <p>
                                        Data Jabatan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="<?= base_url('admin/jabatan') ?>" class="small-box-footer">
                                    Selengkapnya<i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div>
                </section><!-- /.content -->
