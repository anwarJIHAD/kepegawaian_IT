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
          <div class="card">
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
                <thead>
                  <tr class="table-success">
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Jenis Cuti</th>
                    <th>Tanggal Izin</th>
                    <th>Hingga Tanggal</th>
                    <th>No Hp Selama Izin</th>
                    <th>Pemilik No Hp</th>
                    <th>Keterangan Cuti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($approvecuti as $us) : ?>
                    <tr>
                      <td> <?= $i; ?>.</td>
                      <td><?= $us['nama']; ?></td>
                      <td><?= $us['jenis_cuti']; ?></td>
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
                      <td><button class="btn btn-light" data-toggle="modal" data-target="#modal<?= $us['id_cuti']; ?>"><i class="bi bi-pencil-square"></i> Ubah Status</button></td>
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

<<!-- Modal -->
  <?php foreach ($approvecuti as $us) : ?>
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
            <form id="myForm<?= $us['id_cuti']; ?>" method="POST" action="<?= base_url('PerizinanCuti/ubahstatus/') . $us['id_cuti']; ?>">
              <input type="hidden" name="id" value="<?= $us['id_cuti'] ?>;">
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="ket_kepsek" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                  <option value="Diterima">Diterima</option>
                  <option value="Ditolak">Ditolak</option>
                </select>
              </div>
              <a href="<?= base_url('PerizinanCuti') ?>" class="btn btn-light">Tutup</a>
              <button type="button" name="tambah" class="btn btn-primary float-right" onclick="confirmSubmit(<?= $us['id_cuti']; ?>)">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </section>
  </div>

  <script>
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