<?php
session_start();
use Gregwar\Image\Image;
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
  include("../../application/config/database/koneksi.php");
  include("../../application/config/configuration/getSlug.php");
  require("../../application/config/vendor/autoload.php");

  # Filter & Cek ada id Artikel atau tidak
  if (!isset($_GET['id'])) {
    echo "<script>window.location='/dashboard/artikel/';</script>";
    exit;
  }

  # Cek Apakah artikel tersedia dan user berhak edit.
  $id_article=mysqli_escape_string($dbc, $_GET['id']);
  if (isset($_SESSION['admin'])) {
    # Admin mempunyai wewenang terhadap seluruh artikel.
    $datauser=$_SESSION['admin'];
    $level="admin";
    $query=mysqli_query($dbc, "SELECT * FROM artikel WHERE id_artikel='$id_article'");
    $dbpict=mysqli_fetch_array($query)['pict'];

  } elseif (isset($_SESSION['alumni'])) {
    # User hanya mempunyai wewenang terhadap artikelnya sendiri.
    $datauser=$_SESSION['alumni'];
    $level="alumni";
    $query=mysqli_query($dbc, "SELECT * FROM artikel WHERE id_artikel='$id_article' AND users_id_user='$datauser[id_user]'");
    $dbpict=mysqli_fetch_array($query)['pict'];
  } else {
    # Apabila tidak mempunyai session
    echo "<script>alert('{WHOOPS:SECURED by SurakartaHax0r}');window.location='/dashboard/artikel/';</script>";
  }

  # Apakah diizinkan
  if (mysqli_num_rows($query) == 0) {
    # code...
    echo "<script>window.location='/dashboard/artikel/';</script>";
  } else {
    # dizinkan
    # Ambil data
    $judul=mysqli_escape_string($dbc, $_POST['title']);
    $kategori=mysqli_escape_string($dbc, $_POST['kategori']);
    $content=mysqli_escape_string($dbc, $_POST['content']);

    # Cek kategori
    $query=mysqli_query($dbc, "SELECT id_kategori FROM kategori WHERE id_kategori='$kategori'");
    if (mysqli_num_rows($query) == 0) {
      echo "<script>window.location='$base_url/dashboard/artikel/add.php?error=Kategori Tidak Ada';</script>";
      exit;
    }

    # Buat Slug
    $slug=createSlug($judul, $dbc);

    # cek apakah menyertakan gambar ?
    if (isset($_FILES['gambar']) AND $_FILES['gambar']['name']!=Null) {
      $maxSize=1024000; # 1MB
      $sizeGambar=$_FILES['gambar']['size'];
      $pict=getdate()[0].'-'.mysqli_escape_string($dbc, $_FILES['gambar']['name']);
      $locHD="../../assets/img/blog/hd/".$pict;
      $locTMB="../../assets/img/blog/thumb/".$pict;
      $fileType = pathinfo($locHD,PATHINFO_EXTENSION);

      # Upload Gambar
      if ($sizeGambar > $maxSize) {
        echo "<script>window.location='$base_url/dashboard/artikel/edit.php?id=$id_article&error=File melebihi batas maksimal kententuan 1 MB';</script>";
      } else {
        $allowTypes = array('jpg','png','jpeg');
        if(in_array($fileType, $allowTypes)){
          # Format dizinkan
          move_uploaded_file($_FILES["gambar"]["tmp_name"], $locHD);
          if(file_exists($locHD)) {
            if ($dbpict!=Null) {
              if (file_exists('../../assets/img/blog/hd/'.$dbpict)) {
                unlink('../../assets/img/blog/hd/'.$dbpict);
              }
              if (file_exists('../../assets/img/blog/thumb/'.$dbpict)) {
                unlink('../../assets/img/blog/thumb/'.$dbpict);
              }
            }
            # upload SD
            $genTMB=Image::open($locHD)->zoomCrop(150,150)->save($locTMB);
          } else {
            $pict=$dbcpict;
          }
          # menyertakan gambar
          $query=mysqli_query($dbc, "UPDATE artikel SET judul='$judul',slug='$slug',pict='$pict',content='$content',kategori_id_kategori='$kategori' WHERE id_artikel='$id_article'");
        } else {
          echo "<script>window.location='$base_url/dashboard/artikel/edit.php?id=$id_article&error=Format gambar tidak dizinkan.';</script>";
          exit;
        }
      }
    } else {
      # Tidak menyertakan gambar
      $query=mysqli_query($dbc, "UPDATE artikel SET judul='$judul',slug='$slug',pict=Null,content='$content',kategori_id_kategori='$kategori' WHERE id_artikel='$id_article'");
    }

    if ($query) {
      echo "<script>window.location='$base_url/dashboard/artikel/edit.php?id=$id_article&success=true';</script>";
    }
  }
} else {
  echo "<script>window.location='/login';</script>";
}
?>