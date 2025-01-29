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

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
if (
    !isset($data['id']) ||
    !isset($data['prenez_numero']) ||
    !isset($data['prenez_fecha'])
) {
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos'
    ]);
    exit;
}

$id = $conn->real_escape_string($data['id']);
$prenez_numero = $conn->real_escape_string($data['prenez_numero']);
$prenez_fecha = $conn->real_escape_string($data['prenez_fecha']);

try {
    // Begin transaction
    $conn->begin_transaction();

    // Update the vacuno table
    $stmtUpdate = $conn->prepare("UPDATE vacuno SET tareas_prenez_numero = ?, tareas_prenez_fecha = ? WHERE id = ?");
    $stmtUpdate->bind_param("sss", $prenez_numero, $prenez_fecha, $id);
    if (!$stmtUpdate->execute()) {
        throw new Exception("Error al ejecutar la actualización: " . $stmtUpdate->error);
    }
    $stmtUpdate->close();

    // Retrieve the current tagid for the animal
    $stmtTag = $conn->prepare("SELECT tagid FROM vacuno WHERE id = ?");
    $stmtTag->bind_param("i", $id);
    $stmtTag->execute();
    $resultTag = $stmtTag->get_result();
    if ($resultTag->num_rows === 0) {
        throw new Exception("Animal con ID $id no encontrado.");
    }
    $rowTag = $resultTag->fetch_assoc();
    $tagid = $rowTag['tagid'];
    $stmtTag->close();

    // Insert into h_prenez table
    $stmtInsert = $conn->prepare("INSERT INTO v_historicos_tareas_prenez (historicos_tareas_prenez_tagid, historicos_tareas_prenez_numero, historicos_tareas_prenez_fecha) VALUES (?, ?, ?)");
    $stmtInsert->bind_param("sss", $tagid, $prenez_numero, $prenez_fecha);
    if (!$stmtInsert->execute()) {
        throw new Exception("Error al insertar en h_prenez: " . $stmtInsert->error);
    }
    $stmtInsert->close();

    // Commit transaction
    $conn->commit();

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Información de preñez actualizada correctamente.'
    ]);
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();

    // Return error response
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$conn->close();
?> 