<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Subkriteria </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data  Subkriteria                                                             <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
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
                                                <?= ucwords(str_replace("_", " ", $column)) ?>
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
                                                <?= $row[$column] ?>
                                            </td>
                                        <?php endforeach; ?>
                                        <td align="center">

                                                                                <a href="<?= base_url('admin/detail_subkriteria/'.$row['id_subkriteria']) ?>" class="btn btn-info waves-effect">Details</a>
                                        
                                                                                <button class="btn btn-info waves-effect" data-toggle="modal" data-target="#edit" onclick="get_subkriteria(<?= $row['id_subkriteria'] ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                                        
                                                                                <button class="btn btn-danger waves-effect" onclick="delete_subkriteria(<?= $row['id_subkriteria'] ?>)"><i class="glyphicon glyphicon-trash"></i> </button>
                                        
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
            <?= form_open("admin/subkriteria") ?>
           <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Subkriteria</h4>
              </div>
              <div class="modal-body">
                    <?php foreach ($columns as $column): ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label><?= ucwords(str_replace('_', ' ', $column)) ?></label>
                                <input type="text" id="<?= $column ?>" name="<?= $column ?>" class="form-control">
                            </div>
                        </div>
                    <?php endforeach; ?>
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
            <?= form_open("admin/subkriteria") ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Subkriteria</h4>
              </div>
              <div class="modal-body">
                    <input type="hidden" name="edit_id_subkriteria" id="edit_id_subkriteria">
                    <?php foreach ($columns as $column): ?>
                        <div class="form-group form-float">
                            <div class="form-line focused">
                                <label><?= ucwords(str_replace('_', ' ', $column)) ?></label>
                                <input type="text" id="edit_<?= $column ?>" name="<?= $column ?>" class="form-control">
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

        
        function get_subkriteria(id_subkriteria) {
            $.ajax({
                url: "<?= base_url('admin/Subkriteria') ?>",
                type: 'POST',
                data: {
                    id_subkriteria: id_subkriteria,
                    get: true
                },
                success: function(response) {
                    response = JSON.parse(response);
                    <?php foreach ($columns as $column): ?>
                    $('#edit_<?= $column ?>').val(response.<?= $column ?>);
                    <?php endforeach; ?>
                    <?php if (in_array("id_subkriteria", $columns)): ?>                    
                    $('input[class="form-control"][name="id_subkriteria"]').val(response.id_subkriteria);
                    <?php endif; ?>                }
            });
        }
        
        
        function delete_subkriteria(id_subkriteria) {
            $.ajax({
                url: "<?= base_url('admin/Subkriteria') ?>",
                type: 'POST',
                data: {
                    id_subkriteria: id_subkriteria,
                    delete: true
                },
                success: function() {
                    window.location = "<?= base_url('admin/Subkriteria') ?>";
                }
            });   
        }
        </script>