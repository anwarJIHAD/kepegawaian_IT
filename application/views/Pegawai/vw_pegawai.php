<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h5>Data Pegawai</h5>
        </div>
        <div class="section-body">
        <div class="row">
              <div class="col">
                <div class="card">
                <?= $this->session->flashdata('message'); ?>
                <?php if ($pegawai['role'] == 'Admin') { ?>
                    <h4><a href="<?= base_url() ?>Pegawai/tambah_pegawai" class="btn btn-primary">Tambah Data</a> </h4>
                    <?php } ?>
                    
                  </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
                        <thead>                                 
                          <tr class="table-success">
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIY</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Jurusan</th>
                            <th>Jabatan</th>
                            <th>No Handphone</th>
                            <th> <?php if ($pegawai['role'] == 'Admin') { ?>Action<?php }?></th>
                          </tr>
                        </thead>
                        <tbody> 
                        <?php $i = 1; ?>
                        <?php foreach ($pegawai_m as $us) : ?>                                
                          <tr>
                          <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['niy']; ?></td>
                                <td><?= $us['tmpt_lahir']; ?></td>
                                <td><?= $us['tgl_lahir']; ?></td>
                                <td><?= $us['pnd_trkhr']; ?></td>
                                <td><?= $us['jurusan']; ?></td>
                                <td><?= $us['jabatan']; ?></td>
                                <td><?= $us['no_hp']; ?></td>

                            <td> <?php if ($pegawai['role'] == 'Admin') { ?>
                              <a href="<?= base_url('pegawai/edit_pegawai/') . $us['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                              <a href="<?= base_url('Pegawai/hapus/') . $us['id']; ?>" class="btn btn-danger btn-sm">Hapus</a><?php }?></td>
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
<script>
    function confirm_delete(question) {

        if (confirm(question)) {

            alert("Action to delete");

        } else {
            return false;
        }

    }
</script>