
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="#import-siswa" data-toggle="modal" class="btn btn-info"><i class="fas fa-sign-out-alt"></i> Import Excel</a>
                        <?php echo anchor(site_url('siswa/create'), '<i class="fas fa-plus"></i> Tambah Data', 'class="btn btn-primary"'); ?>
                        <?php echo anchor(site_url('siswa/excel'), '<i class="fas fa-sign-out-alt"></i> Excel', 'class="btn btn-success"'); ?>
                        <?php echo anchor(site_url('siswa/word'), '<i class="fas fa-sign-out-alt"></i> Word', 'class="btn btn-warning"'); ?>

                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dt" width="100%" id="#mytable">
                       <thead>
                        <tr>
                            <th>No</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Nis</th>
                            <th>Nama Siswa</th>
                            <th>Tgl Lahir</th>
                            <th>Jk</th>
                            <th>Tahun Ajaran</th>
                            <th>Email</th>
                            <th>Aktif</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="import-siswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="exampleModalLongTitle">Import siswa</h4>
  </div>
  <div class="modal-body">
    <strong>Cara import</strong>
    <p>Download template dibawah ini kemudian isi dengan data siswa, kemudian import kembali pada form dibawah ini</p>
    <a href="<?php echo base_url('siswa/template') ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Template</a>
    <hr>
    <form action="<?php echo base_url('siswa/import') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group <?php if(form_error('excel')) echo 'has-error'?>">
            <label for="excel">File Excel</label>
            <input required="" type="file" id="excel" name="excel" class="form-control excel " placeholder="File Excel" value="<?php echo set_value('excel') ?>">
            <?php echo form_error('excel', '<small style="color:red">','</small>') ?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
    <div class="modal-footer">
    </form>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $(".dt").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "siswa/json", "type": "POST"},
            columns: [
            {
                "data": "id_siswa",
                "orderable": false
            },
            {"data": "nama_jurusan"},
            {"data": "nama_kelas"},
            {"data": "nis"},
            {"data": "nama_siswa"},
            {"data": "tgl_lahir"},
            {"data": "jk"},
            {"data": "tahun_ajaran"},
            {"data": "email"},
            {
                "data": "aktif",
                render : function(data,type,row){
                    if(data == '1'){
                        return 'aktif'
                    }else{
                        return 'tidak aktif'
                    }
                }
            },
            {
                "data" : "action",
                "orderable": false,
                "className" : "text-center"
            }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        $(document).on("click", ".hapus-data", function () {
          hapus($(this).data("href"));
      });

    });

</script>