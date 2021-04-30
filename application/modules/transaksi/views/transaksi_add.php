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
                            <div class="form-group <?php if(form_error('barcode')) echo 'has-error'?> ">
                                <input type="text" class="form-control barcode" name="barcode" id="barcode" placeholder="Barcode" value="" autofocus="" autocomplete="off" />
                                <?php echo form_error('barcode', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('barcode')) echo 'has-error'?> ">
                                <input readonly="" type="text" class="form-control nama_siswa" name="barcode" id="barcode" placeholder="Nama Siswa" value="" autofocus="" autocomplete="off" />
                                <?php echo form_error('barcode', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('barcode')) echo 'has-error'?> ">
                                <input readonly="" type="text" class="form-control nama_kelas" name="barcode" id="barcode" placeholder="Kelas" value="" autofocus="" autocomplete="off" />
                                <?php echo form_error('barcode', '<small style="color:red">','</small>') ?>
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

<script>

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