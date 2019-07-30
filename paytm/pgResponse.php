<?php
error_reporting(0);
require '..//includes/check_login.php';
require '..//includes/connection.php';
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

$oid=$_POST['ORDERID'];
$amt=$_POST['TXNAMOUNT'];
$uid=$_SESSION['user'];
if($isValidChecksum == "TRUE") {

	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		echo "Order ID : ".$_POST['ORDERID']."<br>";
		echo "Amount Paid : ".$_POST['TXNAMOUNT']."<br>";
		switch($_POST['TXNAMOUNT'])
		{
		case 10:
			$coins=10000;
			break;
		case 50:
			$coins=1000000;
			break;
		case 100:
			$coins=10000000;
			break;
		default:
			$coins=0;
			echo "Coins are not added !! Hacker Got Punished -_- !!";
		}
		$query="select balance from users where id=$uid";
		$query=mysqli_query($db,$query);
		$query=mysqli_fetch_array($query);
		$coins+=$query['balance'];
		$query="update users set balance=$coins where id=$uid";
		mysqli_query($db,$query);
		$query="insert into transactions (oid,uid,amount,success) values('$oid',$uid,$amt,1)";
		mysqli_query($db,$query);
		header( "refresh:5;url=..//index.php" );
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failed !!</b>" . "<br/>";
		$query="insert into transactions (oid,uid,amount,success) values('$oid',$uid,$amt,0)";
		mysqli_query($db,$query);
		header( "refresh:2;url=..//index.php" );
	}
}
else {
	echo "<b>Checksum mismatched.</b>";
	$query="insert into transactions (oid,uid,amount,success) values('$oid',$uid,$amt,2)";
	mysqli_query($db,$query);
	header( "refresh:2;url=..//index.php" );
	//Process transaction as suspicious.
}

?>