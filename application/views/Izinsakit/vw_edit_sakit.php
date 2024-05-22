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
                    <form method="POST">
                    <input type="hidden" name="id" value="<?= $izin_sakit['id'] ?>;">

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $izin_sakit['nama']; ?>" placeholder="Nama Pegawai">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tanggal Izin</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="<?= $izin_sakit['tgl_izin']; ?>" placeholder="Tanggal Izin">
                        <?= form_error('tgl_izin', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <label class="col-sm-1 col-form-label" >Hingga</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" id="hingga_tgl" name="hingga_tgl" value="<?= $izin_sakit['hingga_tgl']; ?>" placeholder="Tanggal Izin">
                        <?= form_error('hingga_tgl', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Keterangan Sakit</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ket_sakit" name="ket_sakit" value="<?= $izin_sakit['ket_sakit']; ?>" placeholder="Keterangan Sakit">
                        <?= form_error('ket_sakit', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload Surat Sakit</label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control custom-file-input" name="file" id="file" value="<?= $izin_sakit['file_sakit']; ?>" placeholder="Upload Surat Sakit">
                        <?= form_error('file_sakit', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="custom-file-label" for="customFile">
                    </div>
                    </div>
                    </div>
                
                    <a href="<?= base_url('Console/pegawai') ?>" class="btn btn-light">Tutup</a>
                        <button type="submit" name="tambah" class="btn btn-success float-right">Simpan</button>
                        </form>
          </div>
          </div>
        </section>
      </div>

    </div>
  </div>