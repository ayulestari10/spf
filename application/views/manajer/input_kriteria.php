<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Input Kriteria Penilaian </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php  
                $msg = $this->session->flashdata('msg');
                if (isset($msg)) echo $msg;
            ?>
            <?= form_open('manajer/input-kriteria') ?>
                <div class="row" style="margin-top: 5%;">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="form-group">
                            <label>Departemen</label>
                            <select onchange="getJabatan(this.value);" required class="form-control show-tick" name="id_departemen">
                                <option>-- Pilih --</option>
                                <?php foreach ($departemen as $row): ?>
                                    <option value="<?= $row->id_departemen ?>"><?= $row->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="form-control show-tick" disabled required name="id_jabatan" id="id_jabatan">
                                <option>-- Pilih --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kriteria</label>
                            <select class="form-control show-tick" required name="id_jenis_kriteria">
                                <option>-- Pilih --</option>
                                <?php foreach ($jenis_kriteria as $row): ?>
                                    <option value="<?= $row->id_jenis_kriteria ?>"><?= $row->nama_kriteria ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addFormInput(); return false;"> Tambah Subkriteria Penilaian</button>
                    </div>
                </div>
                <div id="form-container">
                    <div class="row" style="margin-top: 2%;">
                        <div class="col-md-3 col-md-offset-1">
                            <div class="form-group">
                                <label>Nama Subkriteria</label>
                                <input type="text" name="nama[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Standar Nilai</label>
                                <input type="number" name="standar_nilai[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Kelompok Nilai</label>
                                <select class="form-control show-tick" name="id_kelompok_nilai[]">
                                    <option>-- Pilih --</option>
                                    <?php foreach ($kelompok_nilai as $row): ?>
                                        <option value="<?= $row->id_kelompok_nilai ?>"><?= $row->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-3 col-md-offset-1">
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

        function getJabatan(id_departemen) {
            $.ajax({
                url: '<?= base_url('manajer/input-kriteria?action=get_jabatan&id_departemen=') ?>' + id_departemen,
                type: 'GET',
                success: function(response) {
                    var json = $.parseJSON(response);
                    var html = '<option>-- Pilih --</option>';
                    for (var i = 0; i < json.length; i++) {
                        html += '<option value="' + json[i].id_jabatan + '">' + json[i].nama + '</option>';
                    }
                    $('#id_jabatan').html(html).prop('disabled', false);
                    if (json.length <= 0) {
                        $('#id_jabatan').prop('disabled', true);
                    }
                }
            });

            return false;
        }

        function addFormInput() {
            $.ajax({
                url: '<?= base_url('manajer/input-kriteria?action=get_kelompok_nilai') ?>',
                type: 'GET',
                async: false,
                success: function(response) {
                    var json = $.parseJSON(response);
                    var html = '<option>-- Pilih --</option>';
                    for (var i = 0; i < json.length; i++) {
                        html += '<option value="' + json[i].id_kelompok_nilai + '">' + json[i].nama + '</option>';
                    }

                    $('#form-container').append('<div class="row" style="margin-top: 2%;">' +
                        '<div class="col-md-3 col-md-offset-1">' +
                            '<div class="form-group">' +
                                '<label>Nama Subkriteria</label>' +
                                '<input type="text" name="nama[]" class="form-control">' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-3">' +
                            '<div class="form-group">' +
                                '<label>Standar Nilai</label>' +
                                '<input type="number" name="standar_nilai[]" class="form-control">' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<div class="form-group">' +
                                '<label>Kelompok Nilai</label>' +
                                '<select class="form-control show-tick" name="id_kelompok_nilai[]">' +
                                    html +
                                '</select>' +
                            '</div>' +
                        '</div>' +
                    '</div>');
                }
            });

            return false;
        }
</script>