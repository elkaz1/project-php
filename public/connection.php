<?php
$mysqli = new mysqli("localhost", "root", "", "phpproject");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
