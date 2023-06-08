<?php
$status = FALSE;
if(isset($_GET['id'])){
	//CEK DATA DI DATABASE
	$sql_cek = mysql_query("SELECT m.*, a.username FROM mahasiswa m JOIN account a ON m.id_mahasiswa=a.id_mahasiswa WHERE m.id_mahasiswa='".$_GET['id']."'");
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

			<form action="mahasiswa_proses.php" method="post" name="frmadd" class="form-horizontal" enctype="multipart/form-data">
			  
			  <legend>Data Mahasiswa</legend>

			  <input type="hidden" name="id_mahasiswa" class="form-control" id="id_mahasiswa" value="<?php echo $hasil['id_mahasiswa'];?>" required />
			  
			  <div class="form-group">
				<label for="nama" class="col-sm-2 control-label form-label">Nama Mahasiswa</label>
				<div class="col-sm-4">
				  <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $hasil['nama'];?>" placeholder="Nama Mahasiswa" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="nim" class="col-sm-2 control-label form-label">NIM</label>
				<div class="col-sm-4">
				  <input type="text" name="nim" class="form-control" id="nim" value="<?php echo $hasil['nim'];?>" placeholder="NIM" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="program_studi" class="col-sm-2 control-label form-label">Program Studi</label>
				<div class="col-sm-4">
				  <select class="selectpicker" id="program_studi" name="program_studi" data-live-search="true" data-size="5" data-width="100%" required>
						<option value="">Pilih Program Studi</option>
						<?php
						foreach($program_studi as $program_studinya){
						?>
						<option value="<?php echo $program_studinya;?>" <?php echo ($hasil['program_studi']==$program_studinya)?'selected':'';?>><?php echo $program_studinya;?></option>
						<?php
						}
						?>
					</select>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="alamat" class="col-sm-2 control-label form-label">Alamat</label>
				<div class="col-sm-4">
				  <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $hasil['alamat'];?>" placeholder="Alamat" required />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-2 control-label form-label">Email</label>
				<div class="col-sm-4">
				  <input type="email" name="email" class="form-control" id="email" value="<?php echo $hasil['email'];?>" placeholder="Email" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="indeks_prestasi" class="col-sm-2 control-label form-label">Indeks Prestasi</label>
				<div class="col-sm-4">
				  <input type="text" name="indeks_prestasi" class="form-control" id="indeks_prestasi" value="<?php echo $hasil['indeks_prestasi'];?>" placeholder="IPK" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="id_dpa" class="col-sm-2 control-label form-label">Nama DPA</label>
				<div class="col-sm-4">
				  <select class="selectpicker" id="id_dpa" name="id_dpa" data-live-search="true" data-size="5" data-width="100%" required>
						<option value="">Pilih DPA</option>
						<?php
						$sql_ta = mysql_query("SELECT * FROM th_ajaran ORDER BY nama_th_ajaran desc");
						while($hasil_ta = mysql_fetch_array($sql_ta)){
						?>
							<optgroup label="<?php echo $hasil_ta['nama_th_ajaran'];?>">
						<?php
							$sql_dpa = mysql_query("SELECT * FROM dpa WHERE id_th_ajaran='".$hasil_ta['id_th_ajaran']."' ORDER BY nip");
							while($hasil_dpa = mysql_fetch_array($sql_dpa)){
						?>
							<option value="<?php echo $hasil_dpa['id_dpa'];?>" <?php echo ($hasil['id_dpa']==$hasil_dpa['id_dpa'])?'selected':'';?>><?php echo $hasil_dpa['nip'].'-'.$hasil_dpa['nama'];?></option>
						<?php
							}
						?>
							</optgroup>
						<?php
						}
						?>
					</select>
				</div>
			  </div>

			  <div class="form-group">
				<label for="foto" class="col-sm-2 control-label form-label">Foto</label>
				<div class="col-sm-4">
				    <?php
					$foto = "../uploaded/mahasiswa/".$hasil['foto'];
					if(is_file($foto)){
					?>
						<img src="<?php echo $foto;?>" width="120px" />
					<?php
					}
					?>
				</div>
				*) Kosongkan jika tidak diganti
			  </div>

			  <div class="form-group">
				<label for="foto" class="col-sm-2 control-label form-label"></label>
				<div class="col-sm-4">
				  <input type="file" name="foto" class="form-control" id="foto" value="" placeholder="Foto" />
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
				  <a href="index.php?hal=mahasiswa">
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

	$('#indeks_prestasi').mask("0.00");
	$('#nim').mask("00000000");

	});
	</script>
</div>
<?php
}else{
	echo "<script>window.location='index.php?hal=mahasiswa';</script>";
}
?>