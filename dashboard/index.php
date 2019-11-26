<?php
session_start();
include ("../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
  include("../application/config/database/koneksi.php");
  if (isset($_SESSION['admin'])) {
    $datauser=$_SESSION['admin'];
    $level='admin';
    $query=mysqli_query($dbc, "SELECT count(id_artikel) FROM artikel");
    $countArtikel=mysqli_fetch_array($query)[0];
    $query=mysqli_query($dbc, "SELECT count(id_artikel) FROM artikel WHERE status=0");
    $countArtikel_ta=mysqli_fetch_array($query)[0];
    $query=mysqli_query($dbc, "SELECT count(id_user) FROM users WHERE status=1");
    $countAlumni=mysqli_fetch_array($query)[0];
    $query=mysqli_query($dbc, "SELECT count(id_user) FROM users WHERE status=0");
    $countANC=mysqli_fetch_array($query)[0];
  } elseif (isset($_SESSION['alumni'])) {
    $datauser=$_SESSION['alumni'];
    $level='alumni';
    $query=mysqli_query($dbc, "SELECT count(id_artikel) FROM artikel WHERE users_id_user=$datauser[id_user]");
    $countArtikel=mysqli_fetch_array($query)[0];
    $query=mysqli_query($dbc, "SELECT count(id_artikel) FROM artikel WHERE users_id_user=$datauser[id_user] AND status=1");
    $countArtikel_a=mysqli_fetch_array($query)[0];
    $query=mysqli_query($dbc, "SELECT count(id_artikel) FROM artikel WHERE users_id_user=$datauser[id_user] AND status=0");
    $countArtikel_ta=mysqli_fetch_array($query)[0];
    
  } else {
    session_destroy();
    echo "<script>window.location='/login'</script>";
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard - Portal Alumni Teknik Kimia UMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/dashboard/images/favicon.ico">

    <!-- App css -->
    <link href="../assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/dashboard/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/dashboard/css/theme.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="/dashboard" class="logo">
                        <span>
                            <img src="../assets/img/logo/n-logo.png" width="210" height="40" alt="" height="15">
                        </span>
                        <i>
                            <img src="../assets/dashboard/images/logo-small.png" alt="" height="24">
                        </i>
                    </a>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="./"><i class="feather-home"></i><span class="badge badge-pill badge-success float-right">1</span><span>Dashboard</span></a>
                        </li>  

                        <li>
                            <a href="javascript: void(0);" class="has-arrow"><i class="feather-copy"></i><span>Artikel</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/dashboard/artikel/add.php">Buat Artikel</a></li>
                                <li><a href="/dashboard/artikel/?short=verified">Data Artikel Verified</a></li>
                                <li><a href="/dashboard/artikel/?short=unverified">Data Artikel Unverified</a></li>
                                
                            </ul>
                        </li>
                        <?php if ($level=='admin') { ?>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"><i class="feather-calendar"></i><span>Event</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="pages-invoice.html">Buat Event</a></li>
                                <li><a href="pages-starter.html">Data Event</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"><i class="feather-users"></i><span>Alumni</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/dashboard/alumni/">Data Alumni</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li class="menu-title">Lainnya</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"><i class="feather-settings"></i><span>Pengaturan</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="pages-invoice.html">Profile</a></li>
                                <?php if($level=='admin') { ?> 
                                <li><a href="pages-invoice.html">Website</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php"><i class="feather-log-out"></i><span class="badge badge-pill badge-success float-right"></span><span>Keluar</span></a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-sm mr-2 d-lg-none header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <div class="header-breadcumb">
                            <h6 class="header-pretitle d-none d-md-block">Pages <i class="dripicons-arrow-thin-right"></i> Dashboard</h6>
                            <h2 class="header-title">Overview</h2>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                    

                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-danger badge-pill">2</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#" class="text-reset">
                                        <div class="media py-2 px-3">
                                            <img src="../assets/dashboard/images/users/avatar-2.jpg"
                                                class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Administrator</h6>
                                                <p class="font-size-12 mb-1">Gunakan website ini dengan bijak, baik, benar dan mematuhi UU yang berlaku.</p>
                                                <p class="font-size-12 mb-0 text-muted"><i class="mdi mdi-clock-outline"></i> Hari ini</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="text-reset">
                                        <div class="media py-2 px-3">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-success rounded-circle">
                                                    <i class="mdi mdi-cloud-download-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Update Available !</h6>
                                                <p class="font-size-12 mb-1">Update versi terbaru Website Alumni.</p>
                                                <p class="font-size-12 mb-0 text-muted"><i class="mdi mdi-clock-outline"></i> 1 Desember 2019</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top">
                                    <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-down-circle mr-1"></i> Load More..
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn header-item" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="../assets/dashboard/images/users/avatar-1.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-sm-inline-block ml-1"><?php echo $datauser['username']; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    <?php echo $level; ?>
                                </a>

                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    Pengaturan
                                </a>

                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="logout.php">
                                    <span>Keluar</span>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </header>

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase font-size-12 text-muted mb-3">Jumlah Artikel</h6>
                                            <span class="h3 mb-0"><?php echo $countArtikel; ?> </span>
                                        </div>
                                        <div class="col-auto">
                                        </div>
                                    </div> <!-- end row -->

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        
                        
                    <?php if($level=='admin') { ?>
                          <div class="col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase font-size-12 text-muted mb-3">Jumlah Artikel</h6>
                                            <span class="h3 mb-0"><?php echo $countArtikel_ta; ?> </span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge badge-soft-success">Unverified</span>
                                        </div>
                                    </div> <!-- end row -->

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                          <div class="col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase font-size-12 text-muted mb-3">Jumlah Alumni</h6>
                                            <span class="h3 mb-0"><?php echo $countAlumni; ?> </span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge badge-soft-success">verified</span>
                                        </div>
                                    </div> <!-- end row -->

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase font-size-12 text-muted mb-3">Jumlah Alumni</h6>
                                            <span class="h3 mb-0"><?php echo $countANC; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge badge-soft-danger">unverified</span>
                                        </div>
                                    </div> <!-- end row -->

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <?php } else { ?>
                          <div class="col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase font-size-12 text-muted mb-3">Jumlah Artikel</h6>
                                            <span class="h3 mb-0"> <?php echo $countArtikel_a; ?> </span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge badge-soft-success">Verified</span>
                                        </div>
                                    </div> <!-- end row -->

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase font-size-12 text-muted mb-3">Jumlah Artikel</h6>
                                            <span class="h3 mb-0"> <?php echo $countArtikel_ta; ?> </span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge badge-soft-danger">Unverified</span>
                                        </div>
                                    </div> <!-- end row -->

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase font-size-12 text-muted mb-3">Call Center</h6>
                                            <span class="h3 mb-0"> <a href="">Here</a> </span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge badge-soft-success">Administrator</span>
                                        </div>
                                    </div> <!-- end row -->

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->


                        <?php } ?>
                        
                    </div>
                    <!-- end row-->

                    <div class="row">
                        <div class="col-xl-4 col-lg-5">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Notice</h4>
                                    <p class="card-subtitle mb-4">Administrator Silahkan selalu memantau Website</p>

                    
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
        
                        </div> <!-- end col-->

                        <div class="col-xl-8 col-lg-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Information</h4>
                                    <p class="card-subtitle mb-4">Silahkan Menggunakan Website ini dengan benar dan patuhi undang undang berlaku. Apabila akun atau artikel anda belum <b>terverifikasi</b> atau <b>tidak aktif</b> silahkan hubungi admin untuk konfirmasi <a href="">di sini</a></p>
                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                    <div class="row">
                        <?php if ($level=='admin') { ?>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Alumni Terbaru</h4>
                                    <p class="card-subtitle mb-4">Data Alumni yang terdaftar baru baru ini</p>
                                    <div class="table-responsive">
                                        <table class="table table-centered table-striped table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>No. Ijazah</th>
                                                    <th>NOHP</th>
                                                    <th>Alamat</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query=mysqli_query($dbc, "SELECT id_user, nama_alumni, ijazah, foto_alumni, no_hp, alamat_alumni FROM users LIMIT 5");
                                            if (mysqli_num_rows($query) > 0) {
                                                while ($data=mysqli_fetch_array($query)) { 
                                            ?>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="../assets/images/<?php echo $data['foto_alumni']; ?>" alt="table-user" class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold"><?php echo $data['nama_alumni']; ?></a>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['ijazah']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['no_hp']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['alamat_alumni']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="profile/data-profile.php?id=<?php echo $data['id_user']; ?>">Lihat Data</a>
                                                    </td>
                                                </tr>
                                              <?php 
                                                  }
                                              } else {
                                              ?>
                                              <tr>
                                                <td colspan="4">Alumni Tidak Ada...</td>
                                              </tr>
                                              <?php
                                              }
                                              ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                        <?php } ?>
                        <?php if ($level=='admin') { ?>
                        <div class="col-xl-6">

                        <?php } else { ?>
                        <div class="col-xl-12">
                        <?php } ?>
                            <div class="card">
                                <div class="card-body">
                                  <?php if ($level=='admin') {
                                    $query=mysqli_query($dbc, "SELECT artikel.id_artikel, LEFT(artikel.judul, 27 ) AS judul, artikel.status, artikel.create_at, kategori.nama_kategori, users.username FROM artikel, users, kategori WHERE kategori.id_kategori=artikel.kategori_id_kategori AND users.id_user=artikel.users_id_user ORDER BY artikel.create_at DESC LIMIT 5 ");
                                    $key='di';
                                  } else {
                                    $query=mysqli_query($dbc, "SELECT artikel.id_artikel, LEFT(artikel.judul, 27 ) AS judul, artikel.status, artikel.create_at, kategori.nama_kategori, users.username FROM artikel, users, kategori WHERE artikel.users_id_user=$datauser[id_user] AND users.id_user=artikel.users_id_user AND kategori.id_kategori=artikel.kategori_id_kategori ORDER BY artikel.create_at DESC LIMIT 5");
                                    $key='anda';
                                  }
                                  ?>
                                  
                                    <h4 class="card-title">Artikel Terbaru</h4>
                                    <p class="card-subtitle mb-4">Artikel yang <?php echo $key; ?> posting baru baru ini</p>
                                    <div class="table-responsive table-bordered">
                                        <table class="table table-borderless table-hover table-centered table-nowrap mb-0">
                                          <?php 
                                          if (mysqli_num_rows($query) > 0) {
                                                while ($data=mysqli_fetch_array($query)) {
                                          ?>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h5 class="font-size-15 mb-1 font-weight-normal"><?php echo $data['judul'];?>..</h5>
                                                        <span class="text-muted font-size-12"><?php echo $data['create_at']; ?></span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-15 mb-1 font-weight-normal">Status</h5>
                                                        <span class="text-muted font-size-12"><?php if($data['status']==1) {echo 'Terverifikasi';} else { echo 'tidak aktif'; }?>
                                                          
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-15 mb-1 font-weight-normal">Kategori</h5>
                                                        <span class="text-muted font-size-12"><?php echo $data['nama_kategori']; ?></span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-15 mb-1 font-weight-normal"><?php echo $data['username']; ?></h5>
                                                        <span class="text-muted font-size-12">
                                                          <a href="article/edit.php?id=<?php echo $data['id_artikel']; ?>">Lihat Artikel</a>
                                                        </span>
                                                    </td>
                                                </tr>
                                              <?php 
                                                  }
                                              } else {
                                              ?>
                                              <tr>
                                                <td colspan="4">Artikel Tidak Ada...</td>
                                              </tr>
                                              <?php
                                              }
                                              ?>
                                               
                                            </tbody>
                                        </table>
                                    </div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2019 © Website Portal Alumni Teknik Kimia UMS.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Dibuat dengan Cinta
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="../assets/dashboard/js/jquery.min.js"></script>
    <script src="../assets/dashboard/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dashboard/js/metismenu.min.js"></script>
    <script src="../assets/dashboard/js/waves.js"></script>
    <script src="../assets/dashboard/js/simplebar.min.js"></script>

    <!-- Sparkline Js-->
    <!-- <script src="../assets/dashboard/plugins/jquery-sparkline/jquery.sparkline.min.js"></script> -->

    <!-- Morris Js-->
    <!-- <script src="../assets/dashboard/plugins/morris-js/morris.min.js"></script> -->
    <!-- Raphael Js-->
    <script src="../assets/dashboard/plugins/raphael/raphael.min.js"></script>

    <!-- Custom Js -->
    <script src="../assets/dashboard/pages/dashboard-demo.js"></script>

    <!-- App js -->
    <script src="../assets/dashboard/js/theme.js"></script>

</body>
</html>
<?php
} else {
  echo "<script>window.location='/login';</script>";
}
?>