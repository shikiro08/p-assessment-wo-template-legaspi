<?php
// Establishing the connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'lougeh_db');

// Checking if the connection was successful
if (!$conn) {
    // Display the error if the connection failed
    die('Could not connect: ' . mysqli_connect_error());
}
?>