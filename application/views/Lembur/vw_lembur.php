<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h5>Data Lembur</h5>
        </div>
         <?= $this->session->flashdata('message'); ?> 
        <div class="section-body">
                <div class="card">
                <div class="card-body">
                  <div style="margin-bottom: 20px;">
                  <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru' || $pegawai['role'] == 'pustakawati') { ?>
                    <a href="<?= base_url() ?>Lembur/tambah_lembur" class="btn btn-outline-warning"><i class="bi bi-plus-circle"></i> Tambah Data</a> 
                    <?php } ?>
                  </div>

                    <div class="table-responsive">
                    <table class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
                        <thead>                                 
                          <tr class="table-success">
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Lama Lembur</th>
                            <th>Keterangan Lembur</th>
                            <th>Action</th> 
                          </tr>
                        </thead>
                        <tbody>                                 
                        <?php $i = 1; ?>
                        <?php foreach ($lembur as $us) : ?>                                
                          <tr>
                          <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['tanggal']; ?></td>
                                <td><?= $us['masuk']; ?></td>
                                <td><?= $us['pulang']; ?></td>
                                <td><?= $us['lama_lembur']; ?></td>
                                <td><?= $us['ket_lembur']; ?></td>
                            <td> <?php if ($pegawai['role'] == 'Admin') { ?>
                              <a href="<?= base_url('Lembur/edit_lembur/') . $us['id']; ?>" class="btn btn-light btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                              <a href="<?= base_url('Lembur/hapus/') . $us['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</a><?php } else {?> -<?php }?> </td>
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
<script>
    function confirm_delete(question) {

        if (confirm(question)) {

            alert("Action to delete");

        } else {
            return false;
        }

    }
</script>