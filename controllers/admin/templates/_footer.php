
    <!-- Mainly scripts -->
    <!--<script src="<?php //echo getConfig('siteUrl') . '/js/jquery-3.1.1.min.js' ?>"></script>-->
    <script src="<?php echo getConfig('siteUrl') . '/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo getConfig('siteUrl') . '/js/plugins/metisMenu/jquery.metisMenu.js' ?>"></script>
    <script src="<?php echo getConfig('siteUrl') . '/js/plugins/slimscroll/jquery.slimscroll.min.js' ?>"></script>
    <script src="<?php echo getConfig('siteUrl') . '/js/plugins/dataTables/datatables.min.js' ?>"></script>
    
     <!--Custom and plugin javascript--> 
    <script src="<?php echo getConfig('siteUrl') . '/js/inspinia.js' ?>"></script>
    <script src="<?php echo getConfig('siteUrl') . '/js/plugins/pace/pace.min.js' ?>"></script>
    <script src="<?php echo getConfig('siteUrl') . '/js/common.js' ?>"></script>
     <!--daterangepicker--> 
    <script src="<?php echo getConfig('siteUrl') .'/js/plugins/switchery/switchery.min.js'; ?>"></script>
    <script src="<?php echo getConfig('siteUrl') .'/js/plugins/moment/moment.min.js'; ?>"></script>
    <script src="<?php echo getConfig('siteUrl') .'/js/plugins/datepicker/daterangepicker.js'; ?>"></script>
   
     <!--Page-Level Scripts--> 
    <script type="text/javascript">
    $(document).ready(function() {
      $('#single_cal4').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#changeDate').val( $( "#single_cal4" ).val());
        $('#form-change-date').submit();
      });
      
      $('#single_cal3').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#changeDate').val( $( "#single_cal3" ).val());
        $('#form-change-date').submit();
      });
   
    $('#single_cal2').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#changeDate').val( $( "#single_cal2" ).val());
        $('#form-change-date').submit();
      });
      $('#single_cal1').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#changeDate').val( $( "#single_cal1" ).val());
        $('#form-change-date').submit();
       
      });
    });
  </script>
   <!--/datepicker--> 
<script>
    $(document).ready(function(){

        $('.summernote').summernote();
        var elem_3 = document.querySelector('.js-switch');
        var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

    });    
</script>         
