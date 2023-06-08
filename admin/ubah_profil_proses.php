<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA UBAH PROFIL
if(isset($_POST['simpan'])){
	
	$id_account		= trim($_POST['id_account']);
	$nama			= trim($_POST['nama']);
	$username		= trim($_POST['username']);
	$password		= trim($_POST['password']);
	
	//Cek NIP dan Tahun Ajaran
	$sql_cek = mysql_query("SELECT * FROM account WHERE username='".$username."' AND id_account<>'".$id_account."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Username $username sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{
		//Menyimpan data
		$sql = "UPDATE account 
		SET `nama`='".$nama."', `username`='".$username."' 
		WHERE `id_account`='".$id_account."'";
		
		if(mysql_query($sql))
		{
			//Ubah Password
			if($password!=""){
				$sql_password = "UPDATE account 
				SET `password`='".md5($password)."'
				WHERE `id_account`='".$id_account."'";
				mysql_query($sql_password);
			}

			//Ubah Sesi Admin
			$_SESSION['account_myers_briggs']['username']   = $username;

			echo "<script>alert('Data Ubah Profil Berhasil Diubah')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=ubah_profil';</script>";	
		}else{
			echo "<script>alert('Data Ubah Profil Gagal Diubah')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}

//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=ubah_profil';</script>";	
}
?>