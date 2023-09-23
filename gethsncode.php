<?php
$hsn=$_GET['hsnno'];
include('lib/function.php');

$qry="SELECT hsn FROM item_master WHERE id='$hsn'";
$st=$conn->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$hsncode=$row['hsn'];

echo $hsncode;
?>