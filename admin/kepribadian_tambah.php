<div class="row">

	<div class="col-md-12">
	  <div class="panel panel-default">

	    <div class="panel-body">

			<form action="kepribadian_proses.php" method="post" name="frmadd" class="form-horizontal">
			  
			  
			  <legend>Keterangan Nama Kepribadian : </legend>

			  <div class="col-md-12">
			  		<h4 style="text-align: center; margin-top: 0px;">
		            <?php
		            $sql_kategori = "SELECT * FROM kategori ORDER BY id_kategori";
		            $eks_kategori = mysql_query($sql_kategori);
		            while($hasil_kategori = mysql_fetch_array($eks_kategori)){
		                $id_kategori = substr($hasil_kategori['id_kategori'], 0,1);
		                echo '<b>'.$id_kategori.'</b>'.' - '.$hasil_kategori['nama_kategori'].'&nbsp; &nbsp; &nbsp; &nbsp;';
		            }
		            ?>
		            </h4>
			  </div>
			  
			  <div style="clear: both;"></div>

			  <legend>Data Tipe Kepribadian</legend>

			  <div class="form-group">
				<label for="nama" class="col-sm-2 control-label form-label">Nama Kepribadian</label>
				<div class="col-sm-4">
				  <input type="text" name="nama" class="form-control" id="nama" value="" placeholder="Kode Kategori" required />
				</div>
			  </div>

			  <div class="form-group">
				<label for="deskripsi" class="col-sm-2 control-label form-label">Deskripsi</label>
				<div class="col-sm-4">
				  <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5"></textarea>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="btnSubmit" class="col-sm-2 control-label form-label"></label>
				<div class="col-sm-2">
				  <a href="index.php?hal=kepribadian">
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

		$('#nama').keyup(function(){
	    	this.value = this.value.toUpperCase();
		});

	});
	</script>
</div>