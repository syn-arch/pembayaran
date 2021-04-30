<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h2>TUNAI</h2>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Pada transaksi non tunai anda dapat melakukannya melalui langkah-langkah berikut.</p>
                        <ol>
                            <li>Pergi ke sekolah SMK BUDI BAKTI CIWIDEY</li>
                            <li>Hubungi Administrasi Sekolah (Bpk. ~)</li>
                            <li>Sebutkan nis atau nama siswa</li>
                            <li>Serahkan uang pembayaran sebesar <?= "Rp. " . number_format($pembayaran->nominal) ?></li>
                            <li>Transaksi selesai</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h2>NON TUNAI</h2>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>0. Pastikan informasi pengirim sudah terisi, anda dapat mengubahnya melalui link <a target="_blank" href="<?php echo base_url('transaksi/tambah_rek') ?>" >BERIKUT</a> <br> Jika sudah terisi lanjut ke langkah berikutnya</p>
                        <p>1. Untuk melakukan transaksi non tunai, anda dapat mentransfer pembayaran ke rekening dibawah *(<small>pilih salah satu</small>)
                        Sebesar <?= "Rp. " . number_format($pembayaran->nominal)  ?></P>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Rek</th>
                                        <th>No. Rek</th>
                                        <th>Atas Nama</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach ($metode_pembayaran as $row): ?>
                                    <tr>
                                        <td><?= $row->nama_bank ?></td>
                                        <td><?= $row->no_rekening ?></td>
                                        <td><?= $row->atas_nama ?></td>
                                        <td><?= $row->keterangan ?></td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <p>2. Simpan bukti pembayaran, dapat berbentuk faktur fisik, atau screenshoot (untuk pengguna m-banking)</p>
                        <p>3. Selanjutnya inputkan pembayaran yang telah dilakukan pada link berikut</p>
                        <hr>
                        <a class="btn btn-primary btn-block" href="<?php echo base_url('transaksi/bayar_siswa/') . $this->uri->segment(3) . '/' . $this->uri->segment(4) ?>">FORM PEMBAYARAN</a>
                        <hr>
                        <p>4. Tunggu maksimal 1 x 24 jam untuk dikonfirmasi oleh admin</p>
                        <p>5. Setelah pembayaran berhasil dikonfirmasi, anda dapat mencetak bukti pembayaran</p>
                        <p>6. Transaksi Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>