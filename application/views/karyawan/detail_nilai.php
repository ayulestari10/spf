<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Detail Penilaian </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php  
                $msg = $this->session->flashdata('msg');
                if (isset($msg)) echo $msg;
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Detail Penilaian                                                             
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <style type="text/css">
                                tr th, tr td {text-align: center;}
                            </style>
                            <?php  
                                $jenis_kriteria = $this->jenis_kriteria_m->get();
                                $gap_subkriteria = [];
                                foreach ($jenis_kriteria as $jk):
                            ?>
                            <h3><?= $jk->nama_kriteria ?></h3>
                            <table width="100%" class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                <thead>
                                    <th>Sub Kriteria</th>
                                    <th>Standar</th>
                                    <th>Nilai</th>
                                    <th>Gap</th>
                                </thead>
                                <tbody>
                                    <?php  
                                        $nilai = $this->nilai_m->get([
                                            'id_penilaian'          => $id_penilaian,
                                            'id_karyawan'           => $id_karyawan,
                                            'id_jenis_kriteria'     => $jk->id_jenis_kriteria
                                        ]);
                                        foreach ($nilai as $row):
                                    ?>
                                    <?php  
                                        $subkriteria = $this->subkriteria_m->get_row(['id_subkriteria' => $row->id_subkriteria]);
                                        if (!isset($subkriteria))
                                        {
                                            continue;
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $subkriteria->nama ?></td>
                                        <td><?= $subkriteria->standar_nilai ?></td>
                                        <td><?= $row->nilai ?></td>
                                        <td>
                                            <?php 
                                                $gap = $row->nilai - $subkriteria->standar_nilai; 
                                                echo $gap;
                                                if ($gap < 0)
                                                {
                                                    $gap *= -1;
                                                    $percentage = (float)$gap/(float)$subkriteria->standar_nilai * 100;
                                                    if ($percentage > 50)
                                                    {
                                                        $gap_subkriteria []= $subkriteria->nama;
                                                    }
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <label>NCF: <?= $this->gap_analysis_m->factor($id_penilaian, $id_karyawan, $jk->id_jenis_kriteria, 1, $karyawan->id_departemen, $karyawan->id_jabatan) ?></label><br>
                            <label>NSF: <?= $this->gap_analysis_m->factor($id_penilaian, $id_karyawan, $jk->id_jenis_kriteria, 2, $karyawan->id_departemen, $karyawan->id_jabatan) ?></label>
                            <?php endforeach; ?>
                            <!-- /.table-responsive -->
                            <h3>Hasil Akhir Penilaian</h3>
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td>Kompetensi Inti</td>
                                        <td><?= $hasil_penilaian->kompetensi_inti ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi Peran</td>
                                        <td><?= $hasil_penilaian->kompetensi_peran ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi Fungsional</td>
                                        <td><?= $hasil_penilaian->kompetensi_fungsional ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hasil Akhir</td>
                                        <td><?= $hasil_penilaian->hasil_akhir ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4>Subkriteria yang direkomendasikan untuk diikuti pelatihan</h4>
                            <?php if (count($gap_subkriteria) <= 0): ?>
                                <p>Tidak ada</p>
                            <?php endif; ?>
                            <?php foreach ($gap_subkriteria as $row): ?>
                                <p><?= $row ?></p>
                            <?php endforeach; ?>
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

        // $(document).ready(function() {
        //     $('.dataTables-example').DataTable({
        //         responsive: true
        //     });
        // });
</script>