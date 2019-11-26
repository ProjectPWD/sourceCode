<?php
include("application/config/database/koneksi.php");


$query=mysqli_query($dbc, "SELECT * FROM kategori");

while($data=mysqli_fetch_array($query)) {
	print($data['id_kategori'].$data['nama_kategori'].'<br>');
}

?>