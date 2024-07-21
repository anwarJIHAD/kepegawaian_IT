<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h5>Surat Perizinan</h5>
    </div>
    <?= $this->session->flashdata('message'); ?> 
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
                    <th>Tanggal Izin</th>
                    <th>Waktu Izin</th>
                    <th>Hingga Waktu</th>
                    <th>Lama Izin</th>
                    <th>Jenis Izin</th>
                    <th>Tujuan Izin</th>
                    <th>Alasan Izin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                  <?php foreach ($approveizin as $us) : ?>
                    <tr>
                      <td> <?= $i; ?>.</td>
                      <td><?= $us['nama']; ?></td>
                      <td><?= $us['tgl_izin']; ?></td>
                      <td><?= $us['waktu_izin']; ?></td>
                      <td><?= $us['hingga_waktu']; ?></td>
                      <td><?= $us['lama_izin']; ?></td>
                      <td><?= $us['jenis_izin']; ?></td>
                      <td><?= $us['tujuan_izin']; ?></td>
                      <td><?= $us['alasan_izin']; ?></td>
                      <td>
                        <?php if ($us['status'] == 'Diterima') { ?>
                          <span class="badge badge-success"><?= $us['status']; ?></span>
                        <?php } elseif ($us['status'] == 'Ditolak') { ?>
                          <span class="badge badge-danger"><?= $us['status']; ?></span>
                        <?php } else { ?>
                          <span class="badge badge-warning"><?= $us['status']; ?></span>
                        <?php } ?>
                        </td>
                      <td><button class="btn btn-light" data-toggle="modal" data-target="#modal<?= $us['id_izin']; ?>"><i class="bi bi-pencil-square"></i> Ubah Status</button></td>
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
<?php foreach ($approveizin as $us) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal<?= $us['id_izin']; ?>">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Surat Perizinan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="myForm<?= $us['id_izin']; ?>" method="POST" action="<?= base_url('PengajuanIzin/ubahstatus/') . $us['id_izin']; ?>">
          <input type="hidden" name="id" value="<?= $us['id_izin']; ?>">
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="Diterima">Diterima</option>
              <option value="Ditolak">Ditolak</option>
            </select>
          </div>
          <a href="<?= base_url('Pengajuanizin/approveizin') ?>" class="btn btn-light">Tutup</a>
          <button type="button" name="tambah" class="btn btn-primary float-right" onclick="confirmSubmit(<?= $us['id_izin']; ?>)">Simpan</button>
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

function confirmSubmit(id) {
  Swal.fire({
    title: 'Konfirmasi',
    text: "Apakah anda yakin?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, lanjutkan!'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('myForm' + id).submit(); // Submit the form with the unique id
    }
  })
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
