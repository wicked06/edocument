<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "edocumentdb";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_errno) {
    echo "$conn->connect_error";
    die("Connection Failed: ".$conn->connect_error);
}

?>