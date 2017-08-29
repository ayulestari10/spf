<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Input Kriteria Penilaian </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?= form_open('') ?>
                <div class="row" style="margin-top: 5%;">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="form-group">
                            <label>Departemen</label>
                            <select class="form-control show-tick" name="">
                                <option>-- Pilih --</option>
                                <option value="Contoh">Contoh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="form-control show-tick" name="">
                                <option>-- Pilih --</option>
                                <option value="Contoh">Contoh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kriteria</label>
                            <select class="form-control show-tick" name="">
                                <option>-- Pilih --</option>
                                <option value="Contoh">Contoh</option>
                            </select>
                        </div>
                        <button class="btn btn-primary"> Tambah Subkriteria Penilaian</button>
                    </div>
                </div>
                <div class="row" style="margin-top: 2%;">
                    <div class="col-md-3 col-md-offset-1">
                        <div class="form-group">
                            <label>Nama Subkriteria</label>
                            <input type="text" name="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Standar Nilai</label>
                            <input type="text" name="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Kelompok Nilai</label>
                            <select class="form-control show-tick" name="">
                                <option>-- Pilih --</option>
                                <option value="Contoh">Contoh</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-3 col-md-offset-1">
                       <input type="submit" name="" class="btn btn-success" value="Submit">
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
</script>