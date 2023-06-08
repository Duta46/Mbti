<?php
//Kosongkan Sessi
unset($_SESSION['total']);
unset($_SESSION['waktu_selesai']);
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
$_SESSION['waktu_selesai'] = date("H:i:s");
?>
<script type="text/javascript">
    var Example1 = new (function() {
        var $waktu_selesai, // Stopwatch element on the page
            incrementTime = 10, // Timer speed in milliseconds
            currentTime = 0, // Current time in hundredths of a second
            updateTimer = function() {
                $waktu_selesai.html(formatTime(currentTime));
                currentTime += incrementTime / 10;
            },
            init = function() {
                $waktu_selesai = $('#waktu_selesai');
                Example1.Timer = $.timer(updateTimer, incrementTime, false);
            };
        this.resetStopwatch = function() {
            currentTime = 0;
            this.Timer.stop().once();
        };
        $(init);
    });

    // Common functions
    function pad(number, length) {
        var str = '' + number;
        while (str.length < length) {str = '0' + str;}
        return str;
    }
    function formatTime(time) {
        var min = parseInt(time / 6000),
            sec = parseInt(time / 100) - (min * 60),
            hundredths = pad(time - (sec * 100) - (min * 6000), 2);
        return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2) + ":" + hundredths;
    }
</script>

<div class="row">

    <form role="form" style="margin-top: 0px;">
        
        <div class="col-sm-2">
            <h3 style="font-size: 40px"><b><span id="waktu_selesai">00:00:00</span></b></h3>
        </div>
        <div class="col-sm-10">
            <h3 style="text-align: center; margin-top: 0px;">Petunjuk Pengerjaan Soal</h3>
            <h5 style="text-align: center; margin-top: 0px;">
            <?php
            $sql_jawaban = "SELECT * FROM jawaban ORDER BY bobot, nama_jawaban";
            $eks_jawaban = mysql_query($sql_jawaban);
            $no=0;
            while($hasil_jawaban = mysql_fetch_array($eks_jawaban)){
                echo $no.' - '.$hasil_jawaban['nama_jawaban'].'&nbsp; &nbsp; &nbsp; &nbsp;';
                $no++;
            }
            ?>
            </h5>
        </div>
        <div class="col-sm-12">

        <div class="" style="margin-top: 30px;">
        <div class="">
            <progress value="0" max="100" id="progress" style="width: 100%;"></progress>
        </div>
        </div>

        <div id="result">
            <div class="start">
                <div style="text-align: center;">
                    <button style="padding: 10px; margin-bottom: 70px; margin-top: 20px; margin-right: 20px; background-color: #bfa145; color: black;" href="soal.php">Mulai TEST</button>
                </div>
            </div>
          
        </div>
        </div>
    </form>

</div>

<script language="JAVASCRIPT">
  $(function(){
    $(".start button").click(function() {
      url = $(this).attr("href");
      $("#result").load(url);
      Example1.Timer.play();
      return false;
    });

    $(document).ajaxComplete(function(){
      $("#loading").hide();
      $("#result").css({"opacity":"1"});
    });
  });
</script>

<?php
//HITUNG JUMLAH SOAL
$jmlSoal    = 0;
$sql_soal   = "SELECT * FROM soal";
$eks_soal   = mysql_query($sql_soal);
while($hasil_soal = mysql_fetch_array($eks_soal)){
    //JUMLAH KONTEN SOAL
    $sql_konten = "SELECT id_kategori FROM konten_soal 
                WHERE id_soal='".$hasil_soal['id_soal']."'
                GROUP BY id_kategori ORDER BY id_kategori";
    $eks_konten = mysql_query($sql_konten);
    while($hasil_konten = mysql_fetch_array($eks_konten)){
        $jmlSoal += 1;
    }
}

if($jmlSoal>0){
    $persen = 100/$jmlSoal;
}else{
    $persen = 100;
}

?>

<script language=JavaScript> 
    
    function incr() { 

        var progress = document.getElementById('progress').value;
        document.getElementById("progress").value= progress + <?php echo $persen;?>;
    }

    function decr() { 

        var progress = document.getElementById('progress').value;
        document.getElementById("progress").value= progress - <?php echo $persen;?>;
    }

</script> 
</body>
</html>