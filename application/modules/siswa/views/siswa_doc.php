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
    <h2>Siswa List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Barcode</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Nis</th>
            <th>Nama Siswa</th>
            <th>Tgl Lahir</th>
            <th>Jk</th>
            <th>Tahun Ajaran</th>
            <th>Email</th>
            <th>Aktif</th>

            </tr><?php
            foreach ($siswa_data as $siswa)
            {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $siswa->barcode ?></td>
                    <td><?php echo $siswa->nama_jurusan ?></td>
                    <td><?php echo $siswa->nama_kelas ?></td>
                    <td><?php echo $siswa->nis ?></td>
                    <td><?php echo $siswa->nama_siswa ?></td>
                    <td><?php echo $siswa->tgl_lahir ?></td>
                    <td><?php echo $siswa->jk ?></td>
                    <td><?php echo $siswa->tahun_ajaran ?></td>	
                    <td><?php echo $siswa->email ?></td> 
                    <td><?php echo $siswa->aktif == '1' ? 'AKTIF' : 'TIDAK AKTIF' ?></td> 
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
    </html>