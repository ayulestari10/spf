<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Karyawan </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data  Karyawan                                                             <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
                                                    </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <style type="text/css">
                                tr th, tr td {text-align: center;}
                            </style>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <?php foreach ($columns as $column): ?>
                                            <th>
                                                <?php  
                                                    if ($column == 'id_jabatan')
                                                    {
                                                        echo 'Jabatan';
                                                    }
                                                    else if ($column == 'id_departemen')
                                                    {
                                                        echo 'Departemen';
                                                    }
                                                    else
                                                    {
                                                        echo ucwords(str_replace("_", " ", $column));    
                                                    }
                                                ?>
                                            </th>
                                        <?php endforeach; ?>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $row): ?>
                                    <tr>
                                        <?php foreach ($columns as $column): ?>
                                            <td>
                                                <?php $row = (array)$row; ?>
                                                <?php
                                                    if ($column == 'id_jabatan')
                                                    {
                                                        $jabatan = $this->jabatan_m->get_row(['id_jabatan' => $row[$column]]);
                                                        echo $jabatan ? $jabatan->nama : 'Data jabatan tidak ditemukan';
                                                    }
                                                    else if ($column == 'id_departemen')
                                                    {
                                                        $departemen = $this->departemen_m->get_row(['id_departemen' => $row[$column]]);
                                                        echo $departemen ? $departemen->nama : 'Data departemen tidak ditemukan';
                                                    }
                                                    else
                                                    {
                                                        echo $row[$column];
                                                    } 
                                                ?>
                                            </td>
                                        <?php endforeach; ?>
                                        <td align="center">

                                                                                <a href="<?= base_url('karyawan/detail-karyawan/'.$row['id_karyawan']) ?>" class="btn btn-info waves-effect">Details</a>
                                        
                                                                                <button class="btn btn-info waves-effect" data-toggle="modal" data-target="#edit" onclick="get_karyawan(<?= $row['id_karyawan'] ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                                        
                                                                                <button class="btn btn-danger waves-effect" onclick="delete_karyawan(<?= $row['id_karyawan'] ?>)"><i class="glyphicon glyphicon-trash"></i> </button>
                                        
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

            
        <!-- Add -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog" role="document">
            <?= form_open("karyawan/karyawan") ?>
           <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Karyawan</h4>
              </div>
              <div class="modal-body">
                    <?php foreach ($columns as $column): ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>
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
                                            echo ucwords(str_replace('_', ' ', $column));
                                        }
                                    ?>
                                </label>
                                <?php if ($column == 'id_departemen'): ?>
                                    <select class="form-control" name="id_departemen" id="id_departemen">
                                    <?php foreach ($departemen_all as $d): ?>
                                            <option value="<?= $d->id_departemen ?>"><?= $d->nama ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                <?php elseif ($column == 'id_jabatan'): ?>
                                    <select class="form-control" name="id_jabatan" id="id_jabatan">
                                    <?php foreach ($jabatan_all as $j): ?>
                                        <option value="<?= $j->id_jabatan ?>"><?= $j->nama ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                <?php else: ?>
                                <input type="text" id="<?= $column ?>" name="<?= $column ?>" class="form-control">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>Agama</label>
                                <input type="text" id="agama" name="agama" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>Pendidikan</label>
                                <input type="text" id="pendidikan" name="pendidikan" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>Username</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default m-t-15 waves-effect" data-dismiss="modal">Batal</button>
                <input type="submit" name="insert" value="Simpan" class="btn btn-primary m-t-15 waves-effect">
              </div>
              <?= form_close() ?>            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--/End Add -->

        
                <!-- Edit -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <?= form_open("karyawan/karyawan") ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Karyawan</h4>
              </div>
              <div class="modal-body">
                    <input type="hidden" name="edit_id_karyawan" id="edit_id_karyawan">
                    <?php foreach ($columns as $column): ?>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label>
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
                                        echo ucwords(str_replace('_', ' ', $column));
                                    }
                                ?>
                            </label>
                            <?php if ($column == 'id_departemen'): ?>
                                <div id="departemen-plc"></div>
                            <?php elseif ($column == 'id_jabatan'): ?>
                                <div id="jabatan-plc"></div>
                            <?php else: ?>
                            <input type="text" id="edit_<?= $column ?>" name="<?= $column ?>" class="form-control">
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" name="edit" value="Edit" class="btn btn-primary">
              </div>
              <?= form_close() ?>            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  
        <!--/End Edit -->
        
    </div>
</section>

<script type="text/javascript">

        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        
        function get_karyawan(id_karyawan) {
            $.ajax({
                url: "<?= base_url('karyawan/karyawan') ?>",
                type: 'POST',
                data: {
                    id_karyawan: id_karyawan,
                    get: true
                },
                success: function(response) {
                    console.log(response);
                    response = JSON.parse(response);
                    <?php foreach ($columns as $column): ?>
                    $('#edit_<?= $column ?>').val(response.<?= $column ?>);
                    <?php endforeach; ?>
                    <?php if (in_array("id_karyawan", $columns)): ?>                    
                    $('input[class="form-control"][name="id_karyawan"]').val(response.id_karyawan);
                    <?php endif; ?>       
                    $('#departemen-plc').html(response.departemen);
                    $('#jabatan-plc').html(response.jabatan);     
                }
            });
        }
        
        
        function delete_karyawan(id_karyawan) {
            $.ajax({
                url: "<?= base_url('karyawan/karyawan') ?>",
                type: 'POST',
                data: {
                    id_karyawan: id_karyawan,
                    delete: true
                },
                success: function() {
                    window.location = "<?= base_url('karyawan/Karyawan') ?>";
                }
            });   
        }
        </script>