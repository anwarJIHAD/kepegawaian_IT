<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>

<!-- Main Content -->
<?= $this->session->flashdata('message'); ?>
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data absensi</h1>
		</div>

		<div class="section-body">
			<div class="card">
				<div class="card-header">
					<h4>Edit Data absensi</h4>
				</div>
				<div class="card-body">
					<form method="POST">
						<input type="hidden" name="id" value="<?= $absensi['id'] ?>;">
						<input type="hidden" name="niy" value="<?= $absensi['niy'] ?>;">

						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama Pegawai</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai['nama']; ?>"
									placeholder="Nama Pegawai" readonly>
								<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Tanggal</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $absensi['tanggal']; ?>">
								<?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Jam Datang</label>
							<div class="col-sm-9">
								<input type="time" class="form-control" id="waktu_datang" name="waktu_datang"
									value="<?= $absensi['waktu_datang']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Jam Pulang</label>
							<div class="col-sm-9">
								<input type="time" class="form-control" id="waktu_pulang" name="waktu_pulang"
									value="<?= $absensi['waktu_pulang']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Pulang Awal</label>
							<div class="col-sm-9">
								<input type="time" class="form-control" id="pulang_awal" name="pulang_awal"
									value="<?= $absensi['pulang_awal']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Lama Kerja</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="waktu_kerja" name="waktu_kerja"
									value="<?= $absensi['waktu_kerja']; ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Status Kehadiran</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="status" name="status" value="<?= $absensi['status']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Keterangan Absensi</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="keterangan" name="keterangan"
									value="<?= $absensi['waktu_kerja']; ?>">
							</div>
						</div>
						<a href="<?= base_url('Console/absensi') ?>" class="btn btn-light">Tutup</a>
						<button type="submit" name="edit" class="btn btn-success float-right">Simpan</button>

					</form>
				</div>
			</div>
	</section>
</div>

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	$(document).ready(function () {
		total_waktu();
		function total_waktu() {
			let total = $('#waktu_kerja').val();
			let [totalHours, totalMinutes] = total.split(':');
			// console.log(totalMinutes);
			if (totalMinutes) {
				$('#waktu_kerja').val(`${totalHours} jam ${totalMinutes} menit`);
			}

		}
		function calculateabsensi() {
			let masuk = $('#waktu_datang').val();
			let pulang = $('#waktu_pulang').val();
			console.log(masuk, pulang)

			if (masuk && pulang) {
				let [masukHours, masukMinutes] = masuk.split(':');
				let [pulangHours, pulangMinutes] = pulang.split(':');

				let masukTime = new Date(`1970-01-01T${masukHours}:${masukMinutes}:00`);
				let pulangTime = new Date(`1970-01-01T${pulangHours}:${pulangMinutes}:00`);

				if (pulangTime < masukTime) {
					pulangTime.setDate(pulangTime.getDate() + 1);
				}

				let diff = pulangTime - masukTime;
				let hours = Math.floor(diff / 1000 / 60 / 60);
				let minutes = Math.floor((diff / 1000 / 60) % 60);

				$('#waktu_kerja').val(`${hours} jam ${minutes} menit`);
			}
		}

		$('#waktu_datang, #waktu_pulang').on('change', calculateabsensi);
	});
</script>