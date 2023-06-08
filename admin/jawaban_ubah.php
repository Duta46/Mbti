<?php
$status = FALSE;
if(isset($_GET['id'])){
	//CEK DATA DI DATABASE
	$sql_cek = mysql_query("SELECT * FROM jawaban WHERE id_jawaban='".$_GET['id']."'");
	if (mysql_num_rows($sql_cek) > 0){
		$status = TRUE;
	}
}

if($status){
	$hasil = mysql_fetch_array($sql_cek);
?>
<div class="row">

	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="jawaban_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Jawaban</legend>

			  <input type="hidden" name="id_jawaban" class="form-control" id="id_jawaban" value="<?php echo $hasil['id_jawaban'];?>" required />
			  
			  <div class="form-group">
				<label for="bobot" class="col-sm-2 control-label form-label">Bobot</label>
				<div class="col-sm-4">
				  <input type="text" name="bobot" class="form-control" id="bobot" value="<?php echo $hasil['bobot'];?>" placeholder="Bobot" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="nama_jawaban" class="col-sm-2 control-label form-label">Jawaban</label>
				<div class="col-sm-4">
				  <input type="text" name="nama_jawaban" class="form-control" id="nama_jawaban" value="<?php echo $hasil['nama_jawaban'];?>" placeholder="Jawaban" required />
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="btnSubmit" class="col-sm-2 control-label form-label"></label>
				<div class="col-sm-2">
				  <a href="index.php?hal=jawaban">
				  <button class="btn btn-danger" type="button" name="batal"><i class="fa fa-mail-reply"></i> Batal</button>
				  </a>
				</div>
				<div class="col-sm-2">
				  <button class="btn btn-success pull-right" type="submit" name="ubah"><i class="fa fa-save"></i> Simpan</button>
				</div>
			  </div>
			</form> 

	    </div>
	  </div>


	</div>
	<script>
	$(document).ready(function() {

	$('#bobot').mask("00");

	});
	</script>
</div>
<?php
}else{
	echo "<script>window.location='index.php?hal=jawaban';</script>";
}
?>