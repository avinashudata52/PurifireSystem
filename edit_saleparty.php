<?php include('log_chk.php')?>
<!DOCTYPE html>
<html>
<head>
<?php 
  date_default_timezone_set('Asia/Calcutta');
  $dt=date('Y-m-d');
  include('common/meta.php');
?>
<script type="text/javascript">
    function ChangeCase(elem)
    {
        elem.value = elem.value.toUpperCase();
    }
	
	function chkState()
	{
		if(document.getElementById("txtmh").checked == true)
		{
			document.getElementById('txtstate').value = '1';
		}
		else if(document.getElementById("txtomh").checked == true)
		{
			document.getElementById('txtstate').value = '2';
		}		
	}
</script>

</head>
<body >
<?php
$eId=$_GET['eId'];
include('lib/function.php');
$qry="SELECT id,company_nm,mobile,adrs,email,gst_no,state,city_pin FROM party_details WHERE id='$eId'";
//echo $qry."<br>";
$st=$conn->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$id=$row['id'];
$company_nm=$row['company_nm'];
$mobile=$row['mobile'];
$adrs=$row['adrs'];
$email=$row['email'];
$state=$row['state'];
$gst_no=$row['gst_no'];
$city_pin=$row['city_pin'];
$conn=null;
?>
<div class="wrapper">
<section class="content-header">
      <!-- /.container-fluid -->
</section>
  <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Party Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="update_saleparty_details.php" method="post">
              <input type="hidden" value="<?php echo $id?>" id="eId" name="eId">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Company Name :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtconpanynm" name="txtconpanynm" placeholder="Company Name" value="<?php echo $company_nm;?>" required>
                    </div>
                    <label class="col-sm-2 col-form-label">Mobile No :</label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="txtmob" name="txtmob" placeholder="Mobile No" value="<?php echo $mobile;?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtaddress" name="txtaddress" placeholder="Address" value="<?php echo $adrs;?>" required>
                    </div>
                    <label class="col-sm-2 col-form-label">Email :</label>
                    <div class="col-sm-4">
                      <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Email" value="<?php echo $email;?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">GST / UIN No :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtgst" name="txtgst" value="<?php echo $gst_no;?>" placeholder="GST / UIN No" required>
                    </div>
                    <label class="col-sm-2 col-form-label">State :</label>
                    <div class="col-sm-4">
                    <?php
                    if($state == "1")
					{
						echo '<input type="radio"  id="txtmh" name="txtmh" onClick="chkState();" checked required> Maharashtra
                      <input type="radio"  id="txtomh" name="txtmh" onClick="chkState()" required> Out Of Maharashtra
                      ';
					}
					else
					{
						echo '<input type="radio"  id="txtmh" name="txtmh" onClick="chkState();" required> Maharashtra
                      <input type="radio"  id="txtomh" name="txtmh" onClick="chkState()" checked required> Out Of Maharashtra
                      ';
					}
					?>
                     <input type="hidden" id="txtstate" name="txtstate" value="<?php echo $state;?>"> 
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">City Pin :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtcitypin" name="txtcitypin" placeholder="City Pin" value="<?php echo $city_pin;?>" required>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="btnsub" name="btnsub">Submit</button>
                </div>
                <!-- /.card-footer -->
              </form>
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
