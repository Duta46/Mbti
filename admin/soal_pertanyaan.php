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
<div class="row">

<?php
$link = "&id_soal=".$hasil_soal['id_soal'];
$paging = $link;
$where	= " AND id_soal='".$hasil_soal['id_soal']."' ";
if(isset($_REQUEST['nama']) && $_REQUEST['nama']!='')
{
	$nama	= $_REQUEST['nama'];
	$paging .= '&nama='.$nama;
	$where = " AND (nama_konten LIKE '%".$nama."%')";
}else{
	$nama = '';
}

if(isset($_REQUEST['id_kategori']) && $_REQUEST['id_kategori']!='')
{
	$id_kategori	= $_REQUEST['id_kategori'];
	$paging .= '&id_kategori='.$id_kategori;
	$where .= " AND (k.id_kategori = '".$id_kategori."')";
}else{
	$id_kategori = '';
}
?> 
<?php
$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);


$results = mysql_query("SELECT * FROM kategori k JOIN konten_soal ks ON k.id_kategori=ks.id_kategori WHERE 1 $where");
$jmldata = mysql_num_rows($results);

$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman, 'soal_pertanyaan'.$paging, $jmldata);

?>

<script type="text/javascript">
	function tambah(){
        var id_kategori = $('#id_kategori').val();
        var link = '';
        if(id_kategori!=''){
        	link = '&id_kategori='+id_kategori;
        }
        window.open('index.php?hal=soal_pertanyaan_tambah<?php echo $link;?>'+link,'_self');
    }
</script>
  
  <div class="col-md-12">
      <div class="panel panel-default">
			
			<div class="col-md-12">
				
					<table class="table" width="100%">
						<tr><th>
						<div class="col-md-4 col-lg-4">
							<button class="btn btn-success" type="button" name="tambah" onclick="tambah()"><i class="fa fa-plus"></i> Tambah Konten Soal</button>
						</div>
						<form action="index.php?hal=soal_pertanyaan<?php echo $link;?>" method="post">
						<div class="col-md-6 col-lg-6">
								<div class="col-md-6 col-lg-6">
									<select class="selectpicker" id="id_kategori" name="id_kategori" data-live-search="true" data-size="5" data-width="100%">
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
						</div>
						<div class="col-md-2 col-lg-2"><button class="btn btn-primary" type="submit" name="tampilkan"><i class="fa fa-search"></i> Cari</button></div>
						</form>
						</th></tr>
					</table>
			</div>

			<h3 align="center"><?php echo $hasil_soal['nama_soal'];?></h3>
			
			<table class="table display table-striped" width="100%" style="font-size:11px">
			  <thead>
				<tr>
				  <th width="5%">No</th>
				  <th width="15%">Kode Soal</th>
				  <th>Konten Soal</th>
				  <th width="20%">Opsi</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$sql = mysql_query("SELECT *
					FROM kategori k JOIN konten_soal ks ON k.id_kategori=ks.id_kategori
					WHERE 1 $where 
					ORDER BY k.id_kategori, kode_soal
					LIMIT $posisi,$batas");
				if(mysql_num_rows($sql)>0){
					$no=1+$posisi;
					while($hasil = mysql_fetch_array($sql)) { 
				?>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $hasil['kode_soal'];?></td>
						<td><?php echo $hasil['nama_konten'];?></td>
						<td>
						<a href='index.php?hal=soal_pertanyaan_ubah<?php echo $link;?>&id=<?php echo $hasil['kode_soal'];?>' class='btn btn-sm btn-light'>
							<button class="btn btn-sm btn-info">
								<i class="fa fa-edit"></i> Ubah
							</button>
						</a>
						
						<button class="btn btn-sm btn-danger" data-title="Konten Soal" data-href="soal_pertanyaan_proses.php?hapus=<?php echo $hasil['kode_soal'];?><?php echo $link;?>" data-toggle="modal" data-target="#confirm-delete">
					        <i class="fa fa-trash-o"></i> Hapus
					    </button>
						</td>
					</tr>
				<?php
					}
				}else{
				?>
				<tr>
					<td colspan=4>Data Konten Soal Masih Kosong</td>
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

<?php
}else{
	echo "<script>window.location='index.php?hal=soal';</script>";
}
?>