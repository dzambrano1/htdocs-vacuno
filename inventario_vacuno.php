<?php


require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


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
<link rel="icon" href="images/Ganagram_icono.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!--Bootstrap 5 Css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Custom css -->
<link rel="stylesheet" href="./vacuno.css">

<!-- Include Chart.js and Chart.js DataLabels Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<!-- Add these in the <head> section, after your existing CSS/JS links -->

<!-- Place these in the <head> section in this exact order -->

<!-- jQuery Core (main library) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- DataTables Buttons JS -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Add these in the <head> section, after your existing DataTables CSS/JS -->
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- DataTables Buttons JS -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

</head>
<body>
<!-- Icon Navigation Buttons -->
<div class="container" id="nav-buttons">
    <div class="container nav-icons-container" id="nav-buttons">
        <button onclick="window.location.href='../inicio.php'" class="icon-button" data-tooltip="Inicio">
            <img src="./images/Ganagram_New_Logo-png.png" alt="Inicio" class="nav-icon">
        </button>
        
        <button onclick="window.location.href='./vacuno_historial.php'" class="icon-button" data-tooltip="Registrar Ganado">
            <img src="./images/registros.png" alt="Inicio" class="nav-icon">
        </button>
        
        <button onclick="window.location.href='./vacuno_indices.php'" class="icon-button" data-tooltip="Indices Vacunos">
            <img src="./images/fondo-indexado.png" alt="Inicio" class="nav-icon">
        </button>
        
        <button onclick="window.location.href='./vacuno_configuracion.php'" class="icon-button" data-tooltip="Configurar Tablas">
            <img src="./images/configuracion.png" alt="Inicio" class="nav-icon">
        </button>
    </div>
</div>

<!-- Scroll Icons Container -->
<div class="container scroll-icons-container">
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-inventario-poblacion-vacuno" data-tooltip="Poblacion">
        <img src="./images/vaca.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-inventario-produccion-vacuno" data-tooltip="Produccion">
        <img src="./images/Bascula.png" alt="Produccion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-inventario-alimentacion-vacuno" data-tooltip="Alimentacion">
        <img src="./images/bolso.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-inventario-salud-vacuno" data-tooltip="Salud">
        <img src="./images/vacunacion.png" alt="Salud" class="nav-icon">
    </button>
       
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-inventario-reproduccion-vacuno" data-tooltip="Reproducion">
        <img src="./images/matriz.png" alt="Razas" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-inventario-otros-vacuno" data-tooltip="Otros">
        <img src="./images/compra.png" alt="Razas" class="nav-icon">
    </button>
</div>
<!-- Poblacion Vacuno -->

<div class="container mt-3 mb-4 text-center">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newEntryModal">
        <i class="fas fa-plus"></i>
    </button>
</div>

<div class="container filters-container" style="text-align: center;">
  <form method="GET" action="" class="filters-form" style="display: block;">
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
  </form>            
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
                    echo '<img src="./uploads/default_image.png" alt="Default Imagen" id="image_' . $row['id'] . '" style="width: 120px; height: auto; border-radius: 50%;">'; // Increased width to 120px
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
                         overflow: hidden;">
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

        <div class="action-buttons btn-group" style="margin-top: 10px; display: flex; justify-content: center; width: 100%; padding:10px;">
            <button class="action-btn history-btn" 
                    title="Actualizar" 
                    onclick="openUpdateModal(\'' . htmlspecialchars($row['tagid']) . '\')">
                <i class="fa-regular fa-pen-to-square" style="color: #048c09;"></i>
            </button>
            <button class="action-btn history-btn" title="Historial" onclick="registrar(\'' . htmlspecialchars($row['tagid']) . '\')">
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

<!-- Borrar Animal -->
<script>
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
<script>
    // Add this at the start of your script section
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all modals
        var modals = document.querySelectorAll('.modal');
        modals.forEach(function(modal) {
            new bootstrap.Modal(modal);
        });
    });

    // Add this function for the update modal image preview
function previewUpdateImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('updateImagePreview');
        output.src = reader.result;
    }
    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}

// Update the openUpdateModal function to include the image upload handler
function openUpdateModal(tagid) {
    console.log('Opening modal for tagid:', tagid);
    
    const modalElement = document.getElementById('updateModal');
    if (!modalElement) {
        console.error('Modal element not found');
        return;
    }

    // Add event listener for image upload
    const imageUpload = document.getElementById('updateImageUpload');
    if (imageUpload) {
        imageUpload.addEventListener('change', previewUpdateImage);
    }
}

    // Rest of your existing openUpdateModal code...


    function openUpdateModal(tagid) {
        console.log('Opening modal for tagid:', tagid);
        
        const modalElement = document.getElementById('updateModal');
        if (!modalElement) {
            console.error('Modal element not found');
            return;
        }

        const modal = new bootstrap.Modal(modalElement, {
            keyboard: true,
            backdrop: true
        });
        
        $.ajax({
            url: 'fetch_vacuno_data.php',
            type: 'GET',
            data: { tagid: tagid },
            dataType: 'json',
            success: function(data) {
                console.log('Data received:', data);
                
                if (data.error) {
                    console.error('Data error:', data.error);
                    return;
                }

                // Update image preview with correct path
                const updateImagePreview = document.getElementById('updateImagePreview');
                if (updateImagePreview) {
                    if (data.imagen && data.imagen.trim() !== '') {
                        // Use the correct path to your images folder
                        const imagePath = `images/${data.imagen}`;
                        console.log('Setting image path:', imagePath);
                        
                        // First try to load the image
                        fetch(imagePath)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Image not found');
                                }
                                updateImagePreview.src = imagePath;
                            })
                            .catch(error => {
                                console.warn('Error loading image:', error);
                                updateImagePreview.src = 'images/default_image.png';
                            });
                    } else {
                        console.log('No image data, using default');
                        updateImagePreview.src = 'images/default_image.png';
                    }
                } else {
                    console.error('Image preview element not found');
                }

                // Helper function to safely set form values
                const setFieldValue = (id, value) => {
                    const element = document.getElementById(id);
                    if (element) {
                        element.value = value || '';
                        console.log(`Set ${id} to:`, value);
                    } else {
                        console.warn(`Element not found: ${id}`);
                    }
                };

                // Populate form fields
                setFieldValue('updateNombre', data.nombre);
                setFieldValue('updateTagid', data.tagid);
                setFieldValue('updateFechaNacimiento', data.fecha_nacimiento);
                setFieldValue('updateGenero', data.genero);
                setFieldValue('updateRaza', data.raza);
                setFieldValue('updateEtapa', data.etapa);
                setFieldValue('updateGrupo', data.grupo);
                setFieldValue('updateEstatus', data.estatus);
                setFieldValue('updateFechaCompra', data.fecha_compra);

                // Set the image preview
                document.getElementById('updateImagePreview').src = data.image ? data.image : './images/default_image.png';

                // Show the modal
                modal.show();
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', error);
                console.error('Response:', xhr.responseText);
                alert('Error al cargar los datos del animal: ' + error);
            }
        });
    }

    // Add event listener for modal hidden event
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('updateModal');
        if (modalElement) {
            modalElement.addEventListener('hidden.bs.modal', function () {
                console.log('Modal hidden');
            });
        }
    });
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
<h3  class="container mt-4 text-white" id="section-inventario-poblacion-vacuno">
POBLACION
</h3>

<h4 class="container">Animales Registrados</h4>

<!-- Tabla Poblacion Vacuno -->
<div class="container table-responsive mt-4">
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
<!-- Vacuno Table Script Inicializacion -->
<script>
// Add this before your DataTable initialization
const spanishTranslation = {
    "decimal": "",
    "emptyTable": "No hay datos disponibles en la tabla",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
    "infoFiltered": "(filtrado de _MAX_ registros totales)",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Mostrar _MENU_ registros",
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "search": "Buscar:",
    "zeroRecords": "No se encontraron registros coincidentes",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": activar para ordenar la columna ascendente",
        "sortDescending": ": activar para ordenar la columna descendente"
    }
};

// vacuno DataTable initialization
$(document).ready(function() {
    $('#vacunoTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<!-- Ir a Pagina Registros -->    
<script>
function registrar(tagid) {
    // Redirect to vacuno_historial.php with tagid as a query parameter
    window.location.href = './vacuno_historial.php?search=' + encodeURIComponent(tagid);
}
</script>
<!-- Canvas Genero Raza Grupo Estatus Pie Charts -->
<div style="max-width: 600px; margin: 40px auto;">
    <h4>Distribución por genero (%)</h4>
    <canvas id="sexoPieChart"></canvas>
</div>
<div style="max-width: 600px; margin: 40px auto;">
    <h4>Distribución por Raza (%)</h4>
    <canvas id="razaPieChart"></canvas>
</div>
<div style="max-width: 600px; margin: 40px auto;">
    <h4>Distribución por Grupos (%)</h4>
    <canvas id="grupoPieChart"></canvas>
</div>
<div style="max-width: 600px; margin: 40px auto;">
    <h4>Distribución por Estatus (%)</h4>
    <canvas id="estatusPieChart"></canvas>
</div>
<!-- Genero Pie Chart -->
<script>
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
<!-- New Entry Modal -->
<div class="modal fade" id="newEntryModal" tabindex="-1" aria-labelledby="newEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="newEntryModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Animal
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newEntryForm" class="needs-validation" novalidate>
                    <div class="row">
                        <!-- Left Column - Image -->
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <div class="image-preview-container">
                                    <img id="newImagePreview" src="./images/default_image.png" 
                                         class="img-thumbnail mb-2" alt="Preview" 
                                         style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                                <label for="newImageUpload" class="btn btn-outline-success btn-sm mt-2">
                                    <i class="fas fa-upload me-2"></i>Subir Imagen
                                </label>
                                <input type="file" class="d-none" id="newImageUpload" accept="image/*" onchange="previewImage(event)">
                            </div>
                        </div>

                        <!-- Right Column - Form Fields -->
                        <div class="col-md-8">
                            <div class="row g-3">
                                <!-- Tag ID -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="newTagid" required>
                                        <label for="newTagid">Tag ID</label>
                                        <div class="invalid-feedback">
                                            Por favor ingrese un Tag ID válido
                                        </div>
                                    </div>
                                </div>

                                <!-- Nombre -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="newNombre" required>
                                        <label for="newNombre">Nombre</label>
                                        <div class="invalid-feedback">
                                            Por favor ingrese un nombre
                                        </div>
                                    </div>
                                </div>

                                <!-- Fecha Nacimiento -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="newFechaNacimiento" required>
                                        <label for="newFechaNacimiento">Fecha de Nacimiento</label>
                                        <div class="invalid-feedback">
                                            Por favor seleccione la fecha de nacimiento
                                        </div>
                                    </div>
                                </div>

                                <!-- Fecha Compra -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="newFechaCompra">
                                        <label for="newFechaCompra">Fecha de Compra</label>
                                    </div>
                                </div>

                                <!-- Sexo -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="newGenero" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Macho">Macho</option>
                                            <option value="Hembra">Hembra</option>
                                        </select>
                                        <label for="newGenero">Sexo</label>
                                        <div class="invalid-feedback">
                                            Por favor seleccione el sexo
                                        </div>
                                    </div>
                                </div>

                                <!-- Raza -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="newRaza" required>
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $conn_razas = new mysqli('localhost', $username, $password, $dbname);
                                            $sql_razas = "SELECT DISTINCT razas_nombre FROM v_razas ORDER BY razas_nombre";
                                            $result_razas = $conn_razas->query($sql_razas);
                                            while ($row_razas = $result_razas->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row_razas['razas_nombre']) . '">' 
                                                    . htmlspecialchars($row_razas['razas_nombre']) . '</option>';
                                            }
                                            $conn_razas->close();
                                            ?>
                                        </select>
                                        <label for="newRaza">Raza</label>
                                        <div class="invalid-feedback">
                                            Por favor seleccione la raza
                                        </div>
                                    </div>
                                </div>

                                <!-- Grupo -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="newGrupo" required>
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $conn_grupos = new mysqli('localhost', $username, $password, $dbname);
                                            $sql_grupos = "SELECT DISTINCT grupos_nombre FROM v_grupos ORDER BY grupos_nombre";
                                            $result_grupos = $conn_grupos->query($sql_grupos);
                                            while ($row_grupos = $result_grupos->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row_grupos['grupos_nombre']) . '">' 
                                                    . htmlspecialchars($row_grupos['grupos_nombre']) . '</option>';
                                            }
                                            $conn_grupos->close();
                                            ?>
                                        </select>
                                        <label for="newGrupo">Grupo</label>
                                        <div class="invalid-feedback">
                                            Por favor seleccione el grupo
                                        </div>
                                    </div>
                                </div>

                                <!-- Estatus -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="newEstatus" required>
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $conn_estatus = new mysqli('localhost', $username, $password, $dbname);
                                            $sql_estatus = "SELECT DISTINCT estatus_nombre FROM v_estatus ORDER BY estatus_nombre";
                                            $result_estatus = $conn_estatus->query($sql_estatus);
                                            while ($row_estatus = $result_estatus->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row_estatus['estatus_nombre']) . '">' 
                                                    . htmlspecialchars($row_estatus['estatus_nombre']) . '</option>';
                                            }
                                            $conn_estatus->close();
                                            ?>
                                        </select>
                                        <label for="newEstatus">Estatus</label>
                                        <div class="invalid-feedback">
                                            Por favor seleccione el estatus
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer btn-group">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-outline-success" onclick="saveNewEntry()">
                    <i class="fas fa-save me-2"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!--Save New Entry Function  -->
<script>
function saveNewEntry() {
    // Get the form
    const form = document.getElementById('newEntryForm');
    if (!form) {
        console.error('New entry form not found');
        return;
    }

    // Create FormData object
    const formData = new FormData();
    
    // Add form fields
    formData.append('tagid', document.getElementById('newTagid').value);
    formData.append('nombre', document.getElementById('newNombre').value);
    formData.append('fecha_nacimiento', document.getElementById('newFechaNacimiento').value);
    formData.append('fecha_compra', document.getElementById('newFechaCompra').value);
    formData.append('genero', document.getElementById('newGenero').value);
    formData.append('raza', document.getElementById('newRaza').value);
    formData.append('grupo', document.getElementById('newGrupo').value);
    formData.append('estatus', document.getElementById('newEstatus').value);

    // Add the image file if one was selected
    const imageFile = document.getElementById('newImageUpload').files[0];
    if (imageFile) {
        formData.append('imagen', imageFile);
    }

    // Show loading state
    const saveButton = document.querySelector('#newEntryModal .btn-outline-success');
    if (!saveButton) {
        console.error('Save button not found');
        return;
    }
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Guardando...';
    saveButton.disabled = true;

    // Send the create request
    $.ajax({
        url: 'vacuno_create.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 10000,
        success: function(response) {
            try {
                const result = typeof response === 'string' ? JSON.parse(response) : response;
                
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Guardado!',
                        text: 'El nuevo animal ha sido registrado exitosamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        // Reset form
                        form.reset();
                        
                        // Reset image preview
                        const imagePreview = document.getElementById('newImagePreview');
                        if (imagePreview) {
                            imagePreview.src = 'images/default_image.png';
                        }
                        
                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('newEntryModal'));
                        if (modal) {
                            modal.hide();
                        }
                        
                        // Refresh page
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message || 'Hubo un error al guardar los datos.'
                    });
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al procesar la respuesta del servidor.'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax error:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
            
            let errorMessage = 'Hubo un error al enviar los datos';
            if (status === 'timeout') {
                errorMessage = 'La solicitud tardó demasiado tiempo. Por favor, intente de nuevo.';
            } else if (xhr.responseText) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        errorMessage = response.message;
                    }
                } catch (e) {
                    console.error('Error parsing error response:', e);
                }
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage
            });
        },
        complete: function() {
            // Restore button state
            saveButton.innerHTML = originalText;
            saveButton.disabled = false;
        }
    });
}
</script>
<!-- Add this script for image preview -->
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('newImagePreview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="updateModalLabel">
                    <i class="fas fa-edit me-2"></i>Actualizar Animal
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="row">
                        <!-- Left Column - Image -->
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <div class="image-preview-container">
                                    <img id="updateImagePreview" src="./images/default_image.png" 
                                         class="img-thumbnail mb-2" alt="Preview" 
                                         style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                                <label for="updateImageUpload" class="btn btn-outline-success btn-sm mt-2">
                                    <i class="fas fa-upload me-2"></i>Cambiar Imagen
                                </label>
                                <input type="file" class="d-none" id="updateImageUpload" 
                                       accept="image/*" onchange="previewUpdateImage(event)">
                            </div>
                        </div>

                        <!-- Right Column - Form Fields -->
                        <div class="col-md-8">
                            <div class="row g-3">
                                <!-- Tag ID -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="tagid" id="updateTagid" required readonly>
                                        <label for="updateTagid">Tag ID</label>
                                    </div>
                                </div>

                                <!-- Nombre -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="nombre" id="updateNombre" required>
                                        <label for="updateNombre">Nombre</label>
                                    </div>
                                </div>

                                <!-- Fecha Nacimiento -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" name="fecha_nacimiento" id="updateFechaNacimiento" required>
                                        <label for="updateFechaNacimiento">Fecha de Nacimiento</label>
                                    </div>
                                </div>

                                <!-- Fecha Compra -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" name="fecha_compra" id="updateFechaCompra">
                                        <label for="updateFechaCompra">Fecha de Compra</label>
                                    </div>
                                </div>

                                <!-- Sexo -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="genero" id="updateGenero" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Macho">Macho</option>
                                            <option value="Hembra">Hembra</option>
                                        </select>
                                        <label for="updateGenero">Sexo</label>
                                    </div>
                                </div>

                                <!-- Raza -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="raza" id="updateRaza" required>
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $conn_razas = new mysqli('localhost', $username, $password, $dbname);
                                            $sql_razas = "SELECT DISTINCT razas_nombre FROM v_razas ORDER BY razas_nombre";
                                            $result_razas = $conn_razas->query($sql_razas);
                                            while ($row_razas = $result_razas->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row_razas['razas_nombre']) . '">' 
                                                    . htmlspecialchars($row_razas['razas_nombre']) . '</option>';
                                            }
                                            $conn_razas->close();
                                            ?>
                                        </select>
                                        <label for="updateRaza">Raza</label>
                                    </div>
                                </div>                                

                                <!-- Etapa -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="etapa" id="updateEtapa" required>
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $conn_etapa = new mysqli('localhost', $username, $password, $dbname);
                                            $sql_etapa = "SELECT DISTINCT etapa FROM vacuno ORDER BY etapa";
                                            $result_etapa = $conn_etapa->query($sql_etapa);
                                            while ($row_etapa = $result_etapa->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row_etapa['etapa']) . '">' 
                                                    . htmlspecialchars($row_etapa['etapa']) . '</option>';
                                            }
                                            $conn_etapa->close();
                                            ?>
                                        </select>
                                        <label for="updateEtapa">Etapa</label>
                                    </div>
                                </div>

                                <!-- Grupo -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="grupo" id="updateGrupo" required>
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $conn_grupos = new mysqli('localhost', $username, $password, $dbname);
                                            $sql_grupos = "SELECT DISTINCT grupos_nombre FROM v_grupos ORDER BY grupos_nombre";
                                            $result_grupos = $conn_grupos->query($sql_grupos);
                                            while ($row_grupos = $result_grupos->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row_grupos['grupos_nombre']) . '">' 
                                                    . htmlspecialchars($row_grupos['grupos_nombre']) . '</option>';
                                            }
                                            $conn_grupos->close();
                                            ?>
                                        </select>
                                        <label for="updateGrupo">Grupo</label>
                                    </div>
                                </div>

                                <!-- Estatus -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="estatus" id="updateEstatus" required>
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $conn_estatus = new mysqli('localhost', $username, $password, $dbname);
                                            $sql_estatus = "SELECT DISTINCT estatus_nombre FROM v_estatus ORDER BY estatus_nombre";
                                            $result_estatus = $conn_estatus->query($sql_estatus);
                                            while ($row_estatus = $result_estatus->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row_estatus['estatus_nombre']) . '">' 
                                                    . htmlspecialchars($row_estatus['estatus_nombre']) . '</option>';
                                            }
                                            $conn_estatus->close();
                                            ?>
                                        </select>
                                        <label for="updateEstatus">Estatus</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer btn-group">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-outline-success" onclick="saveUpdates()">
                    <i class="fas fa-save me-2"></i>Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>
<script>
function saveUpdates() {
    // Get the form
    const form = document.getElementById('updateForm');
    if (!form) {
        console.error('Update form not found');
        return;
    }

    // Create FormData object from the form
    const formData = new FormData(form);
    
    // Add any fields that might not be in the form
    const tagid = document.getElementById('updateTagid');
    if (tagid) {
        formData.append('tagid', tagid.value);
    }

    // Add the image file if one was selected
    const imageFile = document.getElementById('updateImageUpload').files[0];
    if (imageFile) {
        formData.append('image', imageFile);
    }

    // Show loading state
    const saveButton = document.querySelector('#updateModal .btn-outline-success');
    if (!saveButton) {
        console.error('Save button not found');
        return;
    }
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Guardando...';
    saveButton.disabled = true;

    // Send the update request
    $.ajax({
        url: 'vacuno_update.php',
        type: 'POST',
        data: formData,
        processData: false,  // Important for FormData
        contentType: false,  // Important for FormData
        cache: false,        // Prevent caching
        timeout: 10000,      // Set timeout to 10 seconds
        success: function(response) {
            try {
                const result = typeof response === 'string' ? JSON.parse(response) : response;
                
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: 'Los datos han sido actualizados exitosamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        // Close modal and refresh page
                        const modal = bootstrap.Modal.getInstance(document.getElementById('updateModal'));
                        if (modal) {
                            modal.hide();
                        }
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message || 'Hubo un error al actualizar los datos.'
                    });
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al procesar la respuesta del servidor.'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax error:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
            
            let errorMessage = 'Hubo un error al enviar los datos';
            if (status === 'timeout') {
                errorMessage = 'La solicitud tardó demasiado tiempo. Por favor, intente de nuevo.';
            } else if (xhr.responseText) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        errorMessage = response.message;
                    }
                } catch (e) {
                    console.error('Error parsing error response:', e);
                }
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage
            });
        },
        complete: function() {
            // Restore button state
            saveButton.innerHTML = originalText;
            saveButton.disabled = false;
        }
    });
}

// Add form validation before submission
document.getElementById('updateModal').addEventListener('shown.bs.modal', function () {
    const form = this.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>

<h3  class="container mt-4 text-white" id="section-inventario-produccion-vacuno">
PRODUCCION
</h3>

<!-- VH_Peso Table -->

<h4 class="container">Historial Produccion Carnica</h4>

<div class="container table-responsive mt-4">
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
        </table>
</div>
<!-- Pesos Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#pesosTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<!-- Canvas Producion Carne -->
<div style="max-width: 1300px; margin: 40px auto;">
    <h4 class="container">PESAJE ANIMAL</h4>
    <canvas id="avgPesoChart" width="600" height="400"></canvas>
</div>
<!-- Chart Produccion Carne -->
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

<!-- Produccion Lechera -->

<h4 class="container" id="Produccion-Lechera">Historial Produccion Lechera</h4>

<!-- VH_Leche Table -->
<div class="container table-responsive mt-4">    
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
    </table>
</div>

<!-- Leche Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#lecheTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<!-- Canvas Leche Produccion -->
<div style="max-width: 1300px; margin: 40px auto;">        
    <h4>PESAJES MENSUALES LECHE</h4>
    <canvas id="avgLecheChart" width="600" height="400"></canvas>
</div>
<!-- Chart Promedio Leche  -->
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

<h3  class="container mt-4 text-white" id="section-inventario-alimentacion-vacuno">
ALIMENTACION
</h3>


<h4 class="container" id="Section-Alimentacion">Historial Inversion Concentrado</h4>

<!-- VH_Concentrado Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Concentrado Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#concentradoTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<!-- VH_Melaza Table -->

    <h4 class="container">Historial Inversion Melaza</h4>

<div class="container table-responsive mt-4">
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
       </table>
</div>
<!-- Melaza Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#melazaTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<!-- VH_Sal Table -->

    <h4 class="container">Historial Inversion Sal</h4>

<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Sal Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#salTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<!-- Canvas Inversion en Alimentacion -->
<div style="max-width: 1300px; margin: 40px auto;">
    <h4 class="container">INVERSION ALIMENTOS</h4>
    <canvas id="avgRacionChart" width="600" height="400"></canvas>
</div>
<!-- Inversion en alimentacion Chart -->
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

<h3  class="container mt-4 text-white" id="section-inventario-salud-vacuno">
SALUD
</h3>

<h4 class="container" id="Section-Vacunas">Historial Vacunación Aftosa</h4>

<!-- VH_Aftosa Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Aftosa Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#aftosaTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>

<h4 class="container">Historial de Vacunación IBR</h4>

<!-- VH_IBR Table -->
<div class="container table-responsive mt-4">    
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
    </table>
</div>
<!-- IBR Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#ibrTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial de Vacunación CBR</h4>

<!-- VH_CBR Table -->
<div class="container table-responsive mt-4">    
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
    </table>
</div>
<!-- CBR Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#cbrTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Vacunación Brucelosis</h4>

<!-- VH_brucelosis Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Bruceslosis Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#brucelosisTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Vacunación Carbunco</h4>

<!-- VH_carbunco Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Carbunco Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#carbuncoTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Vacunación Garrapatas</h4>

<!-- VH_garrapatas Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Garrapatas Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#garrapatasTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Tratamiento Mastitis</h4>

<!-- VH_mastitis Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Mastitis Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#mastitisTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Tratamiento Lombrices</h4>

<!-- VH_lombrices Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Lombrices Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#lombricesTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h3  class="container mt-4 text-white" id="section-inventario-reproduccion-vacuno">
REPRODUCCION
</h3>

<h4 class="container">Historial Inseminacion</h4>

<!-- VH_inseminacion Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Inseminacion Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#inseminacionTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Gestacion</h4>

<!-- VH_gestacion Table -->
<div class="container table-responsive mt-4">

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
<!-- Gestacion Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#gestacionTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Partos</h4>


<!-- VH_parto Table -->
<div class="container table-responsive mt-4">
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
<!-- Parto Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#partoTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>


<!-- Tabla Abortos -->
<h4 class="container">Historial Abortos</h4>

<!-- VH_aborto Table -->
<div class="container table-responsive mt-4">
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
<!-- Aborto Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#abortoTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h3  class="container mt-4 text-white" id="section-inventario-otros-vacuno">
OTROS
</h3>

<h4 class="container">Historial Venta</h4>

<!-- VH_venta Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Venta Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#ventaTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Destete</h4>
<!-- VH_destete Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Destete Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#desteteTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>
<h4 class="container">Historial Descarte</h4>

<!-- VH_descarte Table -->
<div class="container table-responsive mt-4">
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
    </table>
</div>
<!-- Descarte Table Script Inicializacion -->
<script>
$(document).ready(function() {
    $('#descarteTable').DataTable({
        responsive: true,
        dom: "Blfrtip",
        bProcessing: true,
        buttons: [ 'excel','pdf'],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]], 
        language: {
            ...spanishTranslation,
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
        },
        paging: true,
        pagingType: "full_numbers"
    });
});
</script>

<!-- Back to top button -->
<button id="backToTop" class="back-to-top" onclick="scrollToTop()" title="Volver arriba">
    <div class="arrow-up"><i class="fa-solid fa-arrow-up"></i></div>
</button>

<script>
// Show/hide back to top button based on scroll position
window.onscroll = function() {
    const backToTopButton = document.getElementById("backToTop");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        backToTopButton.style.display = "flex";
    } else {
        backToTopButton.style.display = "none";
    }
};

// Smooth scroll to top function
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
</script>

<!-- Scroll to Section-->

<script>
// Add event listeners to all scroll buttons
document.querySelectorAll('.scroll-Icons-container button').forEach(button => {
    button.addEventListener('click', function() {
        // Get the target section ID from data-target attribute
        const targetId = this.getAttribute('data-target').substring(1); // Remove the # from the ID
        const targetElement = document.getElementById(targetId);
        
        if (targetElement) {
            // Smooth scroll to the target section
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            
            // If using Bootstrap collapse, toggle it
            const bsCollapse = new bootstrap.Collapse(targetElement, {
                toggle: true
            });
        }
    });
});
</script>
<!-- Crear Nuevo Animal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get form element
    const createEntryForm = document.getElementById('newEntryForm');
    const newEntryModal = document.getElementById('newEntryModal');

    if (createEntryForm) {
        // Handle form submission
        createEntryForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Create a FormData object from the form
            const formData = new FormData(createEntryForm);

            // Show loading state
            const submitButton = createEntryForm.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Guardando...';
            submitButton.disabled = true;

            // Send the form data using fetch
            fetch('vacuno_create.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Nuevo animal agregado exitosamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        // Reset form and close modal
                        createEntryForm.reset();
                        const imagePreview = document.getElementById('newImagePreview');
                        if (imagePreview) {
                            imagePreview.src = 'images/default_image.png';
                        }
                        const modal = bootstrap.Modal.getInstance(newEntryModal);
                        if (modal) {
                            modal.hide();
                        }
                        // Reload page to show new entry
                        location.reload();
                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Ocurrió un error al agregar el nuevo animal.'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al procesar la solicitud.'
                });
            })
            .finally(() => {
                // Restore button state
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            });
        });

        // Handle image preview for new entry
        const newImageUpload = document.getElementById('newImageUpload');
        const newImagePreview = document.getElementById('newImagePreview');

        if (newImageUpload && newImagePreview) {
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
        }
    }

    // Initialize Bootstrap validation
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});
</script>


<?php
$conn->close();
?> 

<!-- DataTables Scripts -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<!-- Make sure these exact versions of the libraries are included in your head section -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>


</body>
</html>