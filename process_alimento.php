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
    $alimento = $_POST['alimento'];
    $tipo = $_POST['tipo'];
    $etapa = $_POST['etapa'];
    $racion = $_POST['racion'];
    $costo = $_POST['costo'];

    // Insert data into alimentacion table
    $sql = "INSERT INTO alimentacion (nombre_producto, tipo, etapa, racion, costo) VALUES ('$alimento', '$tipo', '$etapa', '$racion', '$costo')";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Redirect to config_alimento.php
    header("Location: vacuno_configuracion_alimentacion.php");
    exit();
}
?>