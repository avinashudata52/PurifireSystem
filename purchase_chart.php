<?php 
header('Content-Type: application/json');
include('lib/function.php');
$item_code='-1';
$suppliercode=$_GET['suppliercode'];
if($item_code=='-1')
{
	/*$sqlQuery ="SELECT DATE_FORMAT(a.date,'%d-%m-%Y') AS dt,b.qty FROM purchase_entry AS a
LEFT JOIN puchase_entry_info AS b ON a.id=b.lastId
ORDER BY a.date ASC LIMIT 6";*/ 
$sqlQuery="SELECT a.bill_no,a.date as dt,SUM(b.qty) AS qty FROM purchase_entry AS a
LEFT JOIN puchase_entry_info AS b ON a.id=b.lastId
GROUP BY a.bill_no,a.date ORDER BY a.date DESC LIMIT 6";	
}
//echo $sqlQuery;
$result = $conn->prepare($sqlQuery);
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);

$dataPoints = array();
while($row=$result->fetch())
{
$pr=(double)$row["qty"];
$dt=date('d-m-Y',strtotime($row['dt']));
$stuff = array("label" => $dt,"y" => $pr,"indexLabel" => "{y}");
array_push($dataPoints,$stuff);	
} 
$mysql=null; 
echo json_encode($dataPoints); 
?>