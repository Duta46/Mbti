<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA KATEGORI
if(isset($_POST['simpan'])){

	$nama_kategori	= trim($_POST['nama_kategori']);
	$id_kategori	= trim($_POST['id_kategori']);
	
	//Cek Kategori
	$sql_cek = mysql_query("SELECT * FROM kategori WHERE (id_kategori='".$id_kategori."' OR nama_kategori='".$nama_kategori."')");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Kode Kategori $id_kategori / Kategori $nama_kategori sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "INSERT INTO kategori (`id_kategori`, `nama_kategori`) VALUES ('".$id_kategori."', '".$nama_kategori."')";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Kategori Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=kategori';</script>";	
		}else{
			echo "<script>alert('Data Kategori Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}
		
//JIKA UBAH DATA KATEGORI
}else if(isset($_POST['ubah'])){
	
	$id_kategori1	= trim($_POST['id_kategori1']);
	$id_kategori	= trim($_POST['id_kategori']);
	$nama_kategori	= trim($_POST['nama_kategori']);
	
	//Cek Kategori
	$sql_cek = mysql_query("SELECT * FROM kategori WHERE (id_kategori='".$id_kategori."' OR nama_kategori='".$nama_kategori."') AND id_kategori<>'".$id_kategori1."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Kode Kategori $id_kategori / Kategori $nama_kategori sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "UPDATE kategori SET id_kategori='".$id_kategori."', nama_kategori='".$nama_kategori."' WHERE id_kategori='".$id_kategori1."'";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Kategori Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=kategori';</script>";	
		}else{
			echo "<script>alert('Data Kategori Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}

//JIKA HAPUS DATA KATEGORI
}else if(isset($_GET['hapus'])){
	
	$sql = "DELETE FROM kategori WHERE id_kategori='".$_GET['hapus']."'";
	if(mysql_query($sql))
		{
			echo "<script>alert('Data Kategori Berhasil Dihapus')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=kategori';</script>";	
		}else{
			echo "<script>alert('Data Kategori Gagal Dihapus')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=kategori';</script>";	
}
?>