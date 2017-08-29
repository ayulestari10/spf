<section class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Input Penilaian </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?= form_open('') ?>
                <div class="row" style="margin-top: 5%;">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="form-group">
                            <label>Standard Requirement</label>
                            <input type="text" name="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Penilaian</label>
                            <input type="text" name="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tahun Penilaian</label>
                            <input type="text" name="" class="form-control">
                        </div>
                        <button class="btn btn-primary"> Tambah Bobot GAP</button>
                    </div>
                </div>
                <div class="row" style="margin-top: 2%;">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="form-group">
                            <label>Selisih</label>
                            <input type="text" name="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bobot Nilai</label>
                            <input type="text" name="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name=""></textarea>
                        </div>
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