<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo base_url('transaksi/tambah_rek_aksi'); ?>" method="post">
                            <div class="form-group <?php if(form_error('bank')) echo 'has-error'?> ">
                                <label for="varchar">Nama bank</label>
                                <input type="text" class="form-control" name="bank" id="nama_bank" placeholder="Nama bank" value="<?php echo $rek['bank']; ?>" />
                                <?php echo form_error('bank', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('atas_nama')) echo 'has-error'?> ">
                                <label for="varchar">Atas Nama</label>
                                <input type="text" class="form-control" name="atas_nama" id="atas_nama" placeholder="Nama atas nama" value="<?php echo $rek['atas_nama']; ?>" />
                                <?php echo form_error('atas_nama', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('no_rekening')) echo 'has-error'?> ">
                                <label for="varchar">No Rekening</label>
                                <input type="text" class="form-control" name="no_rekening" id="o_rekening" placeholder="no rekening" value="<?php echo $rek['no_rekening']; ?>" />
                                <?php echo form_error('no_rekening', '<small style="color:red">','</small>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>