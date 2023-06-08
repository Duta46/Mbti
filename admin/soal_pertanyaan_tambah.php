<?php
$status = FALSE;
if(isset($_GET['id_soal'])){
	//CEK DATA DI DATABASE
	$sql_cek = mysql_query("SELECT * FROM soal WHERE id_soal='".$_GET['id_soal']."'");
	if (mysql_num_rows($sql_cek) > 0){
		$status = TRUE;
	}
}

if($status){
	$hasil_soal = mysql_fetch_array($sql_cek);
?>

<?php
if(isset($_REQUEST['id_kategori']) && $_REQUEST['id_kategori']!='')
{
	$id_kategori	= $_REQUEST['id_kategori'];
}else{
	$id_kategori = '';
}
?>
<div class="row">

	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="soal_pertanyaan_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Konten Soal "<?php echo $hasil_soal['nama_soal'];?>"</legend>

			  <input type="hidden" name="id_soal" class="form-control" id="id_soal" value="<?php echo $hasil_soal['id_soal'];?>" required />
			  <input type="hidden" name="id_kategori" class="form-control" id="id_kategori" value="<?php echo $hasil_soal['id_kategori'];?>" required />

			  <div class="form-group">
				<label for="id_kategori" class="col-sm-2 control-label form-label">Kategori Soal</label>
				<div class="col-sm-4">
				  <select class="selectpicker" id="id_kategori" name="id_kategori" data-live-search="true" data-size="5" data-width="100%" required>
						<option value="">Pilih Kategori</option>
						<?php
						$sql_kat = mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
						while($hasil_kat = mysql_fetch_array($sql_kat)){
						?>
							<option value="<?php echo $hasil_kat['id_kategori'];?>" <?php echo ($hasil_kat['id_kategori']==$id_kategori)?'selected':'';?>><?php echo $hasil_kat['id_kategori'].' - '.$hasil_kat['nama_kategori'];?></option>
						<?php
						}
						?>
					</select>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nama_konten" class="col-sm-2 control-label form-label">Konten Soal</label>
				<div class="col-sm-4">
				  <textarea class="form-control" name="nama_konten" id="nama_konten" rows="5"></textarea>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="btnSubmit" class="col-sm-2 control-label form-label"></label>
				<div class="col-sm-2">
				  <a href="index.php?hal=soal_pertanyaan&id_soal=<?php echo $hasil_soal['id_soal'];?>">
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
	echo "<script>window.location='index.php?hal=soal';</script>";
}
?>