
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
        padding: 3px;
        box-sizing: border-box;
    }
	
	.display {
		margin-left: 200px; /* Same width as the sidebar + left position in px */
		margin-top: 500px;
		padding: 0px 10px;
		font-color: "black";
	}
	
	.border {
		top: -650px;
		background-color: lightgrey;
		width: 555px;
		border: 5px black;
		padding: 25px;
		border-radius: 25px;
		margin: 25px;
	
	}
}
	
</style>
</head>
<body>

<div 

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
	<div class="home" style="margin-top:px;">

		<div class="home_background" style="background-color: #e0f2fb;"></div>

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
												<div class="button header_button"><a href="log_in.php">Sign In</a></div>
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
	
	<!-- This connects to the database and runs queries to get all the information regarding the respective warehouse. -->
	
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
					<div class = "border">
						<?php 
							$ID = $_GET["id"];
							
							$servername = "mydb.ics.purdue.edu";
							$username = "g1090425";
							$password = "group4332";
							$dbname = "g1090425";
							
							// Create connection
							$conn = new mysqli($servername, $username, $password, $dbname);
							// Check connection
							
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							} 
							
							$sql = "SELECT Listed_Rental_Price FROM Listing WHERE Warehouse_ID = '$ID'";
							$price = $conn->query($sql);
							
							
							echo "<div style ='font:20px/21px Arial,tahoma,sans-serif;color:#000000'>";
							
							
							$row = $price->fetch_assoc();
							echo "Listed Rental Price: " . $row["Listed_Rental_Price"] . " SF/Month" ."<br><br><br>";
							
							
							
							$sql2 = "SELECT Owner_ID, Street_Address, City, State, Zip_Code, Total_Space_Available_for_Rent, Year_Built, Property_Type FROM Warehouse WHERE Warehouse_ID = '$ID'";
							$warehouse = $conn->query($sql2);
							
							$row2 = $warehouse->fetch_assoc();
							echo "Street Address: " . $row2["Street_Address"] . ", " . $row2["City"] . ", " . $row2["State"] . ", " . $row2["Zip_Code"] . "<br><br>";
							echo "Total Space Availabe for Rent: " . $row2["Total_Space_Available_for_Rent"] . " SF" . "<br><br>";
							echo "Year Built: " . $row2["Year_Built"] . "<br><br>";
							echo "Property Type: " . $row2["Property_Type"] . "<br><br><br>";
							
							
							
							$sql3 = "SELECT Average_Warehouse_Rating, Average_Owner_Rating FROM Contract WHERE Warehouse_ID = '$ID'";
							$ratings = $conn->query($sql3);
							
							$row3 = $ratings->fetch_assoc();
							echo "Average Warehouse Rating: " . $row3["Average_Warehouse_Rating"] . "/5" . "<br><br>";
							echo "Average Owner Rating: " . $row3["Average_Owner_Rating"] . "/5" . "<br><br><br><br>";
						?>

	<!-- There is also a create contract button that redirects to another page to create a contract for that warehouse. -->

						<a href = "log_in_request.php?wid=<?= $ID ?>&oid=<?= $row2["Owner_ID"] ?>"> Request Contract Here! </a>
						
						</div>
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



</body>
</html>