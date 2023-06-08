<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA DPA
if(isset($_POST['simpan'])){

	$nip			= trim($_POST['nip']);
	$nama			= trim($_POST['nama']);
	$email			= trim($_POST['email']);
	$id_th_ajaran	= trim($_POST['id_th_ajaran']);
	$no_hp			= trim($_POST['no_hp']);
	$username		= trim($_POST['username']);
	$password		= trim($_POST['password']);
	$id_dpa			= kode_otomatis("dpa", "id_dpa", "", "", "");
	
	//Cek NIP dan Tahun Ajaran
	$sql_cek = mysql_query("SELECT * FROM dpa WHERE id_th_ajaran='".$id_th_ajaran."' AND nip='".$nip."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Tahun Ajaran dan NIP $nip sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{
		//Cek Account
		$sql_cek = mysql_query("SELECT * FROM account WHERE username='".$username."' AND divisi='DPA'");
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
				$folder_foto = "../uploaded/dpa/";
				//buat folder
				if(!is_dir($folder_foto))
				{
					mkdir($folder_foto);
				}

				$info 			= getimagesize($lokasi_file);
				$extension 		= image_type_to_extension($info[2]);
				$nama_file      = $nip.$extension ;
				
				resize(450, $folder_foto.'/'.$nama_file ,$lokasi_file);
				$nama_foto = $nama_file;
			}

			//Menyimpan data
			$sql = "INSERT INTO dpa (`id_dpa`, `id_th_ajaran`, `nip`, `nama`, `email`, `no_hp`, `foto`) VALUES ('".$id_dpa."', '".$id_th_ajaran."', '".$nip."', '".$nama."', '".$email."', '".$no_hp."', '".$nama_foto."')";
			
			if(mysql_query($sql))
			{
				$id_account			= kode_otomatis("account", "id_account", "", "", "");
				//Simpan Account
				$sql_account = "INSERT INTO account (`id_account`, `id_dpa`, `nama`, `username`, `password`, `divisi`) 
				VALUES ('".$id_account."', '".$id_dpa."', '".$nama."', '".$username."', '".md5($password)."', 'DPA')";
				if(mysql_query($sql_account))
				{
					echo "<script>alert('Data DPA Berhasil Disimpan')</script>";
					//arahkan
					echo "<script>window.location='index.php?hal=dpa';</script>";	
				}else{
					//Hapus DPA 
					mysq_query("DELETE FROM dpa WHERE id_dpa='".$id_dpa."'");

					echo "<script>alert('Data DPA Gagal Disimpan')</script>";
					//arahkan
					echo "<script>window.location='javascript:history.go(-1)';</script>";
				}
			}else{
				echo "<script>alert('Data DPA Gagal Disimpan')</script>";
				//arahkan
				echo "<script>window.location='javascript:history.go(-1)';</script>";	
			}
		}
	}
		
//JIKA UBAH DATA DPA
}else if(isset($_POST['ubah'])){
	
	$id_dpa			= trim($_POST['id_dpa']);
	$nip			= trim($_POST['nip']);
	$nama			= trim($_POST['nama']);
	$email			= trim($_POST['email']);
	$id_th_ajaran	= trim($_POST['id_th_ajaran']);
	$no_hp			= trim($_POST['no_hp']);
	$username		= trim($_POST['username']);
	$password		= trim($_POST['password']);
	
	//Cek NIP dan Tahun Ajaran
	$sql_cek = mysql_query("SELECT * FROM dpa WHERE id_th_ajaran='".$id_th_ajaran."' AND nip='".$nip."' AND id_dpa<>'".$id_dpa."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Tahun Ajaran dan NIP $nip sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{
		//Cek Account
		$sql_cek = mysql_query("SELECT * FROM account WHERE username='".$username."' AND divisi='DPA' AND id_dpa<>'".$id_dpa."'");
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
				$folder_foto = "../uploaded/dpa/";
				//buat folder
				if(!is_dir($folder_foto))
				{
					mkdir($folder_foto);
				}

				$info 			= getimagesize($lokasi_file);
				$extension 		= image_type_to_extension($info[2]);
				$date_time		= date("YmdHis");
				$nama_file      = $nip."_".$date_time.$extension ;


				resize(450, $folder_foto.'/'.$nama_file ,$lokasi_file);
				$nama_foto = $nama_file;
			}

			//Menyimpan data
			$sql = "UPDATE dpa 
			SET `id_th_ajaran`='".$id_th_ajaran."', `nip`='".$nip."', `nama`='".$nama."', `email`='".$email."', `no_hp`='".$no_hp."' 
			WHERE `id_dpa`='".$id_dpa."'";
			
			if(mysql_query($sql))
			{
				//Ubah Foto
				if($nama_foto!=""){
					$sql_foto = "UPDATE dpa 
					SET `foto`='".$nama_foto."'
					WHERE `id_dpa`='".$id_dpa."'";
					mysql_query($sql_foto);
				}
				//Ubah Account
				$sql_account = "UPDATE account 
				SET `nama`='".$nama."', `username`'".$username."'
				WHERE `id_dpa`='".$id_dpa."'";
				mysql_query($sql_account);
				//Ubah Password
				if($password!=""){
					$sql_password = "UPDATE account 
					SET `password`='".md5($password)."'
					WHERE `id_dpa`='".$id_dpa."'";
					mysql_query($sql_password);
				}

				echo "<script>alert('Data DPA Berhasil Diubah')</script>";
				//arahkan
				echo "<script>window.location='index.php?hal=dpa';</script>";	
			}else{
				echo "<script>alert('Data DPA Gagal Diubah')</script>";
				//arahkan
				echo "<script>window.location='javascript:history.go(-1)';</script>";	
			}
		}
	}

//JIKA HAPUS DATA DPA
}else if(isset($_GET['hapus'])){
	$foto = $_GET['foto'];
	$sql = "DELETE FROM dpa WHERE id_dpa='".$_GET['hapus']."'";
	if(mysql_query($sql))
	{
		//Hapus Account
		mysql_query("DELETE FROM account WHERE id_dpa='".$_GET['hapus']."'");

		//Hapus Foto
		$folder = "../uploaded/dpa/".$foto;
		if(is_file($folder)){
			unlink($folder);
		}

		echo "<script>alert('Data DPA Berhasil Dihapus')</script>";
		//arahkan
		echo "<script>window.location='index.php?hal=dpa';</script>";	
	}else{
		echo "<script>alert('Data DPA Gagal Dihapus')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}
//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=dpa';</script>";	
}
?>