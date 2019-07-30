<?php
	error_reporting(0);
	$fn=$ln=$un=$pw=$em=$ph="";
	require 'includes/connection.php';
	if(!$db)
		$err="Not Connected To Database";
	else 
		$err="Connected To Database";
	if(isset($_POST['register']) && $db)
	{
		$fn=$_POST['first'];
		$ln=$_POST['last'];
		$un=$_POST['username'];
		$pw=$_POST['password'];
		$em=$_POST['email'];
		$ph=$_POST['phone'];
		$gen=$_POST['gender'];
		
		$chkuser="select * from users where username='$un'";
		$chkemail="select * from users where email='$em'";
		$chkphone="select * from users where phone='$ph'";
		
		$chkuser=mysqli_query($db,$chkuser);
		$chkemail=mysqli_query($db,$chkemail);
		$chkphone=mysqli_query($db,$chkphone);
		
		
		if(mysqli_num_rows($chkuser)>0)
			$err="Username Already Exist !!";
		else if(mysqli_num_rows($chkemail)>0)
			$err="Email Already Exist !!";
		else if(mysqli_num_rows($chkphone)>0)
			$err="Mobile Already Exist !!";
		else
		{
			//If user has referral code
			if(isset($_POST['ref']))
			{
				$ref=$_POST['ref'];
				$query="select id from users where ref_id='$ref'";
				$query=mysqli_query($db,$query);
				//If code is incorrect correct
				if(!mysqli_num_rows($query))
				{
					$err="Invalid Referral Code !!";
					goto last;
				}
			}
			//For Verification Mail
			$rnd=rand(1,9);
            require 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
			$mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
            $mail->Port = 587; // Which port to use, 587 is the default port for TLS security.
            $mail->SMTPSecure = 'tsl'; // Which security method to use. TLS is most secure.
            $mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
            $mail->IsHTML(true);
            $mail->Username = "amitbhadanakg@gmail.com"; // Your Gmail address.
            $mail->Password = "9314702277"; // Your Gmail login password or App Specific Password
            $mail->setFrom('amitbhadanakg@gmail', 'Home Casino'); // Set the sender of the message.
            $mail->addAddress($em, $fn); // Set the recipient of the message.
            $mail->Subject = 'Home Casino - Please confirm your email address.'; // The subject of the message.
            $bd="Thanks for signing up for Home Casino! Please click the link below to confirm your email address.<br><br>";
			$tmp="https://homecasino.ml/verify.php?id=".$em."&pw=".sha1($rnd);
			$bd.="<a href=".$tmp.">".$tmp."</a><br><br>";
            $bd.="Happy playing!<br>Team HomeCasino";
			$mail->Body = $bd;
			if ($mail->send()) //If sent successfully
            {
				//Insert Data
				$pw=sha1($pw);
				if(isset($_POST['ref']))
					$query="insert into users(active,first,last,username,password,email,phone,gender,balance) values($rnd,'$fn','$ln','$un','$pw','$em','$ph','$gen',2000)";
				else
					$query="insert into users(active,first,last,username,password,email,phone,gender,balance) values($rnd,'$fn','$ln','$un','$pw','$em','$ph','$gen',1000)";
				mysqli_query($db,$query);
				$query="select id from users where username='$un'";
				$query=mysqli_query($db,$query);
				$query=mysqli_fetch_array($query);
				$id=$query['id'];
				//If user has referral code
				if(isset($_POST['ref']))
				{
					$query="insert into referrals(ref_id,user_id,active)values('$ref',$id,0)";
					mysqli_query($db,$query);
				}
				//For Creating Referral Code
				$ref=strtoupper(substr($fn,0,3).$id.substr(sha1(rand(0,1000)),0,2));
				$query="update users set ref_id='$ref' where id=$id";
				$query=mysqli_query($db,$query);
				$err="Check Inbox(or Spam) for Verification Link";
				$pw="";
            } 
            else
			{
				$err="Verification link couldn't be sent to email.";
				$pw="";
			}
		}//End of else(when details are correct)
	}//End of Submit Button Click Event 
	last:
?>
<html>
	<head>
		<title>Register Account</title>
	
        <link rel="stylesheet" type="text/css" href="css/register.css">
        	<script src="scripts/register.js"></script>
	</head>
	<body>
		<div class="register">
			<fieldset>
				<legend align="center">Create new user</legend>
				<form name="registration" method="post" onSubmit="return check();">
					<h1>Enter Details</h1>
					<p>First Name</p>
					<input type="text" value="<?php echo $fn;?>" name="first" placeholder="Enter First Name" maxlength="15">
					<p>Last Name</p>
					<input type="text" value="<?php echo $ln;?>" name="last" placeholder="Enter Last Name" maxlength="15">
					<p>Username</p>
					<input type="text" value="<?php echo $un;?>" name="username" placeholder="Choose Username" maxlength="30">
					<p>Password</p>
					<input type="password" value="<?php echo $pw;?>" name="password" placeholder="Enter Password" maxlength="30">
					<p>Re-Password</p>
					<input type="password" value="<?php echo $pw;?>" name="rpassword" placeholder="ReEnter Password" maxlength="30">
					<p>Email</p>
					<input type="text" value="<?php echo $em;?>" name="email" placeholder="Enter Email Address" maxlength="30">
					<p>Mobile</p>
					<input type="text" value="<?php echo $ph;?>" name="phone" placeholder="Enter Mobile Number" maxlength="10">
					<p class="para">Gender</p><br>
					<input type="radio" name="gender" value="male"><font color="white" size="4">Male</font>
					<input type="radio" name="gender" value="female"><font color="white" size="4">Female</font>
					<p>Have Referral Code?</p>
					<input type="text" name="ref" placeholder="Enter referral code (optional)">
					<p align="center">
						<?php 
							if($db)
								echo'<input type="submit" value="Create Account" name="register">';
							else
								echo'<input disabled type="submit" value="Create Account" name="register">';
						?>
						<input type="button" value="Login" onClick="window.location.href='login.php'">
					</p>
					<p align="center">
						<?php echo $err;?>
					</p>
				</form>
			</fieldset>
		</div>
	</body>
</html>