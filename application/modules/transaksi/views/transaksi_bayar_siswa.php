<style type="text/css">
    td {
        padding: 10px;
    }
</style>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <img style="margin-right: 20px" src="<?php echo base_url('assets/img/logo.png') ?>" alt="" class="img-responsive pull-left" width="100">
            <h3>SMK BUDI BAKTI CIWIDEY</h3>
            <h5>Jl. Babakan Tiga No.82 Kec.Ciwidey Kab.Bandung</h5>
            <br>
            <hr>
        </div>
        <!-- /.col -->
    </div>

    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">

            <table>
                <tr>
                    <th>No Faktur</th>
                    <td><?php echo faktur() ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?php echo date('Y-m-d H:i:s') ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?php echo $siswa->nama_siswa ?></td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td><?php echo $siswa->nama_jurusan ?></td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td><?php echo $siswa->nama_kelas ?></td>
                </tr>
                <tr>
                    <th>Tahun Ajaran</th>
                    <td><?php echo $siswa->tahun_ajaran ?></td>
                </tr>
            </table>

        </div>
        <div class="col-sm-3 invoice-col">
            <table>
                <tr>
                    <th>Nama Pembayaran</th>
                    <td><?php echo $pembayaran->nama_kategori ?></td>
                </tr>
                <tr>
                    <th>Jumlah Pembayaran</th>
                    <td><?php echo "Rp. " . number_format($pembayaran->nominal) ?></td>
                </tr>
                <tr>
                    <th>Telah Dibayar</th>
                    <td><?php echo "Rp. " . number_format($telah_dibayar) ?></td>
                </tr>
                <tr>
                    <th>Sisa Pembayaran</th>
                    <td><?php echo "Rp. " . number_format($pembayaran->nominal - $telah_dibayar) ?></td>
                </tr>
                <tr>
                    <th>Status</th>

                    <?php if ($telah_dibayar >= $pembayaran->nominal): ?>
                        <td>LUNAS</td>
                        <?php else: ?>
                            <td>BELUM LUNAS</td>
                        <?php endif ?>

                    </tr>
                </table>
            </div>
            <?php if ($telah_dibayar < $pembayaran->nominal): ?>
                <div class="col-sm-5 invoice-col">
                    <form action="<?php echo base_url('transaksi/create_action/true') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="jumlah_bayar" value="<?php echo $pembayaran->nominal ?>">
                        <input type="hidden" class="telah_dibayar" value="<?php echo $telah_dibayar ?>">
                        <input type="hidden" name="id_pembayaran" value="<?php echo $this->uri->segment(4) ?>">
                        <input type="hidden" name="nis" value="<?php echo $this->uri->segment(3) ?>">
                        <input type="hidden" name="no_faktur" value="<?php echo faktur() ?>">
                        <table>
                            <tr>
                                <th>Jumlah Dibayar</th>
                                <td><input type="number" placeholder="Jumlah Dibayar" class="form-control jumlah_dibayar" name="jumlah_dibayar" autocomplete="off" required=""></td>
                            </tr>
                            <tr>
                                <th>Sisa Bayar</th>
                                <td><input readonly="" type="text" placeholder="Sisa Bayar" class="form-control sisa_bayar" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Bukti Pembayaran</th>
                                <td><input type="file" placeholder="Bukti Pembayaran" class="form-control" name="bukti" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="btn btn-primary btn-block">Submit</button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><a href="<?php echo base_url('transaksi/create_siswa') ?>" class="btn btn-success btn-block">Kembali</a></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <?php else: ?>
                    <div class="col-sm-5 invoice-col">
                        <table>

                            <tr>
                                <td></td>
                                <td><a href="<?php echo base_url('transaksi/create_siswa') ?>" class="btn btn-success btn-block">Kembali</a></td>
                            </tr>
                        </table>
                    </div>
                <?php endif ?>
            </div>
            <hr>
            <!-- /.row -->
        </section>

        <script>
            function toRupiah(angka = '0', idr = false) {
                var rupiah = '';
                if (angka == null) {
                    angka = '0';
                }
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++) if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
                    if (idr == true) {
                        return rupiah.split('', rupiah.length - 1).reverse().join('');
                    } else {
                        return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
                    }
                }

                $('.jumlah_dibayar').keyup(function(){
                    jumlah_bayar = $('.jumlah_bayar').val()
                    telah_dibayar = $('.telah_dibayar').val() || 0

                    sisa_bayar = parseInt(jumlah_bayar) - (parseInt($(this).val()) + parseInt(telah_dibayar))
                    $('.sisa_bayar').val(toRupiah(sisa_bayar, true))

                })
            </script>