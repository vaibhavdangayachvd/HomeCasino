<?php
	session_start();
	if(isset($_REQUEST['guest']))
		$_SESSION['guest']=500;
	if(!isset($_SESSION['user']) && !isset($_SESSION['guest']))
	{
		session_destroy();
		header('location:login.php');
	}
?>