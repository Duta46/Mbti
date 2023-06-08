<?php 
if(isset($_GET['id'])){

$id = $_GET['id'];

if(isset($_GET['tipe']) && $_GET['tipe']=='sebelumnya'){
    $judul = "Hasil Tes Sebelumnya";
}else{
    $judul = "Detail Hasil Tipe Kepribadian MBTI";
}

$sql = "SELECT result.*, mahasiswa.nama, mahasiswa.nim, tipe_kepribadian.nama as tipe_kepribadian, tipe_kepribadian.deskripsi 
    FROM result INNER JOIN mahasiswa ON result.id_mahasiswa = mahasiswa.id_mahasiswa 
    INNER JOIN tipe_kepribadian ON result.`id_tipekepribadian` = tipe_kepribadian.id_tipekepribadian 
    WHERE mahasiswa.id_mahasiswa='".$hasil_mhs['id_mahasiswa']."'
    AND result.id_result = $id";

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
    min-height: 64px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    border: none;
}
.text-middle{
    padding-top:20px;
    font-size: 32px;
    display: block;
    width: 100%;
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
    
    <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 50px;" ><?php echo $judul;?></h2>
    

    <?php
    if(isset($_GET['tipe']) && $_GET['tipe']=='sebelumnya'){
    ?>
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Nama :</label>
            <input readonly type="text" class="form-control"  placeholder="Name" value="<?php echo $data['nama']?>">
        </div>
        <div class="form-group">

            <label>Nim :</label>
            <input readonly type="text" class="form-control"  placeholder="Nim" value="<?php echo $data['nim']?>">
        </div>
        <div class="form-group">

            <label>Tanggal Pengerjaan :</label>
            <input readonly type="text" class="form-control" value="<?php echo $data['tgl_pengerjaan']?>">
        </div>   
        <div class="form-group">

            <label>Waktu Pengerjaan :</label>
            <input readonly type="text" class="form-control" value="<?php echo $data['waktu_selesai']?>">
        </div>        

        <div class="form-group">
            <label>Hasil Tipe Kepribadian :</label>
            <input readonly type="text" class="form-control" name="hasil" value="<?php echo $data['tipe_kepribadian']?>">
        </div>

        <div class="form-group">
            <label>Deskripsi Tipe Kepribadian :</label>
            <textarea readonly type="text" class="form-control" rows="10"><?php echo $data['deskripsi']?></textarea>
        </div>
        
    </div>  
    <div class="col-sm-3"></div>
    <?php
    }
    ?>

    <div style="clear: both;"></div>

    <h1 style="text-align: center; color: black; margin-bottom: 50px;" ><?php echo $data['tipe_kepribadian']?></h1>

    <?php
    $sql_soal = "SELECT * FROM soal ORDER BY no_urut";
    $eks_soal = mysql_query($sql_soal);
    while ($hasil_soal = mysql_fetch_array($eks_soal)) {
    ?>
    <div class="col-sm-12">
        <h3 style="text-align: center; color: black; margin-bottom: 30px;" ><?php echo $hasil_soal['nama_soal'];?></h3>
        <?php
        //CEK KONTEN SOAL
        $sql_konten = "SELECT k.id_kategori, k.nama_kategori 
        FROM konten_soal ks JOIN kategori k ON ks.id_kategori=k.id_kategori
        WHERE id_soal='".$hasil_soal['id_soal']."' GROUP BY id_soal, k.id_kategori ORDER BY id_kategori";
        $eks_konten = mysql_query($sql_konten);

        //Bar Grafik
        $bar = array();
        $total_bar = 0;
        $idx = 1;
        while ($hasil_konten = mysql_fetch_array($eks_konten)) {
            $nilai = 0;
            //CEK NILAI RESULT
            $sql_nilai = "SELECT nilai FROM nilai n
            JOIN konten_soal ks ON n.kode_soal=ks.kode_soal
            JOIN kategori k ON ks.id_kategori=k.id_kategori
            WHERE id_result='".$data['id_result']."' 
            AND k.id_kategori='".$hasil_konten['id_kategori']."' ";
            $eks_nilai = mysql_query($sql_nilai);
            while ($hasil_nilai = mysql_fetch_array($eks_nilai)) {
                $nilai += $hasil_nilai['nilai'];
            }

            //Bar
            if($idx%2==0){
                $progress = "progress-right";
                $type = "success";
            }else{
                $progress = "";
                $type = "info";
            }

            $bar[$hasil_konten['id_kategori']] = $nilai;
            $total_bar += $nilai;
            $idx++;
        } 

        $kiri = 0;
        $kanan = 0;
        $idx = 1;
        foreach ($bar as $id_kategori => $total_nilai) {
            if($idx%2==0){
                $kanan = $total_nilai;
            }else{
                $kiri = $total_nilai;
            }
            $idx++;
        }
        ?>
        <div class="col-sm-12">
            <div class="media">
                <div class="media-left" style="width: 10%">
                    <div class="progress vertical">
                        <div class="progress-bar progress-bar-warning" style="width: 100%">
                            <span class="text-middle info-nilai"><?php echo $kiri;?></span>
                        </div>
                    </div>
                </div>
                <div class="media-body" style="width: 100%">
                    <div class="progress vertical">
                        <?php
                        //Tampilkan Bar
                        $idx = 1;
                        foreach ($bar as $id_kategori => $total_nilai) {
                            //Bar
                            if($idx%2==0){
                                $progress = "progress-right";
                                $type = "success";
                            }else{
                                $progress = "";
                                $type = "info";
                            }
                            //Persentase
                            if($total_bar>0){
                                $persen = ($total_nilai)*(100/$total_bar);
                            }else{
                                $persen = 0;
                            }
                        ?>
                          <div class="progress-bar progress-bar-<?php echo $type;?>" style="width: <?php echo $persen;?>%">
                            <span class="text-middle"><?php echo $kategori[$id_kategori];?></span>
                          </div>
                        <?php
                            $idx++;
                        }
                        ?>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="media-right">
                   <div class="progress vertical">
                        <div class="progress-bar progress-bar-warning" style="width: 100%">
                            <span class="text-middle info-nilai"><?php echo $kanan;?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-sm-12" style="clear:both;padding-bottom: 40px;"></div>
    <?php
    }
    ?>
    
    <center>
    <a href="index.php?hal=result">
    <button style="padding: 10px; margin-top: 20px; background-color: #bfa145; color: black;" type="button">Kembali</button>
    </a>
    </center>

</div>
<?php
}else{
    echo "<meta http-equiv='Refresh' content='0; url=index.php?hal=result'>";
}
?>