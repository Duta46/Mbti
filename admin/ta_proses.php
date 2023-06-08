<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA TAHUN AJARAN
if(isset($_POST['simpan'])){

	$nama_th_ajaran	= trim($_POST['nama_th_ajaran']);
	$id_th_ajaran	= kode_otomatis("th_ajaran", "id_th_ajaran", "", "", "");
	
	//Cek Tahun Ajaran
	$sql_cek = mysql_query("SELECT * FROM th_ajaran WHERE nama_th_ajaran='".$nama_th_ajaran."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Tahun Ajaran $nama_th_ajaran sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "INSERT INTO th_ajaran (`id_th_ajaran`, `nama_th_ajaran`) VALUES ('".$id_th_ajaran."', '".$nama_th_ajaran."')";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Tahun Ajaran Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=ta';</script>";	
		}else{
			echo "<script>alert('Data Tahun Ajaran Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}
		
//JIKA UBAH DATA TAHUN AJARAN
}else if(isset($_POST['ubah'])){
	
	$id_th_ajaran	= trim($_POST['id_th_ajaran']);
	$nama_th_ajaran	= trim($_POST['nama_th_ajaran']);

	//Cek Tahun Ajaran
	$sql_cek = mysql_query("SELECT * FROM th_ajaran WHERE nama_th_ajaran='".$nama_th_ajaran."' AND id_th_ajaran<>'".$id_th_ajaran."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Tahun Ajaran $nama_th_ajaran sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "UPDATE th_ajaran SET nama_th_ajaran='".$nama_th_ajaran."' WHERE id_th_ajaran='".$id_th_ajaran."'";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Tahun Ajaran Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=ta';</script>";	
		}else{
			echo "<script>alert('Data Tahun Ajaran Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}

//JIKA HAPUS DATA TAHUN AJARAN
}else if(isset($_GET['hapus'])){
	
	$sql = "DELETE FROM th_ajaran WHERE id_th_ajaran='".$_GET['hapus']."'";
	if(mysql_query($sql))
		{
			echo "<script>alert('Data Tahun Ajaran Berhasil Dihapus')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=ta';</script>";	
		}else{
			echo "<script>alert('Data Tahun Ajaran Gagal Dihapus')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=ta';</script>";	
}
?>