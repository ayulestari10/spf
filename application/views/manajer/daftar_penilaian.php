<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Daftar Penilaian </h1>
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
                            Daftar  Penilaian                                                             
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <style type="text/css">
                                tr th, tr td {text-align: center;}
                            </style>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <!-- <th>Standard Requirement</th> -->
                                        <th>Tanggal Penilaian</th>
                                        <th>Tahun Penilaian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penilaian as $row): ?>
                                    <tr>
                                        <!-- <td><?= $row->standar_requirement ?></td> -->
                                        <td><?= $row->tgl_penilaian ?></td>
                                        <td><?= $row->thn_penilaian ?></td>
                                        <td align="center">
                                            <a href="<?= base_url((($id_jabatan == 2) ? 'manajer' : ($id_jabatan == 3 ? 'direktur' : 'karyawan')) . '/penilaian-detail?id_penilaian=' . $row->id_penilaian) ?>" class="btn btn-primary waves-effect"><i class="fa fa-eye"></i> View</a>
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
</script>