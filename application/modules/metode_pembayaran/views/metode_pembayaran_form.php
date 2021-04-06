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
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('nama_bank')) echo 'has-error'?> ">
                            <label for="varchar">Nama Bank</label>
                            <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Nama Bank" value="<?php echo $nama_bank; ?>" />
                            <?php echo form_error('nama_bank', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('atas_nama')) echo 'has-error'?> ">
                            <label for="varchar">Atas Nama</label>
                            <input type="text" class="form-control" name="atas_nama" id="atas_nama" placeholder="Atas Nama" value="<?php echo $atas_nama; ?>" />
                            <?php echo form_error('atas_nama', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('no_rekening')) echo 'has-error'?> ">
                            <label for="varchar">No Rekening</label>
                            <input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="No Rekening" value="<?php echo $no_rekening; ?>" />
                            <?php echo form_error('no_rekening', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('keterangan')) echo 'has-error'?> ">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
                            <?php echo form_error('keterangan', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="id_metode_pembayaran" value="<?php echo $id_metode_pembayaran; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>