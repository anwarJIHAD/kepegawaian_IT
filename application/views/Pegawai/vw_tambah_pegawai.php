<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
     
     <!-- Main Content -->
     <?= $this->session->flashdata('message'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Pegawai</h1>
          </div>

          <div class="section-body">
          <div class="card">
                  <div class="card-header">
                    <h4>Tambah Data Pegawai</h4>
                  </div>
                  <div class="card-body">
                  <form  method="POST" action="<?= base_url('pegawai/tambah_pegawai') ?>">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="" placeholder="Nama Pegawai">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">NIY</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="niy" name="niy" value="" placeholder="NIY">
                        <?= form_error('niy', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir" value="" placeholder="Tempat Lahir">
                        <?= form_error('tmpt_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="" placeholder="Tanggal Lahir">
                        <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="pnd_trkhr" name="pnd_trkhr" value="" placeholder="Pendidikan Terakhir">
                        <?= form_error('pnd_trkhr', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">TMT SMA IT</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="tmt_smait" name="tmt_smait" value="" placeholder="TMT SMA IT">
                        <?= form_error('tmt_smait', '<small class="text-danger pl-3">', '</small>'); ?>                    
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jurusan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="" placeholder="Jurusan">
                        <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jabatan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="" placeholder="Jabatan">  
                        <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">No Handphone</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="" placeholder="No Handphone"> 
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username" value="" placeholder="Username"> 
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password"> 
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>  
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Role</label>
                      <div class="col-sm-9" >    
                      <select class="form-control" id="role" name="role" value="" placeholder="Role">
                                                <option value="Admin">Staf Tata Usaha</option>
                                                <option value="kepala sekolah">Kepala Sekolah</option>
                                                <option value="guru">Guru</option>
                                                <option value="pustakawati">Pustakawati</option>
                                            </select>
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
