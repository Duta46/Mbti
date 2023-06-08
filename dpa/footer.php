



<footer class="spacer">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <h4><?php echo title;?></h4>
                    <p><?php echo keterangan;?></p>
                    <p><?php echo author;?></p>
                </div>              
                 
                 
                 
            <!--/.row--> 
        </div>
        <!--/.container-->    
    
    <!--/.footer-bottom--> 
</footer>







<script src="../assets/wow/wow.min.js"></script>
<script src="../assets/uniform/js/jquery.uniform.js"></script>
<script src="../assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>
<script src="../assets/mobile/touchSwipe.min.js"></script>
<script src="../assets/respond/respond.js"></script>
<script src="../assets/gallery/jquery.blueimp-gallery.min.js"></script>
<script src="../assets/script.js"></script>

<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $("").DataTable();
    $('#mahasiswa').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
    $('#kepribadian').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "align":"left"
    });
  });
</script>