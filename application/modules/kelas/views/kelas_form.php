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
                        <a href="<?php echo base_url('kelas') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post">
                            <div class="form-group <?php if(form_error('nama_kelas')) echo 'has-error'?> ">
                                <label for="varchar">Nama Kelas</label>
                                <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" value="<?php echo $nama_kelas; ?>" />
                                <?php echo form_error('nama_kelas', '<small style="color:red">','</small>') ?>
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
                            <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>" /> 
                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>