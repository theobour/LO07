<?php
function Connect()
{
 $dbhost = "innovuttbvbdd.mysql.db";
 $dbuser = "innovuttbvbdd";
 $dbpass = "gpaluNT0";
 $dbname = "innovuttbvbdd";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);

 if (!$conn->set_charset("utf8")) {
    exit();
} else {
}
 return $conn;
}
?>