<?php
	error_reporting(0);
	if(isset($_REQUEST['id']))
	{
		require 'includes/connection.php';
		$em=$_REQUEST['id'];
		$pw=$_REQUEST['pw'];
		$query="select active,id from users where email='$em'";
		$query=mysqli_query($db,$query);
		$query=mysqli_fetch_array($query);
		$id=$query['id'];
		$query=sha1($query['active']);
		if(!strcmp($query,$pw))
		{
			$query="update users set active=0 where id=$id";
			mysqli_query($db,$query);
			$query="update referrals set active=1 where user_id=$id";
			if(mysqli_query($db,$query))
			{
				$query="select ref_id from referrals where user_id=$id";
				$query=mysqli_query($db,$query);
				$query=mysqli_fetch_array($query);
				$ref=$query['ref_id'];
				$query="select balance from users where ref_id='$ref'";
				$query=mysqli_query($db,$query);
				$query=mysqli_fetch_array($query);
				$bal=$query['balance']+1000;
				$query="update users set balance=$bal where ref_id='$ref'";
				mysqli_query($db,$query);
			}
		}
	}
	header('location:login.php');
?>