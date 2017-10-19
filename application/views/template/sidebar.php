<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=base_url('assets/img/avatar.jpg')?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <?php if(isset($username)): ?>
                    <p>Hello <?= $username ?></p>
                <?php else: ?>
                    <p>Hello User</p>
                <?php endif; ?>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="<?= base_url('') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <?php if (isset($id_jabatan) && $id_jabatan == 2): ?>
            <li>
                <a href="<?= base_url('manajer/penilaian') ?>">
                    <i class="fa fa-user"></i> <span>Beri Nilai Karyawan</span>
                </a>
            </li>
                <?php if (isset($id_departemen) && $id_departemen == 2): ?>
                <li>
                    <a href="<?= base_url('manajer/input-penilaian') ?>">
                        <i class="fa fa-book"></i> <span>Input Penilaian</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('manajer/input-kriteria') ?>">
                        <i class="fa fa-book"></i> <span>Input Kriteria Penilaian</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?= base_url('manajer/bobot-gap') ?>">
                        <i class="fa fa-cog"></i> <span>Pengaturan Bobot Gap</span>
                    </a>
                </li> -->
                <?php endif; ?>
            <?php elseif (isset($id_jabatan) && ($id_jabatan == 3 or $id_jabatan == 1)): ?>
            <li>
                <a href="<?= base_url('karyawan/daftar-penilaian') ?>">
                    <i class="fa fa-book"></i> <span>Daftar Penilaian</span>
                </a>
            </li>
                <?php if (isset($id_departemen) && $id_departemen == 2): ?>
                <!-- <li>
                    <a href="<?= base_url('karyawan/penilaian') ?>">
                        <i class="fa fa-user"></i> <span>Penilaian Karyawan</span>
                    </a>
                </li> -->
                <li>
                    <a href="<?= base_url('karyawan/karyawan') ?>">
                        <i class="fa fa-users"></i> <span>Kelola Data Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('karyawan/input-penilaian') ?>">
                        <i class="fa fa-book"></i> <span>Input Penilaian</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('karyawan/input-kriteria') ?>">
                        <i class="fa fa-book"></i> <span>Input Kriteria</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('karyawan/departemen') ?>">
                        <i class="fa fa-book"></i> <span>Kelola Data Departemen</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('karyawan/jabatan') ?>">
                        <i class="fa fa-book"></i> <span>Kelola Data Jabatan</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('karyawan/bobot-gap') ?>">
                        <i class="fa fa-cog"></i> <span>Pengaturan Bobot Gap</span>
                    </a>
                </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
