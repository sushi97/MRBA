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
						$ID = $_SESSION["id"];
						if($ID == 0) {
                            session_unset();
							session_destroy();
							header("Location: index3.php");
						}else {
							$CUST = $db->get_row("SELECT * FROM customers WHERE cid = $ID");
							if($CUST) {
								echo "<div>$CUST->fname $CUST->lname</div> <div class=\"primary-button\" id=\"LogoutButton\"><a>Logout</a></div><div class=\"primary-button\"><a href=\"myProfile.php\">Profile</a></div>";
							} else {
								session_unset();
                                session_destroy();
                                header("Location: index.php");
							}
						}
					} else {
                        header("Location: index3.php");
                    }
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
                        <li class="selected">
                            <a href="#0">
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
            <h1>BOOK NOW</h1>
            <span>CHOOSE YOUR REQUIREMENTS AND WE WILL PROVIDE YOU WITH OUR BEST OPTIONS</span>
        </div>

        <div class="content first-content">
            <div class="tot">
                <div class="left-info">
                    <form id="findroom" action="book.php" method="post">
                        <p>
                            When do you want the room?
                        </p>
                        <br />
                        <div class="upper-form">
                            <input name="book_date" type="date" id="book_date" placeholder="Booking Date" required="" />
                            <br />
                            <p>
                                What type of room do you want?
                            </p>
                            <br />
                            <select name="type">
                                <option value="board">Board Room</option>
                                <option value="conference">Conference Room</option>
                                <option value="meeting">Meeting Room</option>
                                <option value="training">Training Room</option>
                            </select>
                        </div>

                </div>

                <div class="right-info">
                    <p>
                        Where exactly do you want your room?
                    </p>
                    <br />
                    <div class="upper-form">
                        <select name="location">
                            <option value="katraj" selected>Katraj</option>
                            <option value="hinjewadi">Hinjewadi</option>
                            <option value="aundh">Aundh</option>
                            <option value="baner">Baner</option>
                            <option value="kalyaninagar">KalyaniNagar</option>
                        </select>
                        <div class="primary-button">
                            <button type="submit" id="submit">GET AVAILABLE ROOMS!</button>
                        </div>
                    </div>

                    </form>
                </div>
                <table class="darkTable" style="width:100%;text-align:center;">
                    <tr style="background-color:#999999;">
                        <th>Room ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Area</th>
                        <th>Seating Capacity</th>
                        <th>Cost per hour</th>
                        <th>Amenities</th>
                        <th>Time Slots</th>
                        <th>Book Room</th>

                    </tr>

                    <?php
                        $TYPE = $_POST["type"];
                        $LOCATION = $_POST["location"] ;
                        $DATE = $_POST["book_date"];

                        if(isset($_POST["book_date"])){

						$ROOMS = $db->get_results("SELECT * FROM rooms WHERE type='$TYPE' OR area='$LOCATION';");
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

                            $BOOKINGS = $db->get_results("SELECT * FROM bookings WHERE rid = $ROOM->rid AND bookdate='$DATE';");

                            $SLOTS = array("", "", "", "", "", "", "", "");
                            if($BOOKINGS) {
                                foreach($BOOKINGS as $BOOKING) {
                                    $SLOTS[$BOOKING->slot_no] = "disabled";
                                }
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
                            <form name=\"timeslot\" action=\"addBookings.php\" method=\"post\">
                                <input type=\"checkbox\" name=\"slot[]\" value=\"0\" title=\"8AM - 10AM\" $SLOTS[0]>
                                <input type=\"checkbox\" name=\"slot[]\" value=\"1\" title=\"10AM - 12PM\" $SLOTS[1]>
                                <input type=\"checkbox\" name=\"slot[]\" value=\"2\" title=\"12PM - 2PM\" $SLOTS[2]>
                                <input type=\"checkbox\" name=\"slot[]\" value=\"3\" title=\"2PM - 4PM\" $SLOTS[3]>
                                <input type=\"checkbox\" name=\"slot[]\" value=\"4\" title=\"4PM - 6PM\" $SLOTS[4]>
                                <input type=\"checkbox\" name=\"slot[]\" value=\"5\" title=\"6PM - 8PM\" $SLOTS[5]>
                                <input type=\"checkbox\" name=\"slot[]\" value=\"6\" title=\"8PM - 10PM\" $SLOTS[6]>
                                <input type=\"checkbox\" name=\"slot[]\" value=\"7\" title=\"10PM - 12AM\" $SLOTS[7]>
                            
                            </td>
                            <td>
                                    <input type=\"hidden\" name=\"bookdate\" value=\"$DATE\">
                                    <input type=\"hidden\" name=\"cid\" value=\"$ID\">
									<input type=\"hidden\" name=\"rid\" value=\"$ROOM->rid\">
									<input type=\"submit\" value=\"Book\">
								</form>
							</td>
						</tr>";
						}
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