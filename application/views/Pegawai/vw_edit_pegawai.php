<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
  /* Add your custom styles here */
</style>

<!-- Main Content -->
<?= $this->session->flashdata('message'); ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Pegawai</h1>
    </div>

    <div class="section-body">
      <div class="card" style="background-color:white">
        <div class="card-header">
          <h4>Edit Data Pegawai</h4>
        </div>
        <div class="card-body">
          <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $pegawai_m['id'] ?>;">

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Pegawai</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai_m['nama']; ?>">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
                      <label class="col-sm-3 col-form-label">NIY</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="niy" name="niy" value=" <?= $pegawai_m['niy']; ?>">
                        <?= form_error('niy', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="tempat_lahir" name="tmpt_lahir"  value=" <?= $pegawai_m['tmpt_lahir']; ?>" >
                        <?= form_error('tmpt_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-9">
                      <input type="date" class="form-control" id="tanggal_lahir" name="tgl_lahir" value="<?= date('Y-m-d', strtotime($pegawai_m['tgl_lahir'])); ?>">
                        <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="pendidikan_trkhr" name="pnd_trkhr"  value=" <?= $pegawai_m['pnd_trkhr']; ?>">
                        <?= form_error('pnd_trkhr', '<small class="text-danger pl-3">', '</small>'); ?>  
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">TMT SMA IT</label>
                      <div class="col-sm-9">
                      <input type="date" class="form-control" id="tmt_smait" name="tmt_smait" value="<?= date('Y-m-d', strtotime($pegawai_m['tmt_smait'])); ?>">

                        <?= form_error('tmt_smait', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jurusan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="jurusan" name="jurusan"  value=" <?= $pegawai_m['jurusan']; ?>">
                        <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jabatan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="jabatan" name="jabatan"  value=" <?= $pegawai_m['jabatan']; ?>">  
                        <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">No Handphone</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_hp" name="no_hp"  value=" <?= $pegawai_m['no_hp']; ?>"> 
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username"  value=" <?= $pegawai_m['username']; ?>"> 
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="password" name="password"> 
                    </div>
                    </div>
            <!-- Repeat similar structure for other form fields -->

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Role</label>
              <div class="col-sm-9">
                <select class="form-control" id="role" name="role" value="" placeholder="Role">
                  <option value="Admin" <?php if ($pegawai_m['role'] == "Admin") {
                                                      echo "selected";
                                                    } ?>>Staff tata usaha</option>
                  <option value="kepala sekolah" <?php if ($pegawai_m['role'] == "kepala sekolah") {
                                                      echo "selected";
                                                    } ?>>Kepala sekolah</option>
                  <option value="guru" <?php if ($pegawai_m['role'] == "guru") {
                                          echo "selected";
                                        } ?>>Guru</option>
                  <option value="pustakawati" <?php if ($pegawai_m['role'] == "pustakawati") {
                                                  echo "selected";
                                                } ?>>Pustakawati</option>
                </select>
              </div>
            </div>
            <!-- End of form fields -->
            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status" name="status" placeholder="Status">
                                        <option <?= $pegawai_m['status'] == 'Aktif' ? 'selected' : '' ?> value="Aktif">Aktif</option>
                                        <option <?= $pegawai_m['status'] == 'Non Aktif' ? 'selected' : '' ?> value="Non Aktif">Non Aktif</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <a href="<?= base_url('Pegawai') ?>" class="btn btn-light">Tutup</a>
                <button type="submit" name="tambah" class="btn btn-primary float-right">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

