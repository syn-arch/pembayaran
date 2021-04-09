
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
                        <a href="<?php echo base_url('siswa') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
             <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                 <table class="table">
                    <tr><td>Jurusan</td><td><?php echo $nama_jurusan; ?></td></tr>
                    <tr><td>Kelas</td><td><?php echo $nama_kelas; ?></td></tr>
                    <tr><td>Nis</td><td><?php echo $nis; ?></td></tr>
                    <tr><td>Nama Siswa</td><td><?php echo $nama_siswa; ?></td></tr>
                    <tr><td>Tgl Lahir</td><td><?php echo $tgl_lahir; ?></td></tr>
                    <tr><td>Jk</td><td><?php echo $jk; ?></td></tr>
                    <tr><td>Tahun Ajaran</td><td><?php echo $tahun_ajaran; ?></td></tr>
                    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
                    <tr><td>Aktif</td><td><?php echo $aktif; ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>