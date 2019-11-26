<?php
session_start();
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin'])) {
	include ("../../application/config/database/koneksi.php");

	if (empty($_GET['id'])) {
	    echo "<script>window.location='/dashboard/artikel/?short=verified';</script>";
	    exit;
  	}

	// Hanya Admin Yang Berhak
	if (empty($_SESSION['admin'])) {
		echo "$base_url/404";
		exit;
	}

	$id=mysqli_escape_string($dbc, $_GET['id']);
	$query=mysqli_query($dbc, "UPDATE artikel SET status=1 WHERE id_artikel='$id'");
	if ($query) {
		echo "<script>window.location='$base_url/dashboard/artikel/?short=unverified&success=Artikel Berhasil Di Konfirmasi';</script>";
	} else {
		echo "<script>window.location='$base_url/dashboard/artikel/?short=unverified&?error=Artikel Gagal Di Konfirmasi';</script>";
	}

} else {
  echo "<script>window.location='/login';</script>";
}
?>