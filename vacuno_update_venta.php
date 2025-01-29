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


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_venta table
function insertVenta($conn, $tagid, $monto, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_venta (vh_venta_tagid, vh_venta_monto, vh_venta_fecha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sss", $tagid, $monto, $fecha);

    // Execute the statement
    if ($stmt->execute()) {        
        header("Location: vacuno_tareas.php?search=" . urlencode($tagid));
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $tagid = isset($_POST['tagid']) ? $_POST['tagid'] : null;
    $monto = isset($_POST['vh_venta_monto']) ? $_POST['vh_venta_monto'] : null;
    $fecha = isset($_POST['vh_venta_fecha']) ? $_POST['vh_venta_fecha'] : null;

    // Call the insert function
    if ($tagid !== null && $monto !== null && $fecha !== null) {
        insertVenta($conn, $tagid, $monto, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 