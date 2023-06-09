<div class="row">

<?php
require_once '../inc/koneksi.php';
$paging = "";
$where	= "";
if(isset($_REQUEST['nama']) && $_REQUEST['nama']!='')
{
	$nama	= $_REQUEST['nama'];
	$paging .= '&nama='.$nama;
	$where = " AND (m.nama LIKE '%".$nama."%' OR m.nim = '".$nama."')";
}else{
	$nama = '';
}

if(isset($_REQUEST['id_dpa']) && $_REQUEST['id_dpa']!='')
{
	$id_dpa	= $_REQUEST['id_dpa'];
	$paging .= '&id_dpa='.$id_dpa;
	$where .= " AND (dpa.id_dpa = '".$id_dpa."')";
}else{
	$id_dpa = '';
}
?> 
<?php
$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);


$results = mysqli_query($truecont, "SELECT * FROM mahasiswa m LEFT JOIN dpa ON m.id_dpa=dpa.id_dpa WHERE 1 $where");
$jmldata = mysqli_num_rows($results);

$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman, 'mahasiswa'.$paging, $jmldata);

?>
  
  <div class="col-md-12">
      <div class="panel panel-default">
			
			<div class="col-md-12">
				<form action="index.php?hal=mahasiswa" method="post">
					<table class="table" width="100%">
						<tr><th>
						<div class="col-md-4 col-lg-4">
							<a href="index.php?hal=mahasiswa_tambah">
							<button class="btn btn-success" type="button" name="tambah"><i class="fa fa-plus"></i> Tambah Mahasiswa</button>
							</a>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="col-md-6 col-lg-6">
								<select class="selectpicker" id="id_dpa" name="id_dpa" data-live-search="true" data-size="5" data-width="100%">
									<option value="">Pilih DPA</option>
									<?php
									$sql_ta = mysqli_query($truecont, "SELECT * FROM th_ajaran ORDER BY nama_th_ajaran desc");
									while($hasil_ta = mysqli_fetch_array($sql_ta)){
									?>
										<optgroup label="<?php echo $hasil_ta['nama_th_ajaran'];?>">
									<?php
										$sql_dpa = mysqli_query($truecont, "SELECT * FROM dpa WHERE id_th_ajaran='".$hasil_ta['id_th_ajaran']."' ORDER BY nip");
										while($hasil_dpa = mysqli_fetch_array($sql_dpa)){
									?>
										<option value="<?php echo $hasil_dpa['id_dpa'];?>" <?php echo ($hasil_dpa['id_dpa']==$id_dpa)?'selected':'';?>><?php echo $hasil_dpa['nip'].'-'.$hasil_dpa['nama'];?></option>
									<?php
										}
									?>
										</optgroup>
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
									 <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama;?>" placeholder="Nama Mahasiswa" /> 
								   </div>
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
				<th>Foto</th>
				  <th width="10%">NIM</th>
				  <th>Nama</th>
				  <th>Alamat</th>
				  <th>Email</th>
				  <th>IPK</th>
				  <th>DPA</th>
				  <th width="20%">Opsi</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$sql = mysqli_query($truecont, "SELECT m.id_mahasiswa, m.nim, m.nama, m.alamat, m.email, m.foto, m.indeks_prestasi, dpa.nip, dpa.nama as nama_dpa 
					FROM mahasiswa m LEFT JOIN dpa ON m.id_dpa=dpa.id_dpa 
					WHERE 1 $where 
					ORDER BY nim 
					LIMIT $posisi,$batas");
				if(mysqli_num_rows($sql)>0){
					while($hasil = mysqli_fetch_array($sql)) { 
				?>
					<tr>
					<td>
							<?php
							$foto = "../uploaded/mahasiswa/".$hasil['foto'];
							if(is_file($foto)){
							?>
								<img src="<?php echo $foto;?>" width="100px" />
							<?php
							}
							?>
						</td>
						<td><?php echo $hasil['nim'];?></td>
						<td><?php echo $hasil['nama'];?></td>
						<td><?php echo $hasil['alamat'];?></td>
						<td><?php echo $hasil['email'];?></td>
						<td><?php echo $hasil['indeks_prestasi'];?></td>
						<td><?php echo $hasil['nip'].' ('.$hasil['nama_dpa'].')';?></td>
						<td>
						<a href='index.php?hal=mahasiswa_ubah&id=<?php echo $hasil['id_mahasiswa'];?>' class='btn btn-sm btn-light'>
							<button class="btn btn-sm btn-info">
								<i class="fa fa-edit"></i> Ubah
							</button>
						</a>
						
						<button class="btn btn-sm btn-danger" data-title="Mahasiswa" data-href="mahasiswa_proses.php?hapus=<?php echo $hasil['id_mahasiswa'];?>&foto=<?php echo $hasil['foto'];?>" data-toggle="modal" data-target="#confirm-delete">
					        <i class="fa fa-trash-o"></i> Hapus
					    </button>
						</td>
					</tr>
				<?php
					}
				}else{
				?>
				<tr>
					<td colspan=8>Data Mahasiswa Masih Kosong</td>
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

