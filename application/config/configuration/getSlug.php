<?php
include ("../../application/config/configuration/settings.php");
if (isset($_SESSION['admin']) OR !empty($_SESSION['alumni'])) {
	function isSlugExist($data, $dbc) {
		$data=mysqli_escape_string($dbc, $data);
		$query=mysqli_query($dbc, "SELECT slug FROM artikel WHERE slug='$data'");

		if(mysqli_num_rows($query) > 0) {
			return True;
		} else {
			return False;
		}
	}

	function createSlug($data, $dbc) {
		$replace = '-';         
	    $data = strtolower($data);     
	    //replace / and . with white space     
	    $data = preg_replace("/[\/\.]/", "", $data);     
	    $data = preg_replace("/[^a-z0-9_\s-]/", "", $data);     
	    //remove multiple dashes or whitespaces     
	    $data = preg_replace("/[\s-]+/", " ", $data);     
	    //convert whitespaces and underscore to $replace     
	    $data = preg_replace("/[\s_]/", $replace, $data);     
	    //limit the slug size     
	    $data = substr($data, 0, 200);

	    $final=$data;

		if(isSlugExist($final, $dbc)) {

			$i = 1; $baseSlug=$final;
			while(isSlugExist($final)){
			    $final = $baseSlug . "-" . $i++;        
			}

			return $final;
		}

		return $final.".html";
	}

	function createIDarticle($dbc) {
		$query=mysqli_query($dbc, "SELECT max(id_artikel) FROM artikel");
		$id=mysqli_fetch_array($query)[0] + 1;

		return $id;
	}
} else {
  echo "<script>window.location='/login';</script>";
}
?>