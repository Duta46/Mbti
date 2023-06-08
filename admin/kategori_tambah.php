<div class="row">

	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="kategori_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  <legend>Data Kategori Soal</legend>
			  
			  <div class="form-group">
				<label for="id_kategori" class="col-sm-2 control-label form-label">Kode Kategori</label>
				<div class="col-sm-4">
				  <input type="text" name="id_kategori" maxlength="3" class="form-control" id="id_kategori" value="" placeholder="Kode Kategori" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="nama_kategori" class="col-sm-2 control-label form-label">Kategori</label>
				<div class="col-sm-4">
				  <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" value="" placeholder="Kategori" required />
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="btnSubmit" class="col-sm-2 control-label form-label"></label>
				<div class="col-sm-2">
				  <a href="index.php?hal=kategori">
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

		$('#id_kategori').keyup(function(){
	    	this.value = this.value.toUpperCase();
		});

	});
	</script>
</div>