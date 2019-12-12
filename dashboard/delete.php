<?php
    include("../application/config/database/koneksi.php");

    $id = $_GET['id'];
    $delete = "DELETE FROM artikel WHERE id_artikel='$id'";
    $data = mysqli_query($dbc, $delete) ;

    if ($data>0) {    
        echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href='artikel.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href='artikel.php';
            </script>";
    }

?>