<html>

<head>
    <title>contact us page</title>
    <link rel="stylesheet" href="style2.css">
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
                            if($_SESSION["id"]) {
                                $ID = $_SESSION["id"];
                                if($ID == 0) {
                                    header("Location: admin.html");
                                }else {
                                    $CUST = $db->get_row("SELECT * FROM customers WHERE cid = $ID");
                                    if($CUST) {
                                        echo "$CUST->fname $CUST->lname <div class=\"primary-button\" id=\"LogoutButton\"><button>Logout</button></div>";
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
                    <li class="selected">
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
            <h1>CONTACT US</h1>
            <span>YOU'LL BE RESPONDED WITHIN 48 HOURS</span>
        </div>
        <div class="content first-content">

            <div class="tot">
                <div class="left-info">
                    <p>Please fill up the details in case of any queries and we will get back to you in no time. In case of
                        further correspondance, you may visit our office below:
                        <br>
                        <br>
                        <em>Lab A314 Computer Department
                            <br>PICT, Pune 411043</em>
                    </p>
                </div>

                <div class="right-info">
                    <form id="contact" action="" method="post">
                        <div class="upper-form">
                            <div class="left-form">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Your Name" required=""> </div>
                            <div class="right-form">
                                <input name="email" type="email" class="form-control" id="email" placeholder="Email" required="">
                            </div>
                        </div>
                        <div class="bottom-form">
                            <div class="bt">

                                <textarea name="message" rows="7" class="form-control" id="message" placeholder="Message" required=""></textarea>
                            </div>
                            <div class="primary-button">
                                <!-- <a href="#">Send Message</a> -->
                                <button type="submit" id="form-submit">Send Message</button>
                            </div>
                        </div>

                    </form>
                </div>
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