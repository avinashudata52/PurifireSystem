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
	$paymode=$_POST['txtpaymode'];
	
	if(empty($_POST['txtbanknm']))
	{
		$banknm=0;
	}
	else
	{
		$banknm=$_POST['txtbanknm'];
	}
	
	if(empty($_POST['txtchequenm']))
	{
		$cheque_no=0;
	}
	else
	{
		$cheque_no=$_POST['txtchequenm'];	
	}
	
	if(empty($_POST['txtchequedt']))
	{
		$cheque_dt=0;
	}
	else
	{
		$cheque_dt=$_POST['txtchequedt'];
	}
	
	if(empty($_POST['txtonlinepay']))
	{
		$online_pay=0;
	}
	else
	{
		$online_pay=$_POST['txtonlinepay'];
	}
	
	if(empty($_POST['txttransid']))
	{
		$transactionId=0;
	}
	else
	{
		$transactionId=$_POST['txttransid'];
	}
	
	if(empty($_POST['txtpayamt']) || $_POST['txtpayamt'])
	{
		$payamt=0;
	}
	else
	{
		$payamt=$_POST['txtpayamt'];
	}
	
	if(empty($_POST['txtbalamt']) || $_POST['txtbalamt'])
	{
		$balamt=0;
	}
	else
	{
		$balamt=$_POST['txtbalamt'];
	}
	
	
	
	
	
	$qry="INSERT INTO purchase_entry(party_id,bill_no,`date`,purchase_type,gst_type,total,discount_type,discnt_amt_per,dis_total,sgst,cgst,igst,
			   						grand_tot,pay_bill_amt,paymode,bank_nm,cheque_no,check_dt,online_pay,transaction_id,payamt,balamt)
			   					    VALUES('$partynm','$bill','$txtdate','$txtpurchasety','$txtgsttype','$txttotal','$discounttype',
									'$disamt','$discnt_total','$sgst','$cgst','$igst','$grandtot','$pay_billamt','$paymode',
									'$banknm','$cheque_no','$cheque_dt','$online_pay','$transactionId','$payamt','$balamt')";
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
	
	$conn=null;		
	echo '<script>alert("Record Inserted Successfully...!")</script>';
	echo '<script>window.location.href="purchase_entry.php"</script>';	
}
else
{
	echo '<script>alert("Record Not Inserted...!")</script>';
	echo '<script>window.location.href="purchase_entry.php"</script>';
}

?>