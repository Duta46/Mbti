<div class="row">

  

<?php
$paging = "";
$where	= "";
if(isset($_REQUEST['nama']) && $_REQUEST['nama']!='')
{
	$nama	= $_REQUEST['nama'];
	$paging .= '&nama='.$nama;
	$where = " AND (nama_th_ajaran LIKE '%".$nama."%')";
}else{
	$nama = '';
}
?> 
<?php
$p      = new Paging;
$batas  = 5;
$posisi = $p->cariPosisi($batas);


$results = mysql_query("SELECT * FROM th_ajaran WHERE 1 $where");
$jmldata = mysql_num_rows($results);

$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman, 'ta'.$paging, $jmldata);

?>
  
  <div class="col-md-12">
      <div class="panel panel-default">
			
			<div class="col-md-12">
				<form action="index.php?hal=ta" method="post">
					<table class="table" width="100%">
						<tr><th>
						<div class="col-md-6 col-lg-6">
							<a href="index.php?hal=ta_tambah">
							<button class="btn btn-success" type="button" name="tambah"><i class="fa fa-plus"></i> Tambah Tahun Ajaran</button>
							</a>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="control-group">
							  <div class="controls">
							   <div class="input-prepend input-group">
								 <span class="add-on input-group-addon"><i class="fa fa-search"></i></span>
								 <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama;?>" placeholder="Nama Tahun Ajaran" /> 
							   </div>
							  </div>
							</div>
						</div>
						<div class="col-md-2 col-lg-2"><button class="btn btn-primary" type="submit" name="tampilkan"><i class="fa fa-search"></i> Cari</button></div>
						</th></tr>
					</table>
				</form>
			</div>
			
			<table class="table display table-striped" width="100%" style="font-size:11px">
			  <thead>
				<tr>
				  <th>Tahun Ajaran</th>
				  <th width="20%">Opsi</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$sql = mysql_query("SELECT *
					FROM th_ajaran
					WHERE 1 $where 
					ORDER BY nama_th_ajaran DESC 
					LIMIT $posisi,$batas");
				if(mysql_num_rows($sql)>0){
					while($hasil = mysql_fetch_array($sql)) { 
				?>
					<tr>
						<td><?php echo $hasil['nama_th_ajaran'];?></td>
						<td>
						<a href='index.php?hal=ta_ubah&id=<?php echo $hasil['id_th_ajaran'];?>' class='btn btn-sm btn-light'>
							<button class="btn btn-sm btn-info">
								<i class="fa fa-edit"></i> Ubah
							</button>
						</a>
						
						<button class="btn btn-sm btn-danger" data-title="Tahun Ajaran" data-href="ta_proses.php?hapus=<?php echo $hasil['id_th_ajaran'];?>" data-toggle="modal" data-target="#confirm-delete">
					        <i class="fa fa-trash-o"></i> Hapus
					    </button>
						</td>
					</tr>
				<?php
					}
				}else{
				?>
				<tr>
					<td colspan=2>Data Tahun Ajaran Masih Kosong</td>
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

