<?php

include_once("DBconn.php");

session_start();
if($_SESSION["id"] != 0) {
    header("Location: index3.php");
    return;
}

$RID;

if($db->query("DELETE FROM rooms WHERE rid = $RID;")) {
    echo "Room Deleted sucessfully";
    return;
} else {
    header("Location: fail.html");
    return;
}