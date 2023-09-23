<?php
$sID=$_GET['sID'];
//echo $id."<br>";
include('lib/function.php');
$qry="SELECT * FROM party_details WHERE id='$sID' AND sts='0'";
//echo $qry."<br>";
$stmt=$conn->prepare($qry);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$mobile=$row['mobile'];
$adrs=$row['adrs'];
$email=$row['email'];
$gst_no=$row['gst_no'];
$state=$row['state'];
echo $adrs."*".$mobile."*".$email."*".$gst_no."*".$state;
$conn=null;
?>