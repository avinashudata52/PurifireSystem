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
function pdetails(id)
 {
 window.open("sale_details.php?vId="+id, "_blank" ,"toolbar=yes, scrollbars=yes, resizable=no, top=20, left=10, width=900, height=650");
 }
 function pprint(id)
 {
	window.open("mpdf/taxInvoice/saletax_invoice.php?Id="+id, "_blank"); 
 }
 function payment(id)
 {
	window.open("sale_payment_entry.php?pId="+id, "_blank" ,"toolbar=yes, scrollbars=yes, resizable=no, top=20, left=10, width=1200, height=650");
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
              <h3 class="card-title">Sale Master</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Date</th>
                  <th>Bill No</th>
                  <th>Party Name</th>
                  <th>Total</th>
                  <th>Paid Amt</th>
                  <th>Remaining Amt</th>
                  <th style="text-align:center">View</th>
                  <th>Tax Invoice</th>
                  <th style="text-align:center">Payment Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
				include('lib/function.php');
				$qry="SELECT a.id,a.date,a.bill_no,a.grand_tot,a.payamt,a.balamt,b.company_nm,b.mobile,b.email FROM sale_entry AS a 
					  LEFT JOIN `party_details` AS b ON a.party_id=b.id order by a.id desc";
				$st=$conn->prepare($qry);
				$st->execute();
				$cnt=1;
				while($row=$st->fetch(PDO::FETCH_ASSOC))
				{
					$id=$row['id'];
					echo '<tr>';
					echo '<td align="center">'.$cnt.'</td>';
					echo '<td>'.date('d-m-Y',strtotime($row['date'])).'</td>';
					echo '<td align="center"> '.$row['bill_no'].'</td>';
					echo '<td>'.$row['company_nm'].'</td>';
					echo '<td align="center">'.$row['grand_tot'].'</td>';
					
					$qqq="SELECT SUM(paid_amt) AS totalpaid FROM sale_outstanding WHERE sale_id='$id'";
					$sss=$conn->prepare($qqq);
					$sss->execute();
					$row2=$sss->fetch(PDO::FETCH_ASSOC);
					$netamt=$row['grand_tot']-($row2['totalpaid']);
					
					$paiamt=$row2['totalpaid'];		
					
					echo '<td align="center">'.$paiamt.'</td>';
					echo '<td align="center">'.$netamt.'</td>';
					echo '<td align="center" style="color:#007bff"><a href="javascript:pdetails('.$id.')"><i class="fa fa-eye"></i></a></td>';
					echo '<td align="center" ><a href="javascript:pprint('.$id.')">Print</a></td>';
					if($netamt == "0")
					{
						//echo $netamt."<br>";
						echo '<td align="center"><a href="javascript:payment('.$id.')" style="color:#008040"><b>Paid</b></a></td>';
					}
					else
					{
						echo '<td align="center"><a href="javascript:payment('.$id.')" style="color:#f00"><b>PayNow</b></a></td>';
					}
					echo '</tr>';
					$cnt++;
				}
				$conn=null;
				?>
                </tbody>
               
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
