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
                <h4>Edit Data Berkas</h4>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="form-control custom-file-input" name="file" id="file">
                      <label class="custom-file-label" for="customFile">Pilih Berkas</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control"></textarea>
                  </div>
                  <a href="<?= base_url('Berkas') ?>" class="btn btn-light">Tutup</a>
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