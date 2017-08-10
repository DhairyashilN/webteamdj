<!-- jQuery 2.0.2 -->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- CK Editor -->
<script src="<?php echo base_url();?>assets/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
        CKEDITOR.replace('product_desc');
    });
</script>
</body>
</html>