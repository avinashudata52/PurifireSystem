<?php
if(isset($_POST['btnsub']))
{
	include('lib/function.php');
	
	$txtpartynm=$_POST['txtpartynm'];
	$txtbillno=$_POST['txtbillno'];
	$txtdate=$_POST['txtdate'];
	$txtsalety=$_POST['txtpurchasety'];
	$txtgsttype=$_POST['txtgsttype'];
	$txttotal=$_POST['txttotal'];
	$discount_type=$_POST['disval'];
	$discnt_amt=$_POST['txtdiscnt'];
	$dis_tot=$_POST['txtdiscountamt'];
	$txtsgst=$_POST['txtsgst'];
	$txtcgst=$_POST['txtcgst'];
	$txtigst=$_POST['txtigst'];
	$txtgrandtot=$_POST['txtgrandtot'];
	$txtpaybillamt=$_POST['txtpaybillamt'];
	
	
	if(empty($_POST['txtpayamt']) || $_POST['txtpayamt'] == '0')
	{
		$payamt=0;
	}
	else
	{
		$payamt=$_POST['txtpayamt'];
	}
	
	if(empty($_POST['txtbalamt']) || $_POST['txtbalamt'] == '0')
	{
		$balamt=0;
	}
	else
	{
		$balamt=$_POST['txtbalamt'];
	}
	
	$qryy="INSERT INTO sale_billno(bill_no)VALUES('$txtbillno')";
	//echo $qryy."<br>";
	$st=$conn->prepare($qryy);
	$st->execute();
	
	$qry="INSERT INTO sale_entry(party_id,bill_no,`date`,sale_type,gst_type,total,discount_type,discnt_amt_per,dis_total,sgst,cgst,igst,grand_tot,pay_bill_amt,payamt,balamt)
						  VALUES('$txtpartynm','$txtbillno','$txtdate','$txtsalety','$txtgsttype','$txttotal','$discount_type','$discnt_amt','$dis_tot',
						  '$txtsgst','$txtcgst','$txtigst','$txtgrandtot','$txtpaybillamt','$payamt','$balamt')";
	//echo $qry."<br>";
	$stm=$conn->prepare($qry);
	$stm->execute();
	$lastId=$conn->lastInsertId();
	
	$hsn_code=$_POST['hsn_code'];
	$cnt=count($hsn_code);
	
	$item_name=$_POST['item_name'];
	$p_qty=$_POST['p_qty'];
	$i_qty=$_POST['i_qty'];
	$p_rate=$_POST['p_rate'];
	$i_total=$_POST['i_total'];
	
	for($i=0;$i<$cnt;$i++)
	{
		$q="INSERT INTO sale_entry_info(lastId,hsc_code,item_nm,stock_qty,qty,rate,total)
								 VALUES('$lastId','$hsn_code[$i]','$item_name[$i]','$p_qty[$i]','$i_qty[$i]','$p_rate[$i]','$i_total[$i]')";
		//echo $q."<br>";
		$stt=$conn->prepare($q);
		$stt->execute();
		
		$up="UPDATE stock_maintain SET qty=qty-'$i_qty[$i]' WHERE itemId='$item_name[$i]'";
		//echo $up."<br>";
		$ss=$conn->prepare($up);
		$ss->execute();	
	}
	
	$qq="SELECT MAX(id) AS RctNo FROM sale_outstanding";
	$ss=$conn->prepare($qq);
	$ss->execute();
	$rw=$ss->fetch(PDO::FETCH_ASSOC);
	$Rno=$rw['RctNo']+1;
							
	$qqq="INSERT INTO sale_outstanding(sale_id,receipt_no,bill_no,`date`,grand_tot,paid_amt,bal_amt)VALUES('$lastId','$Rno','$txtbillno','$txtdate','$txtgrandtot','$payamt','$balamt')";
	$sss=$conn->prepare($qqq);
	$sss->execute();
	
	
	$conn=null;
	
	echo '<script>alert("Record Inserted Successfully...!")</script>';
	echo '<script>window.location.href="sale_entry.php"</script>';
	
}
else
{
	echo '<script>alert("Record Not Inserted Successfully...!")</script>';
	echo '<script>window.location.href="sale_entry"</script>';
}
?>