<?php include('log_chk.php')?>
<!DOCTYPE html>
<html>
<head>
<?php 
  date_default_timezone_set('Asia/Calcutta');
  $dt=date('Y-m-d');
  include('common/meta.php');
?>
<script>
function getsale(id)
 {
 window.open("stock_details.php?sId="+id, "_blank" ,"toolbar=yes, scrollbars=yes, resizable=no, top=20, left=10, width=900, height=650");
 }
 function getstock(id)
 {
	 window.open("getstock.php?sId="+id, "_blank" ,"toolbar=yes, scrollbars=yes, resizable=no, top=20, left=10, width=900, height=650");
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
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('common/sidemenu.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          
          <!-- /.card -->

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Stock Master</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th style="text-align:center">No</th>
                  <th>Item Name</th>
                  <th style="text-align:center">Purchase Qty</th>
                  <th style="text-align:center">Sale Qty</th>
                  <th style="text-align:center">Bal Qty</th>
                </tr>
                </thead>
                <tbody>
                <?php
				include('lib/function.php');
				$qry="SELECT a.*,b.itemnm,b.hsn FROM stock_maintain AS a
					  LEFT JOIN `item_master` AS b ON a.itemId=b.id";
				$st=$conn->prepare($qry);
				$st->execute();
				$cnt=1;
				$stock=0;
				$sale=0;
				$bal=0;
				while($row=$st->fetch(PDO::FETCH_ASSOC))
				{
					$id=$row['id'];
					echo '<tr>';
					echo '<td align="center">'.$cnt.'</td>';
					echo '<td>'.$row['itemnm'].'</td>';
					echo '<td align="center"><a href="javascript:getstock('.$row['itemId'].')"><b style="color:#3a8909">'.$row['bal'].'</b></a></td>';
					echo '<td align="center"><a href="javascript:getsale('.$row['itemId'].')"><b style="color:#f00">'.$saltot=$row['bal']-$row['qty'].'</b></a></td>';
					echo '<td align="center"><b style="color:#1f52e1">'.$row['qty'].'</b></td>';
					echo '</tr>';
					$cnt++;
					
				$stock=$stock+$row['bal'];
				$sale=$sale+$saltot;
				$bal=$bal+$row['qty'];
				}
				$conn=null;
				?>
                </tbody>
               <tfoot>
               <th colspan="1"></th>
               <th style="text-align:right">Total</th>
               <th style="text-align:center;color:#f00"><?php echo $stock;?></th>
               <th style="text-align:center;color:#f00"><?php echo $sale;?></th>
               <th style="text-align:center;color:#f00"><?php echo $bal;?></th>
               </tfoot>
              </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
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
</body>
</html>
