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
                        <a href="<?php echo base_url('tahun_ajaran') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post">
                           <div class="form-group <?php if(form_error('tahun_ajaran')) echo 'has-error'?> ">
                            <label for="int">Tahun Ajaran</label>
                            <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="Tahun Ajaran" value="<?php echo $tahun_ajaran; ?>" />
                            <?php echo form_error('tahun_ajaran', '<small style="color:red">','</small>') ?>
                        </div>
                        <input type="hidden" name="id_tahun_ajaran" value="<?php echo $id_tahun_ajaran; ?>" /> 
                        <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>