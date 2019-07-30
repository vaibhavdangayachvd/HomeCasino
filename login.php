<?php
	error_reporting(0);
	$un=$pw="";
	require 'includes/connection.php';
	if(!$db)
		$err="Not Connected To Database";
	else 
		$err="Connected To Database";
	if(isset($_POST['login'])|| isset($_COOKIE['user']))
	{
		if(isset($_COOKIE['user']))
		{
			$un=$_COOKIE['user'][0];
			$pw=$_COOKIE['user'][1];
		}
		else
		{
			$un=$_POST['user'];
			$pw=sha1($_POST['password']);
		}
		$query="select * from users where username='$un' or email='$un' or phone='$un'";
		$query=mysqli_query($db,$query);
		if(!mysqli_num_rows($query))
		{
			$err="Username Not found !!";
			$pw="";
		}
		else
		{
			$query="select * from users where password='$pw' and (username='$un' or email='$un' or phone='$un')";
			$query=mysqli_query($db,$query);
			if(!mysqli_num_rows($query))
			{
				$err="Incorrect Password !!";
				$pw="";
			}
			else
			{
				$query=mysqli_fetch_array($query);
				if($query['active'])
				{
					$err="Account Inactive !! Check Email";
					$pw="";
				}
				else
				{
					if(isset($_POST['logged']))
					{
						setcookie('user[0]',$un,time()+86400*30,"/");
						setcookie('user[1]',$pw,time()+86400*30,"/");
					}
					$un="select id from users where username='$un' or email='$un' or phone='$un'";
					$un=mysqli_query($db,$un);
					$un=mysqli_fetch_array($un);
					$un=$un['id'];
					session_start();
					$_SESSION['user']=$un;
					header('location:index.php');
				}
			}
		}
	}
?>
<html>
	<head>
		<title>Login Account</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
		<script src="scripts/login.js"></script>
	</head>
	<body>
		<div class="loginbox">
			<img src="images/images.png" class="avatar">
			<form name="logging" method="post" onSubmit="return check()">
				<p>Username/email/phone</p>
				<input type="text" name="user" value="<?php echo $un?>" placeholder="Enter Login" maxlength="30">
				<p>Enter Password</p>
				<input type="password" name="password" value="<?php echo $pw?>" placeholder="Enter Password" maxlength="30">
				<?php
					if($db)
					{
						?>
						<input type="submit" value="Login" name="login">
						<button type="button" onClick="window.location.href = 'register.php';">Register</button>
						<?php
					}
					else
					{
						?>
						<input disabled type="submit" value="Login" name="login">
						<button type="button" onClick="window.location.href = 'register.php';">Register</button>
						<?php
					}
				?>
				<button type="button" onClick="window.location.href = 'crosszero.php';">Play Offline</button>
				<p><a href="index.php?guest=true">Login As Guest</a>&nbsp;&nbsp;<a href="reset.php">Forgot Password</a></p><br>
				<p>Keep me logged in<input type="checkbox" name="logged"></p>
				<p align="center">
					<?php echo $err;?>
				</p>
			</form>
        </div>
	</body>
</html>