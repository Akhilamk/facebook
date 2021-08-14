<?php
session_start();
$_SESSION['userid']="";
unset($_SESSION['userid']);
header("location:facebookpage.php");

?>