<!DOCTYPE html>
<html lang="en">
<head>
<title>Submit a Rating</title>
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
				<li class="menu_item"><a href="main_page.php">Home</a></li>
				<li class="menu_item"><a href="filtering_inputs.php">Warehouses</a></li>
				<li class="menu_item"><a href="about_team_page.php">About Us</a></li>
				<li class="menu_item"><a href="contact_us.php">Contact Us</a></li>
			</ul>
		</div>
	</div>
	
	<!-- Home -->
	<div class="home" style="height: 1500px;">
		<!-- <div class="home_background" style="background-image: url(images/index.jpg)"></div> -->
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/warehouse3.jpg" data-speed="0.8"></div>


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
									</div>
									<div class="header_social ml-auto">
										
									</div>
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
													<li><a href="contact_us.php">Contact Us</a></li>
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
					<div class="col-lg-12">
						 <div style="background-color:#40e0d0; background-image: linear-gradient(to right, #40e0d0, #329fec); text-align:left; vertical-align: middle; padding:20px 20px;">
	
					
							
				<title>Bootstrap star rating example</title>
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
	
	<!-- Reference used for rating html design
	Savani H. Bootstrap star rating example using bootstrap-star-rating plugin [Internet]. Itsolutionstuff.com. 2018 [cited November 2018]. Available from: https://itsolutionstuff.com/post/bootstrap-star-rating-example-using-bootstrap-star-rating-pluginexample.html-->
<!--</head>
<body>-->

<?php
//gets owner ID and contract ID from user portal to pass information through ratings form
$UserID = $_GET["lesseeID"];  
$ContractID = $_GET["contractID"]; 
?>
<div class="container">
	<h2>Submit a rating.</h2>
	<font size = +1 color = "black"> As a valued client of our service, your feedback is important to us. <br>Please submit an honest rating of the owner you worked with and their facility. <br>Mouse over the rating titles to read more about the definition of the rating.<br>
	
	<form action="rating_sql.php" class="contact_form" id="contact_form" method = "GET">

    <br/>
	<!--Rating form for lessee. Includes tool tip popups to describe the rating.-->
	<h2>Rate the owner of your lease:</h2>

    <label for="input-1" class="control-label" style="cursor:pointer;" title="An owner's rating for courtesy should be based on their professionalism, attitude and friendliness. "> Courtesy:</label>
	<input id="input-1" name="OC" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="5">
	
    <br/>
    <label for="input-2" class="control-label" style="cursor:pointer;" title="An owner's rating for Adherence to Contract should be based on their compliance with the terms outlined in the contract. A low rating would be warranted if the owner violated their end of the contract in any situation. ">Adherence to Contract:</label>
    <input id="input-2" name="OATC" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="5">

    <br/>
    <label for="input-3" class="control-label" style="cursor:pointer;" title="An owner's rating for Timeliness should be based on their responsiveness to communication regarding the contract, warehouse access and all other communication during the rental process. It should also reflect their timeliness in emergency situations, if applicable. ">Timeliness:</label>
    <input id="input-3" name="OT" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="5">				

	<h2>Rate the warehouse:</h2>
	
    <label for="input-4" class="control-label" style="cursor:pointer;" title="A warehouse's rating for Cleanliness should be based on the condition of the warehouse when the contract started. "> Cleanliness:</label>
	<input id="input-4" name="WC" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="5">
	
    <br/>
    <label for="input-5" class="control-label" style="cursor:pointer;" title="A warehouse's rating for Safety and Repair should be based on the condition of the appliances and structure of the warehouse. ">Safety and Repair:</label>
    <input id="input-5" name="WSAR" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="5">
	
	<input type = "hidden" id="input-6" name="CID" value=<?=$ContractID?>>
	<input type = "hidden" id="input-7" name="UserID" value=<?=$UserID?>>
	<button class="button contact_button"><span>Submit Rating</span></button>				
	</form>

</div>



<div class="home_buttons">
							</div>
							</div>

<script>
$("#input-id").rating();
</script>
						</div>
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
								<a href="main_page.php">
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

					
					<!-- Footer Column -->
					<div class="col-lg-2 footer_col">
						<div class="footer_links">
							<ul>
						
							</ul>
						</div>
					</div>

				</div>
			</div>
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
										<li><a href="contact_us.php">Contact us</a></li>
										<li><a href="#">Sitemap</a></li>
										<li><a href="#">Privacy</a></li>
									</ul>
								</div>
								<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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