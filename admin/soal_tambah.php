<div class="row">

	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="soal_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Soal</legend>
			  <?php
			  //No Urut
			  $no_urut		= kode_otomatis("soal", "no_urut", "", "", "");
			  ?>

			  

			  <div class="form-group">
				<label for="no_urut" class="col-sm-2 control-label form-label">No Urut Soal</label>
				<div class="col-sm-4">
				  <input type="text" name="no_urut" class="form-control" id="no_urut" value="<?php echo $no_urut;?>" placeholder="No Urut Soal" required />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nama_soal" class="col-sm-2 control-label form-label">Nama Soal</label>
				<div class="col-sm-4">
				  <textarea class="form-control" name="nama_soal" id="nama_soal" rows="5"></textarea>
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
				  <button class="btn btn-success pull-right" type="submit" name="simpan"><i class="fa fa-save"></i> Simpan</button>
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