<?php
	function hitung_umur($tgl_lahir, $tgl_kematian){
		list($thn_skrg, $bln_skrg, $tgl_skrg) = explode('-', date('Y-m-d', strtotime($tgl_kematian)));
		list($thn_lhr, $bln_lhr, $tgl_lhr) = explode('-', date('Y-m-d', strtotime($tgl_lahir)));
		$umur = $thn_skrg - $thn_lhr;
				
		if($bln_skrg < $bln_lhr){
			$umur--;
		}else if(($bln_skrg == $bln_lhr) && ($tgl_skrg < $tgl_lhr)){
			$umur--;
		}
		 
		return $umur;
	}
	function tgl_format($tgl, $format="Y-m-d"){
			$tgl		= str_replace("/", "-", $tgl);
			$tgl		= date_create($tgl);
			$tanggal	= date_format($tgl,$format);
			return $tanggal;		 
	}
	
	function tgl_indo_db($tgl){
			$tgl		= str_replace("/", "-", $tgl);
			$tgl		= date_create($tgl);
			$tanggal	= date_format($tgl,"Y-m-d");
			return $tanggal;		 
	}
	
	function tgl_db_indo($tgl){
			$tgl		= str_replace("/", "-", $tgl);
			$tgl		= date_create($tgl);
			$tanggal	= date_format($tgl,"d-m-Y");
			return $tanggal;		 
	}

	function tgl_indo($tgl){
			$tgl		= str_replace("/", "-", $tgl);
			$tgl		= date_create($tgl);
			$hari		= getHari(date_format($tgl,"N"));
			$tanggal	= date_format($tgl,"j");
			$bulan		= getBulan(date_format($tgl,"n"));
			$tahun		= date_format($tgl,"Y");
			$jam		= date_format($tgl,"H:i:s");
			$jam		= ($jam=='00:00:00')?'':$jam;
			return $hari.', '.$tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}
	
	function tgl_indo_biasa($tgl){
			$tgl		= str_replace("/", "-", $tgl);
			$tgl		= date_create($tgl);
			$tanggal	= date_format($tgl,"j");
			$bulan		= getBulan(date_format($tgl,"n"));
			$tahun		= date_format($tgl,"Y");
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	
	
	function getHari($hari){
		switch ($hari){
			case 1: 
				return "Senin";
				break;
			case 2:
				return "Selasa";
				break;
			case 3:
				return "Rabu";
				break;
			case 4:
				return "Kamis";
				break;
			case 5:
				return "Jum'at";
				break;
			case 6:
				return "Sabtu";
				break;
			case 7:
				return "Minggu";
				break;
		}
	}
	
	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
?>
