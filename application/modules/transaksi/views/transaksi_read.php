
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
                 <table class="table">
                     <tr><td>Id Kategori</td><td><?php echo $id_kategori; ?></td></tr>
                     <tr><td>Nis</td><td><?php echo $nis; ?></td></tr>
                     <tr><td>Tgl</td><td><?php echo $tgl; ?></td></tr>
                     <tr><td>Tahun Dibayar</td><td><?php echo $tahun_dibayar; ?></td></tr>
                     <tr><td>Jumlah Dibayar</td><td><?php echo $jumlah_dibayar; ?></td></tr>
                     <tr><td>Status</td><td><?php echo $status; ?></td></tr>
                     <tr><td>Bukti Pembayaran</td><td><?php echo $bukti_pembayaran; ?></td></tr>
                 </table>
             </div>
         </div>
     </div>
 </div>
</div>
</div>