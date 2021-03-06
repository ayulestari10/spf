<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Penilaian </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <?php  
                $arr = $this->hasil_penilaian_m->get_rank($id_penilaian);
                $unsorted_arr = [];
                foreach ($karyawan as $row)
                {
                    foreach ($arr as $el)
                    {
                        if ($el->id_karyawan == $row->id_karyawan)
                        {
                            $unsorted_arr []= $row;
                            break;
                        }
                    }
                }
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Penilaian                                                             
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
                                        <th>Ranking</th>
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
                                        <td>
                                            <?php  
                                                $rank = 'Belum ada';
                                                foreach ($unsorted_arr as $key => $value)
                                                {
                                                    if ($value->id_karyawan == $row->id_karyawan)
                                                    {
                                                        $rank = $key + 1;
                                                        break;
                                                    }       
                                                }
                                                echo $rank;
                                            ?>
                                        </td>
                                        <td id="karyawan-<?= $row->id_karyawan ?>"><button class="btn btn-<?php 
                                            $state = FALSE;
                                            $hasil_penilaian = $this->hasil_penilaian_m->get_row([
                                                'id_penilaian'  => $id_penilaian,
                                                'id_karyawan'   => $row->id_karyawan
                                            ]);
                                            if (isset($hasil_penilaian))
                                            {
                                                $id_hasil = $hasil_penilaian->id_hasil;
                                                $acc = $this->acc_penilaian_m->get_row(['id_hasil' => $id_hasil]);
                                                if (isset($acc))
                                                {
                                                    if ($id_jabatan == 2 && $id_departemen == 2)
                                                    {
                                                        if ($acc->validasi_dept_manajer == 1)
                                                        {
                                                            $state = TRUE;
                                                        }
                                                    }
                                                    else if ($id_jabatan == 2)
                                                    {
                                                        if ($acc->validasi_dept_manajer == 1)
                                                        {
                                                            $state = TRUE;
                                                        }   
                                                    }
                                                    else if ($id_departemen == 2)
                                                    {
                                                        if ($acc->validasi_hrd == 1)
                                                        {
                                                            $state = TRUE;
                                                        }
                                                    }
                                                    else if ($id_jabatan == 3)
                                                    {
                                                        if ($acc->validasi_pimpinan == 1)
                                                        {
                                                            $state = TRUE;
                                                        }
                                                    }
                                                }
                                            }

                                            echo $state ? 'success' : 'danger';
                                        ?> btn-sm" onclick="acc_penilaian(<?= $row->id_karyawan ?>);"><i class="fa fa-<?= $state ? 'check' : 'times' ?>"></i> <?= $state ? 'Valid' : 'Tidak valid' ?></button></td>
                                        <?php if ($id_jabatan == 2): ?>
                                        <td align="center">
                                            <?php  
                                                $check_nilai = $this->nilai_m->get([
                                                    'id_penilaian'  => $id_penilaian,
                                                    'id_karyawan'   => $row->id_karyawan
                                                ]);
                                            ?>
                                            <a href="<?= base_url('manajer/input-nilai-karyawan?id_penilaian=' . $id_penilaian . '&id_karyawan=' . $row->id_karyawan) ?>" class="btn btn-<?= count($check_nilai) > 0 ? 'success' : 'primary' ?> btn-sm waves-effect"><i class="fa fa-edit"></i> Beri nilai</a>
                                        </td>
                                        <?php else: ?>
                                            <td align="center">
                                                <a href="<?= base_url('direktur' . '/detail-nilai?id_penilaian=' . $id_penilaian . '&id_karyawan=' . $row->id_karyawan) ?>" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-eye"></i> Lihat nilai</a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <a href="<?= base_url('direktur/unduh-laporan?id_penilaian=' . $id_penilaian) ?>" class="btn btn-primary btn-lg"><i class="fa fa-download"></i> Unduh Laporan</a>
                        </div>
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
                url: '<?= base_url('direktur' . '/penilaian-detail?id_penilaian=' . $id_penilaian) ?>',
                type: 'POST',
                data: {
                    validasi: true,
                    id_karyawan: id_karyawan
                },
                success: function(response) {
                    var json = $.parseJSON(response);
                    console.log(json);
                    var status = json.error;
                    if (status == false) {
                        $('#karyawan-' + id_karyawan).html(json.result);
                    } else {
                        alert('Karyawan tersebut belum memiliki hasil penilaian');
                    }
                },
                error: function(e) {
                    console.log(e.responseText);
                }
            });

            return false;
        }
</script>