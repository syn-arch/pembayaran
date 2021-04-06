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
        <h2>Metode_pembayaran List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Bank</th>
		<th>Atas Nama</th>
		<th>No Rekening</th>
		<th>Keterangan</th>
		
            </tr><?php
            foreach ($metode_pembayaran_data as $metode_pembayaran)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $metode_pembayaran->nama_bank ?></td>
		      <td><?php echo $metode_pembayaran->atas_nama ?></td>
		      <td><?php echo $metode_pembayaran->no_rekening ?></td>
		      <td><?php echo $metode_pembayaran->keterangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>