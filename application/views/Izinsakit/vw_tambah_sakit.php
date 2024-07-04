<!-- Main Content -->
<?= $this->session->flashdata('message'); ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Surat Perizinan Sakit</h1>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <h4>Form Surat Perizinan</h4>
        </div>
        <div class="card-body">
          <form id="myForm" method="POST" action="<?= base_url('perizinansakit/tambahsakit') ?>" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Pegawai</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai['nama']; ?>" placeholder="Nama Pegawai" disabled>
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tanggal Izin</label>
              <div class="col-sm-4">
                <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="" placeholder="Tanggal Izin">
                <?= form_error('tgl_izin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <label class="col-sm-1 col-form-label">Hingga</label>
              <div class="col-sm-4">
                <input type="date" class="form-control" id="hingga_tgl" name="hingga_tgl" value="" placeholder="Tanggal Izin">
                <?= form_error('hingga_tgl', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Keterangan Sakit</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ket_sakit" name="ket_sakit" value="" placeholder="Keterangan Sakit">
                <?= form_error('ket_sakit', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Upload Surat Sakit</label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="file_sakit" id="file_sakit">
                <?= form_error('file_sakit', '<small class="text-danger pl-3">', '</small>'); ?>
                <!--  <div class="custom-file-label" for="customFile"> -->

              </div>
            </div>
            <a href="<?= base_url('PerizinanSakit') ?>" class="btn btn-light">Tutup</a>
            <button type="button" name="tambah" class="btn btn-primary float-right" onclick="confirmSubmit()">Simpan</button>
          </form>
        </div>
      </div>
  </section>
</div>

 </div>
  </div>

<script>
  function confirmSubmit() {
    Swal.fire({
      title: 'Konfirmasi Aksi',
      text: "Aksi ini tidak dapat di ubah, apakah anda yakin?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, lanjutkan!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('myForm').submit(); // Submit the form
      }
    })
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>