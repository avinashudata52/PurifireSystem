<?php
	if(isset($_POST['btnsignin']))
	{
		include('lib/function.php');
	
		$username=$_POST['txtname'];
		$password=$_POST['txtpassword'];
		
		$qry="SELECT id,uname,pwd FROM login_tbl WHERE uname='$username' AND pwd='$password'";
		//echo $qry."<br>";
		$stm=$conn->prepare($qry);
		$stm->execute();
		$row=$stm->fetch(PDO::FETCH_ASSOC);
		
		$id=$row['id'];
		$uname=$row['uname'];
		$pwd=$row['pwd'];
		
		if($uname == $username && $pwd == $password)
		{   session_start();
			$_SESSION['logId']=$id;
			echo '<script type="text/javascript">window.location.href="admin.php"</script>';
		}
		else
		{
			echo '<script>alert("Incorrect Username OR Password ...!")</script>';
			echo '<script type="text/javascript">window.location.href="index.php"</script>';
		}
	}
?>