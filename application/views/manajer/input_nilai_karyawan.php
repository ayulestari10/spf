<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Input Nilai Karyawan </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php  
                $msg = $this->session->flashdata('msg');
                if (isset($msg)) echo $msg;
            ?>
            <div class="row" style="margin-top: 5%;">
                <div class="col-md-8 col-md-offset-1">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>NIK</b></td>
                            <td><?= $karyawan->NIK ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama</b></td>
                            <td><?= $karyawan->nama ?></td>
                        </tr>
                        <tr>
                            <td><b>Departemen</b></td>
                            <td>
                                <?php  
                                    $departemen = $this->departemen_m->get_row(['id_departemen' => $karyawan->id_departemen]);
                                    if (isset($departemen))
                                    {
                                        echo $departemen->nama;
                                    }
                                    else
                                    {
                                        echo 'Data departemen tidak ditemukan';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Jabatan</b></td>
                            <td>
                                <?php  
                                    $jabatan = $this->jabatan_m->get_row(['id_jabatan' => $karyawan->id_jabatan]);
                                    if (isset($jabatan))
                                    {
                                        echo $jabatan->nama;
                                    }
                                    else
                                    {
                                        echo 'Data jabatan tidak ditemukan';
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?= form_open('manajer/input-nilai-karyawan?id_penilaian=' . $id_penilaian . '&id_karyawan=' . $id_karyawan) ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <?php foreach ($kriteria as $row): ?>
                            <h4>
                                <?php  
                                    $jenis_kriteria = $this->jenis_kriteria_m->get_row(['id_jenis_kriteria' => $row->id_jenis_kriteria]);
                                    if (isset($jenis_kriteria))
                                    {
                                        echo $jenis_kriteria->nama_kriteria;
                                    }
                                    else
                                    {
                                        echo 'Nama kriteria tidak ditemukan';
                                    }
                                ?>
                            </h4>
                            <table class="table table-bordered">
                                <?php 
                                    $subkriteria = $this->subkriteria_m->get(['id_kriteria' => $row->id_kriteria]);
                                    foreach ($subkriteria as $sub):
                                ?>
                                    <tr>
                                        <td><b><?= $sub->nama ?></b></td>
                                        <td style="width: 13%;">
                                            <?php  
                                                $check_nilai = $this->nilai_m->get_row([
                                                    'id_penilaian'      => $id_penilaian,
                                                    'id_karyawan'       => $id_karyawan,
                                                    'id_jenis_kriteria' => $row->id_jenis_kriteria,
                                                    'id_subkriteria'    => $sub->id_subkriteria
                                                ]);
                                            ?>
                                            <input required type="number" min="0" name="nilai_sub_<?= $sub->id_subkriteria ?>" class="form-control" <?= isset($check_nilai) ? 'value="' . $check_nilai->nilai . '"' : '' ?> >
                                            <input type="hidden" name="id_sub[]" value="<?= $sub->id_subkriteria ?>">
                                            <input type="hidden" name="jenis_sub_<?= $sub->id_subkriteria ?>" value="<?= $row->id_jenis_kriteria ?>">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="row">
                    <?php if (count($kriteria) > 0): ?>
                    <div class="col-md-8 col-md-offset-1">
                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
                    </div>
                    <?php else: ?>
                    <div class="col-md-8 col-md-offset-1">
                        <?= 'Departemen ' . $departemen->nama . ' dengan jabatan ' . $jabatan->nama . ' belum memiliki kriteria penilaian. Silahkan buat kriteria penilaiannya terlebih dahulu' ?>
                    </div>
                    <?php endif ?>
                </div>
                <!-- /.row -->
            <?= form_close() ?>      
    </div>
</section>

<script type="text/javascript">

        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        function addFormInput() {
            $('#form-container').append('<div class="row" style="margin-top: 2%;">' +
                    '<div class="col-md-4 col-md-offset-1">' +
                        '<div class="form-group">' +
                            '<label>Selisih</label>' +
                            '<input type="number" name="selisih[]" class="form-control">' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                        '<div class="form-group">' +
                            '<label>Bobot Nilai</label>' +
                            '<input type="number" name="bobot_nilai[]" step="0.1" class="form-control">' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="row">' +
                    '<div class="col-md-8 col-md-offset-1">' +
                        '<div class="form-group">' +
                            '<label>Keterangan</label>' +
                            '<textarea class="form-control" name="keterangan[]"></textarea>' +
                        '</div>' +
                    '</div>' +
                '</div>');

            return false;
        }
</script>