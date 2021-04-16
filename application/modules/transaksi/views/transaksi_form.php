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
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group <?php if(form_error('id_pembayaran')) echo 'has-error'?> ">
                                    <label for="int">Kategori</label>
                                    <select name="id_pembayaran" id="id_pembayaran" class="form-control">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($kategori as $row): ?>
                                            <option <?php echo $id_pembayaran == $row->id_pembayaran ? 'selected': ''  ?> value="<?php echo $row->id_pembayaran ?>"><?php echo $row->nama_kategori ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?php echo form_error('id_pembayaran', '<small style="color:red">','</small>') ?>
                                </div>
                                <div class="form-group <?php if(form_error('nis')) echo 'has-error'?> ">
                                    <label for="int">Nis</label>
                                    <input type="text" name="nis" class="form-control" value="<?php echo $nis ?>" readonly>
                                    <?php echo form_error('nis', '<small style="color:red">','</small>') ?>
                                </div>
                                <div class="form-group <?php if(form_error('tgl')) echo 'has-error'?> ">
                                    <label for="timestamp">Tgl</label>
                                    <input type="datetime-local" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo date('Y-m-d\TH:i:s', strtotime($tgl)) ?>" />
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
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" <?php echo $status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="diterima" <?php echo $status == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                        <option value="ditolak" <?php echo $status == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                    </select>
                                    <?php echo form_error('status', '<small style="color:red">','</small>') ?>
                                </div>
                                <div class="form-group <?php if(form_error('bukti_pembayaran')) echo 'has-error'?> ">
                                    <label for="varchar">Bukti Pembayaran</label>
                                    <input type="file" name="bukti" class="form-control">
                                    <img src="<?php echo base_url('assets/img/transaksi/') . $bukti_pembayaran ?>" alt="" class="img-responsive">
                                    <?php echo form_error('bukti_pembayaran', '<small style="color:red">','</small>') ?>
                                </div>
                                <div class="form-group <?php if(form_error('keterangan')) echo 'has-error'?> ">
                                    <label for="int">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" placeholder="Keterangan" cols="30" rows="10" class="form-control"><?= $keterangan ?></textarea>
                                    <?php echo form_error('keterangan', '<small style="color:red">','</small>') ?>
                                </div>
                                <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>" /> 
                                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                            </form>
                        </div>
                        <?php if ($judul == 'Ubah Transaksi'): ?>
                            <div class="col-md-4">
                                <h4>Informasi Pengirim</h4>
                                <table class="table">
                                    <thead>
                                        <thead>
                                            <tr>
                                                <th>Nama Bank</th>
                                                <td><?= $bank ?></td>
                                            </tr>
                                            <tr>
                                                <th>Atas Nama</th>
                                                <td><?= $atas_nama ?></td>
                                            </tr>
                                            <tr>
                                                <th>No Rekening</th>
                                                <td><?= $no_rekening ?></td>
                                            </tr>
                                        </thead>
                                    </thead>
                                </table>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>