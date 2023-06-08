<?php
session_start();
require_once '../inc/koneksi.php';
require_once '../inc/fungsi.php';
require_once '../inc/fungsi_indotgl.php';

//JIKA TAMBAH DATA SOAL
if(isset($_POST['simpan'])){

	$no_urut	= trim($_POST['no_urut']);
	$nama_soal	= trim($_POST['nama_soal']);
	$id_soal	= kode_otomatis("soal", "id_soal", "", "", "");
	
	//Cek Soal
	$sql_cek = mysql_query("SELECT * FROM soal WHERE (nama_soal='".$nama_soal."' OR no_urut='".$no_urut."')");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Kategori, Nama Soal, No Urut sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "INSERT INTO soal (`id_soal`, `no_urut`, `nama_soal`) VALUES ('".$id_soal."', '".$no_urut."', '".$nama_soal."')";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Soal Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=soal';</script>";	
		}else{
			echo "<script>alert('Data Soal Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}
		
//JIKA UBAH DATA SOAL
}else if(isset($_POST['ubah'])){
	
	$id_soal	= trim($_POST['id_soal']);
	$no_urut	= trim($_POST['no_urut']);
	$nama_soal	= trim($_POST['nama_soal']);
	
	//Cek Soal
	$sql_cek = mysql_query("SELECT * FROM soal WHERE (nama_soal='".$nama_soal."' OR no_urut='".$no_urut."') AND id_soal<>'".$id_soal."'");
	if (mysql_num_rows($sql_cek)>0){
		echo "<script>alert('Kategori, Nama Soal, No Urut sudah ada sebelumnya')</script>";
		//arahkan
		echo "<script>window.location='javascript:history.go(-1)';</script>";	
	}else{

		//Menyimpan data
		$sql = "UPDATE soal SET no_urut='".$no_urut."', nama_soal='".$nama_soal."' WHERE id_soal='".$id_soal."'";
		
		if(mysql_query($sql))
		{
			echo "<script>alert('Data Soal Berhasil Disimpan')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=soal';</script>";	
		}else{
			echo "<script>alert('Data Soal Gagal Disimpan')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
	}

//JIKA HAPUS DATA SOAL
}else if(isset($_GET['hapus'])){
	
	$sql = "DELETE FROM soal WHERE id_soal='".$_GET['hapus']."'";
	if(mysql_query($sql))
		{
			echo "<script>alert('Data Soal Berhasil Dihapus')</script>";
			//arahkan
			echo "<script>window.location='index.php?hal=soal';</script>";	
		}else{
			echo "<script>alert('Data Soal Gagal Dihapus')</script>";
			//arahkan
			echo "<script>window.location='javascript:history.go(-1)';</script>";	
		}
//JIKA TIDAK SEMUANYA
}else{
	echo "<script>window.location='index.php?hal=soal';</script>";	
}
?>