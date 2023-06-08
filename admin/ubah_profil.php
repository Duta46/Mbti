<?php
$status = FALSE;
//CEK DATA DI DATABASE
$sql_cek = mysql_query("SELECT * FROM account WHERE id_account='".$_SESSION['account_myers_briggs']['id']."'");
if (mysql_num_rows($sql_cek) > 0){
	$status = TRUE;
}

if($status){
	$hasil = mysql_fetch_array($sql_cek);
?>
<div class="row">
	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="ubah_profil_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Profil Admin</legend>

			  <input type="hidden" name="id_account" class="form-control" id="id_account" value="<?php echo $hasil['id_account'];?>" required />
			  
			  <div class="form-group">
				<label for="nama" class="col-sm-2 control-label form-label">Nama</label>
				<div class="col-sm-4">
				  <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $hasil['nama'];?>" placeholder="Nama" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="username" class="col-sm-2 control-label form-label">Username</label>
				<div class="col-sm-4">
				  <input type="text" name="username" class="form-control" id="username" value="<?php echo $hasil['username'];?>" placeholder="Username" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="password" class="col-sm-2 control-label form-label">Password</label>
				<div class="col-sm-4">
				  <input type="password" name="password" class="form-control" id="password" value="" placeholder="Password" />
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="btnSubmit" class="col-sm-2 control-label form-label"></label>
				<div class="col-sm-2">
				  <a href="index.php?hal=ta">
				  <button class="btn btn-danger" type="button" name="batal"><i class="fa fa-mail-reply"></i> Batal</button>
				  </a>
				</div>
				<div class="col-sm-2">
				  <button class="btn btn-success pull-right" type="submit" name="simpan"><i class="fa fa-save"></i> Simpan</button>
				</div>
			  </div>
			</form> 

	    </div>
	  </div>


	</div>

</div>
<?php
}else{
	echo "<script>window.location='../login.php';</script>";
}
?>