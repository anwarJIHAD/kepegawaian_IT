<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
	crossorigin="anonymous"></script>


<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h5>Data Absensi</h5>
		</div>
		<script>
			function tampilkan() {
				var div = document.getElementById("uploud");
				if (div.style.display === "none") {
					div.style.display = "block";
				} else {
					div.style.display = "none";
				}

			}

		</script>
		<?= $this->session->flashdata('message'); ?>
		<div class="section-body">
			<div class="card">
				<div class="card-body">
					<div style="margin-bottom: 20px;">
						<?php if ($pegawai['role'] == 'Admin') { ?>

							<button class="btn btn-outline-warning" data-bs-target="#exampleModal">
								<i class="bi bi-plus-circle" onclick="tampilkan()">Uploud Excel</i>
							</button>
						<?php } ?>
					</div>

					<!-- <div class="modal modal-dialog-centered" id="exampleModal">
						...
					</div> -->
					<div class="d-flex justify-content-center">
						<?= $this->session->flashdata('message'); ?>
						<div class="col-lg-4 col-md-6 col-sm-8 col-12" id="uploud" style="display: none;">
							<div class="card mb-4" style="background-color:#a8f5b4">
								<h5 class="card-header text-center">Masukkan Data Absensi</h5>
								<div class="card-body">
									<form id="uploadForm" action="Absensi/upload" method="POST" enctype="multipart/form-data">
										<div class="drop-area" id="dropArea">
											<p>Drag and drop Excel file here, or click to choose file</p>
											<input type="file" id="excelFileInput" name="excelFile" accept=".csv,.xls,.xlsx"
												style="display: none;">
										</div>
										<div class="d-flex justify-content-center">
											<div class="file-preview" id="filePreview"></div>
										</div>
										<div class="d-flex justify-content-center">
											<button type="submit" class="btn rounded-pill btn-primary submit-btn ml-3">Upload</button>
											<button onclick="tampilkan()" type="button"
												class="btn rounded-pill btn-warning submit-btn ml-3">Cancel</button>
										</div>
									</form>
									<script>
										const dropzone = document.getElementById('dropArea');
										const fileInput = document.getElementById('excelFileInput');
										const filePreview = document.getElementById('filePreview');
										const uploadForm = document.getElementById('uploadForm');

										// Klik untuk memilih file
										dropzone.addEventListener('click', () => {
											fileInput.click();
										});

										// Drag over event
										dropzone.addEventListener('dragover', (e) => {
											e.preventDefault();
											dropzone.classList.add('dragover');
										});

										// Drag leave event
										dropzone.addEventListener('dragleave', (e) => {
											e.preventDefault();
											dropzone.classList.remove('dragover');
										});

										// Drop event
										dropzone.addEventListener('drop', (e) => {
											e.preventDefault();
											dropzone.classList.remove('dragover');
											const files = e.dataTransfer.files;
											if (files.length) {
												validateAndPreviewFile(files[0]);
											}
										});

										// Change event when file is selected using file input
										fileInput.addEventListener('change', (e) => {
											const files = e.target.files;
											if (files.length) {
												validateAndPreviewFile(files[0]);
											}
										});

										function validateAndPreviewFile(file) {
											const allowedExtensions = /(\.xls|\.xlsx|\.csv)$/i;
											if (!allowedExtensions.exec(file.name)) {
												alert('Invalid file type! Please upload an Excel file.');
												fileInput.value = '';
												filePreview.innerHTML = '';
												return;
											}

											showFilePreview(file);
										}

										function showFilePreview(file) {
											filePreview.innerHTML = '';
											const fileType = file.type;

											let icon = '';
											if (fileType.includes('spreadsheet') || fileType.includes('excel')) {
												icon = 'https://img.icons8.com/color/48/000000/ms-excel.png'; // Excel icon
											} else if (fileType.includes('csv')) {
												icon = 'https://img.icons8.com/color/48/000000/csv.png'; // CSV icon
											} else {
												icon = 'https://img.icons8.com/color/48/000000/document.png'; // Default document icon
											}

											filePreview.innerHTML = `<img src="${icon}" alt="File Icon"><span>${file.name}</span>`;
										}

										// Handle form submit
										uploadForm.addEventListener('submit', (e) => {
											if (!fileInput.files.length) {
												e.preventDefault();
												alert('Please select a file before submitting.');
											}
										});
									</script>

								</div>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;"
							id="table-1">
							<thead>
								<tr class="table-success">
									<th>No</th>
									<th>Nama Pegawai</th>
									<th>Tanggal</th>
									<th>Jam Datang</th>
									<th>Jam Pulang</th>
									<th>Pulang Awal</th>
									<th>Waktu Kerja</th>
									<th>Status Kehadiran</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($absensi as $us): ?>
									<tr>
										<td> <?= $i; ?>.</td>
										<td><?= $us['nama']; ?></td>
										<td><?= $us['tanggal']; ?></td>
										<td><?= $us['waktu_datang']; ?></td>
										<td><?= $us['waktu_pulang']; ?></td>
										<td><?= $us['pulang_awal']; ?></td>
										<td><?= $us['waktu_kerja']; ?></td>
										<td><?= $us['status']; ?></td>
										<td><?= $us['keterangan']; ?></td>
										<td> <?php if ($pegawai['role'] == 'Admin') { ?>
												<a href="<?= base_url('Absensi/edit_absensi/') . $us['id']; ?>" class="btn btn-light btn-sm mr-1"><i
														class="bi bi-pencil-square"></i> Edit</a>
												<a href="<?= base_url('Absensi/hapus/') . $us['id']; ?>" class="btn btn-danger btn-sm"><i
														class="bi bi-trash"></i> Hapus</a><?php } else { ?> -<?php } ?>
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
<script>
	function confirm_delete(question) {

		if (confirm(question)) {

			alert("Action to delete");

		} else {
			return false;
		}

	}
</script>
