<?php
$HOSTNAME = "localhost";
$USERNAME = "root";
$PASSWORD = "trplm1980";
$DBNAME = "hoteldb";

mysqli_report(MYSQLI_REPORT_STRICT);
//Connect to database
$conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DBNAME);

//test connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>