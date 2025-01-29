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

// Function to insert into vh_banos table
function insertbano($conn, $tagid, $producto, $costo, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_banos (vh_banos_tagid, vh_banos_producto, vh_banos_costo, vh_banos_fecha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("ssds", $tagid, $producto, $costo, $fecha); // Assuming vh_banos_tagid is a string, and others are decimal

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to vacuno_tareas.php after successful insert
        header("Location: vacuno_tareas.php?search=" . urlencode($tagid)); // Pass the tagid back to the page
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
    $tagid = isset($_POST['tagid']) ? $_POST['tagid'] : null; // Ensure you pass tagid from the form
    $producto = isset($_POST['vh_banos_producto']) ? $_POST['vh_banos_producto'] : null;
    $costo = isset($_POST['vh_banos_costo']) ? $_POST['vh_banos_costo'] : null;
    $fecha = isset($_POST['vh_banos_fecha']) ? $_POST['vh_banos_fecha'] : null;

    // Call the insert function
    if ($tagid && $producto !== null && $costo !== null && $fecha) {
        insertbano($conn, $tagid, $producto, $costo, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 