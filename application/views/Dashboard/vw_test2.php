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
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Dashboard</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">Modules</a></div>
				<div class="breadcrumb-item">Chart.js</div>
			</div>
		</div>

		<div class="section-body">
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
			<div class="row">
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header border-0">
							<div class="d-flex justify-content-between">
								<h4 class="card-title">Jumlah Perizinan</h4>
							</div>
						</div>
						<div class="card-body">
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
						<div class="card-header border-0">
							<div class="d-flex justify-content-between">
								<h4 class="card-title">Jabatan</h4>
							</div>
						</div>
						<div class="card-body">
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
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
		crossorigin="anonymous"></script>
	<script>
		$(document).ready(function () {
			let tahun = '';
			$.ajax({
				url: '<?php echo base_url('Dashboard/getPerizinan'); ?>',
				type: 'GET',
				data: { tahun: tahun },
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

					google.charts.load('current', { 'packages': ['bar'] });
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
					data: { tahun: tahun },
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

						google.charts.load('current', { 'packages': ['bar'] });
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
			})
		});
	</script>



	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load("current", { packages: ["corechart"] });
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