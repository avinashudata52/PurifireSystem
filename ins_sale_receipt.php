<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
<?php 
if(isset($_POST['btnsub']))
{
include('lib/function.php');
$purchaseId=$_POST['purchaseId'];
$txtreceiptno=$_POST['txtreceiptno'];
$txtcompanynm=$_POST['txtcompanynm'];
$txtbillno=$_POST['txtbillno'];
$txtgrandtot=$_POST['txtgrandtot'];
$txtpaidamt=$_POST['txtpaidamt'];
$txtbalamt=$_POST['txtbalamt'];
$txtdate=$_POST['txtdate'];
$txtpaybillamt=$_POST['txtpaybillamt'];
$txtpayamt=$_POST['txtpayamt'];
$txtremainamt=$_POST['txtremainamt'];

if($txtpaybillamt == "1")
{
	$qry="INSERT INTO sale_outstanding(sale_id,receipt_no,bill_no,`date`,grand_tot,paid_amt,bal_amt)
							 VALUES('$purchaseId','$txtreceiptno','$txtbillno','$txtdate','$txtgrandtot','$txtpayamt','$txtremainamt')";
	$st=$conn->prepare($qry);
	$st->execute();
	
	
}
	$conn=null;
	echo "<script> alert('Record Inserted Successfully...!')</script>";
	echo "<script>refreshAndClose(); </script>";
	echo "<script>self.opener.location.reloadAndClose(); </script>";
	echo "<script>window.location.href='purchase_master.php'</script>";

}
else
{
echo "<script> alert('Record Not Inserted...!')</script>";
echo "<script>refreshAndClose(); </script>";
echo "<script>self.opener.location.reloadAndClose(); </script>";
echo "<script>window.location.href='purchase_master.php'</script>";
}
?>