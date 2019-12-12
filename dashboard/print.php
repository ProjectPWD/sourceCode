
<?php include("../application/config/database/koneksi.php"); ?>
<?php include("include/header.php"); ?>
<?php include("include/navbar.php"); ?>

<?php
    session_start();
    if (!isset($_SESSION["submit"])) {
        header("Location: ../../application/model/login.php");
        exit;
    }
        ?>

<!DOCTYPE html>
<html>

<?php
    $id = $_GET['id'];
    $cari = "SELECT * FROM artikel WHERE id_artikel='$id'";
            
    $hasil_cari = mysqli_query($dbc, $cari);
    // $data = mysqli_fetch_array($hasil_cari);
    if(mysqli_num_rows($hasil_cari) == 0) {
        echo "<script>window.history.back()</script";
    } else {
        $data = mysqli_fetch_assoc($hasil_cari);
    }

?>
<!-- Mirrored from adminlte.io/themes/AdminLTE/pages/examples/invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Nov 2019 02:30:03 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> AdminLIncTE, TariBo.
          <small class="pull-right">Tanggal <?php echo $data['tanggal_posting'] ?> | Jam <?php echo $data['waktu_posting'] ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Admin, Inc.</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>John Doe</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (555) 539-1037<br>
          Email: john.doe@example.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <table>
                        <tr>
                            <td width="200"><p class="lead">Judul Artikel</p></td>
                            <td><p class="lead"> <?php echo $data['judul_artikel'] ?> </p></td>
                        </tr>
                        <tr>
                            <td><p class="lead">Gambar</p></td>
                            <td><p class="lead"> <img src="<?php echo $data['foto_artikel'] ?>" width='250' height='190'> </p></td>
                        </tr>
                        <tr>
                            <td width="100"><p class="lead">Kutipan Artikel</p></td>
                            <td><p class="lead"> <?php echo $data['isi_artikel'] ?> </p></td>
                        </tr>              
                    
                    </table>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>

<!-- Mirrored from adminlte.io/themes/AdminLTE/pages/examples/invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Nov 2019 02:30:03 GMT -->
</html>
