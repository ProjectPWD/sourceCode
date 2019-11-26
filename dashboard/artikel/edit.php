<?php
session_start();
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
  include("../../application/config/database/koneksi.php");

  if (!isset($_GET['id'])) {
    echo "<script>window.location='/dashboard/article';</script>";
    exit;
  }

  $id_article=mysqli_escape_string($dbc, $_GET['id']);
  if (isset($_SESSION['admin'])) {
    $datauser=$_SESSION['admin'];
    $query=mysqli_query($dbc, "SELECT * FROM artikel WHERE id_artikel='$id_article'");
    $level='admin';
  } elseif (isset($_SESSION['alumni'])) {
    $datauser=$_SESSION['alumni'];
    $query=mysqli_query($dbc, "SELECT * FROM artikel WHERE id_artikel='$id_article' AND users_id_user='$datauser[id_user]'");
    $level='alumni';
  } else {
    echo "{WHOOPS:SECURED by SurakartaHax0r}";
  }

  if(mysqli_num_rows($query) == 0 ) {
    echo "<script>window.location='/dashbaord/article/?status=verified';</script>";
    exit;
  }
  $dataartikel=mysqli_fetch_array($query);
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

    <link href="/assets/dashboard/plugins/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
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
                                <li><a href="/dashboard/artikel/?short=verified">Data Artikel Verified</a></li>
                                <li><a href="/dashboard/artikel/?short=unverified">Data Artikel Unverified</a></li>
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
                                <li><a href="/dashbaord/alumni/">Data Alumni</a></li>
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
                            <h2 class="header-title">EDIT ARTIKEL</h2>
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
                            
                            <?php if (isset($_GET['success']) AND !empty($_GET['status'])) { ?>
                                <?php if ($_GET['status']==1) { ?>
                                     <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                        <h5 class="alert-heading">Berhasil !</h5>
                                        <p>Selamat artikel anda berhasil disimpan dan teraktivasi silahkan cek artikel anda di menu artikel <code>-></code> Data artikel verified.</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                <?php } elseif ($_GET['status']=='unverified') { ?>
                                     <div class="alert alert-primary alert-dismissible fade show mb-0" role="alert">
                                        <h5 class="alert-heading">Berhasil !</h5>
                                        <p>Selamat artikel anda berhasil disimpan. Status artikel yang anda buat adalah <code>unverified</code>. Artikel anda akan Administrator review dalam waktu 1x24 Jam apabila dalam jangka waktu tersebut tidak ada action silahkan hubungi admin melalui menu bantuan dengan menyertakan ID artikel anda.</p>
                                        <p>untuk mengetahui ID artikel & memantau artikel yang <code>unverified</code>, silahkan cek artikel anda di menu <code>artikel -> Data artikel unverified</code></p>
                                        <p>Apabila artikel telah tereview / terkonfirmasi status artikel anda akan berubah menjadi <code>verified</code>.</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                <?php } ?>
                            <br>
                            <?php } ?>
                            <?php if(isset($_GET['error'])) { ?> 
                            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                <h5 class="alert-heading">Gagal !</h5>
                                <p><i><b>Error : <?php echo $_GET['error']; ?></b></i>. Maaf, artikel yang anda submit gagal untuk disimpan.</code>. Silahkan ulangi kembali dan pastikan data yang anda input benar dan tidak kosong. Apabila masih terjadi error silahkan hubungi admin di menu <code style="color: blue;">bantuan</code></p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <br>
                            <?php } ?>
                            
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Artikel</h4>
                                    <p class="card-subtitle mb-4">
                                        Halaman untuk edit artikel mengenani berita, lowongan pekerjaan dan informasi magang. Alumni dapat edit sebuah artikelnya sendiri.
                                    </p>
                                    <hr>

                                    <form action="<?php echo $base_url; ?>/dashboard/artikel/()edit.php?id=<?php echo $id_article; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="title">Judul Artikel</label>
                                            <input type="text" id="title"  name='title' class="form-control" value="<?php echo $dataartikel['judul']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select class="form-control" name="kategori" id="kategori">
                                            <?php
                                            $query=mysqli_query($dbc, "SELECT * FROM kategori");
                                            if (mysqli_num_rows($query) > 0) {
                                              while ($data=mysqli_fetch_array($query)) {
                                                if ($data['id_kategori']==$dataartikel['kategori_id_kategori']) {
                                                ?>
                                                <option value="<?php echo $data['id_kategori']; ?>" selected><?php echo $data['nama_kategori']; ?></option>

                                                <?php
                                                } else {
                                                ?>
                                                <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                                                <?php
                                                }
                                              }
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                          <?php
                                          // cek gambar
                                          if (!file_exists('../../assets/img/blog/hd/'.$dataartikel['pict'])) {
                                            $dataartikel['pict']='default.png';
                                          } elseif($dataartikel['pict']==Null) {
                                            $dataartikel['pict']='default.png';
                                          }
                                          ?>
                                            <label for="gambar">Gambar</label>
                                            <p class="card-subtitle mb-4">Maksimal Gambar 1 MB</p>
                                            <input type="file" name="gambar" class="dropify" data-default-file="../../assets/img/blog/hd/<?php echo $dataartikel['pict']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Konten</label>
                                            <textarea name="content" id="myTextarea" style="z-index: 99999;"><?php echo $dataartikel['content']; ?></textarea>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary" type="submit">SIMPAN ARTIKEL</button>
                                        </div>
                                    </form>
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
    <script src="/assets/dashboard/plugins/dropify/dropify.min.js"></script>

    <script src="../../assets/dashboard/js/theme.js"></script>
    <script src='../inc/tinymce/tinymce.min.js'></script>
    <script>
    tinymce.init({
        selector: '#myTextarea',
        height: 500,
        theme: 'modern',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    </script>
    <script src="/assets/dashboard/pages/fileuploads-demo.js"></script>
<?php
} else {
  echo "<script>window.location='/login';</script>";
}
?>