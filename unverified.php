<?php
session_start();
if (isset($_SESSION['unverified'])) {
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
                                                <a href="index.html" class="d-block mb-5">
                                                    <img src="assets/img/logo/n-f-logo.png" alt="app-logo" width="250" />
                                                </a>
                                            </div>
                                            <h1 class="h5 mb-1">Selamat Datang</h1>
                                            <p class="text-muted mb-4">Maaf akun anda belum terverifikasi oleh admin. Apabila anda baru mendaftar silahkan tunggu 1x24 jam, administrator akan segera memverifikasi akun anda. Apabila akun anda belum terverifikasi dalam jangka waktu tersebut silahkan hubungi admin.</p>
                                            <p class="text-muted mb-4">Setelah Menghubungi admin silahkan anda keluarkan akun anda agar konfirmasi akun anda berjalan dengan lancar.</p>
                                            <div class="text-center">
                                                <button class="btn btn-primary">CALL CENTER</button>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <button class="btn btn-danger" onclick="window.location='/dashboard/logout.php';">KELUAR</button>
                                            </div>
                                            <p></p>
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
	echo "<script>window.location='/dashboard'</script>";
}
?>