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
                                    header("Location: admin.html");
                                }else {
                                    $CUST = $db->get_row("SELECT * FROM customers WHERE cid = $ID");
                                    if($CUST) {
                                        echo "$CUST->fname $CUST->lname <div class=\"primary-button\" id=\"LogoutButton\"><a>Logout</a></div>";
                                    } else {
                                        session_unset();
                                        session_destroy();
                                    }
                                }
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
                            <h6>HOME</h6>
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
            <h1>YOUROOMS</h1>
            <span>SIMPLE AND EFFECTIVE MEETING ROOM MANAGEMENT SYSTEM</span>
        </div>

        <div class="content first-content">
            <h4>LET'S TALK ABOUT YOUROOMS</h4>
            <p>YOUROOMS is a web based booking software package that makes it easy for you to manage rooms and resources and
                to book a room anywhere, even if it is in a different location. Use our meeting rooms for presentations,
                interviews, client pitches or training for your company. We also provide a number of meeting spaces as conference
                rooms and boardrooms for rent. Catering, coffee service, projection equipment and other services are available
                to ensure you have everything you need for your meeting. Just show up and get started.</p>
            <div class="primary-button">
                <a href="#">Book Now!</a>
            </div>
        </div>
    </div>
    <footer>
        <p>Copyright &copy; 2018 YOUROOMS | Designed by Tejas Srivastava</p>
    </footer>
    <script type="text/javascript">
        function logout() {
            document.location = 'logout.php';
        }
        LogoutButton.addEventListener('click', logout, false);
    </script>
</body>

</html>