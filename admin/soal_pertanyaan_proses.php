<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA SOAL
if(isset($_POST['simpan'])){

	$id_soal		= trim($_POST['id_soal']);
	$id_kategori	= trim($_POST['id_kategori']);
	$nama_konten	= trim($_POST['nama_konten']);
	$kode_soal		= kode_otomatis("konten_soal", "kode_soal", $id_kategori, 3, 2);
	
	//Cek Soal
	$sql_cek = mysql_query("SELECT * FROM konten_soal WHERE id_soal='".$id_soal."' AND id_kategori='".$id_kategori."' AND nama_konten='".$nama_konten."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Konten Soal sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "INSERT INTO konten_soal (`kode_soal`, `id_kategori`, `id_soal`, `nama_konten`) VALUES ('".$kode_soal."', '".$id_kategori."', '".$id_soal."', '".$nama_konten."')";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Konten Soal Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=soal_pertanyaan_tambah&id_soal=".$id_soal."&id_kategori=".$id_kategori."';</script>";	
		}else{
			echo "<script>alert('Data Konten Soal Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}
		
//JIKA UBAH DATA SOAL
}else if(isset($_POST['ubah'])){
	
	$kode_soal		= trim($_POST['kode_soal']);
	$id_soal		= trim($_POST['id_soal']);
	$id_kategori	= trim($_POST['id_kategori']);
	$nama_konten	= trim($_POST['nama_konten']);
	
	//Cek Soal
	$sql_cek = mysql_query("SELECT * FROM konten_soal WHERE id_soal='".$id_soal."' AND id_kategori='".$id_kategori."' AND nama_konten='".$nama_konten."' AND kode_soal<>'".$kode_soal."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Konten Soal sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "UPDATE konten_soal SET id_kategori='".$id_kategori."', id_soal='".$id_soal."', nama_konten='".$nama_konten."' WHERE kode_soal='".$kode_soal."'";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Konten Soal Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=soal_pertanyaan&id_soal=".$id_soal."&id_kategori=".$id_kategori."';</script>";	
		}else{
			echo "<script>alert('Data Konten Soal Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}

//JIKA HAPUS DATA SOAL
}else if(isset($_GET['hapus'])){
	
	$sql = "DELETE FROM konten_soal WHERE kode_soal='".$_GET['hapus']."'";
	if(mysql_query($sql))
		{
			echo "<script>alert('Data Konten Soal Berhasil Dihapus')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=soal_pertanyaan&id_soal=".$_GET['id_soal']."';</script>";	
		}else{
			echo "<script>alert('Data Konten Soal Gagal Dihapus')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=soal';</script>";	
}
?>