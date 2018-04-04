<?php

include_once("DBconn.php");

session_start();
if($_SESSION["id"] == 0) {
    header("Location: index3.php");
    return;
}

$CID = $_POST["cid"];
$RID = $_POST["rid"];
$BOOKDATE = $_POST["bookdate"];
$SLOTNOS= $_POST["slot"];
var_dump($SLOTNOS);

for($I=0; $I<count($SLOTNOS); $I++) {
	if($db->query("INSERT INTO bookings(cid, rid, bookdate, slot_no) VALUES ($CID, $RID, '$BOOKDATE', $SLOTNOS[$I]);")){
	} else {
		$db->query("DELETE FROM bookings WHERE rid=$RID AND cid=$CID AND bookdate='$BOOKDATE';");
		header("Location: fail.html");
		return;
	}
}

header("Location: success.html");
return;