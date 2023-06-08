<?php
date_default_timezone_set('Asia/Jakarta');

//FUNGSI WEBSITE
define ("title", "Myers-Briggs Type Indicator Scale");
define ("keterangan", "For Academic Purpose PD/MAPRO UII/2010");
define ("author", "Copyright &copy; 2017. Abdul Ghoni Ikhwanuddin. All Right Reserved ");

//FUNGSI AGAMA
$program_studi = array('Teknik Informatika'=>'Teknik Informatika','Teknik Industri'=>'Teknik Industri','Teknik Kimia'=>'Teknik Kimia','Teknik Elektro'=>'Teknik Elektro',
'Teknik Sipil'=>'Teknik Sipil','Teknik Mesin'=>'Teknik Mesin','Teknik Lingkungan'=>'Teknik Lingkungan','Arsitektur'=>'Arsitektur','Psikologi'=>'Psikologi','Farmasi'=>'Farmasi','Ekonomi'=>'Ekonomi','Hukum'=>'Hukum','Ekonomi Islam'=>'Ekonomi Islam','Manajemen'=>'Manajemen');

//FUNGSI RUPIAH
function Rupiah($number=0){
	$angka = number_format($number, 0, ',', '.');
	return $angka;
}

//Fungsi Selisih Waktu
function selisih($waktu){
      $sekarang = strtotime(date("H:i:s"));
      $waktu = strtotime($waktu);

      $hitung = abs($sekarang - $waktu);

      return gmdate("H:i:s", $hitung);
  }

//KODE AUTO INCREMENT
function kode_otomatis($tabel, $id, $inisial, $index, $panjang)
{
  $query  = "SELECT `".$id."` as id FROM `".$tabel."` WHERE `".$id."` LIKE '".$inisial."%'";
  $query  = mysql_query($query);
  while($data = mysql_fetch_array($query))
  {
    $max_id[] = (int) substr($data['id'],strlen($inisial));
  }
  $id_max = (isset($max_id))?max($max_id):0;
  if($index=='' && ($panjang=='' || $panjang!=''))
  {
  $no_urut  = (int) $id_max;
  }else if($index!='' && $panjang==''){
  $no_urut    = (int) substr($id_max, $index);
  }else{
  $no_urut  = (int) substr($id_max, $index, $panjang);
  }
  $no_urut  = (int) $id_max;
  $no_urut  = $no_urut + 1;
  if($index=='' && $panjang=='')
  {
    $id_baru  = $no_urut;
  }else if($index!='' && $panjang==''){
    $id_baru  = $inisial . $no_urut;
  }else{
    $id_baru  = $inisial . sprintf("%0$panjang"."s", $no_urut);
  }
  return $id_baru;
}

function resize($newWidth, $targetFile, $originalFile) {

    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw new Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    /*
    if (file_exists($targetFile)) {
            unlink($targetFile);
    }*/
    $image_save_func($tmp, "$targetFile");
}

// Upload file untuk download file
function UploadFile($fupload_name, $lokasi, $lokasi_file){
  //direktori file
  $vdir_upload = "$lokasi/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($lokasi_file, $vfile_upload);
}
//READMORE
function readmore ($string, $limit=160, $break=".", $pad="...") {
    // return with no change if string is shorter than $limit
    if(strlen($string) <= $limit)
        return $string;
    // is $break present between $limit and the end of the string? 
    if ( false !== ($breakpoint = strpos($string, $break, $limit)) ) {
        if($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }
    return $string;
}
?>