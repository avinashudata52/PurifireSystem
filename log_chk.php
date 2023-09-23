<?php session_start();
	if(!isset($_SESSION['logId']) || empty($_SESSION['logId']))
	{
		echo '<script type="text/javascript">window.location.href="index.php"</script>';
	}
?>