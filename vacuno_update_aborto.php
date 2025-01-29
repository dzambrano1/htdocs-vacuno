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

// Function to insert into vh_aborto table
function insertAborto($conn, $tagid, $causa, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_aborto (vh_aborto_tagid, vh_aborto_causa, vh_aborto_fecha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sss", $tagid, $causa, $fecha);

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
    $causa = isset($_POST['vh_aborto_causa']) ? $_POST['vh_aborto_causa'] : null;
    $fecha = isset($_POST['vh_aborto_fecha']) ? $_POST['vh_aborto_fecha'] : null;

    // Call the insert function
    if ($tagid !== null && $causa !== null && $fecha !== null) {
        insertAborto($conn, $tagid, $causa, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 