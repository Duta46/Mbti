<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA TIPE KEPRIBADIAN
if(isset($_POST['simpan'])){

	$nama				= trim($_POST['nama']);
	$deskripsi			= $_POST['deskripsi'];
	$id_tipekepribadian	= kode_otomatis("tipe_kepribadian", "id_tipekepribadian", "", "", "");
	
	//Cek Kepribadian
	$sql_cek = mysql_query("SELECT * FROM tipe_kepribadian WHERE (nama='".$nama."')");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Kepribadian $nama sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "INSERT INTO tipe_kepribadian (`id_tipekepribadian`, `nama`, `deskripsi`) VALUES ('".$id_tipekepribadian."', '".$nama."', '".$deskripsi."')";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Kepribadian Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=kepribadian';</script>";	
		}else{
			echo "<script>alert('Data Kepribadian Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}
		
//JIKA UBAH DATA TIPE KEPRIBADIAN
}else if(isset($_POST['ubah'])){
	
	$id_tipekepribadian		= trim($_POST['id_tipekepribadian']);
	$nama					= trim($_POST['nama']);
	$deskripsi				= $_POST['deskripsi'];
	
	//Cek Kepribadian
	$sql_cek = mysql_query("SELECT * FROM tipe_kepribadian WHERE (nama='".$nama."') AND id_tipekepribadian<>'".$id_tipekepribadian."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Kepribadian $nama sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "UPDATE tipe_kepribadian SET nama='".$nama."', deskripsi='".$deskripsi."' WHERE id_tipekepribadian='".$id_tipekepribadian."'";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Kepribadian Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=kepribadian';</script>";	
		}else{
			echo "<script>alert('Data Kepribadian Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}

//JIKA HAPUS DATA TIPE KEPRIBADIAN
}else if(isset($_GET['hapus'])){
	
	$sql = "DELETE FROM tipe_kepribadian WHERE id_tipekepribadian='".$_GET['hapus']."'";
	if(mysql_query($sql))
		{
			echo "<script>alert('Data Kepribadian Berhasil Dihapus')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=kepribadian';</script>";	
		}else{
			echo "<script>alert('Data Kepribadian Gagal Dihapus')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=kepribadian';</script>";	
}
?>