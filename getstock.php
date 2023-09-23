<?php include('log_chk.php')?>
<!DOCTYPE html>
<html>
<head>
<?php 
  date_default_timezone_set('Asia/Calcutta');
  $dt=date('Y-m-d');
  include('common/meta.php');
?>
 
</head>
<body >

<div class="wrapper">
<section class="content-header">
      <!-- /.container-fluid -->
</section>
  <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><b>Purchase Details</b></h3>
              </div>
                <div class="card-body">
                    
                   <table width="100%" border="1" cellpadding="5">
                   		<tr style="background-color:#5377e0">
                        	<th style="text-align:center">No</th>
                            <th style="text-align:center">Date</th>
                            <th style="text-align:center">Company Name</th>
                            <th style="text-align:center">Bill No</th>
                            <th style="text-align:center">Rate</th>
                            <th style="text-align:center">Qty</th>
                        </tr>
                        <tbody>
							<?php
                            $vId=$_GET['sId'];
                            include('lib/function.php');
                            $qq="SELECT a.bill_no,a.date,b.qty,b.rate,c.company_nm FROM `purchase_entry` AS a
								LEFT JOIN `puchase_entry_info` AS b ON a.id=b.lastId
								LEFT JOIN `purchase_party_details` AS c ON a.party_id=c.id
								WHERE b.item_nm='$vId'";
							$ss=$conn->prepare($qq);
							$ss->execute();
							$cnt=1;
							$tot=0;
							$amt=0;
							while($rw=$ss->fetch(PDO::FETCH_ASSOC))
							{
								echo '<tr>';
								echo '<td align="center">'.$cnt.'</td>';
								echo '<td align="center">'.date('d-m-Y',strtotime($rw['date'])).'</td>';
								echo '<td align="center">'.$rw['company_nm'].'</td>';
								echo '<td align="center">'.$rw['bill_no'].'</td>';
								echo '<td align="center">'.$rw['rate'].'</td>';
								echo '<td align="center">'.$rw['qty'].'</td>';
								echo '</tr>';
								$cnt++;
								$amt=$amt+$rw['rate'];
								$tot=$tot+$rw['qty'];
							}
							$conn=null;
							?>
                        </tbody>
                        <tfoot>
                           <th style="text-align:right;color:#f00" colspan="4">Total</th>
                           <th style="color:#f00;text-align:center"><?php echo $amt;?></th>
                            <th style="color:#f00;text-align:center"><?php echo $tot;?></th>
                        </tfoot>
                   </table>  
                   
                   
                 
                </div>
             
              
            </div>
        <!-- /.card -->

		

      </div>
      <!-- /.container-fluid -->
      
      
      
	</section>
  

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
<script src="selectjs/chosen.jquery.js" type="text/javascript"></script>
<script src="selectjs/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var config = {
'.chosen-select'           : {},
'.chosen-select-deselect'  : {allow_single_deselect:true},
'.chosen-select-no-single' : {disable_search_threshold:10},
'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
'.chosen-select-width'     : {width:"95%"}
}
for (var selector in config) {
$(selector).chosen(config[selector]);
}
</script>
</body>
</html>
