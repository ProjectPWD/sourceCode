<?php
session_start();
if (isset($_POST['username']) OR !empty($_POST['email'])) {
	if (isset($_GET['check'])) {
		include ("../database/koneksi.php");
		if ($_GET['check']=='username') {
			$username=mysqli_escape_string($dbc,$_POST['username']);
			$mysql=mysqli_query($dbc, "SELECT username FROM users WHERE username='$username'");
			echo mysqli_num_rows($mysql);
		}
		if ($_GET['check']=='email') {
			# code...
		}
	} else {
		echo "{as} WHAT DO YOU WANT GO HERE BITCH ??";
	}
} else {
	echo "{WHOOPS} WHAT DO YOU WANT GO HERE BITCH ??";
}
?>