<?php
$status = FALSE;
if(isset($_GET['id'])){
	//CEK DATA DI DATABASE
	$sql_cek = mysql_query("SELECT * FROM th_ajaran WHERE id_th_ajaran='".$_GET['id']."'");
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

			<form action="ta_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Tahun Ajaran</legend>

			  <input type="hidden" name="id_th_ajaran" class="form-control" id="id_th_ajaran" value="<?php echo $hasil['id_th_ajaran'];?>" required />
			  
			  <div class="form-group">
				<label for="nama_th_ajaran" class="col-sm-2 control-label form-label">Tahun Ajaran</label>
				<div class="col-sm-4">
				  <input type="text" name="nama_th_ajaran" class="form-control" id="nama_th_ajaran" value="<?php echo $hasil['nama_th_ajaran'];?>" placeholder="Tahun Ajaran" required />
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
				  <button class="btn btn-success" type="submit" name="ubah"><i class="fa fa-save"></i> Simpan</button>
				</div>
			  </div>
			</form> 

	    </div>
	  </div>


	</div>
	<script>
	$(document).ready(function() {

	$('#nama_th_ajaran').mask("0000/0000");

	});
	</script>
</div>
<?php
}else{
	echo "<script>window.location='index.php?hal=ta';</script>";
}
?>