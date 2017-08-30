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
                                    <tr>
                                        <td>09021181520021</td>
                                        <td>Ayu Lestari</td>
                                        <td>Finance</td>
                                        <td>Sekretaris</td>
                                        <td>Valid</td>
                                        <td align="center">
                                            <button class="btn btn-success" onclick="">Valid</button>
                                            <a href="<?= base_url('manajer/penilaian_detail/') ?>" class="btn btn-info waves-effect">Details</a>
                                        </td>
                                    </tr>
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
</script>