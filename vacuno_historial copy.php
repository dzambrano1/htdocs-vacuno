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
?>

<!DOCTYPE html>
<html>
<head>
<title>Historial Vacuno</title>
<!-- Link to the Favicon -->
<link rel="icon" href="images/ganagram_ico.ico" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<style>
            :root {
            --primary-color: #e0e8dc;
            --secondary-color: #4a5d23;
            --background-color: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0rem;
            padding: 0;

        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            gap: 0.1rem;
            padding: 0.3rem;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 0.5;
            color: #333;
            padding: 10px;
        }
        .info-card-container{
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            padding: 0.5rem;
            margin: 1rem;            
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            gap: 0.5rem;
        }

        .info-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            padding: 0.1rem;
            margin: 0.1rem;
            transition: transform 0.3s ease;
        }

        .info-card:hover {
          background-color: var(--primary-color);
            transform: translateY(-5px);
            font-size: x-small;
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.1rem;
            padding-bottom: 0.1rem;
            border-bottom: 2px solid #eee;
        }

        .icon-wrapper {
            width: 7rem;
            height: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .icon-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
       
        .additional-info {
            margin-top: 1rem;
            padding-top: 0.3rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .info-item {
            text-align: center;
            flex: 1;
        }

        .info-item:not(:last-child) {
            border-right: 1px solid #eee;
        }

        .info-label {
            font-size: 1rem;
            font-weight: 600;
            color: #666;
            margin: 0.25rem;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin: 0.5rem;
            text-align: center;
            font-weight: 500;
        }
        .numero-label{
            font-size: 2rem;
            font-weight: 600;
            color: #666;
            margin-left: 1rem;    
        }
        .numero-unidad{
            font-size: 1rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-left: 1rem;
            margin-top: 1rem;
        }

        @media (max-width: 480px) {
            .container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .info-card {
                margin: 0;
                padding: 0rem;
            }

            .icon-wrapper {
                border-radius: 12px;
                margin-right: 0.5rem;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
            }            
        }

        /* Custom tooltip styling */
        .tooltip {
            font-size: 1rem !important;
        }
        
        .tooltip-inner {
            max-width: 200px;
            padding: 0.25rem 0.5rem;
            font-size: 1rem;
            line-height: 1.2;
        }

    
    .table-section {
        margin-bottom: 40px;
    }
    .section-title {
        background-color: #f8f9fa;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-weight: bold;
    }
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 48px;
        font-weight:bolder;
        color: #83956e;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        text-transform: uppercase;
    }
    
    /* Responsive font sizes */
    @media screen and (max-width: 768px) {
        .page-title {
            font-size: 36px;
        }
    }
    
    @media screen and (max-width: 480px) {
        .page-title {
            font-size: 24px;
        }
        .section-title {
            font-size: 18px;
        }
        .desktop-table {
            display: none;
        }
        .mobile-table {
            display: block;
        }
    }
    @media screen and (min-width: 320) {
        .desktop-table {
            display: block;
        }
        .mobile-table {
            display: none;
        }
    }
    .dtr-details {
        width: 100%;
    }
    
    /* Specific styles for Carne table */
    #pesoTable {
        width: 100% !important;
    }
    
    /* Desktop */
    @media screen and (min-width: 1024px) {
        #pesoTable th, 
        #pesoTable td {
            min-width: 150px;
        }
    }
    
    /* Tablet */
    @media screen and (max-width: 768px) {
        #pesoTable th, 
        #pesoTable td {
            min-width: 100px;
            font-size: 14px;
            padding: 8px 4px;
        }
    }
    
    /* Mobile */
    @media screen and (max-width: 480px) {
        #pesoTable th, 
        #pesoTable td {
            min-width: 80px;
            font-size: 12px;
            padding: 6px 3px;
        }
    }
    
    /* Center align all content in Carne table */
    #pesoTable th,
    #pesoTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }
    
    /* Center align DataTables controls for Carne table */
    #pesoTable_wrapper .dataTables_filter,
    #pesoTable_wrapper .dataTables_length,
    #pesoTable_wrapper .dataTables_info,
    #pesoTable_wrapper .dataTables_paginate {
        text-align: center !important;
    }
    
    /* Specific styles for Leche table */
    #lecheTable {
        width: 100% !important;
    }
    
    /* Desktop */
    @media screen and (min-width: 1024px) {
        #lecheTable th, 
        #lecheTable td {
            min-width: 150px;
        }
    }
    
    /* Tablet */
    @media screen and (max-width: 768px) {
        #lecheTable th, 
        #lecheTable td {
            min-width: 100px;
            font-size: 14px;
            padding: 8px 4px;
        }
    }
    
    /* Mobile */
    @media screen and (max-width: 480px) {
        #lecheTable th, 
        #lecheTable td {
            min-width: 80px;
            font-size: 12px;
            padding: 6px 3px;
        }
    }
    
    /* Center align all content in Leche table */
    #lecheTable th,
    #lecheTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }
    
    /* Center align DataTables controls for Leche table */
    #lecheTable_wrapper .dataTables_filter,
    #lecheTable_wrapper .dataTables_length,
    #lecheTable_wrapper .dataTables_info,
    #lecheTable_wrapper .dataTables_paginate {
        text-align: center !important;
    }
    
    /* Specific styles for Alimentacion table */
    #alimentacionTable {
        width: 100% !important;
    }
    
    /* Desktop */
    @media screen and (min-width: 1024px) {
        #alimentacionTable th, 
        #alimentacionTable td {
            min-width: 150px;
        }
    }
    
    /* Tablet */
    @media screen and (max-width: 768px) {
        #alimentacionTable th, 
        #alimentacionTable td {
            min-width: 100px;
            font-size: 14px;
            padding: 8px 4px;
        }
    }
    
    /* Mobile */
    @media screen and (max-width: 480px) {
        #alimentacionTable th, 
        #alimentacionTable td {
            min-width: 80px;
            font-size: 12px;
            padding: 6px 3px;
        }
    }
    
    /* Center align all content in Alimentacion table */
    #alimentacionTable th,
    #alimentacionTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }
    
    /* Center align DataTables controls for Alimentacion table */
    #alimentacionTable_wrapper .dataTables_filter,
    #alimentacionTable_wrapper .dataTables_length,
    #alimentacionTable_wrapper .dataTables_info,
    #alimentacionTable_wrapper .dataTables_paginate {
        text-align: center !important;
    }
    
    /* Styles for Vacunas, Baños, Parasitos, Reproduccion, and Preñez y Parto tables */
    #aftosaTable, #banosTable, #parasitosTable, #reproduccionTable, #prenezTable, #partoTable {
        width: 100% !important;
    }

    /* Desktop */
    @media screen and (min-width: 1024px) {
        #aftosaTable th, #aftosaTable td,
        #banosTable th, #banosTable td,
        #parasitosTable th, #parasitosTable td,
        #reproduccionTable th, #reproduccionTable td,
        #prenezTable th, #prenezTable td,
        #partoTable th, #partoTable td {
            min-width: 150px;
        }
    }

    /* Tablet */
    @media screen and (max-width: 768px) {
        #aftosaTable th, #aftosaTable td,
        #banosTable th, #banosTable td,
        #parasitosTable th, #parasitosTable td,
        #reproduccionTable th, #reproduccionTable td,
        #prenezTable th, #prenezTable td,
        #partoTable th, #partoTable td {
            min-width: 100px;
            font-size: 14px;
            padding: 8px 4px;
        }
    }

    /* Mobile */
    @media screen and (max-width: 480px) {
        #aftosaTable th, #aftosaTable td,
        #banosTable th, #banosTable td,
        #parasitosTable th, #parasitosTable td,
        #reproduccionTable th, #reproduccionTable td,
        #prenezTable th, #prenezTable td,
        #partoTable th, #partoTable td {
            min-width: 80px;
            font-size: 12px;
            padding: 6px 3px;
        }
    }

    /* Center align all content */
    #aftosaTable th, #aftosaTable td,
    #banosTable th, #banosTable td,
    #parasitosTable th, #parasitosTable td,
    #reproduccionTable th, #reproduccionTable td,
    #prenezTable th, #prenezTable td,
    #partoTable th, #partoTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }

    /* Center align DataTables controls */
    #aftosaTable_wrapper .dataTables_filter,
    #aftosaTable_wrapper .dataTables_length,
    #aftosaTable_wrapper .dataTables_info,
    #aftosaTable_wrapper .dataTables_paginate,
    #banosTable_wrapper .dataTables_filter,
    #banosTable_wrapper .dataTables_length,
    #banosTable_wrapper .dataTables_info,
    #banosTable_wrapper .dataTables_paginate,
    #parasitosTable_wrapper .dataTables_filter,
    #parasitosTable_wrapper .dataTables_length,
    #parasitosTable_wrapper .dataTables_info,
    #parasitosTable_wrapper .dataTables_paginate,
    #reproduccionTable_wrapper .dataTables_filter,
    #reproduccionTable_wrapper .dataTables_length,
    #reproduccionTable_wrapper .dataTables_info,
    #reproduccionTable_wrapper .dataTables_paginate,
    #prenezTable_wrapper .dataTables_filter,
    #prenezTable_wrapper .dataTables_length,
    #prenezTable_wrapper .dataTables_info,
    #prenezTable_wrapper .dataTables_paginate,
    #partoTable_wrapper .dataTables_filter,
    #partoTable_wrapper .dataTables_length,
    #partoTable_wrapper .dataTables_info,
    #partoTable_wrapper .dataTables_paginate {
        text-align: center !important;
    }

    .section-title {
        background-color: #83956e;
        color: white;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-weight: bold;
    }

    .sub-section-title {
        color: #689260;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #83956e;
        border-color: #83956e;
    }

    .btn-primary:hover {
        background-color: #689260;
        border-color: #689260;
    }

    /* DataTables custom styling */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #83956e;
        border-radius: 4px;
    }

    .dataTables_wrapper .paginate_button.current {
        background: #83956e !important;
        color: white !important;
        border: 1px solid #83956e !important;
    }

    .dataTables_wrapper .paginate_button:hover {
        background: #689260 !important;
        color: white !important;
        border: 1px solid #689260 !important;
    }

    /* Add these styles within the existing <style> tag */
    .header-container {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }

    .animal-name {
        text-align: center;
        color: #689260;
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    @media screen and (max-width: 768px) {
        .animal-name {
            font-size: 20px;
        }
    }

    @media screen and (max-width: 480px) {
        .animal-name {
            font-size: 18px;
        }
    }

    .back-btn {
        position: fixed;
        top: 20px;
        left: 20px;
        font-size: 64px;
        color: #83956e;
        text-decoration: none;
        transition: color 0.3s;
        z-index: 10000;
    }

    .back-btn:hover {
        color: #689260;
    }

    @media screen and (max-width: 768px) {
        .back-btn {
            font-size: 56px;
            left: 15px;
            top: 15px;
        }
    }

    @media screen and (max-width: 480px) {
        .back-btn {
            font-size: 48px;
            left: 10px;
            top: 10px;
        }
    }

    /* Remove the margin-left from input-group */
    /*.input-group {
        margin-left: 100px;
    }*/

    #concentradoTable th,
    #concentradoTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }

    .delete-aftosa {
        padding: 0.25rem 0.5rem;
    }

    .delete-aftosa i {
        color: white;
    }

    #addVacunaForm {
        background-color: #f8f9fa;
        border-radius: 0.25rem;
        padding: 1rem;
    }

    #addVacunaForm .form-label {
        font-weight: 500;
        color: #212529;
    }

    #addVacunaForm .btn-success {
        background-color: #83956e;
        border-color: #83956e;
    }

    #addVacunaForm .btn-success:hover {
        background-color: #689260;
        border-color: #689260;
    }
</style>
</head>
<body>

    <!-- Add back button before the header container -->
    <a href="http://localhost:3000/vacuno/inventario_vacuno.php" class="back-btn">
        <i class="fas fa-arrow-left"></i>
    </a>

    <?php
    // Get animal name if tagid is provided
    $animalName = '';
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $tagid = $conn->real_escape_string($_GET['search']);
        $nameQuery = "SELECT nombre FROM vacuno WHERE tagid = '$tagid'";
        $nameResult = $conn->query($nameQuery);
        if ($nameResult && $nameResult->num_rows > 0) {
            $nameRow = $nameResult->fetch_assoc();
            $animalName = $nameRow['nombre'];
        }
    }
    ?>

<div class="container">
    <div class="info-card-container" 
        data-bs-toggle="tooltip" 
        data-bs-placement="bottom" 
        title="Click para seccion Produccion">
        <div class="info-card">
        <div class="card-header">
            <div class="icon-wrapper">
                <img src="./images/bascula-de-comestibles.png" alt="trigo Icon" class="rounded">
            </div>
            <div class="card-content">
                <div class="numero-label">7</div>
                <div class="numero-unidad">Toneladas</div>
            </div>
        </div>
        <div class="additional-info">
            <div class="info-item">
                <div class="info-label">Becerros</div>
                <div class="info-value text-success">
                    <div class="info-value">1 T</div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Novillos</div>
                <div class="info-value">3 T</div>
            </div>
            <div class="info-item">
                <div class="info-label">Adultos</div>
                <div class="info-value text-primary">
                    <div class="info-value">5 T</div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="info-card-container" 
        data-bs-toggle="tooltip" 
        data-bs-placement="bottom" 
        title="Click para seccion Reproduccion">
        <div class="info-card">
        <div class="card-header">
            <div class="icon-wrapper">
                <img src="./images/matriz.png" alt="Cow Icon" class="rounded">
            </div>
            <div class="card-content">
                <div class="numero-label">50</div>
                <div class="numero-unidad">Vientres</div>
            </div>
        </div>
        <div class="additional-info">
            <div class="info-item">
                <div class="info-label">Preñadas</div>
                <div class="info-value text-success">
                    <div class="info-value">30</div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Vacias</div>
                <div class="info-value">20</div>
            </div>
            <div class="info-item">
                <div class="info-label">Relacion</div>
                <div class="info-value text-primary">
                    <div class="info-value">60%</div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="info-card-container" 
        data-bs-toggle="tooltip" 
        data-bs-placement="bottom" 
        title="Click para seccion Salud">  
        <div class="info-card">
            <div class="card-header">
                <div class="icon-wrapper">
                    <img src="./images/vacunacion.png" alt="carne Icon" class="rounded">
                </div>
                <div class="card-content">
                    <div class="numero-label">750</div>
                    <div class="numero-unidad">Vacunados</div>
                </div>
            </div>
            <div class="additional-info">
                <div class="info-item">
                    <div class="info-label">Becerros</div>
                    <div class="info-value text-success">
                        <div class="info-value">50</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Novillos</div>
                    <div class="info-value">200</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Adultos</div>
                    <div class="info-value text-primary">
                        <div class="info-value">500</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="info-card-container" 
        data-bs-toggle="tooltip" 
        data-bs-placement="bottom" 
        title="Click para seccion Alimentacion">
        <div class="info-card">
            <div class="card-header">
                <div class="icon-wrapper">
                <img src="./images/bolso.png" alt="trigo Icon" class="rounded">
                </div>
                <div class="card-content">
                    <div class="numero-label">1</div>
                    <div class="numero-unidad">Tonelada</div>
                </div>
            </div>
            <div class="additional-info">
                <div class="info-item">
                    <div class="info-label">Becerros</div>
                    <div class="info-value text-success">
                        <div class="info-value">0.1 T</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Novillos</div>
                    <div class="info-value">0.3 T</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Adultos</div>
                    <div class="info-value text-primary">
                        <div class="info-value">0.6 T</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4" style="display:block; justify-content: center; align-items: center;">
        <div>
            <h1 class="page-title">REGISTROS</h1>
            <?php if (!empty($animalName)): ?>
                <div class="animal-name">(<?php echo htmlspecialchars(strtoupper($animalName)); ?>)</div>
            <?php endif; ?>
        </div>
</div>

<?php
// PESAJE ANIMAL 
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_peso = "SELECT * FROM vh_peso WHERE vh_peso_tagid = '$tagid' ORDER BY vh_peso_fecha ASC";
} else {
    $baseQuery_peso = "SELECT * FROM vh_peso ORDER BY vh_peso_fecha ASC";
}
$result_peso = $conn->query($baseQuery_peso);

$pesoData = [];
$pesoFechaLabels = [];
$monthlyWeights = [];
$regressionLine = [];

if ($result_peso->num_rows > 0) {
    // First, collect all weights by month
    while ($row = $result_peso->fetch_assoc()) {
        $date = new DateTime($row['vh_peso_fecha']);
        $monthKey = $date->format('Y-m');
        
        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_peso_animal']);
        $pesoFechaLabels[] = $row['vh_peso_fecha'];
    }
    
    // Initialize array for monthly data
    $monthlyData = array_fill(0, count($pesoFechaLabels), null);
    
    // Calculate monthly weights
    foreach ($pesoFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        
        if (isset($monthlyWeights[$month])) {
            $monthlyData[$index] = end($monthlyWeights[$month]);
        }
    }
    
    // Calculate linear regression
    $x = [];
    $y = [];
    $n = 0;
    
    // Collect points for regression (excluding null values)
    foreach ($monthlyData as $index => $weight) {
        if ($weight !== null) {
            $x[] = $n;
            $y[] = $weight;
            $n++;
        }
    }
    
    if (count($x) > 1) { // Need at least 2 points for regression
        // Calculate means
        $x_mean = array_sum($x) / count($x);
        $y_mean = array_sum($y) / count($y);
        
        // Calculate slope (m) and y-intercept (b)
        $numerator = 0;
        $denominator = 0;
        
        for ($i = 0; $i < count($x); $i++) {
            $numerator += ($x[$i] - $x_mean) * ($y[$i] - $y_mean);
            $denominator += pow($x[$i] - $x_mean, 2);
        }
        
        $slope = $denominator != 0 ? $numerator / $denominator : 0;
        $y_intercept = $y_mean - ($slope * $x_mean);
        
        // Generate regression line points
        $regressionLine = array_fill(0, count($monthlyData), null);
        $point_count = 0;
        
        foreach ($monthlyData as $index => $weight) {
            if ($weight !== null) {
                $regressionLine[$index] = $y_intercept + ($slope * $point_count);
                $point_count++;
            }
        }
    }
}

// Calculate monthly average prices
$monthlyPrices = [];
$monthlyPriceData = [];

if ($result_peso->num_rows > 0) {
    $result_peso->data_seek(0); // Reset pointer to start of result set
    
    // First, collect all prices by month
    while ($row = $result_peso->fetch_assoc()) {
        $date = new DateTime($row['vh_peso_fecha']);
        $monthKey = $date->format('Y-m');
        
        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = [
                'sum' => 0,
                'count' => 0
            ];
        }
        
        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_peso_precio']);
        $monthlyPrices[$monthKey]['count']++;
    }
    
    // Initialize array for monthly price data
    $monthlyPriceData = array_fill(0, count($pesoFechaLabels), null);
    
    // Calculate and assign monthly averages
    foreach ($pesoFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }
}

// Calculate monthly average values (weight * price)
$monthlyValues = [];
$monthlyValueData = [];

if ($result_peso->num_rows > 0) {
    $result_peso->data_seek(0); // Reset pointer to start of result set
    
    // First, collect all values by month
    while ($row = $result_peso->fetch_assoc()) {
        $date = new DateTime($row['vh_peso_fecha']);
        $monthKey = $date->format('Y-m');
        
        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = [
                'sum' => 0,
                'count' => 0
            ];
        }
        
        // Calculate total value for each measurement
        $totalValue = floatval($row['vh_peso_animal']) * floatval($row['vh_peso_precio']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }
    
    // Initialize array for monthly value data
    $monthlyValueData = array_fill(0, count($pesoFechaLabels), null);
    
    // Calculate and assign monthly averages
    foreach ($pesoFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        
        if (isset($monthlyValues[$month]) && $monthlyValues[$month]['count'] > 0) {
            $monthlyValueData[$index] = $monthlyValues[$month]['sum'] / $monthlyValues[$month]['count'];
        }
    }
}
// PESAJE LECHE

// Build the base query for milk production
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_leche = "SELECT * FROM vh_leche WHERE vh_leche_tagid = '$tagid' ORDER BY vh_leche_fecha ASC";
} else {
    $baseQuery_leche = "SELECT * FROM vh_leche ORDER BY vh_leche_fecha ASC";
}
$result_leche = $conn->query($baseQuery_leche);

// Calculate monthly average milk production
$lecheData = [];
$lecheFechaLabels = [];
$annualizedMilkData = [];

if ($result_leche->num_rows > 0) {
    while ($row = $result_leche->fetch_assoc()) {
        $lecheFechaLabels[] = $row['vh_leche_fecha'];
        // Annualize each milk production entry (multiply by 365/12)
        $annualizedMilkData[] = floatval($row['vh_leche_peso']) * (365/12);
    }
}

// Build the base query for milk production
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_leche = "SELECT * FROM vh_leche WHERE vh_leche_tagid = '$tagid' ORDER BY vh_leche_fecha ASC";
} else {
    $baseQuery_leche = "SELECT * FROM vh_leche ORDER BY vh_leche_fecha ASC";
}
$result_leche = $conn->query($baseQuery_leche);

// Calculate monthly cumulative milk production
$lecheData = [];
$lecheFechaLabels = [];
$monthlyMilk = [];
$cumulativeMilkData = [];

if ($result_leche->num_rows > 0) {
    // First, collect all milk production by month
    while ($row = $result_leche->fetch_assoc()) {
        $date = new DateTime($row['vh_leche_fecha']);
        $monthKey = $date->format('Y-m');
        
        if (!isset($monthlyMilk[$monthKey])) {
            $monthlyMilk[$monthKey] = 0;
        }
        
        $monthlyMilk[$monthKey] += floatval($row['vh_leche_peso']);
        $lecheFechaLabels[] = $row['vh_leche_fecha'];
    }
    
    // Calculate cumulative sum
    $cumulativeSum = 0;
    $cumulativeMilkData = array_fill(0, count($lecheFechaLabels), null);
    
    foreach ($lecheFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyMilk[$month])) {
            $cumulativeSum += $monthlyMilk[$month] * 365/12;
            $cumulativeMilkData[$index] = $cumulativeSum;
            unset($monthlyMilk[$month]); // Remove to avoid counting twice
        }
    }
}
// Concentrado: Inversion Acumulada Mensual
// Build the base query for concentrado
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_racion = "SELECT * FROM vh_concentrado WHERE vh_concentrado_tagid = '$tagid' ORDER BY vh_concentrado_fecha ASC";
} else {
    $baseQuery_racion = "SELECT * FROM vh_concentrado ORDER BY vh_concentrado_fecha ASC";
}
$result_racion = $conn->query($baseQuery_racion);

// Calculate cumulative investment in feed
$racionFechaLabels = [];
$racionInvestmentData = [];
$cumulativeInvestment = [];

if ($result_racion->num_rows > 0) {
    $previousDate = null;
    $previousRacion = null;
    $previousCosto = null;
    $today = new DateTime(); // Get today's date for final period calculation
    $runningTotal = 0;
    
    while ($row = $result_racion->fetch_assoc()) {
        $currentDate = new DateTime($row['vh_concentrado_fecha']);
        $racionFechaLabels[] = $row['vh_concentrado_fecha'];
        
        if ($previousDate !== null) {
            // Calculate days between previous and current record
            $interval = $previousDate->diff($currentDate);
            $days = $interval->days;
            
            // Calculate investment for this period
            $dailyInvestment = $previousRacion * $previousCosto;
            $periodInvestment = $dailyInvestment * $days;
            
            // Add to running total
            $runningTotal += $periodInvestment;
        }
        
        // Store the cumulative total for this period
        $cumulativeInvestment[] = $runningTotal;
        
        // Store current values for next iteration
        $previousDate = $currentDate;
        $previousRacion = floatval($row['vh_concentrado_racion']);
        $previousCosto = floatval($row['vh_concentrado_costo']);
    }
    
    // Calculate final period up to today
    if ($previousDate !== null) {
        $interval = $previousDate->diff($today);
        $days = $interval->days;
        
        $dailyInvestment = $previousRacion * $previousCosto;
        $periodInvestment = $dailyInvestment * $days;
        
        // Add final period to running total
        $runningTotal += $periodInvestment;
        $cumulativeInvestment[] = $runningTotal;
        $racionFechaLabels[] = $today->format('Y-m-d');
    }
}
// Melaza: Inversion Acumulada Mensual
// Build the base query for melaza
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_melaza = "SELECT * FROM vh_melaza WHERE vh_melaza_tagid = '$tagid' ORDER BY vh_melaza_fecha ASC";
} else {
    $baseQuery_melaza = "SELECT * FROM vh_melaza ORDER BY vh_melaza_fecha ASC";
}
$result_melaza = $conn->query($baseQuery_melaza);

// Calculate cumulative investment in melaza
$melazaFechaLabels = [];
$melazaInvestmentData = [];
$cumulativeMelazaInvestment = [];

if ($result_melaza->num_rows > 0) {
    $previousDate = null;
    $previousRacion = null;
    $previousCosto = null;
    $today = new DateTime(); // Get today's date for final period calculation
    $runningTotal = 0;
    
    while ($row = $result_melaza->fetch_assoc()) {
        $currentDate = new DateTime($row['vh_melaza_fecha']);
        $melazaFechaLabels[] = $row['vh_melaza_fecha'];
        
        if ($previousDate !== null) {
            // Calculate days between previous and current record
            $interval = $previousDate->diff($currentDate);
            $days = $interval->days;
            
            // Calculate investment for this period
            $dailyInvestment = $previousRacion * $previousCosto;
            $periodInvestment = $dailyInvestment * $days;
            
            // Add to running total
            $runningTotal += $periodInvestment;
        }
        
        // Store the cumulative total for this period
        $cumulativeMelazaInvestment[] = $runningTotal;
        
        // Store current values for next iteration
        $previousDate = $currentDate;
        $previousRacion = floatval($row['vh_melaza_racion']);
        $previousCosto = floatval($row['vh_melaza_costo']);
    }
    
    // Calculate final period up to today
    if ($previousDate !== null) {
        $interval = $previousDate->diff($today);
        $days = $interval->days;
        
        $dailyInvestment = $previousRacion * $previousCosto;
        $periodInvestment = $dailyInvestment * $days;
        
        // Add final period to running total
        $runningTotal += $periodInvestment;
        $cumulativeMelazaInvestment[] = $runningTotal;
        $melazaFechaLabels[] = $today->format('Y-m-d');
    }
}

// Build the base query for sal
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_sal = "SELECT * FROM vh_sal WHERE vh_sal_tagid = '$tagid' ORDER BY vh_sal_fecha ASC";
} else {
    $baseQuery_sal = "SELECT * FROM vh_sal ORDER BY vh_sal_fecha ASC";
}
$result_sal = $conn->query($baseQuery_sal);

// Calculate cumulative investment in sal
$salFechaLabels = [];
$salInvestmentData = [];
$cumulativeSalInvestment = [];

if ($result_sal->num_rows > 0) {
    $previousDate = null;
    $previousRacion = null;
    $previousCosto = null;
    $today = new DateTime(); // Get today's date for final period calculation
    $runningTotal = 0;
    
    while ($row = $result_sal->fetch_assoc()) {
        $currentDate = new DateTime($row['vh_sal_fecha']);
        $salFechaLabels[] = $row['vh_sal_fecha'];
        
        if ($previousDate !== null) {
            // Calculate days between previous and current record
            $interval = $previousDate->diff($currentDate);
            $days = $interval->days;
            
            // Calculate investment for this period
            $dailyInvestment = $previousRacion * $previousCosto;
            $periodInvestment = $dailyInvestment * $days;
            
            // Add to running total
            $runningTotal += $periodInvestment;
        }
        
        // Store the cumulative total for this period
        $cumulativeSalInvestment[] = $runningTotal;
        
        // Store current values for next iteration
        $previousDate = $currentDate;
        $previousRacion = floatval($row['vh_sal_racion']);
        $previousCosto = floatval($row['vh_sal_costo']);
    }
    
    // Calculate final period up to today
    if ($previousDate !== null) {
        $interval = $previousDate->diff($today);
        $days = $interval->days;
        
        $dailyInvestment = $previousRacion * $previousCosto;
        $periodInvestment = $dailyInvestment * $days;
        
        // Add final period to running total
        $runningTotal += $periodInvestment;
        $cumulativeSalInvestment[] = $runningTotal;
        $salFechaLabels[] = $today->format('Y-m-d');
    }
}

// Get the last (most recent) value from each cumulative investment array
$totalSalInvestment = end($cumulativeSalInvestment) ?: 0;
$totalMelazaInvestment = end($cumulativeMelazaInvestment) ?: 0;
$totalConcentradoInvestment = end($cumulativeInvestment) ?: 0;

// Calculate the total investment
$totalInvestment = $totalSalInvestment + $totalMelazaInvestment + $totalConcentradoInvestment;

// Calculate percentages
$salPercentage = ($totalInvestment > 0) ? round(($totalSalInvestment / $totalInvestment) * 100, 1) : 0;
$melazaPercentage = ($totalInvestment > 0) ? round(($totalMelazaInvestment / $totalInvestment) * 100, 1) : 0;
$concentradoPercentage = ($totalInvestment > 0) ? round(($totalConcentradoInvestment / $totalInvestment) * 100, 1) : 0;
?>

<!-- Peso Table Section -->
<?php
// Build the base query for Peso
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_peso = "SELECT * FROM vh_peso WHERE vh_peso_tagid = '$tagid'";
} else {
    $baseQuery_peso = "SELECT * FROM vh_peso";
}
$result_peso = $conn->query($baseQuery_peso);
?>
<div class="container">
    <!-- Search Form -->
<form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" id="search" name="search" placeholder="Buscar por Tag ID..." 
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
</div>
<div class="container mt-4">
<div class="table-section">
<h3 class="section-title">REGISTROS DE PRODUCCION</h3>

<!-- Peso Table -->
<div class="mb-4">
    <h4 class="sub-section-title">Control de Peso</h4>
    
    <!-- Add New Peso Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addPesoForm">
        <i class="fas fa-plus"></i> Agregar Peso
    </button>
    
    <div class="collapse mb-3" id="addPesoForm">
        <div class="card card-body">
            <form id="pesoForm" action="process_peso.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Peso Animal (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="peso" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Precio por kg ($)</label>
                        <input type="number" step="0.01" class="form-control" name="precio" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="pesoTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Peso Animal (kg)</th>
                    <th>Precio ($/kg)</th>
                    <th>Valor Total ($)</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_peso->num_rows > 0) {
                    while($row = $result_peso->fetch_assoc()) {
                        $valor_total = floatval($row['vh_peso_animal']) * floatval($row['vh_peso_precio']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_peso_animal']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_peso_precio']) . "</td>";
                        echo "<td>" . number_format($valor_total, 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_peso_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-peso' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<!-- Add this JavaScript for Peso table -->
<script>
$(document).ready(function() {
    $('.delete-peso').click(function(e) {
        e.preventDefault();
        console.log('Delete Peso button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_peso.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- Concentrado Table Section -->
<?php
// Build the base query for Concentrado
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_concentrado = "SELECT * FROM vh_concentrado WHERE vh_concentrado_tagid = '$tagid'";
} else {
    $baseQuery_concentrado = "SELECT * FROM vh_concentrado";
}
$result_concentrado = $conn->query($baseQuery_concentrado);
?>



<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Pesaje animal</h3>
    <canvas id="pesoLineChart"></canvas>
</div>

<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Evolucion Precio ($/Kg) en Pie</h3>
    <canvas id="precioLineChart"></canvas>
</div>

<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Valor del Animal en Pie</h3>
    <canvas id="valorLineChart"></canvas>
</div>

<!-- Leche Table -->
<?php
// Build the base query for Leche
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_leche = "SELECT * FROM vh_leche WHERE vh_leche_tagid = '$tagid'";
} else {
    $baseQuery_leche = "SELECT * FROM vh_leche";
}
$result_leche = $conn->query($baseQuery_leche);
?>

<!-- Leche Table -->
<div class="container"> 
<div class="mb-4">
    <h4 class="sub-section-title">Control de Leche</h4>
    
    <!-- Add New Leche Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addLecheForm">
        <i class="fas fa-plus"></i> Agregar Producción de Leche
    </button>
    
    <div class="collapse mb-3" id="addLecheForm">
        <div class="card card-body">
            <form id="lecheForm" action="process_leche.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Peso Leche (L)</label>
                        <input type="number" step="0.01" class="form-control" name="peso" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Precio por L ($)</label>
                        <input type="number" step="0.01" class="form-control" name="precio" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="lecheTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Peso Leche (L)</th>
                    <th>Precio ($/L)</th>
                    <th>Valor Total ($)</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_valor_leche = 0;
                if ($result_leche->num_rows > 0) {
                    while($row = $result_leche->fetch_assoc()) {
                        $valor_total = floatval($row['vh_leche_peso']) * floatval($row['vh_leche_precio']);
                        $total_valor_leche += $valor_total;
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_leche_peso']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_leche_precio']) . "</td>";
                        echo "<td>" . number_format($valor_total, 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_leche_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-leche' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td></td>
                    <td><strong>$<?php echo number_format($total_valor_leche, 2); ?></strong></td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
</div>
</div>
</div>
<!-- Add this JavaScript for Leche table -->
<script>
$(document).ready(function() {
    $('.delete-leche').click(function(e) {
        e.preventDefault();
        console.log('Delete Leche button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_leche.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Produccion Estimada de Leche</h3>
    <canvas id="lecheLineChart"></canvas>
</div>

<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Produccion Leche (Acumulado)</h3>
    <canvas id="lecheCumulativeChart"></canvas>
</div>
<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Ingresos Leche (Acumulado)</h3>
    <canvas id="lecheRevenueChart"></canvas>
</div>


<!-- Add this JavaScript after your existing chart scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    try {
        // Get the chart element
        const lecheRevenueChart = document.getElementById('lecheRevenueChart');
        
        // Verify chart element exists
        if (!lecheRevenueChart) {
            console.error('Chart element not found: lecheRevenueChart');
            return;
        }

        // Format dates for display
        const formatDates = dates => dates.map(date => {
            if (!date) return '';
            const [year, month, day] = date.split('-');
            return `${month}/${year}`;
        });

        // Get the context
        const lecheRevenueCtx = lecheRevenueChart.getContext('2d');
        
        // Verify data exists
        const fechaLabels = <?php echo json_encode($lecheFechaLabels ?? []); ?>;
        const revenueData = <?php echo json_encode($cumulativeRevenueData ?? []); ?>;
        
        if (!fechaLabels.length || !revenueData.length) {
            console.warn('No data available for chart');
        }

        // Create the chart
        new Chart(lecheRevenueCtx, {
            type: 'line',
            data: {
                labels: formatDates(fechaLabels),
                datasets: [{
                    label: 'Ingresos Acumulados ($)',
                    data: revenueData,
                    borderColor: '#83956e',
                    backgroundColor: 'rgba(131, 149, 110, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#83956e'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 3,
                plugins: {
                    title: {
                        display: false
                    },
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('es-AR', {
                                        style: 'currency',
                                        currency: 'ARS'
                                    }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Mes'
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Ingresos Estimados ($)'
                        },
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS'
                                }).format(value);
                            }
                        }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error creating chart:', error);
    }
});
</script>

<div class="container table-section" style="display:block; justify-content: center; align-items: center;">
<h3 class="section-title">REGISTROS DE ALIMENTACION</h3>
<!-- ALIMENTACION Table -->
<!-- Concentrado Table -->
    <h4 class="sub-section-title">Control de Concentrado</h4>
    
    <!-- Add New Concentrado Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addConcentradoForm">
        <i class="fas fa-plus"></i> Agregar Concentrado
    </button>
    
    <div class="collapse mb-3" id="addConcentradoForm">
        <div class="card card-body">
            <form id="concentradoForm" action="process_concentrado.php" method="POST">
                <?php
                // Ensure tagid is set from either GET or SESSION
                $tagid = '';
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $tagid = htmlspecialchars($_GET['search']);
                } elseif (isset($_SESSION['current_tagid']) && !empty($_SESSION['current_tagid'])) {
                    $tagid = htmlspecialchars($_SESSION['current_tagid']);
                }
                ?>
                <input type="hidden" name="tagid" value="<?php echo $tagid; ?>">
                
                <!-- Debug output to verify tagid -->
                <?php if (empty($tagid)): ?>
                    <div class="alert alert-warning">
                        No se ha seleccionado ningún animal. Por favor, busque un animal primero.
                    </div>
                <?php endif; ?>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Etapa</label>
                        <input type="text" class="form-control" name="etapa" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ración (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="racion" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo ($/kg)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success" <?php echo empty($tagid) ? 'disabled' : ''; ?>>
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="concentradoTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Etapa</th>
                    <th>Producto</th>
                    <th>Ración (kg)</th>
                    <th>Costo ($/kg)</th>
                    <th>Valor Total ($)</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_valor_concentrado = 0;
                if ($result_concentrado->num_rows > 0) {
                    while($row = $result_concentrado->fetch_assoc()) {
                        $valor_total = floatval($row['vh_concentrado_racion']) * floatval($row['vh_concentrado_costo']);
                        $total_valor_concentrado += $valor_total;
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_concentrado_etapa']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_concentrado_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_concentrado_racion']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_concentrado_costo']) . "</td>";
                        echo "<td>" . number_format($valor_total, 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_concentrado_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-concentrado' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td colspan="4"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_valor_concentrado, 2); ?></strong></td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<!-- Add this JavaScript for Concentrado table -->
<script>
$(document).ready(function() {
    $('.delete-concentrado').click(function(e) {
        e.preventDefault();
        console.log('Delete Concentrado button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_concentrado.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>
<!-- Concentrado Table Section -->
<?php
// Build the base query for Sal
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_concentrado = "SELECT * FROM vh_concentrado WHERE vh_concentrado_tagid = '$tagid'";
} else {
    $baseQuery_concentrado = "SELECT * FROM vh_concentrado";
}
$result_concentrado = $conn->query($baseQuery_concentrado);
?>



<!-- Modified JavaScript for concentrado table -->
<script>
$(document).ready(function() {
    // Initialize DataTable
    var concentradoTable = $('#concentradoTable').DataTable({
        pageLength: 10,
        dom: 'rt<"bottom"ip>',
        language: {
            paginate: {
                previous: '‹',
                next: '›'
            }
        },
        order: [[5, 'desc']], // Order by date column descending
        initComplete: function() {
            // Link custom filter input
            $('#concentradoTableFilter').keyup(function() {
                concentradoTable.search($(this).val()).draw();
            });

            // Link custom length select
            $('#concentradoEntriesLength').change(function() {
                concentradoTable.page.len($(this).val()).draw();
            });
        }
    });

});
</script>
<div style="max-width: 1300px; margin: 40px auto;">
<h3 style="text-align: center;">Inversion Acumulada Alimento Concentrado</h3>
<canvas id="concentrado-acumulado-mensual"></canvas>
</div>


<!-- Melaza Table Section -->
<?php
// Build the base query for Melaza
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_melaza = "SELECT * FROM vh_melaza WHERE vh_melaza_tagid = '$tagid'";
} else {
    $baseQuery_melaza = "SELECT * FROM vh_melaza";
}
$result_melaza = $conn->query($baseQuery_melaza);
?>

<!-- Melaza Table -->

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Control de Melaza</h4>
    
<!-- Add New Melaza Form -->
<button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addMelazaForm">
    <i class="fas fa-plus"></i> Agregar Melaza
</button>

<div class="collapse mb-3" id="addMelazaForm">
    <div class="card card-body">
        <form id="melazaForm" action="process_melaza.php" method="POST">
            <?php
            // Ensure tagid is set from either GET or SESSION
            $tagid = '';
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $tagid = htmlspecialchars($_GET['search']);
            } elseif (isset($_SESSION['current_tagid']) && !empty($_SESSION['current_tagid'])) {
                $tagid = htmlspecialchars($_SESSION['current_tagid']);
            }
            ?>
            <input type="hidden" name="tagid" value="<?php echo $tagid; ?>">
            
            <!-- Debug output to verify tagid -->
            <?php if (empty($tagid)): ?>
                <div class="alert alert-warning">
                    No se ha seleccionado ningún animal. Por favor, busque un animal primero.
                </div>
            <?php endif; ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Etapa</label>
                    <input type="text" class="form-control" name="etapa" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ración (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="racion" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($/kg)</label>
                    <input type="number" step="0.01" class="form-control" name="costo" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success" <?php echo empty($tagid) ? 'disabled' : ''; ?>>
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>    
    <!-- Table Controls -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <label class="me-2">Show entries:</label>
                <select class="form-select form-select-sm w-auto" id="melazaEntriesLength">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <input type="search" class="form-control form-control-sm w-auto" 
                       placeholder="Filter results..." id="melazaTableFilter">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="melazaTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Etapa</th>
                    <th>Producto</th>
                    <th>Ración (kg)</th>
                    <th>Costo ($/kg)</th>
                    <th>Total ($)</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_melaza = 0;
                if ($result_melaza->num_rows > 0) {
                    while($row = $result_melaza->fetch_assoc()) {
                        $total = floatval($row['vh_melaza_racion']) * floatval($row['vh_melaza_costo']);
                        $total_costo_melaza += $total;
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_melaza_etapa']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_melaza_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_melaza_racion']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_melaza_costo']) . "</td>";
                        echo "<td>" . number_format($total, 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_melaza_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-melaza' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td colspan="4"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_melaza, 2); ?></strong></td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
</div>
</div>
        
<!-- Modified JavaScript for Melaza table -->
<script>
$(document).ready(function() {
    // Initialize DataTable
    var melazaTable = $('#melazaTable').DataTable({
        pageLength: 10,
        dom: 'rt<"bottom"ip>',
        language: {
            paginate: {
                previous: '‹',
                next: '›'
            }
        },
        order: [[5, 'desc']], // Order by date column descending
        initComplete: function() {
            // Link custom filter input
            $('#melazaTableFilter').keyup(function() {
                melazaTable.search($(this).val()).draw();
            });

            // Link custom length select
            $('#melazaEntriesLength').change(function() {
                melazaTable.page.len($(this).val()).draw();
            });
        }
    });

    // Existing delete functionality
    $('.delete-melaza').click(function(e) {
        e.preventDefault();
        console.log('Delete Melaza button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_melaza.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>


<div style="max-width: 1300px; margin: 40px auto;">
<h3 style="text-align: center;">Inversion Acumulada Melaza</h3>
<canvas id="melaza-acumulado-mensual"></canvas>
</div>

<!-- Sal Table Section -->
<?php
// Build the base query for Sal
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_sal = "SELECT * FROM vh_sal WHERE vh_sal_tagid = '$tagid'";
} else {
    $baseQuery_sal = "SELECT * FROM vh_sal";
}
$result_sal = $conn->query($baseQuery_sal);
?>

<!-- Sal Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Control de Sal</h4>
    
    <!-- Add New Sal Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addSalForm">
        <i class="fas fa-plus"></i> Agregar Sal
    </button>
    <div class="collapse mb-3" id="addSalForm">
    <div class="card card-body">
        <form id="salForm" action="process_sal.php" method="POST">
            <?php
            // Ensure tagid is set from either GET or SESSION
            $tagid = '';
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $tagid = htmlspecialchars($_GET['search']);
            } elseif (isset($_SESSION['current_tagid']) && !empty($_SESSION['current_tagid'])) {
                $tagid = htmlspecialchars($_SESSION['current_tagid']);
            }
            ?>
            <input type="hidden" name="tagid" value="<?php echo $tagid; ?>">
            
            <!-- Debug output to verify tagid -->
            <?php if (empty($tagid)): ?>
                <div class="alert alert-warning">
                    No se ha seleccionado ningún animal. Por favor, busque un animal primero.
                </div>
            <?php endif; ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Etapa</label>
                    <input type="text" class="form-control" name="etapa" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ración (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="racion" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($/kg)</label>
                    <input type="number" step="0.01" class="form-control" name="costo" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success" <?php echo empty($tagid) ? 'disabled' : ''; ?>>
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- Table Controls -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <label class="me-2">Show entries:</label>
                <select class="form-select form-select-sm w-auto" id="salEntriesLength">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <input type="search" class="form-control form-control-sm w-auto" 
                       placeholder="Filter results..." id="salTableFilter">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="salTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Etapa</th>
                    <th>Producto</th>
                    <th>Ración (kg)</th>
                    <th>Costo ($/kg)</th>
                    <th>Total ($)</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_sal = 0;
                if ($result_sal->num_rows > 0) {
                    while($row = $result_sal->fetch_assoc()) {
                        $total = floatval($row['vh_sal_racion']) * floatval($row['vh_sal_costo']);
                        $total_costo_sal += $total;
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_sal_etapa']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_sal_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_sal_racion']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_sal_costo']) . "</td>";
                        echo "<td>" . number_format($total, 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_sal_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-sal' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td colspan="4"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_sal, 2); ?></strong></td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modified JavaScript for Sal table -->
<script>
$(document).ready(function() {
    // Initialize DataTable
    var salTable = $('#salTable').DataTable({
        pageLength: 10,
        dom: 'rt<"bottom"ip>',
        language: {
            paginate: {
                previous: '‹',
                next: '›'
            }
        },
        order: [[5, 'desc']], // Order by date column descending
        initComplete: function() {
            // Link custom filter input
            $('#salTableFilter').keyup(function() {
                salTable.search($(this).val()).draw();
            });

            // Link custom length select
            $('#salEntriesLength').change(function() {
                salTable.page.len($(this).val()).draw();
            });
        }
    });

    // Existing delete functionality
    $('.delete-sal').click(function(e) {
        e.preventDefault();
        console.log('Delete Sal button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_sal.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Inversion Acumulada Sal Mineral</h3>
    <canvas id="sal-acumulado-mensual"></canvas>
</div>
<div style="max-width: 800px; margin: 40px auto;">
    <h3 style="text-align: center;">Distribución de Inversión en Alimentación</h3>
    <canvas id="investment-distribution-pie"></canvas>
</div>
<!-- SALUD AFTOSA Table -->

<?php
// Build the base query
if (isset($_GET['search']) && !empty($_GET['search'])) {
$tagid = $conn->real_escape_string($_GET['search']);
$baseQuery_vacuna = "SELECT * FROM vh_aftosa WHERE vh_aftosa_tagid = '$tagid'";
} else {
$baseQuery_vacuna = "SELECT * FROM vh_aftosa";
}
$result_vacuna = $conn->query($baseQuery_vacuna);
?>
<div class="container" style="display:block; justify-content: center; align-items: center;">
<div class="table-section">
<h3 class="section-title">REGISTROS DE SALUD</h3>

<!-- Mobile version -->
<div class="mobile-table">
    <!-- Vacunas Table -->
    <div class="mb-4">
        <h4 class="sub-section-title">Vacunas Aftosa</h4>
        
        <!-- Add New Vacuna Form -->
        <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addVacunaForm">
            <i class="fas fa-plus"></i> Agregar Vacuna
        </button>
        
        <div class="collapse mb-3" id="addVacunaForm">
            <div class="card card-body">
                <form id="vacunaForm" action="./process_aftosa.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Producto</label>
                            <input type="text" class="form-control" name="producto" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Costo por Dosis ($)</label>
                            <input type="number" step="0.01" class="form-control" name="costo" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Dosis</label>
                            <input type="number" step="0.01" class="form-control" name="dosis" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Vacunas Table -->
        <div class="table-responsive">
            <table id="vacunasTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Vacuna Nombre</th>
                        <th>Costo ($/dosis)</th>
                        <th>Dosis</th>
                        <th>Fecha Vacunacion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_costo = 0; // Initialize total cost
                    if ($result_vacuna->num_rows > 0) {
                        $result_vacuna->data_seek(0);
                        while($row = $result_vacuna->fetch_assoc()) {
                            // Add to total
                            $total_costo += floatval($row['vh_aftosa_costo']) * floatval($row['vh_aftosa_dosis']);
                            
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['vh_aftosa_producto']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['vh_aftosa_costo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['vh_aftosa_dosis']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['vh_aftosa_fecha']) . "</td>";
                            echo "<td>
                                    <button class='btn btn-danger btn-sm delete-aftosa' 
                                            data-id='" . $row['id'] . "' 
                                            onclick='console.log(\"Delete button clicked for ID: " . $row['id'] . "\")'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="table-info">
                        <td><strong>Total</strong></td>
                        <td><strong>$<?php echo number_format($total_costo, 2); ?></strong></td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<script>
$(document).ready(function() {
    // Handle delete button clicks
    $('.delete-aftosa').click(function(e) {
        e.preventDefault();
        console.log('Delete button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_aftosa.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            // Refresh the current page
                            window.location.reload(true); // true forces a reload from server, not cache
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script> 

<!-- IBR Table Section -->
<?php
// Build the base query for IBR
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_ibr = "SELECT * FROM vh_ibr WHERE vh_ibr_tagid = '$tagid'";
} else {
    $baseQuery_ibr = "SELECT * FROM vh_ibr";
}
$result_ibr = $conn->query($baseQuery_ibr);
?>

<!-- IBR Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Vacunas IBR</h4>
    
    <!-- Add New IBR Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addIbrForm">
        <i class="fas fa-plus"></i> Agregar Vacuna IBR
    </button>
    
    <div class="collapse mb-3" id="addIbrForm">
        <div class="card card-body">
            <form id="ibrForm" action="process_ibr.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Costo por Dosis ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="ibrTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Vacuna Nombre</th>
                    <th>Costo ($/dosis)</th>
                    <th>Dosis</th>
                    <th>Fecha Vacunacion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_ibr = 0; // Initialize total cost
                if ($result_ibr->num_rows > 0) {
                    while($row = $result_ibr->fetch_assoc()) {
                        // Add to total
                        $total_costo_ibr += floatval($row['vh_ibr_costo']) * floatval($row['vh_ibr_dosis']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_ibr_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_ibr_costo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_ibr_dosis']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_ibr_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-ibr' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_ibr, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Add this JavaScript for IBR table -->
<script>
$(document).ready(function() {
    $('.delete-ibr').click(function(e) {
        e.preventDefault();
        console.log('Delete IBR button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_ibr.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>
<!-- CBR Table Section -->
<?php
// Build the base query for CBR
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_cbr = "SELECT * FROM vh_cbr WHERE vh_cbr_tagid = '$tagid'";
} else {
    $baseQuery_cbr = "SELECT * FROM vh_cbr";
}
$result_cbr = $conn->query($baseQuery_cbr);
?>

<!-- CBR Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Vacunas CBR</h4>
    
    <!-- Add New CBR Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addCbrForm">
        <i class="fas fa-plus"></i> Agregar Vacuna CBR
    </button>
    
    <div class="collapse mb-3" id="addCbrForm">
        <div class="card card-body">
            <form id="cbrForm" action="process_cbr.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Costo por Dosis ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="cbrTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Vacuna Nombre</th>
                    <th>Costo ($/dosis)</th>
                    <th>Dosis</th>
                    <th>Fecha Vacunacion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_cbr = 0;
                if ($result_cbr && $result_cbr->num_rows > 0) {
                    while($row = $result_cbr->fetch_assoc()) {
                        $total_costo_cbr += floatval($row['vh_cbr_costo']) * floatval($row['vh_cbr_dosis']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_cbr_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_cbr_costo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_cbr_dosis']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_cbr_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-cbr' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_cbr, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Add this JavaScript for CBR table -->
<script>
$(document).ready(function() {
    $('.delete-cbr').click(function(e) {
        e.preventDefault();
        console.log('Delete CBR button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_cbr.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>
<!-- Brucelosis Table Section -->
<?php
// Build the base query for Brucelosis
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_brucelosis = "SELECT * FROM vh_brucelosis WHERE vh_brucelosis_tagid = '$tagid'";
} else {
    $baseQuery_brucelosis = "SELECT * FROM vh_brucelosis";
}
$result_brucelosis = $conn->query($baseQuery_brucelosis);
?>

<!-- Brucelosis Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Vacunas Brucelosis</h4>
    
    <!-- Add New Brucelosis Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addBrucelosisForm">
        <i class="fas fa-plus"></i> Agregar Vacuna Brucelosis
    </button>
    
    <div class="collapse mb-3" id="addBrucelosisForm">
        <div class="card card-body">
            <form id="brucelosisForm" action="process_brucelosis.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Costo por Dosis ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="brucelosisTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Vacuna Nombre</th>
                    <th>Costo ($/dosis)</th>
                    <th>Dosis</th>
                    <th>Fecha Vacunacion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_brucelosis = 0;
                if ($result_brucelosis && $result_brucelosis->num_rows > 0) {
                    while($row = $result_brucelosis->fetch_assoc()) {
                        $total_costo_brucelosis += floatval($row['vh_brucelosis_costo']) * floatval($row['vh_brucelosis_dosis']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_brucelosis_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_brucelosis_costo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_brucelosis_dosis']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_brucelosis_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-brucelosis' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_brucelosis, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Add this JavaScript for Brucelosis table -->
<script>
$(document).ready(function() {
    $('.delete-brucelosis').click(function(e) {
        e.preventDefault();
        console.log('Delete Brucelosis button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_brucelosis.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>
<!-- Carbunco Table Section -->
<?php
// Build the base query for Carbunco
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_carbunco = "SELECT * FROM vh_carbunco WHERE vh_carbunco_tagid = '$tagid'";
} else {
    $baseQuery_carbunco = "SELECT * FROM vh_carbunco";
}
$result_carbunco = $conn->query($baseQuery_carbunco);
?>

<!-- Carbunco Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Vacunas Carbunco</h4>
    
    <!-- Add New Carbunco Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addCarbuncoForm">
        <i class="fas fa-plus"></i> Agregar Vacuna Carbunco
    </button>
    
    <div class="collapse mb-3" id="addCarbuncoForm">
        <div class="card card-body">
            <form id="carbuncoForm" action="process_carbunco.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Costo por Dosis ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="carbuncoTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Vacuna Nombre</th>
                    <th>Costo ($/dosis)</th>
                    <th>Dosis</th>
                    <th>Fecha Vacunacion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_carbunco = 0; // Initialize total cost
                if ($result_carbunco->num_rows > 0) {
                    while($row = $result_carbunco->fetch_assoc()) {
                        // Add to total
                        $total_costo_carbunco += floatval($row['vh_carbunco_costo']) * floatval($row['vh_carbunco_dosis']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_carbunco_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_carbunco_costo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_carbunco_dosis']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_carbunco_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-carbunco' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_carbunco, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Add this JavaScript for Carbunco table -->
<script>
$(document).ready(function() {
    $('.delete-carbunco').click(function(e) {
        e.preventDefault();
        console.log('Delete Carbunco button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_carbunco.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- garrapatas Table Section -->
<?php
// Build the base query for garrapatas
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_garrapatas = "SELECT * FROM vh_garrapatas WHERE vh_garrapatas_tagid = '$tagid'";
} else {
    $baseQuery_garrapatas = "SELECT * FROM vh_garrapatas";
}
$result_garrapatas = $conn->query($baseQuery_garrapatas);
?>

<!-- garrapatas Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Tratamiento Garrapatas</h4>
    
    <!-- Add New garrapatas Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addgarrapatasForm">
        <i class="fas fa-plus"></i> Agregar Tratamiento garrapatas
    </button>
    
    <div class="collapse mb-3" id="addgarrapatasForm">
        <div class="card card-body">
            <form id="garrapatasForm" action="process_garrapatas.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Costo por Dosis ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="garrapatasTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Producto Nombre</th>
                    <th>Costo ($/dosis)</th>
                    <th>Dosis</th>
                    <th>Fecha Tratamiento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_garrapatas = 0; // Initialize total cost
                if ($result_garrapatas->num_rows > 0) {
                    while($row = $result_garrapatas->fetch_assoc()) {
                        // Add to total
                        $total_costo_garrapatas += floatval($row['vh_garrapatas_costo']) * floatval($row['vh_garrapatas_dosis']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_garrapatas_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_garrapatas_costo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_garrapatas_dosis']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_garrapatas_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-garrapatas' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_garrapatas, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Add this JavaScript for garrapatas table -->
<script>
$(document).ready(function() {
    $('.delete-garrapatas').click(function(e) {
        e.preventDefault();
        console.log('Delete garrapatas button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_garrapatas.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- Mastitis Table Section -->
<?php
// Build the base query for Mastitis
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_mastitis = "SELECT * FROM vh_mastitis WHERE vh_mastitis_tagid = '$tagid'";
} else {
    $baseQuery_mastitis = "SELECT * FROM vh_mastitis";
}
$result_mastitis = $conn->query($baseQuery_mastitis);
?>

<!-- Mastitis Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Tratamiento Mastitis</h4>
    
    <!-- Add New Mastitis Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addMastitisForm">
        <i class="fas fa-plus"></i> Agregar Tratamiento Mastitis
    </button>
    
    <div class="collapse mb-3" id="addMastitisForm">
        <div class="card card-body">
            <form id="mastitisForm" action="process_mastitis.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Costo por Dosis ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="mastitisTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Producto Nombre</th>
                    <th>Costo ($/dosis)</th>
                    <th>Dosis</th>
                    <th>Fecha Tratamiento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_mastitis = 0; // Initialize total cost
                if ($result_mastitis->num_rows > 0) {
                    while($row = $result_mastitis->fetch_assoc()) {
                        // Add to total
                        $total_costo_mastitis += floatval($row['vh_mastitis_costo']) * floatval($row['vh_mastitis_dosis']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_mastitis_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_mastitis_costo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_mastitis_dosis']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_mastitis_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-mastitis' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_mastitis, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Add this JavaScript for Mastitis table -->
<script>
$(document).ready(function() {
    $('.delete-mastitis').click(function(e) {
        e.preventDefault();
        console.log('Delete Mastitis button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_mastitis.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- Lombrices Table Section -->
<?php
// Build the base query for Lombrices
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_lombrices = "SELECT * FROM vh_lombrices WHERE vh_lombrices_tagid = '$tagid'";
} else {
    $baseQuery_lombrices = "SELECT * FROM vh_lombrices";
}
$result_lombrices = $conn->query($baseQuery_lombrices);
?>

<!-- Lombrices Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Tratamiento Lombrices</h4>
    
    <!-- Add New Lombrices Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addLombricesForm">
        <i class="fas fa-plus"></i> Agregar Tratamiento Lombrices
    </button>
    
    <div class="collapse mb-3" id="addLombricesForm">
        <div class="card card-body">
            <form id="lombricesForm" action="process_lombrices.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Costo por Dosis ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="lombricesTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Producto Nombre</th>
                    <th>Costo ($/dosis)</th>
                    <th>Dosis</th>
                    <th>Fecha Tratamiento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_lombrices = 0; // Initialize total cost
                if ($result_lombrices->num_rows > 0) {
                    while($row = $result_lombrices->fetch_assoc()) {
                        // Add to total
                        $total_costo_lombrices += floatval($row['vh_lombrices_costo']) * floatval($row['vh_lombrices_dosis']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_lombrices_producto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_lombrices_costo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_lombrices_dosis']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_lombrices_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-lombrices' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_lombrices, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Add this JavaScript for Lombrices table -->
<script>
$(document).ready(function() {
    $('.delete-lombrices').click(function(e) {
        e.preventDefault();
        console.log('Delete Lombrices button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_lombrices.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- Caulculo Estructura de Costos -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    
<!-- Inicializacion de tablas -->
    <script>
        $(document).ready(function() {
            // Initialize all tables with responsive feature
            $('#pesoTable, #lecheTable, #alimentacionTable, #saludTable, #reproduccionTable, #prenezTable, #partoTable').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "Filter results:"
                }
            });
            
            if (!$.fn.DataTable.isDataTable('#pesoTable')) {
                $('#pesoTable').DataTable({
                    responsive: true,
                    pageLength: 10,
                    autoWidth: false,
                    scrollX: false,
                    columnDefs: [
                        {
                            targets: '_all',
                            className: 'dt-head-center dt-body-center',
                            width: '33.33%'
                        }
                    ]
                });
            }
        });
    </script>    
<!-- Peso: Promedio Mensual -->
<script>
    const ctx = document.getElementById('pesoLineChart').getContext('2d');
    const pesoLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($pesoFechaLabels); ?>,
            datasets: [
                {
                    label: 'Peso Mensual (Kg)',
                    data: <?php echo json_encode($monthlyData); ?>,
                    borderColor: 'rgba(132, 199, 110, 1)',
                    backgroundColor: 'rgba(132, 199, 110, 0.2)',
                    borderWidth: 2,
                    fill: true,
                },
                {
                    label: 'Tendencia Lineal (Kg)',
                    data: <?php echo json_encode($regressionLine); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false,
                    pointRadius: 0, // No points on regression line
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Peso (Kg)'
                    }
                }
            }
        }
    });
</script>
<!-- Peso: Precio Promedio Mensual -->
<script>
    const ctxPrecio = document.getElementById('precioLineChart').getContext('2d');
    const precioLineChart = new Chart(ctxPrecio, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($pesoFechaLabels); ?>,
            datasets: [{
                label: 'Precio Promedio Mensual ($/Kg)',
                data: <?php echo json_encode($monthlyPriceData); ?>,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Precio ($/Kg)'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS'
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
<!-- Peso: Valor en Pie Promedio Mensual -->
<script>
    const ctxValor = document.getElementById('valorLineChart').getContext('2d');
    const valorLineChart = new Chart(ctxValor, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($pesoFechaLabels); ?>,
            datasets: [{
                label: 'Valor Promedio Mensual ($)',
                data: <?php echo json_encode($monthlyValueData); ?>,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Valor Total ($)'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS',
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
<!-- Leche: Promedio Mensual -->
<script>
    const ctxLeche = document.getElementById('lecheLineChart').getContext('2d');
    const lecheLineChart = new Chart(ctxLeche, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($lecheFechaLabels); ?>,
            datasets: [{
                label: 'Producción Mensual Anualizada (Kg/año)',
                data: <?php echo json_encode($annualizedMilkData); ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Producción Anualizada (Kg/año)'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('es-AR', {
                                    minimumFractionDigits: 1,
                                    maximumFractionDigits: 1
                                }).format(context.parsed.y) + ' Kg/año';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>

<!-- Leche: Produccion Acumulada Mensual -->
<script>
    const ctxLecheCumulative = document.getElementById('lecheCumulativeChart').getContext('2d');
    const lecheCumulativeChart = new Chart(ctxLecheCumulative, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($lecheFechaLabels); ?>,
            datasets: [{
                label: 'Producción Acumulada (Kg)',
                data: <?php echo json_encode($cumulativeMilkData); ?>,
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Producción Total (Kg)'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('es-AR', {
                                    minimumFractionDigits: 1,
                                    maximumFractionDigits: 1
                                }).format(context.parsed.y) + ' Kg';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
<!-- Concentrado: Inversion Acumulada Mensual -->
<script>
    const ctxRacion = document.getElementById('concentrado-acumulado-mensual').getContext('2d');
    const concentradoAcumuladoMensual = new Chart(ctxRacion, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($racionFechaLabels); ?>,
            datasets: [{
                label: 'Inversión Acumulada en Alimentación ($)',
                data: <?php echo json_encode($cumulativeInvestment); ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Inversión Total ($)'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS',
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
<!-- Melaza: Inversion Acumulada Mensual -->
<script>
    const ctxMelaza = document.getElementById('melaza-acumulado-mensual').getContext('2d');
    const melazaAcumuladoMensual = new Chart(ctxMelaza, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($melazaFechaLabels); ?>,
            datasets: [{
                label: 'Inversión Acumulada en Melaza ($)',
                data: <?php echo json_encode($cumulativeMelazaInvestment); ?>,
                borderColor: 'rgba(255, 159, 64, 1)',
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Inversión Total ($)'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS',
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
<!-- Sal: Inversion Acumulada Mensual -->
<script>
    const ctxSal = document.getElementById('sal-acumulado-mensual').getContext('2d');
    const salAcumuladoMensual = new Chart(ctxSal, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($salFechaLabels); ?>,
            datasets: [{
                label: 'Inversión Acumulada en Sal Mineral ($)',
                data: <?php echo json_encode($cumulativeSalInvestment); ?>,
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Inversión Total ($)'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS',
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
<!-- Total Feeding Investment Pie Chart-->
<script>
    const ctxPie = document.getElementById('investment-distribution-pie').getContext('2d');
    const investmentDistributionPie = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: [
                'Sal Mineral (' + <?php echo $salPercentage; ?> + '%)',
                'Melaza (' + <?php echo $melazaPercentage; ?> + '%)',
                'Concentrado (' + <?php echo $concentradoPercentage; ?> + '%)'
            ],
            datasets: [{
                data: [
                    <?php echo $totalSalInvestment; ?>,
                    <?php echo $totalMelazaInvestment; ?>,
                    <?php echo $totalConcentradoInvestment; ?>
                ],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.8)',  // Purple for Sal
                    'rgba(255, 159, 64, 0.8)',   // Orange for Melaza
                    'rgba(75, 192, 192, 0.8)'    // Teal for Concentrado
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label = label.split('(')[0].trim(); // Remove percentage from tooltip
                            }
                            
                            let value = context.raw;
                            let percentage = ((value / <?php echo $totalInvestment; ?>) * 100).toFixed(1);
                            
                            return label + ': ' + new Intl.NumberFormat('es-AR', {
                                style: 'currency',
                                currency: 'ARS',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(value) + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
</script> 

<div class="container table-section" style="display:block; justify-content: center; align-items: center;">
<h3 class="section-title">REGISTROS DE REPRODUCCION</h3>

<!-- Inseminacion Table Section -->
<?php
// Build the base query for Inseminacion
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_inseminacion = "SELECT * FROM vh_inseminacion WHERE vh_inseminacion_tagid = '$tagid'";
} else {
    $baseQuery_inseminacion = "SELECT * FROM vh_inseminacion";
}
$result_inseminacion = $conn->query($baseQuery_inseminacion);
?>

<!-- Inseminacion Table -->
<div class="mb-4">
    <h4 class="sub-section-title">Inseminación</h4>
    
    <!-- Add New Inseminacion Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addInseminacionForm">
        <i class="fas fa-plus"></i> Agregar Inseminación
    </button>
    
    <div class="collapse mb-3" id="addInseminacionForm">
        <div class="card card-body">
            <form id="inseminacionForm" action="./process_inseminacion.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Numero</label>
                        <input type="text" class="form-control" name="numero" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Costo por Dosis ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="inseminacionTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Costo ($/dosis)</th>
                    <th>Fecha Inseminación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_inseminacion = 0; // Initialize total cost
                if ($result_inseminacion->num_rows > 0) {
                    while($row = $result_inseminacion->fetch_assoc()) {
                        // Add to total
                        $total_costo_inseminacion += floatval($row['vh_inseminacion_costo']) * floatval($row['vh_inseminacion_costo']);
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_inseminacion_numero']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_inseminacion_costo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_inseminacion_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-inseminacion' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_costo_inseminacion, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>

<!-- Add this JavaScript for Inseminacion table -->
<script>
$(document).ready(function() {
    $('.delete-inseminacion').click(function(e) {
        e.preventDefault();
        console.log('Delete Inseminacion button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_inseminacion.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- Gestacion Table Section -->
<?php
// Build the base query for Gestacion
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_gestacion = "SELECT * FROM vh_gestacion WHERE vh_gestacion_tagid = '$tagid'";
} else {
    $baseQuery_gestacion = "SELECT * FROM vh_gestacion";
}
$result_gestacion = $conn->query($baseQuery_gestacion);
?>

<!-- Gestacion Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Gestación</h4>
    
    <!-- Add New Gestacion Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addGestacionForm">
        <i class="fas fa-plus"></i> Agregar Gestación
    </button>
    
    <div class="collapse mb-3" id="addGestacionForm">
        <div class="card card-body">
            <form id="gestacionForm" action="process_gestacion.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Numero</label>
                        <input type="text" class="form-control" name="numero" required>
                    </div>
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>

    <div class="table-responsive">
        <table id="gestacionTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Fecha Gestación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_gestacion = 0; // Initialize total cost
                if ($result_gestacion->num_rows > 0) {
                    while($row = $result_gestacion->fetch_assoc()) {
                        // Add to total                       
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_gestacion_numero']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_gestacion_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-gestacion' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>  

<!-- Add this JavaScript for Gestacion table -->
<script>
$(document).ready(function() {
    $('.delete-gestacion').click(function(e) {
        e.preventDefault();
        console.log('Delete Gestacion button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_gestacion.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- Parto Table Section -->
<?php
// Build the base query for Parto
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_parto = "SELECT * FROM vh_parto WHERE vh_parto_tagid = '$tagid'";
} else {
    $baseQuery_parto = "SELECT * FROM vh_parto";
}
$result_parto = $conn->query($baseQuery_parto);
?>

<!-- Parto Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Parto</h4>
    
    <!-- Add New Parto Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addPartoForm">
        <i class="fas fa-plus"></i> Agregar Parto
    </button>
    
    <div class="collapse mb-3" id="addPartoForm">
        <div class="card card-body">
            <form id="partoForm" action="process_parto.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Numero</label>
                        <input type="text" class="form-control" name="numero" required>
                    </div>                    
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="partoTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Fecha Parto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_parto = 0; // Initialize total cost
                if ($result_parto->num_rows > 0) {
                    while($row = $result_parto->fetch_assoc()) {
                        echo "<td>" . htmlspecialchars($row['vh_parto_numero']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_parto_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-parto' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add this JavaScript for Parto table -->
<script>
$(document).ready(function() {
    $('.delete-parto').click(function(e) {
        e.preventDefault();
        console.log('Delete Parto button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_parto.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- Aborto Table Section -->
<?php
// Build the base query for Aborto
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_aborto = "SELECT * FROM vh_aborto WHERE vh_aborto_tagid = '$tagid'";
} else {
    $baseQuery_aborto = "SELECT * FROM vh_aborto";
}
$result_aborto = $conn->query($baseQuery_aborto);
?>

<!-- Aborto Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Aborto</h4>
    
    <!-- Add New Aborto Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addAbortoForm">
        <i class="fas fa-plus"></i> Agregar Aborto
    </button>
    
    <div class="collapse mb-3" id="addAbortoForm">
        <div class="card card-body">
            <form id="abortoForm" action="process_aborto.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Causa</label>
                        <input type="text" class="form-control" name="causa" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="abortoTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Causa</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_aborto->num_rows > 0) {
                    while($row = $result_aborto->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_aborto_causa']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_aborto_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-aborto' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add this JavaScript for Aborto table -->
<script>
$(document).ready(function() {
    $('.delete-aborto').click(function(e) {
        e.preventDefault();
        console.log('Delete Aborto button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_aborto.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>
<div class="container table-section" style="display:block; justify-content: center; align-items: center;">
<h3 class="section-title">OTROS REGISTROS</h3>
<!-- Venta Table Section -->
<?php
// Build the base query for Venta
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_venta = "SELECT * FROM vh_venta WHERE vh_venta_tagid = '$tagid'";
} else {
    $baseQuery_venta = "SELECT * FROM vh_venta";
}
$result_venta = $conn->query($baseQuery_venta);
?>

<!-- Venta Table -->
<div class="mb-4">
    <h4 class="sub-section-title">Venta</h4>
    
    <!-- Add New Venta Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addVentaForm">
        <i class="fas fa-plus"></i> Agregar Venta
    </button>
    
    <div class="collapse mb-3" id="addVentaForm">
        <div class="card card-body">
            <form id="ventaForm" action="process_venta.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Peso (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="peso" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Precio por kg ($)</label>
                        <input type="number" step="0.01" class="form-control" name="precio" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="ventaTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Peso (kg)</th>
                    <th>Precio ($/kg)</th>
                    <th>Total ($)</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_venta = 0;
                if ($result_venta->num_rows > 0) {
                    while($row = $result_venta->fetch_assoc()) {
                        $subtotal = floatval($row['vh_venta_peso']) * floatval($row['vh_venta_precio']);
                        $total_venta += $subtotal;
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_venta_peso']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_venta_precio']) . "</td>";
                        echo "<td>" . number_format($subtotal, 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_venta_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-venta' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td><strong>Total</strong></td>
                    <td></td>
                    <td><strong>$<?php echo number_format($total_venta, 2); ?></strong></td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>

<!-- Add this JavaScript for Venta table -->
<script>
$(document).ready(function() {
    $('.delete-venta').click(function(e) {
        e.preventDefault();
        console.log('Delete Venta button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_venta.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>

<!-- Destete Table Section -->
<?php
// Build the base query for Destete
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_destete = "SELECT * FROM vh_destete WHERE vh_destete_tagid = '$tagid'";
} else {
    $baseQuery_destete = "SELECT * FROM vh_destete";
}
$result_destete = $conn->query($baseQuery_destete);
?>

<!-- Destete Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Destete</h4>
    
    <!-- Add New Destete Form -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addDesteteForm">
        <i class="fas fa-plus"></i> Agregar Destete
    </button>
    
    <div class="collapse mb-3" id="addDesteteForm">
        <div class="card card-body">
            <form id="desteteForm" action="process_destete.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Peso (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="peso" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="desteteTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Peso (kg)</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_destete->num_rows > 0) {
                    while($row = $result_destete->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['vh_destete_peso']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_destete_fecha']) . "</td>";
                        echo "<td>
                                <button class='btn btn-danger btn-sm delete-destete' 
                                        data-id='" . $row['id'] . "'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add this JavaScript for Destete table -->
<script>
$(document).ready(function() {
    $('.delete-destete').click(function(e) {
        e.preventDefault();
        console.log('Delete Destete button clicked');
        
        const id = $(this).data('id');
        console.log('ID to delete:', id);
        
        if (confirm('¿Está seguro de que desea eliminar esta entrada?')) {
            $.ajax({
                url: 'process_destete.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    console.log('Response received:', response);
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        if (result.success) {
                            window.location.reload(true);
                        } else {
                            alert('Error al eliminar la entrada: ' + (result.error || 'Error desconocido'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    alert('Error al procesar la solicitud: ' + error);
                }
            });
        }
    });
});
</script>
<!-- Descarte Table Section -->
<?php
// Build the base query for Descarte with JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_descarte = "SELECT d.id, d.vh_descarte_peso, d.vh_descarte_fecha, v.nombre, v.tagid 
                          FROM vh_descarte d 
                          JOIN vacuno v ON d.vh_descarte_tagid = v.tagid 
                          WHERE v.tagid = '$tagid'";
} else {
    $baseQuery_descarte = "SELECT d.id, d.vh_descarte_peso, d.vh_descarte_fecha, v.nombre, v.tagid 
                          FROM vh_descarte d 
                          JOIN vacuno v ON d.vh_descarte_tagid = v.tagid";
}
$result_descarte = $conn->query($baseQuery_descarte);
?>

<!-- Descarte Table -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="sub-section-title">Descarte</h4>
    
    <!-- Add New Descarte Button -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#descarteModal">
        <i class="fas fa-plus"></i> Agregar Descarte
    </button>
    
    <div class="table-responsive">
        <table id="descarteTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Nombre</th>
                    <th>Peso (kg)</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_descarte && $result_descarte->num_rows > 0) {
                    while($row = $result_descarte->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['tagid']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_descarte_peso']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vh_descarte_fecha']) . "</td>";
                        echo "<td>
                                <div class='btn-group' role='group'>
                                    <button type='button' class='btn btn-primary btn-sm edit-descarte' 
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['tagid']) . "'
                                            data-peso='" . htmlspecialchars($row['vh_descarte_peso']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_descarte_fecha']) . "'
                                            data-bs-toggle='modal' 
                                            data-bs-target='#descarteModal'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button type='button' class='btn btn-danger btn-sm delete-descarte' 
                                            data-id='" . htmlspecialchars($row['id']) . "'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                </div>
                            </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Descarte Modal -->
<div class="modal fade" id="descarteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descarteModalTitle">Agregar Descarte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="descarteForm">
                    <input type="hidden" name="action" value="create">
                    <input type="hidden" name="id" id="descarte_id">
                    <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    
                    <div class="mb-3">
                        <label for="descarte_peso" class="form-label">Peso (kg)</label>
                        <input type="number" step="0.01" class="form-control" id="descarte_peso" name="peso" required>
                    </div>
                    <div class="mb-3">
                        <label for="descarte_fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="descarte_fecha" name="fecha" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveDescarte">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Descarte JavaScript -->
<script>
$(document).ready(function() {
    // Initialize DataTable with Spanish language
    $('#descarteTable').DataTable({
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });

    // Handle modal open for new record
    $('#descarteModal').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const isEdit = button.hasClass('edit-descarte');
        const modal = $(this);
        
        // Reset form
        $('#descarteForm')[0].reset();
        
        if (isEdit) {
            modal.find('.modal-title').text('Editar Descarte');
            modal.find('[name="action"]').val('update');
            modal.find('#descarte_id').val(button.data('id'));
            modal.find('#descarte_peso').val(button.data('peso'));
            modal.find('#descarte_fecha').val(button.data('fecha'));
        } else {
            modal.find('.modal-title').text('Agregar Descarte');
            modal.find('[name="action"]').val('create');
            modal.find('#descarte_id').val('');
        }
    });

    // Handle save
    $('#saveDescarte').click(function() {
        const form = $('#descarteForm');
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Log form data
        console.log('Form data:', form.serialize());

        $.ajax({
            url: 'process_descarte.php',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            beforeSend: function() {
                console.log('Sending request...');
            },
            success: function(response) {
                console.log('Response received:', response);
                if (response && response.success) {
                    location.reload();
                } else {
                    console.error('Error details:', response);
                    alert('Error: ' + (response.error || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('Full error details:', {
                    status: status,
                    error: error,
                    response: xhr.responseText,
                    statusCode: xhr.status
                });
                alert('Error processing request. Check console for details.');
            }
        });
    });

    // Handle delete
    $('.delete-descarte').click(function() {
        if (confirm('¿Está seguro de que desea eliminar este registro?')) {
            const id = $(this).data('id');
            
            // Log delete request
            console.log('Deleting record:', id);

            $.ajax({
                url: 'process_descarte.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                dataType: 'json',
                beforeSend: function() {
                    console.log('Sending delete request...');
                },
                success: function(response) {
                    console.log('Delete response:', response);
                    if (response && response.success) {
                        location.reload();
                    } else {
                        console.error('Delete error:', response);
                        alert('Error: ' + (response.error || 'Unknown error'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Delete request failed:', {
                        status: status,
                        error: error,
                        response: xhr.responseText,
                        statusCode: xhr.status
                    });
                    alert('Error processing delete request. Check console for details.');
                }
            });
        }
    });
});
</script>

<!-- Calculate monthly cumulative revenue from milk production -->
<?php
// Calculate monthly cumulative revenue from milk production
$lecheRevenueData = [];
$lecheFechaLabels = [];
$monthlyRevenue = [];
$cumulativeRevenueData = [];

if ($result_leche && $result_leche->num_rows > 0) {
    // Reset pointer to start of result set if needed
    $result_leche->data_seek(0);
    
    // First, collect all revenue by month
    $monthlyData = [];
    while ($row = $result_leche->fetch_assoc()) {
        $date = new DateTime($row['vh_leche_fecha']);
        $monthKey = $date->format('Y-m');
        
        if (!isset($monthlyData[$monthKey])) {
            $monthlyData[$monthKey] = [
                'revenue' => 0,
                'date' => $date->format('Y-m-d')
            ];
        }
        
        // Calculate monthly production from sampling (peso * 365/12)
        $monthlyProduction = floatval($row['vh_leche_peso']) * (365/12);
        
        // Calculate revenue for this entry (monthly production * precio)
        $revenue = $monthlyProduction * floatval($row['vh_leche_precio']);
        $monthlyData[$monthKey]['revenue'] += $revenue;
    }
    
    // Sort by month
    ksort($monthlyData);
    
    // Calculate cumulative sum
    $cumulativeSum = 0;
    foreach ($monthlyData as $monthKey => $data) {
        $cumulativeSum += $data['revenue'];
        $lecheFechaLabels[] = $data['date'];
        $cumulativeRevenueData[] = $cumulativeSum;
    }
}
?>
<script>
        // Initialize all tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover',
                    animation: true,
                    delay: {
                        show: 100,
                        hide: 100
                    },
                    template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                })
            })
        });
    </script>


<?php
$conn->close();
?>
