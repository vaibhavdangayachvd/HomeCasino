<?php
	error_reporting(0);
	$err="";
	if(isset($_GET['reset']))
	{
		require 'includes/connection.php';
		$em=$_GET['email'];
		$query="select password from users where email='$em'";
		$query=mysqli_query($db,$query);
		if(!mysqli_num_rows($query))
			$err="Email not found !!";
		else
		{
			$query=mysqli_fetch_array($query);
			$pw=$query['password'];
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
            $mail->addAddress($em,'User'); // Set the recipient of the message.
            $mail->Subject = 'Home Casino - Reset Password'; // The subject of the message.
            $bd="Here you can reset password for Home Casino! Please click the link below to reset your password.<br><br>";
			$tmp="https://homecasino.ml/changepass.php?id=".$em."&pw=".$pw;
			$bd.="<a href=".$tmp.">".$tmp."</a><br><br>";
            $bd.="Happy playing!<br>Team HomeCasino";
			$mail->Body = $bd;
			if ($mail->send())
			{
				$err="Verification Mail Sent Successfully";
				header('refresh:5;url=login.php');
			}
			else
				$err="Could not send verification mail";
		}
	}
?>
<html>
	<head>
		<title>Reset Password</title>
	</head>
	<body>
		<form method="get">
			<p>Enter Email</p>
			<input type="text" name="email" value="" placeholder="Enter Email" required><br><br>
			<input type="submit" value="Reset Password" name="reset"><br>
			<input disabled type="text" value="<?php echo $err;?>" size="30">
		</form>
	</body>
</html>