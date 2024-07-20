<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h5>Data Lembur</h5>
		</div>
		<?= $this->session->flashdata('message'); ?>
		<div class="section-body">
			<div class="card">
				<div class="card-body">
					<div style="margin-bottom: 20px;">
						<?php if ($pegawai['role'] == 'Admin') { ?>
							<a href="<?= base_url() ?>Lembur/tambah_lembur" class="btn btn-outline-warning"><i
									class="bi bi-plus-circle"></i> Tambah Data</a>
							<a href="<?= base_url() ?>Lembur/export" class="btn btn-outline-success"><i
									class="bi bi-plus-circle"></i> Export Excel</a>
						<?php } ?>
					</div>

					<div class="table-responsive">
						<table class="table table-bordered nowrap"
							style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
							<thead>
								<tr class="table-success">
									<th>No</th>
									<th>Nama Pegawai</th>
									<th>Tanggal</th>
									<th>Masuk</th>
									<th>Pulang</th>
									<th>Lama Lembur</th>
									<th>Keterangan Lembur</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($lembur as $us): ?>
									<tr>
										<td> <?= $i; ?>.</td>
										<td><?= $us['nama']; ?></td>
										<td><?= $us['tanggal']; ?></td>
										<td><?= $us['masuk']; ?></td>
										<td><?= $us['pulang']; ?></td>
										<td><?= $us['lama_lembur']; ?></td>
										<td><?= $us['ket_lembur']; ?></td>
										<td>
											<?php if ($us['status'] == 'Diterima') { ?>
												<span class="badge badge-success"><?= $us['status']; ?></span>
											<?php } elseif ($us['status'] == 'Ditolak') { ?>
												<span class="badge badge-danger"><?= $us['status']; ?></span>
											<?php } else { ?>
												<span class="badge badge-warning"><?= $us['status']; ?></span>
											<?php } ?>
										</td>
										<td>
											<?php if (
												$pegawai['role'] == 'Admin' && $us['status'] != 'Diterima' && $us['status'] != 'Ditolak'
											) { ?>
												<a href="<?= base_url('Lembur/hapus/') . $us['id_lembur']; ?>"
													class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</a>
											<?php } elseif ($us['status'] == 'Diajukan') { ?>
												-
											<?php } else { ?>
												Telah <?= $us['status'] ?>
											<?php } ?>
										</td>
									</tr>
									<?php $i++; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>

</div>
</section>
</div>


</div>
</div>

<!-- Modal -->
<?php foreach ($lembur as $us): ?>
	<div class="modal fade" tabindex="-1" role="dialog" id="modal<?= $us['id_lembur']; ?>">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Data Lembur</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

			</div>
		<?php endforeach; ?>

		<script>
			function confirm_delete(question) {

				if (confirm(question)) {

					alert("Action to delete");

				} else {
					return false;
				}

			}
		</script>
