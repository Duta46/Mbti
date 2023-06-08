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

	$status_ubah = FALSE;
	if(isset($_GET['id'])){
		//CEK DATA DI DATABASE
		$sql_cek_ubah = mysql_query("SELECT * FROM konten_soal WHERE kode_soal='".$_GET['id']."'");
		if (mysql_num_rows($sql_cek_ubah) > 0){
			$status_ubah = TRUE;
		}
	}

	if($status_ubah){
		$hasil = mysql_fetch_array($sql_cek_ubah);
?>
<div class="row">

	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="soal_pertanyaan_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Konten Soal "<?php echo $hasil_soal['nama_soal'];?>"</legend>

			  <input type="hidden" name="id_soal" class="form-control" id="id_soal" value="<?php echo $hasil_soal['id_soal'];?>" required />
			  <input type="hidden" name="kode_soal" class="form-control" id="kode_soal" value="<?php echo $hasil['kode_soal'];?>" required />

			  
			  <div class="form-group">
				<label for="id_kategori" class="col-sm-2 control-label form-label">Kategori Soal</label>
				<div class="col-sm-4">
				  <select class="selectpicker" id="id_kategori" name="id_kategori" data-live-search="true" data-size="5" data-width="100%" required>
						<option value="">Pilih Kategori</option>
						<?php
						$sql_kat = mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
						while($hasil_kat = mysql_fetch_array($sql_kat)){
						?>
							<option value="<?php echo $hasil_kat['id_kategori'];?>" <?php echo ($hasil['id_kategori']==$hasil_kat['id_kategori'])?'selected':'';?>><?php echo $hasil_kat['id_kategori'].' - '.$hasil_kat['nama_kategori'];?></option>
						<?php
						}
						?>
					</select>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nama_konten" class="col-sm-2 control-label form-label">Konten Soal</label>
				<div class="col-sm-4">
				  <textarea class="form-control" name="nama_konten" id="nama_konten" rows="5"><?php echo $hasil['nama_konten'];?></textarea>
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
				  <button class="btn btn-success pull-right" type="submit" name="ubah"><i class="fa fa-save"></i> Simpan</button>
				</div>
			  </div>
			</form> 

	    </div>
	  </div>


	</div>
</div>
<?php
	}else{
		echo "<script>window.location='index.php?hal=soal_pertanyaan&id_soal=".$hasil_soal['id_soal']."';</script>";
	}
}else{
	echo "<script>window.location='index.php?hal=soal';</script>";
}
?>