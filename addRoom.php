<?php

include_once("DBconn.php");

session_start();
if($_SESSION["id"] != 0) {
    header("Location: index3.php");
    return;
}

$ADDRESS = $_POST["address"];
$TYPE = $_POST["type"];
$LOCATION = $_POST["location"] ;
$COSTPERSLOT = (integer)$_POST["cost"];
$CAPACITY = $_POST["capacity"];
$AMENITY = $_POST["amenity"];
$AC = 0;
$PROJECTOR = 0;
$WIFI = 0;
$PANTRY = 0;
$WHITEBOARD = 0;

//echo gettype($AMENITY);
foreach($AMENITY as $ITEM) {
    switch($ITEM) {
        case "ac":
            $AC = 1;
            break;
        case "projector":
            $PROJECTOR = 1;
            break;
        case "wifi":
            $WIFI = 1;
            break;
        case "whiteboard":
            $WHITEBOARD = 1;
            break;
        case "pantry":
            $PANTRY = 1;
            break;
    }
}

if($db->query("INSERT INTO rooms(type, area, costperslot, capacity, ac, projector, wifi, pantry, whiteboard, address) VALUES ('$TYPE', '$LOCATION', $COSTPERSLOT, $CAPACITY, $AC, $PROJECTOR, $WIFI, $PANTRY, $WHITEBOARD, '$ADDRESS');")) {
    header("Location: admin_addRoom.php");
    return;
} else {
    header("Location: fail.html");
    return;
}