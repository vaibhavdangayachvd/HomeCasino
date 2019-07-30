<?php
	error_reporting(0);
	require 'includes/check_login.php';
	$pr=$_POST['pack'];
	switch($pr)
	{
	case 10:
		$nm="Coin Pack 1";
		$coins="10,000";
		break;
	case 50:
		$nm="Coin Pack 2";
		$coins="1,000,000";
		break;
	case 100:
		$nm="Coin Pack 3";
		$coins="10,000,000";
		break;
	default:
		header('location:buycoins.php');
	}
	$oid="ORDS" . rand(10000,99999999);
	$cid=$_SESSION['user'];
?>
<html>
	<head>
		<title>Checkout</title>
        <link type="text/css" rel="stylesheet" href="css/checkout.css">

        

	</head>
	<body>
		<h1>Order Check Out</h1>
        
		<form method="post" action="paytm/pgRedirect.php">
			<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"name="ORDER_ID" autocomplete="off"value="<?php echo $oid; ?>">
			<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $cid; ?>">
			<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
			<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
			<input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $pr; ?>">
			<table align="center">
				<tr>
					<th>S.No</th>
					<th>Label</th>
					<th>Value</th>
				</tr>
				<tr>
					<td>1</td>
					<td>Pack Name</td>
					<td><?php echo $nm;?></td>
				</tr>
				<tr>
					<td>2</td>
					<td>Coins</td>
					<td><?php echo $coins;?></td>
				</tr>
				<tr>
					<td>3</td>
					<td>Price</td>
					<td><?php echo $pr." rs";?></td>
				</tr>
				<tr align="center">
					<td colspan="3">
						<input value="CheckOut" type="submit"	onclick="">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>