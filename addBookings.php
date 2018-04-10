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
                            if(isset($_SESSION["id"])) {
                                $ID = $_SESSION["id"];
                                if($ID == 0) {
                                    header("Location: admin.html");
                                }else {
                                    $CUST = $db->get_row("SELECT * FROM customers WHERE cid = $ID");
                                    if($CUST) {
                                        echo "<div>$CUST->fname $CUST->lname</div> <div class=\"primary-button\" id=\"LogoutButton\"><a>Logout</a></div><div class=\"primary-button\"><a href=\"myProfile.php\">Profile</a></div>";
                                    } else {
                                        session_unset();
                                        session_destroy();
                                    }
                                }
							}
							if(isset($_POST["cid"])){
							$CID = $_POST["cid"];}
							if(isset($_POST["rid"])){
							$RID = $_POST["rid"];}
							if(isset($_POST["bookdate"])){
							$BOOKDATE = $_POST["bookdate"];}
							if(isset($_POST["slot"])){
								$SLOTNOS= $_POST["slot"];}
							
							for($I=0; $I<count($SLOTNOS); $I++) {
								if($db->query("INSERT INTO bookings(cid, rid, bookdate, slot_no) VALUES ($CID, $RID, '$BOOKDATE', $SLOTNOS[$I]);")){
								} else {
									$db->query("DELETE FROM bookings WHERE rid=$RID AND cid=$CID AND bookdate='$BOOKDATE';");
									header("Location: fail.html");
									return;
								}
							}
							$FETCH=$db->query("SELECT ")
							// echo "hi";
							 //header("Location: addBookings.php");
							// return;
						?>

				</div>
				<span class="cd-marker item-1"></span>
				<ul>
					<li>
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
						<a href="#0">
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
			<h1>YOUROOMS</h1>
			<span>SIMPLE AND EFFECTIVE MEETING ROOM MANAGEMENT SYSTEM</span>
		</div>

		<div class="content first-content">
			<h4>YOU HAVE SUCCESSFULLY BOOKED YOUR ROOM</h4>
			<p>Please reach the location 15 minutes prior to the booking time and meet the Yourooms representative.</p>
		
			<div class="primary-button">
				<a href="book.php">Book Another Room!</a>
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
		(logoutButton) ? logoutButton.addEventListener('click', logout, false): null;
	</script>
</body>

</html>