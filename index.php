<?php include("application/config/database/koneksi.php"); ?>
<?php include("header.php"); ?>

<!-- section-hero-posts-->
<div class="hero-header">
    <!-- Hero Slider-->
    <div id="hero-slider" class="hero-slider">

        <!-- Item Slide-->
        <div class="item-slider" style="background:url(assets/img/slide/3.jpg);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="info-slider">
                            <h1>Aktual</h1>
                            <p>Memberikan sajian berbagai macam berita bola yang sangat menarik dan sesuai fakta yang ada.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Item Slide-->

        <!-- Item Slide-->
        <div class="item-slider" style="background:url(assets/img/slide/2.jpg);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="info-slider">
                            <h1>Menarik</h1>
                            <p>Memberikan sajian berita yang lagi hangat dalam perbincangan masyarakat luas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Item Slide-->

        <!-- Item Slide-->
        <div class="item-slider" style="background:url(assets/img/slide/1.jpg);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="info-slider">
                            <h1>Luas</h1>
                            <p>Memberikan sajian berita dan informasi luas baik dari dalam dan luar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Item Slide-->

    </div>
    <!-- End Hero Slider-->
</div>
<!-- End section-hero-posts-->

<!-- Section Area - Content Central -->
<section class="content-info">

    <!-- White Section -->
    <div class="white-section paddings">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <img src="assets/img/siwal.jpg" alt="">
                </div>
                <div class="col-lg-7">
                    <h4 class="subtitle">
                        <!-- <span>Company Value</span> -->
                        Taribo Portal
                    </h4>
                    <p>Website ini merupakan salah satu tugas dari Mata Kuliah Pemrograman Web Dinamis &hearts;</p>

                    <h4 class="subtitle">
                        <!-- <span>Company Value</span> -->
                        
                    </h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Aktual</h5>
                            <p>Memberikan sajian berbagai macam berita bola yang sangat menarik dan sesuai fakta yang ada. </p>
                        </div>
                        <div class="col-lg-4">
                            <h5>Menarik</h5>
                            <p>Memberikan sajian berita yang lagi hangat dalam perbincangan masyarakat luas.</b></p>
                        </div>
                        <div class="col-lg-4">
                            <h5>Luas</h5>
                            <p>Memberikan sajian berita dan informasi luas baik dari dalam dan luar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End White Section -->

    <!-- Parallax Section - Testimonials -->
    <div class="parallax-section parallax-total" style="background:url(assets/img/slide/3.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="text-center padding-bottom">
                        <h2>Our Team Developer <span class="text-resalt">Taribo</span> Portal.</h2>
                        <p>Team work and Hard work.</p>
                    </div>

                    <ul class="testimonials testimonials-carousel">
                        <li>
                            <blockquote>
                                <p>Tetaplah mencoba suatu hal yang baru, agar hidupmu penuh tantangan dan nikmatilah tantangan yang ada. <br><b> - Front End Developer</b></p>
                                <img src="assets/img/naufal.jpg" alt="">
                                <strong>Naufal Alip Pratama</strong><a href="https://www.instagram.com/naufalipp">@naufalipp</a>
                            </blockquote>
                        </li>
                        <li>
                            <blockquote>
                                <p>Kegagalan adalah sebuah proses untuk mencapai suatu kesuksesanmu, maka hargailah kegagalanmu dan tetaplah bersyukur. <br><b> - Back End Developer</b></p>
                                <img src="assets/img/alvicky.jpg" alt="">
                                <strong>Muhammad Vicky Al Hasri</strong><a href="https://www.instagram.com/alvicky__/">@alvicky__</a>
                            </blockquote>
                        </li>
                        <li>
                            <blockquote>
                                <p>Tak peduli seberapa sering kau gagal, <br> Yang terpenting seberapa cepat kau bangkit dari kegagalan. <br><b> - UI / UX Desainer</b></p>
                                <img src="assets/img/haiqal.jpg" alt="">
                                <strong>Fikri Zaki Haiqal</strong><a href="https://www.instagram.com/iqal16">@iqal16</a>
                            </blockquote>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Gray Section - Testimonials -->

    

            </div>
        </div>
    </div>
    <!-- End White Section -->

    <!-- End gray Section -->
    <div class="default-section paddings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center padding-bottom">
                        <h2>Our <span class="text-resalt">News</span></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Resalt-->
        <center>
            <div id="ri-grid" class="ri-grid ri-grid-size-1">
            <?php
                $cari = "SELECT foto_artikel FROM artikel ORDER BY tanggal_posting DESC LIMIT 0,6";
                $hasil_cari = mysqli_query($dbc, $cari);

                if (mysqli_num_rows($hasil_cari) > 0) {

                while ($data = mysqli_fetch_array($hasil_cari)) {
                    
            ?>
                <!-- <img class="ri-loading-image" src="assets/img/grid/loading.gif" alt="Image"> -->
                <ul>
                    <li><a href="#"><img src="dashboard/<?php echo $data['foto_artikel']; ?>" alt="Image"></a></li>
                    
                </ul>
                <?php
                            }
                            }
                            ?>
            </div>
        </center>
        <!-- End Info Resalt-->

    </div>
    <!-- End Gray Section -->



    <?php include("contact-home.php"); ?>