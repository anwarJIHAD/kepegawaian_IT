<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          <h4>Form Surat Perizinan</h4>
        </div>
        <div class="card-body">
          <form id="myForm" method="POST" action="<?= base_url('PengajuanIzin/tambahizin') ?>">
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
              <label class="col-sm-3 col-form-label">Waktu Izin</label>
              <div class="col-sm-4">
                <input type="time" class="form-control" id="waktu_izin" name="waktu_izin" value="" placeholder="Waktu Izin">
                <?= form_error('waktu_izin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <label class="col-sm-1 col-form-label">Hingga</label>
              <div class="col-sm-4">
                <input type="time" class="form-control" id="hingga_waktu" name="hingga_waktu" value="" placeholder="Waktu Izin">
                <?= form_error('hingga_waktu', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Lama Izin</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="lama_izin" name="lama_izin" value="" placeholder="Lama Izin" readonly>
                <?= form_error('lama_izin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jenis Izin</label>
              <div class="col-sm-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jenis_izin" id="exampleRadios1" value="Izin Dinas" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Izin Dinas
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jenis_izin" id="exampleRadios2" value="Izin Pribadi">
                  <label class="form-check-label" for="exampleRadios2">
                    Izin Pribadi
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tujuan Izin</label>
              <div class="col-sm-9">
                <select class="form-control" id="tujuan_izin" name="tujuan_izin" onchange="checkOtherOption()">
                  <option>Tidak Hadir ke Sekolah</option>
                  <option>Terlambat Hadir ke Sekolah</option>
                  <option>Izin Keluar</option>
                  <option>Pulang Cepat</option>
                  <option>Terlambat Hadir Rapat</option>
                  <option>Tidak Ikut Rapat</option>
                  <option>Others</option>
                </select>
                <input type="text" class="form-control" id="other_input" name="other_input" style="display:none; margin-top: 10px;" placeholder="Please specify" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Alasan Izin</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="alasan_izin" name="alasan_izin" placeholder="Alasan Izin">
                <?= form_error('alasan_izin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <a href="<?= base_url('PengajuanIzin') ?>" class="btn btn-light">Tutup</a>
            <button type="button" name="tambah" class="btn btn-primary float-right" onclick="confirmSubmit()">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  function checkOtherOption() {
    var selectElement = document.getElementById("tujuan_izin");
    console.log(selectElement)
    var otherInput = document.getElementById("other_input");

    if (selectElement.value === "Others") {
      otherInput.style.display = "block";
    } else {
      otherInput.style.display = "none";
    }
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            function calculatePengajuanIzin() {
                let waktu_izin = $('#waktu_izin').val();
                let hingga_waktu = $('#hingga_waktu').val();
                console.log(waktu_izin,hingga_waktu)

                if (waktu_izin && hingga_waktu) {
                    let waktu_izinTime = new Date(`1970-01-01T${waktu_izin}:00`);
                    let hingga_waktuTime = new Date(`1970-01-01T${hingga_waktu}:00`);

                    if (hingga_waktuTime < waktu_izinTime) {
                        hingga_waktuTime.setDate(hingga_waktuTime.getDate() + 1);
                    }

                    let diff = hingga_waktuTime - waktu_izinTime;
                    let hours = Math.floor(diff / 1000 / 60 / 60);
                    let minutes = Math.floor((diff / 1000 / 60) % 60);

                    $('#lama_izin').val(`${hours} jam ${minutes} menit`);
                }
            }

            $('#waktu_izin, #hingga_waktu').on('change', calculatePengajuanIzin);
        });
    </script>

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