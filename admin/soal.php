<div class="row">

<?php
$paging = "";
$where	= "";
if(isset($_REQUEST['nama']) && $_REQUEST['nama']!='')
{
	$nama	= $_REQUEST['nama'];
	$paging .= '&nama='.$nama;
	$where .= " AND (nama_soal LIKE '%".$nama."%')";
}else{
	$nama = '';
}


?> 
<?php
$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);


$results = mysql_query("SELECT * FROM soal WHERE 1 $where");
$jmldata = mysql_num_rows($results);

$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman, 'soal'.$paging, $jmldata);

?>

<script type="text/javascript">
	function tambah(){
        var link = '';
        window.open('index.php?hal=soal_tambah'+link,'_self');
    }
</script>
  
  <div class="col-md-12">
      <div class="panel panel-default">
			
			<div class="col-md-12">
				
					<table class="table" width="100%">
						<tr><th>
						<div class="col-md-4 col-lg-4">
							<button class="btn btn-success" type="button" name="tambah" onclick="tambah()"><i class="fa fa-plus"></i> Tambah Soal</button>
						</div>

						<form action="index.php?hal=soal" method="post">

							<div class="col-md-6 col-lg-6">
								<div class="control-group">
								  <div class="controls">
								   <div class="input-prepend input-group">
									 <span class="add-on input-group-addon"><i class="fa fa-search"></i></span>
									 <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama;?>" placeholder="Nama Soal" /> 
								   </div>
								  </div>
								</div>
							</div>
							<div class="col-md-2 col-lg-2"><button class="btn btn-primary" type="submit" name="tampilkan"><i class="fa fa-search"></i> Cari</button></div>
						</form>
						
						</th></tr>
					</table>
			</div>
			
			<table class="table display table-striped" width="100%" style="font-size:11px">
			  <thead>
				<tr>
				  <th width="10%">No Urut</th>
				  <th>Soal</th>
				  <th></th>
				  <th width="20%">Opsi</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$sql = mysql_query("SELECT *
					FROM soal
					WHERE 1 $where 
					ORDER BY no_urut, id_soal, nama_soal 
					LIMIT $posisi,$batas");
				if(mysql_num_rows($sql)>0){
					while($hasil = mysql_fetch_array($sql)) { 
				?>
					<tr>
						<td><?php echo $hasil['no_urut'];?></td>
						<td><?php echo $hasil['nama_soal'];?></td>
						<td>
						<a href='index.php?hal=soal_pertanyaan&id_soal=<?php echo $hasil['id_soal'];?>' class='btn btn-sm btn-light'>
						<button class="btn btn-sm btn-warning">
					        <i class="fa fa-plus"></i> Konten Pertanyaan
					    </button>
					    </a>
						</td>
						<td>
						<a href='index.php?hal=soal_ubah&id=<?php echo $hasil['id_soal'];?>' class='btn btn-sm btn-light'>
							<button class="btn btn-sm btn-info">
								<i class="fa fa-edit"></i> Ubah
							</button>
						</a>
						
						<button class="btn btn-sm btn-danger" data-title="Soal" data-href="soal_proses.php?hapus=<?php echo $hasil['id_soal'];?>" data-toggle="modal" data-target="#confirm-delete">
					        <i class="fa fa-trash-o"></i> Hapus
					    </button>
						</td>
					</tr>
				<?php
					}
				}else{
				?>
				<tr>
					<td colspan=4>Data Soal Masih Kosong</td>
				</tr>
				<?php
				}
				?>
			  </tbody>
			</table>

        </div>
      </div>


    <div class="col-md-12"> <center><?php echo $linkHalaman;?> </center></div>
	
</div>

