<div class="row">
    <div class="col-xs-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4>Data Siswa</h4>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dt" width="100%" id="#mytable">
                        <tr>
                            <th>Nama Siswa</th>
                            <td><?php echo $siswa->nama_siswa ?></td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td><?php echo $siswa->nis ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td><?php echo $siswa->nama_kelas ?></td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td><?php echo $siswa->nama_jurusan ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?php echo $siswa->jk ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?php echo $siswa->tgl_lahir ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <td><?php echo $siswa->tahun_ajaran ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $siswa->email ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4>Informasi Bank Pengirim Siswa</h4>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dt" width="100%" id="#mytable">
                        <tr>
                            <th>Nama Bank</th>
                            <td><?php echo $siswa->bank ?></td>
                        </tr>
                        <tr>
                            <th>No Rekening</th>
                            <td><?php echo $siswa->no_rekening ?></td>
                        </tr>
                        <tr>
                            <th>Atas Nama</th>
                            <td><?php echo $siswa->atas_nama ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="<?php echo base_url('transaksi/tambah_rek') ?>" class="btn btn-primary btn-block">UBAH</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
