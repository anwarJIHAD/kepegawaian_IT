<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Kepegawaian IT</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/summernote/summernote-bs4.css">
  
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/node_modules/prismjs/themes/prism.css">


  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/chocolat/dist/css/chocolat.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Template CSS -->

  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/css/style.css">
  
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/console.css">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins');

    * {
      font-family: 'Poppins', sans-serif;
      src: url('https://fonts.googleapis.com/css?family=Poppins');
    }

    /* Menggunakan linear-gradient untuk membuat gradasi soft hijau */
  #table-1 {
        border: 1px solid;
        border-image: linear-gradient(to bottom, #cdeeed, #a8f5b4); /* Gradasi soft hijau */
        border-image-slice: 1; /* Memastikan bahwa gradasi diterapkan ke seluruh border */
    }

    #table-1 th,
    #table-1 td {
        border: 1px solid;
        border-image: linear-gradient(to bottom, #cdeeed, #a8f5b4); /* Gradasi soft hijau */
        border-image-slice: 1; /* Memastikan bahwa gradasi diterapkan ke seluruh border */}

        
  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1"  >
      <div class="navbar-bg" style="background-color:#398B3F;"></div>
      <nav class="navbar navbar-expand-lg main-navbar" style="background-color:#398B3F;">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <a h class="nav-link nav-link-lg nav-link-user" style="font-size: 30px;"> SMA IT AL ITTIHAD</a>
          </div>
        </form>
        <ul class="navbar-nav navbar-right" >
        

          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center">
           <img alt="image" src="<?= base_url('template/assets/img/profil/') . $pegawai['gambar']?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?= $pegawai['nama']; ?> </div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url() ?>Profile" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= site_url('Auth/logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar" style="background-color:#FFFFFF;">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
          <img alt="image" src="<?= base_url() ?>/template/assets/img/logo_it.png" width = "30" height = "30" class="rounded-circle mr-1"><a href="<?= base_url() ?>Dashboard">Kepegawaian IT</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">IT</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
              <a href="<?= base_url() ?>Dashboard" class="nav-link "><i class="fas fa-th-large test"></i><span>Dashboard</span></a>
            <li class="menu-header">Kepegawaian</li>
            <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'kepala sekolah') { ?>
            <li ><a class="nav-link" href="<?= base_url() ?>Pegawai"><i class="fa fa-users" aria-hidden="true"></i> <span>Data Pegawai</span></a></li>
            <?php } ?>
            <li ><a class="nav-link" href="#"><i class="fa fa-address-book" aria-hidden="true"></i> <span>Absensi</span></a></li>
            <li ><a class="nav-link" href="<?= base_url() ?>Lembur"><i class="fa fa-calendar" aria-hidden="true"></i> <span>Lembur</span></a></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fa fa-envelope" aria-hidden="true"></i> <span>Perizinan</span></a>
              <ul class="dropdown-menu">
              <?php if ($pegawai['role'] == 'Admin' || $pegawai['role'] == 'guru'|| $pegawai['role'] == 'pustakawati') { ?>
                <li><a href="<?= base_url() ?>PerizinanCuti">Pengajuan Surat Cuti</a></li> 
                <li><a href="<?= base_url() ?>PerizinanSakit">Pengajuan Surat Sakit</a></li> 
                <li><a href="<?= base_url() ?>PengajuanIzin">Pengajuan Izin</a></li> 
                <?php }?>
                <?php if ($pegawai['role'] == 'kepala sekolah') { ?>
                <li><a href="<?= base_url() ?>PerizinanCuti/approvecuti">Pengajuan Surat Cuti</a></li> 
                <li><a href="<?= base_url() ?>PerizinanSakit/approvesakit">Pengajuan Surat Sakit</a></li> 
                <li><a href="<?= base_url() ?>PengajuanIzin/approveizin">Pengajuan Izin</a></li> 
                <?php } ?>
              </ul>
              <li ><a class="nav-link" href="<?= base_url() ?>Berkas"><i class="fa fa-file" aria-hidden="true"></i><span>Pengembangan Diri</span></a></li>
            </li>

        
      
             
          </ul>

      </aside>
      </div>

      <!-- Main Content -->
     