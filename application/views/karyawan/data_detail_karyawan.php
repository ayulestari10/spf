<section class="content">
    <div class="container-fluid">
<!-- Bordered Table -->
        <div class="row ">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <div class="card">
                    <div class="header">
                        <h2>
                            Detail Karyawan
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <?php foreach ($columns as $column): ?>
                                    <tr>
                                        <td>
                                            <?php  
                                                if ($column == 'id_departemen')
                                                {
                                                    echo 'Departemen';
                                                }
                                                else if ($column == 'id_jabatan')
                                                {
                                                    echo 'Jabatan';
                                                }
                                                else
                                                {
                                                    echo ucwords(str_replace("_", " ", $column));    
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $data = (array)$data; 
                                                if ($column == 'id_departemen')
                                                {
                                                    $departemen = $this->departemen_m->get_row(['id_departemen' => $data[$column]]);
                                                    echo $departemen ? $departemen->nama : 'Data departemen tidak ditemukan';
                                                }
                                                else if ($column == 'id_jabatan')
                                                {
                                                    $jabatan = $this->jabatan_m->get_row(['id_jabatan' => $data[$column]]);
                                                    echo $jabatan ? $jabatan->nama : 'Data jabatan tidak ditemukan';
                                                }
                                                else
                                                {
                                                    echo $data[$column];
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Bordered Table -->
    </div>
</section>