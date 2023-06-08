<?php
session_start();
include '../inc/koneksi.php';
include '../inc/fungsi.php';
?>

<style type="text/css">
    th, tr {
        text-align: center;
    }

    td {
       /*border: 1px solid black; */
        margin-left: 115px;
    }

    thead {
        background-color: grey;
        color: white;
        text-align: center;
    }

    td {
        max-width: 600px;
        width: auto;
        padding: 5px;
    }

/*******************
 STYLE RADIO BUTTONS
*******************/

input[type="radio"] {
    height: 25px;
    width: 25px;
    margin: 10px 0px 10px 50px;
    vertical-align: middle;

}

input[type="radio"]:checked {
    content: "\2022";
    color: red;
}
</style>
<!-- reservation-information -->

<?php
//DEKLARASI AWAL
$soal       = array();

//HITUNG JUMLAH SOAL
$jmlSoal    = 0;
$sql_soal   = "SELECT * FROM soal";
$eks_soal   = mysql_query($sql_soal);
while($hasil_soal = mysql_fetch_array($eks_soal)){
    //JUMLAH KONTEN SOAL
    $sql_konten = "SELECT id_kategori, nama_konten FROM konten_soal 
                WHERE id_soal='".$hasil_soal['id_soal']."'
                GROUP BY id_kategori ORDER BY id_kategori";
    $eks_konten = mysql_query($sql_konten);
    while($hasil_konten = mysql_fetch_array($eks_konten)){
        $jmlSoal += 1;
        $soal[$jmlSoal]['id_soal']      = $hasil_soal['id_soal'];
        $soal[$jmlSoal]['nama_soal']    = $hasil_soal['nama_soal'];
        $soal[$jmlSoal]['id_kategori']  = $hasil_konten['id_kategori'];
        $soal[$jmlSoal]['nama_konten']  = $hasil_konten['nama_konten'];
    }
}


//CEK JUMLAH SOAL > 0
if($jmlSoal>0){
    //CEK SOAL AWAL ATAU SUDAH NEXT/PREV
    if(isset($_POST['id_soal']) && isset($_POST['id_kategori']) && isset($_POST['urutan_soal'])){
        $urutan_soal = $_POST['urutan_soal'];
        $id_soal     = $_POST['id_soal'];
        $id_kategori = $_POST['id_kategori'];


        //Total Nilai Per Soal
        if(isset($_POST['jawaban'])){
            foreach ($_POST['jawaban'] as $kode_soal => $bobot) {
                $_SESSION['total'][$kode_soal] = $bobot;
            }
        }

        //Cek Posisi Next/Prev
        if(isset($_GET['posisi'])){
            $posisi = $_GET['posisi'];

            if($posisi=='next'){
                $urutan_soal += 1;
                $id_soal     = $soal[$urutan_soal]['id_soal'];
                $id_kategori = $soal[$urutan_soal]['id_kategori'];
            }else{
               $urutan_soal -= 1;
               $id_soal      = $soal[$urutan_soal]['id_soal'];
               $id_kategori  = $soal[$urutan_soal]['id_kategori'];
            }
        }

        $posisi_soal = 'lanjut';
        
        
    }else{
        //URUTAN SOAL
        $urutan_soal = 1;
        $posisi_soal = 'awal';
        $id_soal     = $soal[$urutan_soal]['id_soal'];
        $id_kategori = $soal[$urutan_soal]['id_kategori'];
    }


    //CEK POSISI SOAL AKHIR/LANJUT
    if($jmlSoal==$urutan_soal){
        $posisi_soal = 'akhir';
    }
    //CEK POSISI SOAL AWAL
    if($urutan_soal==1){
        $posisi_soal = 'awal';
    }

    /*
    echo "<pre>";
    print_r($_SESSION['total']);echo '<br>';
    print_r($urutan_soal);echo '<br>';
    print_r($posisi_soal);echo '<br>';
    print_r($id_soal);echo '<br>';
    print_r($id_kategori);echo '<br>';
    echo "</pre>";
    */


    //Cek ID SOAL Masih Ada
    if($id_soal && $id_kategori){

        //Ambil Data di Kontan Soal
        $sql = "SELECT * FROM konten_soal WHERE id_soal = '".$id_soal."' AND id_kategori='".$id_kategori."'";
        $run = mysql_query($sql);
        $jumlah = mysql_num_rows($run);

        $konten_soal = array();
        while($data = mysql_fetch_array($run)){
            $konten_soal[$data['kode_soal']] = $data['nama_konten'];
        }

        $tb_jawaban  = array();
        $sql_jawaban = "SELECT * FROM jawaban ORDER BY bobot, nama_jawaban";
        $eks_jawaban = mysql_query($sql_jawaban);
        while($hasil_jawaban = mysql_fetch_array($eks_jawaban)){
            $tb_jawaban[$hasil_jawaban['id_jawaban']] = $hasil_jawaban['bobot'];
        }
    ?>
    <div class="row">

    <form id="mySoal" role="form" style="margin-top: 10px;" method="post">
        
        <div id="result">

            <input type="hidden" name="urutan_soal" value="<?php echo $urutan_soal;?>" />
            <input type="hidden" name="id_soal" value="<?php echo $id_soal;?>" />
            <input type="hidden" name="id_kategori" value="<?php echo $id_kategori;?>" />
            
            <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black;" ><?php echo $soal[$urutan_soal]['nama_soal'];?></h2>

            <table width="100%">
                <tbody>
                    <?php 
                    $i=1;
                    foreach($konten_soal as $kode_soal=>$soal){
                    ?>

                    <tr>
                        <td width="5%"><h3 style="text-align: left; margin-top: 15px; color: black;"><?php echo $i++;?>.</h3></td>
                        <td><h3 style="text-align: left; margin-top: 15px; color: black;">
                          <?php echo $soal; ?>
                        </h3></td>
                        <td width="30%">
                            <div style="text-align: right;">
                                <?php
                                $no=0;
                                foreach($tb_jawaban as $id=>$bobot){
                                ?>
                                <input type="radio" name="jawaban[<?php echo $kode_soal;?>]" id="jawaban<?php echo $kode_soal;?>" value="<?php echo $bobot;?>" <?php echo (isset($_SESSION['total'][$kode_soal]) && $_SESSION['total'][$kode_soal]==$bobot)?'checked':'';?> required> <?php echo $no++;?>
                                <?php
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <div class="start">
                <div style="text-align: center;">
                    <?php
                    if($posisi_soal=='awal'){
                    ?>
                    <button class="next" style="padding: 10px; margin-bottom: 70px; margin-top: 50px; margin-right: 20px; background-color: #bfa145; color: black;" type="submit" href="soal.php?posisi=next">Next SOAL</button>
                    <?php
                    }else if($posisi_soal=='akhir'){
                    ?>
                    <button class="prev" style="padding: 10px; margin-bottom: 70px; margin-top: 50px; margin-right: 20px; background-color: #bfa145; color: black;" type="submit" href="soal.php?posisi=prev">Prev SOAL</button>
                    <button class="next" style="padding: 10px; margin-bottom: 70px; margin-top: 50px; margin-right: 20px; background-color: #bfa145; color: black;" href="soal_proses.php">Hasil</button>
                    <?php
                    }else{
                    ?>
                    <button class="prev" style="padding: 10px; margin-bottom: 70px; margin-top: 50px; margin-right: 20px; background-color: #bfa145; color: black;" type="button" href="soal.php?posisi=prev">Prev SOAL</button>
                    <button class="next" style="padding: 10px; margin-bottom: 70px; margin-top: 50px; margin-right: 20px; background-color: #bfa145; color: black;" type="submit" href="soal.php?posisi=next">Next SOAL</button>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </form>

    </div>


    <script>
        $(document).ready(function() {
            $('.start .next').click(function(e) { 
                e.preventDefault();

                var isi     = true;
                <?php
                foreach($konten_soal as $kode_soal=>$soal){
                ?>
                    var jawaban<?php echo $kode_soal;?> = $('#jawaban<?php echo $kode_soal;?>:checked').val();
                    if(isNaN(jawaban<?php echo $kode_soal;?>)){
                        isi = false;
                    }
                <?php
                }
                ?>

                if(isi){
                    $.ajax({
                        type: 'POST', 
                        url: $(this).attr("href"),
                        data: $("#mySoal").serialize(),
                        success: function(data)
                        {
                            incr();
                            $("#result").html(data);
                        }
                    });
                }else{
                    alert("Data Harus Lengkap");
                }

                
            });

            $('.start .prev').click(function(e) { 
                e.preventDefault();
                $.ajax({
                    type: 'POST', 
                    url: $(this).attr("href"),
                    data : {
                        urutan_soal : '<?php echo $urutan_soal;?>',
                        id_soal : '<?php echo $id_soal;?>',
                        id_kategori : '<?php echo $id_kategori;?>'
                    },
                    success: function(data)
                    {
                        decr();
                        $("#result").html(data);
                    }
                });

            });  

            $('.start .hasil').click(function(e) { 
                e.preventDefault();

                var isi     = true;
                <?php
                foreach($konten_soal as $kode_soal=>$soal){
                ?>
                    var jawaban<?php echo $kode_soal;?> = $('#jawaban<?php echo $kode_soal;?>:checked').val();
                    if(isNaN(jawaban<?php echo $kode_soal;?>)){
                        isi = false;
                    }
                <?php
                }
                ?>

                if(isi){
                    $.ajax({
                        type: 'POST', 
                        url: $(this).attr("href"),
                        data: $("#mySoal").serialize(),
                        success: function(data)
                        {
                            window.location.assign('soal_proses.php');
                        }
                    });
                }else{
                    alert("Data Harus Lengkap");
                }

                
            });
        });
    </script>
<?php
    //Jika ID Soal Sudah Habis, Arahkan Ke Results
    }else{
        echo "<meta http-equiv=refresh content=0;url=soal_proses.php>";
    }
}else{
    echo "<meta http-equiv=refresh content=0;url=index.php?hal=test_mbti>";
}
?>