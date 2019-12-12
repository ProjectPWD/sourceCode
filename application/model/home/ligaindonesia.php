<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Taribo - indonesia</title>
    

<!-- Theme CSS -->
<link href="../../../assets/css/main.css" rel="stylesheet" media="screen">
<link href="../../../maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" media="screen">


<link rel="shortcut icon" href="../../../assets/img/icons/favicon.ico">
<link rel="apple-touch-icon" href="../../../assets/img/icons/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="../../../assets/img/icons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="../../../assets/img/icons/apple-touch-icon-114x114.png">
<!-- Start Of scound contact section
		============================================= -->
<?php include("../../../application/config/database/koneksi.php"); ?>
<?php include("include/header.php"); ?>

        <!-- Section Title -->
        <section class="section-title" style="background:url(../../../assets/img/slide/1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>Liga Indonesia</h1>
                    </div>

                    <div class="col-md-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li>Home</a></li>
                                <li>Liga Indonesia</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section Title -->

        <!-- Section Area - Content Central -->
        <section class="content-info">

            <div class="container paddings-mini">
                <div class="row">
                        <div class="col-lg-9">
                            <!-- Content Text-->
                            <div class="panel-box" id="container">
                                <div class="titles">
                                    <h4>Recent News</h4>
                                </div>
                                <?php
            
                                    $page = 3;
                                    $artikel = mysqli_query($dbc,"SELECT * FROM artikel");
                                    $data = mysqli_fetch_assoc($artikel);
                                    $jumlahartikel = count($data);
                                    $jumlahpage = ceil($jumlahartikel / $page)-1;
                                    $pageaktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
                                    $awaldata = ($page * $pageaktif) - $page;

                                    $cari = "SELECT id_artikel, judul_artikel, foto_artikel, 
                                            CONCAT(LEFT(isi_artikel,150), 
                                            IF(length(isi_artikel) > 150, '...', '')) as isi_artikel,
                                            waktu_posting, tanggal_posting FROM artikel where id_kategori='1' ORDER BY tanggal_posting DESC LIMIT $awaldata, $page";
                                    $hasil_cari = mysqli_query($dbc, $cari);

                                    if (mysqli_num_rows($hasil_cari) > 0) {
                                 
                                        while ($data = mysqli_fetch_array($hasil_cari)) {
                                            $id = $data['id_artikel'];
                                            $judul = $data['judul_artikel'];
                                            $gambar = $data['foto_artikel'];
                                            $artikel = $data['isi_artikel'];
                                            $tanggal = $data['tanggal_posting'];
                                            $waktu = $data['waktu_posting'];
                                        
                                ?>

                                <!-- Post Item -->
                                <div class="post-item">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="img-hover">
                                                <img class="img-responsive" src="../../../dashboard/<?php echo $data['foto_artikel']; ?>" />
                                                <div class="overlay"><a href="single-news.html">+</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h5><a href="single-news.html"><?php echo "<a href='artikel.php?id=$data[id_artikel]'>";?><?= $judul ?></a></h5>
                                            <span class="data-info"><?= $tanggal ?>  / <?= $waktu ?><i class="fa fa-comments"></i><a href="#">0</a></span>
                                            <p><?= $artikel ?><a href="single-news.html">Read More [+]</a></p>
                                        </div>
                                    </div>

                                </div>
                                <!-- End Post Item -->
                            <?php
                                        }
                                        }
                                        ?> 

                                
                            </div>
                            <!-- End Content Text-->
                            
                            <!-- navigasi -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item">
                                        <?php if($pageaktif > 1) : ?>
                                            <a class="page-link" href="?halaman=<?= $pageaktif - 1; ?>">Previous</a>
                                        <?php endif; ?>
                                    </li>

                                        <?php for($i = 1; $i <= $jumlahpage; $i++) : ?>
                                            <?php if( $i == $pageaktif) : ?>
                                            <li class="page-item active">
                                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                            </li>
                                            <?php else : ?>
                                                <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>

                                            <?php endif; ?>

                                        <?php endfor; ?>

                                        <?php if($pageaktif < $jumlahpage) : ?>
                                            <a class="page-link" href="?halaman=<?= $pageaktif + 1; ?>">Next</a>
                                        <?php endif; ?>
                            

                        </div>

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
                </div>
            </div>

        </section>
        <!-- End Section Area -  Content Central -->

<?php include("include/contact-home.php"); ?>