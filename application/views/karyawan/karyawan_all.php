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
                            Data  Karyawan
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

                                                                                <a href="<?= base_url('karyawan/detail_karyawan/'.$row['id_karyawan']) ?>" class="btn btn-info waves-effect">Details</a>
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

        
        function get_karyawan(id_karyawan) {
            $.ajax({
                url: "<?= base_url('admin/Karyawan') ?>",
                type: 'POST',
                data: {
                    id_karyawan: id_karyawan,
                    get: true
                },
                success: function(response) {
                    response = JSON.parse(response);
                    <?php foreach ($columns as $column): ?>
                    $('#edit_<?= $column ?>').val(response.<?= $column ?>);
                    <?php endforeach; ?>
                    <?php if (in_array("id_karyawan", $columns)): ?>                    
                    $('input[class="form-control"][name="id_karyawan"]').val(response.id_karyawan);
                    <?php endif; ?>                }
            });
        }
        </script>