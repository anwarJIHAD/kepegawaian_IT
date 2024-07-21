<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
<!-- Main Content -->
<?= $this->session->flashdata('message'); ?>
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Lembur</h1>
		</div>

		<div class="section-body">
			<div class="card">
				<div class="card-header">
					<h4>Edit Data Lembur</h4>
				</div>
				<div class="card-body">
					<form method="POST">
						<input type="hidden" name="id" value="<?= $lembur['id'] ?>;">

						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama Pegawai</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai['nama']; ?>" placeholder="Nama Pegawai" disabled>
								<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Tanggal</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $lembur['tanggal']; ?>">
								<?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Masuk</label>
							<div class="col-sm-9">
								<input type="time" class="form-control" id="masuk" name="masuk" value="<?= $lembur['masuk']; ?>">
								<?= form_error('masuk', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Pulang</label>
							<div class="col-sm-9">
								<input type="time" class="form-control" id="pulang" name="pulang" value="<?= $lembur['pulang']; ?>">
								<?= form_error('pulang', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Lama Lembur</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="lama_lembur" name="lama_lembur" value="<?= $lembur['lama_lembur']; ?>" readonly>
								<?= form_error('lama_lembur', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Keterangan Lembur</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="ket_lembur" name="ket_lembur" value="">
								<?= form_error('ket_lembur', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<a href="<?= base_url('Console/lembur') ?>" class="btn btn-light">Tutup</a>
						<button type="submit" name="tambah" class="btn btn-success float-right">Simpan</button>
					</form>
				</div>
			</div>
	</section>
</div>

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		function calculateLembur() {
			let masuk = $('#masuk').val();
			let pulang = $('#pulang').val();
			console.log(masuk, pulang)

			if (masuk && pulang) {
				let masukTime = new Date(`1970-01-01T${masuk}:00`);
				let pulangTime = new Date(`1970-01-01T${pulang}:00`);

				if (pulangTime < masukTime) {
					pulangTime.setDate(pulangTime.getDate() + 1);
				}

				let diff = pulangTime - masukTime;
				let hours = Math.floor(diff / 1000 / 60 / 60);
				let minutes = Math.floor((diff / 1000 / 60) % 60);

				$('#lama_lembur').val(`${hours} jam ${minutes} menit`);
			}
		}

		$('#masuk, #pulang').on('change', calculateLembur);
	});
</script>