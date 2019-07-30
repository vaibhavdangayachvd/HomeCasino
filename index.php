<?php
	error_reporting(0);
	require 'includes/check_login.php';
	require 'includes/connection.php';
	$target=200;
	$curr = mysqli_query($db,'SELECT SUM(amount) as value_sum FROM transactions where success=1'); 
	$curr = mysqli_fetch_array($curr); 
	$curr = $curr['value_sum']==NULL?0:$curr['value_sum'];
	if(isset($_SESSION['user']))
	{
		$name=$_SESSION['user'];
		$query="select first,ref_id from users where id='$name'";
		$query=mysqli_query($db,$query);
		$query=mysqli_fetch_array($query);
		$name=$query['first'];
		$reff=$query['ref_id'];
	}
	else
	{
		$name="Guest";
		$reff="Not available";
	}
	if(isset($_POST['submit']))
	{
		$nm=$_POST['person'];
		$email=$_POST['email'];
		$message=$_POST['message'];
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
		$mail->setFrom($email, $nm); // Set the sender of the message.
		$mail->addAddress('admin@homecasino.ml', 'Home Casino'); // Set the recipient of the message.
		$mail->Subject = 'Feedback from '.$nm; // The subject of the message.
		$bd="Name : ".$nm."<br>Email : ".$email."<br><br><p>".$message."</p>";
		$mail->Body = $bd;
		$mail->send();
	}
?>

<html lang="zxx">
   <head>
      <title>Home casino entertainment| Home :: w3layouts</title>
      <!--meta tags -->
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords" content="Hookah Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
         Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
      <script>
         addEventListener("load", function () {
         	setTimeout(hideURLbar, 0);
         }, false);
         
         function hideURLbar() {
         	window.scrollTo(0, 1);
         }
      </script>
      <!--//meta tags ends here-->
      <!--booststrap-->
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
      <!--//booststrap end-->
      <!-- font-awesome icons -->
      <link href="css/font-awesome.min.css" rel="stylesheet">
      <!-- //font-awesome icons -->
      <!--gallery-->
      <link rel="stylesheet" href="css/lightbox.css">
      <!--//gallery-->
      <!--stylesheets-->
      <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
   <link rel="icon" type="image/jpg" href="images/favixon.png">
   </head>
   
   <div class="header-outs" id="header">
      <!-- headder -->
      <div class="header-most-top">
         <div class="one-headder">
            <div class="container-fluid">
               <div class="row left-indus-icons RWDpagescrollfix">
                  <div class="col-lg-5 col-md-5 col-sm-4 pr-0 headder-icons">
                     <ul>
                        <li>
                           <h4> Follow Us :</h4>
                        </li>
                        <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-rss"></span></a></li>
                        <li><a href="#"><span class="fa fa-vk"></span></a></li>
                     </ul>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-8 email-call ">
                     <ul>
                        <li class="pl-lg-3 pl-2">
							<?php echo "<b>Referral Code(Free 1000 Coins) : ".$reff." || Current Site Payments : ".$curr."rs | Our Target : ".$target."rs ||</b>";?>
							<h4>Logged In As :</h4>
							<p><?php echo $name;?></p>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="headder-nav-icon pagescrollfix">
            <div class="container-fluid">
               <div class="nav-headder-top">
                  <!--//navigation section -->
                  <nav class="navbar navbar-expand-lg navbar-light pagescrollfix">
                     <div class="hedder-up">
                        <h1><a class="navbar-brand" href="index.php">Home casino</a></h1>
                     </div>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav ">
                           <li class="nav-item active">
                              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                           </li>
						   <li class="nav-item">
                              <a href="buycoins.php" class="nav-link">Buy Coins</a>
                           </li>
                           <li class="nav-item">
                              <a href="#games" class="nav-link scroll">Games</a>
                           </li>
                           
                          <li class="nav-item">
                              <a href="#leaderboard" class="nav-link scroll">Leaderboard</a>
                           </li>
						   
                           <li class="nav-item">
                              <a href="#team" class="nav-link scroll">Team</a>
                           </li>
                           <li class="nav-item">
                              <a href="#contact" class="nav-link scroll">Contact</a>
                           </li>
                            <li class="nav-item">
                              <a href="logout.php" class="nav-link">Logout</a>
                           </li>
                          

                          
                        </ul>
                     </div>
                  </nav>
               </div>
               <div class="clearfix"> </div>
            </div>
         </div>      </div>

      <!-- //Navigation -->
      <!-- //header -->
      <!-- Slideshow 4 -->
      <div class="slider">
         <div class="callbacks_container">
            <ul class="rslides" id="slider4">
               <li>
                  <div class="slide-img one-img">
                     <div class="container">
                        <div class="slide-info text-center">
                           <h5>Welcome To Our HOME CASINO</h5>
                           <div class="slide-info-txt">
                              <p>Play the games on our site which you used to play in your childhood also get reward for playing </p>
                           </div>
                           <div class="two-mid-button d-flex justify-content-center mt-lg-5 mt-md-4 mt-sm-4 mt-3">
                              <div class="read-buttn ">
                                 <a href="#about" class=" scroll">About Us</a>
                              </div>
                              <div class="view-buttn">
                                 <a href="#contact" class=" scroll">Mail us</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
               <li>Play exciting games you use to play in childhood
                  <div class="slide-img two-img text-center">
                     <div class="container">
                        <div class="slide-info ">
                           <h5>Welcome To Our Home casino</h5>
                           <div class="slide-info-txt">
                              <p>
                              </p>
                           </div>
                           <div class="two-mid-button d-flex justify-content-center mt-lg-5 mt-md-4 mt-sm-4 mt-3">
                              <div class="read-buttn ">
                                 <a href="#about" class=" scroll">About Us</a>
                              </div>
                              <div class="view-buttn">
                                 <a href="#contact" class=" scroll">Mail Us</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
         <!-- This is here just to demonstrate the callbacks -->
         <!-- <ul class="events">
            <li>Example 4 callback events</li>
            </ul>-->
         <div class="clearfix"></div>
      </div>
   </div>
   <!-- //banner -->
   <!--about -->
   <section class="about py-lg-4 py-md-3 py-sm-3 py-3" id="about">
      <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
         <h3 class="title text-center mb-2">About Us</h3>
         <div class="title-wls-text text-center mb-2">
            <p>We are the savior of your childhood games.
            </p>
         </div>
         <div class="title-img text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">
            <img src="images/aa1.png" alt="" class="img-fluid">
         </div>
         <div class="row">
            <div class="col-lg-6 col-md-8 left-abut-txt ">
               <div class="row mb-md-4 mb-3 abut-right-w3layouts">
                  <div class="col-lg-2 col-md-2 col-sm-2 about-icon-left p-sm-0">
                     <span class="fa fa-thumbs-o-up" aria-hidden="true"></span>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 pl-sm-0">
                     <div class="abut-bottom-w3pvt py-sm-3 py-2">
                        <h4>Heads and tails</h4>
                     </div>
                  </div>
                  <p class="mt-2 text-left">played using a coin and u have to make a guess</p>
               </div>
               <div class="row mb-md-4 mb-3 abut-right-w3layouts">
                  <div class="col-lg-2 col-md-2 col-sm-2 about-icon-left p-sm-0">
                     <span class="fa fa-check" aria-hidden="true"></span>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 pl-sm-0">
                     <div class="abut-bottom-w3pvt py-sm-3 py-2">
                        <h4>7 Ups 7 Down</h4>
                     </div>
                  </div>
                  <p class="mt-2 ">guess the number</p>
               </div>
               <div class="row abut-right-w3layouts">
                  <div class="col-lg-2 col-md-2 col-sm-2 about-icon-left p-sm-0">
                     <span class="fa fa-check" aria-hidden="true"></span>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 pl-sm-0">
                     <div class="abut-bottom-w3pvt py-sm-3 py-2">
                        <h4>Traditional cross zero</h4>
                     </div>
                  </div>
                  <p class="mt-2 text-left">easiest game ever</p>
               </div>
            </div>
            <div class="col-lg-6 col-md-4 video-info-img text-center">
               <div class="abut-img-w3l">
                  <img src="images/ab1.png" alt="" class="img-fluid">
               </div>
            </div>
         </div>
         <!-- //row-two -->
      </div>
   </section>
   <!--//about -->
   <!-- service -->
   <section class="service py-lg-4 py-md-3 py-sm-3 py-3" id="games">
      <div class="container  py-lg-5 py-md-4 py-sm-4 py-3">
         <h3 class="title clr text-center mb-2">Our Games</h3>
         <div class="title-wls-text text-center mb-2">
            <p class="text-light">Easiest and exciting games that you will love definately</p>
         </div>
         <div class="title-img text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">
            <img src="images/aa1.png" alt="" class="img-fluid">
         </div>
         <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 service-wthree-grid">
               <div class="grid">
                  <figure class="effect-goliath">
                     <img src="images/s1.jpg" alt="" class="img-fluid">
                     <figcaption>
                        <h4><span>7up7Down</span></h4>
                        <p>Play for fun</p>
                     </figcaption>
                  </figure>
                  <div class="ser-para-w3layouts ">
                     <div class="view-buttn">
                        <a href="updown.php">Play Now</a>
                     </div>
                     <p>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 service-wthree-grid">
               <div class="grid">
                  <figure class="effect-goliath">
                     <img src="images/s2.jpg" alt="" class="img-fluid">
                     <figcaption>
                        <h4><span>Stone Paper Scissor</span></h4>
                        <p>play for fun</p>
                     </figcaption>
                  </figure>
                  <div class="ser-para-w3layouts ">
                     <div class="view-buttn">
                        <a href="stonepaper.php">Play Now</a>
                     </div>
                     <p>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 service-wthree-grid">
               <div class="grid">
                  <figure class="effect-goliath">
                     <img src="images/s3.jpg" alt="" class="img-fluid">
                     <figcaption>
                        <h4><span>Head Tail</span></h4>
                        <p>Play for fun</p>
                     </figcaption>
                  </figure>
                  <div class="ser-para-w3layouts ">
                     <div class="view-buttn">
                        <a href="headtail.php">play Now</a>
                     </div>
                     <p>
                  </div>
               </div>
            </div>
           
                     <p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- //service -->
   <!-- timings -->
   <section class="timings pt-lg-4 pt-md-3 pt-sm-3 pt-3" id="leaderboard">
      <div class="container pt-lg-5 pt-md-4 pt-sm-4 pt-3">
         <h3 class="title text-center mb-2">Leaderboard</h3>
         <div class="title-wls-text text-center mb-2">
            <p>Scoreboard showing the names and current score of top players</p>
         </div>
         <div class="title-img text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">
            <img src="images/aa1.png" alt="" class="img-fluid">
         </div>
      </div>
      <div class="timings-hours">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 ">
                  <div class="wls-hours-list">
                    <table align="center" border="2">
						<tr align="center">
							<th colspan="3"><u>Winners get Netflix/Spotify every Monday<u></th>
						</tr>
						<tr align="center">
							<th><u>Rank</u></th>
							<th><u>Username<u></th>
							<th><u>Coin Balance<u></th>
						</tr>
						<?php
							$query="select username,balance from users where username<>'vaibhavdangayachvd' and username<>'vishalvk14' order by balance desc limit 10";
							$query=mysqli_query($db,$query);
							$count=0;
							while($row=mysqli_fetch_array($query))
							{
								?>
								<tr>
									<td align="center"><?php echo ++$count;?></td>
									<td align="center"><?php echo $row['username']?></td>
									<td align="center"><?php echo $row['balance']?></td>
								</tr>
								<?php
							}
						?>
                    </table>
                     <div class="timings-details text-center mt-lg-5 mt-md-4 mt-3">
                        <h4 style="color:black;">Enjoy Your game</h4>
                        <div class="view-buttn mt-3">
                           <a href="#games" class=" scroll">Play Now</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <img src="images/smkk.png" alt="" class="img-fluid">
               </div>
            </div >
         </div >
      </div >
   </section>
   
   
   <!-- team -->
   <section class="team py-lg-4 py-md-3 py-sm-3 py-3" id="team">
      <div class="container  py-lg-5 py-md-4 py-sm-4 py-3">
         <h3 class="title text-center mb-2">Our Crews</h3>
         <div class="title-wls-text text-center mb-2">
            <p>The guys who made this website</p>
         </div>
         <div class="title-img text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">
            <img src="images/aa1.png" alt="" class="img-fluid">
         </div>
         <!-- Hover Effect Style : Demo - 13-->
         <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 team-gird-list">
               <div class="box13 text-center">
                  <img src="images/t1.jpg" alt="" class="img-fluid">
                  <div class="box-content">
                     <h4 class="title-team">Vaibhav Dangayach</h4>
                     <span class="post">Developer</span>
                     <ul class="social">
                        <li><a href="#"><span class="fa fa-facebook text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-rss text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-vk text-center"></span></a></li>
                     </ul>
                  </div>
               </div>
               <div class="team-grid text-center mt-lg-4 mt-3">
                  <h4>Vaibhav Dangayach</h4>
                  <h5 class="pt-2 mb-1">Developer</h5>
                  <p class="pt-2">Backend developer of our website</p>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 team-gird-list">
               <div class="box13 text-center">
                  <img src="images/t2.jpg" alt="" class="img-fluid">
                  <div class="box-content">
                     <h4 class="title-team">Vishal Khandelwal</h4>
                     <span class="post">Developer</span>
                     <ul class="social">
                        <li><a href="#"><span class="fa fa-facebook text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-rss text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-vk text-center"></span></a></li>
                     </ul>
                  </div>
               </div>
               <div class="team-grid text-center mt-lg-4 mt-3">
                  <h4>Vishal Khandelwal</h4>
                  <h5 class="pt-2 mb-1">Developer</h5>
                  <p class="pt-2">Front end developer of our website</p>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 team-gird-list">
               <div class="box13 text-center">
                  <img src="images/t3.jpg" alt="" class="img-fluid">
                  <div class="box-content">
                     <h4 class="title-team">Vaibhav Dangayach</h4>
                     <span class="post">Owner</span>
                     <ul class="social">
                        <li><a href="#"><span class="fa fa-facebook text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-rss text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-vk text-center"></span></a></li>
                     </ul>
                  </div>
               </div>
               <div class="team-grid text-center mt-lg-4 mt-3">
                  <h4>Vaibhav Dangayach</h4>
                  <h5 class="pt-2 mb-1">Owner</h5>
                  <p class="pt-2">Also the owner of the website</p>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 team-gird-list">
               <div class="box13 text-center">
                  <img src="images/t4.jpg" alt="" class="img-fluid">
                  <div class="box-content">
                     <h4 class="title-team">Vishal khandelwal</h4>
                     <span class="post">Owner</span>
                     <ul class="social">
                  
                     
                        <li><a href="#"><span class="fa fa-facebook text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-rss text-center"></span></a></li>
                        <li><a href="#"><span class="fa fa-vk text-center"></span></a></li>
                     </ul>
                  </div>
               </div>
               <div class="team-grid text-center mt-lg-4 mt-3">
                  <h4>Vishal Khandelwal</h4>
                  <h5 class="pt-2 mb-1">Owner</h5>
                  <p class="pt-2">Also the owner of website</p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- //team -->
   <!-- gallery -->
   <!--//gallery -->
   <!-- gallery -->
   <!-- offers -->
   <!--//offers -->
   <!--price-table -->
   
   <!--//price-table -->
   <!--blog -->
   <!--//price-table -->
      <section class="contact py-lg-4 py-md-3 py-sm-3 py-3" id="contact">
      <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
         <h3 class="title text-center mb-2">Contact Us</h3>
         <div class="title-wls-text text-center mb-2">
            <p>Send us your feedbacks and queries related to our websitr we will get back to you soon</p>
         </div>
         <div class="title-img text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">
            <img src="images/aa1.png" alt="" class="img-fluid">
         </div>
         <div class="contact-details">
            <form method="post">
               <div class="row">
                  <div class="col-lg-4 ">
                     <div class=" form-group contact-forms">
                        <input name="person" type="text" class="form-control" placeholder="Name" required="">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group contact-forms">
                        <input name="email" type="email" class="form-control" placeholder="Email" required="">
                     </div>
                  </div>
               </div>
               <div class="form-group contact-forms">
                  <textarea name="message" class="form-control" placeholder="Message" rows="3" required=""></textarea>
               </div>
               <button name="submit" type="submit" class="btn text-center sent-butnn">Send</button>
            </form>
         </div>
      </div>
   </section>
   <!--//contact -->
   <!-- footer -->
   <footer class="py-lg-4 py-md-3 py-sm-3 py-3">
      <div class="container py-lg-5 py-md-5 py-sm-4 py-4 text-center">
         <div class="footer-headder mb-lg-4 mb-3">
            <div class="title-img text-center mb-2">
               <img src="images/logo.png" alt="" class="img-fluid">
            </div>
            <h2><a href="index.html">Homecasino</a></h2>
         </div>
         <div class="row address-contact-form">
            <div class=" footer-contact-list col-lg-4 col-md-4">
               <h6 class="mb-3">Address
               </h6>
               <p>1/417 Malviya nagar(302017) jaipur<br>Rajasthan,India
               </p>
            </div>
            <div class="footer-contact-list col-lg-4 col-md-4">
               <h6 class="mb-3">Phone</h6>
               <p>+91 7877480410</p>
               <p>+91 8949555858</p>
            </div>
            <div class="footer-contact-list col-lg-4 col-md-4">
               <h6 class="mb-3">Email</h6>
               <p><a href="mailto:info@example.com">talktovk14@gmail.com</a></p>
               <p><a href="mailto:info@example.com">vaibhavdangayachvd.com</a></p>
            </div>
         </div>
         <div class="bottem-down-footer mt-lg-4 mt-3">
            <p> 
               © <?php echo date('Y');?> Home casino. All Rights Reserved | Maintained by: Vaibhav Dangayach & Vishal Khandelwal
            </p>
         </div>
      </div>
   </footer>
   <!-- //footer -->
   <!--js working-->
   <script src='js/jquery-2.2.3.min.js'></script>
   <!--//js working-->
   <!--Nav script scrollon--> 
   <script>
      $(window).scroll(function() {
          if ($(document).scrollTop() > 150) {
              $('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
          } else {
              $('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
          }
      });
   </script>
   <!--//Nav script scrollon-->
   <!--  light box js -->
   <script src="js/lightbox-plus-jquery.min.js"> </script> 
   <!-- //light box js-->  
   <!--responsiveslides banner-->
   <script src="js/responsiveslides.min.js"></script>
   <script>
      // You can also use "$(window).load(function() {"
      $(function () {
      	// Slideshow 4
      	$("#slider4").responsiveSlides({
      		auto: true,
      		pager:true ,
      		nav:false,
      		speed: 900,
      		namespace: "callbacks",
      		before: function () {
      			$('.events').append("<li>before event fired.</li>");
      		},
      		after: function () {
      			$('.events').append("<li>after event fired.</li>");
      		}
      	});
      
      });
   </script>
   <!--// responsiveslides banner-->	 
   <!--gallery-->
   <script>
      $(document).ready(function(){
      
       $(".filter-button").click(function(){
           var value = $(this).attr('data-filter');
           
           if(value == "all")
           {
               //$('.filter').removeClass('hidden');
               $('.filter').show('1000');
           }
           else
           {
      //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
      //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
               $(".filter").not('.'+value).hide('3000');
               $('.filter').filter('.'+value).show('3000');
               
           }
       });
       
       if ($(".filter-button").removeClass("active")) {
      $(this).removeClass("active");
      }
      $(this).addClass("active");
      
      });
   </script>
   <!--// gallery-->
   <!-- start-smoth-scrolling -->
   <script src="js/move-top.js"></script>
   <script src="js/easing.js"></script>
   <script>
      jQuery(document).ready(function ($) {
      	$(".scroll").click(function (event) {
      		event.preventDefault();
      		$('html,body').animate({
      			scrollTop: $(this.hash).offset().top
      		}, 900);
      	});
      });
   </script>
   <!-- start-smoth-scrolling -->
   <!-- here stars scrolling icon -->
   <script>
      $(document).ready(function () {
      	var defaults = {
      		containerID: 'toTop', // fading element id
      		containerHoverID: 'toTopHover', // fading element hover id
      		scrollSpeed: 1200,
      		easingType: 'linear'
      	};
      	$().UItoTop({
      		easingType: 'easeOutQuart'
      	});
      
      });
   </script>
   <!-- //here ends scrolling icon -->
   <!--bootstrap working-->
   <script src="js/bootstrap.min.js"></script>
   <!-- //bootstrap working-->
   </body>
</html>