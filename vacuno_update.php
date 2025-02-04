<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

// Database connection
$conn = new mysqli('localhost', $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $tagid = $_POST['tagid'];
    $nombre = $_POST['nombre'];
    $raza = $_POST['raza'];
    $etapa = $_POST['etapa'];
    $grupo = $_POST['grupo'];
    $estatus = $_POST['estatus'];

    // Fetch the existing image path from the database
    $sql_existing = "SELECT image FROM vacuno WHERE tagid=?";
    $stmt_existing = $conn->prepare($sql_existing);
    $stmt_existing->bind_param("s", $tagid);
    $stmt_existing->execute();
    $stmt_existing->bind_result($existingImagePath);
    $stmt_existing->fetch();
    $stmt_existing->close();

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // New image uploaded
        $target_dir = "uploads/"; // Ensure this directory exists
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // File is successfully uploaded
            $imagePath = $target_file; // Use the new image path
        } else {
            // Handle error
            $imagePath = $existingImagePath; // Fallback to existing image
        }
    } else {
        // No new image uploaded, keep the existing image
        $imagePath = $existingImagePath;
    }

    // Update the vacuno table
    $sql = "UPDATE vacuno SET nombre=?, raza=?, etapa=?, grupo=?, estatus=?, image=? WHERE tagid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $raza, $etapa, $grupo, $estatus, $imagePath, $tagid);

    if ($stmt->execute()) {
        // Redirect to inventario_vacuno.php after successful update
        header("Location: inventario_vacuno.php?update=success");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
