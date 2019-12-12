<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Tambah Artikel - Taribo</title>
<?php include("../application/config/database/koneksi.php"); ?>

<?php include("include/header.php"); ?>
<?php include("include/navbar.php"); ?>

<?php
    if (isset($_POST['tambah'])) {
        $judul = $_POST['judul'];
        $artikel = $_POST['artikel'];
        $tanggal = $_POST['tanggal'];
        $waktu = $_POST['waktu'];
        $kategori = $_POST['kategori'];
        
        $folder = "uploadGambar/";
        if (!empty($_FILES['gambar']["tmp_name"])) {
            $jenisGambar = $_FILES["gambar"]["type"];
            if ($jenisGambar = "image/jpeg" || $jenisGambar = "image/jpg" || $jenisGambar = "image/png") {
                $gambar = $folder.basename($_FILES['gambar']['name']);
                
                
                $cekJudul= "SELECT * FROM artikel WHERE judul_artikel='$_POST[judul]'"; 
                $prosesCek= mysqli_query($dbc, $cekJudul);
            if (mysqli_num_rows($prosesCek)>0) { 
                    echo "<script>alert('Judul Artikel Sudah Ada!');history.go(-1) </script>";
                } else {
                    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar)) {                    
                        $query = "INSERT INTO artikel (id_artikel, id_kategori, judul_artikel, foto_artikel, isi_artikel, tanggal_posting, waktu_posting) VALUES ('','$kategori', '$judul', '$gambar', '$artikel', '$tanggal', '$waktu')";
                        $insert = mysqli_query($dbc, $query);
                        if(!$insert ){
                            echo "<script>alert('Gagal di tambahkan!');history.go(-1);</script>";
                            } else{
                            echo "<script>alert('Data berhasil di tambahkan!');
                                    document.location.href='artikel.php';
                            </script>";
                        }
                }
            }
        }
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard Artikel
            <!-- <small>Control panel</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard Artikel</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Artikel Portal Berita Bola</h3>
            </div>
            <!-- form start -->
            <form role="form" action="tambahartikel.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="judul">Judul Artikel</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            placeholder="Masukkan Judul Artikel">
                    </div>
                    <div class="form-group">
                        <label for="gambar">File Gambar (Jpg, Png, etc.)</label>
                        <input type="file" id="gambar" name="gambar">
                    </div>
                    <!-- Date -->
                    <div class="form-group">
                        <label>Tanggal Posting</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="tanggal">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- Time -->
                    <div class="form-group">
                        <label>Waktu Posting</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right timepicker" id="timepicker" name="waktu">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <div class="form-group">
                        <label for="judul">Kategori</label>
                        <select class="form-control" name="kategori">
                            <?php
                                        $sql = mysqli_query($dbc, "SELECT * FROM kategori");
                                        while ($result = mysqli_fetch_array($sql)) {            
                                    ?>
                            <option value="<?php echo $result['id_kategori'] ?>"><?php echo $result['nama_kategori'] ?>
                            </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Artikel</h3>
                            <!-- <label for="judul">Judul Artikel</label> -->
                            <div class="box-body pad">
                                <textarea id="editor1" rows="10" cols="80" name="artikel"></textarea>
                            </div>
                            <!-- <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Artikel"> -->
                        </div>
                    </div>

                    <!-- <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Artikel
                                    </h3>
                                </div> -->
                    <!-- /.box-header -->
                    <!-- <div class="box-body pad">
                                        <textarea id="editor1" rows="10" cols="80" name="artikel">
                                </div>
                            </div> -->

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="tambah"><i class="fa fa-fw fa-plus"></i>Tambah</button>
                    </button>
                </div>

                <!-- <div class="modal modal-info fade" id="modal-info">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Info Modal</h4>
                            </div>
                            <div class="modal-body">
                                <p>One fine body&hellip;</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left"
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-outline">Save changes</button>
                            </div>
                        </div> -->
                        <!-- /.modal-content -->
                    <!-- </div> -->
                    <!-- /.modal-dialog -->
                <!-- </div> -->
                <!-- /.modal -->

                <!-- <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="tambah"><i class="fa fa-fw fa-plus"></i>Tambah</button>
                        </div> -->
            </form>


        </div>
        <!-- /.box -->



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include("include/footer.php"); ?>