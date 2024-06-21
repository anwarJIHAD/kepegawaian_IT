<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h5>Data Berkas</h5>
    </div>
     <?= $this->session->flashdata('message'); ?> 
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <div style="margin-bottom: 20px;">
            <h4><a href="<?= base_url() ?>Berkas/tambah_berkas" class="btn btn-outline-warning"><i class="bi bi-plus-circle"></i> Tambah Berkas</a> </h4>
            <div class="card-header-form">
            </div>

          <div class="table-responsive">
            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
              <thead>
                <tr class="table-success">
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIY</th>
                  <th>Berkas</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($berkas as $us) : ?>
                  <tr>
                    <td> <?= $i; ?>.</td>
                    <td><?= $us['nama']; ?></td>
                    <td><?= $us['niy']; ?></td>
                    <td>
                        <?php
                          $file = explode(".", $us['file_berkas']);
                          $file_ext = $file[count($file) - 1];
                          $output_html = "                              
                            <a href='" . base_url('template/assets/img/berkas/') . $us['file_berkas'] . "' class='chocolat-image' title='" . $us['file_berkas'] . "' style='color: #68A805;'>Lihat Berkas</a>
                          ";

                          if(strtolower($file_ext) == "pdf") {
                            $output_html = "                              
                              <a href='" . base_url('template/assets/img/berkas/') . $us['file_berkas'] . "' target='  _blank' style='color: #68A805;'>Lihat Berkas</a>
                            ";
                          }
                        ?>
                        <div class="chocolat-parent">
                          <a href="<?= base_url('template/assets/img/berkas/')  . $us['file_berkas']; ?>" class="chocolat-image" title="<?= $us['file_berkas']; ?>">
                            <div>
                              <?= $output_html ?>
                            </div>
                          </a>
                        </div>
                      </td>
                    <td><?= $us['keterangan']; ?></td>
                      <td><a href="<?= base_url('Berkas/hapus/') . $us['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</a>
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
<script>
  function confirm_delete(question) {

    if (confirm(question)) {

      alert("Action to delete");

    } else {
      return false;
    }

  }
</script>