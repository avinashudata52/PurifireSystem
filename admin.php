<?php include('log_chk.php')?>
<!DOCTYPE html>
<html>
<head>
  <?php include('common/meta.php')?>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onLoad="showGraph1();showGraph();">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('common/sidemenu.php')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                <?php 
				include('lib/function.php');
				$q="SELECT SUM(qty) AS total FROM puchase_entry_info";
				//echo $q."<br>";
				$s=$conn->prepare($q);
				$s->execute();
				while($r=$s->fetch(PDO::FETCH_ASSOC))
				{
					echo $total=$r['total'];	
				}
				$conn=null;
				?>
                </h3>

                <p>Purchase Qty</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-line"></i>
              </div>
              <a href="stock_master.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                <?php 
				include('lib/function.php');
				$q="SELECT SUM(qty) AS total FROM sale_entry_info";
				//echo $q."<br>";
				$s=$conn->prepare($q);
				$s->execute();
				while($r=$s->fetch(PDO::FETCH_ASSOC))
				{
					echo $total=$r['total'];	
				}
				$conn=null;
				?>
                </h3>

                <p>Sale Qty</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="stock_master.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php 
				include('lib/function.php');
				$q="SELECT COUNT(id) AS total FROM purchase_party_details WHERE sts='0'";
				//echo $q."<br>";
				$s=$conn->prepare($q);
				$s->execute();
				while($r=$s->fetch(PDO::FETCH_ASSOC))
				{
					echo $total=$r['total'];	
				}
				$conn=null;
				?></h3>

                <p>Total Purchase Party</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="purchase_customer_master.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                <?php 
				include('lib/function.php');
				$q="SELECT COUNT(id) AS total FROM party_details WHERE sts='0'";
				//echo $q."<br>";
				$s=$conn->prepare($q);
				$s->execute();
				while($r=$s->fetch(PDO::FETCH_ASSOC))
				{
					echo $total=$r['total'];	
				}
				$conn=null;
				?>
                </h3>

                <p>Total Sale Party</p>
              </div>
              <div class="icon">
                <i class="fas fa-users nav-icon"></i>
              </div>
              <a href="party_entry.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Purchase Stock</h3>

                
              </div>
              <div class="card-body">
                  <div class="chart-area">
                    <script type="text/javascript" src="dist/canvasjs.js"></script>
					<div id="chartContainer" style="height: 350px; width: auto;padding:10px;"></div>
                  </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
<script>
$(document).ready(function () {
            showGraph();
			
        });

 function showGraph()
        {		{
                //alert('hi');
				var v='-1';
				var v1='0';
				
				var scriptUrl="purchase_chart.php?item_code="+v+'&suppliercode='+v1;
				//alert(scriptUrl);				
				$.post(scriptUrl,
                function (data2)
                {
					var chart = new CanvasJS.Chart("chartContainer", {
		
						
					  title:{
						//text: "RM PRICE",
						
					  },
					  data: [//array of dataSeries
						{ //dataSeries object
				
						 /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/
						 
						 type: "line",
						 dataPoints:data2
						 
					   }]
					   });
				chart.render();				

                });
            }
        }
</script>
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Sale Stock</h3>

              </div>
              <div class="card-body">
                  <div class="chart-area">
                    <script type="text/javascript" src="dist/canvasjs.js"></script>
					<div id="chartContainer1" style="height: 350px; width: auto;padding:10px;"></div>
                  </div>
                  
                  <script>

$(document).ready(function () {
            showGraph1();
			showGraph();
			
        });

 function showGraph1()
        {		{
                //alert('hi');
				var v='-1';
				var v1='0';
				
				var scriptUrl="sale_chart.php?item_code="+v+'&suppliercode='+v1;
				//alert(scriptUrl);				
				$.post(scriptUrl,
                function (data2)
                {
					var chart = new CanvasJS.Chart("chartContainer1", {
		
						
					  title:{
						//text: "COST PER KG",
						
					  },
					  data: [//array of dataSeries
						{ //dataSeries object
				
						 /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/
						 
						 type: "line",	
						 					 
						 dataPoints:data2 
					   }]
					   });
				chart.render();				

                });
            }
        }
</script>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    
    
    
    
    
    
    
    
    
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
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
