<?php
if(isset($_POST['btnsub']))
{
	include('lib/function.php');
	
	$company=$_POST['txtconpanynm'];
	$mob=$_POST['txtmob'];
	$adrs=$_POST['txtaddress'];
	$emailId=$_POST['txtemail'];
	$gstno=$_POST['txtgst'];
	$state=$_POST['txtstate'];
	$cpin=$_POST['txtcitypin'];
	
	$qry="INSERT INTO party_details(company_nm,mobile,adrs,email,gst_no,state,city_pin)VALUES('$company','$mob','$adrs','$emailId','$gstno','$state','$cpin')";
	$st=$conn->prepare($qry);
	$st->execute();
	
	$conn=null;
	
	echo '<script>alert("Record Inserted Successfully....!")</script>';
	echo '<script>window.location.href="party_entry.php"</script>';
	
}
else
{
	echo '<script>alert("Record Not Inserted....!")</script>';
	echo '<script>window.location.href="party_entry.php"</script>';	
}
?>