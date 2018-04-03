<?php
// Include ezSQL core
include_once "ezSQL/shared/ez_sql_core.php";
// Include ezSQL database specific component (in this case mySQL)
include_once "ezSQL/mysqli/ez_sql_mysqli.php";
// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host

$db = new ezSQL_mysqli('user','user','mrba','localhost');

