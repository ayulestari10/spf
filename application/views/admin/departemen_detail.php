<section class="content">
    <div class="container-fluid">
<!-- Bordered Table -->
        <div class="row ">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <div class="card">
                    <div class="header">
                        <h2>
                            Detail Departemen                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <?php foreach ($columns as $column): ?>
                                    <tr>
                                        <td><?= ucwords(str_replace("_", " ", $column)); ?></td>
                                        <td>
                                            <?php $data = (array)$data; ?>
                                            <?= $data[$column] ?>
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