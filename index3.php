<html>

<head>
    <title>sign up and login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <!-- <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->
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
                                        echo "<div>$CUST->fname $CUST->lname</div> <div class=\"primary-button\" id=\"LogoutButton\"><a>Logout</a></div><div class=\"primary-button\" id=\"LogoutButton\"><a href=\"myProfile.php\">Profile</a></div>";
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
                    <li>
                        <a href="index.php">
                            <div class="image-icon">
                                <img src="img/home-icon.png">
                            </div>
                            <h6>WELCOME</h6>
                        </a>
                    </li>
                    <li class="selected">
                        <a href="#0">
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
            <h1>SIGN UP</h1>
            <span>YOU'RE JUST MINUTES AWAY FROM BOOKING YOUR FIRST ROOM</span>
        </div>
        <div class="content first-content">

            <div class="tot">
                <div class="left-info">
                    <form id="login" action="login.php" method="post">
                        <p>
                            Already registered? LOGIN
                        </p>
                        <br />
                        <div class="upper-form">
                            <input name="log_email" type="email" id="log_email" placeholder="Registered Email ID" required="" />
                            <input name="log_password" type="password" id="log_password" placeholder="password" required="" />
                            <br />
                            <div class="primary-button">
                                <button type="submit" id="log_submit" class=>LOGIN!</button>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="right-info">
                    <p>
                        First time here? Signup!
                    </p>
                    <form id="signup" action="signup.php" method="post">
                        <div class="upper-form">
                            <div class="left-form">
                                <input name="name" type="text" id="name" placeholder="Your Name" required="">
                            </div>
                            <div class="right-form">
                                <input name="email" type="email" id="email" placeholder="Email" required="">
                            </div>
                        </div>
                        <div class="bottom-form">
                            <div class="left-form">
                                <input name="phoneno" type="text" id="phoneno" placeholder="Enter your Phone No" required="">
                            </div>

                            <div class="right-form">
                                <input name="password" type="password" id="password" placeholder="Your Password" required="">
                            </div>
                            <input type="checkbox" name="agree" id="agree" required="" />By continuing, I agree with the terms and conditions.
                            <div class="primary-button">
                                <button type="submit" id="submit">SIGN UP NOW!</button>
                            </div>
                    </form>
                    </div>
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
        LogoutButton.addEventListener('click', logout, false);
    </script>
</body>

</html>