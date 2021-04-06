
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
                        <a href="<?php echo base_url('metode_pembayaran') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                     <table class="table">
	    <tr><td>Nama Bank</td><td><?php echo $nama_bank; ?></td></tr>
	    <tr><td>Atas Nama</td><td><?php echo $atas_nama; ?></td></tr>
	    <tr><td>No Rekening</td><td><?php echo $no_rekening; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>