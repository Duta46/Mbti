<style type="text/css">
    th {
        text-align: center;
    }

    tr {
        height: 50px;
        text-align: center;
    }

    table, th, td {
        border: 1px solid black;
    }

    thead {
        background-color: grey;
        color: white;
        text-align: center;
    }



input[type="radio"]:checked {
    content: "\2022";
    color: red;
}

.jawaban{
    text-indent: 20px;
}
</style>
<!-- reservation-information -->

<div class="row">
    <div class="col-sm-1 wowload fadeInUp"></div>
    <div class="col-sm-10 wowload fadeInUp">
      <section class="content"></br></br></br>
        <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black;" >Rule Pengerjaan Test MBTI</h2>
        <h4 style="text-align: left; margin-top: 70px; color: black;">1.  Penilaian hasil tipe kepribadian dihitung dengan bobot penilaian masing-masing soal adalah sebagai berikut :</h4>
        <h5 style="text-align: left; margin-top: 25px; color: red;">
        <?php
        $sql_jawaban = "SELECT * FROM jawaban ORDER BY bobot, nama_jawaban";
        $eks_jawaban = mysql_query($sql_jawaban);
        $no=0;
        while($hasil_jawaban = mysql_fetch_array($eks_jawaban)){
            echo "<div class='jawaban'>".$no.' - '.$hasil_jawaban['nama_jawaban'].'</div>';
            $no++;
        }
        ?>
        </h5>
        <h4 style="text-align: left; margin-top: 25px;  color: black;">2.  Hasil Test MBTI merupakan cerminan dari kepribadian anda</h4>
        <h4 style="text-align: left; margin-top: 25px;  color: black;">3. Jawablah setiap item pertanyaan dengan jujur sesuai dengan diri anda masing-masing</h4>
        <h4 style="text-align: left; margin-top: 25px;  color: black;">4.  Setiap item pertanyaan wajib dijawab, sekalipun anda tidak menyukainya</h4>
        <h4 style="text-align: left; margin-top: 25px;  color: black;">5.  Estimasi waktu pengerjaan adalah tidak lebih dari 30 menit</h4>
        <h4 style="text-align: left; margin-top: 25px;  color: black;">6.  Apabila telah selesai mengerjakan soal dan ingin beralih ke soal berikutnya, maka memilih pilihan "Next Soal"</h4>
        <h4 style="text-align: left; margin-top: 25px;  color: black;">7.  Tombol "Previous Soal" digunakan apabila anda ingin melihat jawaban sebelumnya</h4>
        <h4 style="text-align: left; margin-top: 25px;  color: black;">8. Tombol "Next Soal" hanya dapat dipilih apabila semua item pertanyaan telah dijawab seluruhnya</h4>
        <h4 style="text-align: left; margin-top: 25px; margin-bottom: 90px;  color: black;">9. Keseluruhan item pertanyaan berjumlah 80 butir yaitu masing masing 10 item pertanyaan di setiap halaman</h4>
        
      </section>
    </div>
</div>
