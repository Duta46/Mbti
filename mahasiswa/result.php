<?php

$sql = "SELECT result.*, mahasiswa.nama, mahasiswa.nim, tipe_kepribadian.nama as tipe_kepribadian, tipe_kepribadian.deskripsi 
    FROM result INNER JOIN mahasiswa ON result.id_mahasiswa = mahasiswa.id_mahasiswa 
    INNER JOIN tipe_kepribadian ON result.`id_tipekepribadian` = tipe_kepribadian.id_tipekepribadian 
    WHERE mahasiswa.id_mahasiswa='".$hasil_mhs['id_mahasiswa']."'
    ORDER BY tgl_pengerjaan DESC LIMIT 1";

$run = mysql_query($sql);
$data = mysql_fetch_array($run);

?>
<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">

    <div class="row">

        
            <div class="col-sm-12">

                <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 70px;" >Hasil Tipe Kepribadian MBTI</h2>
            </div>
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

                <div class="next" style="float: right;">
                    <?php
                    if($data['id_result']!=""){
                    ?>
                    <a href="index.php?hal=detail&id=<?php echo $data['id_result']; ?>">
                    <button style="padding: 10px; margin-top: 20px; background-color: #bfa145; color: black;" type="button">Detail</button>
                    </a>
                    <?php
                    }
                    ?>
                </div>
                
            </div>  
            <div class="col-sm-3"></div>

            <div style="clear: both;padding-bottom: 20px;"></div>

            <?php
            //CEK RESULT SEBELUMNYA
            if($data['id_result']!=""){
                $sql_result = "SELECT result.*, tipe_kepribadian.nama as tipe_kepribadian 
                FROM result INNER JOIN mahasiswa ON result.id_mahasiswa = mahasiswa.id_mahasiswa 
                INNER JOIN tipe_kepribadian ON result.`id_tipekepribadian` = tipe_kepribadian.id_tipekepribadian 
                WHERE mahasiswa.id_mahasiswa='".$hasil_mhs['id_mahasiswa']."' AND result.id_result <> '".$data['id_result']."'
                ORDER BY tgl_pengerjaan DESC, waktu_selesai DESC";
                
                $eks_result = mysql_query($sql_result);
                if(mysql_num_rows($eks_result)>0){
            ?>
                <div class="col-sm-12">

                    <h2 style="text-align: center; border: 1px solid black; background-color: #bfa145; color: black; margin-bottom: 70px;" >Hasil Tes Sebelumnya</h2>
                </div>
                <table id="mahasiswa" class="table table-display table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th width="10%">No</th>
                      <th>Tipe Kepribadian</th>
                      <th>Tanggal</th>
                      <th>Waktu Selesai</th>
                      <th width="20%"></th>
                    </tr>
                  </thead>
                  <tbody>
            <?php
                    $no=1;
                    while($hasil_result = mysql_fetch_array($eks_result)){
            ?> 
                    <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo $hasil_result['tipe_kepribadian'];?></td>
                        <td><?php echo $hasil_result['tgl_pengerjaan'];?></td>
                        <td><?php echo $hasil_result['waktu_selesai'];?></td>
                        <td>
                        <a href="index.php?hal=detail&id=<?php echo $hasil_result['id_result']; ?>&tipe=sebelumnya">
                        <button style="padding: 10px; margin-top: 20px; background-color: #bfa145; color: black;" type="button">Detail</button>
                        </a>
                        </td>
                    </tr>
            <?php
                    }
            ?>
                  </tbody>
                </table>
            <?php
                }
            }
            ?>

    </div>  
</div>