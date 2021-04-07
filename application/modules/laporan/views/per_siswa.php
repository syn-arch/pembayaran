<?php if (!$this->input->get('id_pembayaran')): ?>
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
                        <div class="col-md-6">
                            <form>
                                <div class="form-group <?php if(form_error('id_pembayaran')) echo 'has-error'?> ">
                                    <label for="varchar">Nama Kategori</label>
                                    <select name="id_pembayaran" id="id_pembayaran" class="form-control select2">
                                        <option value="">Pilh Kategori</option>
                                        <?php foreach ($kategori as $row): ?>
                                            <option value="<?php echo $row->id_pembayaran ?>"><?= $row->nama_kategori ?> | <?= $row->nama_jurusan ?> | <?= $row->tahun_angkatan ?></option>  
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group <?php if(form_error('id_kelas')) echo 'has-error'?> ">
                                    <label for="varchar">Nama Kelas</label>
                                    <select name="id_kelas" id="id_kelas" class="form-control select2">
                                        <option value="">Pilh Kelas</option>
                                        <?php foreach ($kelas as $row): ?>
                                            <option value="<?php echo $row->id_kelas ?>"><?= $row->nama_kelas ?></option>  
                                        <?php endforeach ?>
                                    </select>
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
    <?php else: ?>

        <?php 

        $kelas = $this->db->get_where('kelas', ['id_kelas' => $this->input->get('id_kelas')])->row();

        $this->db->where('id_pembayaran', $this->input->get('id_pembayaran'));
        $this->db->where('id_jurusan', $kelas->id_jurusan);
        $pb = $this->db->get('pembayaran')->row();  

        ?>

        <?php if (!$pb): ?>

            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <strong>PERHATIAN</strong>
                        <p>Data Tidak Ditemukan</p>
                        <a href="<?php echo base_url('laporan/per_siswa') ?>">Kembali</a>
                    </div>
                </div>
            </div>

            <?php else: ?>
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
                                    <a href="<?php echo base_url('laporan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <th>Kelas</th>
                                                <td><?= $kelas->nama_kelas ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Pembayaran</th>
                                                <td><?= $pembayaran->nama_kategori ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nominal</th>
                                                <td><?= "Rp. " . number_format($pembayaran->nominal) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Siswa</th>
                                                        <th>Nis</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Jumlah Dibayar</th>
                                                        <th>Sisa Bayar</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <?php $no=1; foreach ($laporan as $row): ?>
                                                   <tr>
                                                       <td><?= $no++ ?></td>
                                                       <td><?= $row['nama_siswa'] ?></td>
                                                       <td><?= $row['nis'] ?></td>
                                                       <td><?= $row['jk'] ?></td>
                                                       <td><?= "Rp. " . number_format($row['jumlah_dibayar']) ?></td>

                                                       <?php if ($row['nominal'] == 0): ?>
                                                        <td><?= "Rp. " . number_format($pembayaran->nominal) ?></td>
                                                        <td><button class="btn btn-danger">BELUM BAYAR</button></td>
                                                        <?php else: ?>
                                                           <td><?= "Rp. " . number_format($row['sisa_bayar']) ?></td>
                                                           <td><?= $row['jumlah_dibayar']  >= $pembayaran->nominal ? '<button class="btn btn-success">LUNAS</button>' : '<button class="btn btn-warning">BELUM LUNAS</button>' ?></td>
                                                       <?php endif ?>

                                                   </tr>
                                               <?php endforeach ?>
                                           </tbody>
                                       </table>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       <?php endif ?>

   <?php endif ?>

