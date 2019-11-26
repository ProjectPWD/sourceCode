<?php
session_start();
if (!isset($_SESSION['admin']) AND empty($_SESSION['alumni']) AND empty($_SESSION['unverified'])) {
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Login Dashboard - Portal Alumni Teknik Kimia UMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/dashboard/images/favicon.ico">

        <!-- App css -->
        <link href="assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/dashboard/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/dashboard/css/theme.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
<body>
<?php
if (isset($_POST['login'])) {
	include("../config/database/koneksi.php");
	$username=mysqli_escape_string($dbc, $_POST['username']);
	$password=mysqli_escape_string($dbc, $_POST['password']);

	// cek
	$mysql=mysqli_query($dbc, "SELECT * FROM users WHERE username='$username'");
	if (mysqli_num_rows($mysql) > 0) {
		$fetchData=mysqli_fetch_array($mysql);
		if (md5($password) == $fetchData['password']) {
			$mysql=mysqli_query($dbc, "SELECT level FROM level WHERE id_level='$fetchData[level_id_level]'");
			if (mysqli_num_rows($mysql) > 0) {
				$fetchLevel=mysqli_fetch_array($mysql);
				if ($fetchLevel[0]=='admin') {
					$_SESSION['admin']=$fetchData;
					echo "<script>alert('Login Suksess');window.location='/dashboard';</script>";
				} elseif($fetchLevel[0]=='alumni') {
                    if ($fetchData['status']==0) {
                        $_SESSION['unverified']=$fetchData;
                        echo "<script>alert('Login Suksess');window.location='/unverified.php';</script>";
                    } else {
                        $_SESSION['alumni']=$fetchData;
                        echo "<script>alert('Login Suksess');window.location='/dashboard';</script>";
                    }
				} else {
					echo "Gagal !! Level User tidak diketahui..";
				}
			} else {
				echo "Gagal !! Level User tidak diketahui..";
			}
		} else {
			echo "Gagal !! Password Salah";
		}
	} else {
		echo "Gagal !! Username tidak ada";
	}
}
?>
	<div class="" style="background: #073C64;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center min-vh-100">
                            <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                                <div class="row">
                                    <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
                                    <div class="col-lg-7">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <a href="./" class="d-block mb-5">
                                                    <img src="assets/img/logo/n-f-logo.png" alt="app-logo" width="250" />
                                                </a>
                                            </div>
                                            <h1 class="h5 mb-1">Selamat Datang</h1>
                                            <p class="text-muted mb-4">Silahkan isikan username dan password anda untuk mengakses ke halaman dashboard.</p>
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <input type="text" name='username'class="form-control form-control-user" id="exampleInputEmail" placeholder="Username..">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name='password' class="form-control form-control-user" id="exampleInputPassword" placeholder="Password..">
                                                </div>
                                                <button type='submit' name='login' class="btn btn-success btn-block"> Masuk</button>
                                                <a class="btn btn-primary btn-block" type='button' onclick="window.location='./';" style="color: white;"> Beranda</a>
                                            <div class="row mt-4">
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-2"><a href="auth-recoverpw.html" class="text-muted font-weight-medium ml-1">Lupa kata sandi ? Contact Admin</a></p>
                                                    <p class="text-muted mb-0">Apakah anda belum mempunyai akun alumni ? Silahkan Daftar<a href="registration" class="text-muted font-weight-medium ml-1"><b>disini</b></a></p>
                                                </div> <!-- end col -->
                                            </div>
                                            </form>

                                            <!-- end row -->
                                        </div> <!-- end .padding-5 -->
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div> <!-- end .w-100 -->
                        </div> <!-- end .d-flex -->
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- jQuery  -->
        <script src="assets/dashboard/assets/js/jquery.min.js"></script>
        <script src="assets/dashboard/assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/dashboard/assets/js/metismenu.min.js"></script>
        <script src="assets/dashboard/assets/js/waves.js"></script>
        <script src="assets/dashboard/assets/js/simplebar.min.js"></script>

        <!-- App js -->
        <script src="assets/dashboard/assets/js/theme.js"></script>

    </body>
</html>
<?php
} else {
    if (isset($_SESSION['unverified'])) {
        echo "<script>window.location='./unverified.php'</script>";
        exit;
    }
	echo "<script>window.location='/dashboard'</script>";
}
?>