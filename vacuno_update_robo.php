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

// Function to insert into vh_robo table
function insertRobo($conn, $tagid, $monto, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_robo (vh_robo_tagid, vh_robo_monto, vh_robo_fecha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sds", $tagid, $monto, $fecha);

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
    $monto = isset($_POST['vh_robo_monto']) ? $_POST['vh_robo_monto'] : null;
    $fecha = isset($_POST['vh_robo_fecha']) ? $_POST['vh_robo_fecha'] : null;

    // Call the insert function
    if ($tagid !== null && $monto !== null && $fecha !== null) {
        insertRobo($conn, $tagid, $monto, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 