<?php
// function generateID($dbc) {
// 	$ID=null;
// 	$exit=0;
// 	while ($exit==0 AND $ID==null) {
// 		$mysql=mysqli_query($dbc, "SELECT max(id_user) FROM users");
// 		if($mysql) {
// 			$ID=mysqli_fetch_array($mysql)[0];
// 			$exit=1;
// 		}
// 	}

// 	return $ID;
// }
function generateID($dbc) {
	$mysql=mysqli_query($dbc, "SELECT max(id_user) FROM users");
	$ID=mysqli_fetch_array($mysql)[0];
	return $ID+1;
}

function checkUsername($dbc, $username) {
	$mysql=mysqli_query($dbc, "SELECT username FROM users WHERE username='$username'");

	return mysqli_num_rows($mysql);
}
?>