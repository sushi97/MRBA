<?php

include_once("DBconn.php");

if($_SESSION["id"]) {
    header("Location: index.html");
} else {
    $EMAIL = $_POST["log_email"];
    $PASS = $_POST["log_password"];

    if($EMAIL == "admin@mrba.com" && $PASS == "admin") {
        session_start();
        $_SESSION["id"] = 0;
        header("Location: admin_viewBooking.php");
        return;
    }

    $GETROW = $db->get_row("SELECT * FROM customers WHERE email = '$EMAIL';");
    //$db->debug();

    if($GETROW) {
        if($GETROW->pwd == $PASS) { 
            session_start();
            $_SESSION["id"] = $GETROW->cid;
            header("Location: index.php");
            return;
        }else {
            session_unset();
            session_destroy();
            header("Location: invalidpwd.html");
            return;
        }
    }else {
        header("Location: invalidEmail.html");
        return;
    }
}