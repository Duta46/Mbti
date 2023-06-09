<div class="row">

	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="dpa_proses.php" method="post" name="frmadd" class="form-horizontal" enctype="multipart/form-data">
			  
			  <legend>Data Dosen Pembimbing Akademik</legend>
			  
			  <div class="form-group">
				<label for="nama" class="col-sm-2 control-label form-label">Nama</label>
				<div class="col-sm-4">
				  <input type="text" name="nama" class="form-control" id="nama" value="" placeholder="Nama" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="nip" class="col-sm-2 control-label form-label">NIP</label>
				<div class="col-sm-4">
				  <input type="text" name="nip" class="form-control" id="nip" value="" placeholder="NIP" required />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-2 control-label form-label">Email</label>
				<div class="col-sm-4">
				  <input type="email" name="email" class="form-control" id="email" value="" placeholder="Email" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="id_th_ajaran" class="col-sm-2 control-label form-label">Tahun Ajaran</label>
				<div class="col-sm-4">
				  <select class="selectpicker" id="id_th_ajaran" name="id_th_ajaran" data-live-search="true" data-size="5" data-width="100%" required>
						<option value="">Pilih Tahun Ajaran</option>
						<?php
						$sql_ta = mysqli_query($truecont, "SELECT * FROM th_ajaran ORDER BY nama_th_ajaran desc");
						while($hasil_ta = mysqli_fetch_array($sql_ta)){
						?>
							<option value="<?php echo $hasil_ta['id_th_ajaran'];?>"><?php echo $hasil_ta['nama_th_ajaran'];?></option>
						<?php
						}
						?>
					</select>
				</div>
			  </div>

			  <div class="form-group">
				<label for="no_hp" class="col-sm-2 control-label form-label">No HP</label>
				<div class="col-sm-4">
				  <input type="text" name="no_hp" class="form-control" id="no_hp" value="" placeholder="No HP" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="foto" class="col-sm-2 control-label form-label">Foto</label>
				<div class="col-sm-4">
				  <input type="file" name="foto" class="form-control" id="foto" value="" placeholder="Foto" />
				</div>
			  </div>

			  <div class="form-group">
				<label for="username" class="col-sm-2 control-label form-label">Username</label>
				<div class="col-sm-4">
				  <input type="text" name="username" class="form-control" id="username" value="" placeholder="Username" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="password" class="col-sm-2 control-label form-label">Password</label>
				<div class="col-sm-4">
				  <input type="password" name="password" class="form-control" id="password" value="" placeholder="Password" required />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="btnSubmit" class="col-sm-2 control-label form-label"></label>
				<div class="col-sm-2">
				  <a href="index.php?hal=dpa">
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
	<script>
	$(document).ready(function() {

	$('#nip').mask("0000000000000000");
	$('#no_hp').mask("0000000000000000");

	});
	</script>
</div>