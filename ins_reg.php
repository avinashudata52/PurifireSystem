<?php
if(isset($_POST['btnreg']))
{
	include('lib/function.php');
	$fullnm=$_POST['txtuname'];
	$mobile=$_POST['txtphone'];
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	
	$query="SELECT mobile,emailId FROM login_tbl WHERE mobile='$mobile'";
	$stm=$conn->prepare($query);
	$stm->execute();
	$row=$stm->fetch(PDO::FETCH_ASSOC);
	if($stm->rowCount()>0)
	{
		echo '<script>alert("This Mobile Already Exist...!")</script>';
		echo '<script>window.location.href="index.php"</script>';
	}
	else
	{
		$qry="INSERT INTO login_tbl(uname,mobile,emailId,pwd)VALUES('$fullnm','$mobile','$email','$password')";
	//echo $qry."<br>";
	$st=$conn->prepare($qry);
	$st->execute();
	$conn=null;
	}
	echo '<script>alert("Record Inserted Successfully...!")</script>';
	echo '<script>window.location.href="index.php"</script>';
	
	
}
else
{	
	echo '<script>alert("Record Not Inserted...!")</script>';
	echo '<script>window.location.href="register"</script>';
	
}

?>