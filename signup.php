<?php

include_once("DBconn.php");

$FULLNAME = $_POST["name"];
$NAME = explode(" ", $FULLNAME);
$EMAIL = $_POST["email"];
$PHONENO = $_POST["phoneno"];
$PASS = $_POST["password"];

if($db->query("INSERT INTO customers (fname,lname,phone,email,pwd) VALUES ( '$NAME[0]', '$NAME[1]', '$PHONENO', '$EMAIL', '$PASS');")) {
    session_start();
    $_SESSION["id"] = $db->get_var("SELECT cid FROM customers WHERE email = '$EMAIL';");
    header("Location: index3.php");
}
else {
    header("Location: fail.html");
}