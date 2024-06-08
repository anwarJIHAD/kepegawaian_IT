<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
</style>
     
     <!-- Main Content -->
     <?= $this->session->flashdata('message'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Surat Perizinan Cuti</h1>
          </div>

          <div class="section-body">
          <div class="card">
                  <div class="card-header">
                    <h4>Form Surat Perizinan</h4>
                  </div>
                  <div class="card-body">
                  <form  method="POST" action="<?= base_url('perizinancuti/tambahcuti') ?>"> 
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai['nama']; ?>" placeholder="Nama Pegawai" disabled>
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Cuti</label>
                <div class="col-sm-9">
                  <select class="form-control" id="jenis_cuti" name="jenis_cuti" onchange="checkOtherOption()">
                    <option>Cuti Biasa</option>
                    <option>Cuti Bulanan</option>
                    <option>Cuti Tahunan</option>
                  </select>
                </div>
              </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tanggal Izin</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="" placeholder="Tanggal Izin">
                        <?= form_error('tgl_izin', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <label class="col-sm-1 col-form-label" >Hingga</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" id="hingga_tgl" name="hingga_tgl" value="" placeholder="Tanggal Izin">
                        <?= form_error('hingga_tgl', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">No Hp Selama Izin</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="" placeholder="No Hp Selama Izin">
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Pemilik No Hp</label>
                      <div class="col-sm-9" >    
                      <select class="form-control" id="pemilik_nohp" name="pemilik_nohp" value="" placeholder="Pemilik No Hp">
                                                <option>Pribadi</option>
                                                <option>Keluarga</option>
                                                <option>Anak</option>
                                            </select>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Keterangan Cuti</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ket_cuti" name="ket_cuti" value="" placeholder="Keterangan Cuti">
                        <?= form_error('ket_cuti', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>
                    </div>
                    </div>
                    <a href="<?= base_url('Console/izin_cuti') ?>" class="btn btn-light">Tutup</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Simpan</button>
  
                        </form>
          </div>
          </div>
        </section>
      </div>

    </div>
  </div>
