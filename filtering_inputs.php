<!DOCTYPE html>
<html lang="en">

<head>
<title>Warehouses</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Conference project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/mytable.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">

<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 2px;
        box-sizing: border-box;
    }
	
	.bordered {
		width: 240px;
		height: 260px;
		padding: 20px;
		border: 2px solid black;
		border-radius: 25px;
		padding: 30px;
	}
	
	div.location {
		top: -330px;
		width: 800px;
		height: 450px;
		margin-left: 500px;
		margin-right: auto;
		border: 2px solid black;
		border-radius: 25px;
		padding: 5px;
		background-color: #808080;
	}
	.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
</head>
<body>

<div class="super_container" style="overflow: auto;">

	<!-- Menu -->

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-rowumn align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="#">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
						<div class="logo_content">
							<div class="logo_text logo_text_not_ie">Find My Warehouse</div>
							<div class="logo_sub"> </div>
						</div>
					</div>
				</a>
			</div>
			<ul>
				<li><a href="main_page.php">Home</a></li>
				<li><a href="filtering_inputs.php">Warehouses</a></li>
				<li><a href="about_team_page.php">About Us</a></li>
				<li><a href="contact_us.php">Contact Us</a></li>
				<li><a href="analytics.php">Analytics</a></li>
			</ul>
		</div>
	</div>
	
	<!-- Home -->

	<div class="home" style="margin-top:0px;">
		<!-- Header -->

		<header class="header" id="header">
			<div>
				<div class="header_top">
					<div class="container">
						<div class="row">
							<div class="row">
								<div class="header_top_content d-flex flex-row align-items-center justify-content-start">
									<div>
										<a href="#">
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
										<ul>
										
										</ul>
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
									<div class="row">
										<div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
											<nav class="main_nav">
												<ul>
													<li><a href="main_page.php">Home</a></li>
													<li class="active"><a href="filtering_inputs.php">Warehouses</a></li>
													<li><a href="about_team_page.php">About Us</a></li>
													<li><a href="contact_us.php">Contact Us</a></li>
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
									<div class="row">
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

		<div class="home_content_container" style="background-image: url(images/map_background_grey.png); top:20%">
			<div class="" style="background-rowor: #0c081d; margin:50px 100px; padding : 200px;">
					<div class = "bordered" style = "background: #808080;">
                        <form action = "scheduling_algorithm.php" method = "post">
							<font color = "white"> 
							Zip Code:<br>
							<input type="text" id = "zipcode" name = "zipcode" required><br>
							Start Date: <br>
							<input type="date" id = "startdate" name = "startdate"><br>
							End Date: <br>
							<input type="date" id = "enddate" name = "enddate"><br><br>
							<input type ="submit" value = "Submit">
							</font>
						</form>
						<div class="location">
							<font size = +5 color = "white" class ="center">
								<center> Start your leasing journey here!</center>
							</font>
							<img src="images/outside_warehouse.png" alt="" width="543.9" height="320.5" class = "center">
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
								<a href="#">
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

					
					

		</div>
		<div class="footer_extra">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_extra_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
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
</body>
</html>