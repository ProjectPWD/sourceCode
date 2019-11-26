<?php
session_start();

include ("../config/configuration/settings.php");
if (!isset($_SESSION['admin']) AND empty($_SESSION['alumni'])) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  </head>
  <body>
  	
    <!-- <h1>Hello, world!</h1> -->
    <div class="jumbotron text-center">
    	<h1>Registration Alumni</h1>
    </div>

    <div class="container" style="background: #eee; background-size: cover; padding: 20px;">
    	<div style="margin-bottom: 0px;"></div>
    	<div class="alert alert-danger alert-dismissible fade show" role="alert" id="gambarFailed" style="display: none; padding-top: 0px;">
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  			</button>
  			<strong>Ukuran Gambar Maksimal 2MB.</strong>
    	</div>
    	<?php if (isset($_GET['success'])) { ?>
    	<div class="alert alert-success alert-dismissible fade show" role="alert" id="gambarFailed">
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  			</button>
  			<strong>Pendaftaran Berhasil !!</strong><br>
  			<p>
  			Silahkan login <a href="<?php echo $base_url;?>/login">disini</a> dengan mengisikan username dan password yang anda daftarkan tadi.
  			</p>
    	</div>
    	<?php } ?>
    	<?php if (isset($_GET['error'])) { 
    	?>
    	<div class="alert alert-danger alert-dismissible fade show" role="alert" id="gambarFailed">
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  			</button>
  			<strong>Pendaftaran Gagal !!</strong><br>
  			<p>
  			<?php echo $_GET['error']; ?>, Silahkan ulangi pendaftaran anda <code>Terimakasih</code>
  			</p>
    	</div>
    	<?php } ?>
    	<form action="<?php echo $base_url; ?>/registration/post" method="POST" enctype="multipart/form-data">
	    	<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" placeholder="Username..." class="form-control">
        <small id="helpUsername" class="form-text text-muted" style="display: none;"><strong style="color: red;">Username telah terpakai</strong></small>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="Password..." class="form-control">
			</div>
			<div class="form-group">
				<label for="nama">Nama Lengkap</label>
				<input type="text" name="nama" id="nama" placeholder="Nama Lengkap..." class="form-control">
			</div>
			<div class="form-group">
				<label for="jk">Jenis Kelamin</label>
				<select name="jk" id="jk" class="form-control">
					<option value="L">Laki-laki</option>
					<option value="P">Perempuan</option>
				</select>
			</div>
			<div class="form-group">
				<label for="nohp">Nomor HP (WA)</label>
				<input type="text" name="nohp" id="nohp" placeholder="Nomor Handphone.." class="form-control">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Tanggal Lahir</label>
				<input type="date" name="tglahir" id="tglahir" class="form-control">
			</div>
			<div class="form-group">
				<label for="alamat">Alamat</label>
				<textarea name="alamat" id="alamat" class="form-control" style="width: 50; height: 50" placeholder="Alamat.."></textarea>
			</div>
			<div class="form-group">
				<label for="fotoAlumni">Foto Alumni ( Universitas )</label>
				<input type="file" class="form-control" id="fotoAlumni" name="fotoAlumni" aria-describedby="fotoAlumniHelp">
				<small id="helpFotoAlumni" class="form-text text-muted" style="display: none;">Foto berformat <strong style="color: red;">jpg/png/jpeg</strong> dan berukuran <strong style="color: red;">MAX 500 KB</strong>.</small>
			</div>
			<div class="form-group">
				<label for="fotoIjazah">Foto Ijazah ( Universitas )</label>
				<input type="file" class="form-control" id="fotoIjazah" name="fotoIjazah" aria-describedby="fotoIjazahHelp">
				<small id="helpFotoIjazah" class="form-text text-muted" style="display: none;">Foto berformat <strong style="color: red;">jpg/png/jpeg</strong> dan berukuran <strong style="color: red">MAX 500 KB</strong>.</small>				
			</div>
			<div class="form-group">
				<div class="text-center">
					<button class="btn btn-primary btn-sm" name="registration" id="registration">DAFTAR</button>
					<button class="btn btn-warning btn-sm">CANCEL</button>
				</div>
				<br>
			</div>
		</form>
		
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo $base_url; ?>/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>

    <!-- Costum JS -->
    <script type="text/javascript">
    	$('#fotoAlumni').bind('change', function(){
    		var maxSize=0.8; // 800KB
    		var fileSize=this.files[0].size/1024/1024;

    		if (fileSize >= maxSize) {
    			$('#registration').attr('disabled',true);
    			$('#fotoAlumni').addClass('is-invalid');
    			$('#helpFotoAlumni').show();
    			// $('#registration').attr('disabled',false);
    		} else {
    			$('#registration').attr('disabled',false);
    			$('#fotoAlumni').removeClass('is-invalid');
    			$('#fotoAlumni').addClass('is-valid');
    			$('#helpFotoAlumni').hide();

    		}
    	});
    	$('#fotoIjazah').bind('change', function(){
    		var maxSize=0.8; // 2MB
    		var fileSize=this.files[0].size/1024/1024;

    		if (fileSize >= maxSize) {
    			$('#registration').attr('disabled',true);
    			$('#fotoIjazah').addClass('is-invalid');
    			$('#helpFotoIjazah').show();
    		} else {
    			$('#registration').attr('disabled',false);
    			$('#fotoIjazah').removeClass('is-invalid');
    			$('#fotoIjazah').addClass('is-valid');
    			$('#helpFotoIjazah').hide();

    		}
    	});
      $("#username").change(function(){
        var username=$("#username").val();
        $.ajax({
          type:"post",
          url:"<?php $base_url; ?>/registration/check/?check=username",
          data:"username="+username,
          success:function(data){
            if(data==0){
              $('#username').removeClass('is-invalid');
              $('#username').addClass('is-valid');
              $('#helpUsername').hide();
              console.log(data);
            } else {
              $('#username').addClass('is-invalid');
              $('#helpUsername').show();
              console.log(data);
            }
          }
        });
      });
    </script>
  </body>
</html>
<?php
} else {
	echo "<script>window.location='/dashboard';</script>";
}
?>