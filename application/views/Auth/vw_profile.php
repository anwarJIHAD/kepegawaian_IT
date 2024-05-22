<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>

<!-- Main Content -->
<?= $this->session->flashdata('message'); ?>
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Halaman Edit Profile</h1>
		</div>

		<div class="section-body">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="card border rounded shadow-lg p-3 mb-5">
							<div class="card-header">
								<h4>Edit Profile</h4>
							</div>
							<div class="row">
								<div class="col-md-5">
									<img src="https://awsimages.detik.net.id/community/media/visual/2023/04/14/gambar-pemandangan-6.jpeg?w=3000"
										alt="Gambar" class="img-fluid mb-2">

								</div>
								<div class="col-md-7">
									<div class="card-body">

										<form method="POST">
											<div class="form-group row">
												<label for="inputEmail3" class="col-sm-3 col-form-label">Nama
													Lengkap</label>
												<div class="col-sm-9">
													<input type="email"
														value="<?= $this->session->userdata('username'); ?>"
														class="form-control" id="inputEmail3"
														placeholder="Nama Lengkap">
												</div>
											</div>
											<div class="form-group row">
												<label for="inputEmail3" class="col-sm-3 col-form-label">NIY</label>
												<div class="col-sm-9">
													<input type="email" value="<?= $this->session->userdata('niy'); ?>"
														class="form-control" id="inputEmail3" placeholder="NIY"
														readonly>
												</div>
											</div>
											<div class="form-group row">
												<label for="inputEmail3" class="col-sm-3 col-form-label">Jenis
													Kelamin</label>
												<div class="col-sm-9">
													<input type="email" class="form-control" id="inputEmail3"
														value="<?= $pegawai['niy'] ?>" placeholder="Jenis Kelamin">
												</div>
											</div>
											<div class="form-group row">
												<label for="inputEmail3" class="col-sm-3 col-form-label">No Hp</label>
												<div class="col-sm-9">
													<input type="email" class="form-control" id="inputEmail3"
														placeholder="No Hp">
												</div>
											</div>
											<div class="form-group row">
												<label for="inputEmail3" class="col-sm-3 col-form-label">Jabatan</label>
												<div class="col-sm-9">
													<input type="email" class="form-control" id="inputEmail3"
														placeholder="Jabatan">
												</div>
											</div>
											<a href="<?= base_url('Console/pegawai') ?>" class="btn btn-light ">Ubah
												Password</a>
											<a href="<?= base_url('Console/pegawai') ?>" class="btn btn-light">Tutup</a>
											<button type="submit" name="tambah"
												class="btn btn-success float-right">Batal</button>
										</form>
									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
			</div>

	</section>
</div>

</div>
</div>