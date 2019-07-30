<?php
	error_reporting(0);
	if(!isset($_REQUEST['id']))
		header('location:login.php');
	else
	{
		require 'includes/connection.php';
		$pw=$_REQUEST['pw'];
		$em=$_REQUEST['id'];
		$query="select password from users where email='$em'";
		$query=mysqli_query($db,$query);
		$query=mysqli_fetch_array($query);
		$query=$query['password'];
		if(strcmp($pw,$query))
			header('location:login.php');
	}
	$err="";
	if(isset($_POST['change']))
	{
		$pw=sha1($_POST['pass']);
		$query="update users set password='$pw' where email='$em'";
		mysqli_query($db,$query);
		$err="Password Changed Successfully";
		header('refresh:1;url=login.php');
	}
?>
<html>
	<head>
		<title>Change Password</title>
		<script>
			function check(){
				var pw=document.change_form.pass.value;
				var repw=document.change_form.repass.value;
				if(pw.length < 3 || pw.length > 30)
				{
					window.alert('Password shoulb be between 3 to 30 characters');
					document.change_form.pass.focus();
					return false;
				}
				else if(pw!=repw)
				{
					window.alert('Passwords do not match !!');
					document.change_form.repass.value="";
					document.change_form.repass.focus();
					return false;
				}
				else
					return true;
			}
		</script>
	</head>
	<body>
		<form method="post" name="change_form" onSubmit="return check()">
			<p>Enter Password</p>
			<input type="password" name="pass" value="" placeholder="Enter Password" required><br>
			<p>Re-Enter Password</p>
			<input type="password" name="repass" value="" placeholder="Re-Enter Password" required><br><br>
			<input type="submit" value="Change" name="change"><br>
			<input disabled type="text" value="<?php echo $err;?>" size="30">
		</form>
	</body>
</html>