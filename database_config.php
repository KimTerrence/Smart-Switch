<?php

$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "Appdev";

$conn = new mysqli( $servername, $username, $password, $dbname);        

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>