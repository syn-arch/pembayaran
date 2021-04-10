<div class="row">

    <?php if ($kategori): ?>
        <?php foreach ($kategori as $row): ?>
            <div class="col-xs-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="pull-left">
                            <div class="box-title">
                                <h2><?php echo $row->nama_kategori ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                           <div class="col-md-12">
                            <h1 class="text-right">Rp. <?php echo number_format($row->nominal) ?></h1>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo base_url('transaksi/pilih_metode_pembayaran/') . $this->session->userdata('nis') . '/' . $row->id_pembayaran ?>" class="btn btn-primary btn-block"><i  class="fa fa-credit-card"></i> BAYAR</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <?php else: ?>

        <div class="container">


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>Perhatian</strong>
                        <p>Data Pembayaran Tidak Ditemukan</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>