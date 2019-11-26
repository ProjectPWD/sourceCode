<?php
session_start();
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
	if (empty($_SESSION['admin'])) {
		echo "$base_url/404";
		exit;
	}
?>	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $base_url; ?>/favicon.ico">

    <title>Dashboard - Website Alumni Teknik Kimi Universitas Muhammadiyah Surakarta</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $base_url; ?>/assets/dashboard/navbar-top.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="index.html#">Top navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/dashboard/article/">Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/dashboard/event/">Event</a>
          </li>
          <?php if(isset($_SESSION['admin'])) { ?> 
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">Logout</a>
          </li>
      </div>
    </nav>

    <div class="container">
      <div class="card">
        <div class="card-header text-center">
          MENU ARTIKEL
        </div>
        <div class="card-body">
          <form action="<?php echo $base_url; ?>/dashboard/article/()confirmation.php" method="GET">
            
            <div class="form-group">
              <label for="title">ID Artikel</label>
              <input type="text" name="id" id="id" placeholder="ID Article..." class="form-control" value="">
            </div>

            <div class="form-group">
              <div class="text-center">
                <button class="btn btn-primary btn-sm" name="konifmasiArtikel" id="tambahartikel">KONFIRMASI ARTIKEL</button>
                <a class="btn btn-warning btn-sm" onclick='window.history.back();'>CANCEL</a>
              </div>
              <br>
            </div>

          </form>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $base_url; ?>/assets/js/vendor/jquery-slim.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>
<?php
} else {
  echo "<script>window.location='/login';</script>";
}
?>