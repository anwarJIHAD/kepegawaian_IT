<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>

<!-- Main Content -->
<?= $this->session->flashdata('message'); ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Berkas</h1>
    </div>

    <div class="section-body">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4>Tambah Data Berkas</h4>
              </div>
              <div class="card-body">
              <form  method="POST" action="<?= base_url('Berkas/tambah_berkas') ?> "enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="id_pegawai" value="<?= $pegawai['id']; ?> ">
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="form-control" name="file_berkas" id="file_berkas">
                      <!-- <label class="custom-file-label" for="customFile">Pilih Berkas</label> -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan"> </textarea>
                    <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <a href="<?= base_url('Console/pegawai') ?>" class="btn btn-light">Tutup</a>
                  <button type="submit" name="tambah" class="btn btn-success float-right">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

  </section>
</div>

</div>
</div>