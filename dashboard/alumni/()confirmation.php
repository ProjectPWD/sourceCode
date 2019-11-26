<?php
session_start();
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin'])) {
	include ("../../application/config/database/koneksi.php");

	if (empty($_GET['id'])) {
	    echo "<script>window.location='/dashboard/alumni/';</script>";
	    exit;
  	}

	// Hanya Admin Yang Berhak
	if (empty($_SESSION['admin'])) {
		echo "$base_url/404";
		exit;
	}

	$id=mysqli_escape_string($dbc, $_GET['id']);
	$query=mysqli_query($dbc, "UPDATE users SET status=1 WHERE id_user='$id'");
	if ($query) {
		echo "<script>window.location='$base_url/dashboard/alumni/?success=Alumni dengan ID $_GET[id] berhasil di Konfirmasi';</script>";
	} else {
		echo "<script>window.location='$base_url/dashboard/alumni/?error=Alumni dengan ID $_GET[id] berhasil di Konfirmasi';</script>";
	}

} else {
  echo "<script>window.location='/login';</script>";
}
?>