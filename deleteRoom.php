<?php

include_once("DBconn.php");

session_start();
if($_SESSION["id"] != 0) {
    header("Location: index3.php");
    return;
}

$RID = $_POST["rid"];
var_dump($RID);

if($db->query("DELETE FROM rooms WHERE rid = $RID;")) {
    header("Location: admin_addRoom.php");
    return;
} else {
    header("Location: fail.html");
    return;
}