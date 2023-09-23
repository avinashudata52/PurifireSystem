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
<?php
$vId=$_GET['vId'];
include('lib/function.php');
$qry="SELECT a.*,b.company_nm,b.mobile,b.adrs,b.email,b.gst_no,b.state,b.city_pin FROM purchase_entry AS a
LEFT JOIN purchase_party_details AS b ON a.party_id=b.id
WHERE a.id='$vId'";
//echo $qry."<br>";
$st=$conn->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$company_nm=$row['company_nm'];
$mobile=$row['mobile'];
$adrs=$row['adrs'];
$email=$row['email'];
$gst_no=$row['gst_no'];

if($row['state'] == "1")
{
	$state="Maharashtra";
}
else
{
	$state="Out Of Maharashtra";
}
$pin=$row['city_pin'];
$bill=$row['bill_no'];
$date=$row['date'];
if($row['purchase_type'] == "1")
{
	$purchase_type="With GST";
}
else
{
	$purchase_type="Without GST";
}

if($row['pay_bill_amt'] == "1")
{
	$pay_bill_amt="Yes";
}
else
{
	$pay_bill_amt="No";
}
$payamt=$row['payamt'];
$balamt=$row['balamt'];

if($row['discount_type'] == "1")
{
	$discount_type="%";
}
else
{
	$discount_type="RS";
}

$discnt_amt_per=$row['discnt_amt_per'];
$dis_total=$row['dis_total'];

$total=$row['total'];


$sgst=$row['sgst'];
$cgst=$row['cgst'];
$igst=$row['igst'];
$grand_tot=$row['grand_tot'];
$gstty=$row['gst_type'];
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
                <h3 class="card-title"><b>Purchase Details</b></h3>
              </div>
                <div class="card-body">
                 <div>
                  <label style="color:RED"><u>Party Information</u></label>
                  </div>
                     <table width="100%">
                        <tr>
                            <td>
                                <table cellpadding="5">
                                    <tr>
                                        <td ><label>Party Name &nbsp;&nbsp;:&nbsp;&nbsp;</label></td>
                                        <td><label> <?php echo $company_nm; ?></label></td>
                                    </tr>
                                    <tr>
                                        <td><label>Mobile No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</label></td>
                                        <td><label> <?php echo $mobile; ?></label></td>
                                    </tr>
                                    <tr>
                                        <td><label>GST No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</label></td>
                                        <td><label> <?php echo $gst_no; ?></label></td>
                                    </tr>
                                </table>
                            </td>
                            
                            <td>
                                <table cellpadding="5">
                                    <tr>
                                        <td><label>Address :</label></td>
                                        <td><label> <?php echo $adrs; ?></label></td>
                                    </tr>
                                    <tr>
                                        <td><label>Email Id :</label></td>
                                        <td><label> <?php echo $email; ?></label></td>
                                    </tr>
                                    <tr>
                                        <td><label>State &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label></td>
                                        <td><label> <?php echo $state."-".$pin; ?></label></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                     
                     </table>
				  
                  <div>
                  <label style="color:RED"><u>Purchase Information</u></label>
                  </div>
                  
                    <table width="100%">
                        <tr>
                            <td>
                                <table cellpadding="5">
                                    <tr>
                                        <td ><label>Bill No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</label></td>
                                        <td><label><?php echo $bill; ?></label></td>
                                    </tr>
                                </table>
                            </td>
                            
                            <td>
                                <table cellpadding="5">
                                    <tr>
                                        <td ><label>Date &nbsp;&nbsp;:&nbsp;&nbsp;</label></td>
                                        <td><label><?php echo date('d-m-Y',strtotime($date)); ?></label></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                     
                     </table>
                     
                   <table width="100%" border="1" cellpadding="5">
                   		<tr style="background-color:#5377e0">
                        	<th>No</th>
                            <th>HSN Code</th>
                            <th>Item Name</th>
                            <th>Rate</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                        <tbody>
							<?php
                            $vId=$_GET['vId'];
                            include('lib/function.php');
                            $qq="SELECT a.*,b.itemnm FROM puchase_entry_info AS a
								 LEFT JOIN item_master AS b ON a.item_nm=b.id WHERE a.lastId='$vId'";
							$ss=$conn->prepare($qq);
							$ss->execute();
							$cnt=1;
							while($rw=$ss->fetch(PDO::FETCH_ASSOC))
							{
								echo '<tr>';
								echo '<td>'.$cnt.'</td>';
								echo '<td>'.$rw['hsc_code'].'</td>';
								echo '<td>'.$rw['itemnm'].'</td>';
								echo '<td>'.$rw['rate'].'</td>';
								echo '<td>'.$rw['qty'].'</td>';
								echo '<td>'.$rw['total'].'</td>';
								echo '</tr>';
								$cnt++;
							}
							$conn=null;
							?>
                        </tbody>
                   </table>  
                   
                   <div class="row" style="margin-top:20px">
                   		<div class="col-md-6">
                        <table width="100%">
                        <tr>
                            <td>
                                <table cellpadding="3">
                                    <tr>
                                    <?php
                                    if($row['state'] == '1')
									{
										if($gstty == "1")
										
										{
											$tot1=0;
											$tot=18/2;
										}
										else if($gstty == "2")
										
										{
											$tot1=0;
											$tot=12/2;
										}
										else if($gstty == "3")
										
										{
											$tot1=0;
											$tot=5/2;
										}
										else
										
										{
											$tot1=0;
											$tot=0;
										}
									}
									else if($row['state'] == '2')
									{
										if($gstty == "1")
										
										{	$tot=0;
											$tot1=18;
										}
										else if($gstty == "2")
										
										{	$tot=0;
											$tot1=12;
										}
										else if($gstty == "3")
										
										{   $tot=0;
											$tot1=5;
										}
										else
										
										{
											$tot1=0;
											$tot=0;
										}
									}
									
									?>
                                        <!--<td ><label>Purchase Type :</label></td>
                                        <td><label> <?php echo $purchase_type;?></label></td>-->
                                    </tr>
                                    <tr>
                                        <td ><label>Total :</label></td>
                                        <td><label> <?php echo $total;?></label></td>
                                    </tr>
                                    <tr>
                                        <td ><label>SGST <?php echo "(".$tot."%)";?>:</label></td>
                                        <td><label> <?php echo $sgst;?></label></td>
                                    </tr> 
                                    <tr>
                                        <td ><label>CGST  <?php echo "(".$tot."%)";?>:</label></td>
                                        <td><label> <?php echo $cgst;?></label></td>
                                    </tr>
                                    <tr>
                                        <td ><label>IGST <?php echo "(".$tot1."%)";?>:</label></td>
                                        <td><label> <?php echo $igst;?></label></td>
                                    </tr>
                                    
                                   	
                                </table>
                            </td>
                        </tr>
                     
                     </table>		
                        </div>
                        <div class="col-md-6">
                          <table width="100%">
                        <tr>
                            <td>
                                <table cellpadding="3">
                                    
                                    <tr>
                                        <td ><label>Grand Total :</label></td>
                                        <td><label> <?php echo $grand_tot;?></label></td>
                                    </tr>
                                    <!--<tr>
                                        <td ><label>GST Type 	 :</label></td>
                                        <td>
                                        <?php
                                        if($gstty == '1')
										{
											echo '<label>18%</label>';
										}
										else if($gstty == '2')
										{
											echo '<label>12%</label>';
										}
										else if($gstty == '3')
										{
											echo '<label>5%</label>';
										}
										else if($gstty == '4')
										{
											echo '<label>Without GST</label>';
										}
										else
										{
											echo '<label>Without GST</label>';
										}
										?>
                                        </td>
                                    </tr>-->
                                   
                                    <tr>
                                        <td >
                                        <label>Discount <?php  echo $discnt_amt_per. $discount_type;?> :</label></td>
                                        <td><label><?php  echo $dis_total;?></label></td>
                                    </tr>
                                    
                                    <tr>
                                        <td ><label>Paying Amount  :</label></td>
                                        <td><label> <?php  echo $payamt;?></label></td>
                                    </tr>
                                    <tr>
                                        <td ><label>Balance Amount  :</label></td>
                                        <td><label> <?php  echo $balamt;?></label></td>
                                    </tr>	
                                </table>
                            </td>
                        </tr>
                     
                     </table>	
                        </div>
                   </div>
                 
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
