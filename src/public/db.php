<?php

// Create connection
$servername = "localhost";
$username = "root";
$password = "qwe123edc";
$dbname = "books";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
