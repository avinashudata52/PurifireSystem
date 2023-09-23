<?php
$hsn=$_GET['hsnno'];
include('lib/function.php');

$qry="SELECT DISTINCT a.hsn,a.itemnm,b.itemId,b.qty,b.bal,b.sale_rate FROM item_master AS a 
LEFT JOIN stock_maintain AS b ON a.id=b.itemId WHERE b.itemId='$hsn'";
$st=$conn->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$hsncode=$row['hsn'];
$qty=$row['qty'];
$rate=$row['sale_rate'];

echo $hsncode."@".$qty."@".$rate;
?>