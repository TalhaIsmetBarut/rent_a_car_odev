<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "rentacar";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    print('Connection error: ' . mysqli_connect_error());
}
?>
