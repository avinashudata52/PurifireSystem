<?php
date_default_timezone_set('Asia/Calcutta');
$dt=date('Y-m-d');
//echo $dt;
include('log_check.php');?>
<!DOCTYPE html>
<html>
<head>
  <?php include('common/meta.php');?>
  <link rel="stylesheet" href="selectcss/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop 
	{ left: -9000px;
	
	}
  </style>
  <script>
	function getaddmode()
		{
			if(document.getElementById('fe').checked==true)
				{
					document.getElementById('type_no').value=1;
					
					document.getElementById('first').style.visibility="visible";
					document.getElementById('first').style.overflow="visible";
					document.getElementById('first').style.height="auto";
					
					document.getElementById('second').style.visibility="hidden";
					document.getElementById('second').style.overflow="visible";
					document.getElementById('second').style.height="0px";
					
					//document.getElementById('type_no').value=1;
				}
				else if(document.getElementById('dse').checked==true)
				{
					document.getElementById('type_no').value=2;
					
					document.getElementById('first').style.visibility="hidden";
					document.getElementById('first').style.overflow="hidden";
					document.getElementById('first').style.height="0px";
					
					
					document.getElementById('second').style.visibility="visible";
					document.getElementById('second').style.overflow="visible";
					document.getElementById('second').style.height="auto";
					
					
					
				}
				else
				{
					document.getElementById('type_no').value=0;
					document.getElementById('first').style.visibility="hidden";
					document.getElementById('first').style.overflow="hidden";
					document.getElementById('first').style.height="0px";
					
					document.getElementById('first').style.visibility="hidden";
					document.getElementById('first').style.overflow="hidden";
					document.getElementById('first').style.height="0px";
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
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include('common/sidemenu.php')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           <!-- <h1>Staff Entry</h1>-->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Addmission Entry</li>
            </ol>
          </div>
        </div>
      </div>
    </section>



 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Select Student Data Your Want to Insert</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
					<div class="form-group">
						<input type="radio" name="fe" id="fe" value='1'  onclick="getaddmode()" checked='true'/>&nbsp;&nbsp; FE Result
						<input type="radio" name="fe" id="dse" value='2' onclick="getaddmode()"  />&nbsp;&nbsp;DSE Result
					</div>
                </div> 
                <!-- /.card-body -->
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>





    <!-- Main content -->
<div class="row" id="first" style="visibility:hidden;overflow:hidden;height:0px;">

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">First Addmission Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="fe_admission_ins.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="row">
				<div class="col-md-6">
					  <div class="form-group">
						<label for="exampleInputEmail1">Addmission Mode:</label>
						<select class="chosen-select form-control" name="txtfeadmission" id="txtfeadmission">
						<option value="0">Select...</option>
						<option value="1">FE Regular</option>
						<option value="2">FE Regular TFWS</option>

						</select>
					  </div>
					  
				</div>
					<div class="row">
					<div class="form-group">
					<div class="col-md-2">
					<input type="hidden" id="type_no" name="type_no" value="0">
					</div>
					</div>
					</div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dept :</label>
                    <select class="chosen-select form-control" name="txtdept" id="txtdept">
                    <option value="0">Select...</option>
                    <option value="1">CSE</option>
                    <option value="2">MECH</option>
                    <option value="3">CIVIL</option>
                    <option value="4">E&TC </option>
                    <option value="5">Electrical</option>
                    </select>
                  </div>
                  </div>
                  
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">File :</label>
                    <input type="file" name="file" id="file" class="form-control" style="height:42px;"/ >
                    <a href="Sample/FE sample format.csv"><label style="color:#f00; margin-top:10px;">Sample CSV File Download</label></a>
                  </div>
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="btnreg" name="btnreg">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 </div>    
<div class="row" id="second" style="visibility:hidden;overflow:hidden;height:0px;">  
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">DSE Addmission Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="demo_ins.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                
                
                <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
						<label for="exampleInputEmail1">Addmission Mode:</label>
						<select class="chosen-select form-control" name="txtdseadmission" id="txtdseadmission">
						<option value="0">Select...</option>
						<option value="1">FE Regular Lateral</option>
						<option value="2">DSE Division</option>
						<option value="3">DSE Division TFWS</option>
						</select>
					  </div>
                  </div>
                  
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dept :</label>
                    <select class="chosen-select form-control" name="txtdept" id="txtdept">
                    <option value="0">Select...</option>
                    <option value="1">CSE</option>
                    <option value="2">MECH</option>
                    <option value="3">CIVIL</option>
                    <option value="4">E&TC </option>
                    <option value="5">Electrical</option>
                    </select>
                  </div>
                  </div>
                  
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">File :</label>
                    <input type="file" name="file" id="file" class="form-control" style="height:42px;"/>
                    <a href="#"><label style="color:#f00">Sample CSV File Download</label></a>
                  </div>
                  </div>
                
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="btnreg" name="btnreg">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>



    <!-- /.content -->
  </div>
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
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
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
