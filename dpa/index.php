<?php
session_start();
if(isset($_SESSION['account_myers_briggs']) && ($_SESSION['account_myers_briggs']['divisi']=='DPA')){

require_once '../inc/koneksi.php';
require_once '../inc/fungsi_indotgl.php';
require_once '../inc/fungsi.php';
require_once '../inc/classPaging.php';

@$hal = $_GET['hal'];

$sql_dpa = "SELECT * FROM th_ajaran ta 
        JOIN dpa ON ta.id_th_ajaran=dpa.id_th_ajaran
        JOIN account a ON dpa.id_dpa=a.id_dpa 
        WHERE username='".$_SESSION['account_myers_briggs']['username']."' AND divisi='DPA'";
$eks_dpa	= mysql_query($sql_dpa);
$hasil_dpa	= mysql_fetch_array($eks_dpa);
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
<?php
$default    = "beranda.php";
if(!$hal){
    require_once "$default";
}else{
?>

<!-- START CONTENT -->
    <div class="container">

        <div class="container-widget">
            
            <div class="col-md-12 col-lg-12">
              <div class="panel panel-widget" style="min-height:285px">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                        <?php
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
<?php
}
?>

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
	echo "<meta http-equiv='Refresh' content='0; url=../login.php'>";
}
?>