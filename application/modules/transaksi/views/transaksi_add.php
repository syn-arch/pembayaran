<style>
    .pembayaran-item {
        display:block;
        height:100px;
        overflow:auto;
    }
    .thead-item, .pembayaran-item tr {
        display:table;
        width:100%;
        table-layout:fixed;/* even columns width , fix width of table too*/
    }
    thead {
        width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
    }
    table {
        width:400px;
    }
</style>
<div class="row">
    <div class="col-xs-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4>Data Siswa</h4>
                    </div>
                </div>
                <div class="pull-right">
                    <h4><?php echo faktur() ?></h4>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?php echo base_url('transaksi/create_action') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="nis" class="nis">
                            <input type="hidden" name="no_faktur" value="<?php echo faktur() ?>">
                            <div class="form-group">
                                <div class="input-group input-group">
                                    <input type="text" class="form-control barcode" name="barcode" placeholder="Barcode Siswa" autocomplete="off">
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#data-siswa" class="btn btn-info btn-flat"><i class="fa fa-user"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('nama_siswa')) echo 'has-error'?> ">
                                <input readonly="" type="text" class="form-control nama_siswa" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" value="" autofocus="" autocomplete="off" />
                                <?php echo form_error('nama_siswa', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('kelas')) echo 'has-error'?> ">
                                <input readonly="" type="text" class="form-control nama_kelas" name="kelas" id="kelas" placeholder="Kelas" value="" autofocus="" autocomplete="off" />
                                <?php echo form_error('kelas', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-item">
                                        <tr>
                                            <th>No</th>
                                            <th>Pembayaran</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="pembayaran-item"></tbody>
                                </table>
                            </div>
                            <table class="table">
                                <tr>
                                    <th>Total</th>
                                    <td><input readonly="" type="text" class="form-control total" name="total" id="total" placeholder="Total" value="" autofocus="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <th>Telah Dibayar</th>
                                    <td><input readonly="" type="text" class="form-control telah_dibayar" name="telah_dibayar" id="telah_dibayar" placeholder="Telah Dibayar" value="" autofocus="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <th>Cash</th>
                                    <td><input required="" type="text" class="form-control cash" name="jumlah_dibayar" id="cash" placeholder="Cash" value="" autofocus="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <th>Sisa Bayar</th>
                                    <td><input readonly="" type="text" class="form-control kembalian" name="kembalian" id="kembalian" placeholder="Kembalian" value="" autofocus="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <th>Bukti Pembayaran</th>
                                    <td><input type="file" class="form-control bukti" name="bukti" id="bukti" placeholder="Kembalian" value="" autofocus="" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><button type="submit" class="btn btn-primary btn-block">Submit</button></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </div>
    <div class="col-xs-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4>Data Pembayaran</h4>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pembayaran</th>
                                        <th>Nominal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="list-pembayaran">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="data-siswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLongTitle">Data siswa</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dt" width="100%" id="#mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Tgl Lahir</th>
                                <th>Jk</th>
                                <th>Tahun Ajaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    base_url = $('meta[name="base_url"]').attr("content");

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
        ajax: {"url": base_url + "siswa/json", "type": "POST"},
        columns: [
        {"data": "id_siswa"},
        {"data": "barcode"},
        {"data": "nis"},
        {"data": "nama_siswa"},
        {"data": "nama_kelas"},
        {"data": "tgl_lahir"},
        {"data": "jk"},
        {"data": "tahun_ajaran"},
        {
            "data" : "aksi",
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

    function rupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    $(document).on('click', '.pilih_siswa', function(){
        const barcode = $(this).data('barcode');

        $('.barcode').val(barcode)

        $.get(`${base_url}siswa/get_siswa/${barcode}`, function(res){

            if (res == 'error') {
                swal({
                  title : "Error",
                  text : "Siswa Tidak Ditemukan",
                  icon : "error"
              })
                $('.barcode').val('')
                $('.barcode').focus()
                return
            }

            const data = JSON.parse(res)
            $('.nama_kelas').val(data.nama_kelas)
            $('.nama_siswa').val(data.nama_siswa)
            $('.nis').val(data.nis)
        });

        $.get(`${base_url}pembayaran/get_kategori_siswa_json/${barcode}`, function(res){
            const data = JSON.parse(res)

            if (data.length < 1) {
                $('.nama_kelas').val('')
                $('.nama_siswa').val('')
                $('.nis').val('')
                $('.list-pembayaran').html('')
                $('.list-pembayaran').append(`
                    <tr>
                    <td colspan="4" class="text-center">Data Pembayaran Tidak Ditemukan</td>
                    </tr>
                    `);
                return
            }

            let num = 1;
            data.map(function (row) {
                $('.list-pembayaran').html('')
                $('.list-pembayaran').append(`
                    <tr>
                    <td>${num++}</td>
                    <td>${row.nama_kategori}</td>
                    <td>${rupiah(row.nominal, 'Rp')}</td>
                    <td>
                    <a class="btn btn-primary btn-tambah" data-id="${row.id_pembayaran}"><i class="fas fa-plus"></i></a>
                    </td>
                    </tr>
                    `);
            })
        });

        $('#data-siswa').modal('hide')
    })

    $('.barcode').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault()
            const base_url = $('meta[name="base_url"]').attr('content');
            const barcode = $(this).val();

            $.get(`${base_url}siswa/get_siswa/${barcode}`, function(res){

                if (res == 'error') {
                    swal({
                      title : "Error",
                      text : "Siswa Tidak Ditemukan",
                      icon : "error"
                  })
                    $('.barcode').val('')
                    $('.barcode').focus()
                    return
                }

                const data = JSON.parse(res)
                $('.nama_kelas').val(data.nama_kelas)
                $('.nama_siswa').val(data.nama_siswa)
                $('.nis').val(data.nis)
            });

            $.get(`${base_url}pembayaran/get_kategori_siswa_json/${barcode}`, function(res){
                const data = JSON.parse(res)

                if (data.length < 1) {
                    $('.nama_kelas').val('')
                    $('.nama_siswa').val('')
                    $('.nis').val('')
                    $('.list-pembayaran').html('')
                    $('.list-pembayaran').append(`
                        <tr>
                        <td colspan="4" class="text-center">Data Pembayaran Tidak Ditemukan</td>
                        </tr>
                        `);
                    return
                }

                let num = 1;
                data.map(function (row) {
                    $('.list-pembayaran').html('')
                    $('.list-pembayaran').append(`
                        <tr>
                        <td>${num++}</td>
                        <td>${row.nama_kategori}</td>
                        <td>${rupiah(row.nominal, 'Rp')}</td>
                        <td>
                        <a class="btn btn-primary btn-tambah" data-id="${row.id_pembayaran}"><i class="fas fa-plus"></i></a>
                        </td>
                        </tr>
                        `);
                })
            });

        }
    });

    $(document).on('click', '.btn-tambah', function(){
        const id = $(this).data('id')

        table = $('.pembayaran-item').html()

        if(table){
            swal({
              title : "Error",
              text : "Pembayaran Telah Ditambahkan",
              icon : "error"
          })
            return
        }

        $.get(`${base_url}pembayaran/get_by_id/${id}`, function(res){
            const data = JSON.parse(res)
            let num = 1;
            $('.pembayaran-item').append(`
                <tr>
                <input type="hidden" name="id_pembayaran" value="${data.id_pembayaran}">
                <td>${num++}</td>
                <td>${data.nama_kategori}</td>
                <td>${rupiah(data.nominal, 'Rp')}</td>
                <td>
                <a class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></a>
                </td>
                </tr>
                `);
            $('.total').val(data.nominal)

            const nis = $('.nis').val()

            $.get(`${base_url}transaksi/get_telah_dibayar/${nis}/${id}`, function(res){
                $('.telah_dibayar').val(parseInt(res) || 0)
            });
        });
    });

    $(document).on('click', '.btn-hapus', function(){
        $(this).closest('tr').remove()
    });

    $('.cash').keyup(function(){
        let cash = $(this).val()
        const total = $('.total').val()
        const telah_dibayar = $('.telah_dibayar').val()

        $('.kembalian').val((parseInt(telah_dibayar) + parseInt(cash)) - parseInt(total))
    })

</script>