<?php
session_start();
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
  include("../../application/config/database/koneksi.php");
  include("../../application/config/configuration/getSlug.php");
  require("../../application/config/vendor/autoload.php");

  # Filter & Cek ada id Artikel atau tidak
  if (!isset($_GET['id'])) {
    echo "<script>window.location='/dashboard/artikel';</script>";
    exit;
  }

  # Cek Apakah artikel tersedia dan user berhak edit.
  $id_article=mysqli_escape_string($dbc, $_GET['id']);
  if (isset($_SESSION['admin'])) {
    # Admin mempunyai wewenang terhadap seluruh artikel.
    $datauser=$_SESSION['admin'];
    $level="admin";
    $query=mysqli_query($dbc, "SELECT * FROM artikel WHERE id_artikel='$id_article'");
  } elseif (isset($_SESSION['alumni'])) {
    # User hanya mempunyai wewenang terhadap artikelnya sendiri.
    $datauser=$_SESSION['alumni'];
    $level="alumni";
    $query=mysqli_query($dbc, "SELECT * FROM artikel WHERE id_artikel='$id_article' AND users_id_user='$datauser[id_user]'");
  } else {
    # Apabila tidak mempunyai session
    echo "<script>alert('{WHOOPS:SECURED by SurakartaHax0r}');window.location='/dashboard/artikel';</script>";
  }

  # Apakah diizinkan
  if (mysqli_num_rows($query) == 0) {
    # code...
    echo "<script>window.location='/dashboard/artikel/';</script>";
  } else {
  	$dbpict=mysqli_fetch_array($query)['pict'];
  	$query=mysqli_query($dbc, "DELETE FROM artikel WHERE id_artikel='$id_article'");
  	if ($query) {
  		if ($dbpict!=null) {
  			 error_reporting(0);
			   unlink('../../assets/img/post/hd/'.$dbpict);
			   unlink('../../assets/img/post/thumb/'.$dbpict);
		  }
		  echo "<script>window.location='/dashboard/artikel/?short=verified&success=Artikel dengan ID $_GET[id] Berhasil dihapus';</script>";
  	} else {
		  echo "<script>window.location='/dashboard/artikel/?short=verified&error=Artikel dengan ID $_GET[id] Gagal di Hapus';</script>";	
  	}
  }

} else {
  echo "<script>window.location='/login';</script>";
}
?>