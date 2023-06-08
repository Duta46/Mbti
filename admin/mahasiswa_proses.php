<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA Mahasiswa
if(isset($_POST['simpan'])){

	$nim			= trim($_POST['nim']);
	$nama			= trim($_POST['nama']);
	$alamat			= trim($_POST['alamat']);
	$email			= trim($_POST['email']);
	$id_dpa			= trim($_POST['id_dpa']);
	$program_studi	= trim($_POST['program_studi']);
	$indeks_prestasi= trim($_POST['indeks_prestasi']);
	$username		= trim($_POST['username']);
	$password		= trim($_POST['password']);
	$id_mahasiswa	= kode_otomatis("mahasiswa", "id_mahasiswa", "", "", "");
	
	//Cek NIM dan DPA
	$sql_cek = mysql_query("SELECT * FROM mahasiswa WHERE id_dpa='".$id_dpa."' AND nim='".$nim."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('DPA dan NIM $nim sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{
		//Cek Account
		$sql_cek = mysql_query("SELECT * FROM account WHERE username='".$username."' AND divisi='Mahasiswa'");
		if (mysql_num_rows($sql_cek)>0){
			echo "<script>alert('Username $username sudah ada sebelumnya')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}else{
			//upload
			$nama_foto 		= "";

			$lokasi_file    = $_FILES['foto']['tmp_name'];
			$tipe_file      = $_FILES['foto']['type'];
			// Apabila ada foto yang diupload
			
			if (!empty($lokasi_file)){		  
				//folder
				$folder_foto = "../uploaded/mahasiswa/";
				//buat folder
				if(!is_dir($folder_foto))
				{
					mkdir($folder_foto);
				}

				$info 			= getimagesize($lokasi_file);
				$extension 		= image_type_to_extension($info[2]);
				$nama_file      = $nim.$extension ;
				
				resize(450, $folder_foto.'/'.$nama_file ,$lokasi_file);
				$nama_foto = $nama_file;
			}

			//Menyimpan data
			$sql = "INSERT INTO mahasiswa (`id_mahasiswa`, `id_dpa`, `nim`, `nama`, `alamat`, `email`, `program_studi`, `indeks_prestasi`, `foto`) VALUES ('".$id_mahasiswa."', '".$id_dpa."', '".$nim."', '".$nama."', '".$alamat."', '".$email."', '".$program_studi."', '".$indeks_prestasi."', '".$nama_foto."')";
			
			if(mysql_query($sql))
			{
				$id_account			= kode_otomatis("account", "id_account", "", "", "");
				//Simpan Account
				$sql_account = "INSERT INTO account (`id_account`, `id_mahasiswa`, `nama`, `username`, `password`, `divisi`) 
				VALUES ('".$id_account."', '".$id_mahasiswa."', '".$nama."', '".$username."', '".md5($password)."', 'Mahasiswa')";
				if(mysql_query($sql_account))
				{
					echo "<script>alert('Data Mahasiswa Berhasil Disimpan')</script>";
					//arahkan
					echo "<script>window.location='index.php?hal=mahasiswa';</script>";	
				}else{
					//Hapus Mahasiswa 
					mysq_query("DELETE FROM mahasiswa WHERE id_mahasiswa='".$id_mahasiswa."'");

					echo "<script>alert('Data Mahasiswa Gagal Disimpan')</script>";
					//arahkan
					echo "<script>window.location='javascript:history.go(-1)';</script>";
				}
			}else{
				echo "<script>alert('Data Mahasiswa Gagal Disimpan')</script>";
				//arahkan
				echo "<script>window.location='javascript:history.go(-1)';</script>";	
			}
		}
	}
		
//JIKA UBAH DATA Mahasiswa
}else if(isset($_POST['ubah'])){
	
	$id_mahasiswa	= trim($_POST['id_mahasiswa']);
	$nim			= trim($_POST['nim']);
	$nama			= trim($_POST['nama']);
	$alamat			= trim($_POST['alamat']);
	$email			= trim($_POST['email']);
	$id_dpa			= trim($_POST['id_dpa']);
	$program_studi	= trim($_POST['program_studi']);
	$indeks_prestasi= trim($_POST['indeks_prestasi']);
	$username		= trim($_POST['username']);
	$password		= trim($_POST['password']);
	
	//Cek NIM dan DPA
	$sql_cek = mysql_query("SELECT * FROM mahasiswa WHERE id_dpa='".$id_dpa."' AND nim='".$nim."' AND id_mahasiswa<>'".$id_mahasiswa."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('DPA dan NIM $nim sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{
		//Cek Account
		$sql_cek = mysql_query("SELECT * FROM account WHERE username='".$username."' AND divisi='Mahasiswa' AND id_mahasiswa<>'".$id_mahasiswa."'");
		if (mysql_num_rows($sql_cek)>0){
			echo "<script>alert('Username $username sudah ada sebelumnya')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}else{
			//upload
			$nama_foto 		= "";

			$lokasi_file    = $_FILES['foto']['tmp_name'];
			$tipe_file      = $_FILES['foto']['type'];
			// Apabila ada foto yang diupload
			
			if (!empty($lokasi_file)){		  
				//folder
				$folder_foto = "../uploaded/mahasiswa/";
				//buat folder
				if(!is_dir($folder_foto))
				{
					mkdir($folder_foto);
				}

				$info 			= getimagesize($lokasi_file);
				$extension 		= image_type_to_extension($info[2]);
				$date_time		= date("YmdHis");
				$nama_file      = $nim."_".$date_time.$extension ;


				resize(450, $folder_foto.'/'.$nama_file ,$lokasi_file);
				$nama_foto = $nama_file;
			}

			//Menyimpan data
			$sql = "UPDATE mahasiswa 
			SET `id_dpa`='".$id_dpa."', `nim`='".$nim."', `nama`='".$nama."', `email`='".$email."', `alamat`='".$alamat."', `program_studi`='".$program_studi."', `indeks_prestasi`='".$indeks_prestasi."'
			WHERE `id_mahasiswa`='".$id_mahasiswa."'";
			
			if(mysql_query($sql))
			{
				//Ubah Foto
				if($nama_foto!=""){
					$sql_foto = "UPDATE mahasiswa 
					SET `foto`='".$nama_foto."'
					WHERE `id_mahasiswa`='".$id_mahasiswa."'";
					mysql_query($sql_foto);
				}
				//Ubah Account
				$sql_account = "UPDATE account 
				SET `nama`='".$nama."', `username`'".$username."'
				WHERE `id_mahasiswa`='".$id_mahasiswa."'";
				mysql_query($sql_account);
				//Ubah Password
				if($password!=""){
					$sql_password = "UPDATE account 
					SET `password`='".md5($password)."'
					WHERE `id_mahasiswa`='".$id_mahasiswa."'";
					mysql_query($sql_password);
				}

				echo "<script>alert('Data Mahasiswa Berhasil Diubah')</script>";
				//arahkan
				echo "<script>window.location='index.php?hal=mahasiswa';</script>";	
			}else{
				echo "<script>alert('Data Mahasiswa Gagal Diubah')</script>";
				//arahkan
				echo "<script>window.location='javascript:history.go(-1)';</script>";	
			}
		}
	}

//JIKA HAPUS DATA Mahasiswa
}else if(isset($_GET['hapus'])){
	$foto = $_GET['foto'];
	$sql = "DELETE FROM mahasiswa WHERE id_mahasiswa='".$_GET['hapus']."'";
	if(mysql_query($sql))
	{
		//Hapus Account
		mysql_query("DELETE FROM account WHERE id_mahasiswa='".$_GET['hapus']."'");

		//Hapus Foto
		$folder = "../uploaded/mahasiswa/".$foto;
		if(is_file($folder)){
			unlink($folder);
		}

		echo "<script>alert('Data Mahasiswa Berhasil Dihapus')</script>";
		//arahkan
		echo "<script>window.location='index.php?hal=mahasiswa';</script>";	
	}else{
		echo "<script>alert('Data Mahasiswa Gagal Dihapus')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}
//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=mahasiswa';</script>";	
}
?>