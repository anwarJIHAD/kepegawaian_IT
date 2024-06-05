<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat Perizinan</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>
    <!-- Main Content -->
    <?= $this->session->flashdata('message'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Surat Perizinan</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Surat Perizinan</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $izin_cuti['id'] ?>;">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai['nama']; ?>" placeholder="Nama Pegawai" disabled>
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Izin</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_cuti" name="jenis_cuti" onchange="checkOtherOption()">
                                        <option <?= $izin_cuti['jenis_cuti'] == 'Cuti Biasa' ? 'selected' : '' ?>>Cuti Biasa</option>
                                        <option <?= $izin_cuti['jenis_cuti'] == 'Cuti Bulanan' ? 'selected' : '' ?>>Cuti Bulanan</option>
                                        <option <?= $izin_cuti['jenis_cuti'] == 'Cuti Tahunan' ? 'selected' : '' ?>>Cuti Tahunan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Izin</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="tgl_izin" name="tgl_izin" value="<?= $izin_cuti['tgl_izin']; ?>">
                                    <?= form_error('tgl_izin', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <label class="col-sm-1 col-form-label">Hingga</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="hingga_tgl" name="hingga_tgl" value="<?= $izin_cuti['hingga_tgl']; ?>">
                                    <?= form_error('hingga_tgl', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No Hp Selama Izin</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $izin_cuti['no_hp']; ?>">
                                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pemilik No Hp</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="pemilik_nohp" name="pemilik_nohp" placeholder="Pemilik No Hp">
                                        <option <?= $izin_cuti['pemilik_nohp'] == 'Pribadi' ? 'selected' : '' ?>>Pribadi</option>
                                        <option <?= $izin_cuti['pemilik_nohp'] == 'Keluarga' ? 'selected' : '' ?>>Keluarga</option>
                                        <option <?= $izin_cuti['pemilik_nohp'] == 'Anak' ? 'selected' : '' ?>>Anak</option>
                                    </select>
                                    <?= form_error('pemilik_nohp', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Keterangan Cuti</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ket_cuti" name="ket_cuti" value="<?= $izin_cuti['ket_cuti']; ?>">
                                    <?= form_error('ket_cuti', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-9 offset-sm-3">
                                    <a href="<?= base_url('Console/perizinancuti') ?>" class="btn btn-light">Tutup</a>
                                    <button type="submit" name="tambah" class="btn btn-success float-right">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
