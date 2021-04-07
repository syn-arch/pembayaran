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
                        <form action="<?php echo $action; ?>" method="post">
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
                            <div class="form-group <?php if(form_error('id_kelas')) echo 'has-error'?> ">
                                <label for="int">Kelas</label>
                                <select name="id_kelas" id="id_kelas" class="form-control">
                                    <option value="">-- Pilih kelas --</option>
                                    <?php foreach ($kelas as $row): ?>
                                        <option <?php echo $id_kelas == $row->id_kelas ? 'selected': ''  ?> value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php echo form_error('id_kelas', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('nis')) echo 'has-error'?> ">
                                <label for="int">Nis</label>
                                <input type="text" class="form-control" name="nis" id="nis" placeholder="Nis" value="<?php echo $nis; ?>" />
                                <?php echo form_error('nis', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('nama_siswa')) echo 'has-error'?> ">
                                <label for="varchar">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" value="<?php echo $nama_siswa; ?>" />
                                <?php echo form_error('nama_siswa', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('tgl_lahir')) echo 'has-error'?> ">
                                <label for="date">Tgl Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tgl Lahir" value="<?php echo $tgl_lahir; ?>" />
                                <?php echo form_error('tgl_lahir', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('jk')) echo 'has-error'?> ">
                                <label for="enum">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control">
                                    <option <?php echo $jk == 'L' ? 'selected': ''  ?> value="L">Laki-Laki</option>
                                    <option <?php echo $jk == 'P' ? 'selected': ''  ?> value="P">Perempuan</option>
                                </select>
                                <?php echo form_error('jk', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('tahun_ajaran')) echo 'has-error'?> ">
                                <label for="int">Tahun Ajaran</label>
                                <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="Tahun Ajaran" value="<?php echo $tahun_ajaran; ?>" />
                                <?php echo form_error('tahun_ajaran', '<small style="color:red">','</small>') ?>
                            </div>
                            <input type="hidden" name="id_siswa" value="<?php echo $id_siswa; ?>" /> 
                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>