<?php
if(isset($_POST['btnsub']))
{
	include('lib/function.php');
	
	/*-----Partyinfo-----*/
	$partynm=$_POST['txtpartynm'];
	$bill=$_POST['txtbillno'];
	$txtdate=$_POST['txtdate'];
	$txtpurchasety=$_POST['txtpurchasety'];
	$txtgsttype=$_POST['txtgsttype'];
	$txttotal=$_POST['txttotal'];
	$discounttype=$_POST['disval'];
	$disamt=$_POST['txtdiscnt'];
	$discnt_total=$_POST['txtdiscountamt'];
	$sgst=$_POST['txtsgst'];
	$cgst=$_POST['txtcgst'];
	$igst=$_POST['txtigst'];
	$grandtot=$_POST['txtgrandtot'];
	$pay_billamt=$_POST['txtpaybillamt'];
	//$paymode=$_POST['txtpaymode'];
	
	
	
	if(empty($_POST['txtpayamt']) || $_POST['txtpayamt'] == '0')
	{
		$payamt=0;
	}
	else
	{
		$payamt=$_POST['txtpayamt'];
	}
	
	if(empty($_POST['txtbalamt']) || $_POST['txtbalamt']  == '0')
	{
		$balamt=0;
	}
	else
	{
		$balamt=$_POST['txtbalamt'];
	}
	
	
	
	
	
	$qry="INSERT INTO purchase_entry(party_id,bill_no,`date`,purchase_type,gst_type,total,discount_type,discnt_amt_per,dis_total,sgst,cgst,igst,
			   						grand_tot,pay_bill_amt,payamt,balamt)
			   					    VALUES('$partynm','$bill','$txtdate','$txtpurchasety','$txtgsttype','$txttotal','$discounttype',
									'$disamt','$discnt_total','$sgst','$cgst','$igst','$grandtot','$pay_billamt','$payamt','$balamt')";
	//echo $qry."<br>";
	$stm=$conn->prepare($qry);
	$stm->execute();
	$lastId=$conn->lastInsertId();
	
	
	$hsn_code=$_POST['hsn_code'];
	$item_name=$_POST['item_name'];
	$rate=$_POST['rate'];
	$i_qty=$_POST['i_qty'];
	$i_total=$_POST['i_total'];
	
	$cnt=count($hsn_code);
	for($i=0;$i<$cnt;$i++)
	{
		$q="INSERT INTO puchase_entry_info(lastId,hsc_code,item_nm,rate,qty,total)VALUES('$lastId','$hsn_code[$i]','$item_name[$i]','$rate[$i]','$i_qty[$i]','$i_total[$i]')";
		//echo $q."<br>";
		$st=$conn->prepare($q);
		$st->execute();
	}
	
	
	
	$qq="SELECT MAX(id) AS RctNo FROM purchase_outstanding";
	$ss=$conn->prepare($qq);
	$ss->execute();
	$rw=$ss->fetch(PDO::FETCH_ASSOC);
	$Rno=$rw['RctNo']+1;
							
	$qqq="INSERT INTO purchase_outstanding(purchase_id,receipt_no,bill_no,`date`,grand_tot,paid_amt,bal_amt)VALUES('$lastId','$Rno','$bill','$txtdate','$grandtot','$payamt','$balamt')";
	$sss=$conn->prepare($qqq);
	$sss->execute();
	
	$conn=null;		
	/*echo '<script>alert("Record Inserted Successfully...!")</script>';
	echo '<script>window.location.href="purchase_entry.php"</script*/
}
else
{
	echo '<script>alert("Record Not Inserted...!")</script>';
	echo '<script>window.location.href="purchase_entry.php"</script>';
}

?>