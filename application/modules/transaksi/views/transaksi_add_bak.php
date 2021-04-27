<?php if (!$this->input->get('nis')): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="pull-left">
                        <div class="box-title">
                            <h4><?php echo $judul ?></h4>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <form>
                                <div class="form-group <?php if(form_error('nis')) echo 'has-error'?> ">
                                    <label for="int">Cari Siswa</label>
                                    <select name="nis" id="nis" class="carisiswa form-control">
                                        <option value="" selected="">-- Cari Siswa --</option>
                                    </select>
                                    <?php echo form_error('nis', '<small style="color:red">','</small>') ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="pull-left">
                        <div class="box-title">
                            <h4><?php echo "Transaksi Terakhir" ?></h4>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dt" width="100%" id="#mytable">
                           <thead>
                            <tr>
                                <th>No</th>
                                <th>Faktur</th>
                                <th>Kategori</th>
                                <th>Nis</th>
                                <th>Siswa</th>
                                <th>Tgl</th>
                                <th>Tahun Dibayar</th>
                                <th>Jumlah Dibayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                    </table>
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
                paging :false,
                searching :false,
                processing: true,
                serverSide: true,
                ajax: {"url": "transaksi/lastjson", "type": "POST"},
                columns: [
                {
                    "data": "id_transaksi",
                    "orderable": false
                },
                {"data": "no_faktur"},
                {"data": "nama_kategori"},
                {"data": "nis"},
                {"data": "nama_siswa"},
                {"data": "tgl"},
                {"data": "tahun_dibayar"},
                {
                    "data": "jumlah_dibayar",
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    "data": "status",
                    render : function(data, type, row){
                        if(data == 'diterima'){
                            return '<button class="btn btn-success">DITERIMA</button>'
                        }else if(data == 'pending'){
                            return '<button class="btn btn-warning">PENDING</button>'
                        }else{
                            return '<button class="btn btn-danger">DITOLAK</button>'
                        }
                    }
                },
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

    <?php else : ?>
        <div class="row">

            <?php if ($kategori): ?>
                <?php foreach ($kategori as $row): ?>
                    <div class="col-xs-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div class="pull-left">
                                    <div class="box-title">
                                        <h2><?php echo $row->nama_kategori ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                   <div class="col-md-12">
                                    <h1 class="text-right">Rp. <?php echo number_format($row->nominal) ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="<?php echo base_url('transaksi/bayar/') . $this->input->get('nis') . '/' . $row->id_pembayaran ?>" class="btn btn-primary btn-block"><i  class="fa fa-credit-card"></i> BAYAR</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

            <?php else: ?>

                <div class="container">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>Perhatian</strong>
                                <p>Data Pembayaran Tidak Ditemukan</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    <?php endif ?>
