<?php include("../application/config/database/koneksi.php"); ?>

<?php include("include/header.php"); ?>
<?php include("include/navbar.php"); ?>

<?php
    $id = $_GET['id'];
    $cari = "SELECT * FROM artikel WHERE id_artikel='$id'";
            
    $hasil_cari = mysqli_query($dbc, $cari);
    // $data = mysqli_fetch_array($hasil_cari);
    if(mysqli_num_rows($hasil_cari) == 0) {
        echo "<script>window.history.back()</script";
    } else {
        $data = mysqli_fetch_assoc($hasil_cari);
    }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Edit Artikel - Taribo</title>
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
            <form role="form" action="?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                                 
                <div class="box-body">
                    <div class="form-group">
                        <label for="judul">Judul Artikel</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            placeholder="Masukkan Judul Artikel" value="<?php echo $data['judul_artikel'] ?>">
                    </div>
                    <div class="form-group">
                        <img src="<?php echo $data['foto_artikel'] ?>" width='150' height='120'>
                    </div>
                    <div class="form-group">
                        <label for="gambar">File Gambar (Jpg, Png, etc.)</label> <br>
                        <p><?php echo $data['foto_artikel'] ?></p>
                        
                    </div>
                    <!-- Date -->
                    <div class="form-group">
                        <label>Tanggal Posting</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" value="<?php echo $data['tanggal_posting'] ?>">
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
                            <input type="text" class="form-control pull-right timepicker" id="timepicker" name="waktu" value="<?php echo $data['waktu_posting'] ?>">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <div class="form-group">
                        <label for="judul">Kategori</label>
                        <select class="form-control" name="kategori" value="<?php echo $data['nama_kategori'] ?>">
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
                            
                            <div class="box-body pad">
                                <textarea class="ckeditor" id="editor1" rows="10" cols="80" name="artikel" value="<?php echo $data['isi_artikel'] ?>"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-fw fa-edit "></i>Edit</button>
                    </button>
                </div>

            </form>

            <?php
            error_reporting(E_ALL ^ E_NOTICE);
            if (isset($_POST['submit'])) {
                $judul = $_POST['judul'];
                $gambar = $_FILES['gambar'];
                $tanggal = $_POST['tanggal'];
                $waktu = $_POST['waktu'];
                $kategori = $_POST['kategori'];
                $artikel = $_POST['artikel'];
                $submit = $_POST['submit'];
            //$update = "UPDATE 'artikel' SET  'id_kategori'='$kategori', 'judul_artikel'='$judul', 'foto_artikel'='$gambar', 'tanggal_posting'='$tanggal', 'waktu_posting'='$waktu', 'isi_artikel'='$artikel' WHERE 'id_artikel'='$id'";
            $update = "UPDATE `artikel` SET `id_kategori`='$kategori',`judul_artikel`='$judul', `isi_artikel`='$artikel',`tanggal_posting`='$tanggal',`waktu_posting`='$waktu' WHERE id_artikel='$id'";
            // print_r($_POST);
            // print_r($_FILES);
            // die;
            if ($update) {
                if ($judul == '') {
                    echo "<script>alert('Judul Artikel Tidak Boleh Kosong!');</script";
                // } elseif ($gambar == '') {
                //     echo "<script>alert('Gambar Artikel Tidak Boleh Kosong!');</script";
                } elseif ($tanggal == '') {
                    echo "<script>alert('Tanggal Artikel Tidak Boleh Kosong!');</script";
                } elseif ($waktu == '') {
                    echo "<script>alert('Waktu Artikel Tidak Boleh Kosong!');</script";
                } elseif ($kategori == '') {
                    echo "<script>alert('Kategori Artikel Tidak Boleh Kosong!');</script";
                } elseif ($artikel == '') {
                    echo "<script>alert('Artikel Tidak Boleh Kosong!');</script";
                } else {
                    mysqli_query($dbc, $update);
                        echo "<script>
                                    alert('Data Artikel Berhasil di Edit!');
                                    document.location.href='artikel.php';
                                </script>"; 
                }

            }
        }
        
?>


        </div>
        <!-- /.box -->



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include("include/footer.php"); ?>
