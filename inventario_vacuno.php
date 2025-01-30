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

// Initialize filters
$filters = array();
$filterValues = array(    
    'genero' => array(),
    'raza' => array(),
    'grupo' => array(),
    'etapa' => array(),
    'estatus' => array()
);

// At the beginning of your PHP code, create the filter logic
$where_conditions = [];
$params = [];

// Build conditions in order (cascade from left to right)
if (!empty($_GET['genero'])) {
    $where_conditions[] = "genero = ?";
    $params[] = $_GET['genero'];
}
if (!empty($_GET['raza'])) {
    $where_conditions[] = "raza = ?";
    $params[] = $_GET['raza'];
}
if (!empty($_GET['etapa'])) {
    $where_conditions[] = "etapa = ?";
    $params[] = $_GET['etapa'];
}
if (!empty($_GET['grupo'])) {
    $where_conditions[] = "grupo = ?";
    $params[] = $_GET['grupo'];
}
if (!empty($_GET['estatus'])) {
    $where_conditions[] = "estatus = ?";
    $params[] = $_GET['estatus'];
}

// Create the WHERE clause
$where_clause = !empty($where_conditions) ? " WHERE " . implode(" AND ", $where_conditions) : "";

// Prepare and execute the query using prepared statements
$sql = "SELECT id, tagid, nombre, genero, raza, etapa, grupo, estatus, fecha_nacimiento, image 
        FROM vacuno" . $where_clause . " ORDER BY tagid ASC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Debug query
$debug_sql = $sql;
foreach ($params as $param) {
    $debug_sql = preg_replace('/\?/', "'" . $param . "'", $debug_sql, 1);
}
error_log("Executed query: " . $debug_sql);

// Use this same $result for both your cards and DataTable


// Fetch counts for each filter category based on current filters

// Sexo Counts
$sexoCountsQuery = "SELECT genero, COUNT(*) as count FROM vacuno";
if (!empty($whereClause)) {
    $sexoCountsQuery .= " WHERE " . implode(' AND ', $whereClause);
}
$sexoCountsQuery .= " GROUP BY genero";

$sexoCountsResult = $conn->query($sexoCountsQuery);

$sexoLabels = [];
$sexoCounts = [];

if ($sexoCountsResult && $sexoCountsResult->num_rows > 0) {
    while ($row = $sexoCountsResult->fetch_assoc()) {
        $sexoLabels[] = $row['genero'];
        $sexoCounts[] = $row['count'];
    }
} else {
    // Handle case when there are no records
    $sexoLabels = ['No Data'];
    $sexoCounts = [0];
}

// Raza Counts
$razaCountsQuery = "SELECT raza, COUNT(*) as count FROM vacuno";
if (!empty($whereClause)) {
    $razaCountsQuery .= " WHERE " . implode(' AND ', $whereClause);
}
$razaCountsQuery .= " GROUP BY raza";

$razaCountsResult = $conn->query($razaCountsQuery);

$razaLabels = [];
$razaCounts = [];

if ($razaCountsResult && $razaCountsResult->num_rows > 0) {
    while ($row = $razaCountsResult->fetch_assoc()) {
        $razaLabels[] = $row['raza'];
        $razaCounts[] = $row['count'];
    }
} else {
    $razaLabels = ['No Data'];
    $razaCounts = [0];
}

// Etapa Counts
$etapaCountsQuery = "SELECT etapa, COUNT(*) as count FROM vacuno";
if (!empty($whereClause)) {
    $etapaCountsQuery .= " WHERE " . implode(' AND ', $whereClause);
}
$etapaCountsQuery .= " GROUP BY etapa";

$etapaCountsResult = $conn->query($etapaCountsQuery);

$etapaLabels = [];
$etapaCounts = [];

if ($etapaCountsResult && $etapaCountsResult->num_rows > 0) {
    while ($row = $etapaCountsResult->fetch_assoc()) {
        $etapaLabels[] = $row['etapa'];
        $etapaCounts[] = $row['count'];
    }
} else {
    $etapaLabels = ['No Data'];
    $etapaCounts = [0];
}

// Grupos Counts
$grupoCountsQuery = "SELECT grupo, COUNT(*) as count FROM vacuno";
if (!empty($whereClause)) {
    $grupoCountsQuery .= " WHERE " . implode(' AND ', $whereClause);
}
$grupoCountsQuery .= " GROUP BY grupo";

$grupoCountsResult = $conn->query($grupoCountsQuery);

$grupoLabels = [];
$grupoCounts = [];

if ($grupoCountsResult && $grupoCountsResult->num_rows > 0) {
    while ($row = $grupoCountsResult->fetch_assoc()) {
        $grupoLabels[] = $row['grupo'];
        $grupoCounts[] = $row['count'];
    }
} else {
    $grupoLabels = ['No Data'];
    $grupoCounts = [0];
}

// Estatus Counts
$estatusCountsQuery = "SELECT estatus, COUNT(*) as count FROM vacuno";
if (!empty($whereClause)) {
    $estatusCountsQuery .= " WHERE " . implode(' AND ', $whereClause);
}
$estatusCountsQuery .= " GROUP BY estatus";

$estatusCountsResult = $conn->query($estatusCountsQuery);

$estatusLabels = [];
$estatusCounts = [];

if ($estatusCountsResult && $estatusCountsResult->num_rows > 0) {
    while ($row = $estatusCountsResult->fetch_assoc()) {
        $estatusLabels[] = $row['estatus'];
        $estatusCounts[] = $row['count'];
    }
} else {
    $estatusLabels = ['No Data'];
    $estatusCounts = [0];
}

// Calculate totals for percentage calculations if needed
$totalSexo = array_sum($sexoCounts);
$totalRaza = array_sum($razaCounts);
$totalEtapa = array_sum($etapaCounts);
$totalGrupo = array_sum($grupoCounts);
$totalEstatus = array_sum($estatusCounts);

// Fetch tagids based on current filters
$tagidsQuery = "SELECT tagid FROM vacuno";
if (!empty($whereClause)) {
    $tagidsQuery .= " WHERE " . implode(' AND ', $whereClause);
}
$tagidsResult = $conn->query($tagidsQuery);

$tagids = [];
if ($tagidsResult && $tagidsResult->num_rows > 0) {
    while ($row = $tagidsResult->fetch_assoc()) {
        $tagids[] = "'" . $conn->real_escape_string($row['tagid']) . "'";
    }
}

// If no tagids are found, set to an array with a dummy value to prevent SQL errors
if (empty($tagids)) {
    $tagids[] = "'NONE'";
}

// Calculate average peso per month
$avgPesoQuery = "
    SELECT 
        DATE_FORMAT(vh_peso_fecha, '%Y-%m') AS peso_month, 
        AVG(vh_peso_animal) AS average_weight 
    FROM 
        vh_peso 
    WHERE 
        vh_peso_tagid IN (" . implode(',', $tagids) . ") 
    GROUP BY 
        peso_month 
    ORDER BY 
        peso_month ASC
";

// Calculate average Leche peso per month
$avgLecheQuery = "
    SELECT 
        DATE_FORMAT(vh_leche_fecha, '%Y-%m') AS leche_month, 
        AVG(vh_leche_peso) AS average_leche 
    FROM 
        vh_leche
    WHERE 
        vh_leche_tagid IN (" . implode(',', $tagids) . ") 
    GROUP BY 
        leche_month 
    ORDER BY 
        leche_month ASC
";

$avgPesoResult = $conn->query($avgPesoQuery);
$avgLecheResult = $conn->query($avgLecheQuery);

$avgPesoLabels = [];
$avgPesoData = [];

$avgLecheLabels = [];
$avgLecheData = [];

if ($avgPesoResult && $avgPesoResult->num_rows > 0) {
    while ($row = $avgPesoResult->fetch_assoc()) {
        $avgPesoLabels[] = $row['peso_month'];
        $avgPesoData[] = round($row['average_weight'], 2);
    }
} else {
    // Handle case when there are no records
    $avgPesoLabels = ['No Data'];
    $avgPesoData = [0];
}

if ($avgLecheResult && $avgLecheResult->num_rows > 0) {
    while ($row = $avgLecheResult->fetch_assoc()) {
        $avgLecheLabels[] = $row['leche_month'];
        $avgLecheData[] = round($row['average_leche'], 2);
    }
} else {
    // Handle case when there are no records
    $avgLecheLabels = ['No Data'];
    $avgLecheData = [0];
}

// Fetch average monthly vh_concentrado_racion * vh_concentrado_costo from vh_concentrado table
$avgRacionQuery = "
    SELECT 
        DATE_FORMAT(vh_concentrado_fecha, '%Y-%m') AS racion_month,
        AVG(vh_concentrado_racion * vh_concentrado_costo) AS average_racion_cost
    FROM 
        vh_concentrado
    GROUP BY 
        racion_month
    ORDER BY 
        racion_month ASC
";

$avgRacionResult = $conn->query($avgRacionQuery);

$avgRacionLabels = [];
$avgRacionData = [];
$avgRacionCumulativeData = []; // New array for cumulative data

if ($avgRacionResult && $avgRacionResult->num_rows > 0) {
    while ($row = $avgRacionResult->fetch_assoc()) {
        $avgRacionLabels[] = $row['racion_month'];
        $avgRacionData[] = round($row['average_racion_cost'], 2);
    }
    
    // Calculate cumulative sum
    $cumulativeSum = 0;
    foreach ($avgRacionData as $data) {
        $cumulativeSum += $data;
        $avgRacionCumulativeData[] = round($cumulativeSum, 2);
    }
} else {
    // Handle case when there are no records
    $avgRacionLabels = ['No Data'];
    $avgRacionData = [0];
    $avgRacionCumulativeData = [0];
}

// Function to generate random colors for datasets
function getRandomColor($alpha = 1) {
    $rand = rand(0, 255);
    $rand2 = rand(0, 255);
    $rand3 = rand(0, 255);
    return "rgba($rand, $rand2, $rand3, $alpha)";
}

// Fetch unique tagids from v_historicos_tareas_partos
$tagidQuery = "SELECT DISTINCT vh_parto_tagid FROM vh_parto";
$tagidResult = $conn->query($tagidQuery);

$tagids = [];
if ($tagidResult && $tagidResult->num_rows > 0) {
    while ($row = $tagidResult->fetch_assoc()) {
        $tagids[] = $row['vh_parto_tagid'];
    }
}

// Fetch parto data grouped by year-month and tagid
$partoQuery = "
     SELECT 
         DATE_FORMAT(vh_parto_fecha, '%Y-%m') AS yearmonth,
         vh_parto_tagid,
         SUM(vh_parto_numero) AS total_parto
     FROM 
         vh_parto
     GROUP BY 
         DATE_FORMAT(vh_parto_fecha, '%Y-%m'), vh_parto_tagid
     ORDER BY 
         DATE_FORMAT(vh_parto_fecha, '%Y-%m') ASC
";

// **Depuración: Imprimir la consulta SQL**
echo "<!-- Query Ejecutada: $partoQuery -->";

$partoResult = $conn->query($partoQuery);

// Initialize arrays for labels and datasets
$labels = [];
$datasets = [];

if ($partoResult && $partoResult->num_rows > 0) {
    $rawData = [];
    while ($row = $partoResult->fetch_assoc()) {
        $labels[] = $row['yearmonth'];
        $tagid = $row['vh_parto_tagid'];
        if (!isset($rawData[$tagid])) {
            $rawData[$tagid] = [];
        }
        // Corrected line: Use 'yearmonth' as the secondary key
        $rawData[$tagid][$row['yearmonth']] = (int)$row['total_parto'];
    }

    // Remove duplicate labels and sort them
    $labels = array_unique($labels);
    sort($labels);

    // Prepare datasets for each tagid
    foreach ($tagids as $tagid) {
        $data = [];
        foreach ($labels as $label) {
            if (isset($rawData[$tagid][$label])) {
                $data[] = $rawData[$tagid][$label];
            } else {
                $data[] = 0; // or null if you prefer gaps
            }
        }

        $datasets[] = [
            'label' => "Tag ID: $tagid",
            'data' => $data,
            'borderColor' => getRandomColor(1),
            'backgroundColor' => getRandomColor(0.5),
            'fill' => false,
        ];
    }
} else {
    // Handle case when there is no data
    $labels = ['No Data'];
    foreach ($tagids as $tagid) {
        $datasets[] = [
            'label' => "Tag ID: $tagid",
            'data' => [0],
            'borderColor' => getRandomColor(1),
            'backgroundColor' => getRandomColor(0.5),
            'fill' => false,
        ];
    }
}

// Encode PHP arrays to JSON for JavaScript
$partoLabelsJson = json_encode($labels);
$partoDatasetsJson = json_encode($datasets);

// Continue with the rest of your PHP code
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Vacuno</title>
    <!-- Link to the Favicon -->
    <link rel="icon" href="images/ganagram_ico.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--Bootstrap 5 Css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        h6 {
            font-size: 0.8rem;
            text-align: center;
            color: red;
        }
    /* DataTables specific styling */
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }

    .dataTables_length,
    .dataTables_filter {
        margin: 15px 0;
    }

    .dataTables_filter {
        text-align: right;
    }

    .dataTables_length select {
        min-width: 70px;
    }

    .dataTables_filter input {
        min-width: 200px;
    }

    .dataTables_info,
    .dataTables_paginate {
        margin: 15px 0;
    }

    /* Ensure the table takes full width */
    table.dataTable {
        width: 100% !important;
        margin: 15px 0 !important;
    }

    /* Make sure controls are visible */
    .dataTables_wrapper .row {
        margin: 10px 0;
        width: 100%;
    }
    
    .table-container {
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin: 20px auto;
        max-width: 95%;
    }

    #vacunoTable {
        font-size: 0.9rem;
    }

    #vacunoTable thead th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        margin-left: 5px;
    }

    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        margin: 0 5px;
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 10px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 5px 10px;
        margin: 0 2px;
        border-radius: 4px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #007bff;
        color: white !important;
        border: none;
    }
    /* Hamburger Button Styling */
        .hamburger {
          position: fixed;
          top: 20px;
          right: 20px;
          z-index: 1100; /* Above the vertical menu */
          background: rgba(186, 245, 238, 0.95); /* Semi-transparent */
          border: none;
          border-radius: 8px;
          padding: 10px;
          cursor: pointer;
          color: black;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: background-color 0.3s;
        }

        .hamburger:hover {
          background-color: rgba(138, 184, 159, 0.95);
        }

        /* Vertical Menu Styling */
        .vertical-menu {
          position: fixed;
          top: 50%;
          right: 20px;
          transform: translateY(-50%);
          background-color: rgba(230, 247, 245, 0.8); /* Semi-transparent */
          border:none;
          border-radius: 8px;
          padding: 10px;
          z-index: 1000;
          display: none; /* Hidden by default */
          flex-direction: column;
          align-items: center;
          transition: opacity 0.3s, visibility 0.3s;
          opacity: 0;
          visibility: hidden;
        }

        .vertical-menu.show {
          display: flex;
          opacity: 1;
          visibility: visible;
        }

        .vertical-menu a {
          display: flex;
          align-items: right;
          justify-content: right;
          color: #000;
          text-decoration: none;
          margin: 5px 0;
          border-radius: 4px;
          transition: background-color 0.3s;
          position: relative;
          width: 30px;
          height: 30px;
        }

        .vertical-menu a {
          padding-left: 100px;
        }

        .vertical-menu a:hover {
          background-color:rgba(138, 184, 159, 0.95);
        }

        .vertical-menu a i {
          font-size: 1.5rem;
        }
        .dropdown-menu{
          background-color: rgba(138, 184, 159, 0.9);
          border: none;
          padding: 5px;
        }

        /* Tooltip Styling */
        .vertical-menu a .tooltip-text {
          visibility: hidden;
          width: 120px;
          background-color: black;
          color: #fff;
          text-align: center;
          border-radius: 6px;
          padding: 5px 0;
          
          /* Position the tooltip */
          position: absolute;
          left: -130px;
          top: 50%;
          transform: translateY(-50%);
          z-index: 1;
          opacity: 0;
          transition: opacity 0.3s;
        }

        .vertical-menu a:hover .tooltip-text {
          visibility: visible;
          opacity: 1;
        }

        /* Arrow for Tooltip */
        .vertical-menu a .tooltip-text::after {
          content: "";
          position: absolute;
          top: 50%;
          left: 100%;
          transform: translateY(-50%);
          border-width: 5px;
          border-style: solid;
          border-color: transparent transparent transparent black;
        }

        /* Media Query for Smaller Screens */
        @media (max-width: 576px) {
          .vertical-menu a {
            width: 50px;
            height: 50px;
          }

          .vertical-menu a .tooltip-text {
            width: 100px;
            left: -110px;
          }
        }
        /* Additional Custom Styles */
        .container {
            margin-top: 80px; /* To prevent content from being hidden behind the fixed menu */
        }
    
        .cards-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 5px;
            padding: 2px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .card {
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 2px;
            text-align: center;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        .avatar {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 3px solid #f0f0f0;
            border-radius: 0%;
            box-shadow: 1 8px 8px rgba(0,0,0,0.1);  
            transition: transform 0.3s;
            cursor: pointer;
        }

        .name {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }

        .title {
            color: #666;
            font-size: 12px;
            margin-bottom: 5px;
            
        }

        .contact-info {
            text-align: left;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: none;
        }

        .contact-info.show {
            display: block;
        }

        .contact-info p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }

        .contact-info i {
            width: 20px;
            margin-right: 8px;
            color: #666;
        }

        .more-details-btn {
            margin-top: 15px;
            padding: 8px 20px;
            background-color: #8ab89f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .more-details-btn:hover {
            background-color: #689260;
        }

        @media (max-width: 1200px) {
            .cards-container {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        @media (max-width: 900px) {
            .cards-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .cards-container {
                grid-template-columns: 1fr;
            }            
        }
        @media (max-width: 370px) {
            .cards-container {
                grid-template-columns: 1fr;
            }
            .filters-container {
                grid-template-columns: 1fr;
            }
        }

        /* Responsive adjustments for .filters-container */
    @media (max-width: 576px) {
    .filters-container {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        padding: 10px; /* Optional: Adjust padding for smaller screens */
    }

    .filters-form {
        display: flex;
        flex-direction: column;
        gap: 15px; /* Space between each filter */
    }

    .form-group {
        width: 100%;
    }

    .new-entry-btn-container {
        display: flex;
        justify-content: center;
        margin-top: 0px; /* Optional: Space above the button */
    }

    .new-entry-btn {
        width: 100%;
        max-width: 100px; /* Optional: Limit the button width */
    }
}

        .filters-container {
            margin: 20px auto;
            padding: 0 20px;
            display: flex;
            justify-content: center; /* Ensures space between form and button */
            align-items: center;
        }

        .filters-form {
            display: flex;
            gap: 20px;
            flex-wrap: nowrap; /* Prevents wrapping to multiple lines */
            justify-content: center;
            align-items: center;
        }

        .filters-form select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: white;
            min-width: 150px; /* Adjust as needed */
            cursor: pointer;
        }

        .filters-form select:hover {
            border-color: #83956e;
        }

        @media (max-width: 1200px) {
            .filters-form select {
                min-width: 130px;
            }
        }

        @media (max-width: 900px) {
            .filters-form select {
                min-width: 110px;
            }
        }

        @media (max-width: 600px) {
            .filters-form select {
                min-width: 90px;
            }
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            padding: 8px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            transition: background-color 0.3s;
        }

        .action-btn.update-btn i {
            color: #4CAF50;
        }

        .action-btn.history-btn i {
            color: #2196F3;
        }

        .action-btn.delete-btn i {
            color: #f44336;
        }

        .new-entry-btn-container{
            align-items: right;
            justify-content: right;
        }

        .new-entry-btn {
            background-color: #83956e;
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 200px;
            transition: background-color 0.3s, transform 0.2s;
            flex-shrink: 0;
        }
        
        .new-entry-btn:hover {
            background-color: #689260;
            transform: scale(1.05);
        }

        .new-entry-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .new-entry-modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 1000px;
            position: relative;
            max-height: 80vh;
            overflow-y: scroll;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: #83956e #f0f0f0;
        }

        /* Webkit (Chrome, Safari, Edge) scrollbar styles */
        .new-entry-modal-content::-webkit-scrollbar {
            width: 8px;
            position: absolute;
            left: 0;
        }

        .new-entry-modal-content::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 4px;
        }

        .new-entry-modal-content::-webkit-scrollbar-thumb {
            background: #83956e;
            border-radius: 4px;
        }

        .new-entry-modal-content::-webkit-scrollbar-thumb:hover {
            background: #689260;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 1px;
        }

        .form-group label {
            display: block;
            margin-bottom: 1px;
        }

        .form-group input,
        .form-group select {
            width: 90%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .submit-btn-container {
            grid-column: 1 / -1;
            text-align: center;
            margin-top: 10px;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-group label {
            display: block;
            margin-bottom: 1px;
        }

        .form-group input,
        .form-group select {
            width: 90%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .submit-btn {
            background-color: #83956e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #689260;
        }

        .image-upload-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-preview {
            width: 55%;
            height: 55%;
            overflow: hidden;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-preview img {
            width: 55%;
            height: 55%;            
            border: none;
            border-radius: 100%;
            object-fit: cover;
        }

        .image-upload-label {
            font-size: 12px;
            color: #000000;
            display: inline-block;
            padding: 8px 16px;
            background-color: #e6f7f5;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .image-upload-label:hover {
            background-color: #a4b3a5;
        }

        #imageUpload {
            display: none;
        }

        .image-column {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .name-column {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .modal-title {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin: 0 0 20px 0;
            padding: 10px 0;
            border-bottom: 2px solid #83956e;
            width: 100%;
        }

        .submit-btn-container {
            margin-top: 20px;
            text-align: center;
            width: 100%;
        }

        .submit-btn {
            background-color: #83956e;
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            max-width: 800px;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #689260;
        }

        .sex-column {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .fields-section {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin: 20px 0;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            justify-content: space-between;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-row:last-child {
            margin-bottom: 0;
        }

        .form-grid-three-columns {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .image-column {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .image-preview {
            width: 200px;
            height: 200px;
            margin: 20px 0;
            overflow: hidden;
            border-radius: 50%;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .center-column,
        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        #newImageUpload {
            display: none;
        }

        .image-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            width: 100%;
        }

        .image-preview {
            width: 200px;
            height: 200px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #f0f0f0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        #imageUpload {
            display: none;
        }

        .form-grid-two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .form-grid-three-columns {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .column {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .action-btn.weight-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            transition: background-color 0.3s;
            vertical-align: middle;
        }

        .action-btn.weight-btn i {
            color: #4CAF50;
            font-size: 14px;
        }

        .action-btn.weight-btn:hover {
            background-color: rgba(76, 175, 80, 0.1);
        }

        .upload-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.7;
            background-color: #7fb38d;
            transition: opacity 0.3s;
        }

        .upload-btn:hover {
            opacity: 1;
            background-color: rgba(104, 146, 96, 0.5);
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 90%; /* Width of the modal */
            max-width: 600px; /* Maximum width */
            border-radius: 8px; /* Rounded corners */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .form-grid-three-columns {
                display: flex;
                flex-direction: column; /* Stack columns vertically on small screens */
            }

            .image-column, .center-column, .right-column {
                width: 100%; /* Full width for each column */
                margin-bottom: 15px; /* Space between columns */
            }

            .image-preview img {
                width: 100%; /* Make the image responsive */
                height: auto; /* Maintain aspect ratio */
            }

            .submit-btn-container {
                text-align: center; /* Center the submit button */
            }
        }
        .card-avatar img{
            width: 150px;
            height: 150px;
        }
        
        h6{
            font-size:0.8rem;
            text-align: center;
            color:red;
        }

        /* Professional DataTable Styling */
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            margin: 20px 0;
        }

        #vacunoTable {
            width: 100% !important;
            background: white;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 4px;
            overflow: hidden;
        }

        #vacunoTable thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 12px 15px;
            border-bottom: 2px solid #83956e;
            white-space: nowrap;
        }

        #vacunoTable tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
            font-size: 0.875rem;
            color: #495057;
        }

        #vacunoTable tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Search and Length Menu Styling */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px 12px;
            margin-left: 8px;
            width: 200px;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 6px 24px 6px 12px;
            margin: 0 8px;
            font-size: 0.875rem;
        }

        /* Pagination Styling */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 15px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 6px 12px;
            margin: 0 3px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background: white;
            color: #495057 !important;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #83956e !important;
            color: white !important;
            border-color: #83956e;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #83956e !important;
            color: white !important;
            border-color: #83956e;
            font-weight: 600;
        }

        /* Info Text Styling */
        .dataTables_wrapper .dataTables_info {
            color: #6c757d;
            font-size: 0.875rem;
            padding-top: 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_filter input {
                width: 150px;
            }

            #vacunoTable thead th,
            #vacunoTable tbody td {
                padding: 8px 10px;
                font-size: 0.8rem;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 4px 8px;
                font-size: 0.8rem;
            }
        }

        /* Striped Rows */
        #vacunoTable tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.02);
        }

        /* Loading State */
        #vacunoTable.dataTable.processing tbody tr {
            opacity: 0.5;
        }

        /* Search Highlight */
        #vacunoTable tbody tr.highlight {
            background-color: #fff3cd;
        }

    </style>

    <!-- Include Chart.js and Chart.js DataLabels Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <!-- Add these in the <head> section, after your existing CSS/JS links -->

    <!-- Place these in the <head> section in this exact order -->

<!-- jQuery Core (main library) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div>
<!-- Filters Form -->
<div class="filters-container">
    <div>
        <a href="http://localhost:3000/inicio.php">
            <img src="http://ganagram.com/wp-content/uploads/2024/04/Ganagram_New_Logo-removebg-preview.png" style="width: 150px; height: 150px;justify-content:space-between;">
        </a>
        <h6>UPV: 01012025-3528</h6>
    </div>
    <div>
        <form method="GET" action="" class="filters-form" style="display: block;margin-top: 20px;padding: 10px;">
            <div class="filters-container" style="text-align: center;">
                <!-- Género/Sexo Filter -->
                <select name="sexo" onchange="this.form.submit()" style="width: 170px;">
                    <option value="">Sexo</option>
                    <option value="Macho" <?php echo (isset($_GET['sexo']) && $_GET['sexo'] === 'Macho') ? 'selected' : ''; ?>>Macho</option>
                    <option value="Hembra" <?php echo (isset($_GET['sexo']) && $_GET['sexo'] === 'Hembra') ? 'selected' : ''; ?>>Hembra</option>
                </select>

                <!-- Raza Filter -->
                <select name="raza" onchange="this.form.submit()" style="width: 170px;">
                    <option value="">Raza</option>
                    <?php
                    $raza_sql = "SELECT DISTINCT raza FROM vacuno";
                    $where_conditions = [];
                    
                    if (!empty($_GET['sexo'])) {
                        $where_conditions[] = "genero = '" . $conn->real_escape_string($_GET['sexo']) . "'";
                    }
                    
                    if (!empty($where_conditions)) {
                        $raza_sql .= " WHERE " . implode(" AND ", $where_conditions);
                    }
                    
                    $result_razas = $conn->query($raza_sql);
                    while ($row = $result_razas->fetch_assoc()) {
                        $selected = (isset($_GET['raza']) && $_GET['raza'] === $row['raza']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($row['raza']) . "' $selected>" . htmlspecialchars($row['raza']) . "</option>";
                    }
                    ?>
                </select>

                <!-- Etapa Filter -->
                <select name="etapa" onchange="this.form.submit()" style="width: 170px;">
                    <option value="">Etapa</option>
                    <?php
                    $etapa_sql = "SELECT DISTINCT etapa FROM vacuno";
                    $where_conditions = [];
                    
                    if (!empty($_GET['sexo'])) {
                        $where_conditions[] = "genero = '" . $conn->real_escape_string($_GET['sexo']) . "'";
                    }
                    if (!empty($_GET['raza'])) {
                        $where_conditions[] = "raza = '" . $conn->real_escape_string($_GET['raza']) . "'";
                    }
                    
                    if (!empty($where_conditions)) {
                        $etapa_sql .= " WHERE " . implode(" AND ", $where_conditions);
                    }
                    
                    $result_etapas = $conn->query($etapa_sql);
                    while ($row = $result_etapas->fetch_assoc()) {
                        $selected = (isset($_GET['etapa']) && $_GET['etapa'] === $row['etapa']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($row['etapa']) . "' $selected>" . htmlspecialchars($row['etapa']) . "</option>";
                    }
                    ?>
                </select>

                <!-- Grupo Filter -->
                <select name="grupo" onchange="this.form.submit()" style="width: 170px;">
                    <option value="">Grupo</option>
                    <?php
                    $grupo_sql = "SELECT DISTINCT grupo FROM vacuno";
                    $where_conditions = [];
                    
                    if (!empty($_GET['sexo'])) {
                        $where_conditions[] = "genero = '" . $conn->real_escape_string($_GET['sexo']) . "'";
                    }
                    if (!empty($_GET['raza'])) {
                        $where_conditions[] = "raza = '" . $conn->real_escape_string($_GET['raza']) . "'";
                    }
                    if (!empty($_GET['etapa'])) {
                        $where_conditions[] = "etapa = '" . $conn->real_escape_string($_GET['etapa']) . "'";
                    }
                    
                    if (!empty($where_conditions)) {
                        $grupo_sql .= " WHERE " . implode(" AND ", $where_conditions);
                    }
                    
                    $result_grupos = $conn->query($grupo_sql);
                    while ($row = $result_grupos->fetch_assoc()) {
                        $selected = (isset($_GET['grupo']) && $_GET['grupo'] === $row['grupo']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($row['grupo']) . "' $selected>" . htmlspecialchars($row['grupo']) . "</option>";
                    }
                    ?>
                </select>

                <!-- Estatus Filter -->
                <select name="estatus" onchange="this.form.submit()" style="width: 170px;">
                    <option value="">Estatus</option>
                    <?php
                    $estatus_sql = "SELECT DISTINCT estatus FROM vacuno";
                    $where_conditions = [];
                    
                    if (!empty($_GET['sexo'])) {
                        $where_conditions[] = "genero = '" . $conn->real_escape_string($_GET['sexo']) . "'";
                    }
                    if (!empty($_GET['raza'])) {
                        $where_conditions[] = "raza = '" . $conn->real_escape_string($_GET['raza']) . "'";
                    }
                    if (!empty($_GET['etapa'])) {
                        $where_conditions[] = "etapa = '" . $conn->real_escape_string($_GET['etapa']) . "'";
                    }
                    if (!empty($_GET['grupo'])) {
                        $where_conditions[] = "grupo = '" . $conn->real_escape_string($_GET['grupo']) . "'";
                    }
                    
                    if (!empty($where_conditions)) {
                        $estatus_sql .= " WHERE " . implode(" AND ", $where_conditions);
                    }
                    
                    $result_estatus = $conn->query($estatus_sql);
                    while ($row = $result_estatus->fetch_assoc()) {
                        $selected = (isset($_GET['estatus']) && $_GET['estatus'] === $row['estatus']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($row['estatus']) . "' $selected>" . htmlspecialchars($row['estatus']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </form>            
    </div>
    <!-- Hamburger Button -->
    <button class="hamburger" id="vacunoMenuToggle" aria-label="Toggle menu">
    <i class="bi bi-list" style="font-size: 1.5rem;"></i>
    </button>
    <!-- Vertical Dropdown Menu -->
    <div class="vertical-menu" id="verticalMenu">
        <!-- Agregar Animal Dropdown -->
        <div class="dropdown mb-2">
            <a href="#" class="dropdown-toggle" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="tooltip-text">Agregar Animal</span>
            <button class="new-entry-btn" title="Agregar Nuevo Animal" onclick="openModal()">
                <i class="bi bi-plus-circle-fill"></i>
            </button>
            </a>              
            </ul>
        </div>
        <!-- Indicators Dropdown -->
        <div class="dropdown mb-2">
            <a href="#" class="dropdown-toggle" id="indicatorsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-graph-up"></i>
                <span class="tooltip-text">Indicadores</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="indicatorsDropdown">
                <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_indices_reproduccion.php">Reproduccion</a></li>
                <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_indices_alimentacion.php">Alimentacion</a></li>
                <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_indices_produccion.php">Produccion</a></li>
                <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_indices_salud.php">Salud</a></li>
            </ul>
        </div>
        <!-- Configuration Dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" id="configDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear"></i>
            <span class="tooltip-text">Configuracion</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="configDropdown">
            <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_configuracion_alimentacion.php">Alimentos</a></li>
            <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_configuracion_vacunas.php">Vacunas</a></li>
            <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_configuracion_razas.php">Razas</a></li>
            <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_configuracion_grupos.php">Grupos</a></li>
            <li class="dropdown-item-margin"><a class="dropdown-item" href="./vacuno_configuracion_estatus.php">Estatus</a></li>
            </ul>
        </div>  
    </div>

</div>

<?php
// Main query for cards and DataTable
$main_sql = "SELECT * FROM vacuno";
$where_conditions = [];

if (!empty($_GET['sexo'])) {
    $where_conditions[] = "genero = '" . $conn->real_escape_string($_GET['sexo']) . "'";
}
if (!empty($_GET['raza'])) {
    $where_conditions[] = "raza = '" . $conn->real_escape_string($_GET['raza']) . "'";
}
if (!empty($_GET['etapa'])) {
    $where_conditions[] = "etapa = '" . $conn->real_escape_string($_GET['etapa']) . "'";
}
if (!empty($_GET['grupo'])) {
    $where_conditions[] = "grupo = '" . $conn->real_escape_string($_GET['grupo']) . "'";
}
if (!empty($_GET['estatus'])) {
    $where_conditions[] = "estatus = '" . $conn->real_escape_string($_GET['estatus']) . "'";
}

if (!empty($where_conditions)) {
    $main_sql .= " WHERE " . implode(" AND ", $where_conditions);
}

$result = $conn->query($main_sql);
?>

<div class="cards-container">
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="card" data-id="' . $row['id'] . '" style="padding: 1px; border: 1px solid #ddd; margin-bottom: 5px; display: flex; flex-direction: column; align-items: center;">
            <div>'; // Removed margin-right
                if(!empty($row['image'])) {
                    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Imagen" id="image_' . $row['id'] . '" style="width: 100%; height: 200px; border-radius:10px;">'; // Increased width to 120px
                } else {
                    echo '<img src="./images/default_image.png" alt="Default Imagen" id="image_' . $row['id'] . '" style="width: 120px; height: auto; border-radius: 50%;">'; // Increased width to 120px
                }
                echo '</div>

            <div style="text-align: center;"> <!-- Center text -->
                <div style="font-weight: bolder;">' . htmlspecialchars($row['nombre']) . '</div>
                <div><i class="fas fa-tag"></i> ' . htmlspecialchars($row['tagid']) . '</div>
            </div>
            <table style="width: 100%; 
                         margin-bottom: 2px;
                         border-collapse: collapse;
                         background-color: #ffffff;
                         box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                         border-radius: 8px;
                         overflow: hidden;
                         font-family: Arial, sans-serif;">
                <tbody>
                    <tr style="background-color: #f8f9fa;">
                        <td style="text-align: left; padding: 8px 15px; font-size: 0.8rem; border-bottom: 1px solid #e9ecef;">
                            <span style="color: #495057;"><i class="fa-solid fa-baby fa-2xs"></i></span>
                            <span style="margin-left: 8px; color: #212529;">' . htmlspecialchars($row['fecha_nacimiento']) . '</span>
                        </td>
                        <td style="text-align: left; padding: 8px 15px; font-size: 0.8rem; border-bottom: 1px solid #e9ecef;">
                            <span style="color: #495057;"><i class="fa-solid fa-mars-and-venus fa-2xs"></i></span>
                            <span style="margin-left: 8px; color: #212529;">' . htmlspecialchars($row['genero']) . '</span>
                        </td>
                    </tr>
                    <tr style="background-color: #ffffff;">
                        <td style="text-align: left; padding: 8px 15px; font-size: 0.8rem; border-bottom: 1px solid #e9ecef;">
                            <span style="color: #495057;"><i class="fa-solid fa-dna fa-2xs"></i></span>
                            <span style="margin-left: 8px; color: #212529;">' . htmlspecialchars($row['raza']) . '</span>
                        </td>
                        <td style="text-align: left; padding: 8px 15px; font-size: 0.8rem; border-bottom: 1px solid #e9ecef;">
                            <span style="color: #495057;"><i class="fa-solid fa-layer-group fa-2xs"></i></span>
                            <span style="margin-left: 8px; color: #212529;">' . htmlspecialchars($row['etapa']) . '</span>
                        </td>
                    </tr>
                    <tr style="background-color: #f8f9fa;">
                        <td style="text-align: left; padding: 8px 15px; font-size: 0.8rem;">
                            <span style="color: #495057;"><i class="fa-solid fa-user-group fa-2xs"></i></span>
                            <span style="margin-left: 8px; color: #212529;">' . htmlspecialchars($row['grupo']) . '</span>
                        </td>
                        <td style="text-align: left; padding: 8px 15px; font-size: 0.8rem;">
                            <span style="color: #495057;"><i class="fa-solid fa-check-double fa-2xs"></i></span>
                            <span style="margin-left: 8px; color: #212529;">' . htmlspecialchars($row['estatus']) . '</span>
                        </td>
                    </tr>
                </tbody>                    
            </table>                              

        <div class="action-buttons" style="margin-top: 10px; display: flex; justify-content: center; width: 100%; padding:10px;"> <!-- Center action buttons -->
            <button class="action-btn history-btn" title="Actualizar" onclick="openUpdateModal(' . htmlspecialchars($row['tagid']) . ')">
                <i class="fa-regular fa-pen-to-square" style="color: #048c09;"></i>
            </button>
            <button class="action-btn history-btn" title="Historial" onclick="openHistory(\'' . htmlspecialchars($row['tagid']) . '\')">
                <i class="fa-solid fa-list-check" style="color: #000;"></i>
            </button>                                        
            <button class="action-btn delete-btn" title="Borrar" onclick="deleteAnimal(this, ' . $row['id'] . ')">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        </div>';
    }
} else {
    echo "<p>No information found</p>";
}
?>
</div>
<!-- Add this after your cards section -->
<div class="container table-container mt-4">
    <table id="vacunoTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tag ID</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Raza</th>
                <th>Etapa</th>
                <th>Grupo</th>
                <th>Estatus</th>
                <th>Fecha Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Use the same $result from the main query that's used for cards
            if ($result && $result->num_rows > 0) {
                // Reset the pointer to the beginning of the result set
                $result->data_seek(0);
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['genero']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['raza']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['etapa']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['grupo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['estatus']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fecha_nacimiento']) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>



<!-- Canvas Genero Raza Grupo Estatus Pie Charts -->
<div style="max-width: 600px; margin: 40px auto;">
    <h3 style="text-align: center;">Distribución por genero (%)</h3>
    <canvas id="sexoPieChart"></canvas>
</div>
<div style="max-width: 600px; margin: 40px auto;">
    <h3 style="text-align: center;">Distribución por Raza (%)</h3>
    <canvas id="razaPieChart"></canvas>
</div>
<div style="max-width: 600px; margin: 40px auto;">
    <h3 style="text-align: center;">Distribución por Grupos (%)</h3>
    <canvas id="grupoPieChart"></canvas>
</div>
<div style="max-width: 600px; margin: 40px auto;">
    <h3 style="text-align: center;">Distribución por Estatus (%)</h3>
    <canvas id="estatusPieChart"></canvas>
</div>
    
<!-- New Entry Modal-->
<div id="newEntryModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="createEntryForm" enctype="multipart/form-data">
        <div class="image-column">                        
                    <div class="image-preview">
                        <img id="newImagePreview" src="./images/Agregar_Logo-png.png" alt="Preview">
                    </div>
                    <label for="newImageUpload" class="image-upload-label">
                        <i class="fas fa-upload"></i> Seleccionar Imagen
                    </label>
                    <input type="file" id="newImageUpload" name="image" accept="image/*" style="display: none;">
                </div>
            <div class="form-grid-two-columns">
                <!-- Left Column -->

                <!-- Center Column -->
                <div class="center-column">
                    <div class="form-group">
                        <label for="newNombre">Nombre:</label>
                        <input type="text" id="newNombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="nacimiento">Nacimiento:</label>
                        <input type="date" id="nacimiento" name="fecha_nacimiento" required>
                    </div>                    
                    <div class="form-group">
                        <label for="newGenero">Genero:</label>
                        <select id="newGenero" name="genero" required>
                            <option value="">Seleccionar</option>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newEstatus">Estatus:</label>
                        <select id="newEstatus" name="estatus" required>
                            <option value="">Seleccionar</option>
                            <?php
                            // Database connection for estatus
                            $conn_estatus = new mysqli('localhost', $username, $password, $dbname);
                            if ($conn_estatus->connect_error) {
                                die("Connection failed: " . $conn_estatus->connect_error);
                            }

                            // Fetch distinct estatus from v_estatus table
                            $sql_estatus = "SELECT DISTINCT estatus_nombre FROM v_estatus";
                            $result_estatus = $conn_estatus->query($sql_estatus);

                            if ($result_estatus->num_rows > 0) {
                                while ($row_estatus = $result_estatus->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row_estatus['estatus_nombre']) . '">' . htmlspecialchars($row_estatus['estatus_nombre']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No estatus found</option>';
                            }

                            $conn_estatus->close();
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="right-column">
                    <div class="form-group">
                        <label for="newTagid">Tag ID:</label>
                        <input type="text" id="newTagid" name="tagid" required>
                    </div>
                    <div class="form-group">                        
                        <label for="newCompra">Fecha Compra:</label>
                        <input type="date" id="newCompra" name="fecha_compra">                       
                    </div>
                    <div class="form-group">
                        <label for="newEtapa">Etapa:</label>
                        <select id="newEtapa" name="etapa" required>
                            <option value="">Seleccionar</option>
                            <option value="Inicio">Inicio</option>
                            <option value="Crecimiento">Crecimiento</option>
                            <option value="Finalizacion">Finalizacion</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newRaza">Raza:</label>
                        <select id="newRaza" name="raza" required>
                            <option value="">Seleccionar</option>
                            <?php
                            // Database connection for razas
                            $conn_razas = new mysqli('localhost', $username, $password, $dbname);
                            if ($conn_razas->connect_error) {
                                die("Connection failed: " . $conn_razas->connect_error);
                            }

                            // Fetch distinct razas from v_razas table
                            $sql_razas = "SELECT DISTINCT razas_nombre FROM v_razas";
                            $result_razas = $conn_razas->query($sql_razas);

                            if ($result_razas->num_rows > 0) {
                                while ($row_razas = $result_razas->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row_razas['razas_nombre']) . '">' . htmlspecialchars($row_razas['razas_nombre']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No razas found</option>';
                            }

                            $conn_razas->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newGrupo">Grupo:</label>
                        <select id="newGrupo" name="grupo" required>
                            <option value="">Seleccionar</option>
                            <?php
                            // Database connection for grupos
                            $conn_grupos = new mysqli('localhost', $username, $password, $dbname);
                            if ($conn_grupos->connect_error) {
                                die("Connection failed: " . $conn_grupos->connect_error);
                            }

                            // Fetch distinct grupos from v_grupos table
                            $sql_grupos = "SELECT DISTINCT grupos_nombre FROM v_grupos";
                            $result_grupos = $conn_grupos->query($sql_grupos);

                            if ($result_grupos->num_rows > 0) {
                                while ($row_grupos = $result_grupos->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row_grupos['grupos_nombre']) . '">' . htmlspecialchars($row_grupos['grupos_nombre']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No grupos found</option>';
                            }

                            $conn_grupos->close();
                            ?>
                        </select>
                    </div>                        
                </div>
            </div>
            <div class="submit-btn-container">
                <button type="submit" class="submit-btn">GUARDAR    </button>
            </div>
        </form>
    </div>
</div>

<!-- Update Modal -->
<div id="updateModal" class="new-entry-modal" style="display: none;">
    <div class="new-entry-modal-content">
        <span class="close" onclick="closeUpdateModal()">&times;</span>
        <h2>Actualizar Información del Animal</h2>
        <form id="updateForm" enctype="multipart/form-data" method="POST" action="vacuno_update.php">
        <div class="image-column">
                    <div class="image-preview">
                        <img id="updateImagePreview" src="./images/default_image.png" alt="Preview" style="width: 100%; height: auto; border-radius: 50%;">
                    </div>
                    <label for="updateImageUpload" class="image-upload-label">
                        <i class="fas fa-upload"></i> Seleccionar Imagen
                    </label>
                    <input type="file" id="updateImageUpload" name="image" accept="image/*" style="display: none;" onchange="previewImage(event)">

                    <!-- Name and Tag ID Fields Below Avatar (Horizontally Aligned) -->
                    <div class="form-group" style="display: flex; justify-content: space-between; margin-top: 10px;">
                        <div style="flex: 1; margin-right: 10px;">
                            <label for="updateNombre">Nombre:</label>
                            <input type="text" id="updateNombre" name="nombre" value="" readonly>
                        </div>
                        <div style="flex: 1;">
                            <label for="updateTagid">Tag ID:</label>
                            <input type="text" id="updateTagid" name="tagid" value="" readonly>
                        </div>
                    </div>
                </div>
            <div class="form-grid">
                <!-- Left Column for Avatar and Info -->
                <div class="form-group">
                        <label for="updateRaza">Raza:</label>
                        <select id="updateRaza" name="raza" required>
                            <option value="">Seleccionar</option>
                            <?php
                            // Database connection for razas
                            $conn_razas = new mysqli('localhost', $username, $password, $dbname);
                            if ($conn_razas->connect_error) {
                                die("Connection failed: " . $conn_razas->connect_error);
                            }

                            // Fetch distinct razas from v_razas table
                            $sql_razas = "SELECT DISTINCT razas_nombre FROM v_razas";
                            $result_razas = $conn_razas->query($sql_razas);

                            if ($result_razas->num_rows > 0) {
                                while ($row_razas = $result_razas->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row_razas['razas_nombre']) . '">' . htmlspecialchars($row_razas['razas_nombre']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No razas found</option>';
                            }

                            $conn_razas->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="updateEtapa">Etapa:</label>
                        <select id="updateEtapa" name="etapa" required>
                            <option value="Inicio">Inicio</option>
                            <option value="Crecimiento">Crecimiento</option>
                            <option value="Finalizacion">Finalizacion</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="updateGrupo">Grupo:</label>
                        <select id="updateGrupo" name="grupo" required>
                            <option value="">Seleccionar</option>
                            <?php
                            // Database connection for grupos
                            $conn_grupos = new mysqli('localhost', $username, $password, $dbname);
                            if ($conn_grupos->connect_error) {
                                die("Connection failed: " . $conn_grupos->connect_error);
                            }

                            // Fetch distinct grupos from v_grupos table
                            $sql_grupos = "SELECT DISTINCT grupos_nombre FROM v_grupos";
                            $result_grupos = $conn_grupos->query($sql_grupos);

                            if ($result_grupos->num_rows > 0) {
                                while ($row_grupos = $result_grupos->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row_grupos['grupos_nombre']) . '">' . htmlspecialchars($row_grupos['grupos_nombre']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No grupos found</option>';
                            }

                            $conn_grupos->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="updateEstatus">Estatus:</label>
                        <select id="updateEstatus" name="estatus" required>
                            <option value="">Seleccionar</option>
                            <?php
                            // Database connection for estatus
                            $conn_estatus = new mysqli('localhost', $username, $password, $dbname);
                            if ($conn_estatus->connect_error) {
                                die("Connection failed: " . $conn_estatus->connect_error);
                            }

                            // Fetch distinct estatus from v_estatus table
                            $sql_estatus = "SELECT DISTINCT estatus_nombre FROM v_estatus";
                            $result_estatus = $conn_estatus->query($sql_estatus);

                            if ($result_estatus->num_rows > 0) {
                                while ($row_estatus = $result_estatus->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row_estatus['estatus_nombre']) . '">' . htmlspecialchars($row_estatus['estatus_nombre']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No estatus found</option>';
                            }

                            $conn_estatus->close();
                            ?>
                        </select>
                    </div>
            </div>
            <div class="submit-btn-container">
                <button type="submit" class="submit-btn">Actualizar</button>
            </div>
        </form>
    </div>
</div>




    <!-- Canvas for Average Weight Chart -->
    <div style="max-width: 1300px; margin: 40px auto;">
        <h3 style="text-align: center;">PRODUCCION CARNICA</h3>
        <canvas id="avgPesoChart" width="600" height="400"></canvas>
    </div>
    <!-- Canvas Leche Produccion -->
    <div style="max-width: 1300px; margin: 40px auto;">        
        <h3 style="text-align: center;">PRODUCCION LECHERA</h3>
        <canvas id="avgLecheChart" width="600" height="400"></canvas>
    </div>
   <!-- Canvas Inversion en Alimentacion -->
    <div style="max-width: 1300px; margin: 40px auto;">
        <h3 style="text-align: center;">INVERSION ALIMENTARIA</h3>
        <canvas id="avgRacionChart" width="600" height="400"></canvas>
    </div>
    <!-- Canvas Numero de Partos -->
    <div style="max-width: 1300px; margin: 40px auto;">
        <h3 style="text-align: center;">Partos por Animal</h3>
        <canvas id="partoMultipleTagChart" width="600" height="400"></canvas>
    </div>
    <!-- New Entry Modal JS -->
    <script>
    // Function to open the modal
    function openModal() {
        document.getElementById('newEntryModal').style.display = 'block';
    }
    // Function to close the modal when the close button is clicked
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('newEntryModal').style.display = 'none';
    });
    // Function to close the modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        var modal = document.getElementById('newEntryModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    
    <script>
        // Toggle details in cards
    function toggleDetails(button) {
    const contactInfo = button.nextElementSibling;
    const isHidden = contactInfo.style.display === 'none' || !contactInfo.style.display;
    contactInfo.style.display = isHidden ? 'block' : 'none';
    button.textContent = isHidden ? 'CERRAR' : 'VER MAS';
    }
    function openHistory(tagid) {
        // Redirect to vacuno_historial.php with tagid as a query parameter
        window.location.href = './vacuno_historial.php?search=' + encodeURIComponent(tagid);
    }
    function openTareas(tagid) {
        // Redirect to vacuno_tareas.php with tagid as a query parameter
        window.location.href = './vacuno_tareas.php?search=' + encodeURIComponent(tagid);
    }
    </script>
    <!-- Genero Pie Chart -->
    <script>
        // Existing scripts...

        // Initialize Pie Charts with Percentages and Data Labels
        document.addEventListener('DOMContentLoaded', function () {
            // Sexo Pie Chart
            var ctxSexo = document.getElementById('sexoPieChart').getContext('2d');
            var sexoPieChart = new Chart(ctxSexo, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($sexoLabels); ?>,
                    datasets: [{
                        label: 'Cantidad por Sexo',
                        data: <?php echo json_encode($sexoCounts); ?>,
                        backgroundColor: [
                            '#ff007f', // Hembra
                            '#4C86E4', // Macho
                            '#36A2EB', // Other if any
                            '#FFCE56', // Additional colors if needed
                            '#AA65D3',
                            '#FF9F40'
                        ],
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: function(value, context) {
                                var sum = context.chart._metasets[context.datasetIndex].total;
                                var percentage = sum > 0 ? ((value / sum) * 100).toFixed(2) : 0;
                                return percentage + '%';
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.label || '';
                                    var value = context.parsed;
                                    var sum = context.chart._metasets[context.datasetIndex].total;
                                    var percentage = sum > 0 ? ((value / sum) * 100).toFixed(2) : 0;
                                    return label + ': ' + percentage + '%';
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Distribución por Sexo (%)'
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Raza Pie Chart
            var ctxRaza = document.getElementById('razaPieChart').getContext('2d');
            var razaPieChart = new Chart(ctxRaza, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($razaLabels); ?>,
                    datasets: [{
                        label: 'Cantidad por Raza',
                        data: <?php echo json_encode($razaCounts); ?>,
                        backgroundColor: [
                            '#FF6384', // Example color for Raza
                            '#36A2EB',
                            '#FFCE56',
                            '#4CAF50',
                            '#AA65D3',
                            '#FF9F40'
                        ],
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: function(value, context) {
                                var sum = context.chart._metasets[context.datasetIndex].total;
                                var percentage = sum > 0 ? ((value / sum) * 100).toFixed(2) : 0;
                                return percentage + '%';
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.label || '';
                                    var value = context.parsed;
                                    var sum = context.chart._metasets[context.datasetIndex].total;
                                    var percentage = sum > 0 ? ((value / sum) * 100).toFixed(2) : 0;
                                    return label + ': ' + percentage + '%';
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Distribución por Raza (%)'
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Grupo Pie Chart
            var ctxGrupo = document.getElementById('grupoPieChart').getContext('2d');
            var grupoPieChart = new Chart(ctxGrupo, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($grupoLabels); ?>,
                    datasets: [{
                        label: 'Cantidad por Clasificación',
                        data: <?php echo json_encode($grupoCounts); ?>,
                        backgroundColor: [
                            '#FF9F40', // Example color for grupo
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                            '#4CAF50',
                            '#AA65D3'
                        ],
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: function(value, context) {
                                var sum = context.chart._metasets[context.datasetIndex].total;
                                var percentage = sum > 0 ? ((value / sum) * 100).toFixed(2) : 0;
                                return percentage + '%';
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.label || '';
                                    var value = context.parsed;
                                    var sum = context.chart._metasets[context.datasetIndex].total;
                                    var percentage = sum > 0 ? ((value / sum) * 100).toFixed(2) : 0;
                                    return label + ': ' + percentage + '%';
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Distribución por Clasificación (%)'
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Estatus Pie Chart
            var ctxEstatus = document.getElementById('estatusPieChart').getContext('2d');
            var estatusPieChart = new Chart(ctxEstatus, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($estatusLabels); ?>,
                    datasets: [{
                        label: 'Cantidad por Estatus',
                        data: <?php echo json_encode($estatusCounts); ?>,
                        backgroundColor: [
                            '#FF6384', // Example color for Estatus
                            '#36A2EB',
                            '#FFCE56',
                            '#4CAF50',
                            '#AA65D3',
                            '#FF9F40',
                            '#8e5ea2',
                            '#3cba9f'
                        ],
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: function(value, context) {
                                var sum = context.chart._metasets[context.datasetIndex].total;
                                var percentage = sum > 0 ? ((value / sum) * 100).toFixed(2) : 0;
                                return percentage + '%';
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.label || '';
                                    var value = context.parsed;
                                    var sum = context.chart._metasets[context.datasetIndex].total;
                                    var percentage = sum > 0 ? ((value / sum) * 100).toFixed(2) : 0;
                                    return label + ': ' + percentage + '%';
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Distribución por Estatus (%)'
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>
    <!-- Actualizar Peso -->
    <script>
        function updateWeight(id) {
            // Get the input values
            const peso = document.getElementById(`peso-animal_${id}`).value;
            const pesoFecha = document.getElementById(`peso-fecha_${id}`).value;
            const pesoPrecio = document.getElementById(`peso-precio_${id}`).value;

            // Basic validation
            if (peso === '' || pesoFecha === '' || pesoPrecio === '') {
                alert('Por favor, completa todos los campos.');
                return;
            }

            // Prepare the data to be sent
            const data = {
                id: id,
                peso: peso,
                peso_fecha: pesoFecha,
                peso_precio: pesoPrecio
            };

            // Send AJAX request using jQuery
            $.ajax({
                url: 'vacuno_update_weight.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Peso actualizado exitosamente.');
                        // Optionally, you can update the UI or reload the page
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocurrió un error al procesar la solicitud.');
                    console.error(error);
                }
            });
        }
    </script>
    <!-- Actualizar Leche -->
    <script>
        function updateMilk(animalId) {
            const lechePeso = document.getElementById(`leche-peso_${animalId}`).value;
            const lecheFecha = document.getElementById(`leche-fecha_${animalId}`).value;
            const lechePrecio = document.getElementById(`leche-precio_${animalId}`).value;

            // Validate inputs
            if (!lechePeso || !lecheFecha || !lechePrecio) {
                alert('Por favor, complete todos los campos.');
                return;
            }

            // Prepare data
            const data = {
                id: animalId,
                leche_peso: parseFloat(lechePeso),
                leche_fecha: lecheFecha,
                leche_precio: parseFloat(lechePrecio)
            };

            // Send data to the server
            fetch('vacuno_update_leche_full.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Leche actualizada exitosamente.');
                    location.reload(); // Reload to see updated values
                } else {
                    alert('Error al actualizar la leche: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        }
    </script>
    <!--  Actualizar Concentrado -->
    <script>
        function updateFood(id) {
            const nombre = document.getElementById(`racion-nombre_${id}`).value;
            const racionPeso = document.getElementById(`racion-peso_${id}`).value;
            const racionFecha = document.getElementById(`racion-fecha_${id}`).value;
            const racion_costo = document.getElementById(`racion-costo_${id}`).value;

            // Basic validation
            if (nombre === '' || racionPeso === '' || racionFecha === '' || racion_costo === '') {
                alert('Por favor, completa todos los campos.');
                return;
            }

            // Prepare the data to be sent
            const data = {
                id: id,
                racion_nombre: nombre,
                racion_peso: racionPeso,
                racion_fecha: racionFecha,
                racion_costo: racion_costo
            };

            // Send AJAX request using jQuery
            $.ajax({
                url: 'vacuno_update_food.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Ración actualizada exitosamente.');
                        location.reload(); // Reload to see updated values
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocurrió un error al procesar la solicitud.');
                    console.error(error);
                }
            });
        }
    </script>
    <!--  Actualizar Vacuna -->
    <script>
        function actualizarVacuna(id) {
            const vacuna = document.getElementById(`vacuna_${id}`).value;
            const vacunaFecha = document.getElementById(`vacuna-fecha_${id}`).value;
            const vacunaCosto = document.getElementById(`vacuna-precio_${id}`).value;

            const data = {
                id: id,
                vacuna: vacuna,
                vacuna_fecha: vacunaFecha,
                vacuna_costo: vacunaCosto
            };

            fetch('vacuno_update_vacunas.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Optionally refresh the page or update the UI
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
    <!-- Actualizar Baño -->
    <script>
    function updateBano(id) {
            const bano = document.getElementById(`bano_${id}`).value.trim();
            const banoFecha = document.getElementById(`bano-fecha_${id}`).value;
            const banoCosto = document.getElementById(`bano-costo_${id}`).value.trim();

            // Basic validation
            if (bano === '') {
                alert('Por favor, ingrese un valor válido para Baño.');
                return;
            }

            if (banoFecha === '') {
                alert('Por favor, seleccione una fecha válida para Baño.');
                return;
            }

            if (banoCosto === '' || isNaN(banoCosto) || parseFloat(banoCosto) < 0) {
                alert('Por favor, ingrese un costo válido para Baño.');
                return;
            }

            // Confirm before updating
            if (!confirm('¿Está seguro de que desea actualizar el Baño?')) {
                return;
            }

            // Prepare data to send
            const data = {
                id: id,
                bano: bano,
                bano_fecha: banoFecha,
                bano_costo: parseFloat(banoCosto)
            };

            // Send the data via fetch
            fetch('vacuno_update_bano.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Baño actualizado exitosamente.');
                    location.reload(); // Reload to see updated values
                } else {
                    alert('Error al actualizar Baño: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        }
    </script>
    <!-- Actualizar Parasitos -->
    <script>
        function updateParasitos(id) {
            const parasitos = document.getElementById(`parasitos_${id}`).value.trim();
            const parasitosFecha = document.getElementById(`parasitos-fecha_${id}`).value;
            const parasitosCosto = document.getElementById(`parasitos-costo_${id}`).value.trim();

            // Basic validation
            if (parasitos === '') {
                alert('Por favor, ingrese un valor válido para Parásitos.');
                return;
            }

            if (parasitosFecha === '') {
                alert('Por favor, seleccione una fecha válida para Parásitos.');
                return;
            }

            if (parasitosCosto === '' || isNaN(parasitosCosto) || parseFloat(parasitosCosto) < 0) {
                alert('Por favor, ingrese un costo válido para Parásitos.');
                return;
            }

            // Confirm before updating
            if (!confirm('¿Está seguro de que desea actualizar los Parásitos?')) {
                return;
            }

            // Prepare data to send
            const data = {
                id: id,
                parasitos: parasitos,
                parasitos_fecha: parasitosFecha,
                parasitos_costo: parseFloat(parasitosCosto)
            };

            // Send the data via fetch
            fetch('vacuno_update_parasitos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Parásitos actualizados exitosamente.');
                    location.reload(); // Reload to see updated values
                } else {
                    alert('Error al actualizar Parásitos: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        }
    </script>
    <!-- Actualizar Destete -->
    <script>
        function updateDestete(id) {
            const destetePeso = document.getElementById(`destete_${id}`).value.trim();
            const desteteFecha = document.getElementById(`destete-fecha_${id}`).value;

            // Basic validation
            if (destetePeso === '' || isNaN(destetePeso) || parseFloat(destetePeso) <= 0) {
                alert('Por favor, ingrese un peso válido para el destete.');
                return;
            }

            if (desteteFecha === '') {
                alert('Por favor, seleccione una fecha válida para el destete.');
                return;
            }

            // Confirm before updating
            if (!confirm('¿Está seguro de que desea actualizar el destete?')) {
                return;
            }

            // Prepare data to send
            const data = {
                id: id,
                destete_peso: parseFloat(destetePeso),
                destete_fecha: desteteFecha
            };

            // Send the data via fetch
            fetch('vacuno_update_destete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Destete actualizado exitosamente.');
                    location.reload(); // Reload to see updated values
                } else {
                    alert('Error al actualizar el destete: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        }
    </script>
    <!-- Actualizar Prenez -->
    <script>
        function updatePrenez(id) {
            const prenezNumero = document.getElementById(`prenez-numero_${id}`).value.trim();
            const prenezFecha = document.getElementById(`prenez-fecha_${id}`).value;

            // Basic validation
            if (prenezNumero === '' || isNaN(prenezNumero) || parseFloat(prenezNumero) <= 0) {
                alert('Por favor, ingrese un número válido para Preñez.');
                return;
            }

            if (prenezFecha === '') {
                alert('Por favor, seleccione una fecha válida para Preñez.');
                return;
            }

            // Confirm before updating
            if (!confirm('¿Está seguro de que desea actualizar la Preñez?')) {
                return;
            }

            // Prepare data to send
            const data = {
                id: id,
                prenez_numero: parseFloat(prenezNumero),
                prenez_fecha: prenezFecha
            };

            // Send the data via fetch
            fetch('vacuno_update_prenez.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Preñez actualizada exitosamente.');
                    location.reload(); // Reload to see updated values
                } else {
                    alert('Error al actualizar la Preñez: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        }
    </script>
    <!-- Actualizar Parto -->
    <script>
<!-- Actualizar Parto  -->
    function updateParto(id) {
            const partoNumero = document.getElementById(`parto-numero_${id}`).value.trim();
            const partoFecha = document.getElementById(`parto-fecha_${id}`).value;

            // Basic validation
            if (partoNumero === '' || isNaN(partoNumero) || parseFloat(partoNumero) <= 0) {
                alert('Por favor, ingrese un número válido para el Parto.');
                return;
            }

            if (partoFecha === '') {
                alert('Por favor, seleccione una fecha válida para el Parto.');
                return;
            }

            // Prepare data to send
            const data = {
                id: id,
                parto_numero: parseFloat(partoNumero),
                parto_fecha: partoFecha
            };

            // Send the data via fetch
            fetch('vacuno_update_parto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Parto actualizado exitosamente.');
                    location.reload(); // Reload to see updated values
                } else {
                    alert('Error al actualizar el Parto: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        }
    </script>
    <!-- Actualizar Inseminacion -->
    <script>
        function updateInseminacion(id) {
            const inseminacionTipo = document.getElementById(`inseminacion-tipo_${id}`).value.trim();
            const inseminacionFecha = document.getElementById(`inseminacion-fecha_${id}`).value;
            const inseminacionCosto = document.getElementById(`inseminacion-costo_${id}`).value;




            if (inseminacionFecha === '') {
                alert('Por favor, seleccione una fecha válida para la Inseminacion.');
                return;
            }

            // Prepare data to send
            const data = {
                id: id,
                inseminacion_tipo: inseminacionTipo,
                inseminacion_fecha: inseminacionFecha,
                inseminacion_costo: inseminacionCosto
            };

            // Send the data via fetch
            fetch('vacuno_update_inseminacion.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Inseminacion actualizada exitosamente.');
                    location.reload(); // Reload to see updated values
                } else {
                    alert('Error al actualizar Inseminación: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        }
    </script>
    <!-- Produccion Carnica -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Debug: Log the data being passed to the chart
            console.log("Average Weight Labels:", <?php echo json_encode($avgPesoLabels); ?>);
            console.log("Average Weight Data:", <?php echo json_encode($avgPesoData); ?>);

            var ctxAvgPeso = document.getElementById('avgPesoChart').getContext('2d');
            var avgPesoChart = new Chart(ctxAvgPeso, {
                type: 'bar', // Change to 'line' if preferred
                data: {
                    labels: <?php echo json_encode($avgPesoLabels); ?>,
                    datasets: [{
                        label: 'Peso Promedio (Kg)',
                        data: <?php echo json_encode($avgPesoData); ?>,
                        backgroundColor: 'rgba(132, 199, 110, 0.6)',
                        borderColor: 'rgba(132, 199, 110, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Kg';
                                }
                            } // End of callbacks
                        } // End of tooltip
                    }, // Correctly closes the plugins object
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Mes (Año-Mes)'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Promedio de Peso (Kg)'
                            }
                        }
                    }
                }
            });
        });
    </script>
    <!-- Grafico Promedio Leche  -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Debug: Log the data being passed to the chart
    console.log("Average Leche Labels:", <?php echo json_encode($avgLecheLabels); ?>);
    console.log("Average Leche Data:", <?php echo json_encode($avgLecheData); ?>);

    var ctxAvgLeche = document.getElementById('avgLecheChart').getContext('2d');
    var avgLecheChart = new Chart(ctxAvgLeche, {
        type: 'line', // Change to 'line' if preferred
        data: {
            labels: <?php echo json_encode($avgLecheLabels); ?>,
            datasets: [{
                label: 'Promedio de Leche (Kg)',
                data: <?php echo json_encode($avgLecheData); ?>,
                backgroundColor: 'rgba(132, 199, 110, 0.6)',
                borderColor: 'rgba(132, 199, 110, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Kg';
                        }
                    } // Properly closes the tooltip object
                } // Properly closes the plugins object
            }, // Correctly closes the scales object
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Mes (Año-Mes)'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Promedio de Leche (Kg)'
                    }
                }
            }
        }
    });
});
</script>
<!-- Actualizar Raza -->
<script>
function updateRaza(id) {
    var select = document.getElementById('raza_' + id);
    var raza = select.value;

    // Basic validation
    if (raza === '') {
        alert('Por favor, seleccione una raza válida.');
        return;
    }

    // Prepare data to send
    var data = { id: id, raza: raza };

    // Send AJAX request using jQuery
    $.ajax({
        url: 'vacuno_update_raza.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Raza actualizada exitosamente.');
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Ocurrió un error al procesar la solicitud.');
            console.error(error);
        }
    });
}
</script>
<!-- Actualizar Grupo -->
<script>
function updateGrupo(id) {
    var select = document.getElementById('grupo_' + id);
    var grupo = select.value;

    // Basic validation
    if (grupo === '') {
        alert('Por favor, seleccione una clasificación válida.');
        return;
    }

    // Prepare the data to be sent
    var data = {
        id: id,
        grupo: grupo
    };

    // Send AJAX request using jQuery
    $.ajax({
        url: 'vacuno_update_grupo.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Clasificación actualizada exitosamente.');
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Ocurrió un error al procesar la solicitud.');
            console.error(error);
        }
    });
}
</script>
<!-- Actualizar Estatus -->
<script>
function updateEstatus(id) {
    var select = document.getElementById('estatus_' + id);
    var estatus = select.value;

    // Basic validation
    if (estatus === '') {
        alert('Por favor, seleccione un estatus válido.');
        return;
    }

    // Prepare the data to be sent
    var data = {
        id: id,
        estatus: estatus
    };

    // Send AJAX request using jQuery
    $.ajax({
        url: 'vacuno_update_estatus.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Estatus actualizado exitosamente.');
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Ocurrió un error al procesar la solicitud.');
            console.error(error);
        }
    });
}
</script>
<!-- Actualizar Imagen -->
<script>
// Function to trigger the hidden file input
function triggerImageUpload(id) {
    document.getElementById('imageUpload_' + id).click();
}

// Function to handle the image upload via AJAX
function uploadImage(id) {
    const fileInput = document.getElementById('imageUpload_' + id);
    const file = fileInput.files[0];

    if (!file) {
        alert('No se ha seleccionado ningún archivo.');
        return;
    }

    // Validate file size (e.g., max 2MB)
    const maxSize = 2 * 1024 * 1024; // 2MB
    if (file.size > maxSize) {
        alert('El archivo excede el tamaño máximo permitido de 2MB.');
        return;
    }

    // Validate file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!allowedTypes.includes(file.type)) {
        alert('Tipo de archivo no permitido. Por favor, suba una imagen JPG, PNG o GIF.');
        return;
    }

    const formData = new FormData();
    formData.append('image', file);
    formData.append('id', id);

    // Optional: Display a loading indicator
    // e.g., show a spinner or disable the upload button

    fetch('vacuno_update_image.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Optional: Hide the loading indicator

        if (data.success) {
            alert('Imagen actualizada exitosamente.');
            // Update the image source to the new image
            const imgElement = document.getElementById('image_' + id);
            imgElement.src = data.image_path + '?' + new Date().getTime(); // Prevent caching
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al subir la imagen.');
    });
}
</script>
    <!-- Image Preview -->
    <script>
        // Function to preview the selected image in the modal
        document.getElementById('newImageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('newImagePreview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(file);
            } else {
                // If no file is selected, revert to the default image
                preview.src = './images/Agregar_Logo-png.png';
            }
        });
    </script>
    <!-- Actualizar Animal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const createEntryForm = document.getElementById('createEntryForm');
            const newEntryModal = document.getElementById('newEntryModal');
            const closeModalBtn = document.querySelector('.close');

            // Function to close the modal
            closeModalBtn.addEventListener('click', function() {
                newEntryModal.style.display = 'none';
            });

            // Function to close the modal when clicking outside the modal content
            window.addEventListener('click', function(event) {
                if (event.target == newEntryModal) {
                    newEntryModal.style.display = 'none';
                }
            });

            // Handle form submission
            createEntryForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Create a FormData object from the form
                const formData = new FormData(createEntryForm);

                // Send the form data using fetch
                fetch('vacuno_update_new_animal.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Nuevo animal agregado exitosamente.');
                        // Optionally, you can reset the form and close the modal
                        createEntryForm.reset();
                        newImagePreview.src = './images/Agregar_Logo-png.png'; // Reset image preview
                        newEntryModal.style.display = 'none';
                        // Optionally, refresh the list or append the new entry dynamically
                        location.reload(); // Reload to see the new entry
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al agregar el nuevo animal.');
                });
            });

            // Optional: Preview the selected image
            const newImageUpload = document.getElementById('newImageUpload');
            const newImagePreview = document.getElementById('newImagePreview');

            newImageUpload.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        newImagePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    <!-- Borrar Animal -->
    <script>
        /**
         * Deletes an animal entry from the 'vacuno' table.
         * @param {HTMLElement} button - The delete button that was clicked.
         * @param {number} id - The ID of the animal to delete.
         */
        function deleteAnimal(button, id) {
            // Confirm deletion
            if (!confirm('¿Está seguro de que desea borrar este animal? Esta acción no se puede deshacer.')) {
                return;
            }

            // Send AJAX request using jQuery
            $.ajax({
                url: './vacuno_delete_animal.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Animal borrado exitosamente.');
                        // Remove the card from the UI
                        $(button).closest('.card').remove();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocurrió un error al procesar la solicitud.');
                    console.error(error);
                }
            });
        }
    </script>
    <!-- Toggle Menu -->
    <script>
  const vacunoMenuToggle = document.getElementById('vacunoMenuToggle');
  const verticalMenu = document.getElementById('verticalMenu');

  vacunoMenuToggle.addEventListener('click', () => {
    verticalMenu.classList.toggle('show');
    // Toggle hamburger icon between open and close
    const icon = vacunoMenuToggle.querySelector('i');
    if (verticalMenu.classList.contains('show')) {
      icon.classList.remove('bi-list');
      icon.classList.add('bi-x-lg');
    } else {
      icon.classList.remove('bi-x-lg');
      icon.classList.add('bi-list');
    }
  });

  // Optional: Close the menu when clicking outside
  document.addEventListener('click', (event) => {
    if (!verticalMenu.contains(event.target) && !vacunoMenuToggle.contains(event.target)) {
      verticalMenu.classList.remove('show');
      const icon = vacunoMenuToggle.querySelector('i');
      icon.classList.remove('bi-x-lg');
      icon.classList.add('bi-list');
    }
  });
</script>

<!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous">

</script>
<!-- Inversion en alimentacion -->
<script>
    // Initialize the Average Ración Cost Line Chart with Cumulative Sum
    document.addEventListener('DOMContentLoaded', function () {
        // Existing chart initializations...

        // Ración Cost Line Chart
        var ctxRacion = document.getElementById('avgRacionChart').getContext('2d');
        var avgRacionChart = new Chart(ctxRacion, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($avgRacionLabels); ?>,
                datasets: [
                    {
                        label: 'Costo Promedio de Ración (USD)',
                        data: <?php echo json_encode($avgRacionData); ?>,
                        fill: false,
                        borderColor: '#FF6384',
                        backgroundColor: '#FF6384',
                        tension: 0.1,
                        pointBackgroundColor: '#FF6384',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#FF6384'
                    },
                    {
                        label: 'Costo Promedio Cumulativo de Ración (USD)',
                        data: <?php echo json_encode($avgRacionCumulativeData); ?>,
                        fill: false,
                        borderColor: '#36A2EB',
                        backgroundColor: '#36A2EB',
                        tension: 0.1,
                        pointBackgroundColor: '#36A2EB',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#36A2EB'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += '$' + context.parsed.y;
                                return label;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Costo Promedio de Ración Mensual (USD) y Cumulativo'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Mes (Año-Mes)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Costo Promedio (USD)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
     <!-- Partos Mensuales -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                // Verificar que las variables JSON están correctamente cargadas
                console.log("Parto Labels:", <?php echo $partoLabelsJson; ?>);
                console.log("Parto Datasets:", <?php echo $partoDatasetsJson; ?>);

                // Inicializar el Gráfico de Número de Partos por Mes y Tag ID
                const ctxPartoMultiple = document.getElementById('partoMultipleTagChart').getContext('2d');
                const partoMultipleTagChart = new Chart(ctxPartoMultiple, {
                    type: 'bar',
                    data: {
                        labels: <?php echo $partoLabelsJson; ?>,
                        datasets: <?php echo $partoDatasetsJson; ?>
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.parsed.y + ' Partos';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Mes (Año-Mes)'
                                },
                                ticks: {
                                    maxRotation: 90,
                                    minRotation: 45
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Número de Partos'
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error("Error al inicializar el gráfico:", error);
            }
        });
    </script>

    <script>
    function openUpdateModal(tagid) {
        // Fetch the current data for the specified tagid
        fetch(`fetch_vacuno_data.php?tagid=${tagid}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    // Populate the modal fields with the fetched data
                    document.getElementById('updateNombre').value = data.nombre;
                    document.getElementById('updateTagid').value = data.tagid;
                    document.getElementById('updateRaza').value = data.raza;
                    document.getElementById('updateEtapa').value = data.etapa;
                    document.getElementById('updateGrupo').value = data.grupo;
                    document.getElementById('updateEstatus').value = data.estatus;

                    // Set the image preview
                    document.getElementById('updateImagePreview').src = data.image ? data.image : './images/default_image.png';
                }
            })
            .catch(error => console.error('Error fetching data:', error));

        // Display the modal
        document.getElementById('updateModal').style.display = 'block';
    }

    // Function to close the modal
    function closeUpdateModal() {
        document.getElementById('updateModal').style.display = 'none';
    }
    </script>

    <script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('updateImagePreview');
            output.src = reader.result; // Set the image source to the uploaded file
        }
        reader.readAsDataURL(event.target.files[0]); // Read the uploaded file
    }
    </script>

    <!-- Add these scripts after your existing scripts -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<!-- Vacuno Table Script Inicializacion -->
<script>
$(document).ready(function() {
    // Initialize DataTable with current filtered data
    var table = $('#vacunoTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'asc']],
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle'
            }
        ]
    });

    // Debug info
    console.log('Current filters:', {
        sexo: <?php echo json_encode(isset($_GET['sexo']) ? $_GET['sexo'] : ''); ?>,
        raza: <?php echo json_encode(isset($_GET['raza']) ? $_GET['raza'] : ''); ?>,
        etapa: <?php echo json_encode(isset($_GET['etapa']) ? $_GET['etapa'] : ''); ?>,
        grupo: <?php echo json_encode(isset($_GET['grupo']) ? $_GET['grupo'] : ''); ?>,
        estatus: <?php echo json_encode(isset($_GET['estatus']) ? $_GET['estatus'] : ''); ?>
    });
});
</script>

<!-- Make sure these exact versions of the libraries are included in your head section -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<!-- VH_Peso Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Produccion Carnica</h3>
    <table id="pesosTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Nombre</th>                
                <th class="text-center">Fecha</th>
                <th class="text-center">Peso (kg)</th>
                <th class="text-center">Precio/kg</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
<?php
// Query for vh_peso table with the same filters as vacuno
$peso_sql = "SELECT vh_peso.*, vacuno.tagid, vacuno.nombre 
            FROM vh_peso 
            JOIN vacuno ON vh_peso_tagid = tagid";

if (!empty($where_conditions)) {
    $peso_sql .= " WHERE " . implode(" AND ", $where_conditions);
}

$peso_sql .= " ORDER BY vh_peso_tagid";

$peso_result = $conn->query($peso_sql);
$total_sum = 0; // Initialize sum variable

if ($peso_result && $peso_result->num_rows > 0) {
    while($row = $peso_result->fetch_assoc()) {
        // Calculate total
        $total = $row['vh_peso_animal'] * $row['vh_peso_precio'];
        $total_sum += $total; // Add to running sum
        
        echo "<tr>";
        echo "<td class='text-center'>" . htmlspecialchars($row['vh_peso_tagid']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";        
        echo "<td class='text-center'>" . htmlspecialchars($row['vh_peso_fecha']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['vh_peso_animal']) . "</td>";
        echo "<td class='text-center'>$" . htmlspecialchars(number_format($row['vh_peso_precio'], 2)) . "</td>";
        echo "<td class='text-center'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
        echo "</tr>";
    }
}
?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize Pesos DataTable
    $('#pesosTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center'
            },
            {
                targets: [4, 5],
                className: 'align-middle text-center'
            }
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column(5)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(5, {page: 'current'})
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html('$' + number_format(pageTotal, 2));
        }
    });
});

// Helper function to format numbers
function number_format(number, decimals) {
    return number.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>

<!-- VH_Leche Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Producción Lechera</h3>
    <table id="lecheTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Peso</th>                
                <th class="text-center">Precio $/L</th>
                <th class="text-center">Total Periodo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query for vh_leche table with the same filters as vacuno
            $leche_sql = "SELECT l.*, v.nombre,
                          LEAD(vh_leche_fecha) OVER (PARTITION BY vh_leche_tagid ORDER BY vh_leche_fecha) as next_fecha
                          FROM vh_leche l
                          LEFT JOIN vacuno v ON l.vh_leche_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $leche_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $leche_sql .= " ORDER BY vh_leche_tagid ASC, vh_leche_fecha DESC";
            
            $leche_result = $conn->query($leche_sql);
            $total_sum_leche = 0; // Initialize sum variable

            if ($leche_result && $leche_result->num_rows > 0) {
                while($row = $leche_result->fetch_assoc()) {
                    // Get the date difference
                    $current_date = new DateTime($row['vh_leche_fecha']);
                    
                    if ($row['next_fecha']) {
                        $next_date = new DateTime($row['next_fecha']);
                    } else {
                        $next_date = new DateTime(); // Current system date
                    }
                    
                    $date_diff = $current_date->diff($next_date);
                    $days_diff = $date_diff->days;
                    
                    // Calculate total including the days difference
                    $total_leche = $row['vh_leche_peso'] * $row['vh_leche_precio'] * $days_diff;
                    $total_sum_leche += $total_leche; // Add to running sum
                    
                    echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_leche_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_leche_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_leche_peso']) . "</td>";
                    echo "<td class='text-center'>$" . htmlspecialchars(number_format($row['vh_leche_precio'], 2)) . "</td>";
                    echo "<td class='text-center'>$" . htmlspecialchars(number_format($total_leche, 2)) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-end">Total Acumulado:</th>
                <th class="text-center">$<?php echo number_format($total_sum_leche, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize Leche DataTable
    $('#lecheTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center'
            },
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [3, 4], // Price and Total columns
                className: 'text-end' // Right align numbers
            },
            {
                targets: [1], // Litros column
                className: 'text-end' // Right align numbers
            }
        ]
    });
});
</script>

<!-- VH_Concentrado Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Inversion Concentrado</h3>
    <table id="concentradoTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>                
                <th class="text-center">Nombre</th>
                <th class="text-center">Fecha</th>
                <th class="test-center">Producto</th>             
                <th class="text-center">Racion (kg)</th>                
                <th class="text-center">Costo $/kg</th>
                <th class="text-center">Total Periodo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Modify the query to include lead function for getting next date
            $concentrado_sql = "SELECT vh_concentrado_tagid, vh_concentrado_costo, vh_concentrado_fecha, vh_concentrado_racion, vh_concentrado_producto, v.nombre,
              LEAD(vh_concentrado_fecha) OVER (PARTITION BY vh_concentrado_tagid ORDER BY vh_concentrado_fecha) as next_fecha
              FROM vh_concentrado l
              LEFT JOIN vacuno v ON l.vh_concentrado_tagid = v.tagid";

if (!empty($where_conditions)) {
    $concentrado_sql .= " WHERE " . implode(" AND ", $where_conditions);
}

$concentrado_sql .= " ORDER BY vh_concentrado_tagid ASC";

$concentrado_result = $conn->query($concentrado_sql);
$total_sum_concentrado = 0; // Initialize sum variable

if ($concentrado_result && $concentrado_result->num_rows > 0) {
    while($row = $concentrado_result->fetch_assoc()) {
        // Get the date difference
        $current_date = new DateTime($row['vh_concentrado_fecha']);
        
        if ($row['next_fecha']) {
            $next_date = new DateTime($row['next_fecha']);
        } else {
            $next_date = new DateTime(); // Current system date
        }
        
        $date_diff = $current_date->diff($next_date);
        $days_diff = $date_diff->days;
        
        // Calculate total including the days difference
        $total_concentrado = $row['vh_concentrado_racion'] * $row['vh_concentrado_costo'] * $days_diff;
        $total_sum_concentrado += $total_concentrado; // Add to running sum
        
        echo "<tr>";
        echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_tagid']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_fecha']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_producto']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_racion']) . "</td>";
        echo "<td class='text-center'>$" . htmlspecialchars(number_format($row['vh_concentrado_costo'], 2)) . "</td>";
        echo "<td class='text-center'>$" . htmlspecialchars(number_format($total_concentrado, 2)) . "</td>";
        echo "</tr>";
    }
}
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total Acumulado:</th>
                <th class="text-center">$<?php echo number_format($total_sum_concentrado, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize Concentrado DataTable
    $('#concentradoTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [1, 3, 4], // Quantity, Price and Total columns
                className: 'text-end' // Right align numbers
            }
        ]
    });
});
</script>

<!-- VH_Melaza Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Inversion Melaza</h3>
    <table id="melazaTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>                
                <th class="text-center">Nombre</th>
                <th class="text-center">Fecha</th>
                <th class="test-center">Producto</th>             
                <th class="text-center">Racion (kg)</th>                
                <th class="text-center">Costo $/kg</th>
                <th class="text-center">Total Periodo</th>
            </tr>
        </thead>
        <tbody>
            <?php
             // Modify the query to include lead function for getting next date
             $melaza_sql = "SELECT vh_melaza_tagid, vh_melaza_costo, vh_melaza_fecha, vh_melaza_racion, vh_melaza_producto, v.nombre,
             LEAD(vh_melaza_fecha) OVER (PARTITION BY vh_melaza_tagid ORDER BY vh_melaza_fecha) as next_fecha
             FROM vh_melaza m
             LEFT JOIN vacuno v ON m.vh_melaza_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $melaza_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $melaza_sql .= " ORDER BY vh_melaza_fecha DESC";
            
            $melaza_result = $conn->query($melaza_sql);
            $total_sum_melaza = 0; // Initialize sum variable

            if ($melaza_result && $melaza_result->num_rows > 0) {
                while($row = $melaza_result->fetch_assoc()) {
                    // Get the date difference
                    $current_date = new DateTime($row['vh_melaza_fecha']);
                    
                    if ($row['next_fecha']) {
                        $next_date = new DateTime($row['next_fecha']);
                    } else {
                        $next_date = new DateTime(); // Current system date
                    }
                    
                    $date_diff = $current_date->diff($next_date);
                    $days_diff = $date_diff->days;
                    
                    // Calculate total
                    $total = $row['vh_melaza_racion'] * $row['vh_melaza_costo']* $days_diff;
                    $total_sum_melaza += $total; // Add to running sum

                    echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_producto']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_racion']) . "</td>";
                    echo "<td class='text-center'>$" . htmlspecialchars(number_format($row['vh_melaza_costo'], 2)) . "</td>";
                    echo "<td>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total Acumulado:</th>
                <th class="text-center">$<?php echo number_format($total_sum_melaza, 2); ?></th>
            </tr>
        </tfoot>
       </table>
</div>

<script>
$(document).ready(function() {
    // Initialize Melaza DataTable
    $('#melazaTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [1, 3, 4], // Quantity, Price and Total columns
                className: 'text-end' // Right align numbers
            }
        ]
    });
});
</script>

<!-- VH_Sal Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Inversion Sal</h3>
    <table id="salTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>                
                <th class="text-center">Nombre</th>
                <th class="text-center">Fecha</th>
                <th class="test-center">Producto</th>             
                <th class="text-center">Racion (kg)</th>                
                <th class="text-center">Costo $/kg</th>
                <th class="text-center">Total Periodo</th>
            </tr>
        </thead>
        <tbody>
        <?php
             // Modify the query to include lead function for getting next date
             $sal_sql = "SELECT vh_sal_tagid, vh_sal_costo, vh_sal_fecha, vh_sal_racion, vh_sal_producto, v.nombre,
             LEAD(vh_sal_fecha) OVER (PARTITION BY vh_sal_tagid ORDER BY vh_sal_fecha) as next_fecha
             FROM vh_sal m
             LEFT JOIN vacuno v ON m.vh_sal_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $sal_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $sal_sql .= " ORDER BY vh_sal_fecha DESC";
            
            $sal_result = $conn->query($sal_sql);
            $total_sum_sal = 0; // Initialize sum variable

            if ($sal_result && $sal_result->num_rows > 0) {
                while($row = $sal_result->fetch_assoc()) {
                    // Get the date difference
                    $current_date = new DateTime($row['vh_sal_fecha']);
                    
                    if ($row['next_fecha']) {
                        $next_date = new DateTime($row['next_fecha']);
                    } else {
                        $next_date = new DateTime(); // Current system date
                    }
                    
                    $date_diff = $current_date->diff($next_date);
                    $days_diff = $date_diff->days;
                    
                    // Calculate total
                    $total = $row['vh_sal_racion'] * $row['vh_sal_costo']* $days_diff;
                    $total_sum_sal += $total; // Add to running sum

                    echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_producto']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_racion']) . "</td>";
                    echo "<td class='text-center'>$" . htmlspecialchars(number_format($row['vh_sal_costo'], 2)) . "</td>";
                    echo "<td>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_sal, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize Sal DataTable
    $('#salTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [1, 3, 4], // Quantity, Price and Total columns
                className: 'text-end' // Right align numbers
            }
        ]
    });
});
</script>

<!-- VH_Aftosa Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Vacunación Aftosa</h3>
    <table id="aftosaTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tag ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Dosis</th>
                <th>Costo $/Dosis</th>
                <th>Total</th>
                <th>Próxima Dosis</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query for vh_aftosa table with the same filters as vacuno
            $aftosa_sql = "SELECT vh_aftosa_tagid, vh_aftosa_fecha, vh_aftosa_producto, vh_aftosa_dosis, vh_aftosa_costo, tagid, v.nombre
                          FROM vh_aftosa 
                          JOIN vacuno v ON vh_aftosa_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $aftosa_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $aftosa_sql .= " ORDER BY vh_aftosa_fecha DESC";
            
            $aftosa_result = $conn->query($aftosa_sql);
            $total_sum_aftosa = 0; // Initialize sum variable

            if ($aftosa_result && $aftosa_result->num_rows > 0) {
                while($row = $aftosa_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_aftosa_dosis'] * $row['vh_aftosa_costo'];
                    $total_sum_aftosa += $total; // Add to running sum

                    // Calculate next dose date (6 months from application)
                    $next_dose = date('Y-m-d', strtotime($row['vh_aftosa_fecha'] . ' + 6 months'));
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['vh_aftosa_tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_aftosa_fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_aftosa_producto']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($row['vh_aftosa_dosis']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_aftosa_costo'], 2)) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($next_dose) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_aftosa, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize Aftosa DataTable
    $('#aftosaTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [2, 3, 4], // Dosis, Price and Total columns
                className: 'text-end' // Right align numbers
            },
            {
                targets: [5], // Next dose date
                render: function(data, type, row) {
                    // Highlight upcoming doses (within next 30 days)
                    var doseDate = new Date(data);
                    var today = new Date();
                    var diffDays = Math.ceil((doseDate - today) / (1000 * 60 * 60 * 24));
                    
                    if (diffDays <= 30 && diffDays >= 0) {
                        return '<span class="text-danger fw-bold">' + data + '</span>';
                    }
                    return data;
                }
            }
        ]
    });
});
</script>

<style>
/* Additional style for upcoming doses */
#aftosaTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_IBR Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial de Vacunación IBR</h3>
    <table id="ibrTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tag ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Dosis</th>
                <th>Costo $/Dosis</th>
                <th>Total</th>
                <th>Próxima Dosis</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_ibr table with the same filters as vacuno
            $ibr_sql = "SELECT vh_ibr_tagid, vh_ibr_fecha, vh_ibr_producto, vh_ibr_dosis, vh_ibr_costo, tagid, v.nombre
                          FROM vh_ibr 
                          JOIN vacuno v ON vh_ibr_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $ibr_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $ibr_sql .= " ORDER BY vh_ibr_fecha DESC";
            
            $ibr_result = $conn->query($ibr_sql);
            $total_sum_ibr = 0; // Initialize sum variable

            if ($ibr_result && $ibr_result->num_rows > 0) {
                while($row = $ibr_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_ibr_dosis'] * $row['vh_ibr_costo'];
                    $total_sum_ibr += $total; // Add to running sum

                    // Calculate next dose date (6 months from application)
                    $next_dose = date('Y-m-d', strtotime($row['vh_ibr_fecha'] . ' + 6 months'));
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['vh_ibr_tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_ibr_fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_ibr_producto']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($row['vh_ibr_dosis']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_ibr_costo'], 2)) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($next_dose) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_ibr, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize IBR DataTable
    $('#ibrTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [2, 3, 4], // Dosis, Price and Total columns
                className: 'text-end' // Right align numbers
            },
            {
                targets: [5], // Next dose date
                render: function(data, type, row) {
                    // Highlight upcoming doses (within next 30 days)
                    var doseDate = new Date(data);
                    var today = new Date();
                    var diffDays = Math.ceil((doseDate - today) / (1000 * 60 * 60 * 24));
                    
                    if (diffDays <= 30 && diffDays >= 0) {
                        return '<span class="text-danger fw-bold">' + data + '</span>';
                    }
                    return data;
                }
            }
        ]
    });
});
</script>

<!-- VH_CBR Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Vacunación CBR</h3>
    <table id="cbrTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tag ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Dosis</th>
                <th>Costo $/Dosis</th>
                <th>Total</th>
                <th>Próxima Dosis</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_ibr table with the same filters as vacuno
            $cbr_sql = "SELECT vh_cbr_tagid, vh_cbr_fecha, vh_cbr_producto, vh_cbr_dosis, vh_cbr_costo, tagid, v.nombre
                          FROM vh_cbr 
                          JOIN vacuno v ON vh_cbr_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $cbr_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $cbr_sql .= " ORDER BY vh_cbr_fecha DESC";
            
            $cbr_result = $conn->query($cbr_sql);
            $total_sum_cbr = 0; // Initialize sum variable

            if ($cbr_result && $cbr_result->num_rows > 0) {
                while($row = $cbr_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_cbr_dosis'] * $row['vh_cbr_costo'];
                    $total_sum_cbr += $total; // Add to running sum

                    // Calculate next dose date (6 months from application)
                    $next_dose = date('Y-m-d', strtotime($row['vh_cbr_fecha'] . ' + 6 months'));
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['vh_cbr_tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_cbr_fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_cbr_producto']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($row['vh_cbr_dosis']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_cbr_costo'], 2)) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($next_dose) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_cbr, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize CBR DataTable
    $('#cbrTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [2, 3, 4], // Dosis, Price and Total columns
                className: 'text-end' // Right align numbers
            },
            {
                targets: [5], // Next dose date
                render: function(data, type, row) {
                    // Highlight upcoming doses (within next 30 days)
                    var doseDate = new Date(data);
                    var today = new Date();
                    var diffDays = Math.ceil((doseDate - today) / (1000 * 60 * 60 * 24));
                    
                    if (diffDays <= 30 && diffDays >= 0) {
                        return '<span class="text-danger fw-bold">' + data + '</span>';
                    }
                    return data;
                }
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#cbrTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>
<!-- VH_brucelosis Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Vacunación Brucelosis</h3>
    <table id="brucelosisTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tag ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Dosis</th>
                <th>Costo $/Dosis</th>
                <th>Total</th>
                <th>Próxima Dosis</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_brucelosis table with the same filters as vacuno
            $brucelosis_sql = "SELECT vh_brucelosis_tagid, vh_brucelosis_fecha, vh_brucelosis_producto, 		vh_brucelosis_dosis, vh_brucelosis_costo, tagid, v.nombre
                          FROM vh_brucelosis 
                          JOIN vacuno v ON vh_brucelosis_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $brucelosis_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $brucelosis_sql .= " ORDER BY vh_brucelosis_fecha DESC";
            
            $brucelosis_result = $conn->query($brucelosis_sql);
            $total_sum_brucelosis = 0; // Initialize sum variable

            if ($brucelosis_result && $brucelosis_result->num_rows > 0) {
                while($row = $brucelosis_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_brucelosis_dosis'] * $row['vh_brucelosis_costo'];
                    $total_sum_brucelosis += $total; // Add to running sum

                    // Calculate next dose date (6 months from application)
                    $next_dose = date('Y-m-d', strtotime($row['vh_brucelosis_fecha'] . ' + 6 months'));
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['vh_brucelosis_tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_brucelosis_fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_brucelosis_producto']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($row['vh_brucelosis_dosis']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_brucelosis_costo'], 2)) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($next_dose) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_brucelosis, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize brucelosis DataTable
    $('#brucelosisTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [2, 3, 4], // Dosis, Price and Total columns
                className: 'text-end' // Right align numbers
            },
            {
                targets: [5], // Next dose date
                render: function(data, type, row) {
                    // Highlight upcoming doses (within next 30 days)
                    var doseDate = new Date(data);
                    var today = new Date();
                    var diffDays = Math.ceil((doseDate - today) / (1000 * 60 * 60 * 24));
                    
                    if (diffDays <= 30 && diffDays >= 0) {
                        return '<span class="text-danger fw-bold">' + data + '</span>';
                    }
                    return data;
                }
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#brucelosisTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>
<!-- VH_carbunco Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Vacunación Carbunco</h3>
    <table id="carbuncoTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tag ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Dosis</th>
                <th>Costo $/Dosis</th>
                <th>Total</th>
                <th>Próxima Dosis</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_carbunco table with the same filters as vacuno
            $carbunco_sql = "SELECT vh_carbunco_tagid, vh_carbunco_fecha, vh_carbunco_producto, 		vh_carbunco_dosis, vh_carbunco_costo, tagid, v.nombre
                          FROM vh_carbunco 
                          JOIN vacuno v ON vh_carbunco_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $carbunco_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $carbunco_sql .= " ORDER BY vh_carbunco_fecha DESC";
            
            $carbunco_result = $conn->query($carbunco_sql);
            $total_sum_carbunco = 0; // Initialize sum variable

            if ($carbunco_result && $carbunco_result->num_rows > 0) {
                while($row = $carbunco_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_carbunco_dosis'] * $row['vh_carbunco_costo'];
                    $total_sum_carbunco += $total; // Add to running sum

                    // Calculate next dose date (6 months from application)
                    $next_dose = date('Y-m-d', strtotime($row['vh_carbunco_fecha'] . ' + 6 months'));
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['vh_carbunco_tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_carbunco_fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_carbunco_producto']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($row['vh_carbunco_dosis']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_carbunco_costo'], 2)) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($next_dose) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_carbunco, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize carbunco DataTable
    $('#carbuncoTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [2, 3, 4], // Dosis, Price and Total columns
                className: 'text-end' // Right align numbers
            },
            {
                targets: [5], // Next dose date
                render: function(data, type, row) {
                    // Highlight upcoming doses (within next 30 days)
                    var doseDate = new Date(data);
                    var today = new Date();
                    var diffDays = Math.ceil((doseDate - today) / (1000 * 60 * 60 * 24));
                    
                    if (diffDays <= 30 && diffDays >= 0) {
                        return '<span class="text-danger fw-bold">' + data + '</span>';
                    }
                    return data;
                }
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#carbuncoTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_garrapatas Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Tratamiento Garrapatas</h3>
    <table id="garrapatasTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tag ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Dosis</th>
                <th>Costo $/Dosis</th>
                <th>Total</th>
                <th>Próxima Dosis</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_garrapatas table with the same filters as vacuno
            $garrapatas_sql = "SELECT vh_garrapatas_tagid, vh_garrapatas_fecha, vh_garrapatas_producto, 		vh_garrapatas_dosis, vh_garrapatas_costo, tagid, v.nombre
                          FROM vh_garrapatas 
                          JOIN vacuno v ON vh_garrapatas_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $garrapatas_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $garrapatas_sql .= " ORDER BY vh_garrapatas_fecha DESC";
            
            $garrapatas_result = $conn->query($garrapatas_sql);
            $total_sum_garrapatas = 0; // Initialize sum variable

            if ($garrapatas_result && $garrapatas_result->num_rows > 0) {
                while($row = $garrapatas_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_garrapatas_dosis'] * $row['vh_garrapatas_costo'];
                    $total_sum_garrapatas += $total; // Add to running sum

                    // Calculate next dose date (6 months from application)
                    $next_dose = date('Y-m-d', strtotime($row['vh_garrapatas_fecha'] . ' + 6 months'));
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['vh_garrapatas_tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_garrapatas_fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_garrapatas_producto']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($row['vh_garrapatas_dosis']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_garrapatas_costo'], 2)) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($next_dose) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_garrapatas, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize garrapatas DataTable
    $('#garrapatasTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [2, 3, 4], // Dosis, Price and Total columns
                className: 'text-end' // Right align numbers
            },
            {
                targets: [5], // Next dose date
                render: function(data, type, row) {
                    // Highlight upcoming doses (within next 30 days)
                    var doseDate = new Date(data);
                    var today = new Date();
                    var diffDays = Math.ceil((doseDate - today) / (1000 * 60 * 60 * 24));
                    
                    if (diffDays <= 30 && diffDays >= 0) {
                        return '<span class="text-danger fw-bold">' + data + '</span>';
                    }
                    return data;
                }
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#garrapatasTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_mastitis Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Tratamiento Mastitis</h3>
    <table id="mastitisTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tag ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Dosis</th>
                <th>Costo $/Dosis</th>
                <th>Total</th>
                <th>Próxima Dosis</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_mastitis table with the same filters as vacuno
            $mastitis_sql = "SELECT vh_mastitis_tagid, vh_mastitis_fecha, vh_mastitis_producto, 		vh_mastitis_dosis, vh_mastitis_costo, tagid, v.nombre
                          FROM vh_mastitis 
                          JOIN vacuno v ON vh_mastitis_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $mastitis_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $mastitis_sql .= " ORDER BY vh_mastitis_fecha DESC";
            
            $mastitis_result = $conn->query($mastitis_sql);
            $total_sum_mastitis = 0; // Initialize sum variable

            if ($mastitis_result && $mastitis_result->num_rows > 0) {
                while($row = $mastitis_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_mastitis_dosis'] * $row['vh_mastitis_costo'];
                    $total_sum_mastitis += $total; // Add to running sum

                    // Calculate next dose date (6 months from application)
                    $next_dose = date('Y-m-d', strtotime($row['vh_mastitis_fecha'] . ' + 6 months'));
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['vh_mastitis_tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_mastitis_fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_mastitis_producto']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($row['vh_mastitis_dosis']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_mastitis_costo'], 2)) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($next_dose) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_mastitis, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize mastitis DataTable
    $('#mastitisTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [2, 3, 4], // Dosis, Price and Total columns
                className: 'text-end' // Right align numbers
            },
            {
                targets: [5], // Next dose date
                render: function(data, type, row) {
                    // Highlight upcoming doses (within next 30 days)
                    var doseDate = new Date(data);
                    var today = new Date();
                    var diffDays = Math.ceil((doseDate - today) / (1000 * 60 * 60 * 24));
                    
                    if (diffDays <= 30 && diffDays >= 0) {
                        return '<span class="text-danger fw-bold">' + data + '</span>';
                    }
                    return data;
                }
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#mastitisTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_lombrices Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Tratamiento Lombrices</h3>
    <table id="lombricesTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Dosis</th>
                <th class="text-center">Costo $/Dosis</th>
                <th class="text-center">Total</th>
                <th class="text-center">Próxima Dosis</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_lombrices table with the same filters as vacuno
            $lombrices_sql = "SELECT vh_lombrices_tagid, vh_lombrices_fecha, vh_lombrices_producto, vh_lombrices_dosis, vh_lombrices_costo, tagid, v.nombre
                          FROM vh_lombrices 
                          JOIN vacuno v ON vh_lombrices_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $lombrices_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $lombrices_sql .= " ORDER BY vh_lombrices_fecha DESC";
            
            $lombrices_result = $conn->query($lombrices_sql);
            $total_sum_lombrices = 0; // Initialize sum variable

            if ($lombrices_result && $lombrices_result->num_rows > 0) {
                while($row = $lombrices_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_lombrices_dosis'] * $row['vh_lombrices_costo'];
                    $total_sum_lombrices += $total; // Add to running sum

                    // Calculate next dose date (6 months from application)
                    $next_dose = date('Y-m-d', strtotime($row['vh_lombrices_fecha'] . ' + 6 months'));
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['vh_lombrices_tagid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_lombrices_fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vh_lombrices_producto']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($row['vh_lombrices_dosis']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_lombrices_costo'], 2)) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($total, 2)) . "</td>";
                    echo "<td>" . htmlspecialchars($next_dose) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_lombrices, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize lombrices DataTable
    $('#lombricesTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        responsive: true,
        order: [[0, 'desc']], // Order by date descending
        columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            },
            {
                targets: [5], // Next dose date
                render: function(data, type, row) {
                    // Highlight upcoming doses (within next 30 days)
                    var doseDate = new Date(data);
                    var today = new Date();
                    var diffDays = Math.ceil((doseDate - today) / (1000 * 60 * 60 * 24));
                    
                    if (diffDays <= 30 && diffDays >= 0) {
                        return '<span class="text-danger fw-bold">' + data + '</span>';
                    }
                    return data;
                }
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#lombricesTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_inseminacion Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Inseminacion</h3>
    <table id="inseminacionTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Numero</th>                               
                <th class="text-center">Costo $</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_inseminacion table with the same filters as vacuno
            $inseminacion_sql = "SELECT vh_inseminacion_tagid, vh_inseminacion_fecha, vh_inseminacion_costo, vh_inseminacion_numero, v.tagid, v.nombre
                          FROM vh_inseminacion 
                          JOIN vacuno v ON vh_inseminacion_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $inseminacion_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $inseminacion_sql .= " ORDER BY vh_inseminacion_fecha DESC";
            
            $inseminacion_result = $conn->query($inseminacion_sql);
            
	        $total_sum_inseminacion = 0; // Initialize sum variable

            if ($inseminacion_result && $inseminacion_result->num_rows > 0) {
                while($row = $inseminacion_result->fetch_assoc()) {
                    // Calculate total
                    $total = $row['vh_inseminacion_costo'];
                    $total_sum_inseminacion += $total; // Add to running sum
                                        
                echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_inseminacion_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_inseminacion_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_inseminacion_numero']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($row['vh_inseminacion_costo'], 2)) . "</td>";                    
                echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Total General:</th>
                <th class="text-center">$<?php echo number_format($total_sum_inseminacion, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize inseminacion DataTable
    $('#inseminacionTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            responsive: true,
            order: [[0, 'desc']], // Order by date descending
            columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#inseminacionTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_gestacion Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Gestacion</h3>
    <table id="gestacionTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Numero</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_gestacion table with the same filters as vacuno
            $gestacion_sql = "SELECT vh_gestacion_tagid, vh_gestacion_fecha, vh_gestacion_numero, v.tagid, v.nombre
                          FROM vh_gestacion 
                          JOIN vacuno v ON vh_gestacion_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $gestacion_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $gestacion_sql .= " ORDER BY vh_gestacion_fecha DESC";
            
            $gestacion_result = $conn->query($gestacion_sql);

            if ($gestacion_result && $gestacion_result->num_rows > 0) {
                while($row = $gestacion_result->fetch_assoc()) {
                    
                                        
                echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_gestacion_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_gestacion_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_gestacion_numero']) . "</td>";                                     
                echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize gestacion DataTable
    $('#gestacionTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            responsive: true,
            order: [[0, 'desc']], // Order by date descending
            columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#gestacionTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_parto Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Parto</h3>
    <table id="partoTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Numero</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_parto table with the same filters as vacuno
            $parto_sql = "SELECT vh_parto_tagid, vh_parto_fecha, vh_parto_numero, v.tagid, v.nombre
                          FROM vh_parto 
                          JOIN vacuno v ON vh_parto_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $parto_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $parto_sql .= " ORDER BY vh_parto_fecha DESC";
            
            $parto_result = $conn->query($parto_sql);

            if ($parto_result && $parto_result->num_rows > 0) {
                while($row = $parto_result->fetch_assoc()) {
                    
                                        
                echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_parto_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_parto_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_parto_numero']) . "</td>";
                echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize parto DataTable
    $('#partoTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            responsive: true,
            order: [[0, 'desc']], // Order by date descending
            columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#partoTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_aborto Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Abortos</h3>
    <table id="abortoTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Causa</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_aborto table with the same filters as vacuno
            $aborto_sql = "SELECT vh_aborto_tagid, vh_aborto_fecha, vh_aborto_causa, v.tagid, v.nombre
                          FROM vh_aborto 
                          JOIN vacuno v ON vh_aborto_tagid = v.tagid";
            
            if (!empty($where_conditions)) {
                $aborto_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $aborto_sql .= " ORDER BY vh_aborto_fecha DESC";
            
            $aborto_result = $conn->query($aborto_sql);

            if ($aborto_result && $aborto_result->num_rows > 0) {
                while($row = $aborto_result->fetch_assoc()) {
                    
                                        
                echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_aborto_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_aborto_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_aborto_causa']) . "</td>";
                echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize aborto DataTable
    $('#abortoTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            responsive: true,
            order: [[0, 'desc']], // Order by date descending
            columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#abortoTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_venta Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Venta</h3>
    <table id="ventaTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Fecha</th>                
                <th class="text-center">Peso</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Monto</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_venta table with the same filters as vacuno
            $venta_sql = "SELECT vh_venta_tagid, vh_venta_fecha, vh_venta_precio, vh_venta_peso, v.tagid, v.nombre
                          FROM vh_venta 
                          JOIN vacuno v ON vh_venta_tagid = v.tagid";

            $total_sum_ventas = 0;
            if (!empty($where_conditions)) {
                $venta_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $venta_sql .= " ORDER BY vh_venta_fecha DESC";
            
            $venta_result = $conn->query($venta_sql);

            if ($venta_result && $venta_result->num_rows > 0) {
                while($row = $venta_result->fetch_assoc()) {
                    $monto = $row['vh_venta_peso'] * $row['vh_venta_precio'];
                    $total_sum_ventas += $monto;
                                        
                echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_venta_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_venta_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_venta_peso']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_venta_precio']) . "</td>";
                    echo "<td class='text-end'>$" . htmlspecialchars(number_format($monto, 2)) . "</td>";
                echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-end">Total Ventas:</th>
                <th class="text-center">$<?php echo number_format($total_sum_ventas, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize venta DataTable
    $('#ventaTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            responsive: true,
            order: [[0, 'desc']], // Order by date descending
            columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#ventaTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_destete Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Destete</h3>
    <table id="desteteTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Fecha</th>                
                <th class="text-center">Peso</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_destete table with the same filters as vacuno
            $destete_sql = "SELECT vh_destete_tagid, vh_destete_fecha, vh_destete_peso, v.tagid, v.nombre
                          FROM vh_destete 
                          JOIN vacuno v ON vh_destete_tagid = v.tagid";
                          
            $total_sum_destetes = 0;
            if (!empty($where_conditions)) {
                $destete_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $destete_sql .= " ORDER BY vh_destete_fecha DESC";
            
            $destete_result = $conn->query($destete_sql);
            $prom_peso_destete = 0;
            $numero_destetes = 0;
            $destetes_total = 0;

            if ($destete_result && $destete_result->num_rows > 0) {
                while($row = $destete_result->fetch_assoc()) {
                    $destetes_total += $row['vh_destete_peso'];
                    $numero_destetes++;
                    $prom_peso_destete = $destetes_total / $numero_destetes;
                                        
                echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_destete_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_destete_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_destete_peso']) . "</td>";
                echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total Promedio Peso:</th>
                <th class="text-center">$<?php echo number_format($prom_peso_destete, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize destete DataTable
    $('#desteteTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            responsive: true,
            order: [[0, 'desc']], // Order by date descending
            columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#desteteTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

<!-- VH_descarte Table -->
<div class="container table-container mt-4">
    <h3 style="text-align: center;">Historial Descarte</h3>
    <table id="descarteTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Tag ID</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Fecha</th>                
                <th class="text-center">Peso</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Query for vh_descarte table with the same filters as vacuno
            $descarte_sql = "SELECT vh_descarte_tagid, vh_descarte_fecha, vh_descarte_peso, v.tagid, v.nombre
                          FROM vh_descarte 
                          JOIN vacuno v ON vh_descarte_tagid = v.tagid";
                          
            $total_sum_descartes = 0;
            if (!empty($where_conditions)) {
                $descarte_sql .= " WHERE " . implode(" AND ", $where_conditions);
            }
            
            $descarte_sql .= " ORDER BY vh_descarte_fecha DESC";
            
            $descarte_result = $conn->query($descarte_sql);

            $descartes_total = 0;

            if ($descarte_result && $descarte_result->num_rows > 0) {
                while($row = $descarte_result->fetch_assoc()) {
                    $descartes_total += $row['vh_descarte_peso'];                    
                                        
                echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_descarte_tagid']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_descarte_fecha']) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row['vh_descarte_peso']) . "</td>";
                echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total:</th>
                <th class="text-center">$<?php echo number_format($descartes_total, 2); ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize descarte DataTable
    $('#descarteTable').DataTable({
        dom: '<"top"<"row"<"col-sm-6"l><"col-sm-6"f>>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)"
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            responsive: true,
            order: [[0, 'desc']], // Order by date descending
            columnDefs: [
            {
                targets: '_all',
                className: 'align-middle text-center' // Added text-center for all columns
            }
        ]
    });
});
</script>
<style>
/* Additional style for upcoming doses */
#descarteTable .text-danger {
    color: #dc3545 !important;
}
.fw-bold {
    font-weight: bold !important;
}
</style>

</body>
</html>
<?php
$conn->close();
?> 