<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h5>Surat Perizinan</h5>
    </div>
    <!-- <?= $this->session->flashdata('message'); ?> -->
    <div class="section-body">
      <div class="row">
        <div class="col">
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
                <thead>
                <tr class="table-success">
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Tanggal Izin </th>
                    <th>Hingga Tanggal</th>
                    <th>Keterangan Sakit</th>
                    <th>File Surat Sakit</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                  <?php foreach ($approvesakit as $us) : ?>
                    <tr>
                      <td> <?= $i; ?>.</td>
                      <td><?= $us['nama']; ?></td>
                      <td><?= $us['tgl_izin']; ?></td>
                      <td><?= $us['hingga_tgl']; ?></td>
                      <td><?= $us['ket_sakit']; ?></td>
                      <td><?= $us['file_sakit']; ?></td>
                      <td>
                        <?php if ($us['status'] == 'Disetujui') { ?>
                          <span class="badge badge-success"><?= $us['status']; ?></span>
                        <?php } elseif ($us['status'] == 'Ditolak') { ?>
                          <span class="badge badge-danger"><?= $us['status']; ?></span>
                        <?php } else { ?>
                          <span class="badge badge-warning"><?= $us['status']; ?></span>
                        <?php } ?>
                        </td>
                      <td><button class="btn btn-light" data-toggle="modal" data-target="#modal<?= $us['id_sakit']; ?>"><i class="bi bi-pencil-square"></i> Ubah Status</button></td>
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

</div>
</section>
</div>

</div>
</div>

<!-- Modal -->
<?php foreach ($approvesakit as $us) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal<?= $us['id_sakit']; ?>">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Surat Perizinan Sakit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('PerizinanSakit/ubahstatus/') . $us['id_sakit']; ?>">
        <input type="hidden" name="id" value="<?= $us['id_sakit'] ?>;">
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
            <option value="Disetujui">Disetujui</option>
            <option value="Ditolak">Ditolak</option>
            </select>
          </div>
          <a href="<?= base_url('Console/pegawai') ?>" class="btn btn-light">Tutup</a>
              <button type="submit" name="tambah" class="btn btn-primary float-right">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  </section>
  </div>


</tr>

</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

</div>
</section>
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