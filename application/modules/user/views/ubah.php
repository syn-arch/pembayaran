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
                        <a href="<?php echo base_url('user') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
               <div class="row">
                <div class="col-md-2"></div>
                   <div class="col-md-8">
                       <form method="POST" enctype="multipart/form-data">
                        <div class="form-group <?php if(form_error('id_user')) echo 'has-error'?>">
                          <label for="id_user">ID user</label>
                          <input readonly="" type="text" id="id_user" name="id_user" class="form-control" value="<?php echo $user['id_user'] ?>">
                          <?php echo form_error('id_user', '<small style="color:red">','</small>') ?>
                        </div>
                           <div class="form-group <?php if(form_error('nama_user')) echo 'has-error'?>">
                               <label for="nama_user">Nama user</label>
                               <input type="text" id="nama_user" name="nama_user" class="form-control nama_user" placeholder="Nama user" value="<?php echo $user['nama_user'] ?>">
                               <?php echo form_error('nama_user', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('jk')) echo 'has-error'?>">
                               <label for="jk">Jenis Kelamin</label><br>
                               <select name="jk" id="jk" class="form-control">
                                   <option value="">-- Silahkan Pilih Jenis Kelamin --</option>
                                   <option value="L" <?php echo $user['jk'] == "L" ? 'selected' : '' ?>>Laki-Laki</option>
                                   <option value="P" <?php echo $user['jk'] == "P" ? 'selected' : '' ?>>Perempuan</option>
                               </select>
                               <?php echo form_error('jk', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('alamat')) echo 'has-error'?>" >
                               <label for="alamat">Alamat</label>
                               <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control " placeholder="alamat"><?php echo $user['alamat'] ?></textarea>
                               <?php echo form_error('alamat', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('telepon')) echo 'has-error'?>">
                               <label for="telepon">Telepon</label>
                               <input type="text" id="telepon" name="telepon" class="form-control telepon " placeholder="Telepon" value="<?php echo $user['telepon'] ?>">
                               <?php echo form_error('telepon', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('email')) echo 'has-error'?>">
                               <label for="E-mail">E-mail</label>
                               <input type="text" id="E-mail" name="email" class="form-control E-mail " placeholder="E-mail" value="<?php echo $user['email'] ?>">
                               <?php echo form_error('E-mail', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('gambar')) echo 'has-error'?>">
                               <label for="gambar">Gambar</label>
                               <input type="file" id="gambar" name="gambar" class="form-control gambar " placeholder="Gambar" value="<?php echo set_value('gambar') ?>">
                               <?php echo form_error('gambar', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group">
                             <img src="<?php echo base_url('assets/img/user/') . $user['gambar'] ?>" alt="" width="200">
                           </div>
                           <div class="form-group <?php if(form_error('id_role')) echo 'has-error'?>">
                               <label for="id_role">Level</label>
                               <select name="id_role" id="id_role" class="form-control">
                                   <option value="">-- Silahkan Pilih Level ---</option>
                                   <?php foreach ($role as $row): ?>
                                       <option value="<?php echo $row['id_role'] ?>" <?php echo $user['id_role'] == $row['id_role'] ? 'selected' : '' ?>><?php echo $row['nama_role'] ?></option>
                                   <?php endforeach ?>
                               </select>
                               <?php echo form_error('id_role', '<small style="color:red">','</small>') ?>
                           </div>
                            <div class="form-group <?php if(form_error('petugas')) echo 'has-error'?>">
                               <label for="petugas">Petugas ?</label><br>
                               <select name="petugas" id="petugas" class="form-control petugas">
                                   <option value="0" <?php echo $user['petugas'] == "0" ? 'selected' : '' ?>>TIDAK</option>
                                   <option value="1" <?php echo $user['petugas'] == "1" ? 'selected' : '' ?>>IYA</option>
                               </select>
                               <?php echo form_error('petugas', '<small style="color:red">','</small>') ?>
                           </div>
                            <div class="form-group id_jurusan <?php if(form_error('id_jurusan')) echo 'has-error'?>">
                               <label for="id_jurusan">Jurusan</label>
                               <select name="id_jurusan" id="id_jurusan" class="form-control">
                                   <?php foreach ($jurusan as $row): ?>
                                       <option value="<?php echo $row['id_jurusan'] ?>" <?php echo $user['id_jurusan'] == $row['id_jurusan'] ? 'selected' : '' ?>><?php echo $row['nama_jurusan'] ?></option>
                                   <?php endforeach ?>
                               </select>
                               <?php echo form_error('id_jurusan', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-primary btn-block">Submit</button>
                           </div>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.petugas').change(function(){
        if ($(this).val() == 1) {
            $('.id_jurusan').show()
        }else{
            $('.id_jurusan').hide()
        }
    })
</script>