<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
     
     <!-- Main Content -->
     <?= $this->session->flashdata('message'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Daftar Surat Izin Cuti</h1>
          </div>

          <div class="section-body">
          <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h4>Penolakan Surat Izin</h4>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="form-group">
              <label>Alasan Penolakan</label>
              <textarea class="form-control"></textarea>
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
