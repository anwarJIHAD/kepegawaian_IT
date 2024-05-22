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
                  <form  method="POST" action="<?= base_url('lembur/tambah_lembur') ?>">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="" placeholder="Nama Pegawai">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
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
                        <input type="text" class="form-control" id="lama_lembur" name="lama_lembur" value="" placeholder="Lama Lembur">
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
                    
                    <a href="<?= base_url('Console/lembur') ?>" class="btn btn-light">Tutup</a>
                        <button type="submit" name="tambah" class="btn btn-success float-right">Simpan</button>
  
                        </form>
          </div>
          </div>
        </section>
      </div>

    </div>
  </div>

  <script>
    
  </script>
