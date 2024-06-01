<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h5>Data Berkas</h5>
        </div>
        <!-- <?= $this->session->flashdata('message'); ?> -->
        <div class="section-body">
        <div class="row">
              <div class="col">
                <div class="card">
                
                    <h4><a href="<?= base_url() ?>Berkas/tambah_berkas" class="btn btn-primary">Tambah Berkas</a> </h4>
                    <div class="card-header-form">
                     
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
                            <th>Berkas</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($berkas as $us) : ?>                                
                          <tr>
                          <td> <?= $i; ?>.</td>
                                <td><?= $us['nama']; ?></td>
                                <td><?= $us['niy']; ?></td>
                                <td><?= $us['file_berkas']; ?></td>
                                <td><?= $us['keterangan']; ?></td>
                                <td> 
                                <a href="<?= base_url('Berkas/hapus/') . $us['id']; ?>" class="btn btn-danger btn-sm">Hapus</a> </td>
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