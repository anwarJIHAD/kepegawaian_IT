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
            <form method="POST" action="<?= base_url('PengajuanIzin/tambahizin') ?>">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai['nama']; ?>" placeholder="Nama Pegawai" disabled>
                  <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
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
                  <input type="text" class="form-control" id="other_input" name="other_input" style="display:none; margin-top: 10px;" placeholder="Please specify"/>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Alasan Izin</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="alasan_izin" name="alasan_izin" placeholder="Alasan Izin">
                  <?= form_error('alasan_izin', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <a href="<?= base_url('Console/izin') ?>" class="btn btn-light">Tutup</a>
              <button type="submit" name="tambah" class="btn btn-success float-right">Simpan</button>
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