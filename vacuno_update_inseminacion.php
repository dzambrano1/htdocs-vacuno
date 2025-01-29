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

// Function to insert into vh_inseminacion table
function insertInseminacion($conn, $tagid, $numero, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_inseminacion (vh_inseminacion_tagid, vh_inseminacion_numero, vh_inseminacion_fecha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sis", $tagid, $numero, $fecha);

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
    $numero = isset($_POST['vh_inseminacion_numero']) ? $_POST['vh_inseminacion_numero'] : null;
    $fecha = isset($_POST['vh_inseminacion_fecha']) ? $_POST['vh_inseminacion_fecha'] : null;

    // Call the insert function
    if ($tagid !== null && $numero !== null && $fecha !== null) {
        insertInseminacion($conn, $tagid, $numero, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 