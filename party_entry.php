<?php include('log_chk.php')?>
<!DOCTYPE html>
<html>
<head>
  <?php include('common/meta.php');?>
  
 <script>
function edit(id)
 {
 window.open("edit_saleparty.php?eId="+id, "_blank" ,"toolbar=yes, scrollbars=yes, resizable=no, top=20, left=10, width=900, height=650");
 }
 
 function del(id)
 {

	
	var r = confirm("Do you want to Delete this Record....?");
	if (r == true) {
	var scriptUrl ='del_saleparty.php?id='+id;
	//alert(scriptUrl);
	$.ajax({url:scriptUrl,success:function(result)
	{	
	alert('Record Deleted Successfully...');
	window.location.href='party_entry.php';
	}});
	
	} 
	else {
	txt = "You Pressed Cancel!";
	}

}
</script>
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
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('common/sidemenu.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Party Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="party_ins.php" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Company Name :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtconpanynm" name="txtconpanynm" placeholder="Company Name" onBlur="ChangeCase(this)" required>
                    </div>
                    <label class="col-sm-2 col-form-label">Mobile No :</label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="txtmob" name="txtmob" placeholder="Mobile No" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtaddress" name="txtaddress" placeholder="Address" onBlur="ChangeCase(this)" required>
                    </div>
                    <label class="col-sm-2 col-form-label">Email :</label>
                    <div class="col-sm-4">
                      <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Email" required>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">GST / UIN No :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtgst" name="txtgst" placeholder="GST / UIN No" required>
                    </div>
                    <label class="col-sm-2 col-form-label">State :</label>
                    <div class="col-sm-4">
                      
                      <input type="radio"  id="txtmh" name="txtmh" onClick="chkState();" required> Maharashtra
                      <input type="radio"  id="txtomh" name="txtmh" onClick="chkState()" required> Out Of Maharashtra
                      <input type="hidden" id="txtstate" name="txtstate" value="0">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">City Pin :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="txtcitypin" name="txtcitypin" placeholder="City Pin" required>
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
      
      <div class="row">
        <div class="container-fluid ">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Party Master</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
              	<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>	
                  <th>Company</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>GST No</th>
                  <th>State</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php 
				include('lib/function.php');
				$qry="SELECT id,company_nm,mobile,adrs,email,gst_no,state,city_pin FROM party_details WHERE sts='0' ORDER BY id DESC";
				$st=$conn->prepare($qry);
				$st->execute();
				$cnt=1;
				while($row=$st->fetch(PDO::FETCH_ASSOC))
				{
					
					$id=$row['id'];
					echo '<tr>';
					echo '<td>'.$cnt.'</td>';
					echo '<td>'.$row['company_nm'].'</td>';
					echo '<td>'.$row['mobile'].'</td>';
					echo '<td>'.$row['adrs'].'</td>';
					echo '<td>'.$row['email'].'</td>';
					echo '<td>'.$row['gst_no'].'</td>';
					if($row['state'] == "1")
					{
						$state="Maharashtra";
					}
					else
					{
						$state="Out of Maharashtra";
					}
					echo '<td>'.$state.'-'.$row['city_pin'].'</td>';
					echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit" style="color:#007bff"></i></a></td>';
					echo '<td align="center"><a href="javascript:del('.$id.')"><i class="fa fa-trash" style="color:#f00"></i></a></td>';
					echo '</tr>';
					$cnt++;
				}
				$conn=null;
				?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>	
                  <th>Company</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>GST/UIN No</th>
                  <th>State</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      
    </section>
    <!--List Table-->
    
   
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('common/footer.php')?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
</body>
</html>
