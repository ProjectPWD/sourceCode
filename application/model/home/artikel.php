<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Taribo - Sport</title>


    <!-- Theme CSS -->
    <link href="../../../assets/css/main.css" rel="stylesheet" media="screen">
    <link href="../../../maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"
        media="screen">


    <link rel="shortcut icon" href="../../../assets/img/icons/favicon.ico">
    <link rel="apple-touch-icon" href="../../../assets/img/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../../../assets/img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../../../assets/img/icons/apple-touch-icon-114x114.png">
    <!-- Start Of scound contact section
		============================================= -->
    <?php include("../../../application/config/database/koneksi.php"); ?>
    <?php include("include/header.php"); ?>

    <!-- Section Area - Content Central -->
    <section class="content-info">

        <div class="container paddings-mini">
            <div class="row">

                <!-- Sidebars -->
                <aside class="col-lg-3">

                    <!-- Widget Text-->
                    <div class="panel-box">
                        <div class="titles no-margin">
                            <h4>Project</h4>
                        </div>
                        <div class="info-panel">
                            <p>Website ini merupakan salah satu tugas dari Mata Kuliah Pemrograman Web Dinamis &hearts;</p>
                        </div>
                    </div>
                    <!-- End Widget Text-->

                </aside>
                <!-- End Sidebars -->


                <div class="col-lg-9">
                <?php
                    $id = $_GET['id'];
                    $cari = "SELECT * FROM artikel WHERE id_artikel='$id'";
                            
                    $hasil_cari = mysqli_query($dbc, $cari);
                    // $data = mysqli_fetch_array($hasil_cari);
                    if(mysqli_num_rows($hasil_cari) == 0) {
                        echo "<script>window.history.back()</script";
                    } else {
                        $data = mysqli_fetch_assoc($hasil_cari);
                    

                ?>
                    <!-- Content Text-->
                    <div class="panel-box">
                        <div class="titles no-margin">
                            <h4><?php echo $data['judul_artikel'] ?></h4>
                        </div>
                        <img src="../../../dashboard/<?php echo $data['foto_artikel']; ?>" alt="">
                        <div class="info-panel">
                            <p><?php echo $data['isi_artikel'] ?></p>
                            
                        </div>
                    </div>
                    <!-- End Content Text-->


                    <!-- Comments -->
                    <div class="panel-box">
                        <!-- Title Post -->
                        <div class="titles">
                            <h4>Comments</h4>
                        </div>
                        <!-- Title Post -->
                        <ul class="testimonials">
                            <?php
                                $id = $_GET['id'];
                                $select = mysqli_query($dbc, "SELECT * FROM komentar WHERE id_artikel='$id'");
                                while ($data = mysqli_fetch_array($select)) {


                            ?>
                            <li>
                                <blockquote>
                                    <p><?php echo $data['isi_komentar']; ?></p>
                                    <img src="../../../assets/img/user.png" alt="">
                                    <strong><?php echo $data['nama_pengomentar']; ?></strong><a href="https://www.instagram.com/<?php echo $data['akun_ig']; ?>"><?php echo $data['akun_ig']; ?></a> <br><br>
                                </blockquote>
                            </li>
                            <?php
                                }
                                
                                
                                }
                                ?>
                         
                        </ul>
                        
                    </div>
                    <!-- End Comments -->

                    <!-- Comment Form -->
                    <div class="panel-box padding-b">
                        <!-- Title Post -->
                        <div class="titles">
                            <h4>Publish Comment</h4>
                        </div>

                        <div class="info-panel">
                            <!-- Form coment -->
                            <form class="form-theme" method="POST" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Your name *</label>
                                        <input type="text"  
                                            class="form-control" name="nama">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Your Instagram Account *</label>
                                        <input type="text"  
                                            class="form-control" name="akunig">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Comment *</label>
                                        <textarea  rows="10" class="form-control" name="isi"
                                            style="height: 138px;" ></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <input type="submit" name="lihat" value="Post Comment" class="btn btn-primary"> -->
                                        <button class="btn btn-primary" type="submit" name="komentar" >Komentar</button>
                                        <!-- <input type="submit" value='Masukkan' name='komentar'> -->
                                    </div>
                                </div>
                            </form>
                            <?php
                            // echo "Gas";
                                if (isset($_POST["komentar"])) {
                                    error_reporting(E_ALL ^ E_NOTICE);
                                    $idartikel = $_GET['id'];
                                    $nama = $_POST['nama'];
                                    $akunig = $_POST['akunig'];
                                    $isi = $_POST['isi'];
                                    // $submit = $_POST['komentar'];
                                    // echo "Gas";
                                    
                                                 
                                    $query = mysqli_query($dbc, "INSERT INTO komentar (id_komentar, id_artikel, nama_pengomentar, akun_ig, isi_komentar) 
                                                VALUES ('', '$idartikel', '$nama', '$akunig', '$isi')");
                                    if (!$query) {
                                        echo "<script>alert('Gagal di tambahkan!');history.go(-1);</script>";
                                        } else{
                                            echo "<script>alert('Berhasil di tambahkan!');history.go(-1);</script>";
                                        }
                                    }
                                    
                            ?>
                            <!-- End Form coment -->
                        </div>
                    </div>
                    <!-- End Comment Form -->

                </div>
            </div>
        </div>
    </section>
    <!-- End Section Area -  Content Central -->




    <?php include("include/contact-home.php"); ?>