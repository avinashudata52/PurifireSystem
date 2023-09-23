<?php
$id=$_GET['id'];
include('lib/function.php');
$qry="UPDATE purchase_party_details SET sts='2' WHERE id='$id'";
//echo $qry."<br>";
$stmt=$conn->prepare($qry);
$stmt->execute();

$conn=null;
?>