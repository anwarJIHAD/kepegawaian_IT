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
                <div class="card">
                  <div class="card-header ">
                    <h4><a href="tambahsakit" class="btn btn-success">Ajukan Izin Sakit</a> </h4>
                    <div class="card-header-form">
                      <form>

                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Izin</th>
                            <th>Waktu Izin</th>
                            <th>Keterangan Sakit</th>
                            <th>File Surat Sakit</th>
                            <th>Status</th>
                            <th> <?php if ($pegawai['role'] == 'Admin') { ?>Action <?php } ?></th> 
                          </tr>
                        </thead>
                        <tbody>                                 
                          <tr>
                            <td>
                              1
                            </td>
                            <td>Input data</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                <div class="progress-bar bg-success" data-width="100%"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                            <td>2018-01-16</td>
                            <td><div class="badge badge-success">Completed</div></td>
                            <td><a href="<?= base_url() ?>PerizinanSakit/editsakit" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url() ?>PerizinanSakit/hapussakit" class="btn btn-danger">Hapus</a></td>
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