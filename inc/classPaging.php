<?php
// class paging untuk page administrator
class Paging{
// Fungsi untuk mencek page dan posisi data
function cariPosisi($batas){
if(empty($_GET['page'])){
	$posisi=0;
	$_GET['page']=1;
}
else{
	$posisi = ($_GET['page']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total page
function jumlahHalaman($jmldata, $batas){
$jmlpage = ceil($jmldata/$batas);
return $jmlpage;
}

// Fungsi untuk link page 1,2,3 (untuk admin)
function navHalaman($page_aktif, $jmlpage, $file, $jmldata=''){
	$jumlah_data = ($jmldata=='')?'':"<li class='disabled'><a><span class='label label-success'> Total : ".$jmldata."</span></a>";
$link_page = "<ul class='pagination'>";

// Link ke page pertama (first) dan sebelumnya (prev)
if($page_aktif > 1){
	$prev = $page_aktif-1;
	$link_page .= "<li class='previous'><a href=$_SERVER[PHP_SELF]?hal=$file&page=1>&larr; First</a></li><li class='previous'><a href=$_SERVER[PHP_SELF]?hal=$file&page=$prev>&laquo; Prev</a></li>";
}else{
	$link_page .= "<li class='disabled'><a>&larr; First</a></li><li class='disabled'><a>&laquo; Prev</a></li>";

}

// Link page 1,2,3, ...
$angka = ($page_aktif > 3 ? "<li class='disabled'><a>...</a></li>" : " "); 
for ($i=$page_aktif-2; $i<$page_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?hal=$file&page=$i>$i</a></li>";
  }
	  $angka .= "<li class='disabled'><a>$page_aktif</a></li>";
	  
    for($i=$page_aktif+1; $i<($page_aktif+3); $i++){
    if($i > $jmlpage)
      break;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?hal=$file&page=$i>$i</a></li>";
    }
	  $angka .= ($page_aktif+3<$jmlpage ? "<li class='disabled'><a>...</a></li><li><a href=$_SERVER[PHP_SELF]?hal=$file&page=$jmlpage>$jmlpage</a></li>" : " ");

if($jmlpage > 1){
	$link_page .= "<li class='disabled'>$angka</li>";
}

// Link ke page berikutnya (Next) dan terakhir (Last) 
if($page_aktif < $jmlpage){
	$next = $page_aktif+1;
	$link_page .= "<li class='next'><a href=$_SERVER[PHP_SELF]?hal=$file&page=$next>Next &raquo;</a></li><li class='next'><a href=$_SERVER[PHP_SELF]?hal=$file&page=$jmlpage>Last &rarr;</a></li>";
}else{
	$link_page .= "<li class='disabled'><a>Next &raquo;</a></li><li class='disabled'><a>Last &rarr;</a></li>";
}
$link_page .= $jumlah_data."</ul>";
return $link_page;
}
}
?>