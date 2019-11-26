<?php
session_start();
use Gregwar\Image\Image;
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
  include("../../application/config/database/koneksi.php");
  include("../../application/config/configuration/getSlug.php");
  require("../../application/config/vendor/autoload.php");

  #
  if (isset($_SESSION['admin'])) {
    $datauser=$_SESSION['admin'];
    $level="admin";
  } elseif (isset($_SESSION['alumni'])) {
    $datauser=$_SESSION['alumni'];
    $level="alumni";
  }

  # Tangkap Data
  $judul=mysqli_escape_string($dbc, $_POST['title']);
  $pict=getdate()[0].'-'.mysqli_escape_string($dbc, $_FILES['gambar']['name']);
  $kategori=mysqli_escape_string($dbc, $_POST['kategori']);
  $konten=mysqli_escape_string($dbc, $_POST['content']);  

  # Cek kategori
  $query=mysqli_query($dbc, "SELECT id_kategori FROM kategori WHERE id_kategori='$kategori'");
  if (mysqli_num_rows($query) == 0) {
    echo "<script>window.location='$base_url/dashboard/article/add.php?error=Kategori Tidak Ada';</script>";
    exit;
  }

  # Buat ID
  $id=createIDarticle($dbc);

  # Buat Slug
  $slug=createSlug($judul, $dbc);

  # Setting gambar
  $maxSize=1024000; # 1MB
  $sizeGambar=$_FILES['gambar']['size'];
  $locHD="../../assets/img/post/hd/".$pict;
  $locTMB="../../assets/img/post/thumb/".$pict;
  $fileType = pathinfo($locHD,PATHINFO_EXTENSION);

  # Upload Gambar
  if ($sizeGambar > $maxSize) {
    echo "<script>window.location='$base_url/dashboard/article/add.php?error=File melebihi batas maksimal kententuan 1 MB';</script>";
  } else {
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
      $hd=move_uploaded_file($_FILES["gambar"]["tmp_name"], $locHD);
      if(file_exists($locHD)) {
        // Generate to thumb
        $genTMB=Image::open($locHD)->zoomCrop(150,150)->save($locTMB);
 
        if (file_exists($locTMB)) {
          # Save to Database as level's user
          if ($level=="admin") {
            $query=mysqli_query($dbc, "INSERT INTO artikel(id_artikel, judul, slug, pict, status, content, create_at, kategori_id_kategori, users_id_user) VALUES ('$id','$judul','$slug','$pict',1,$konten,CURRENT_TIMESTAMP,'$kategori',$datauser[id_user])");
            if ($query) {
              echo "<script>window.location='$base_url/dashboard/article/add.php?success=true&status=1';</script>";
            } else {
              unlink($locHD);
              unlink($locTMB);
              echo "<script>window.location='$base_url/dashboard/article/add.php?error=Tambah Artikel Gagal';</script>";
            }
          } elseif ($level=="alumni") {
            $query=mysqli_query($dbc, "INSERT INTO artikel(id_artikel, judul, slug, pict, status, content, create_at, kategori_id_kategori, users_id_user) VALUES ('$id','$judul','$slug','$pict',0,'$konten',CURRENT_TIMESTAMP,'$kategori','$datauser[id_user]')");
            if ($query) {
              echo "<script>window.location='$base_url/dashboard/article/add.php?success=true&status=0';</script>";
            } else {
              unlink($locHD);
              unlink($locTMB);
              echo "<script>window.location='$base_url/dashboard/article/add.php?error=Tambah Artikel Gagal';</script>";
            }
          } else {
            echo "<script>window.location='$base_url/dashboard/article/add.php?error=Access Deined, unkown user.';</script>";
          }
        } else {
          unlink($locHD);
          echo "<script>window.location='$base_url/dashboard/article/add.php?error=Upload gambar thumbnail gagal.';</script>";
        }
      } else {
          echo "<script>window.location='$base_url/dashboard/article/add.php?error=Upload gambar gagal.';</script>";
      }
    } else {
      echo "<script>window.location='$base_url/dashboard/article/add.php?error=Format gambar tidak dizinkan.';</script>";
    }
  }


} else {
  echo "<script>window.location='/login';</script>";
}
?>