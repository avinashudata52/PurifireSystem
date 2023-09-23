<?php
if(isset($_POST['btnsub']))
{
include('lib/function.php');
date_default_timezone_set('Asia/Calcutta');
$dt=date('Y-m-d');
$txtbillno=$_POST['txtbillno'];

$txtitemId=$_POST['txtitemId'];
$txtpqty=$_POST['txtpqty'];
$txtprate=$_POST['txtprate'];
$txtptot=$_POST['txtptot'];
$txtprate=$_POST['txtprate'];

$srate=$_POST['srate'];
$stot=$_POST['stot'];

$count=count($txtitemId);

$qry="INSERT INTO stock_master(dt,purchase_invoice)VALUES('$dt','$txtbillno')";
//echo $qry."<br>";
$stm=$conn->prepare($qry);
$stm->execute();
$lastId=$conn->lastInsertId();

	for($i=0;$i<$count;$i++)
	{
		$qu="INSERT INTO stock_info(lastId,item,qty,p_rate,p_total,s_rate,s_total)VALUES('$lastId','$txtitemId[$i]','$txtpqty[$i]','$txtprate[$i]','$txtptot[$i]','$srate[$i]','$stot[$i]')";
		//echo $qu."<br>";
		$s=$conn->prepare($qu);
		$s->execute();
		//echo $txtitemId[$i]."<br>";
		
		$q="select id from stock_maintain WHERE itemId='$txtitemId[$i]'";
		//echo $q."<br>";
		$stmt=$conn->prepare($q);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
			$ID=$row['id'];
			if(!empty($ID))
				{
				$qq="UPDATE stock_maintain SET qty=qty+'$txtpqty[$i]',bal=bal+'$txtpqty[$i]',prev_rate='$txtprate[$i]',rate='$srate[$i]' WHERE id='$ID'";
				echo $qq."<br>";
				$ss=$conn->prepare($qq);
				$ss->execute();
				
				}
			else
				{
				$qqq="INSERT INTO stock_maintain (dt,itemId,rate,qty,bal,prev_rate)VALUES('$dt','$txtitemId[$i]','$srate[$i]','$txtpqty[$i]','$txtpqty[$i]','$txtprate[$i]')";
				echo $qqq."<br>";
				$sss=$conn->prepare($qqq);
				$sss->execute();
				}
		$qrt="UPDATE item_master SET rate='$srate[$i]' WHERE id='$txtitemId[$i]'";	
		$srt=$conn->prepare($qrt);
		$srt->execute();
				
	}
	
$query="UPDATE purchase_entry SET stock_sts='1' WHERE id='$txtbillno'";
//echo $query."<br>";
$qstm=$conn->prepare($query);
$qstm->execute();

	
$conn=null;	
/*echo '<script>alert("Stock Added Successfully...!")</script>';
echo '<script>window.location.href="stock_entry.php"</script>';	*/
}
else
{
echo '<script>alert("Stock Not Added Successfully...!")</script>';
echo '<script>window.location.href="stock_entry.php"</script>';
}
?>