<?php
session_start();
if(isset($_SESSION['account_myers_briggs']) && ($_SESSION['account_myers_briggs']['divisi']=='Administrator')){

require_once '../inc/koneksi.php';
require_once '../inc/fungsi_indotgl.php';
require_once '../inc/fungsi.php';
require_once '../inc/classPaging.php';

@$hal = $_GET['hal'];
?>
<!DOCTYPE HTML>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include 'header.php';?>

  
    
</head><!--/head-->

<body>


<!-- START CONTENT -->
    <div class="container">

        <div class="container-widget">

            <!-- Start Files -->
            <div class="col-md-12 col-lg-12">
                <div class="panel">
                    <div class="nav-collapse">
                    <!-- START SIDEBAR -->
                    <ul class="nav navbar-nav">
                      <li><a href="index.php" <?php echo (empty($hal))?'class="active"':'';?>><span class="icon color2"><i class="fa fa-home"></i></span> Beranda<span class="label label-default"></span></a></li>
                      
                      <li><a href="index.php?hal=ta" <?php echo (substr($hal, 0, 2)=='ta')?'class="active"':'';?>><span class="icon color6"><i class="fa fa-list"></i></span> Tahun Ajaran</a></li>
                      <li><a href="index.php?hal=dpa" <?php echo (substr($hal, 0, 3)=='dpa')?'class="active"':'';?>><span class="icon color6"><i class="fa fa-list"></i></span> DPA</a></li>
                      <li><a href="index.php?hal=mahasiswa" <?php echo (substr($hal, 0, 9)=='mahasiswa')?'class="active"':'';?>><span class="icon color6"><i class="fa fa-user"></i></span> Mahasiswa</a></li>

                      <li><a href="index.php?hal=kategori" <?php echo (substr($hal, 0, 8)=='kategori')?'class="active"':'';?>><span class="icon color6"><i class="fa fa-list"></i></span> Kategori</a></li>
                      <li><a href="index.php?hal=soal" <?php echo (substr($hal, 0, 4)=='soal')?'class="active"':'';?>><span class="icon color6"><i class="fa fa-list"></i></span> Soal</a></li>
                      <li><a href="index.php?hal=jawaban" <?php echo (substr($hal, 0, 7)=='jawaban')?'class="active"':'';?>><span class="icon color6"><i class="fa fa-list"></i></span> Jawaban</a></li>

                      <li><a href="index.php?hal=kepribadian" <?php echo (substr($hal, 0, 11)=='kepribadian')?'class="active"':'';?>><span class="icon color6"><i class="fa fa-list"></i></span> Kepribadian</a></li>
                      
       
                      <li><a href="index.php?hal=ubah_profil" <?php echo (substr($hal, 0, 11)=='ubah_profil')?'class="active"':'';?>><span class="icon color6"><i class="fa fa-wrench"></i></span> Ubah Profil</a></li>
                      <li><a href="javascript:void(0)" data-href="../logout.php" data-toggle="modal" data-target="#confirm-logout"><span class="icon color6"><i class="fa fa-power-off"></i></span> Logout</a></li>
                    </ul>
                    <!-- END SIDEBAR -->
                    </div>
                    
                    <div style="clear: both;"></div>
              </div>
                
            </div>
            <!-- End Files -->
            
            <div class="col-md-12 col-lg-12">
              <div class="panel panel-widget" style="min-height:285px">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                        <?php
                        $default    = "beranda.php";
                        if(!$hal){
                            require_once "$default";
                        }else{
                            switch($hal){
                                case $hal:
                                    if(is_file($hal.".php"))
                                    {
                                      require_once $hal.".php";
                                    }
                                    else
                                    {
                                      require_once "$default";
                                    }
                                    break;
                                default:
                                    require_once "$default";
                            }
                        }
                        ?>
                        </div>
                    </div>


                </div>

              </div>
            </div>
            <!-- End Panel -->
            
            


        </div>
    </div>
    <!-- End Content -->


<?php include 'footer.php';?>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Hapus Data <span class="debug-data"></span></h4>
            </div>
        
            <div class="modal-body">
                <p>Apakah ingin melanjutkan ?</p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-mail-reply'></i> Batal</button>
                <a class="btn btn-danger btn-ok"><i class='fa fa-trash'></i> Hapus</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Logout</h4>
            </div>
        
            <div class="modal-body">
                <p>Apakah ingin keluar sistem ?</p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-mail-reply'></i> Batal</button>
                <a class="btn btn-danger btn-ok"><i class='fa fa-power-off'></i> Logout</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        
        $('.debug-url').html('Hapus URL : <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        $('.debug-data').html('<strong>' + $(e.relatedTarget).data('title') + '</strong>');
    });
    $('#confirm-logout').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
            
</body>
</html>
<?php
}else{
    echo "<script>window.location='../login.php';</script>";
}
?>