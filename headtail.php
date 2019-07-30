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
	if(isset($_REQUEST['head']) || isset($_REQUEST['tail']))
	{
		$bet=$_REQUEST['bet'];
		if($bet<=$bal)
		{
			$res=rand(0,1);
			if(($res && isset($_REQUEST['tail'])) || (!$res && isset($_REQUEST['head'])))
			{
				$bal+=$bet;
				$res="You Win ".$bet." Coins :)";
				$res=array($res,1);
			}
			else
			{
				$bal-=$bet;
				$res="You Lose ".$bet." Coins :(";
				$res=array($res,0);
			}
			if(isset($_SESSION['guest']))
				$_SESSION['guest']=$bal;
			else
			{
				$query="update users set balance=$bal where id='$ssn'";
				mysqli_query($db,$query);
			}
		}
		else
		{
			$res="You Don't Have Enough Coin Balance";
			$res=array($res,0);
		}
	}
?>
<html>
	<head>
		<title>Head Tails</title>
		<script src="scripts/betting.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/headtail.css">
      
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
    
    <div class="row no-gutters" >
      <div class="col-md-6 no-gutters">
        <div class="leftside">
		<h1><u>Play Head Tails</u></h1>
		<h2><u>Steps to play :-</u></h2>
		<ol>
			<li>Choose a bet between 50 to 25 Lakh</li>
			<li>Choose Between Head and Tail</li>
			<li>Click To Play</li>
		</ol>
		<h2><u>Prize:-</u></h2>
		<p>If you win, you will get double the amount you betted</p>
        </div>
        </div>
        <div class="col-md-6 no-gutters">
        <div class="rightside">
        
		                 
			<fieldset>
			<form method="post" name="betting" onSubmit="return check()">
				<?php
					if($res[1]){
						?>
						<br><input style="border:0;background-color:white;font-weight:bold;color:green;width:250px;" disabled type="text" value="<?php echo $res[0];?>" name="result"><br><br>
						<?php
					}
					else{
						?>
						<br><input style="border:0;background-color:white;font-weight:bold;color:red;width:250px;" disabled type="text" value="<?php echo $res[0];?>" name="result"><br><br>
						<?php
					}
				?>
                <fieldset>
				<p>Coin Balance&nbsp;<img src="images/index.png"><input disabled type="text" value="<?php echo $bal;?>" name="balance" > <br><br>
				<p>Current Bet&nbsp;<input disabled type="text" value="0" name="bet"></p>
				<input style="border:0;background-color:white;color:red;width:250px;" disabled type="text" value="" name="notification">&nbsp;
				<input class="b1" type="button" value="Reset" onClick="reset_bet()"><br><br>
				<input class="b2" type="button" value="50" onClick="increase_bet(50)">&nbsp;&nbsp;
				<input class="b2" type="button" value="100" onClick="increase_bet(100)">&nbsp;&nbsp;
				<input class="b2" type="button" value="500" onClick="increase_bet(500)">&nbsp;&nbsp;
				<input class="b2" type="button" value="2500" onClick="increase_bet(2500)"><br><br>&nbsp;&nbsp;
				<input class="b2" type="button" value="10000" onClick="increase_bet(10000)">&nbsp;&nbsp;
				<input class="b2" type="button" value="50000" onClick="increase_bet(50000)">&nbsp;&nbsp;
				<input class="b2" type="button" value="100K" onClick="increase_bet(100000)">&nbsp;&nbsp;
				<input class="b2" type="button" value="200K" onClick="increase_bet(200000)"><br><br>
				<input class="b2" type="button" value="500K" onClick="increase_bet(500000)">&nbsp;&nbsp;
				<input class="b2" type="button" value="1M" onClick="increase_bet(1000000)">&nbsp;&nbsp;
				<input class="b2" type="button" value="2M" onClick="increase_bet(2000000)">&nbsp;&nbsp;
				<input class="b2"  type="button" value="4M" onClick="increase_bet(4000000)"><br><br>
				<input class="b2" type="button" value="10M" onClick="increase_bet(10000000)">&nbsp;&nbsp;
				<input class="b2" type="button" value="15M" onClick="increase_bet(15000000)">&nbsp;&nbsp;
				<input class="b2" type="button" value="25M" onClick="increase_bet(25000000)"><br><br>
				<p >Choose Head or Tail:
				<input class="b1" type="submit" value="Head" name="head"> <input class="b1" type="submit" value="Tail" name="tail"></p>
			</div>
            </div>
            </div>
            </fieldset>
            </form>
		</fieldset>
	</body>
</html>