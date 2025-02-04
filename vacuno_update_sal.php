<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_sal table
function insertSal($conn, $tagid, $etapa, $producto, $racion, $costo, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_sal (vh_sal_tagid, vh_sal_etapa, vh_sal_producto, vh_sal_racion, vh_sal_costo, vh_sal_fecha) VALUES (?, ?, ?, ? , ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sssdds", $tagid, $etapa, $producto, $racion, $costo, $fecha);

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
    $tagid = isset($_POST['tagid']) ? $_POST['tagid'] : null;
    $etapa = isset($_POST['vh_sal_etapa']) ? $_POST['vh_sal_etapa'] : null;
    $producto = isset($_POST['vh_sal_producto']) ? $_POST['vh_sal_producto'] : null;
    $racion = isset($_POST['vh_sal_racion']) ? $_POST['vh_sal_racion'] : null;
    $costo = isset($_POST['vh_sal_costo']) ? $_POST['vh_sal_costo'] : null;
    $fecha = isset($_POST['vh_sal_fecha']) ? $_POST['vh_sal_fecha'] : null;

    // Call the insert function
    if ($tagid !== null && $etapa !== null && $producto !== null && $racion !== null && $costo !== null && $fecha !== null) {
        insertSal($conn, $tagid, $etapa, $producto, $racion,$costo, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 