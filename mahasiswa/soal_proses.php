<?php
session_start();
if(isset($_SESSION['account_myers_briggs']) && ($_SESSION['account_myers_briggs']['divisi']=='Mahasiswa')){

	require_once '../inc/koneksi.php';
	require_once '../inc/fungsi.php';

	//Lama Waktu Selesai
	$waktu_selesai = selisih($_SESSION['waktu_selesai']);

	$sql_mhs = "SELECT * FROM mahasiswa mhs JOIN account a ON mhs.id_mahasiswa=a.id_mahasiswa WHERE username='".$_SESSION['account_myers_briggs']['username']."' AND divisi='Mahasiswa'";
	$eks_mhs	= mysqli_query($sql_mhs);
	$hasil_mhs	= mysqli_fetch_array($eks_mhs);
	?>

	<?php 
	if(isset($_POST['id_soal']) && isset($_POST['id_kategori']) && isset($_POST['jawaban'])){
	    //Masukkan Jawaban Terakhir Ke Sesi
	    foreach ($_POST['jawaban'] as $kode_soal => $bobot) {
	        $_SESSION['total'][$kode_soal] = $bobot;
	    }
	    
		$konten_soal  = array();

		foreach($_SESSION['total'] as $kode_soal=>$bobot){
			$nilai_total 	= null;
			$nilai_kategori = null;
			//Cek Query
			$sql_konten = "SELECT id_soal, id_kategori FROM konten_soal WHERE kode_soal='".$kode_soal."'";
			$eks_konten = mysqli_query("SELECT id_soal, id_kategori FROM konten_soal WHERE kode_soal='".$kode_soal."'");
			while($hasil_konten = mysqli_fetch_array($eks_konten)){
				if(isset($konten_soal[$hasil_konten['id_soal']][$hasil_konten['id_kategori']])){
					$konten_soal[$hasil_konten['id_soal']][$hasil_konten['id_kategori']] += $bobot;
				}else{
					$konten_soal[$hasil_konten['id_soal']][$hasil_konten['id_kategori']] = $bobot;
				}
			}
		}

		//MENENTUKAN KEPIBADIAN
		$kelompok_kategori  = array();
		$tipekepribadian    = "";

		foreach($konten_soal as $id_soal=>$ArrKategori){
			$nilai_total 	= null;
			$nilai_kategori = null;
			foreach($ArrKategori as $id_kategori=>$total){

				$total_kategori[$id_soal][$id_kategori] = $total;

				if(empty($nilai_total) && empty($nilai_kategori)){
					$nilai_total = $total;
					$nilai_kategori = $id_kategori;
				}else{
					if($nilai_total<$total){
						$nilai_total = $total;
						$nilai_kategori = $id_kategori;
					}
				}
			}
			//Simpan Array
			$kelompok_kategori[$id_soal]['id'] 			= substr($nilai_kategori, 0, 1);
			$tipekepribadian							.= $kelompok_kategori[$id_soal]['id'];
			$kelompok_kategori[$id_soal]['total']		= $nilai_total;
		}

		//Ambil Data Tipe Kepribadian
		$sql_cek = mysqli_query("SELECT * FROM tipe_kepribadian WHERE nama='".$tipekepribadian."'");
		if (mysqli_num_rows($sql_cek)>0){

			$hasil_cek = mysqli_fetch_array($sql_cek);

			$id_result			= kode_otomatis("result", "id_result", "", "", "");
			//Simpan Result
			$sql_result = "INSERT INTO result (`id_result`, `id_tipekepribadian`, `id_mahasiswa`, `tgl_pengerjaan`, `waktu_selesai`) 
						VALUES ('".$id_result."', '".$hasil_cek['id_tipekepribadian']."', '".$hasil_mhs['id_mahasiswa']."', now(), '".$waktu_selesai."')";
					
			if(mysqli_query($sql_result))
			{
				//Simpan Nilai Result
				foreach($_SESSION['total'] as $kode_soal=>$bobot){
					$sql_nilai = "INSERT INTO nilai (`id_result`, `kode_soal`, `nilai`) 
						VALUES ('".$id_result."', '".$kode_soal."', '".$bobot."')";
					mysqli_query($sql_nilai);
				}
				
			}
		}else{
			echo "<script>alert('TIDAK ADA TIPE $tipekepribadian')</script>";
		}

		//Unset Sesi
		unset($_SESSION['total']);
		unset($_SESSION['waktu_selesai']);

		echo "<meta http-equiv='Refresh' content='0; url=index.php?hal=result'>";

	}else{
		echo "<meta http-equiv='Refresh' content='0; url=index.php?hal=test_mbti'>";
	}

}else{
	echo "<meta http-equiv='Refresh' content='0; url=../login.php'>";
}
?>