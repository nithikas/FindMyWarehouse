<!DOCTYPE html>
<html lang="en">

<head>
<title>Pending Contracts</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Conference project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/owner_portal.css">
<link rel="stylesheet" type="text/css" href="styles/speakers_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/mytable.css">
</head>
<body>
<div class="super_container">

	<!-- Menu -->

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="#">
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
				<li><a href="contact_us.php">Contact Us</a></li>
				<li><a href="analytics.php">Analytics</a></li>
			</ul>
		</div>
	</div>
	
	<!-- Home -->

	<div class="home" style ="height: 750px;">


		<!-- Header -->

		<header class="header" id="header">
			<div>
				<div class="header_top">
					<div class="container">
						<div class="row">
							<div class="col">
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
										
									</div>
									<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
	
	<!-- Tabs for navigation --> 
	
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
									<div class="col-lg-12">
										<div class="contact_form_container">
											<div class="contact_form_title">Log In</div>
												<form action="#" class="contact_form" id="contact_form">
													<input type="email" class="contact_input" placeholder="E-mail or Account Name" required="required">
													<input type="text" class="contact_input" placeholder="Password" required="required">
													<button class="button contact_button"><span>Log In</span></button>
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

	<!-- Connecting to the database and running a query to get the contracts that are pending -->
		
	<?php 
		$servername = "mydb.ics.purdue.edu";
		$username = "g1090425";
		$password = "group4332";
		$dbname = "g1090425";
		$id = $_GET['id'];
		
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		$lesseeP = $conn->query("SELECT Contract_ID, Lessee_ID, Pending_Lessee, Warehouse_ID, Agreed_Rental_Price, Owner_ID, Pending_Owner FROM Contract WHERE Lessee_ID = '$id' AND Pending_Lessee = 'Yes'");
				
		$ownerP = $conn->query("SELECT Average_Lessee_Rating, Contract_ID, Owner_ID, Pending_Owner, Warehouse_ID, Agreed_Rental_Price, Lessee_ID, Pending_Lessee FROM Contract WHERE Owner_ID = '$id' AND Pending_Owner = 'Yes'");

	?>
	
	
	<!-- Creating a table of the Contract ID, Lessee or Owner ID, Lessee or Owner Pending, an Accept button, and a Decline button --> 
	
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<span style="color: black; font-size: 25px">
							<br><br><br><br>
								Lessee Pending Contracts: <br>
								</span>
							<span style='color: black; font-size: 17px;' >
							<?php
								if ($lesseeP->num_rows > 0) {
									while($lesseeCheck = $lesseeP->fetch_assoc()) {
								?>
								
							<table id ='pendingContractsL' style = 'width:100%'>
								<tr>
								<th> Contract ID </th>
								<th> Owner ID </th>
								<th> Warehouse ID </th>
								<th> Pending Lessee </th>
								<th> Accept </th>
								<th> Decline </th>
								<th> Rental Price </th>
								
								</tr>
								
								<tr>
									<td><?=$lesseeCheck["Contract_ID"]?></td>
									<td><?=$lesseeCheck["Owner_ID"]?></td>
									<td><?=$lesseeCheck["Warehouse_ID"]?></td>
									<td><?=$lesseeCheck["Pending_Lessee"]?></td>

								<?php
									if ($lesseeCheck["Pending_Owner"] === 'Yes') {
								?>
									<td> Accept </td>
									<td> Decline </td>
									<td><?=$lesseeCheck["Agreed_Rental_Price"]?></td>
									</tr>
								</table>
								<?php
									}
									else {
								?>
									<td> <a href = "lessee_accept_contract?contractID=<?=$lesseeCheck["Contract_ID"]?>&lesseeID=<?=$lesseeCheck["Lessee_ID"]?>"> Accept </a> </td>
									<td> <a href = "decline_contract_lessee?contractID=<?=$lesseeCheck["Contract_ID"]?>&lesseeID=<?=$lesseeCheck["Lessee_ID"]?>"> Decline </a> </td>
									<td><?=$lesseeCheck["Agreed_Rental_Price"]?></td>
									</tr>
								</table>
								*DISCLAIMER: If you do not like the price that the owner has suggested, decline the contract and contact the warehouse owner through the directory to negotiate the price.*
								<?php 
									} 
								?>
								
								<?php 
									}
								}
								else {
									echo "</table>";
									echo "<br>No pending contracts found!";
									
								}
								?>
								
							</span>
							<br>
							<br>
							<span style="color: black; font-size: 25px">
							Owner Pending Contracts: <br>
							</span>
							
							<span style='color: black; font-size: 17px;' >
							<?php
								if ($ownerP->num_rows > 0) {
									while($ownerCheck = $ownerP->fetch_assoc()) {
								?>
							<table id ='pendingContractsO' style = 'width:100%'>
								<tr>
								<th> Contract ID </th>
								<th> Owner ID </th>
								<th> Pending Owner </th>
								<th> Accept </th>
								<th> Decline </th>
								<th> Rental Price </th>
								<th> Lessee Rating</th>
								</tr>
								
								<tr>
									<td><?=$ownerCheck["Contract_ID"]?></td>
									<td><?=$ownerCheck["Owner_ID"]?></td>
									<td><?=$ownerCheck["Pending_Owner"]?></td>
							
									<td> <a href = "owner_accept_contract.php?contractID=<?=$ownerCheck["Contract_ID"]?>&ownerID=<?=$ownerCheck["Owner_ID"]?>&WarehouseID=<?=$ownerCheck["Warehouse_ID"]?>"> Accept</a></td>
									<td> <a href = "decline_contract_owner?contractID=<?=$ownerCheck["Contract_ID"]?>&ownerID=<?=$ownerCheck["Owner_ID"]?>"> Decline </a> </td>
									<td><?=$ownerCheck["Agreed_Rental_Price"]?></td>
									<td><?=$ownerCheck["Average_Lessee_Rating"]?></td>
							
								</tr>
								</table>
								<?php 
									}
								}
								else {
									echo "</table>";
									echo "<br>No pending contracts found!";
								}
								?>
								
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		

</div>


	
</div>		
</div>

<!-- Creating the footer that is identical on all pages -->

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

					
					<!-- Footer Column -->
					<div class="col-lg-2 footer_col">
						
					</div>

				</div>
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
										<li><a href="contact_us.php">Contact Us</a></li>
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
</div>
</div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/speakers.js"></script>
</body>
</html>
