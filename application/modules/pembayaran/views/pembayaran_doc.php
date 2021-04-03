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
    <h2>Pembayaran List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Jurusan</th>
            <th>Tahun Angkatan</th>
            <th>Nominal</th>
            <th>Keterangan</th>

            </tr><?php
            foreach ($pembayaran_data as $pembayaran)
            {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $pembayaran->nama_kategori ?></td>
                    <td><?php echo $pembayaran->nama_jurusan ?></td>
                    <td><?php echo $pembayaran->tahun_angkatan ?></td>
                    <td><?php echo $pembayaran->nominal ?></td>
                    <td><?php echo $pembayaran->keterangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
    </html>