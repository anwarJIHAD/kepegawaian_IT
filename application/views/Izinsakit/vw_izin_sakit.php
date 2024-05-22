<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h5>Data Pengajuan Sakit</h5>
    </div>
     <?= $this->session->flashdata('message'); ?> 
    <div class="section-body">
      <div class="row">
        <div class="col">
          <div class="card">
          <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati' || $pegawai['role'] == 'kepala sekolah') { ?>
                    <h4><a href="<?= base_url() ?>perizinansakit/tambahsakit" class="btn btn-primary">Ajukan Izin Sakit</a> </h4>
                    <?php } ?>
                    
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
                <thead>
                  <tr class="table-success">
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Tanggal Izin</th>
                    <th>Hingga Tanggal</th>
                    <th>Keterangan Sakit</th>
                    <th>File Surat Sakit</th>
                    <th> <?php if ($pegawai['role'] == 'Admin'|| $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati') { ?>Action <?php } ?></th> 
                  </tr>
                </thead>
                <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($izin_sakit as $us) : ?>                                
                          <tr>
                          <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['tgl_izin']; ?></td>
                                <td><?= $us['hingga_tgl']; ?></td>
                                <td><?= $us['ket_sakit']; ?></td>
                                <td><?= $us['file_sakit']; ?></td>
                                <td> <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati') { ?>
                                <a href="<?= base_url('perizinanSakit/editsakit/') . $us['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= base_url('PerizinanSakit/hapus/') . $us['id']; ?>" class="btn btn-danger btn-sm">Hapus</a><?php }?> </td>
                          </tr>
                          <?php $i++; ?>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                
              </div>
  
          </div>
      </section>
  </div>
  

</div>
</div>

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Surat Perizinan Cuti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
              <label>Alasan Penolakan</label>
              <textarea class="form-control"></textarea>
            </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>




<script>
  function confirm_delete(question) {

    if (confirm(question)) {

      alert("Action to delete");

    } else {
      return false;
    }

  }
</script>