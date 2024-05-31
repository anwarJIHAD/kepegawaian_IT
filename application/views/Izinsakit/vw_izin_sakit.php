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
                    <th>Status</th>
                    <th> <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati') { ?>Action <?php } ?></th>
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
                          <a href="<?= base_url('perizinanSakit/editsakit/') . $us['id_sakit']; ?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="<?= base_url('perizinanSakit/hapus/') . $us['id_sakit']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        <?php } elseif ($us['status'] == 'Diajukan') { ?>
                          -
                        <?php } else { ?>
                          <button class="btn btn-light" data-toggle="modal" data-target="#modal<?= $us['id_sakit']; ?>">Detail</button>
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
<?php foreach ($izin_sakit as $us) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal<?= $us['id_sakit']; ?>">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Surat Perizinan Sakit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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