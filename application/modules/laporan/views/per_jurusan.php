<?php if (!$this->input->get('id_kategori')): ?>
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
								<div class="form-group <?php if(form_error('id_kategori')) echo 'has-error'?> ">
									<label for="varchar">Nama Kategori</label>
									<select name="id_kategori" id="id_kategori" class="form-control select2">
										<option value="">Pilh Kategori</option>
										<?php foreach ($kategori as $row): ?>
											<option value="<?php echo $row->id_kategori ?>"><?= $row->nama_kategori ?></option>  
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group <?php if(form_error('tahun_angkatan')) echo 'has-error'?> ">
									<label for="varchar">Tahun Angkatan</label>
									<input type="tahun_angkatan" name="tahun_angkatan" class="form-control" placeholder="Tahun Angkatan">
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
									<th>Kategori</th>
									<td><?= $kategori->nama_kategori ?></td>
								</tr>
								<tr>
									<th>Tahun Angkatan</th>
									<td><?= $this->input->get('tahun_angkatan') ?></td>
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
											<th>Nama Jurusan</th>
											<th>Nominal</th>
											<th>Jumlah Kelas</th>
											<th>Jumlah Siswa</th>
											<th>Harus Dibayar</th>
											<th>Telah Dibayar</th>
											<th>Sisa Bayar</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach ($laporan as $index => $row): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $row['nama_jurusan'] ?></td>
											<td><?= "Rp. " . number_format($pembayaran[$index]->nominal) ?></td>
											<td><?= $row['jml_kelas'] ?></td>
											<td><?= $row['jml_siswa'] ?></td>
											<td><?= "Rp. " . number_format($row['jml_siswa'] * $pembayaran[$index]->nominal) ?></td>
											<td><?= "Rp. " . number_format($row['telah_dibayar']) ?></td>
											<td><?= "Rp. " . number_format($row['jml_siswa'] * $pembayaran[$index]->nominal - $row['telah_dibayar']) ?></td>
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

