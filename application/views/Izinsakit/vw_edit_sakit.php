<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
     
     <!-- Main Content -->
     <?= $this->session->flashdata('message'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Surat Perizinan</h1>
          </div>

          <div class="section-body">
          <div class="card">
                  <div class="card-header">
                    <h4>Edit Surat Perizinan</h4>
                  </div>
                  <div class="card-body">
                  <form id="myForm" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $izin_sakit['id'] ?> ">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nama Pegawai</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai['nama']; ?>" placeholder="Nama Pegawai" disabled>
          
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Tanggal Izin</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="<?= $izin_sakit['tgl_izin']; ?>" placeholder="Tanggal Izin" disabled>
          
        </div>
        <label class="col-sm-1 col-form-label">Hingga</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" id="hingga_tgl" name="hingga_tgl" value="<?= $izin_sakit['hingga_tgl']; ?>" placeholder="Tanggal Izin" disabled>
         
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Keterangan Sakit</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="ket_sakit" name="ket_sakit" value="<?= $izin_sakit['ket_sakit']; ?>" placeholder="Keterangan Sakit" disabled> 
           
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Upload Surat Sakit</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="file_sakit" id="file_sakit">
            <?= form_error('file_sakit', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <a href="<?= base_url('PerizinanSakit') ?>" class="btn btn-light">Tutup</a>
    <button type="submit" name="tambah" class="btn btn-primary float-right" onclick="confirmSubmit(event)">Simpan</button>
</form>

<script>
    function confirmSubmit(event) {
        event.preventDefault(); // Prevent the form from submitting immediately
        Swal.fire({
            title: 'Konfirmasi Aksi',
            text: "Aksi ini tidak dapat diubah, apakah anda yakin?",
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
