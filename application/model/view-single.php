<?php
if (isset($_GET['cat'])) {
	if ($_GET['cat']=='berita') {
		echo "Halaman Berita";
	} elseif ($_GET['cat']=='lowongan') {
		include('lowongan.html');
	} elseif ($_GET['cat']=='magang') {
		include('magang.html');
	} elseif ($_GET['cat']=='event') {
		echo "Halaman Event";
	}
} else {
	include("../404.php");
}

?>