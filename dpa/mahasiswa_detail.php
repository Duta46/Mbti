<?php 
if(isset($_GET['id']) && isset($_GET['idResult'])){

    $id_mahasiswa = $_GET['id'];
    $id_result = $_GET['idResult'];

    if(isset($_GET['tipe']) && $_GET['tipe']=='sebelumnya'){
        $tipe = "&tipe=".$_GET['tipe'];
        $judul = "Hasil Tes Sebelumnya";
    }else{
        $judul = "Detail Hasil Tipe Kepribadian MBTI";
        $tipe="";
    }



    //DEKLARASI AWAL SOAL
    $soal       = array();

    //HITUNG JUMLAH SOAL
    $jmlSoal    = 0;
    $sql_soal   = "SELECT * FROM soal";
    $eks_soal   = mysql_query($sql_soal);
    while($hasil_soal = mysql_fetch_array($eks_soal)){
        $jmlSoal += 1;
        $soal[$jmlSoal]['id_soal']   = $hasil_soal['id_soal'];
        $soal[$jmlSoal]['nama_soal'] = $hasil_soal['nama_soal'];
    }

    if(isset($_GET['soal'])){
        $urutan_soal = $_GET['soal'];
    }else{
        $urutan_soal = 1;
    }

    //DATA MAHASISWA
    $sql = "SELECT result.*, mahasiswa.nama, mahasiswa.nim, tipe_kepribadian.nama as tipe_kepribadian, tipe_kepribadian.deskripsi 
        FROM result INNER JOIN mahasiswa ON result.id_mahasiswa = mahasiswa.id_mahasiswa 
        INNER JOIN tipe_kepribadian ON result.`id_tipekepribadian` = tipe_kepribadian.id_tipekepribadian 
        WHERE mahasiswa.id_mahasiswa='".$id_mahasiswa."'
        AND result.id_result = $id_result";

    $run = mysql_query($sql);
    $data = mysql_fetch_array($run);

?>

<style type="text/css">
.progress-middle .progress-bar {
    position: relative;
}
.progress-right .progress-bar {
    float: right;
}
.progress.vertical {
    height: 50px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    border: none;
}
.text-middle{
    padding-top:15px;
    padding-right:55px;
    font-size: 24px;
    display: block;
    width: 100%;
    color:black;
}
.info-nilai{
    width: 100px;
    height: 100px;
}
</style>
<?php
//KATEGORI
$kategori = array();
$sql_kategori = mysql_query("SELECT * FROM kategori ORDER BY nama_kategori ");

while($hasil_kategori = mysql_fetch_array($sql_kategori)) { 
    $kategori[$hasil_kategori['id_kategori']] = $hasil_kategori['nama_kategori'];
}
?>

<div class="row">
    
    <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 10px;" ><?php echo $judul;?></h2>
    <?php
    if(isset($_GET['tipe']) && $_GET['tipe']=='sebelumnya'){
    ?>
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama :</label>
                <input readonly type="text" class="form-control"  placeholder="Name" value="<?php echo $data['nama']?>">
            </div>
            <div class="form-group">

                <label>Nim :</label>
                <input readonly type="text" class="form-control"  placeholder="Nim" value="<?php echo $data['nim']?>">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">

                <label>Tanggal Pengerjaan :</label>
                <input readonly type="text" class="form-control" value="<?php echo $data['tgl_pengerjaan']?>">
            </div>   
            <div class="form-group">

                <label>Waktu Pengerjaan :</label>
                <input readonly type="text" class="form-control" value="<?php echo $data['waktu_selesai']?>">
            </div>   
        </div>     
        
    </div>  
    <div class="col-sm-3"></div>
    <?php
    }
    ?>

    <div style="clear: both;"></div>

    <div class="col-sm-1"></div>
    <div class="col-sm-10">
    <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 20px;" ><?php echo $soal[$urutan_soal]['nama_soal'];?></h2>
    </div>
    <div class="col-sm-1"></div>
    <div style="clear: both;"></div>

    <?php
    //AMBIL DATA KATEGORI PER SOAL
    $kategori       = array();
    $jmlKategori    = 0;
    $sql_konten = "SELECT k.id_kategori, nama_kategori FROM kategori k
                JOIN konten_soal ks ON k.id_kategori=ks.id_kategori 
                WHERE id_soal='".$soal[$urutan_soal]['id_soal']."'
                GROUP BY k.id_kategori ORDER BY k.id_kategori";
    $eks_konten = mysql_query($sql_konten);
    while($hasil_konten = mysql_fetch_array($eks_konten)){
        $jmlKategori += 1;
        $kategori[$jmlKategori]['id_kategori']      = $hasil_konten['id_kategori'];
        $kategori[$jmlKategori]['nama_kategori']    = $hasil_konten['nama_kategori'];
    }
    ?>
    
    <div class="col-sm-4">
        <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 10px;" ><?php echo $kategori[1]['nama_kategori'];?></h2>
    </div>

    <div class="col-sm-4">
        
    </div>

    <div class="col-sm-4">
        <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 10px;" ><?php echo $kategori[2]['nama_kategori'];?></h2>
    </div>

    <div style="clear: both;"></div>
    
    
    <?php
    //Ambil Data di Kontan Soal
    $soal_1 = array();
    $no_urut = 1;
    $sql_soal = "SELECT * FROM konten_soal
    WHERE  id_kategori='".$kategori[1]['id_kategori']."'
    ORDER BY kode_soal";
    $eks_soal = mysql_query($sql_soal);
    while($hasil_soal = mysql_fetch_array($eks_soal)){
        $soal_1[$no_urut]['kode_soal']   = $hasil_soal['kode_soal'];
        $soal_1[$no_urut]['id_soal']     = $hasil_soal['id_soal'];
        $soal_1[$no_urut]['nama_konten'] = $hasil_soal['nama_konten'];
        $no_urut++;
    }

    $soal_2 = array();
    $no_urut = 1;
    $sql_soal = "SELECT * FROM konten_soal
    WHERE  id_kategori='".$kategori[2]['id_kategori']."'
    ORDER BY kode_soal";
    $eks_soal = mysql_query($sql_soal);
    while($hasil_soal = mysql_fetch_array($eks_soal)){
        $soal_2[$no_urut]['kode_soal']   = $hasil_soal['kode_soal'];
        $soal_2[$no_urut]['id_soal']     = $hasil_soal['id_soal'];
        $soal_2[$no_urut]['nama_konten'] = $hasil_soal['nama_konten'];
        $no_urut++;
    }
    ?>

    <?php
    $jml_kiri = 0;
    $jml_kanan = 0;
    foreach($soal_1 as $no_urut=>$arr){
    ?>
        <div class="col-sm-4">
            <h4 style="text-align: center; border: 1px solid black; background-color: #dea245; color: black; margin-bottom: 10px;height: 60px;" >
                <?php echo $no_urut.'. '.$arr['nama_konten'];?>
            </h4>
        </div>

        <div class="col-sm-4">
            <div class="col-sm-12">
                <?php
                //CEK KONTEN SOAL KIRI
                $sql_konten = "SELECT nilai
                FROM nilai
                WHERE kode_soal ='".$arr['kode_soal']."'
                AND id_result = '".$id_result."'";
                $eks_konten = mysql_query($sql_konten);
                if(mysql_num_rows($eks_konten)>0){
                    while($hasil_konten = mysql_fetch_array($eks_konten)){
                        $nilai = $hasil_konten['nilai'];
                        $jml_kiri += $nilai;
                    }
                }else{
                    $nilai = 0;
                }

                $persen = ($nilai)*(100/3);
                ?>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="progress vertical">
                          <div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar" aria-valuenow="<?php echo $persen;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen;?>%;">
                            <span class="text-middle info-nilai"><?php echo $nilai;?></span>
                          </div>
                        </div>
                    </div>
                </div>

                <?php
                //CEK KONTEN SOAL KANAN
                $sql_konten = "SELECT nilai
                FROM nilai
                WHERE kode_soal ='".$soal_2[$no_urut]['kode_soal']."'
                AND id_result = '".$id_result."'";
                $eks_konten = mysql_query($sql_konten);
                if(mysql_num_rows($eks_konten)>0){
                    while($hasil_konten = mysql_fetch_array($eks_konten)){
                        $nilai = $hasil_konten['nilai'];
                        $jml_kanan += $nilai;
                    }
                }else{
                    $nilai = 0;
                }

                $persen = ($nilai)*(100/3);
                ?>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="progress vertical progress-right">
                          <div class="progress-bar progress-bar-striped progress-bar-success" role="progressbar" aria-valuenow="<?php echo $persen;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen;?>%;">
                            <span class="text-middle info-nilai"><?php echo $nilai;?></span>
                          </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-sm-4">
            <h4 style="text-align: center; border: 1px solid black; background-color: #dea245; color: black; margin-bottom: 10px;height: 60px;" >
                <?php echo $no_urut.'. '.$soal_2[$no_urut]['nama_konten'];?>
            </h4>
        </div>
    <?php    
    }
    ?>

    <div style="clear: both;"></div>


    <div class="col-sm-4">
        <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 10px;" >Score :<?php echo $jml_kiri;?></h2>
    </div>

    <div class="col-sm-4">
        
    </div>

    <div class="col-sm-4">
        <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 10px;" >Score :<?php echo $jml_kanan;?></h2>
    </div>

    <div style="clear: both;"></div>

    
    
    <center>
    
    <?php
    if($urutan_soal>1 && $urutan_soal<=$jmlSoal){
        $no_soal = $urutan_soal-1;
    ?>
        <a href="index.php?hal=mahasiswa_detail&id=<?php echo $id_mahasiswa;?>&idResult=<?php echo $id_result;?>&soal=<?php echo $no_soal;?><?php echo $tipe;?>">
        <button style="padding: 10px; margin-top: 20px; background-color: #bfa145; color: black;" type="button">Prev</button>
        </a>
    <?php
    }

    if($urutan_soal<$jmlSoal){
        $no_soal = $urutan_soal+1;
    ?>
        <a href="index.php?hal=mahasiswa_detail&id=<?php echo $id_mahasiswa;?>&idResult=<?php echo $id_result;?>&soal=<?php echo $no_soal;?><?php echo $tipe;?>">
        <button style="padding: 10px; margin-top: 20px; background-color: #bfa145; color: black;" type="button">Next</button>
        </a>
    <?php
    }
    ?>

    <?php
    if($urutan_soal==1 || $urutan_soal==$jmlSoal){
    ?>
    <br />
    <a href="index.php?hal=mahasiswa_lihat&id=<?php echo $id_mahasiswa;?>">
    <button style="padding: 10px; margin-top: 20px; background-color: #bfa145; color: black;" type="button">Kembali</button>
    </a>
    <?php
    }
    ?>
    </center>

</div>
<?php
}else{
    echo "<meta http-equiv='Refresh' content='0; url=index.php?hal=mahasiswa'>";
}
?>