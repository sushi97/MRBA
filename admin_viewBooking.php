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
                    if($_SESSION["id"]) {
						header("Location: index3.php");
						session_unset();
						session_destroy();
						return;
                    }else {
						echo "ADMIN <div class=\"primary-button\" id=\"LogoutButton\"><button>Logout</button></div>";
					}
                    ?>
				</div>
				<span class="cd-marker item-1"></span>
				<ul>
					<li class="selected">
						<a href="#">
							<div class="image-icon">
								<img src="img/about-icon.png">
							</div>
							<h6>VIEW BOOKINGS</h6>
						</a>
					</li>
					<li>
						<a href="admin_addRoom.php">
							<div class="image-icon">
								<img src="img/featured-icon.png">
							</div>
							<h6>ADD ROOMS</h6>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="heading">
			<h1>BOOKINGS</h1>
			<span></span>
		</div>

		<div class="content first-content">
			<div class="tot">
				<table class="darkTable" style="width:100%;text-align:center;">
					<tr style="background-color:#999999;">
						<th>Booking ID</th>
						<th>Room ID</th>
						<th>Customer name</th>
						<th>Customer phone</th>
						<th>Customer email</th>
						<th>Timestamp</th>
						<th>Date booked for</th>
						<th>Slot No</th>
						<th>Delete</th>
					</tr>
					<?php 
						$BOOKINGS = $db->get_results("SELECT b.bid,b.rid, c.fname,c.lname, c.phone,c.email,b.bookingtime, b.bookdate, b.slot_no FROM customers c JOIN bookings b ON c.cid=b.cid;");
						foreach($BOOKINGS as $BOOKING) {

							echo "<tr>
							<td>$BOOKING->bid</td>
							<td>$BOOKING->rid</td>
							<td>$BOOKING->fname $BOOKING->lname</td>
							<td>$BOOKING->phone</td>
							<td>$BOOKING->email</td>
							<td>$BOOKING->bookingtime</td>
							<td>$BOOKING->bookdate</td>
							<td>$BOOKING->slot_no</td>
							<td><form action=\"deleteBooking.php\" method=\"POST\">
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
		let logoutButton = document.getElementById("LogoutButton");
		(logoutButton)?logoutButton.addEventListener('click', logout, false):null;
	</script>
</body>

</html>