<?php
	error_reporting(0);
	require 'includes/check_login.php';
	require 'includes/connection.php';
	$res=array("","");
	if(isset($_SESSION['guest']))
		$bal=$_SESSION['guest'];
	else
	{
		$ssn = $_SESSION['user'];
		$query="select balance from users where id='$ssn'";
		$bal=mysqli_query($db,$query);
		$bal=mysqli_fetch_array($bal);
		$bal=$bal['balance'];
	}
	if(isset($_REQUEST['up']) || isset($_REQUEST['down']))
	{
		$bet=$_REQUEST['bet'];
		if($bet<=$bal)
		{
			$res=rand(1,6);
			$res+=rand(1,6);
			if(($res>7 && isset($_REQUEST['up'])) || ($res<7 && isset($_REQUEST['down'])))
			{
				$bal+=$bet;
				$res="Output : ".$res." - You Win ".$bet." Coins :)";
				$res=array($res,1);
			}
			else
			{
				$bal-=$bet;
				$res="Output : ".$res." - You Lose ".$bet." Coins :(";
				$res=array($res,0);
			}
			if(isset($_SESSION['guest']))
				$_SESSION['guest']=$bal;
			else
			{
				$query="update users set balance=$bal where id='$ssn'";
				mysqli_query($db,$query);
			}
			$query="update users set balance=$bal where id='$ssn'";
			mysqli_query($db,$query);
		}
	}
?>
<html>
	<head>
		<title>7Up7Down</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/stonepaper.css">
  
		<script src="scripts/betting.js"></script>
	</head>
	<body>
    
        <div class="row bgcolor no-gutters">
          <div class="col-md-6">
          </div>
           
          
                <div class="col-md-2">
                <ul><li><a style="color:white" href="#"></a></li></ul>
                </div>
     
              <div class="col-md-2">
              <ul><li><a style="color:white" href="#"></a></li></ul>
              </div>
               <div class="col-md-1">
                <ul><li><a style="color:white" href="index.php">Home</a></li></ul>
                </div>
                <div class="col-md-1">
                <ul><li><a style="color:white" href="logout.php">Logout</a></li></ul>
                </div>
      
    
       </div>
    </div>
    
 
    
    <div class="row no-gutters">
    <div class="col-md-6 no-gutters">
    <div class="leftside">

		<h1>Play 7Up-7Down</h1>
		<h2>Steps to play :-</h2>
		<ol>
			<li>Choose a bet between 50 to 25 Lakh</li>
			<li>Choose Between 7Up and 7Down</li>
			<li>Click To Play</li>
			<li>Two Dices will roll and if you predict correctly you win.</li>
		</ol>
		<h2>Prize</h2>
		<p>If you win, you will get double the amount you betted</p>
        </div>
        </div>
	  <div class="col-md-6 no gutters">
         <div class="rightside">
			<form method="post" name="betting" onSubmit="return check()">
				<?php
					if($res[1]){
						?>
						<br><input id="cd"c style="border:0;background-color:white;font-weight:bold;color:green;width:250px;" disabled type="text" value="<?php echo $res[0];?>" name="result"><br><br>
						<?php
					}
					else{
						?>
						<br><input id="cd" style="border:0;background-color:white;font-weight:bold;color:red;width:250px;" disabled type="text" value="<?php echo $res[0];?>" name="result"><br><br>
						<?php
					}
				?>
				<fieldset>
				<p>Coin Balance&nbsp;<img src="images/index.png"><input disabled type="text" value="<?php echo $bal;?>" name="balance" > <br><br>
				<p>Current Bet&nbsp;<input disabled type="text" value="0" name="bet"></p>
				<input style="border:0;background-color:white;color:red;width:250px;" disabled type="text" value="" name="notification">&nbsp;
				<input class="b1" type="button" value="Reset" onClick="reset_bet()"><br><br>
				<input class="b2" type="button" value="50" onClick="increase_bet(50)">
				<input class="b2" type="button" value="100" onClick="increase_bet(100)">
				<input class="b2" type="button" value="500" onClick="increase_bet(500)">
				<input class="b2" type="button" value="2500" onClick="increase_bet(2500)"><br><br>
				<input class="b2" type="button" value="10000" onClick="increase_bet(10000)">
				<input class="b2" type="button" value="50000" onClick="increase_bet(50000)">
				<input class="b2" type="button" value="100K" onClick="increase_bet(100000)">
				<input class="b2" type="button" value="200K" onClick="increase_bet(200000)"><br><br>
				<input class="b2" type="button" value="500K" onClick="increase_bet(500000)">
				<input class="b2" type="button" value="1M" onClick="increase_bet(1000000)">
				<input class="b2" type="button" value="2M" onClick="increase_bet(2000000)">
				<input class="b2" type="button" value="4M" onClick="increase_bet(4000000)"><br><br>
				<input class="b2" type="button" value="10M" onClick="increase_bet(10000000)">
				<input class="b2" type="button" value="15M" onClick="increase_bet(15000000)">
				<input class="b2" type="button" value="25M" onClick="increase_bet(25000000)"><br><br>
				<p>Choose 7Up or 7Down
				<input class="b1" type="submit" value="7Up" name="up"> <input class="b1" type="submit" value="7Down" name="down">
      </div>
        </div>			</form>
		</fieldset>
	</body>
</html>