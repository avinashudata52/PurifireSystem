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
	function getpaytype()
	{
		if(document.getElementById('txtyes').checked==true)
		{
			document.getElementById("cash").style.visibility='visible';
			document.getElementById("cash").style.overflow='visible';
			document.getElementById("cash").style.height='auto';
			
			document.getElementById("txtpaybillamt").value=1;
		}
		else
		{
			
			document.getElementById("cash").style.visibility='hidden';
			document.getElementById("cash").style.overflow='hidden';
			document.getElementById("cash").style.height='0px';
			
			document.getElementById("txtpaybillamt").value=2;	
		}
	  }
</script>
<script>
	function getcal_balamt()
	{
		
		
		var grandtot = parseFloat(document.getElementById('txtgrandtot').value);
		//alert(grandtot);
		var payamt = parseFloat(document.getElementById('txtpaidamt').value);
		//alert(payamt);
		var balamt = parseFloat(document.getElementById('txtbalamt').value);
		//alert(payamt);
		var payingamt = parseFloat(document.getElementById('txtpayamt').value);
		//alert(payamt);
		if(payingamt > balamt)
		{
			alert('Please Enter valid amount...!');
			document.getElementById('txtpayamt').value="0";
			document.getElementById('txtremainamt').value="0";
		}
		else
		{
			var bal=parseFloat(balamt)-parseFloat(payingamt);
			//alert(bal);
			if(isNaN(bal))
			{
				bal=0;
			}
			document.getElementById('txtremainamt').value=bal;
		}
			
	}
</script>
<script>
function getprint(id)
{
	window.open("purchase_receipt.php?pId="+id, "_blank" ,"toolbar=yes, scrollbars=yes, resizable=no, top=20, left=10, width=700, height=450");
}
</script>
</head>
<body >
<?php
$pId=$_GET['pId'];
include('lib/function.php');
$qry="SELECT a.date,a.grand_tot,a.paid_amt,a.bal_amt,b.bill_no,b.id,c.company_nm FROM purchase_outstanding AS a 
LEFT JOIN purchase_entry AS b ON a.purchase_id=b.id
LEFT JOIN purchase_party_details AS c ON b.party_id=c.id
WHERE a.purchase_id='$pId'";
//echo $qry."<br>";
$st=$conn->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$purchase_id=$row['id'];
$date=$row['date'];
$bill_no=$row['bill_no'];
$grand_tot=$row['grand_tot'];
$payamt=$row['paid_amt'];
$balamt=$row['bal_amt'];
$company_nm=$row['company_nm'];
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
                <h3 class="card-title"><b>Purchase Outstanding Cash Reciept</b></h3>
              </div>
              <form action="ins_purchase_receipt.php" method="post">
                <div class="card-body">
                
                <input type="hidden" id="purchaseId" name="purchaseId" value="<?php echo $purchase_id;?>">
                <div class="row">
                
                	<div class="col-md-5">
                    	<div class="row">
                        	<div class="col-md-4">
                            <label>Receipt No :</label>
                            </div>
                            <div class="col-md-7">
                            <?php 
							include('lib/function.php');
							$q="SELECT MAX(id) AS RctNo FROM purchase_outstanding";
							$s=$conn->prepare($q);
							$s->execute();
							$rw=$s->fetch(PDO::FETCH_ASSOC);
							$Rno=$rw['RctNo']+1;
							?>
                            <input type="text" id="txtreceiptno" name="txtreceiptno" class="form-control" value="<?php echo $Rno;?>" readonly>
                            </div>
                           <div class="col-md-1"></div>
                        </div>
                        <div class="row" style="margin-top:8px">
                        	<div class="col-md-4">
                            <label>Company Name :</label>
                            </div>
                            <div class="col-md-7">
                            <input type="text" id="txtcompanynm" name="txtcompanynm" class="form-control" value="<?php echo $company_nm;?>" readonly>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row" style="margin-top:8px">
                        	<div class="col-md-4">
                            <label>Bill No :</label>
                            </div>
                            <div class="col-md-7">
                            <input type="text" id="txtbillno" name="txtbillno" class="form-control" value="<?php echo $bill_no;?>" readonly>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        
                        <div class="row" style="margin-top:8px">
                        	<div class="col-md-4">
                            <label>Date :</label>
                            </div>
                            <div class="col-md-7">
                            <input type="date" class="form-control" id="txtdate" name="txtdate" value="<?php echo $dt;?>" readonly>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        
                        
                        <div class="row" style="margin-top:8px">
                        	<div class="col-md-4">
                            <label>Total :</label> 
                            </div>
                            <div class="col-md-7">
                            <input type="text" id="txtgrandtot" name="txtgrandtot" class="form-control" value="<?php echo $grand_tot;?>" readonly>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row" style="margin-top:8px">
                        	<div class="col-md-4">
                            <label>Paid Amount :</label>
                            </div>
                            <div class="col-md-7">
                            <?php 
							include('lib/function.php');
							$qq="SELECT SUM(paid_amt) AS totalpaid FROM purchase_outstanding WHERE purchase_id='$pId'";
							$ss=$conn->prepare($qq);
							$ss->execute();
							while($row1=$ss->fetch(PDO::FETCH_ASSOC))
							{
								echo '<input type="text" id="txtpaidamt" name="txtpaidamt" class="form-control" value="'.$row1['totalpaid'].'" readonly>';
							}
							$conn=null;
							?>
                            
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row" style="margin-top:8px">
                        	<div class="col-md-4">
                            <label>Net Balance :</label>
                            </div>
                            <div class="col-md-7">
                            <?php 
							include('lib/function.php');
							$qqq="SELECT SUM(paid_amt) AS totalpaid FROM purchase_outstanding WHERE purchase_id='$pId'";
							$sss=$conn->prepare($qqq);
							$sss->execute();
							while($row2=$sss->fetch(PDO::FETCH_ASSOC))
							{
								$netamt=($grand_tot)-($row2['totalpaid']);
							}
							$conn=null;
							?>
                            <input type="text" id="txtbalamt" name="txtbalamt" class="form-control" value="<?php echo $netamt;?>" readonly>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        
                        	<?php 
							include('lib/function.php');
							$qqq1="SELECT SUM(paid_amt) AS totalpaid FROM purchase_outstanding WHERE purchase_id='$pId'";
							$sss1=$conn->prepare($qqq1);
							$sss1->execute();
							while($row3=$sss1->fetch(PDO::FETCH_ASSOC))
							{
								$net=($grand_tot)-($row3['totalpaid']);
							}
							if($netamt == '0')
							{
							?>
                            
                            <?php
                            }else
							{
                            ?>
                            <div class="row" style="margin-top:15px">
                                <div class="col-md-6">
                                <label>Do You Want To Pay Bill</label>
                                </div>
                                <div class="col-md-6">
                                <input type="radio" id="txtyes" name="txtyes" onClick="getpaytype();" required>&nbsp;Yes
                            <input type="radio" id="txtno" name="txtyes" onClick="getpaytype()">&nbsp;No
                            
                            <input type="hidden" id="txtpaybillamt" name="txtpaybillamt" value="0" required>
                                </div>
                            </div>
                            <div class="row" id="cash" style="visibility:hidden;overflow:hidden;height:0px">

                        	<div class="col-md-4" style="margin-top:5px">
                            <label>Paying Amount :</label>
                            </div>
                            <div class="col-md-7" style="margin-top:5px">
                            <input type="text" id="txtpayamt" name="txtpayamt" class="form-control" onChange="getcal_balamt();">
                            </div>
                            <div class="col-md-1"></div>
                                                       
                        
                        	<div class="col-md-4" style="margin-top:5px">
                            <label>Balance Amount :</label>
                            </div>
                            <div class="col-md-7" style="margin-top:5px">
                            <input type="text" id="txtremainamt" name="txtremainamt" class="form-control" readonly>
                            </div>
                            <div class="col-md-1"></div>
                            </div>
                            
                  <button type="submit" class="btn btn-primary" id="btnsub" name="btnsub">Submit</button>
                
                            <?php
							}
							?>
                        
                        
                        
                    
                    </div>
                    
                    <div class="col-md-7">
                    	<table width="100%" class="table table-bordered">
                        	<tr style="background-color:#5377e0">
                            	<th style="text-align:center">No</th>
                                <th style="text-align:center">Receipt No</th>
                                <th style="text-align:center">Date</th>
                                <th style="text-align:center">Paid Amount</th>
                                <th style="text-align:center">Print</th>
                            </tr>
                            <?php
                            include('lib/function.php');
							$query="SELECT id,receipt_no,`date`,paid_amt FROM purchase_outstanding WHERE purchase_id='$pId'";
							$stm=$conn->prepare($query);
							$stm->execute();
							$cnt=1;
							$total=0;
							while($rw1=$stm->fetch(PDO::FETCH_ASSOC))
							{
								if($rw1['paid_amt'] == '0')
								{
								}
								else
								{
									$id=$rw1['id'];
									echo '<tr>';
									echo '<td align="center">'.$cnt.'</td>';
									echo '<td align="center">'.$rw1['receipt_no'].'</td>';
									echo '<td align="center">'.$rw1['date'].'</td>';
									echo '<td align="center">'.$rw1['paid_amt'].'</td>';
									echo '<td align="center"><a href="javascript:getprint('.$id.')">Print</a></td>';
									echo '</tr>';
									$total=$total+$rw1['paid_amt'];
									$cnt++;
								}
							}
							
							$conn=null;
							?>
                            
                            <?php
							$remain=$grand_tot-$total;
							if($remain == "0")
							{
								echo '<tfoot>
                            <!--<tr>
                            <th colspan="3" style="text-align:right">Total</th>
                            <th colspan="2"><?php echo $total;?></th>
                            </tr>-->
                            <tr>
                            <th colspan="5" style="text-align:center;color:#f00">Total Amount has been paid</th>
                            </tr>
                            </tfoot>';
							}
                            ?>
                            
                        </table>
                    </div>
                
                </div>   
                 
                </div>
             
              
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

<script>
$( document ).ready(function() {
	
    $("#btnsub").click(function()
	{
	   if($("#txtpaybillamt").val().trim() == "0")
		{
			$("#txtpartynm").addClass("require");
			alert("Please Select Pay Bill Type...!");
			$("#txtyes").focus();
			return false;
		}
		else if($("#txtpaybillamt").val().trim() == "1")
		{
			var a =document.getElementById('txtpayamt').value;
			if(a == "")
			{
			$("#txtpayamt").addClass("require");
			alert("Please Enter Paying Amount...!");
			$("#txtpayamt").focus();
			return false;
			}
		}
		
	});

});

</script>

</body>
</html>
