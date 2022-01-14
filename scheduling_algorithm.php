   
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


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>jQuery UI Slider - Range slider</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 0, 100 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
 </script>


<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
	
	.main {
		margin-left: 200px; /* Same width as the sidebar + left position in px */
		margin-top: 150px;
		padding: 0px 10px;
		font-color: "black";
	}
	
	.sidenav {
			
			width: 275px; /* Set the width of the sidebar */
			z-index: 1; /* Stay on top */
			top: 225px; /* Stay at the top */
			left: 20px;
			border-radius: 25px;
			background-color: #D3D3D3; /* Black */
			overflow-x: hidden; /* Disable horizontal scroll */
			overflow-y: hidden;
			padding-top: 20px;
			padding-left: 40px;
			padding-bottom: 20px;
			padding-right: 20px;
			
	}
	.home_content_container {
		background-color: #377AE8;
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

	<div class="home" style="margin-top:0px;">
		<!-- <div class="home_background" style="background-image: url(images/index.jpg)"></div> -->
		<!-- <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/warehouse2.jpg" data-speed="0.8"></div> -->

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
													<li class = ""><a href="main_page.php">Home</a></li>
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
		
		<!-- setting the value in each box on the side navigation bar obtained during the previous run of the page to a variable -->
		<!-- we use this to pre-fill in the user information so that each time they press submit, the page won't completely refresh to empty boxes -->
		<?php
		$N1 = $_POST[zipcode];
			if (empty($N1) == TRUE){
				$N1 = "";
			}
			$N2 = $_POST[startdate];
			if (empty($N2) == TRUE){
				$N2 = "false";
			}
			$N3 = $_POST[enddate];
			if (empty($N3) == TRUE){
				$N3 = "false";
			}
		?>
		
		
		<!-- Side navigation bar to allow user to input specifications for a warehouse -->
		<div class = "sidenav">
		<font color="black">
		<form action = "advanced_scheduling_algorithm.php" method = "post">
		Zip Code:<br>
		<input type="text" id = "zip_code" name = "zip_code" value = "<?php echo $N1 ?>" required><br>
		Start Date: <br>
		<input type="date" id = "start_date" name = "start_date" value = "<?php echo $N2 ?>"><br>
		End Date: <br>
		<input type="date" id = "end_date" name = "end_date" value = "<?php echo $N3 ?>"><br>
		Types of Storage:<br>
		<input type="checkbox" name="pallet_racking" value="Pallet_Racking"> Pallet Racking <br>
		<input type="checkbox" name="shelving" value="Shelving"> Shelving <br>
		<input type="checkbox" name="mobile_shelving" value="Mobile_Shelving"> Mobile Shelving <br>
		<input type="checkbox" name="multi_tier_racking" value="Multi-Tier_Racking"> Multi-Tier Racking <br>
		<input type="checkbox" name="mezzanine_flooring" value="Mezzanine_Flooring"> Mezzanine Flooring <br>
		Lower Price Bound (/SF/Mo):<br>
		<input type = "text" id = "price_lower_bound" name = "price_lower_bound"><br>
		Higher Price Bound (/SF/Mo):<br>
		<input type = "text" id = "price_higher_bound" name = "price_higher_bound"><br>
		Entire Warehouse:<br>
		<input type="checkbox" name="entire_warehouse" value="Entire_Warehouse"> Entire Warehouse <br>
		Lower Space Bound (SF):<br>
		<input type = "text" id = "space_lower_bound" name = "space_lower_bound"><br>
		Higher Space Bound (SF):<br>
		<input type = "text" id = "space_higher_bound" name = "space_higher_bound"><br>
		Year Built:<br>
		<input type = "text" id = "year_built" name = "year_built"><br>
		Lower Bound Owner Rating:<br>
		<input type = "number" id = "lower_bound_owner_rating" name = "lower_bound_owner_rating" min="1" max="5"><br>
		Lower Bound Warehouse Rating:<br>
		<input type = "number" id = "lower_bound_warehouse_rating" name = "lower_bound_warehouse_rating" min="1" max="5"><br>
		<input type ="submit" value = " Submit "> <br>
		</font>
		</div>
		
		
		<div class="home_background" style="background-color: #e0f2fb"> 
			<div class="" style="background-color: #e0f2fb; margin:100px 100px; padding : 100px;">
				<div class="row">
					<div class="row">
		
		<div class = "main">
								<!-- Use specifications from previous run of website to filter warehouses and display those that match the specifications -->	
								<?php
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
									//Run scheduling and ranking algorithm in R using the user inputs
									$newString = shell_exec("Rscript ex.R $N1 $N2 $N3");
									
									//The output from R is a string with all of the warehouse IDs that match the specifications 
									$length = strlen($newString);
									
									//If warehouses were found after filtering
									if ($length > 0){
										
										//For the entire string, substring all of the warehouse IDs
										for ($x = 5; $x <= (strlen($newString) - 2); $x = $x + 13){
											$substring = substr($newString, $x, -($length - 10 - $x));
											//For each warehouse id, find the appropriate attributes to put in the table
											$sql = "SELECT Warehouse_ID, City, State, Zip_Code, Total_Space_Available_for_Rent, Year_Built FROM Warehouse WHERE Warehouse_ID = " . $substring;
											$result = $conn->query($sql);
											
											$row = $result->fetch_assoc()
											?>
												<!--Store query results in table -->
												<table id="example" class="display" style="width:100%; left:100px">
												<thead class = "table table-dark">
													<tr>
														<th>Warehouse ID</th>
														<th>City</th>
														<th>State</th>
														<th>Zip Code</th>
														<th>Total Space Available</th>
														<th>Year Built</th>
													</tr>
												</thead>
												<tbody>
												<tr>
													<td><button type = "button" onclick = "window.location = 'warehouse_details.php?id=<?=$row["Warehouse_ID"]?>';"><?=$row["Warehouse_ID"]?></button></td>
													<td><?=$row["City"]?></td>
													<td><?=$row["State"]?></td>
													<td><?=$row["Zip_Code"]?></td>
													<td><?=$row["Total_Space_Available_for_Rent"]?></td>
													<td><?=$row["Year_Built"]?></td>
												</tr>
												 </tbody>
                            
                        
											<?php
												
												
										}
										?>
										<tfoot class = "table table-dark">
											<tr>
												<th>Warehouse ID</th>
												<th>City</th>
												<th>State</th>
												<th>Zip Code</th>
												<th>Total Space Available</th>
												<th>Year Built</th>
											</tr>
										</tfoot>
										</table>
										<?php
												
										//If no warehouses were found after filtering		
										}else{
										?>
										<!-- Output a blank table -->
										<table id="example" class="display" style="width:100%; left:100px">
												<thead class = "table table-dark">
													<tr>
														<th>Warehouse ID</th>
														<th>City</th>
														<th>State</th>
														<th>Zip Code</th>
														<th>Total Space Available</th>
														<th>Year Built</th>
													</tr>
												</thead>
												<tfoot class = "table table-dark">
											<tr>
												<th>Warehouse ID</th>
												<th>City</th>
												<th>State</th>
												<th>Zip Code</th>
												<th>Total Space Available</th>
												<th>Year Built</th>
											</tr>
										</tfoot>
										</table>
										<?php
												
												
										}
										?>
										
                           
	</div>
					</div>
				</div>
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
<script src="js/custom.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="js/mytable.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );

</script>


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