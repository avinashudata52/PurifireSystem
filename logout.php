<?php
session_start();
session_destroy();
unset($_SESSION["logId"]);
header("Location:index.php");
exit();
?>