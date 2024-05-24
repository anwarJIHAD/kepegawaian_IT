<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h5>Data Pengajuan Cuti</h5>
    </div>
    <?= $this->session->flashdata('message'); ?>
    <div class="section-body">
      <div class="row">
        <div class="col">
          <div class="card">
            <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati') { ?>
              <h4><a href="<?= base_url() ?>perizinancuti/tambahcuti" class="btn btn-primary">Ajukan Izin Cuti</a> </h4>
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
                    <th>No Hp Selama Izin</th>
                    <th>Pemilik No Hp</th>
                    <th>Keterangan Cuti</th>
                    <th>Status</th>
                    <th> <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati') { ?>Action <?php } ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($izin_cuti as $us) : ?>
                    <tr>
                      <td> <?= $i; ?>.</td>
                      <td><?= $us['nama']; ?></td>
                      <td><?= $us['tgl_izin']; ?></td>
                      <td><?= $us['hingga_tgl']; ?></td>
                      <td><?= $us['no_hp']; ?></td>
                      <td><?= $us['pemilik_nohp']; ?></td>
                      <td><?= $us['ket_cuti']; ?></td>
                      <td>
                        <?php if ($us['status'] == 'Diterima') { ?>
                          <span class="badge badge-success"><?= $us['status']; ?></span>
                        <?php } elseif ($us['status'] == 'Ditolak') { ?>
                          <span class="badge badge-danger"><?= $us['status']; ?></span>
                        <?php } else { ?>
                          <span class="badge badge-warning"><?= $us['status']; ?></span>
                        <?php } ?>
                      </td>
                      <td> <?php if ($pegawai['role'] ==  $this->session->userdata('role') && $us['role'] == $this->session->userdata('role') && $us['status'] != 'Diterima' && $us['status'] != 'Ditolak') { ?>
                          <a href="<?= base_url('perizinanCuti/editcuti/') . $us['id_cuti']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <?php } elseif ($us['status'] == 'Diajukan') { ?>
                          -
                        <?php } else { ?>
                          <button class="btn btn-light" data-toggle="modal" data-target="#modal<?= $us['id_cuti']; ?>">Detail</button>
                        <?php } ?>
                      </td>
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
<?php foreach ($izin_cuti as $us) : ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="modal<?= $us['id_cuti']; ?>">
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
            <label>Deskripsi</label>
            <textarea class="form-control" disabled><?= $us['ket_kepsek']; ?></textarea>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  </div>
<?php endforeach; ?>



<script>
  function confirm_delete(question) {

    if (confirm(question)) {

      alert("Action to delete");

    } else {
      return false;
    }

  }
</script>