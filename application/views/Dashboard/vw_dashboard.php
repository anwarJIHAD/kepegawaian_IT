<style>
	.card-body {
		font-size: 14px;
	}

	.info {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 8px;
	}

	.info .details {
		display: flex;
		flex-direction: column;
	}

	.info .details .id-name {
		font-weight: bold;
	}

	.info .timestamp {
		background-color: #e0e0e0;
		padding: 5px 10px;
		border-radius: 5px;
		font-size: 12px;
	}
</style>
<!-- <div class="main-content">
		<section class="section">
				<div class="section-header">
						<h1>Dashboard</h1>
				</div>
				<div class="section-body">
						<div class="row">
								<div class="col-12 col-md-6 col-lg-6">
										<div class="card">
												<div class="card-header">
														<h4>Doughnut Chart</h4>
												</div>
												<div class="card-body">
														<canvas id="myChart3"></canvas>
												</div>
										</div>
								</div>
								<div class="col-12 col-md-6 col-lg-6">
										<div class="card">
												<div class="card-header">
														<h4>Pie Chart</h4>
												</div>
												<div class="card-body">
														<canvas id="myChart4"></canvas>
												</div>
										</div>
								</div>
						</div>
				</div>
		</section>
</div> -->
<div class="main-content" style="background-color: #F1F8F2">

	<section class="section">
		<div class="section-header">
			<h1>Dashboard</h1>

		</div>

		<div class="section-body">
			<div class="hero mb-4" style="background-color: #D1E5D3;padding: 20px 30px;">
				<div class="hero-inner container p-0">
					<div class="row align-items-center">
						<div class="col-md-8">
							<h2> <span style="font-weight: bold;color:#333333">السلام عليك, <?= $pegawai['nama']; ?>
								</span></h2>
							<p class="text-justify" style="color:#333333">Nikmati kemudahan akses informasi dan layanan
								terkait kepegawaian untuk mendukung karir dan kesejahteraan Anda.
							</p>
						</div>
						<div class="col-md-4 text-center">
							<img src="<?= base_url('template/assets/img/logo-dashboard.png') ?>" alt=""
								class="img-fluid" style="max-width: 50%;">
						</div>
					</div>
				</div>

			</div>
			<!-- <div class="row">
				<div class="col-12 col-md-6 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h4>Doughnut Chart</h4>
						</div>
						<div class="card-body">
								<div id="donutchart" style="width: 900px; height: 500px;"></div>            </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h4>Doughnut Chart</h4>
						</div>
						<div class="card-body">
								<div id="donutchart2" style="width: 900px; height: 500px;"></div>            </div>
					</div>
				</div>
			</div> -->

			<!-- kepala sekolah -->
			<?php if ($this->session->userdata('role') == 'kepala sekolah') { ?>
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="card card-statistic-1">
							<div class="card-icon bg-primary">
								<i class="far fa-user"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Total Pegawai</h4>
								</div>
								<div class="card-body">
									<?php echo $jumlah_pegawai; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="card card-statistic-1">
							<div class="card-icon bg-success">
								<i class="far fa-newspaper"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Jumlah Izin Cuti</h4>
								</div>
								<div class="card-body">
									<?php echo $jumlah_cuti; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="card card-statistic-1">
							<div class="card-icon bg-danger">
								<i class="far fa-file"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Jumlah Izin Sakit</h4>
								</div>
								<div class="card-body">
									<?php echo $jumlah_sakit; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="card card-statistic-1">
							<div class="card-icon bg-warning">
								<i class="far fa-file"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Jumlah Pegawai Lembur</h4>
								</div>
								<div class="card-body">
									<?php echo $jumlah_lembur; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="card card-primary">
							<div class="card-header">
								<h4>Pengajuan Surat Cuti</h4>
							</div>
							<div class="card-body">
								<?php foreach ($notif_cuti as $us): ?>
									<div class="info">
										<div class="row">
											<div class="col-6">
												<div class="details">
													<div><a href="<?= base_url() ?>PerizinanCuti/approvecuti">
													<?= $us['message']; ?></a></div>
												</div>
											</div>
											<div class="col">
												<div class="timestamp">
													<?= $us['created_at']; ?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card card-primary">
							<div class="card-header">
								<h4>Pengajuan Surat Sakit</h4>
							</div>
							<div class="card-body">
								<?php foreach ($notif_sakit as $us): ?>
									<div class="info">
										<div class="row">
											<div class="col-6">
												<div class="details">
												<div><a href="<?= base_url() ?>PerizinanSakit/approvesakit">
												<?= $us['message']; ?></a></div>
												</div>
											</div>
											<div class="col">
												<div class="timestamp">
													<?= $us['created_at']; ?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card card-primary">
							<div class="card-header">
								<h4>Pengajuan Surat Izin</h4>
							</div>
							<div class="card-body">
								<?php foreach ($notif_izin as $us): ?>
									<div class="info">
										<div class="row">
											<div class="col-6">
												<div class="details">
												<div><a href="<?= base_url() ?>PengajuanIzin/approveizin">
												<?= $us['message']; ?></a></div>
												</div>
											</div>
											<div class="col">
												<div class="timestamp">
													<?= $us['created_at']; ?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<!-- pegawai -->
				<?php } else if ($this->session->userdata('role') == 'guru' || $this->session->userdata('role') == 'pustakawati') { ?>
						<div class="row">
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="card card-statistic-1">
									<div class="card-icon bg-success">
										<i class="far fa-newspaper"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Jumlah Izin Cuti (Total)</h4>
										</div>
										<div class="card-body">
										<?php echo $jumlah_cuti_pegawai; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="card card-statistic-1">
									<div class="card-icon bg-danger">
										<i class="far fa-file"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Jumlah Izin Sakit (Total)</h4>
										</div>
										<div class="card-body">
										<?php echo $jumlah_sakit_pegawai; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="card card-statistic-1">
									<div class="card-icon bg-warning">
										<i class="far fa-file"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Jumlah Pegawai Lembur (Total)</h4>
										</div>
										<div class="card-body">
										<?php echo $jumlah_lembur_pegawai; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">

							<!-- chart guru - jumlah cuti sakit -->
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header border-0">
										<div class="d-flex justify-content-between">
											<h4 class="card-title">Izin Sakit </h4>
										</div>
									</div>
									<div class="card-body">
										<div class="d-flex- flex-row-reverse col-sm-4 ml-auto">
											<div class="input-group">
												<select style="width:20%;" id="search_sakitguru" name="keyword"
													class="form-control" value="<?= set_value('keyword'); ?>">
													<option class='text-center dropdown-toggle' value="">Semua</option>
												<?php foreach ($tahun as $p): ?>
														<option value="<?= $p; ?>">
														<?= $p; ?>
														</option>
												<?php endforeach; ?>>

												</select>
											</div>
											<p class="d-flex flex-column">

											</p>
											<p class="ml-auto d-flex flex-column text-right">

												<span class="text-muted"></span>
											</p>
										</div>
										<!-- /.d-flex -->

										<div class="d-flex flex-row-reverse col-sm-6 ml-auto">
											<div class='coba3'>
												<div id="sakit_guru" style="height:350px; width:500px;" height="163"></div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card -->
							</div>
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header border-0">
										<div class="d-flex justify-content-between">
											<h4 class="card-title">izin Cuti</h4>
										</div>


									</div>
									<div class="ml-4" style="color:red">
										<div class="d-flex justify-content-start">
											<div class="col-3">Sisa Izin Cuti : </div>
											<div id="sisa" class="col-2 text-success ml-0">
											<?php echo (22 - $jumlah_cuti_pegawai); ?>
											</div>
										</div>
									</div>

									<div class="card-body">
										<div class="d-flex- flex-row-reverse col-sm-4 ml-auto">
											<div class="input-group d-flex justify-content-between">
												<select style="width:20%;" id="search_cutiguru" name="keyword"
													class="form-control" value="<?= set_value('keyword'); ?>">
													<option class='text-center dropdown-toggle' value="">Semua</option>
												<?php foreach ($tahun as $p): ?>
														<option value="<?= $p; ?>">
														<?= $p; ?>
														</option>
												<?php endforeach; ?>>
												</select>
												</div>
											<p class="d-flex flex-column">
											</p>
											<p class="ml-auto d-flex flex-column text-right">
												<span class="text-muted"></span>
											</p>
										</div>
										<!-- /.d-flex -->

										<div class="d-flex flex-row-reverse col-sm-6 ml-auto">
											<div class='coba3'>
												<div id="cuti_guru" style="height:350px; width:500px;" height="163"></div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card -->
							</div>
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header border-0">
										<div class="d-flex justify-content-between">
											<h4 class="card-title">Absensi</h4>
										</div>
									</div>
									<div class="card-body">
										<div class="d-flex- flex-row-reverse col-sm-4 ml-auto">
											<div class="input-group">
												<select style="width:20%;" id="tahun_absen" name="keyword" class="form-control"
													value="<?= set_value('tahun_absen'); ?>">
													<option class='text-center dropdown-toggle' value="">Semua</option>
												<?php foreach ($tahun as $p): ?>
														<option value="<?= $p; ?>">
														<?= $p; ?>
														</option>
												<?php endforeach; ?>>

												</select>
											</div>
											<p class="d-flex flex-column">

											</p>
											<p class="ml-auto d-flex flex-column text-right">

												<span class="text-muted"></span>
											</p>
										</div>
										<!-- /.d-flex -->

										<div class="d-flex flex-row-reverse col-sm-6 ml-auto">
											<div class='chart_absen'>
												<div id="main_canvas_absen" style="height:350px; width:500px;" height="163">
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card -->
							</div>
						</div>
					</div>


					<!-- Tata Usaha -->
			<?php } else if ($this->session->userdata('role') == 'Admin') { ?>
						<div class="row">
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="card card-statistic-1">
									<div class="card-icon bg-primary">
										<i class="far fa-user"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Total Pegawai</h4>
										</div>
										<div class="card-body">
									<?php echo $jumlah_pegawai; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="card card-statistic-1">
									<div class="card-icon bg-success">
										<i class="far fa-newspaper"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Jumlah Izin Cuti</h4>
										</div>
										<div class="card-body">
									<?php echo $jumlah_cuti; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="card card-statistic-1">
									<div class="card-icon bg-danger">
										<i class="far fa-file"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Jumlah Izin Sakit</h4>
										</div>
										<div class="card-body">
									<?php echo $jumlah_sakit; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="card card-statistic-1">
									<div class="card-icon bg-warning">
										<i class="far fa-file"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Jumlah Pegawai Lembur</h4>
										</div>
										<div class="card-body">
									<?php echo $jumlah_lembur; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header border-0">
										<div class="d-flex justify-content-between">
											<h4 class="card-title">Jumlah Perizinan</h4>
										</div>
									</div>
									<div class="card-body" >
										<div class="d-flex- flex-row-reverse col-sm-4 ml-auto">
											<div class="input-group">
												<select style="width:20%;" id="Psearch1" name="keyword" class="form-control"
													value="<?= set_value('pelaksana'); ?>">
													<option class='text-center dropdown-toggle' value="">Semua</option>
											<?php foreach ($tahun as $p): ?>
														<option value="<?= $p; ?>">
													<?= $p; ?>
														</option>
											<?php endforeach; ?>>

												</select>
											</div>
											<p class="d-flex flex-column">

											</p>
											<p class="ml-auto d-flex flex-column text-right">

												<span class="text-muted"></span>
											</p>
										</div>
										<!-- /.d-flex -->

										<div class="d-flex flex-row-reverse col-sm-6 ml-auto">
											<div class='coba3'>
												<div id="colChart" style="height:350px; width:500px;" height="163"></div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card -->
							</div>
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header border-0" >
										<div class="d-flex justify-content-between">
											<h4 class="card-title">Absensi</h4>
										</div>
									</div>
									<div class="card-body" >
										<div class="d-flex- flex-row-reverse col-sm-4 ml-auto">
											<div class="input-group">
												<select style="width:20%;" id="tahun_absen" name="keyword" class="form-control"
													value="<?= set_value('tahun_absen'); ?>">
													<option class='text-center dropdown-toggle' value="">Semua</option>
											<?php foreach ($tahun as $p): ?>
														<option value="<?= $p; ?>">
													<?= $p; ?>
														</option>
											<?php endforeach; ?>>

												</select>
											</div>
											<p class="d-flex flex-column">

											</p>
											<p class="ml-auto d-flex flex-column text-right">

												<span class="text-muted"></span>
											</p>
										</div>
										<!-- /.d-flex -->

										<div class="d-flex flex-row-reverse col-sm-6 ml-auto">
											<div class='chart_absen'>
												<div id="main_canvas_absen" style="height:350px; width:500px;" height="163">
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card -->
							</div>
						</div>
			<?php } else { ?>

			<?php } ?>



		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.7.1.js"
		integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function () {
			let tahun = '';

			//dashboard TU - perizinan
			$.ajax({
				url: '<?php echo base_url('Dashboard/getPerizinan'); ?>',
				type: 'GET',
				data: {
					tahun: tahun
				},
				dataType: 'json',
				success: function (response) {
					// alert(response);
					// Tampilkan data yang diterima dari server
					var month_1 = response['month_1']
					var month_2 = response['month_2']
					var month_3 = response['month_3']
					var month_4 = response['month_4']
					var month_5 = response['month_5']
					var month_6 = response['month_6']
					var month_7 = response['month_7']
					var month_8 = response['month_8']
					var month_9 = response['month_9']
					var month_10 = response['month_10']
					var month_11 = response['month_11']
					var month_12 = response['month_12']

					var month_1_ = response['month_1_']
					var month_2_ = response['month_2_']
					var month_3_ = response['month_3_']
					var month_4_ = response['month_4_']
					var month_5_ = response['month_5_']
					var month_6_ = response['month_6_']
					var month_7_ = response['month_7_']
					var month_8_ = response['month_8_']
					var month_9_ = response['month_9_']
					var month_10_ = response['month_10_']
					var month_11_ = response['month_11_']
					var month_12_ = response['month_12_']

					google.charts.load('current', {
						'packages': ['bar']
					});
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {
						var data = google.visualization.arrayToDataTable([
							['Bulan', 'Cuti', 'Sakit'],
							['Januari', month_1, month_1],
							['Februari', month_2, month_2_],
							['Maret', month_3, month_3_],
							['April', month_4, month_4_],
							['Mei', month_5, month_5_],
							['Juni', month_6, month_6_],
							['Juli', month_7, month_7_],
							['Agustus', month_8, month_8_],
							['September', month_9, month_9_],
							['Oktober', month_10, month_10_],
							['November', month_11, month_11_],
							['Desember', month_12, month_12_]
						]);

						var options = {
							chart: {
								title: 'Per Bulan',
								subtitle: 'Perizinan Surat Cuti dan Sakit',
							}
						};

						var chart = new google.charts.Bar(document.getElementById('colChart'));

						chart.draw(data, google.charts.Bar.convertOptions(options));
					}


				},
				error: function (xhr, textStatus, errorThrown) {
					if (xhr.status === 500) {
						// Kesalahan server internal, tampilkan pesan kesalahan
						alert('Terjadi kesalahan saat mengambil data1: ');
					} else {
						// Kesalahan lainnya, tampilkan pesan kesalahan umum
						alert('Terjadi kesalahan saat mengambil data.');
					}
				}
			});
			$('#Psearch1').change(function () {
				var tahun = $(this).val().toLowerCase();
				$.ajax({
					url: '<?php echo base_url('Dashboard/getPerizinan'); ?>',
					type: 'GET',
					data: {
						tahun: tahun
					},
					dataType: 'json',
					success: function (response) {
						// alert(response);
						// Tampilkan data yang diterima dari server
						var month_1 = response['month_1']
						var month_2 = response['month_2']
						var month_3 = response['month_3']
						var month_4 = response['month_4']
						var month_5 = response['month_5']
						var month_6 = response['month_6']
						var month_7 = response['month_7']
						var month_8 = response['month_8']
						var month_9 = response['month_9']
						var month_10 = response['month_10']
						var month_11 = response['month_11']
						var month_12 = response['month_12']

						var month_1_ = response['month_1_']
						var month_2_ = response['month_2_']
						var month_3_ = response['month_3_']
						var month_4_ = response['month_4_']
						var month_5_ = response['month_5_']
						var month_6_ = response['month_6_']
						var month_7_ = response['month_7_']
						var month_8_ = response['month_8_']
						var month_9_ = response['month_9_']
						var month_10_ = response['month_10_']
						var month_11_ = response['month_11_']
						var month_12_ = response['month_12_']

						google.charts.load('current', {
							'packages': ['bar']
						});
						google.charts.setOnLoadCallback(drawChart);

						function drawChart() {
							var data = google.visualization.arrayToDataTable([
								['Bulan', 'Cuti', 'Sakit'],
								['Januari', month_1, month_1],
								['Februari', month_2, month_2_],
								['Maret', month_3, month_3_],
								['April', month_4, month_4_],
								['Mei', month_5, month_5_],
								['Juni', month_6, month_6_],
								['Juli', month_7, month_7_],
								['Agustus', month_8, month_8_],
								['September', month_9, month_9_],
								['Oktober', month_10, month_10_],
								['November', month_11, month_11_],
								['Desember', month_12, month_12_]
							]);

							var options = {
								chart: {
									title: 'Per Bulan',
									subtitle: 'Perizinan Surat Cuti dan Sakit',
								}
							};

							var chart = new google.charts.Bar(document.getElementById('colChart'));

							chart.draw(data, google.charts.Bar.convertOptions(options));
							chart1.draw(data, google.charts.Bar.convertOptions(options));
						}


					},
					error: function (xhr, textStatus, errorThrown) {
						if (xhr.status === 500) {
							// Kesalahan server internal, tampilkan pesan kesalahan
							alert('Terjadi kesalahan saat mengambil data1: ');
						} else {
							// Kesalahan lainnya, tampilkan pesan kesalahan umum
							alert('Terjadi kesalahan saat mengambil data.');
						}
					}
				});
			})
			//dashboard TU - Absen
			$.ajax({
				url: '<?php echo base_url('Dashboard/getAbsen'); ?>',
				type: 'GET',
				data: {
					tahun: tahun
				},
				dataType: 'json',
				success: function (response) {
					// alert(response);
					// Tampilkan data yang diterima dari server
					var month_1 = response['month_1']
					var month_2 = response['month_2']
					var month_3 = response['month_3']
					var month_4 = response['month_4']
					var month_5 = response['month_5']
					var month_6 = response['month_6']
					var month_7 = response['month_7']
					var month_8 = response['month_8']
					var month_9 = response['month_9']
					var month_10 = response['month_10']
					var month_11 = response['month_11']
					var month_12 = response['month_12']

					var month_1_ = response['month_1_']
					var month_2_ = response['month_2_']
					var month_3_ = response['month_3_']
					var month_4_ = response['month_4_']
					var month_5_ = response['month_5_']
					var month_6_ = response['month_6_']
					var month_7_ = response['month_7_']
					var month_8_ = response['month_8_']
					var month_9_ = response['month_9_']
					var month_10_ = response['month_10_']
					var month_11_ = response['month_11_']
					var month_12_ = response['month_12_']

					var month_1_A = response['month_1_A']
					var month_2_A = response['month_2_A']
					var month_3_A = response['month_3_A']
					var month_4_A = response['month_4_A']
					var month_5_A = response['month_5_A']
					var month_6_A = response['month_6_A']
					var month_7_A = response['month_7_A']
					var month_8_A = response['month_8_A']
					var month_9_A = response['month_9_A']
					var month_10_A = response['month_10_A']
					var month_11_A = response['month_11_A']
					var month_12_A = response['month_12_A']
					google.charts.load('current', {
						'packages': ['bar']
					});
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {
						var data = google.visualization.arrayToDataTable([
							['Bulan', 'Hadir', 'Telat', 'Tidak Hadir'],
							['Januari', month_1, month_1, month_1_A],
							['Februari', month_2, month_2_, month_2_A],
							['Maret', month_3, month_3_, month_3_A],
							['April', month_4, month_4_, month_4_A],
							['Mei', month_5, month_5_, month_5_A],
							['Juni', month_6, month_6_, month_6_A],
							['Juli', month_7, month_7_, month_7_A],
							['Agustus', month_8, month_8_, month_8_A],
							['September', month_9, month_9_, month_9_A],
							['Oktober', month_10, month_10_, month_11_A],
							['November', month_11, month_11_, month_11_A],
							['Desember', month_12, month_12_, month_12_A]
						]);

						var options = {
							chart: {
								title: 'Per Bulan',
								subtitle: 'Absensi',
							}
						};

						var chart = new google.charts.Bar(document.getElementById('main_canvas_absen'));

						chart.draw(data, google.charts.Bar.convertOptions(options));
					}


				},
				error: function (xhr, textStatus, errorThrown) {
					if (xhr.status === 500) {
						// Kesalahan server internal, tampilkan pesan kesalahan
						alert('Terjadi kesalahan saat mengambil data1: ');
					} else {
						// Kesalahan lainnya, tampilkan pesan kesalahan umum
						alert('Terjadi kesalahan saat mengambil data.');
					}
				}
			});
			$('#tahun_absen').change(function () {
				var tahun = $(this).val().toLowerCase();
				$.ajax({
					url: '<?php echo base_url('Dashboard/getAbsen'); ?>',
					type: 'GET',
					data: {
						tahun: tahun
					},
					dataType: 'json',
					success: function (response) {
						// alert(response);
						// Tampilkan data yang diterima dari server
						var month_1 = response['month_1']
						var month_2 = response['month_2']
						var month_3 = response['month_3']
						var month_4 = response['month_4']
						var month_5 = response['month_5']
						var month_6 = response['month_6']
						var month_7 = response['month_7']
						var month_8 = response['month_8']
						var month_9 = response['month_9']
						var month_10 = response['month_10']
						var month_11 = response['month_11']
						var month_12 = response['month_12']

						var month_1_ = response['month_1_']
						var month_2_ = response['month_2_']
						var month_3_ = response['month_3_']
						var month_4_ = response['month_4_']
						var month_5_ = response['month_5_']
						var month_6_ = response['month_6_']
						var month_7_ = response['month_7_']
						var month_8_ = response['month_8_']
						var month_9_ = response['month_9_']
						var month_10_ = response['month_10_']
						var month_11_ = response['month_11_']
						var month_12_ = response['month_12_']

						var month_1_A = response['month_1_A']
						var month_2_A = response['month_2_A']
						var month_3_A = response['month_3_A']
						var month_4_A = response['month_4_A']
						var month_5_A = response['month_5_A']
						var month_6_A = response['month_6_A']
						var month_7_A = response['month_7_A']
						var month_8_A = response['month_8_A']
						var month_9_A = response['month_9_A']
						var month_10_A = response['month_10_A']
						var month_11_A = response['month_11_A']
						var month_12_A = response['month_12_A']
						google.charts.load('current', {
							'packages': ['bar']
						});
						google.charts.setOnLoadCallback(drawChart);

						function drawChart() {
							var data = google.visualization.arrayToDataTable([
								['Bulan', 'Hadir', 'Telat', 'Tidak Hadir'],
								['Januari', month_1, month_1, month_1_A],
								['Februari', month_2, month_2_, month_2_A],
								['Maret', month_3, month_3_, month_3_A],
								['April', month_4, month_4_, month_4_A],
								['Mei', month_5, month_5_, month_5_A],
								['Juni', month_6, month_6_, month_6_A],
								['Juli', month_7, month_7_, month_7_A],
								['Agustus', month_8, month_8_, month_8_A],
								['September', month_9, month_9_, month_9_A],
								['Oktober', month_10, month_10_, month_11_A],
								['November', month_11, month_11_, month_11_A],
								['Desember', month_12, month_12_, month_12_A]
							]);

							var options = {
								chart: {
									title: 'Per Bulan',
									subtitle: 'Absensi',
								}
							};

							var chart = new google.charts.Bar(document.getElementById('main_canvas_absen'));

							chart.draw(data, google.charts.Bar.convertOptions(options));
						}


					},
					error: function (xhr, textStatus, errorThrown) {
						if (xhr.status === 500) {
							// Kesalahan server internal, tampilkan pesan kesalahan
							alert('Terjadi kesalahan saat mengambil data1: ');
						} else {
							// Kesalahan lainnya, tampilkan pesan kesalahan umum
							alert('Terjadi kesalahan saat mengambil data.');
						}
					}
				});
			})

			//dashboard guru - perizinan sakit
			$.ajax({
				url: '<?php echo base_url('Dashboard/getsakit_guru'); ?>',
				type: 'GET',
				data: {
					tahun: tahun
				},
				dataType: 'json',
				success: function (response) {
					// alert(response);
					// Tampilkan data yang diterima dari server
					var month_1_ = response['month_1_']
					var month_2_ = response['month_2_']
					var month_3_ = response['month_3_']
					var month_4_ = response['month_4_']
					var month_5_ = response['month_5_']
					var month_6_ = response['month_6_']
					var month_7_ = response['month_7_']
					var month_8_ = response['month_8_']
					var month_9_ = response['month_9_']
					var month_10_ = response['month_10_']
					var month_11_ = response['month_11_']
					var month_12_ = response['month_12_']

					google.charts.load('current', {
						'packages': ['bar']
					});
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {
						var data = google.visualization.arrayToDataTable([
							['Bulan', 'Sakit'],
							['Januari', month_1_],
							['Februari', month_2_],
							['Maret', month_3_],
							['April', month_4_],
							['Mei', month_5_],
							['Juni', month_6_],
							['Juli', month_7_],
							['Agustus', month_8_],
							['September', month_9_],
							['Oktober', month_10_],
							['November', month_11_],
							['Desember', month_12_]
						]);

						var options = {
							chart: {
								title: 'Per Bulan',
								subtitle: 'Perizinan  Sakit',
							}
						};

						var chart1 = new google.charts.Bar(document.getElementById('sakit_guru'));

						chart1.draw(data, google.charts.Bar.convertOptions(options));
					}


				},
				error: function (xhr, textStatus, errorThrown) {
					if (xhr.status === 500) {
						// Kesalahan server internal, tampilkan pesan kesalahan
						alert('Terjadi kesalahan saat mengambil data1: ');
					} else {
						// Kesalahan lainnya, tampilkan pesan kesalahan umum
						alert('Terjadi kesalahan saat mengambil data.');
					}
				}
			});
			$('#search_sakitguru').change(function () {
				var tahun = $(this).val().toLowerCase();
				$.ajax({
					url: '<?php echo base_url('Dashboard/getsakit_guru'); ?>',
					type: 'GET',
					data: {
						tahun: tahun
					},
					dataType: 'json',
					success: function (response) {
						// alert(response);
						// Tampilkan data yang diterima dari server
						var month_1_ = response['month_1_']
						var month_2_ = response['month_2_']
						var month_3_ = response['month_3_']
						var month_4_ = response['month_4_']
						var month_5_ = response['month_5_']
						var month_6_ = response['month_6_']
						var month_7_ = response['month_7_']
						var month_8_ = response['month_8_']
						var month_9_ = response['month_9_']
						var month_10_ = response['month_10_']
						var month_11_ = response['month_11_']
						var month_12_ = response['month_12_']

						google.charts.load('current', {
							'packages': ['bar']
						});
						google.charts.setOnLoadCallback(drawChart2);

						function drawChart2() {
							var data = google.visualization.arrayToDataTable([
								['Bulan', 'Sakit'],
								['Januari', month_1_],
								['Februari', month_2_],
								['Maret', month_3_],
								['April', month_4_],
								['Mei', month_5_],
								['Juni', month_6_],
								['Juli', month_7_],
								['Agustus', month_8_],
								['September', month_9_],
								['Oktober', month_10_],
								['November', month_11_],
								['Desember', month_12_]
							]);

							var options = {
								chart: {
									title: 'Per Bulan',
									subtitle: 'Perizinan  Sakit',
								}
							};

							var chart = new google.charts.Bar(document.getElementById('sakit_guru'));

							chart.draw(data, google.charts.Bar.convertOptions(options));
						}


					},
					error: function (xhr, textStatus, errorThrown) {
						if (xhr.status === 500) {
							// Kesalahan server internal, tampilkan pesan kesalahan
							alert('Terjadi kesalahan saat mengambil data1: ');
						} else {
							// Kesalahan lainnya, tampilkan pesan kesalahan umum
							alert('Terjadi kesalahan saat mengambil data.');
						}
					}
				});
			})

			//dashboard guru - perizinan cuti
			$.ajax({
				url: '<?php echo base_url('Dashboard/getcuti_guru'); ?>',
				type: 'GET',
				data: {
					tahun: tahun
				},
				dataType: 'json',
				success: function (response) {
					// alert(response);
					// Tampilkan data yang diterima dari server
					var month_1_ = response['month_1_']
					var month_2_ = response['month_2_']
					var month_3_ = response['month_3_']
					var month_4_ = response['month_4_']
					var month_5_ = response['month_5_']
					var month_6_ = response['month_6_']
					var month_7_ = response['month_7_']
					var month_8_ = response['month_8_']
					var month_9_ = response['month_9_']
					var month_10_ = response['month_10_']
					var month_11_ = response['month_11_']
					var month_12_ = response['month_12_']

					google.charts.load('current', {
						'packages': ['bar']
					});
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {
						var data = google.visualization.arrayToDataTable([
							['Bulan', 'Sakit'],
							['Januari', month_1_],
							['Februari', month_2_],
							['Maret', month_3_],
							['April', month_4_],
							['Mei', month_5_],
							['Juni', month_6_],
							['Juli', month_7_],
							['Agustus', month_8_],
							['September', month_9_],
							['Oktober', month_10_],
							['November', month_11_],
							['Desember', month_12_]
						]);

						var options = {
							chart: {
								title: 'Per Bulan',
								subtitle: 'Perizinan  Cuti',
							}
						};

						var chart1 = new google.charts.Bar(document.getElementById('cuti_guru'));

						chart1.draw(data, google.charts.Bar.convertOptions(options));
					}


				},
				error: function (xhr, textStatus, errorThrown) {
					if (xhr.status === 500) {
						// Kesalahan server internal, tampilkan pesan kesalahan
						alert('Terjadi kesalahan saat mengambil data1: ');
					} else {
						// Kesalahan lainnya, tampilkan pesan kesalahan umum
						alert('Terjadi kesalahan saat mengambil data.');
					}
				}
			});
			$('#search_cutiguru').change(function () {
				var tahun = $(this).val().toLowerCase();
				$.ajax({
					url: '<?php echo base_url('Dashboard/getcuti_guru'); ?>',
					type: 'GET',
					data: {
						tahun: tahun
					},
					dataType: 'json',
					success: function (response) {
						// alert(response);
						// Tampilkan data yang diterima dari server
						var month_1_ = response['month_1_']
						var month_2_ = response['month_2_']
						var month_3_ = response['month_3_']
						var month_4_ = response['month_4_']
						var month_5_ = response['month_5_']
						var month_6_ = response['month_6_']
						var month_7_ = response['month_7_']
						var month_8_ = response['month_8_']
						var month_9_ = response['month_9_']
						var month_10_ = response['month_10_']
						var month_11_ = response['month_11_']
						var month_12_ = response['month_12_']

						google.charts.load('current', {
							'packages': ['bar']
						});
						google.charts.setOnLoadCallback(drawChart2);

						function drawChart2() {
							var data = google.visualization.arrayToDataTable([
								['Bulan', 'Sakit'],
								['Januari', month_1_],
								['Februari', month_2_],
								['Maret', month_3_],
								['April', month_4_],
								['Mei', month_5_],
								['Juni', month_6_],
								['Juli', month_7_],
								['Agustus', month_8_],
								['September', month_9_],
								['Oktober', month_10_],
								['November', month_11_],
								['Desember', month_12_]
							]);

							var options = {
								chart: {
									title: 'Per Bulan',
									subtitle: 'Perizinan  Cuti',
								}
							};
							let terpakai = month_1_ + month_2_ + month_3_ + month_4_ + month_5_ + month_6_ + month_7_ + month_8_ + month_9_ + month_10_ + month_11_ + month_12_;
							var sisa = document.getElementById('sisa')
							var sisaCuti = 22 - terpakai;

							// Isi teks dari elemen div
							sisa.textContent = sisaCuti;

							var chart = new google.charts.Bar(document.getElementById('cuti_guru'));

							chart.draw(data, google.charts.Bar.convertOptions(options));
						}


					},
					error: function (xhr, textStatus, errorThrown) {
						if (xhr.status === 500) {
							// Kesalahan server internal, tampilkan pesan kesalahan
							alert('Terjadi kesalahan saat mengambil data1: ');
						} else {
							// Kesalahan lainnya, tampilkan pesan kesalahan umum
							alert('Terjadi kesalahan saat mengambil data.');
						}
					}
				});
			})
		});
	</script>



	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load("current", {
			packages: ["corechart"]
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Task', 'Hours per Day'],
				['Work', 11],
				['Eat', 2],
				['Commute', 2],
				['Watch TV', 2],
				['Sleep', 7]
			]);

			var options = {
				title: 'My Daily Activities',
				pieHole: 0.4,
			};

			var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
			chart.draw(data, options);

			var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
			chart.draw(data, options);
		}
	</script>
	<!-- <script type="text/javascript">
		google.charts.load('current', { 'packages': ['bar'] });
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Bulan', 'Cuti', 'Sakit'],
				['Januari', 1000, 400],
				['Februari', 1170, 469],
				['Maret', 660, 1120],
				['April', 660, 1120],
				['Mei', 660, 1120],
				['Juni', 660, 1120],
				['Juli', 660, 1120],
				['Agustus', 660, 1120],
				['September', 660, 1120],
				['Oktober', 660, 1120],
				['November', 660, 1120],
				['Desember', 1030, 540]
			]);

			var options = {
				chart: {
					title: 'Per Bulan',
					subtitle: 'Perizinan Surat Cuti dan Sakit',
				}
			};

			var chart = new google.charts.Bar(document.getElementById('colChart'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		}
	</script> -->
