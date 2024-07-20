<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h5>Data Pengajuan Sakit</h5>
    </div>
    <?= $this->session->flashdata('message'); ?>
    <div class="section-body">
      <div class="card">
        <div class="row">
          <div class="col">
            <div class="card-body">
              <div style="margin-bottom: 20px;">
                <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati' || $pegawai['role'] == 'kepala sekolah') { ?>
                  <a href="<?= base_url() ?>perizinansakit/tambahsakit" class="btn btn-outline-warning"><i class="bi bi-plus-circle"></i> Ajukan Izin Sakit </a>
                <?php } ?>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
                  <thead>
                    <tr class="table-success">
                      <th>No</th>
                      <th>Nama Pegawai</th>
                      <th>Tanggal Izin</th>
                      <th>Hingga Tanggal</th>
                      <th>Keterangan Sakit</th>
                      <th>File Surat Sakit</th>
                      <th>Status</th>
                      <th> <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati') { ?>Aksi <?php } ?></th>
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
                        <td>
                          <?php
                          $file = explode(".", $us['file_sakit']);
                          $file_ext = $file[count($file) - 1];
                          $output_html = "                              
                            <a href='" . base_url('template/assets/img/suratsakit/') . $us['file_sakit'] . "' class='chocolat-image' title='" . $us['file_sakit'] . "' style='color: #68A805;'>Lihat File</a>
                          ";

                          if (strtolower($file_ext) == "pdf") {
                            $output_html = "                              
                              <a href='" . base_url('template/assets/img/suratsakit/') . $us['file_sakit'] . "' target='  _blank' style='color: #68A805;'>Lihat File</a>
                            ";
                          }
                          ?>
                          <?php if ($us['file_sakit']) : ?>
                            <div class="chocolat-parent">
                              <a href="<?= base_url('template/assets/img/suratsakit/')  . $us['file_sakit']; ?>" class="chocolat-image" title="<?= $us['file_sakit']; ?>">
                                <div>
                                  <?= $output_html ?>
                                </div>
                              </a>
                            </div>
                          <?php elseif (!$us['file_sakit']) : ?>
                            <div>
                              Belum Upload
                            </div>
                          <?php endif ?>
                        </td>
                        <td>
                          <?php if ($us['status'] == 'Disetujui') { ?>
                            <span class="badge badge-success"><?= $us['status']; ?></span>
                          <?php } elseif ($us['status'] == 'Ditolak') { ?>
                            <span class="badge badge-danger"><?= $us['status']; ?></span>
                          <?php } else { ?>
                            <span class="badge badge-warning"><?= $us['status']; ?></span>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if ($pegawai['role'] ==  $this->session->userdata('role') && $us['role'] == $this->session->userdata('role') && $us['status'] != 'Disetujui' && $us['status'] != 'Ditolak') { ?>
                            <?php if (!$us['file_sakit']) : ?>
                              <a href="<?= base_url('perizinanSakit/editsakit/') . $us['id_sakit']; ?>" class="btn btn-light btn-sm mr-2"><i class="bi bi-pencil-square"></i> Upload File</a>
                            <?php endif ?>
                            <a href="<?= base_url('perizinanSakit/hapus/') . $us['id_sakit']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</a>
                          <?php } elseif ($us['status'] == 'Diajukan') { ?>
                            -
                          <?php } else { ?>
                            Telah <?= $us['status'] ?>
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