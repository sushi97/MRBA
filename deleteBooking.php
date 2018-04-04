<?php

include_once("DBconn.php");

session_start();
if($_SESSION["id"] != 0) {
    header("Location: index3.php");
    return;
}

$BID = $_POST["bid"];

if($db->query("DELETE FROM bookings WHERE bid = $BID;")) {
    header("Location: admin_viewBooking.php");
    return;
} else {
    header("Location: fail.html");
    return;
}