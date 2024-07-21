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
          <h4>Edit Surat Perizinan</h4>
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $izin['id'] ?>">
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
                <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="<?= $izin['tgl_izin']; ?>" placeholder="Tanggal Izin">
                <?= form_error('tgl_izin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Waktu Izin</label>
              <div class="col-sm-4">
                <input type="time" class="form-control" id="waktu_izin" name="waktu_izin" value="<?= $izin['waktu_izin']; ?>" placeholder="Waktu Izin">
                <?= form_error('waktu_izin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <label class="col-sm-1 col-form-label">Hingga</label>
              <div class="col-sm-4">
                <input type="time" class="form-control" id="hingga_waktu" name="hingga_waktu" value="<?= $izin['hingga_waktu']; ?>">
                <?= form_error('hingga_waktu', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Lama Izin</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="lama_izin" name="lama_izin" value="<?= $izin['lama_izin']; ?>" readonly>
                <?= form_error('lama_izin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jenis Izin</label>
              <div class="col-sm-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jenis_izin" id="exampleRadios1" value="Izin Dinas" <?= $izin['jenis_izin'] == 'Izin Dinas' ? 'checked' : '' ?>>
                  <label class="form-check-label" for="exampleRadios1">
                    Izin Dinas
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jenis_izin" id="exampleRadios2" value="Izin Pribadi" <?= $izin['jenis_izin'] == 'Izin Pribadi' ? 'checked' : '' ?>>
                  <label class="form-check-label" for="exampleRadios2">
                    Izin Pribadi
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tujuan Izin</label>
              <div class="col-sm-9">
                <?php
                $jenis_tujuan_izin = [
                  'Tidak Hadir ke Sekolah',
                  'Terlambat Hadir ke Sekolah',
                  'Izin Keluar',
                  'Pulang Cepat',
                  'Terlambat Hadir Rapat',
                  'Tidak Ikut Rapat'
                ];
                ?>
                <select class="form-control" id="tujuan_izin" name="tujuan_izin" onchange="checkOtherOption()">
                  <option <?= $izin['tujuan_izin'] == 'Tidak Hadir ke Sekolah' ? 'selected' : '' ?>>Tidak Hadir ke Sekolah</option>
                  <option <?= $izin['tujuan_izin'] == 'Terlambat Hadir ke Sekolah' ? 'selected' : '' ?>>Terlambat Hadir ke Sekolah</option>
                  <option <?= $izin['tujuan_izin'] == 'Izin Keluar' ? 'selected' : '' ?>>Izin Keluar</option>
                  <option <?= $izin['tujuan_izin'] == 'Pulang Cepat' ? 'selected' : '' ?>>Pulang Cepat</option>
                  <option <?= $izin['tujuan_izin'] == 'Terlambat Hadir Rapat' ? 'selected' : '' ?>>Terlambat Hadir Rapat</option>
                  <option <?= $izin['tujuan_izin'] == 'Tidak Ikut Rapat' ? 'selected' : '' ?>>Tidak Ikut Rapat</option>
                  <option <?= (!in_array($izin['tujuan_izin'], $jenis_tujuan_izin)) ? 'selected' : '' ?> id="option-other">Others</option>
                </select>
                <input type="text" class="form-control" id="other_input" name="other_input" value="<?= (!in_array($izin['tujuan_izin'], $jenis_tujuan_izin)) ? $izin['tujuan_izin'] : '' ?>" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Alasan Izin</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="alasan_izin" name="alasan_izin" value="<?= $izin['alasan_izin']; ?>" placeholder="Alasan Izin">
                <?= form_error('alasan_izin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <a href="<?= base_url('Console/pegawai') ?>" class="btn btn-light">Tutup</a>
            <button type="submit" name="tambah" class="btn btn-success float-right">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    let tujuan = '<?= $izin['tujuan_izin'] ?>';
    if (tujuan == 'Tidak Hadir ke Sekolah' ||
      tujuan == 'Terlambat Hadir ke Sekolah' ||
      tujuan == 'Izin Keluar' ||
      tujuan == 'Pulang Cepat' ||
      tujuan == 'Terlambat Hadir Rapat' ||
      tujuan == 'Tidak Ikut Rapat') {
      $('#other_input').css('display', 'none');
    } else {
      $('#option-other').find(":selected");
      $('#other_input').css({
        display: 'block',
        'margin-bottom': '2px'
      })
    }
  });

  function checkOtherOption() {
    var selectElement = document.getElementById("tujuan_izin");
    var otherInput = document.getElementById("other_input");

    if (selectElement.value === "Others") {

      $('#other_input').css({
        display: 'block',
        'margin-bottom': '2px'
      })
    } else {
      $('#other_input').css('display', 'none')
    }
  }
</script>