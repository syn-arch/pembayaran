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
                                        <th>Nama Pembayaran</th>
                                        <td><?= $pembayaran->nama_kategori ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jurusan</th>
                                        <td><?= $pembayaran->nama_jurusan ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <td><?= $pembayaran->tahun_angkatan ?></td>
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
                                                <th>Nama Kelas</th>
                                                <th>Telah Dibayar</th>
                                                <th>Sisa Bayar</th>
                                                <th>Jml Siswa</th>
                                                <th>Jml Siswa Bayar</th>
                                                <th>Jml Siswa Belum Bayar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($laporan as $row): ?>

                                            <?php 

                                            $this->db->select('count(distinct(nis)) as sudah_bayar');
                                            $this->db->join('siswa', 'nis');
                                            $this->db->where('siswa.id_kelas', $row['id_kelas']);
                                            $sudah_bayar = $this->db->get('transaksi')->row_array()['sudah_bayar'];

                                             ?>

                                            <tr>
                                               <td><?= $no++ ?></td>
                                               <td><?= $row['nama_kelas'] ?></td>
                                               <td><?= "Rp. " . number_format($row['telah_dibayar']) ?></td>
                                               <td><?= "Rp. " . number_format(($pembayaran->nominal * $row['jml_siswa']) -  $row['telah_dibayar']) ?></td>
                                               <td><?= $row['jml_siswa'] ?></td>
                                               <td><?= $sudah_bayar ?></td>
                                               <td><?= $row['jml_siswa'] - $sudah_bayar ?></td>
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

