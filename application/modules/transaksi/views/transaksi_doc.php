<!doctype html>
<html>
<head>
    <title>harviacode.com - codeigniter crud generator</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    <style>
        .word-table {
            border:1px solid black !important; 
            border-collapse: collapse !important;
            width: 100%;
        }
        .word-table tr th, .word-table tr td{
            border:1px solid black !important; 
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <h2>Transaksi List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nis</th>
            <th>Siswa</th>
            <th>Tgl</th>
            <th>Tahun Dibayar</th>
            <th>Jumlah Dibayar</th>
            <th>Status</th>

            </tr><?php
            foreach ($transaksi_data as $transaksi)
            {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $transaksi->nama_kategori ?></td>
                    <td><?php echo $transaksi->nis ?></td>
                    <td><?php echo $transaksi->nama_siswa ?></td>
                    <td><?php echo $transaksi->tgl ?></td>
                    <td><?php echo $transaksi->tahun_dibayar ?></td>
                    <td><?php echo "Rp. " . number_format($transaksi->jumlah_dibayar) ?></td>
                    <td><?php echo $transaksi->status ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
    </html>