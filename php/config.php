<?php
session_start();
$host = "localhost";
$dbname = "kilicit";
$user = "root";
$passwort = "";

$conn = mysqli_connect($host, $user, $passwort, $dbname);
if ($conn->connect_error) {
    echo "$conn->connect_error";
  die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$sql = "SELECT * FROM settings";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $setting["maintenance"] = $row["maintenance"];
}


?>