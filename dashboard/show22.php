<?php include("../application/config/database/koneksi.php"); ?>

<?php include("include/header.php"); ?>
<?php include("include/navbar.php"); ?>

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
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                    <h1>
                        Dashboard Artikel
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard Artikel</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box box-primary">
                        <div class="pad margin no-print">
                            <div class="callout callout-info" style="margin-bottom: 0!important;">
                                <h4><i class="fa fa-info"></i> Note:</h4>
                                Halaman ini hanya menampilkan mengenai Artikel.
                            </div>
                        </div>

                        <!-- Main content -->
                        <section class="invoice">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="page-header">
                                        <i class="fa fa-globe"></i> TariBo.
                                        <small class="pull-right">Tanggal <?php echo $data['tanggal_posting'] ?> | Jam <?php echo $data['waktu_posting'] ?></small>
                                    </h2>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
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

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-xs-12">
                                    <a href="print.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i>
                                        Print</a>
                                    
                                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                        <i class="fa fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div>
                        </section>
                        <!-- /.content -->
                    </div>

            </div>
            <!-- /.box -->



            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php include("include/footer.php"); ?>