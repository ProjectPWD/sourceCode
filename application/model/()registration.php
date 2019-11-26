<?php
session_start();
include("../config/configuration/settings.php");
if (!isset($_SESSION['admin']) AND empty($_SESSION['alumni'])) {
	include ("../config/database/koneksi.php");
	include("../config/configuration/generateIDuser.php");
	$error=array();
	$maxfile=512000; #500KB
	# GET Biodata
	$username=mysqli_escape_string($dbc, $_POST['username']);
	$password=md5(mysqli_escape_string($dbc, $_POST['password']));
	$nama=mysqli_escape_string($dbc, $_POST['nama']);
	$jk=mysqli_escape_string($dbc, $_POST['jk']);
	$alamat=mysqli_escape_string($dbc, $_POST['alamat']);
	$nohp=mysqli_escape_string($dbc, $_POST['nohp']);
	$tglahir=mysqli_escape_string($dbc, $_POST['tglahir']);

	# Check Username dan Email
	if (checkUsername($dbc, $username) == 1) {
		$err="Username telah terdaftar";
		echo "<script>window.location='http://localhost/registration/?error=$err';</script>";
	} else { 
		# GET File Input
		$fotoAlumni=getdate()[0].basename($_FILES["fotoAlumni"]["name"]);
		$fotoIjazah=getdate()[0].basename($_FILES["fotoIjazah"]["name"]);
		$sizeAlumni=$_FILES['fotoAlumni']['size'];
		$sizeIjazah=$_FILES['fotoIjazah']['size'];

		# SETTING File Input
		$targetFileAlumni = "../../assets/img/alumni/" . $fotoAlumni;
		$fileTypeAlumni = pathinfo($targetFileAlumni,PATHINFO_EXTENSION);

		$targetFileIjazah = "../../assets/img/ijazah/" . $fotoIjazah;
		$fileTypeIjazah = pathinfo($targetFileIjazah,PATHINFO_EXTENSION);

		# Proses upload
		if ($sizeAlumni > $maxfile OR $sizeIjazah > $maxfile) {
			$err="File melebihi batas maksimal kententuan 500 KB";
			echo "<script>window.location='http://localhost/registration/?error=$err';</script>";
		} else {
			$allowTypes = array('jpg','png','jpeg');
			if(in_array($fileTypeAlumni, $allowTypes)){
				if (in_array($fileTypeIjazah, $allowTypes)) {
					$pindahA=move_uploaded_file($_FILES["fotoAlumni"]["tmp_name"], $targetFileAlumni);
					$pindahB=move_uploaded_file($_FILES["fotoIjazah"]["tmp_name"], $targetFileIjazah);
					if($pindahA==true AND $pindahB==True){
						$id=generateID($dbc);
						# Insert into Database
						$mysql=mysqli_query($dbc, "INSERT INTO users(id_user, username, password, nama_alumni, alamat_alumni, jenis_kelamin, no_hp, tgl_lahir, ijazah, foto_alumni, level_id_level, status) VALUES ('$id','$username','$password','$nama','$alamat','$jk','$nohp','$tglahir','$fotoIjazah','$fotoAlumni',2,0)");
						if ($mysql) {
							echo "<script>window.location='http://localhost/registration/?success=true';</script>";
						} else {
							# Delete All File
			        		unlink($targetFileAlumni);
			        		unlink($targetFileIjazah);
			        		$err="Pendaftaran Gagal, Error Inserting Data.";
							echo "<script>window.location='http://localhost/registration/?error=$err';</script>";
						}
		        	} else {
		        		# Delete All File
		        		unlink($targetFileAlumni);
		        		unlink($targetFileIjazah);
		        		$err="Foto Ijazah/Alumni Gagal di Upload";
						echo "<script>window.location='http://localhost/registration/?error=$err';</script>";
		        	}
				} else {
					$err="Format Foto Ijazah tidak Benar";
					echo "<script>window.location='http://localhost/registration/?error=$err';</script>";
				}
			} else {
				$err="Format Foto Alumni tidak Benar";
				echo "<script>window.location='http://localhost/registration/?error=$err';</script>";
			}
		}
	}


} else {
	echo "<script>window.location='$baseurl/dashboard';</script>";
}
?>