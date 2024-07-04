<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
.small-img {
    width: 250px;
    /* Adjust the size as needed */
    height: 250px;
    /* Adjust the size as needed */
    object-fit: cover;
}
</style>

<!-- Main Content -->
<div class="main-content">
<section class="section">
        <div class="section-header">
            <h1>Halaman Edit Profile</h1>
        </div>
		<div class="section-body">
            <div class="container">
                <div class="row ">
                    <div class="col-md-5">
                        <div class="card border rounded shadow-lg p-3 mb-5">
                            <div class="card-header">
                                <h4>Edit Foto Profile</h4>
                            </div>
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <img src="<?= base_url('template/assets/img/profil/') .$pegawai['gambar'] ?>" alt=""
                                    class="rounded-circle small-img mb-3">

                                <form action="<?= base_url('profile/update_profile'); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Upload</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="inputEmail3" name="gambar"
                                                accept=".gif, .jpg, .jpeg, .png" placeholder="Silahkan Upload Foto">
                                        </div>
                                    </div>
									<div class="d-flex flex-column align-items-center justify-content-center">
                                    <button type="submit" class="btn btn-primary ">Update 
                                        Profile</button>
									</div>

                                </form>



                            </div>


                        </div>

                    </div>

                    <div class="col-md-7">
                        <div class="card border rounded shadow-lg p-3 mb-5">
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <?= $this->session->flashdata('message'); ?>

                            <div class="row">

                                <div class="col-md-10">
                                    <div class="card-body">

                                        <form method="POST">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?= $pegawai['nama'] ?>"
                                                        class="form-control" id="inputEmail3" name="nama"
                                                        placeholder="Username">
                                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3"
                                                    class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?= $pegawai['username'] ?>"
                                                        class="form-control" id="inputEmail3" name="username"
                                                        placeholder="Username">
                                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">NIY</label>
                                                <div class="col-sm-9">
                                                    <input type="email" value="<?= $pegawai['niy'] ?>"
                                                        class="form-control" id="inputEmail3" placeholder="NIY"
                                                        name="niy" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">
                                                    Tempat Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputEmail3"
                                                        name="tmpt_lahir" value="<?= $pegawai['tmpt_lahir'] ?>"
                                                        placeholder="Jenis Kelamin">
                                                    <?= form_error('tmpt_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal
                                                    Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="inputEmail3"
                                                        value="<?= $pegawai['tgl_lahir'] ?>" name="tgl_lahir"
                                                        placeholder="No Hp">
                                                    <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Pndidikan
                                                    Terakhir</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputEmail3"
                                                        value="<?= $pegawai['pnd_trkhr'] ?>" name="pnd_trkhr"
                                                        placeholder="Pendidikan Terakhir" readonly>
                                                    <?= form_error('pnd_trkhr', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jurusan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputEmail3"
                                                        value="<?= $pegawai['jurusan'] ?>" name="jurusan"
                                                        placeholder="jurusan">
                                                    <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jabatan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputEmail3"
                                                        value="<?= $pegawai['jabatan'] ?>" name="jabatan"
                                                        placeholder="jabatan" readonly>
                                                    <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nomor
                                                    HP</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputEmail3"
                                                        value="<?= $pegawai['no_hp'] ?>" name="no_hp"
                                                        placeholder="no_hp">
                                                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="bg-info font-size-12 rounded-3 text-white p-3"><i
                                                        class="bi bi-info-circle-fill me-1"></i>Perubahan Password akan
                                                    berlaku
                                                    untuk seluruh akses pada platform lainnya</div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Password
                                                    Lama</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control"
                                                        value="<?= set_value('pass_lama'); ?>" name="pass_lama"
                                                        placeholder="Isi Jika Ingin Mengganti Password"
                                                        id="password_old">
                                                    <?= form_error('pass_lama', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Password
                                                    Baru</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="input-password"
                                                        value="<?= set_value('pass_baru'); ?>" name="pass_baru"
                                                        placeholder="Masukkan password Baru">
                                                    <?= form_error('pass_baru', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Konfirmasi
                                                    Password
                                                    Baru</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="input-password2"
                                                        value="<?= set_value('pass_baru2'); ?>" name="pass_baru2"
                                                        placeholder="Masukkan password Baru">
                                                </div>

                                            </div>
                                            <a href="<?= base_url('Dashboard') ?>" class="btn btn-light">Tutup</a>
                                            <button type="submit" name="tambah" class="btn btn-primary float-right">Edit
                                                Profile</button>
                                        </form>
                                    </div>
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