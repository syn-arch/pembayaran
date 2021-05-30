
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url() ?>vendor/lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <title>Faktur <?php echo $data->no_faktur ?></title>
</head>
<body>


    <style type="text/css">
        td {
            padding: 5px;
        }
    </style>

    <section class="container">
        <div class="row">
            <div class="col-xs-12">
                <img style="margin-right: 40px" src="<?php echo base_url() ?>assets/img/logo.png" alt="" class="img-responsive pull-left" width="100">
                <div class="ml-4">
                    <h3><strong>SMK BUDI BAKTI CIWIDEY</strong></h3>
                    <h5>Jl. Babakan Tiga No.82 Kec.Ciwidey Kab.Bandung</h5>
                    <h5>Telp : 6283822623170 |  E-mail : smkbbc.sch.id@info | Website : www.smkbbc.sch.id</h5>
                </div>

                <hr style="height: 2px; background: black">
                <h4 class="text-center"><strong>BUKTI PEMBAYARAN SISWA</strong></h4>
                <hr style="height: 2px; background: black">

            </div>
            <!-- /.col -->
        </div>

        <div class="row invoice-info">
            <div class="col-xs-4">
                <table>
                    <tr>
                        <th>NO FAKTUR</th>
                        <td><?php echo $data->no_faktur ?></td>
                    </tr>
                    <tr>
                        <th>TANGGAL</th>
                        <td><?php echo $data->tgl ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <?php if ($telah_dibayar >= $data->nominal): ?>
                            <td>LUNAS</td>
                            <?php else: ?>
                                <td>BELUM LUNAS</td>
                            <?php endif ?>

                        </tr>
                    </tr>
                </table>
            </div>
            <div class="col-xs-3"></div>
            <div class="col-xs-4">
                <table>
                    <tr>
                        <th>NIS</th>
                        <td><?php echo $data->nis ?></td>
                    </tr>
                    <tr>
                        <th>NAMA SISWA</th>
                        <td><?php echo $data->nama_siswa ?></td>
                    </tr>
                    <tr>
                        <th>JURUSAN</th>
                        <td><?php echo $data->nama_jurusan ?></td>
                    </tr>
                    <tr>
                        <th>KELAS</th>
                        <td><?php echo $data->nama_kelas ?></td>
                    </tr>
                </table>

            </div>
        </div>

        <hr style="height: 2px; background: black">

        <div class="row">
            <div class="col-xs-12">
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th width="70%">PEMBAYARAN</th>
                            <th class="text-right">JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <h4> 1. </h4></td>
                            <td> <h4> <?php echo $data->nama_kategori ?> </h4></td>
                            <td class="text-right"> <h4> <?php echo "Rp. " . number_format($data->jumlah_dibayar) ?> </h4></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr style="height: 2px; background: black">

        <div class="row">
            <div class="col-md-6">
                <h4><strong>TERBILANG :</strong></h4>
                <h4><i><?php echo terbilang($data->jumlah_dibayar) . ' rupiah' ?></i></h4>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
            <a href="<?php echo base_url('transaksi/invoice/' . $data->id_transaksi) ?>" class="btn btn-block btn-primary">CETAK</a>
            <a href="<?php echo base_url('transaksi') ?>" class="btn btn-block btn-success">KEMBALI</a>
        </div>
    </div>
    </section>
</body>
</html>