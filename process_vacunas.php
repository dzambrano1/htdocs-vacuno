<?php

// local Credentials
// header("Access-Control-Allow-Headers:*");
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ganagram";

// Hostinger credentials
// $servername = "localhost";
// $username = "u568157883_root";
// $password = "Sebastian7754*";
// $dbname = "u568157883_ganagram";

// local Credentials
header("Access-Control-Allow-Headers:*");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ganagram";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Database connection
$conn = new mysqli('localhost', $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$vacunas_nombre_comercial = $_POST['vacunas_nombre_comercial'];
$dosis = $_POST['vacunas_dosis'];
$costo = $_POST['vacunas_costo'];

// Insert data into alimentacion table
$sql = "INSERT INTO vacunas (vacunas_nombre_comercial, vacunas_dosis, vacunas_costo) VALUES ('$vacunas_nombre_comercial', '$dosis', '$costo')";

if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect to config_alimento.php
header("Location: vacuno_configuracion_vacunas.php");
exit();
}
?>