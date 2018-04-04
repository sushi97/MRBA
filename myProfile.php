<html>

<head>
	<title>home page</title>
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
</head>

<body>
	<div class=overlay></div>
	<div class="cd-hero">
		<div class="cd-slider-nav">
			<nav>
				<div class="session_status">
					<?php
                    include_once("DBconn.php");
					session_start();
					$ID = $_SESSION["id"];
                    if($_SESSION["id"] == 0) {
						header("Location: index3.php");
						session_unset();
						session_destroy();
						return;
                    }else {
						$CUST = $db->get_row("SELECT * FROM customers WHERE cid=$ID;");
						echo "$CUST->fname $CUST->lname<div class=\"primary-button\" id=\"LogoutButton\"><a>Logout</a></div>";
					}
                    ?>
				</div>
				<span class="cd-marker item-1"></span>
				<ul>
					<li class="selected">
						<a href="index.php">
							<div class="image-icon">
								<img src="img/home-icon.png">
							</div>
							<h6>WELCOME</h6>
						</a>
					</li>
					<li>
						<a href="index3.php">
							<div class="image-icon">
								<img src="img/about-icon.png">
							</div>
							<h6>JOIN US</h6>
						</a>
					</li>
					<li>
						<a href="book.php">
							<div class="image-icon">
								<img src="img/featured-icon.png">
							</div>
							<h6>BOOK NOW</h6>
						</a>
					</li>
					<li>
						<a href="index4.php">
							<div class="image-icon">
								<img src="img/projects-icon.png">
							</div>
							<h6>OFFERINGS</h6>
						</a>
					</li>
					<li>
						<a href="index2.php">
							<div class="image-icon">
								<img src="img/contact-icon.png">
							</div>
							<h6>CONTACT</h6>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="heading">
			<h1>MY PROFILE</h1>
			<span>Your recent bookings</span>
		</div>

		<div class="content first-content">
			<div class="tot">
				<table class="darkTable" style="width:100%;text-align:center;">
					<tr style="background-color:#999999;">
						<th>Booking ID</th>
						<th>Name</th>
						<th>Type</th>
						<th>Area</th>
						<th>Seating Capacity</th>
						<th>Amenities</th>
						<th>Date booked for</th>
						<th>Slot No</th>
						<th>Cost</th>
						<th>Delete</th>
					</tr>
					<?php 
						$BOOKINGS = $db->get_results("SELECT b.bid, b.cid, b.rid, r.costperslot, r.address, r.type, r.area, r.capacity, r.ac, r.projector, r.wifi, r.pantry, r.whiteboard, b.bookdate, b.slot_no FROM rooms r JOIN bookings b on r.rid=b.rid WHERE b.cid=$ID;");
						foreach($BOOKINGS as $BOOKING) {

							$ACSTR = "no";
							if($BOOKING->ac == 1) {
								$ACSTR = "yes";
							}
							$PROSTR = "no";
							if($BOOKING->projector == 1) {
								$PROSTR = "yes";
							}
							$WFSTR = "no";
							if($BOOKING->wifi == 1) {
								$WFSTR = "yes";
							}
							$WBSTR = "no";
							if($BOOKING->whiteboard == 1) {
								$WBSTR = "yes";
							}
							$PANSTR = "no";
							if($BOOKING->pantry == 1) {
								$PANSTR = "yes";
							}

							echo "<tr>
							<td>$BOOKING->bid</td>
							<td>$BOOKING->address</td>
							<td>$BOOKING->type</td>
							<td>$BOOKING->area</td>
							<td>$BOOKING->capacity</td>
							<td>
								<img class=\"ico $ACSTR\" src=\"img/amenity-ac.svg\" title=\"Air Conditioner\" />
								<img class=\"ico $WFSTR\" src=\"img/amenity-wifi.svg\" title=\"WiFi\" />
								<img class=\"ico $WBSTR\" src=\"img/amenity-white-board.svg\" title=\"Whiteboard\" />
								<img class=\"ico $PROSTR\" src=\"img/amenity-projector.svg\" title=\"Projector\" />
								<img class=\"ico $PANSTR\" src=\"img/amenity-pantry.svg\" title=\"Pantry\" />
								<!-- <img class=\"ico\"src=\"img/amenity-ac.svg\" /> -->
							</td>
							<td>$BOOKING->bookdate</td>
							<td>$BOOKING->slot_no</td>
							<td>$BOOKING->costperslot</td>
							<td><form action=\"deleteBookingCust.php\" method=\"POST\">
							<input type=\"hidden\" name=\"bid\" value=\"$BOOKING->bid\">
							<input type=\"submit\" value=\"Delete\">
							</form>
							</td>
							</tr>";
						}
					?>
				</table>
			</div>
		</div>
	</div>
	</div>
	<footer>
		<p>Copyright &copy; 2018 YOUROOMS | Designed byMRBA</p>
	</footer>
	<script type="text/javascript">
		function logout() {
			document.location = 'logout.php';
		}
		let logoutButton = document.getElementById("LogoutButton"); 		(logoutButton)?logoutButton.addEventListener('click', logout, false):null;
	</script>
</body>

</html>