<?php

require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

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