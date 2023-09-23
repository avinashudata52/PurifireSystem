<?php 
date_default_timezone_set('Asia/Calcutta');
if(isset($_POST['btnsub']))
{
	include('lib/function.php');
	$Item_nm=$_POST['txtitem'];
	$txthsncode=$_POST['txthsncode'];
	$date=date('Y-m-d');
	$query="INSERT INTO item_master(dt,itemnm,hsn)VALUES('$date','$Item_nm','$txthsncode')";
	//echo $query."<br>";
	$st=$conn->prepare($query);
	$st->execute();
	$conn = null;
	
	echo "<script> alert('Record Inserted Successfully...!')</script>";
	echo "<script>window.location.href='items.php'</script>";
}
else
{
	echo "<script> alert('Record Not Inserted...!')</script>";
	echo "<script>window.location.href='items.php'</script>";
}
?>