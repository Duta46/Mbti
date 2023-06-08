<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA JAWABAN
if(isset($_POST['simpan'])){

	$bobot			= trim($_POST['bobot']);
	$nama_jawaban	= trim($_POST['nama_jawaban']);
	$id_jawaban		= kode_otomatis("jawaban", "id_jawaban", "", "", "");
	
	//Cek Jawaban
	$sql_cek = mysql_query("SELECT * FROM jawaban WHERE (nama_jawaban='".$nama_jawaban."' OR bobot='".$bobot."')");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('No Urut $bobot / Jawaban $nama_jawaban sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "INSERT INTO jawaban (`id_jawaban`, `nama_jawaban`, `bobot`) VALUES ('".$id_jawaban."', '".$nama_jawaban."', '".$bobot."')";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Jawaban Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=jawaban';</script>";	
		}else{
			echo "<script>alert('Data Jawaban Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}
		
//JIKA UBAH DATA JAWABAN
}else if(isset($_POST['ubah'])){
	
	$id_jawaban		= trim($_POST['id_jawaban']);
	$bobot			= trim($_POST['bobot']);
	$nama_jawaban	= trim($_POST['nama_jawaban']);
	
	//Cek Jawaban
	$sql_cek = mysql_query("SELECT * FROM jawaban WHERE (nama_jawaban='".$nama_jawaban."' OR bobot='".$bobot."') AND id_jawaban<>'".$id_jawaban."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('No Urut $bobot / Jawaban $nama_jawaban sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "UPDATE jawaban SET bobot='".$bobot."', nama_jawaban='".$nama_jawaban."' WHERE id_jawaban='".$id_jawaban."'";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Jawaban Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=jawaban';</script>";	
		}else{
			echo "<script>alert('Data Jawaban Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}

//JIKA HAPUS DATA JAWABAN
}else if(isset($_GET['hapus'])){
	
	$sql = "DELETE FROM jawaban WHERE id_jawaban='".$_GET['hapus']."'";
	if(mysql_query($sql))
		{
			echo "<script>alert('Data Jawaban Berhasil Dihapus')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=jawaban';</script>";	
		}else{
			echo "<script>alert('Data Jawaban Gagal Dihapus')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=jawaban';</script>";	
}
?>