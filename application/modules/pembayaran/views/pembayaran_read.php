
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
                        <a href="<?php echo base_url('pembayaran') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
               <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                   <table class="table">
                    <tr><td>Kategori</td><td><?php echo $nama_kategori; ?></td></tr>
                    <tr><td>Jurusan</td><td><?php echo $nama_jurusan; ?></td></tr>
                    <tr><td>Tahun Angkatan</td><td><?php echo $tahun_angkatan; ?></td></tr>
                    <tr><td>Nominal</td><td><?php echo "Rp. " . number_format($nominal); ?></td></tr>
                    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>