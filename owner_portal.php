<!DOCTYPE html>
<html lang="en">

<!-- style for sidebar -->
<style>
.sidenav {
    width: 175px;
    position: fixed;
    z-index: 1;
    top: 275px;
    left: 50px;
    background: #eee;
    overflow-x: hidden;
    padding: 8px 0;
}

.sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 17px;
    color: #2196F3;
    display: block;
}

.sidenav a:hover {
    color: #064579;
}
</style>

<head>
<title>User Portal</title>
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

	<div class="home" style ="height: 1400px;">


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
													<li> <a href="about_team_page.php">About Us</a></li>
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
		<?php 
		$servername = "mydb.ics.purdue.edu";
		$username = "g1090425";
		$password = "group4332";
		$dbname = "g1090425";
		//this pulls the user id over from the previous page
		$id = $_GET['id'];
		$emailID = $_POST[email];
		//start connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		// this checks if the user is in the database
		$statement = $conn->query("SELECT Name, User_ID FROM User WHERE Email = '$_POST[email]' AND AES_DECRYPT(Password,'password') = '$_POST[userPassword]'");
		
		//this checks to see if the user id is in the database
		$returnFromRating = $conn->query("SELECT Name, User_ID FROM User WHERE User_ID = '$id'");
		$ratingQ = $returnFromRating->fetch_assoc();
		$name = $ratingQ['Name'];
		$statement2 = $statement->fetch_assoc();
		$statement3 = $statement2['User_ID'];
		$statement4 = $statement2['Name'];
		
		//this checks to see if the user is actually a registered user
		//if yes, then it logs in
		if ($statement->num_rows > 0) {
		?>
		<div class='home_content_container'>
			<div class='container'>
				<div class='row'>
					<div class='col'>
				<div class='home_content_container'>
			<div class='container'>
				<div class='row'>
					<div class='col'>
						<div class='home_content d-flex flex-row align-items-end justify-content-start'>
						 <div style='background-color:#4867c0; background-image: linear-gradient(to right, #4867c0, #329fec); text-align:left; vertical-align: middle; padding:20px 47px;'>
							<!-- print the name of the user -->
							<div style='color:white'; class='current_page'>
							<?php
		echo "Welcome, ".  $statement4 . "!"; 
		?> 
		</div>
					<div class='breadcrumbs ml-auto'>
							</div>	
							</div>
						</div>
					</div>
				<div class='button header_button'><a href='user_directory.php'>Access Our Directory</a></div>
				<div class='button header_button'><a href='new_warehouse_form.php'>Add New Warehouse</a></div>
				<div class='button header_button'><a href='filtering_inputs.php'>Lease New Warehouse</a></div>
				
				</div>
			</div>
		</div>
	</div>
	
	
	
<div class='cta'>
	<?php
			$sql = "select C.Amount_Paid, C.Contract_ID, C.Pending_Lessee, C.Pending_Owner, C.Owner_ID, C.Warehouse_ID, C.Space_Rented, C.Start_Date_of_Lease, C.End_Date_of_Lease, C.Agreed_Rental_Price, W.Street_Address, W.City, W.State, W.Zip_Code from Contract C join Warehouse W on C.Pending_Lessee = 'No' and C.Pending_Owner = 'No' and C.Warehouse_ID = W.Warehouse_ID and Lessee_ID = '$statement3'";
			$result = $conn->query($sql);
			$sql3 = "select Owner_ID, Contract_ID from Contract where Lessee_ID = '$statement3'";
			$helpMe = $conn->query($sql3);
			$initialQuery = $helpMe->fetch_assoc();
			$contractID1 = $initialQuery['Contract_ID'];
			echo "<br>";
			?> 
			<!-- this is a sidebar that lets the user check their warehouses, update account info, delete account, and log in -->
			<div class = 'sidenav'>
			<a href='your_warehouses.php?id=<?=$statement3?>'>Check out your warehouses</a>
				<br>
				<a href='pending_contracts.php?id=<?=$statement3?>'>See if you have any pending contracts</a> <br>
				<a href='update_profile.php?id=<?=$statement3?>'>Update personal information</a> <br>
				<a href='delete_account_form.php?id=<?=$statement3?>'>Delete your account</a><br>
				<a href="log_in.php">Log Out</a><br> 
				</div>
				<?php 
			//this creates a table for each contract the user has as a lessee
			//it outputs the contract id, id of the owner (this is hyperlinked to a user directory with the owner's information), warehouse id (this is hyperlinked
			//to a warehouse details page with the warehouse's information), start & end date of lease, amount of space rented, agreed rental price, a link to complete
			//the owner and warehouse ratings, and amount paid (this is hyperlinked to a page where you can pay your rental fee)
			echo '<span style="color: black; font-size: 25px;" >Contracts where you are a lessee:';
			echo "<br>";
			if ($result->num_rows > 0) {
				?> <?php
				while($row = $result->fetch_assoc()) {
					?>
					<span style='color: black; font-size: 17px;' >
					<form method='get' action='ratings.php'>
						<input type = 'hidden'>
						<table id ='table.cta' style = 'width:100%'>
						<tr>
						<th>Contract ID</th>
						<th>Owner ID</th>
						<th>Warehouse ID</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Space Rented</th>
						<th>Rental Price</th>
						<th>Ratings</th>
						<th>Amount Paid</th>
						</tr>
						<tr>
						<td><a > <?= $row["Contract_ID"] ?> </a></td>
						<td><a href='directory_of_users.php?id=<?=$row['Owner_ID']?>'><?= $row["Owner_ID"] ?></a></td>
						<td><a href='warehouse_details.php?id=<?= $row["Warehouse_ID"] ?>'> <?= $row["Warehouse_ID"] ?> </a></td>
						<td><a><?= $row["Start_Date_of_Lease"] ?></a></td>
						<td><a><?= $row["End_Date_of_Lease"] ?></a></td>
						<td><a><?= $row["Space_Rented"] ?></a></td>
						<td><a><?= $row["Agreed_Rental_Price"] ?></a></td>
						<td> <a href = "ratings.php?contractID=<?=$contractID1?>&lesseeID=<?=$statement3?>">Complete Contract Ratings Here</a></td>
						<td><a href='payment_page.php?warehouseID=<?= $row["Warehouse_ID"]?>&contractID=<?=$row['Contract_ID']?>&userID=<?= $statement3?>'><?= $row["Amount_Paid"] ?> Click here to pay.</a></td>
						</tr>
						</form>
					<br>
				<?php	
			}
			}
			//if they have no contracts as a lessee, it prints no contracts found
			else {
				echo "No contracts found." ;
			} ?>
			</table>
		

			<?php
			$sql2 = "select C.Contract_ID, C.Pending_Lessee, C.Pending_Owner, C.Lessee_ID, C.Warehouse_ID, C.Space_Rented, C.Start_Date_of_Lease, C.End_Date_of_Lease, C.Agreed_Rental_Price, W.Street_Address, W.City, W.State, W.Zip_Code from Contract C join Warehouse W on C.Pending_Lessee = 'No' and C.Pending_Owner = 'No' and C.Warehouse_ID = W.Warehouse_ID and C.Owner_ID = '$statement3'";
			$result2 = $conn->query($sql2);
			$sql3 = "select Lessee_ID, Contract_ID from Contract where Owner_ID = '$statement3'";
			$helpMe = $conn->query($sql3);
			$initialQuery = $helpMe->fetch_assoc();
			$contractID = $initialQuery['Contract_ID'];
			echo "<br>";
			echo '<span style="color: black; font-size: 25px;" ><br>Contracts where you are an owner:';
			if ($result2->num_rows > 0) {
				
				while($row2 = $result2->fetch_assoc()) {
			//this creates a table for each contract the user has as an owner
			//it outputs the contract id, id of the lessee (this is hyperlinked to a user directory with the lessee's information), warehouse id (this is hyperlinked
			//to a warehouse details page with the warehouse's information), start & end date of lease, amount of space rented, agreed rental price,  and a link to complete
			//the lessee rating
			?>
		
					<span style='color: black; font-size: 17px;' >
					<form method='get' >
						<input type = 'hidden'>
						<table style = 'width:100%'>
						<tr>
						<th>Contract ID</th>
						<th>Lessee ID</th>
						<th>Warehouse ID</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Space Rented</th>
						<th>Rental Price</th>
						<th>Ratings</th>
						</tr>
						<tr>
						<td><a > <?= $row2["Contract_ID"] ?> </a></td>
						<td><a href='directory_of_users.php?id=<?= $row2["Lessee_ID"] ?>'> <?= $row2["Lessee_ID"] ?> </a></td>
						<td><a href='warehouse_details.php?id=<?= $row2["Warehouse_ID"] ?>'> <?= $row2["Warehouse_ID"] ?> </a></td>
						<td><a><?= $row2["Start_Date_of_Lease"] ?></a></td>
						<td><a><?= $row2["End_Date_of_Lease"] ?></a></td>
						<td><a><?= $row2["Space_Rented"] ?></a></td>
						<td><a><?= $row2["Agreed_Rental_Price"] ?></a></td>
						<td> <a href = "ratings_madeby_owner.php?contractID=<?=$contractID?>&ownerID=<?=$statement3?>">Complete Contract Ratings Here</a></td>
						</tr>
						</form>
					

		<?php		}
			}
			//if they have no contracts as an owner, it prints no contracts found
			else {
				echo "<br>No contracts found.";
			}
			echo "</table>";
			$conn->close();
echo "	</div>

";?>
<form method="get" action="https://www.fedex.com/apps/fedextrack/index.html" style = "color: black; font-size:17px">
							Enter FedEx Tracking Number:
							<input type="text" name="tracknumbers" />
							<input type="submit" value="Track!" />
							</form>
							<br>
							<br>
							<br>
</div>
</div>
<?php		
} //this checks to see if the user's id number was previously stored & if it is, it will log them in 
else if ($returnFromRating->num_rows > 0){
?> <div class='home_content_container'>
			<div class='container'>
				<div class='row'>
					<div class='col'>
				<div class='home_content_container'>
			<div class='container'>
				<div class='row'>
					<div class='col'>
						<div class='home_content d-flex flex-row align-items-end justify-content-start'>
						 <div style='background-color:#4867c0; background-image: linear-gradient(to right, #4867c0, #329fec); text-align:left; vertical-align: middle; padding:20px 47px;'>
							<!-- print the name of the user -->
							<div style='color:white'; class='current_page'>
							<?php
		echo "Welcome, ".  $name . "!"; 
		?> 
		</div>
					<div class='breadcrumbs ml-auto'>
							</div>	
							</div>
						</div>
					</div>
				
				<div class='button header_button'><a href='user_directory.php'>Access Our Directory</a></div>
				<div class='button header_button'><a href='new_warehouse_form.php'>Add New Warehouse</a></div>
				<div class='button header_button'><a href='filtering_inputs.php'>Lease New Warehouse</a></div>
				</div>
			</div>
		</div>
	</div>
	<div class='sidenav'>
	<!-- this is a sidebar that lets the user check their warehouses, update account info, delete account, and log in -->
	<a href='your_warehouses.php?id=<?=$id?>'>Check out your warehouses!</a>
				<br>
				<a href='pending_contracts.php?id=<?=$id?>'>See if you have any pending contracts!</a>
				<br><a href='update_profile.php?id=<?=$id?>'>Update personal information</a><br>
				<a href='delete_account_form.php?id=<?=$id?>'>Delete your account</a><br>
				<a href="log_in.php">Log Out</a>
	</div>
	
<div class='cta'>
	<?php
			$sql = "select C.Amount_Paid, C.Contract_ID, C.Owner_ID, C.Warehouse_ID, C.Space_Rented, C.Start_Date_of_Lease, C.End_Date_of_Lease, C.Agreed_Rental_Price, W.Street_Address, W.City, W.State, W.Zip_Code from Contract C join Warehouse W on C.Pending_Lessee = 'No' and C.Pending_Owner = 'No' and C.Warehouse_ID = W.Warehouse_ID and Lessee_ID = '$id'";
			$result = $conn->query($sql);
			$sql3 = "select Owner_ID, Contract_ID from Contract where Lessee_ID = '$id'";
			$statement6 = $conn->query($sql3);
			$initialQuery = $statement6->fetch_assoc();
			$contractID1 = $initialQuery['Contract_ID'];
			echo "<br>";
			echo '<span style="color: black; font-size: 25px;" >Contracts where you are a lessee:';
			echo "<br>";
			if ($result->num_rows > 0) {
				?> 	
				
				<?php
				while($row = $result->fetch_assoc()) {
				//this creates a table for each contract the user has as a lessee
				//it outputs the contract id, id of the owner (this is hyperlinked to a user directory with the owner's information), warehouse id (this is hyperlinked
				//to a warehouse details page with the warehouse's information), start & end date of lease, amount of space rented, agreed rental price, a link to complete
				//the owner and warehouse ratings, and amount paid (this is hyperlinked to a page where you can pay your rental fee)
					?>
					<span style='color: black; font-size: 17px;' >
					<form method='get' action='ratings.php'>
						<input type = 'hidden'>
						<table id ='table.cta' style = 'width:115%'>
						<tr>
						<th>Contract ID</th>
						<th>Owner ID</th>
						<th>Warehouse ID</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Space Rented</th>
						<th>Rental Price</th>
						<th>Ratings</th>
						<th>Amount Paid</th>
						</tr>
						<tr>
						<td><a > <?= $row["Contract_ID"] ?> </a></td>
						<td><a href='directory_of_users.php?id=<?=$row['Owner_ID']?>'><?= $row["Owner_ID"] ?></a></td>
						<td><a href='warehouse_details.php?id=<?= $row["Warehouse_ID"] ?>'> <?= $row["Warehouse_ID"] ?> </a></td>
						<td><a><?= $row["Start_Date_of_Lease"] ?></a></td>
						<td><a><?= $row["End_Date_of_Lease"] ?></a></td>
						<td><a><?= $row["Space_Rented"] ?></a></td>
						<td><a><?= $row["Agreed_Rental_Price"] ?></a></td>
						<td> <a href = "ratings.php?contractID=<?=$contractID1?>&lesseeID=<?=$id?>">Complete Contract Ratings Here</a></td>
						<td><a href='payment_page.php?warehouseID=<?= $row["Warehouse_ID"]?>&contractID=<?=$row['Contract_ID']?>&userID=<?= $id?>'><?= $row["Amount_Paid"] ?> Click here to pay.</a></td>
						</tr>
						</form>
					<br>
				<?php	
			}
			}
			//if they have no contracts as a lessee, it prints no contracts found
			else {
				echo "<br>No contracts found." ;
			} ?>
			</table>
		

			<?php
			$sql2 = "select C.Contract_ID, C.Lessee_ID, C.Warehouse_ID, C.Space_Rented, C.Start_Date_of_Lease, C.End_Date_of_Lease, C.Agreed_Rental_Price, W.Street_Address, W.City, W.State, W.Zip_Code from Contract C join Warehouse W on C.Pending_Lessee = 'No' and C.Pending_Owner = 'No' and C.Warehouse_ID = W.Warehouse_ID and C.Owner_ID = '$id'";
			$result2 = $conn->query($sql2);
			$sql3 = "select Lessee_ID, Contract_ID from Contract where Owner_ID = '$id'";
			$statement6 = $conn->query($sql3);
			$initialQuery = $statement6->fetch_assoc();
			$contractID = $initialQuery['Contract_ID'];
			echo "<br>";
			echo '<span style="color: black; font-size: 25px;" >Contracts where you are an owner:';
			echo "<br>";
			if ($result2->num_rows > 0) {
				while($row2 = $result2->fetch_assoc()) {
			//this creates a table for each contract the user has as an owner
			//it outputs the contract id, id of the lessee (this is hyperlinked to a user directory with the lessee's information), warehouse id (this is hyperlinked
			//to a warehouse details page with the warehouse's information), start & end date of lease, amount of space rented, agreed rental price,  and a link to complete
			//the lessee rating
			?>
					<span style='color: black; font-size: 17px;' >
					<form method='get' >
						<input type = 'hidden'>
						<table style = 'width:115%'>
						<tr>
						<th>Contract ID</th>
						<th>Lessee ID</th>
						<th>Warehouse ID</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Space Rented</th>
						<th>Rental Price</th>
						<th>Ratings</th>
						</tr>
						<tr>
						<td><a > <?= $row2["Contract_ID"] ?> </a></td>
						<td><a href='directory_of_users.php?id=<?= $row2["Lessee_ID"] ?>'> <?= $row2["Lessee_ID"] ?> </a></td>
						<td><a href='warehouse_details.php?id=<?= $row2["Warehouse_ID"] ?>'> <?= $row2["Warehouse_ID"] ?> </a></td>
						<td><a><?= $row2["Start_Date_of_Lease"] ?></a></td>
						<td><a><?= $row2["End_Date_of_Lease"] ?></a></td>
						<td><a><?= $row2["Space_Rented"] ?></a></td>
						<td><a><?= $row2["Agreed_Rental_Price"] ?></a></td>
						<td> <a href = "ratings_madeby_owner.php?contractID=<?=$contractID?>&ownerID=<?=$id?>">Complete Contract Ratings Here</a></td>
						</tr>
						</form>
					<br>

		<?php		}
			}
			//if they have no contracts as an owner, it prints no contracts found
			else {
				echo " <br>No contracts found.";
			}
			echo "</table>";
			$conn->close();
echo "	</div>

";?>
<!-- this includes a FedEx tracking button to track packages -->
<form method="get" action="https://www.fedex.com/apps/fedextrack/index.html" style = "color: black; font-size:17px">
							Enter FedEx Tracking Number:
							<input type="text" name="tracknumbers" />
							<input type="submit" value="Track!" />
							</form>
							<br>
							<br>
							<br>
</div>
</div>	
<?php
}

// (LOG IN VALIDATION) if their information is not in the database or the user id is
// not carried over, then the page redirects back to log in

else {
	?><meta http-equiv="refresh" content="2;url=log_in_failed.php"> <?php
}		?>
				

	
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
