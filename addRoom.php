<?php

include_once("DBconn.php");

session_start();
if($_SESSION["id"] != 0) {
    header("Location: index3.php");
    return;
}

$TYPE;
$AREA;
$COSTPERSLOT;
$CAPACITY;
$AC;
$PROJECTOR;
$WIFI;
$PANTRY;
$WHITEBOARD;
$BACKUP;

if($db->query("INSERT INTO rooms(type, area, costperslot, capacity, ac, projector, wifi, pantry, whiteboard, backup) VALUES ($TYPE, $AREA, $COSTPERSLOT, $CAPACITY, $AC, $PROJECTOR, $WIFI, $PANTRY, $WHITEBOARD, $BACKUP);")) {
    echo "Room Added sucessfully";
    return;
} else {
    header("Location: fail.html");
    return;
}