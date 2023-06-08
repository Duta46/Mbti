<div class="col-sm-5"></div>
<h2>Profil Mahasiswa</h2>

<?php
		$command = "SELECT mahasiswa.*, dpa.nama as dpa, th_ajaran.nama_th_ajaran, tp.nama as kepribadian
    FROM mahasiswa INNER JOIN dpa ON mahasiswa.id_dpa = dpa.id_dpa
    JOIN th_ajaran ON dpa.id_th_ajaran = th_ajaran.id_th_ajaran
    LEFT JOIN result ON result.id_mahasiswa = mahasiswa.id_mahasiswa
    LEFT JOIN tipe_kepribadian tp ON result.id_tipekepribadian = tp.id_tipekepribadian
    WHERE mahasiswa.id_mahasiswa='".$hasil_mhs['id_mahasiswa']."'
    ORDER BY tgl_pengerjaan DESC";

    $query=mysqli_query($truecont, $command);

    $row=mysqli_fetch_array($query);
?>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-2">
      <img src='../uploaded/mahasiswa/<?php echo $row['foto']?>' width='150' height='180'>
    </div>
  	<div class="col-sm-3 wowload fadeInUp" style="padding-left: 50px;">
	  	<div class="rooms">
	  		<!-- Main content -->
        <section class="content">
          <div class="row">
              <div class="box box-danger">
                  <div class="box-body">
                    <div class="row">
                      <div class="form-group">
                        <label>Nama :</label>
                          <input readonly type="text" class="form-control"  placeholder="Name" value="<?php echo $row['nama']?>">
                      </div>
                      <div class="form-group">

                          <label>Nim :</label>
                          <input readonly type="text" class="form-control"  placeholder="Nim" value="<?php echo $row['nim']?>">
                      </div>
                      <div class="form-group">

                          <label>Alamat :</label>
                          <input readonly type="text" class="form-control"  placeholder="Alamat" value="<?php echo $row['alamat']?>">
                      </div>

                      <div class="form-group">
                        <label>Program Studi :</label>
                          <input readonly type="text" class="form-control"  placeholder="Program Studi" value="<?php echo $row['program_studi']?>">
                      </div>

                      <div class="form-group">
                        <label>Indeks Prestasi :</label>
                          <input readonly type="text" class="form-control"  placeholder="Indeks Prestasi" value="<?php echo $row['indeks_prestasi']?>">
                      </div>
                    </div>
                    <!-- /.row -->
                  </div>
              </div>
              <!-- /.panel -->
          </div>
        </section>

	  	</div>
  	</div>
    <div class="col-sm-1 wowload fadeInUp"></div>
    <div class="col-sm-3 wowload fadeInUp">
	  	<div class="rooms">
	  		<!-- Main content -->
        <section class="content">
          <div class="row">
              <div class="box box-danger">
                  <div class="box-body">
                    <div class="row">
                      <div class="form-group">
                      	<label>Nama DPA :</label>
                          <input readonly type="text" class="form-control"  placeholder="Nama DPA" value="<?php echo $row['dpa']?>">
                      </div>

                      <div class="form-group">
                      	<label>Tahun Ajaran :</label>
                          <input readonly type="text" class="form-control"  placeholder="Tahun Ajaran" value="<?php echo $row['nama_th_ajaran']?>">
                      </div>

                      <div class="form-group">
                      	<label>Email :</label>
                          <input readonly type="text" class="form-control"  placeholder="Email" value="<?php echo $row['email']?>">
                      </div>
                      <div class="form-group">
                      	<label>Tipe Kepribadian :</label>
                          <input readonly type="text" class="form-control"  placeholder="Tipe Kepribadian" value="<?php echo $row['kepribadian']?>">
                      </div>
                    </div>
                    <!-- /.row -->
                  </div>
              </div>
              <!-- /.panel -->
          </div>
        </section>

	  	</div>
  	</div>
</div>