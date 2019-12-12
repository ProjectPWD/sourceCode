<?php include("../application/config/database/koneksi.php"); ?>

<?php include("include/header.php"); ?>
<?php include("include/navbar.php"); ?>

<?php
    session_start();
    // $_SESSION['username'] && $_SESSION['level'] == true;
    $id = $_GET['judul_artikel'];

    $cari = "SELECT id_artikel, id_kategori, judul_artikel, foto_artikel, 
            CONCAT(LEFT(isi_artikel,150), 
            IF(length(isi_artikel) > 150, '...', '')) as isi_artikel,
            waktu_posting, tanggal_posting FROM artikel order by tanggal_posting DESC";
    $hasil_cari = mysqli_query($dbc, $cari);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Admin Taribo - Sport</title>
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
                        <h3 class="box-title">Artikel Portal Berita Bola</h3>
                    </div>
                
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="tambahartikel.php" class="btn btn-sm btn-primary btn-lg"><i class="fa fa-fw fa-plus"></i> Tambah Artikel</a> <br><br>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td align="center"><b>#</b></td>
                                        <td align="center"><b>Judul</b> </td>
                                        <td align="center"><b>Gambar</b> </td>
                                        <td align="center"><b>Kutipan</b> </td>
                                        <td align="center"><b>#ID</b></td>
                                        <td align="center"><b>Waktu</b> </td>
                                        <td align="center"><b>Tanggal</b> </td>
                                        <td align="center" width="100"><b>Aksi</b> </td>



                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    
                                    if (mysqli_num_rows($hasil_cari) > 0) {
                                        $no=1;
                                        while ($data = mysqli_fetch_assoc($hasil_cari)) {
                                        
                                        // echo "
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data['judul_artikel'] ?></td>
                                            <td><img src='<?= $data['foto_artikel'] ?>' width='70' height='90' /></td>
                                            <td><?= $data['isi_artikel'] ?></td>
                                            <td><?= $data['id_kategori'] ?></td>
                                            <td><?= $data['waktu_posting'] ?></td>
                                            <td><?= $data['tanggal_posting'] ?></td>
                                             
                                            <td><?php echo "<a href='show.php?id=$data[id_artikel]'>";?><button type="button" class="btn btn-sm btn-success btn-lg"><span class="glyphicon glyphicon-eye-open"></span></button>                                
                                            <?php echo "<a href='edit.php?id=$data[id_artikel]'>";?> <button type="button" class="btn btn-sm btn-primary btn-lg"><span class="glyphicon glyphicon-edit"></span></button>
                                            <?php echo "<a href='delete.php?id=$data[id_artikel]'>";?> <button type="button" class="btn btn-sm btn-danger btn-lg"><span class="glyphicon glyphicon-trash"></span></button></td> 
                                             
                                    </tr>
                                    
                                <?php
                                    $no++;
                                           }
                                    }
                                    ?>

                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->



            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php include("include/footer.php"); ?>        