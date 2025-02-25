<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_mastitis table
function insertMastitis($conn, $tagid, $producto, $costo, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_mastitis (vh_mastitis_tagid, vh_mastitis_producto, vh_mastitis_costo, vh_mastitis_fecha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("ssds", $tagid, $producto, $costo, $fecha); // Assuming vh_mastitis_tagid is a string, and others are decimal

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
    $producto = isset($_POST['vh_mastitis_producto']) ? $_POST['vh_mastitis_producto'] : null;
    $costo = isset($_POST['vh_mastitis_costo']) ? $_POST['vh_mastitis_costo'] : null;
    $fecha = isset($_POST['vh_mastitis_fecha']) ? $_POST['vh_mastitis_fecha'] : null;

    // Call the insert function
    if ($tagid && $producto !== null && $costo !== null && $fecha !== null) {
        insertMastitis($conn, $tagid, $producto, $costo, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 