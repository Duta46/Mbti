<div class="row">

  

<?php
$paging = "";
$where	= " AND dpa.id_dpa='".$hasil_dpa['id_dpa']."' ";
if(isset($_REQUEST['nama']) && $_REQUEST['nama']!='')
{
	$nama	= $_REQUEST['nama'];
	$paging .= '&nama='.$nama;
	$where .= " AND (m.nama LIKE '%".$nama."%' OR m.nim = '".$nama."' OR tk.nama LIKE '%".$nama."%')";
}else{
	$nama = '';
}

?> 
<?php
$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);


$results = mysql_query("SELECT * FROM mahasiswa m LEFT JOIN dpa ON m.id_dpa=dpa.id_dpa LEFT JOIN result r ON m.id_mahasiswa=r.id_mahasiswa LEFT JOIN tipe_kepribadian tk ON r.id_tipekepribadian=tk.id_tipekepribadian WHERE 1 $where Group by m.id_mahasiswa");

$jmldata = mysql_num_rows($results);

$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman, 'mahasiswa'.$paging, $jmldata);

?>
  
  <div class="col-md-12">
      <div class="panel panel-default">
			
			<div class="col-md-12">
				<form action="index.php?hal=mahasiswa" method="post">
					<table class="table" width="100%">
						<tr><th>
						<div class="col-md-4 col-lg-4"></div>
						<div class="col-md-6 col-lg-6">
							<div class="col-md-12 col-lg-12">
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
			
			<table class="table table-display table-striped" width="100%">
			  <thead>
				<tr>
				  <th width="150px"></th>
				  <th width="10%">NIM</th>
				  <th>Nama</th>
				  <th>Alamat</th>
				  <th>Email</th>
				  <th>IPK</th>
				  <th>Hasil</th>
				  <th width="20%"></th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$sql = mysql_query("SELECT m.id_mahasiswa, m.nim, m.nama, m.alamat, m.email, m.foto, m.indeks_prestasi, dpa.nip, dpa.nama as nama_dpa, tk.nama nama_kepribadian
					FROM mahasiswa m LEFT JOIN dpa ON m.id_dpa=dpa.id_dpa 
					LEFT JOIN result r ON m.id_mahasiswa=r.id_mahasiswa
					LEFT JOIN tipe_kepribadian tk ON r.id_tipekepribadian=tk.id_tipekepribadian
					WHERE 1 $where 
					Group by m.id_mahasiswa
					ORDER BY nim 
					LIMIT $posisi,$batas");
				if(mysql_num_rows($sql)>0){
					while($hasil = mysql_fetch_array($sql)) { 
				?>
					<tr>
						<td>
							<?php
							$gambar = "../uploaded/mahasiswa/".$hasil['foto'];
							if(is_file($gambar)){
							?>
							<img src='<?php echo $gambar?>' width='100' />
							<?php	
							}
							?>
						</td>
						<td><?php echo $hasil['nim'];?></td>
						<td><?php echo $hasil['nama'];?></td>
						<td><?php echo $hasil['alamat'];?></td>
						<td><?php echo $hasil['email'];?></td>
						<td><?php echo $hasil['indeks_prestasi'];?></td>
						<td>
						<?php 
						$sql_k = mysql_query("SELECT nama
						FROM tipe_kepribadian tk JOIN result r ON tk.id_tipekepribadian=r.id_tipekepribadian
						WHERE id_mahasiswa='".$hasil['id_mahasiswa']."'
						ORDER BY tgl_pengerjaan DESC limit 1");
						while($hasil_k = mysql_fetch_array($sql_k)) { 
							echo $hasil_k['nama'];
							echo "<br />";
						}
						?>
							
						</td>

						<td>
						<a href='index.php?hal=mahasiswa_lihat&id=<?php echo $hasil['id_mahasiswa'];?>' class='btn btn-sm btn-light'>
							<button class="btn btn-sm btn-info">
								<i class="fa fa-eye"></i> Detail
							</button>
						</a>
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

