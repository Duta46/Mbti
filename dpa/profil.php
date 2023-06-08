<div class="col-sm-5"></div>
<h2>Profil DPA</h2>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-2">
      <img src='../uploaded/dpa/<?php echo $hasil_dpa['foto']?>' width='150' height='180'>
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
                          <label>Nama</label>
                          <input class="form-control" name="nama" id="nama" value="<?php echo $hasil_dpa['nama']?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>NIP</label>
                          <input class="form-control" name="nip" id="nip" value="<?php echo $hasil_dpa['nip']?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <input class="form-control" name="email" id="email" value="<?php echo $hasil_dpa['email']?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Nomor Telepon/HP</label>
                          <input class="form-control" name="no_hp" id="no_hp" value="<?php echo $hasil_dpa['no_hp']?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Tahun Ajaran</label>
                          <input class="form-control" name="nama_th_ajaran" id="nama_th_ajaran" value="<?php echo $hasil_dpa['nama_th_ajaran']?>" readonly>
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
</div>