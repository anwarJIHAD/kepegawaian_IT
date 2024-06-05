<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
  .drop-zone {
    max-width: 500px;
    height: 200px;
    padding: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-family: "Quicksand", sans-serif;
    font-weight: 500;
    font-size: 20px;
    cursor: pointer;
    color: #cccccc;
    border: 4px dashed #b55050;
    border-radius: 10px;
  }

  .drop-zone--over {
    border-style: solid;
  }

  .drop-zone__input {
    display: none;
  }

  .drop-zone__thumb {
    width: 100%;
    height: 100%;
    border-radius: 10px;
    overflow: hidden;
    background-color: #cccccc;
    background-size: cover;
    position: relative;
  }

  .drop-zone__thumb::after {
    content: attr(data-label);
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 5px 0;
    color: #ffffff;
    background: rgba(0, 0, 0, 0.75);
    font-size: 14px;
    text-align: center;
  }
</style>
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


                <div class="card-body">
                <div style="margin-bottom: 20px;">
                <?php if ($pegawai['role'] == 'Admin') { ?>
                    <a href="<?= base_url() ?>Pegawai/tambah_pegawai" class="btn btn-outline-warning"><i class="bi bi-plus-circle"></i> Tambah Data</a> 
                   <button  class="btn btn-outline-warning" data-target="#exampleModal" data-toggle="modal"><i class="bi bi-file-earmark-ruled"></i> Export Excel</button> 
                    <?php } ?>
                </div>
                    <div class="table-responsive">
                      <table class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0;width:100%;" id="table-1">
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
                            <th>Status</th>
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
                                <td><?= $us['status']; ?></td>
                            <td> <?php if ($pegawai['role'] == 'Admin') { ?>
                              <a href="<?= base_url('pegawai/edit_pegawai/') . $us['id']; ?>" class="btn btn-light btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                              <a href="<?= base_url('Pegawai/hapus/') . $us['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</a><?php }?></td>
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

<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url() ?>Pegawai/loadfile" enctype="multipart/form-data" method="POST">
      <div class="modal-header">
        <h5 class="modal-title">Upload Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="drop-zone" style="margin-bottom: 15px;">
          <span>Drop file here or click to upload</span>
          <input type="file" name="myFile" class="drop-zone__input" >
        </div>
        <div>
          <span>Download Excel template <a href="<?= base_url() ?>pegawai/getTemplate" style="color:#b55050;">here</a></span>
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="submit" class="btn btn-outline-dark">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<!-- end -->

</div>
</div>
<script>
  document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");
    dropZoneElement.addEventListener("click", (e) => {
      inputElement.click();
    });
    inputElement.addEventListener("change", (e) => {
      if (inputElement.files.length) {
        updateThumbnail(dropZoneElement, inputElement.files[0]);
      }
    });
    dropZoneElement.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropZoneElement.classList.add("drop-zone--over");
    });
    ["dragleave", "dragend"].forEach((type) => {
      dropZoneElement.addEventListener(type, (e) => {
        dropZoneElement.classList.remove("drop-zone--over");
      });
    });
    dropZoneElement.addEventListener("drop", (e) => {
      e.preventDefault();
      if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
      }
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
    // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
      dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }
    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
      thumbnailElement = document.createElement("div");
      thumbnailElement.classList.add("drop-zone__thumb");
      dropZoneElement.appendChild(thumbnailElement);
    }
    thumbnailElement.dataset.label = file.name;
    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
      };
    } else {
      thumbnailElement.style.backgroundImage = null;
    }
  }

  function confirm_delete(question) {

    if (confirm(question)) {

      alert("Action to delete");

    } else {
      return false;
    }

  }


</script>
