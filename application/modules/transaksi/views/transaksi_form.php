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
                        <a href="<?php echo base_url('transaksi') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                            <div class="form-group <?php if(form_error('nis')) echo 'has-error'?> ">
                                <label for="int">Nis</label>
                                <select name="nis" id="nis" class="form-control">
                                    <option value="">-- Pilih Siswa --</option>
                                    <?php foreach ($siswa as $row): ?>
                                        <option <?php echo $nis == $row->nis ? 'selected': ''  ?> value="<?php echo $row->nis ?>"><?php echo $row->nama_siswa ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php echo form_error('nis', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('tgl')) echo 'has-error'?> ">
                                <label for="timestamp">Tgl</label>
                                <input type="date" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" />
                                <?php echo form_error('tgl', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('tahun_dibayar')) echo 'has-error'?> ">
                                <label for="int">Tahun Dibayar</label>
                                <input type="text" class="form-control" name="tahun_dibayar" id="tahun_dibayar" placeholder="Tahun Dibayar" value="<?php echo $tahun_dibayar; ?>" />
                                <?php echo form_error('tahun_dibayar', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('jumlah_dibayar')) echo 'has-error'?> ">
                                <label for="int">Jumlah Dibayar</label>
                                <input type="text" class="form-control" name="jumlah_dibayar" id="jumlah_dibayar" placeholder="Jumlah Dibayar" value="<?php echo $jumlah_dibayar; ?>" />
                                <?php echo form_error('jumlah_dibayar', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('status')) echo 'has-error'?> ">
                                <label for="varchar">Status</label>
                                <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                                <?php echo form_error('status', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('bukti_pembayaran')) echo 'has-error'?> ">
                                <label for="varchar">Bukti Pembayaran</label>
                                <input type="text" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" placeholder="Bukti Pembayaran" value="<?php echo $bukti_pembayaran; ?>" />
                                <?php echo form_error('bukti_pembayaran', '<small style="color:red">','</small>') ?>
                            </div>
                            <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>" /> 
                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>