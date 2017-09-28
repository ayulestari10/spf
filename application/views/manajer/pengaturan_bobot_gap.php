<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Input Penilaian </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php  
                $msg = $this->session->flashdata('msg');
                if (isset($msg)) echo $msg;
            ?>
            <?= form_open('manajer/bobot-gap') ?>
                
                <div id="form-container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-1">
                            <button type="button" class="btn btn-primary" onclick="addFormInput(); return false;"> Tambah Bobot GAP</button>
                        </div>
                    </div>
                    <?php foreach ($bobot_gap as $row): ?>
                    <div class="row" style="margin-top: 2%;">
                        <input type="hidden" name="id_bobot[]" value="<?= $row->id_bobot ?>">
                        <div class="col-md-4 col-md-offset-1">
                            <div class="form-group">
                                <label>Selisih</label>
                                <input type="number" name="selisih[]" class="form-control" value="<?= $row->selisih ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bobot Nilai</label>
                                <input type="number" name="bobot_nilai[]" step="0.1" class="form-control" value="<?= $row->bobot_nilai ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan[]"><?= $row->keterangan ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="row" style="margin-top: 2%;">
                        <div class="col-md-4 col-md-offset-1">
                            <div class="form-group">
                                <label>Selisih</label>
                                <input type="number" name="selisih[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bobot Nilai</label>
                                <input type="number" name="bobot_nilai[]" step="0.1" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan[]"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
                    </div>
                </div>
                <!-- /.row -->
            </form>        
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