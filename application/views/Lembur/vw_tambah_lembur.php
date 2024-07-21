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
          <h4>Tambah Data Lembur</h4>
        </div>
        <div class="card-body">
          <form id="myForm" method="POST" action="<?= base_url('Lembur/tambah_lembur') ?>">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Pegawai</label>
              <div class="col-sm-9">
                <select class="form-control" id="niy" name="niy">
                  <option value="">Pilih Nama Pegawai</option>
                  <?php foreach ($pegawai_data as $p) : ?>
                    <option value="<?= $p['niy']; ?>"><?= $p['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
                <?= form_error('niy', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tanggal</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="" placeholder="Tanggal">
                <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Masuk</label>
              <div class="col-sm-9">
                <input type="time" class="form-control" id="masuk" name="masuk" value="" placeholder="Masuk">
                <?= form_error('masuk', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Pulang</label>
              <div class="col-sm-9">
                <input type="time" class="form-control" id="pulang" name="pulang" value="" placeholder="Pulang">
                <?= form_error('pulang', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Lama Lembur</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="lama_lembur" name="lama_lembur" value="" placeholder="Lama Lembur" readonly>
                <?= form_error('lama_lembur', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Keterangan Lembur</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ket_lembur" name="ket_lembur" value="" placeholder="Keterangan Lembur">
                <?= form_error('ket_lembur', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <a href="<?= base_url('Lembur') ?>" class="btn btn-light">Tutup</a>
            <button type="submit" name="tambah" class="btn btn-primary float-right" onclick="confirmSubmit()">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
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

    // Add event listener for form submission
    $('#myForm').on('submit', function(e) {
      e.preventDefault(); // Prevent the default form submission

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
          this.submit(); // Submit the form after confirmation
        }
      });
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>