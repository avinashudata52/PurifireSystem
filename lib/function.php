<?php
{
$hostname = 'localhost';
//$port = '3308';
$username = 'root';
$password = '';
$dbname = 'stock_mgnt';



try {
   	 $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
	 $conn->exec("set names utf8");
   	 /*** echo a message saying we have connected ***/
   	//echo 'Connected to database';
   	// $conn = null;
	
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }	
	//PDO connection end

}
?>
