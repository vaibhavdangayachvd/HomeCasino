<?php
	error_reporting(0);
	require "includes/check_login.php";
	if(isset($_SESSION['guest']))
		header('location:index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Coins Pack</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Trendy Cart Widget Template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />


<link href="css/main.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/coinrate.css" rel="stylesheet" type="text/css" media="all" />  
<script src="js/modernizr.js"></script> 
</head>
<body>
<div class="wrap-w3ls">
	<h1 class="cart-w3ls">Coins Pack</h1>
     <section id="example">
		<div class="content-grid-agileits">
			<form action="checkout.php" method="post">
				<input type="hidden" name="pack" value="10">
				<fieldset>
					<img src="images/2.jpg" alt="">
					<p><a href="#">10,000 coins</a></p>
					<ul>
						<li> <del>25.00 Rs.</del></li>
						<li> <span>10.00 Rs</span></li>
					</ul>
					<div class="item-interaction">
					<button type="submit"><img src="images/cart.png"  class="cart-agile"></button>
					</div> 
				</fieldset>
			</form>
		</div>
		<div class="content-grid-agileits">
			<form action="checkout.php" method="post">
				<input type="hidden" name="pack" value="50">
				<fieldset>
					<img src="images/2.jpg" alt="">
					<p><a href="#">1 Million Coins</a></p>
					<ul>
						<li> <del>90.00 Rs</del></li>
						<li> <span>50.00 Rs</span></li>
					</ul>
					<div class="item-interaction">
						<button type="submit"><img src="images/cart.png"  class="cart-agile"></button>
					</div> 
				</fieldset>
			</form>
		</div>
		<div class="content-grid-agileits">
			<form action="checkout.php" method="post">
				<input type="hidden" name="pack" value="100">
				<fieldset>
					<img src="images/2.jpg" alt="">
					<p><a href="#">10 Million Coins</a></p>
					<ul>
						<li> <del>250.00 Rs</del></li>
						<li> <span>100.00 Rs</span></li>
					</ul>
					<div class="item-interaction">
						<button type="submit"><img src="images/cart.png"  class="cart-agile"></button>
					</div> 
				</fieldset>
			</form>	
		</div>
		<div class="clear"> </div>
	</section>
</div>   


<p class="footer-class">© <?php echo date('Y')?> Home casino. All Rights Reserved | Maintained by: Vaibhav Dangayach & Vishal Khandelwal
 </p>
</body>
</html>
