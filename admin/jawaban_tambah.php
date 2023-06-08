<div class="row">

	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="jawaban_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Jawaban</legend>
			  <?php
			  //Bobot
			  $bobot		= kode_otomatis("jawaban", "bobot", "", "", "");
			  ?>
			  <div class="form-group">
				<label for="bobot" class="col-sm-2 control-label form-label">Bobot</label>
				<div class="col-sm-4">
				  <input type="text" name="bobot" class="form-control" id="bobot" value="<?php echo $bobot;?>" placeholder="Bobot" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="nama_jawaban" class="col-sm-2 control-label form-label">Jawaban</label>
				<div class="col-sm-4">
				  <input type="text" name="nama_jawaban" class="form-control" id="nama_jawaban" value="" placeholder="Jawaban" required />
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
				  <button class="btn btn-success pull-right" type="submit" name="simpan"><i class="fa fa-save"></i> Simpan</button>
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