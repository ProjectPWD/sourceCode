<?php
session_start();
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
  include("../../application/config/database/koneksi.php");
  if (!isset($_GET['short'])) {
      echo "<script>window.location='/dashboard'</script>";
      exit;
  }

  if ($_GET['short']!='verified' AND $_GET['short']!='unverified') {
    echo "<script>window.location='/dashboard'</script>";
    exit;
  } else {
    $short=mysqli_escape_string($dbc, $_GET['short']);
    if ($short=='verified') {
      $key=1;
    } else {
      $key=0;
    }
  }

  if (isset($_SESSION['admin'])) {
    $datauser=$_SESSION['admin'];
    $query=mysqli_query($dbc, "SELECT artikel.id_artikel, LEFT(artikel.judul, 20) AS judul, artikel.slug,artikel.status, LEFT(artikel.content, 50) AS content, date(artikel.create_at) AS create_at, users.username, kategori.nama_kategori FROM artikel, users, kategori WHERE kategori.id_kategori=artikel.kategori_id_kategori AND users.id_user=artikel.users_id_user AND artikel.status=$key ORDER BY artikel.create_at DESC");
    $level='admin';
  } elseif (isset($_SESSION['alumni'])) {
    $datauser=$_SESSION['alumni'];
    $query=mysqli_query($dbc, "SELECT artikel.id_artikel, LEFT(artikel.judul, 20) AS judul, artikel.slug,artikel.status, LEFT(artikel.content, 50) AS content, artikel.create_at, users.username, kategori.nama_kategori FROM artikel, users, kategori WHERE artikel.users_id_user=$datauser[id_user] AND users.id_user=artikel.users_id_user AND kategori.id_kategori=artikel.kategori_id_kategori AND artikel.status=$key ORDER BY artikel.create_at");
    $level='alumni';
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

    <!-- Plugins css -->
    <link href="../../assets/dashboard/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/dashboard/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/dashboard/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/dashboard/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../../assets/dashboard/images/favicon.ico">

    <!-- App css -->
    <link href="../../assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/dashboard/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/dashboard/css/theme.min.css" rel="stylesheet" type="text/css" />

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
                            <img src="../../assets/img/logo/n-logo.png" width="210" height="40" alt="" height="15">
                        </span>
                        <i>
                            <img src=".../../assets/img/logo/n-logo.png" alt="" height="24">
                        </i>
                    </a>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="/dashboard"><i class="feather-home"></i><span class="badge badge-pill badge-success float-right">1</span><span>Dashboard</span></a>
                        </li>  

                        <li class="mm-show mm-active">
                            <a href="javascript: void(0);" class="has-arrow mm-active"><i class="feather-copy"></i><span>Artikel</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/dashboard/artikel/add.php">Buat Artikel</a></li>
                                <li><a href="/dashboard/artikel/index.php?short=verified">Data Artikel Verified</a></li>
                                <li><a href="/dashboard/artikel/index.php?short=unverified">Data Artikel Unverified</a></li>
                                <?php if($level=='admin') { ?> 
                                <?php } else ?>
                                
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
                                <?php if ($level=='admin') { ?>
                                <li><a href="pages-invoice.html">Website</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="../logout.php"><i class="feather-log-out"></i><span class="badge badge-pill badge-success float-right"></span><span>Keluar</span></a>
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
                            <h2 class="header-title" style="text-transform: uppercase;">data artikel yang <?php if($_GET['short']=='verified') { echo "terverifikasi"; } else {echo "belum Terverifikasi"; }?></h2>
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
                                            <img src="../../assets/dashboard/images/users/avatar-2.jpg"
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
                                <img class="rounded-circle header-profile-user" src="../../assets/dashboard/images/users/avatar-1.jpg"
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

                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="../logout.php">
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
                        <div class="col-12">
                            <?php if (isset($_GET['success'])) { ?><div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                <h5 class="alert-heading">Berhasil !</h5>
                                <p>Selamat <b><?php echo $_GET['success']; ?></b> silahkan cek artikel anda.</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <br>
                            <?php } ?>
                            <?php if(isset($_GET['error'])) { ?> 
                            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                <h5 class="alert-heading">Gagal !</h5>
                                <p><i><b>Error : <?php echo $_GET['error']; ?></b></i>. Silahkan ulangi kembali dan pastikan data yang anda input benar dan tidak kosong. Apabila masih terjadi error silahkan hubungi admin di menu <code style="color: blue;">bantuan</code></p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <br>
                            <?php } ?>

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Artikel</h4>
                                    <p class="card-subtitle mb-4">
                                        <?php if($level=='admin') { ?>
                                        Berikut adalah seluruh data artikel yang <b><?php echo $short; ?></b>.  
                                        <?php } else { ?> 
                                        Berikut adalah seluurh data artikel anda yang telah <b></b><?php echo $short; ?></b>. 
                                        <?php } ?>
                                    </p>
                                    <table id="key-datatable" class="table dt-responsive">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Judul</th>
                                                <td>Kategori</td>
                                                <td>Tanggal</td>
                                                <td>Status</td>
                                                <td>Kontributor</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>            
                                        <tbody>
                                        <?php 
                                        if (mysqli_num_rows($query) > 0) {
                                            $no=1;
                                            while ($data=mysqli_fetch_array($query)) {
                                          ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $data['id_artikel']; ?></td>
                                            <td><?php echo $data['judul']; ?></td>
                                            <td><?php echo $data['nama_kategori']; ?></td>
                                            <td><?php echo $data['create_at']; ?></td>
                                            <td><?php echo $short; ?></td>
                                            <td><?php echo $data['username']; ?></td>
                                            <td>
                                              <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <button type="button" class="btn btn-primary" onclick="window.location='edit.php?id=<?php echo $data['id_artikel'];?>'"><i class="feather-eye "></i></button>
                                            <?php if ($level=='admin') { ?>
                                                <?php if ($data['status']==0) { ?>
                                                <button type="button" class="btn btn-success" onclick="window.location='()confirmation.php?id=<?php echo $data['id_artikel']; ?>'"><i class="feather-check-square"></i></button>
                                                <?php } else { ?>
                                                <button type="button" class="btn btn-warning" onclick="window.location='()unconfirmation.php?id=<?php echo $data['id_artikel']; ?>'"><i class="feather-x-square" alt='Batal verifikasi  '></i></button>
                                                <?php } ?>
                                            <?php  } ?>
                                                <button type="button" class="btn btn-danger" onclick="window.location='delete.php?id=<?php echo $data['id_artikel']; ?>'"><i class="feather-trash"></i></button>
                                              </div>
                                        </tr>
                                      <?php 
                                            $no++;
                                            }
                                      } else { ?>
                                        <tr>
                                          <td colspan="7" align="center">Belum Ada Artikel yang <?php echo $short; ?>...</td>
                                        </tr>
                                      <?php } ?>
                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
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
    <script src="../../assets/dashboard/js/jquery.min.js"></script>
    <script src="../../assets/dashboard/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/dashboard/js/metismenu.min.js"></script>
    <script src="../../assets/dashboard/js/waves.js"></script>
    <script src="../../assets/dashboard/js/simplebar.min.js"></script>

    <!-- third party js -->
    <script src="../../assets/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/buttons.html5.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/buttons.flash.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/buttons.print.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/dataTables.select.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/pdfmake.min.js"></script>
    <script src="../../assets/dashboard/plugins/datatables/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Raphael Js-->

    <!-- Datatables init -->
    <script src="../../assets/dashboard/pages/datatables-demo.js"></script>


    <!-- App js -->
    <script src="../../assets/dashboard/js/theme.js"></script>
<?php
} else {
  echo "<script>window.location='/login';</script>";
}
?>