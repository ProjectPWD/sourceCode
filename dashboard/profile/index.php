<?php
session_start();
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
  include("../../application/config/database/koneksi.php");
  if (isset($_SESSION['admin'])) {
    $datauser=$_SESSION['admin'];
  } elseif (isset($_SESSION['alumni'])) {
    $datauser=$_SESSION['alumni'];
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
            <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
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
            <a class="nav-link" href="/dashboard/profile">Profile</a>
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
          <ul>
            <li><a href="edit.php">Edit Profile</a></li>
          </ul>
          <?php if(isset($_SESSION['admin'])) { ?> 
          <?php } ?>
          <table class="table table-bordered">
            <tr>
              <td colspan="2" align="center">
                <img src="<?php echo $base_url ?>/assets/img/alumni/<?php echo $datauser['foto_alumni']; ?>" width='150' height='150'>
              </td>
            </tr>
            <tr>
              <td colspan="2">No Ijazah.</td>
            </tr>
            <tr>
              <td>#ID</td>
              <td><?php echo $datauser['id_user']; ?></td>
            </tr>
            <tr>
              <td>Username</td>
              <td><?php echo $datauser['username']; ?></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><?php echo $datauser['password']; ?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td><?php echo $datauser['nama_alumni']; ?></td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <?php if ($datauser['jenis_kelamin']=="L") { ?>
              <td>Laki-laki</td>
              <?php } else { ?>
              <td>Laki-laki</td>
              <?php } ?>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>Title</td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td><?php echo $datauser['tgl_lahir']; ?></td>
            </tr>
            <tr>
              <td>No HP</td>
              <td><?php echo $datauser['no_hp']; ?></td>
            </tr>
          </table>
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