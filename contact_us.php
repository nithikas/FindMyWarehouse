<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Conference project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">

</head>
<body>

<div class="super_container">

	<!-- Menu -->

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="main_page.php">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
						<div class="logo_content">
							<div class="logo_text logo_text_not_ie">Find My Warehouse</div>
							<div class="logo_sub"><?php echo "Today is " . date("l, F d, Y"); ?> - West Lafayette, IN</div>
						</div>
					</div>
				</a>
			</div>
			<ul>
				<li><a href="main_page.php">Home</a></li>
				<li><a href="filtering_inputs.php">Warehouses</a></li>
				<li><a href="about_team_page.php">About Us</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="analytics.php">Analytics</a></li>
			</ul>
		</div>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/warehouse7.jpg" data-speed="0.8"></div>

		<!-- Header -->

		<header class="header" id="header">
			<div>
				<div class="header_top">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="header_top_content d-flex flex-row align-items-center justify-content-start">
									<div>
										<a href="main_page.php">
											<div class="logo_container d-flex flex-row align-items-start justify-content-start">
												<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
												<div class="logo_content">
													<div id="logo_text" class="logo_text logo_text_not_ie">Find My Warehouse</div>
													<div class="logo_sub"><?php echo "Today is " . date("l, F d, Y"); ?> - West Lafayette, IN</div>
												</div>
											</div>
										</a>	
								
									<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="header_nav" id="header_nav_pin">
					<div class="header_nav_inner">
						<div class="header_nav_container">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
											<nav class="main_nav">
												<ul>
													<li><a href="main_page.php">Home</a></li>
													<li><a href="filtering_inputs.php">Warehouses</a></li>
													<li><a href="about_team_page.php">About Us</a></li>
													<li class = "active"><a href="contact_us.php">Contact Us</a></li>
													<li><a href="analytics.php">Analytics</a></li>
												</ul>
											</nav>
											<div class="header_extra ml-auto">
												<div class="button header_button"><a href="log_in.php">Log In</a></div>
												<div class="button header_button"><a href="create_account.php">Sign Up</a></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="search_container">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="search_content d-flex flex-row align-items-center justify-content-end">
											<form action="#" id="search_container_form" class="search_container_form">
												<input type="text" class="search_container_input" placeholder="Search" required="required">
												<button class="search_container_button"><i class="fa fa-search" aria-hidden="true"></i></button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</header>

		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content d-flex flex-row align-items-end justify-content-start">
						 <div style="background-color:#4867c0; background-image: linear-gradient(to right, #4867c0, #329fec); text-align:left; vertical-align: middle; padding:20px 47px;">
							<div style="color:white"; class="current_page">Contact Us</div>
							<div class="breadcrumbs ml-auto">
							</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->

	<div class="contact">
		<div class="contact_map_background">

			<!-- Contact Map -->
			<div class="contact_map">
	
	<!-- This is a link to the location of Grissom Hall on Google Maps; we did not create this map ourselves; we just used that link to have it in the background for aesthetic purposes -->
	
				<div class="mapouter"><iframe width="1670" height="750" id="gmap_canvas" src="https://maps.google.com/maps?q=grissom%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><style>.mapouter{text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:1000px;width:1000px;}</style></div>
			</div>
	
	<!-- This is a form where the user can input their information/concern and it is emailed to us so we can respond accordingly. -->
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-xl-4">
					<div class="contact_form_container">
						<div class="contact_form_title">Contact Us!</div><br>
						<form method="post" name="myemailform" action="form-to-email.php">
						<div class="offset-xl-0 col-xl-10" style = "color:white;">Name: <br><input type="text" name="name"></div>
						<br>
						<div class="offset-xl-0 col-xl-10" style = "color:white;">Email Address:   <br> <input type="text" name="email"></div>
						<br>
						<div class="offset-xl-0 col-xl-10" style = "color:white;">Enter Message:  <br><textarea name="message"></textarea></div>
						<br>
						<input type="submit" value=" Send Message " onclick="contact_us.php">
						</form>
	
		<!-- This is a general box/container that contains our company name with more information about us with our Facebook and MySpace page!-->
						
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1 col-xl-6 offset-xl-2">
					<div class="contact_info_container">
						<div>
							<a href="#">
								<div class="logo_container d-flex flex-row align-items-start justify-content-start">
									<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
									<div class="logo_content">
										<div style="font-size: 22px" id="logo_text" class="logo_text logo_text_not_ie">Find My Warehouse</div>
										<div style="font-size: 12px" class="logo_sub"><?php echo "Today is " . date("l, F d, Y"); ?> - West Lafayette, IN</div>
									</div>
								</div>
							</a>	
						</div>
						<div class="contact_info_list_container">
							<ul class="contact_info_list">
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div class="contact_info_icon text-center"><img src="images/contact_1.png" alt=""></div></div>
									<div class="contact_info_text">Grissom Hall, West Lafayette, IN 47906</div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div class="contact_info_icon text-center"><img src="images/contact_2.png" alt=""></div></div>
									<div class="contact_info_text">+1 (630)999-6066</div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div class="contact_info_icon text-center"><img src="images/contact_3.png" alt=""></div></div>
									<div class="contact_info_text">info@findmywarehouse.com</div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div class="contact_info_icon text-center"><img src="images/fblogo.png" alt=""></div></div>
									<div class="contact_info_text"><a href = "https://www.facebook.com/Findmywarehousecom-332494927583109/?notif_id=1543875972870733&notif_t=page_fan" target="_blank"> Check out our Facebook page! </a></div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div class="contact_info_icon text-center"><img src="images/myspacelogo.png" alt=""></div></div>
									<div class="contact_info_text"><a href = "https://www.myspace.com/findmywarehouseie332" target="_blank"> Check out our MySpace page! </a></div>
								</li>
							</ul>
						</div>
						<div class="contact_info_pin"><div></div></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="footer_content">
			<div class="container">
				<div class="row">
					
					<!-- Footer Column -->
					<div class="col-lg-4 footer_col">
						<div class="footer_about">
							<div>
								<a href="main_page.php#">
									<div class="logo_container d-flex flex-row align-items-start justify-content-start">
										<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
										<div class="logo_content">
											<div style="font-size:24px" id="logo_text" class="logo_text logo_text_not_ie">Find My Warehouse</div>
											<div class="logo_sub"><?php echo "Today is " . date("l, F d, Y"); ?> - West Lafayette, IN</div>
										</div>
									</div>
								</a>	
							</div>
							<div class="footer_about_text">
							  <p>Find My Warehouse is an online platform where people share their storage resources nationwide.</p>
							</div>
						</div>
					</div>

				<!-- Footer Column -->
					<div class="col-lg-3 footer_col">
						<div class="footer_links">
							<ul>
								<li><a href="main_page.php">Home</a></li>
								<li><a href="filtering_inputs.php">Warehouses</a></li>
								<li><a href="about_team_page.php">About Us</a></li>
								<li><a href="contact_us.php">Contact Us</a></li>
								<li><a href="analytics.php">Analytics</a></li>
							
							</ul>
						</div>
					</div>
							<!-- Footer Column -->
					<div class="col-lg-3 footer_col">
						<div class="footer_links">
							<ul>
								
								<li><a href="log_in.php">Log In</a></li>
								<li><a href="create_account.php">Sign Up</a></li>
								
							</ul>
						</div>

					

			
		

		<div class="footer_extra">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_extra_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
							<div class="footer_social">
								
							</div>
							<div class="footer_extra_right ml-lg-auto text-lg-right">
								<div class="footer_extra_links">
									<ul>
										<li><a href="contact.php">Contact us</a></li>
										<li><a href="#">Sitemap</a></li>
										<li><a href="#">Privacy</a></li>
									</ul>
								</div> 
								<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- WE DID NOT CREATE THIS TEMPLATE. ALL CREDITS TO Colorlib -->
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
		
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="js/contact.js"></script>
</body>
</html>