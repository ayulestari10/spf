<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Penilaian </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data  Penilaian                                                             
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <style type="text/css">
                                tr th, tr td {text-align: center;}
                            </style>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Departemen</th>
                                        <th>Jabatan</th>
                                        <th>Status Penilaian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($karyawan as $row): ?>
                                    <tr>
                                        <td><?= $row->NIK ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td>
                                            <?php 
                                                $departemen = $this->departemen_m->get_row(['id_departemen' => $row->id_departemen]);
                                                if (isset($departemen))
                                                {
                                                    echo $departemen->nama;
                                                }
                                                else
                                                {
                                                    echo '<font color="red">Data departemen tidak ditemukan</font>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $jabatan = $this->jabatan_m->get_row(['id_jabatan' => $row->id_jabatan]);
                                                if (isset($jabatan))
                                                {
                                                    echo $jabatan->nama;
                                                }
                                                else
                                                {
                                                    echo '<font color="red">Data jabatan tidak ditemukan</font>';
                                                }
                                            ?>
                                        </td>
                                        <td id="karyawan-<?= $row->id_karyawan ?>"><button class="btn btn-success btn-sm" onclick="acc_penilaian(<?= $row->id_karyawan ?>);"><i class="fa fa-check"></i> Valid</button></td>
                                        <td align="center">
                                            <?php  
                                                $check_nilai = $this->nilai_m->get([
                                                    'id_penilaian'  => $id_penilaian,
                                                    'id_karyawan'   => $row->id_karyawan
                                                ]);
                                            ?>
                                            <a href="<?= base_url('manajer/input-nilai-karyawan?id_penilaian=' . $id_penilaian . '&id_karyawan=' . $row->id_karyawan) ?>" class="btn btn-<?= count($check_nilai) > 0 ? 'success' : 'primary' ?> btn-sm waves-effect"><i class="fa fa-edit"></i> Beri nilai</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        
    </div>
</section>

<script type="text/javascript">

        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        function acc_penilaian(id_karyawan) {
            $.ajax({
                url: '<?= base_url('manajer/penilaian-detail?id_penilaian=' . $id_penilaian) ?>',
                type: 'POST',
                data: {
                    validasi: true,
                    id_karyawan: id_karyawan
                },
                success: function(response) {
                    
                },
                error: function(e) {
                    console.log(e.responseText);
                }
            });

            return false;
        }
</script>