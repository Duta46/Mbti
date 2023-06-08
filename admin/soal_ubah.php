<?php
$status = FALSE;
if(isset($_GET['id'])){
	//CEK DATA DI DATABASE
	$sql_cek = mysql_query("SELECT * FROM soal WHERE id_soal='".$_GET['id']."'");
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

			<form action="soal_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Soal</legend>

			  <input type="hidden" name="id_soal" class="form-control" id="id_soal" value="<?php echo $hasil['id_soal'];?>" required />


			  

			  <div class="form-group">
				<label for="no_urut" class="col-sm-2 control-label form-label">No Urut Soal</label>
				<div class="col-sm-4">
				  <input type="text" name="no_urut" class="form-control" id="no_urut" value="<?php echo $hasil['no_urut'];?>" placeholder="No Urut Soal" required />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nama_soal" class="col-sm-2 control-label form-label">Nama Soal</label>
				<div class="col-sm-4">
				  <textarea class="form-control" name="nama_soal" id="nama_soal" rows="5"><?php echo $hasil['nama_soal'];?></textarea>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="btnSubmit" class="col-sm-2 control-label form-label"></label>
				<div class="col-sm-2">
				  <a href="index.php?hal=soal">
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

	$('#no_urut').mask("00");

	});
	</script>
</div>
<?php
}else{
	echo "<script>window.location='index.php?hal=soal';</script>";
}
?>