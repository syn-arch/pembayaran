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
                        <form action="<?php echo $action; ?>" method="post">
                         <div class="form-group <?php if(form_error('id_kategori')) echo 'has-error'?> ">
                            <label for="int">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $row): ?>
                                    <option <?php echo $id_kategori == $row->id_kategori ? 'selected': ''  ?> value="<?php echo $row->id_kategori ?>"><?php echo $row->nama_kategori ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php echo form_error('id_kategori', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('id_jurusan')) echo 'has-error'?> ">
                            <label for="int">Jurusan</label>
                           <select name="id_jurusan" id="id_jurusan" class="form-control">
                                <option value="">-- Pilih jurusan --</option>
                                <?php foreach ($jurusan as $row): ?>
                                    <option <?php echo $id_jurusan == $row->id_jurusan ? 'selected': ''  ?> value="<?php echo $row->id_jurusan ?>"><?php echo $row->nama_jurusan ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php echo form_error('id_jurusan', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('tahun_angkatan')) echo 'has-error'?> ">
                            <label for="int">Tahun Angkatan</label>
                            <input type="text" class="form-control" name="tahun_angkatan" id="tahun_angkatan" placeholder="Tahun Angkatan" value="<?php echo $tahun_angkatan; ?>" />
                            <?php echo form_error('tahun_angkatan', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('nominal')) echo 'has-error'?> ">
                            <label for="int">Nominal</label>
                            <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" value="<?php echo $nominal; ?>" />
                            <?php echo form_error('nominal', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('keterangan')) echo 'has-error'?> ">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
                            <?php echo form_error('keterangan', '<small style="color:red">','</small>') ?>
                        </div>
                        <input type="hidden" name="id_pembayaran" value="<?php echo $id_pembayaran; ?>" /> 
                        <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>