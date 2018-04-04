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
					<li>
						<a href="admin_viewBooking.php">
							<div class="image-icon">
								<img src="img/about-icon.png">
							</div>
							<h6>VIEW BOOKINGS</h6>
						</a>
					</li>
					<li class="selected">
						<a href="#0">
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
			<h1>ADD ROOMS</h1>
			<span></span>
		</div>

		<div class="content first-content">
			<div class="tot">
				<div class="left-form">


					<form name="add_room" action="addRoom.php" method="post">
						<input name="address" type="text" placeholder="Name" required="" />
						<select name="type">
							<option value="board">Board Room</option>
							<option value="conference">Conference Room</option>
							<option value="meeting">Meeting Room</option>
							<option value="training">Training Room</option>
						</select>
						<select name="location">
							<option value="katraj">Katraj</option>
							<option value="hinjewadi">Hinjewadi</option>
							<option value="aundh">Aundh</option>
							<option value="baner">Baner</option>
							<option value="kalyaninagar">
								KalyaniNagar
							</option>
						</select>


				</div>
				<div class="right-form">
					<input name="capacity" type="number" placeholder="Seating Capacity" required="" />
					<input name="cost" type="text" placeholder="Cost per Hour" required="" />
				</div>
				AMENITIES
				<input type="checkbox" name="amenity[]" value="ac" />AC
				<input type="checkbox" name="amenity[]" value="projector" />Projector
				<input type="checkbox" name="amenity[]" value="whiteboard" />Whiteboard
				<input type="checkbox" name="amenity[]" value="pantry" />Pantry
				<input type="checkbox" name="amenity[]" value="wifi" />WiFi
				<div class="primary-button">
					<button type="submit" id="submit">ADD ROOM NOW!</button>
				</div>
				</form>


				<table class="darkTable" style="width:100%;text-align:center;">
					<tr style="background-color:#999999;">
						<th>Room ID</th>
						<th>Name</th>
						<th>Type</th>
						<th>Area</th>
						<th>Seating Capacity</th>
						<th>Cost per hour</th>
						<th>Amenities</th>
						<th>DeleteRoom</th>
					</tr>

					<?php 
						$ROOMS = $db->get_results("SELECT * FROM rooms;");
						foreach($ROOMS as $ROOM) {
							$ACSTR = "no";
							if($ROOM->ac == 1) {
								$ACSTR = "yes";
							}
							$PROSTR = "no";
							if($ROOM->projector == 1) {
								$PROSTR = "yes";
							}
							$WFSTR = "no";
							if($ROOM->wifi == 1) {
								$WFSTR = "yes";
							}
							$WBSTR = "no";
							if($ROOM->whiteboard == 1) {
								$WBSTR = "yes";
							}
							$PANSTR = "no";
							if($ROOM->pantry == 1) {
								$PANSTR = "yes";
							}

							echo "<tr>
							<td>$ROOM->rid</td>
							<td>$ROOM->address</td>
							<td>$ROOM->type</td>
							<td>$ROOM->area</td>
							<td>$ROOM->capacity</td>
							<td>$ROOM->costperslot</td>
							<td>
								<img class=\"ico $ACSTR\" src=\"img/amenity-ac.svg\" title=\"Air Conditioner\" />
								<img class=\"ico $WFSTR\" src=\"img/amenity-wifi.svg\" title=\"WiFi\" />
								<img class=\"ico $WBSTR\" src=\"img/amenity-white-board.svg\" title=\"Whiteboard\" />
								<img class=\"ico $PROSTR\" src=\"img/amenity-projector.svg\" title=\"Projector\" />
								<img class=\"ico $PANSTR\" src=\"img/amenity-pantry.svg\" title=\"Pantry\" />
								<!-- <img class=\"ico\"src=\"img/amenity-ac.svg\" /> -->
							</td>
							<td>
								<form action=\"deleteRoom.php\" method=\"POST\">
									<input type=\"hidden\" name=\"rid\" value=\"$ROOM->rid\">
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