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
?>

<!DOCTYPE html>
<html>
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

    <!-- Add back button before the header container -->
    <a href="./inventario_vacuno.php" class="back-btn">
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
<!-- Icon Navigation Buttons -->    
<div class="container nav-icons-container" id="nav-buttons">
    <button onclick="window.location.href='../inicio.php'" class="icon-button" data-tooltip="Inicio">
        <img src="./images/Ganagram_New_Logo-png.png" alt="Inicio" class="nav-icon">
    </button>

    <button onclick="window.location.href='./inventario_vacuno.php'" class="icon-button" data-tooltip="Inventario Vacuno">
        <img src="./images/vacas.png" alt="Inventario Vacuno" class="nav-icon">
    </button>

    <button onclick="window.location.href='./vacuno_indices.php'" class="icon-button" data-tooltip="Indices Vacunos">
        <img src="./images/fondo-indexado.png" alt="Inicio" class="nav-icon">
    </button>

    <button onclick="window.location.href='./vacuno_configuracion.php'" class="icon-button" data-tooltip="Configurar Tablas">
        <img src="./images/configuracion.png" alt="Inicio" class="nav-icon">
    </button>
</div>

<!-- Scroll Icons Container -->
<div class="container scroll-icons-container">
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-historial-produccion-vacuno" data-tooltip="Produccion">
        <img src="./images/bascula-de-comestibles.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-historial-alimentacion-vacuno" data-tooltip="Alimentacion">
        <img src="./images/bolso.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-historial-salud-vacuno" data-tooltip="Salud">
        <img src="./images/vacunacion.png" alt="Salud" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-historial-reproduccion-vacuno" data-tooltip="reproduccion">
        <img src="./images/matriz.png" alt="Razas" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#section-historial-otros-vacuno" data-tooltip="Otros">
        <img src="./images/compra.png" alt="Razas" class="nav-icon">
    </button>
</div>




<div class="container mt-4">
        <div>
            <h2 class="page-title">REGISTROS</h2>
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

//Leche: Ingresos Acumulados


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
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_peso = "SELECT p.*, v.nombre
                      FROM vh_peso p
                      LEFT JOIN vacuno v ON p.vh_peso_tagid = v.tagid
                      WHERE p.vh_peso_tagid = '$tagid'";
} else {
    $baseQuery_peso = "SELECT p.*, v.nombre
                      FROM vh_peso p
                      LEFT JOIN vacuno v ON p.vh_peso_tagid = v.tagid";
}
$result_peso = $conn->query($baseQuery_peso);
?>
<div class="container text-center">
    <!-- Search Form -->
    <form method="GET" class="text-center mb-4">
        <div class="input-group text-center">
            <input type="text" id="search" name="search" placeholder="Buscar por Tag ID..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-success">Buscar</button>
        </div>
    </form>
</div>

<h3  class="container mt-4 text-white" class="collapse" id="section-historial-produccion-vacuno">
REGISTROS DE PRODUCCION
</h3>

<!-- Registros de Peso -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">PESAJE ANIMAL</h4>

<!-- Peso: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <!-- NEW PESO FORM -->

    <div class="collapse mb-3" id="addPesoForm">
        <div class="card card-body">

            <form id="pesoForm" action="process_peso.php" method="POST">
                <input type="hidden" name="action" value="insert">
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

    <!-- PESO DataTable -->

    <div class="table-responsive">
        <!-- Add New Peso Form -->
        <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addPesoForm">
        <i class="fas fa-plus"></i> Registrar
        </button>
        <table id="pesosTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Nombre</th>
                    <th>Peso (kg)</th>
                    <th>Precio</th>
                    <th>Total ($)</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_peso->num_rows > 0) {
                    while($row = $result_peso->fetch_assoc()) {
                        $valor_total = floatval($row['vh_peso_animal']) * floatval($row['vh_peso_precio']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_peso_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['nombre'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_peso_animal']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_peso_precio']) . "</td>";
                        echo "<td style='text-align: center;'>" . number_format($valor_total, 2) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_peso_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-peso'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editPesoModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_peso_tagid']) . "'
                                            data-peso='" . htmlspecialchars($row['vh_peso_animal']) . "'
                                            data-precio='" . htmlspecialchars($row['vh_peso_precio']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_peso_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm delete-peso'
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

<!--  Peso Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#pesosTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[5, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3, 4], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [5], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [6], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit Peso Modal -->

<div class="modal fade" id="editPesoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Peso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPesoForm" action="process_peso.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Peso (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="peso" id="edit_peso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio por kg ($)</label>
                        <input type="number" step="0.01" class="form-control" name="precio" id="edit_precio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Peso JS -->

<script>
    // Handle edit button click
    $('.edit-peso').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const peso = button.data('peso');
        const precio = button.data('precio');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_peso').val(peso);
        $('#edit_precio').val(precio);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditPeso').click(function() {
        const form = $('#editPesoForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_peso.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editPesoModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });
</script>


<!-- Leche Table -->

<!-- Leche Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_leche = "SELECT p.*, v.nombre
                      FROM vh_leche p
                      LEFT JOIN vacuno v ON p.vh_leche_tagid = v.tagid
                      WHERE p.vh_leche_tagid = '$tagid'";
} else {
    $baseQuery_leche = "SELECT p.*, v.nombre
                      FROM vh_leche p
                      LEFT JOIN vacuno v ON p.vh_leche_tagid = v.tagid";
}
$result_leche = $conn->query($baseQuery_leche);
?>
<div class="container">
    <!-- Search Form -->
<form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" id="search" name="search" placeholder="Buscar por Tag ID..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-success">Buscar</button>
        </div>
    </form>
</div>
<div class="container mt-4">
<h4 class="container mt-4" style="text-align: center;">REGISTROS PRODUCCION LECHE</h4>
</div>

<!-- Registros de leche -->

<!-- Leche: Nuevo Registro Form -->
<div class="container">
    <h5>Control Pesaje Leche</h5>
    <!-- Add New Leche Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addLecheForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW Leche FORM -->

    <div class="collapse mb-3" id="addLecheForm">
        <div class="card card-body">

            <form id="lecheForm" action="process_leche.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Leche (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="leche" required>
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
</div>

<!-- Leche DataTable -->

<div class="container table-responsive">
    <table id="lecheTable" class="table table-striped table-bordered">
        <thead>

            <tr>
                <th style="text-align: center;">Tag ID</th>
                <th style="text-align: center;">Nombre</th>
                <th style="text-align: center;">Leche (kg)</th>
                <th style="text-align: center;">Precio</th>
                <th style="text-align: center;">Total ($)</th>
                <th style="text-align: center;">Fecha</th>
                <th style="text-align: center;">Acciones</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_leche->num_rows > 0) {
                while($row = $result_leche->fetch_assoc()) {
                    $valor_total = floatval($row['vh_leche_peso']) * floatval($row['vh_leche_precio']);

                    echo "<tr>";
                    echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_leche_tagid']) . "</td>";
                    echo "<td style='text-align: center;'>" . htmlspecialchars($row['nombre'] ?? 'N/A') . "</td>";
                    echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_leche_peso']) . "</td>";
                    echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_leche_precio']) . "</td>";
                    echo "<td style='text-align: center;'>" . number_format($valor_total, 2) . "</td>";
                    echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_leche_fecha']) . "</td>";
                    echo "<td style='text-align: center;'>
                            <div class='btn-group' role='group'>
                                <button class='btn btn-success text-center btn-sm edit-Leche'
                                        data-bs-toggle='modal'
                                        data-bs-target='#editLecheModal'
                                        data-id='" . htmlspecialchars($row['id']) . "'
                                        data-tagid='" . htmlspecialchars($row['vh_leche_tagid']) . "'
                                        data-Leche='" . htmlspecialchars($row['vh_leche_peso']) . "'
                                        data-precio='" . htmlspecialchars($row['vh_leche_precio']) . "'
                                        data-fecha='" . htmlspecialchars($row['vh_leche_fecha']) . "'>
                                    <i class='fas fa-edit'></i>
                                </button>
                                <button class='btn btn-danger btn-sm delete-Leche'
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

<!--  Leche Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#lecheTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[5, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3, 4], // Leche, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [5], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [6], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>

<!-- Edit Leche Modal -->

<div class="modal fade" id="editLecheModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Leche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editLecheForm" action="process_leche.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Leche (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="peso" id="edit_leche_peso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio por kg ($)</label>
                        <input type="number" step="0.01" class="form-control" name="precio" id="edit_leche_precio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_leche_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Leche JS -->

<script>
$(document).ready(function() {
    // Existing delete handler...

    // Handle edit button click
    $('.edit-leche').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const peso = button.data('peso');
        const precio = button.data('precio');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_leche_peso').val(peso);
        $('#edit_leche_precio').val(precio);
        $('#edit_leche_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditLeche').click(function() {
        const form = $('#editLecheForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_leche.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editLecheModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    <?php
    // Query to get monthly averages
    $sql_monthly_milk = "
        SELECT
            DATE_FORMAT(vh_leche_fecha, '%Y-%m') as month,
            AVG(vh_leche_peso * vh_leche_precio) as average_revenue,
            COUNT(*) as count
        FROM vh_leche
        WHERE vh_leche_tagid = '$tagid'
        GROUP BY DATE_FORMAT(vh_leche_fecha, '%Y-%m')
        ORDER BY month ASC
    ";

    $result_monthly_milk = $conn->query($sql_monthly_milk);

    $months = [];
    $revenues = [];

    if ($result_monthly_milk->num_rows > 0) {
        while($row = $result_monthly_milk->fetch_assoc()) {
            // Format date for display
            $date = new DateTime($row['month'] . '-01');
            $months[] = $date->format('M Y');
            $revenues[] = round($row['average_revenue'], 2);
        }
    }
    ?>
// Create the chart
    const ctx = document.getElementById('lecheRevenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Ingreso Promedio Mensual ($)',
                data: <?php echo json_encode($revenues); ?>,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Promedio Mensual de Ingresos por Leche'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '$ ' + context.parsed.y.toLocaleString('es-ES', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$ ' + value.toLocaleString('es-ES', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    }
                }
            }
        }
    });
});
</script>

<!-- Leche: Graficos Canvas -->
<div style="max-width: 1300px; margin: 40px auto;">
    <h4 style="text-align: center;">Produccion Leche</h4>
    <canvas id="lecheLineChart"></canvas>
</div>

<div style="max-width: 1300px; margin: 40px auto;">
    <h4 style="text-align: center;">Produccion Acumulada Leche</h4>
    <canvas id="lecheCumulativeChart"></canvas>
</div>
<div style="max-width: 1300px; margin: 40px auto;">
    <h4 style="text-align: center;">Ingresos Acumulados Leche</h4>
    <canvas id="lecheRevenueChart"></canvas>
</div>

<h3  class="container mt-4 text-white" class="collapse" id="section-historial-alimentacion-vacuno">
REGISTROS DE ALIMENTACION
</h3>

<!-- Registros de Concentrado -->
<h4 class="container mt-4" style="text-align: center;">REGISTROS ALIMENTO CONCENTRADO</h4>
<!-- Concentrado Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_concentrado = "SELECT c.*, v.nombre
                      FROM vh_concentrado c
                      LEFT JOIN vacuno v ON c.vh_concentrado_tagid = v.tagid
                      WHERE c.vh_concentrado_tagid = '$tagid'";
} else {
    $baseQuery_concentrado = "SELECT c.*, v.nombre
                      FROM vh_concentrado c
                      LEFT JOIN vacuno v ON c.vh_concentrado_tagid = v.tagid";
}
$result_concentrado = $conn->query($baseQuery_concentrado);
?>
<div class="container">
    <!-- Search Form -->
<form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" id="search" name="search" placeholder="Buscar por Tag ID..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-success">Buscar</button>
        </div>
    </form>
</div>

<!-- Registros de Concentrado -->

<!-- concentrado Table Section -->
<?php
// Build the base query for concentrado
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_concentrado = "SELECT * FROM vh_concentrado WHERE vh_concentrado_tagid = '$tagid'";
} else {
    $baseQuery_concentrado = "SELECT * FROM vh_concentrado";
}
$result_concentrado = $conn->query($baseQuery_concentrado);
?>

<!-- concentrado Table -->

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Concentrado</h5>

<!-- Add New concentrado Form -->
<button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addconcentradoForm">
    <i class="fas fa-plus"></i> Registrar
</button>

<div class="collapse mb-3" id="addconcentradoForm">
    <div class="card card-body">
        <form id="concentradoForm" action="process_concentrado.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Etapa</label>
                    <input type="text" class="form-control" name="etapa" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ración (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="racion" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo</label>
                    <input type="number" step="0.01" class="form-control" name="costo" required>
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
        <table id="concentradoTable" class="table table-striped table-bordered">
            <thead>
                <tr>
		            <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Etapa</th>
                    <th style="text-align: center;">Producto</th>
                    <th style="text-align: center;">Ración (kg)</th>
                    <th style="text-align: center;">Costo ($/kg)</th>
                    <th style="text-align: center;">Total ($)</th>
                    <th style="text-align: center;"></th>

                </tr>
            </thead>
            <tbody>
                <?php
                $total_costo_concentrado = 0;
                if ($result_concentrado->num_rows > 0) {
                    while($row = $result_concentrado->fetch_assoc()) {
                        $total = floatval($row['vh_concentrado_racion']) * floatval($row['vh_concentrado_costo']);
                        $total_costo_concentrado += $total;

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_concentrado_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_concentrado_etapa']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_concentrado_producto']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_concentrado_racion']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_concentrado_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . number_format($total, 2) . "</td>";

                        echo "<td style='text-align: center;'>
                                <div class='d-flex text-center justify-content-center gap-2'>
                                    <button class='btn btn-sm btn-success' onclick='openEditConcentradoModal(" .
                                    $row['id'] . ", \"" .
                                    $row['vh_concentrado_fecha'] . "\", \"" .
                                    $row['vh_concentrado_tagid'] . "\", \"" .
                                    $row['vh_concentrado_racion'] . "\", \"" .
                                    $row['vh_concentrado_costo'] . "\", \"" .
                                    $row['vh_concentrado_etapa'] . "\", \"" .
                                    $row['vh_concentrado_producto']. "\")'>
                                    <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-sm btn-danger' onclick='deleteconcentradoEntry(" . $row['id'] . ")'>
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
<script>
    $(document).ready(function() {
    $('#concentradoTable').DataTable({
        // Basic configuration
        pageLength: 5,
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],
        order: [[0, 'desc']],
        
        // Spanish language configuration
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Responsive configuration
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRow,
                type: 'column',
                target: 'tr'
            }
        },

        // DOM and button configuration
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column definitions
        columnDefs: [
            {
                // Control column for expand/collapse
                className: 'control',
                orderable: false,
                targets: 0
            },
            {
                // Format numeric columns
                targets: [3, 4, 5], // Ración, Costo, Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                // Format date column
                targets: [0],
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                // Actions column
                targets: -1,
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
<!-- Edit concentrado Modal -->
<div class="modal fade" id="editConcentradoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar concentrado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editconcentradoForm" action="process_concentrado.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_concentrado_id">
                    <input type="hidden" name="tagid" id="edit_concentrado_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_concentrado_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Etapa</label>
                        <input type="text" class="form-control" name="etapa" id="edit_concentrado_etapa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ración (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="racion" id="edit_concentrado_racion" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_concentrado_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_concentrado_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Function to open edit modal for concentrado entries
function openEditConcentradoModal(id, fecha, tagid, racion, costo, etapa, producto, ) {
    document.getElementById('edit_concentrado_id').value = id;
    document.getElementById('edit_concentrado_fecha').value = fecha;
    document.getElementById('edit_concentrado_tagid').value = tagid;
    document.getElementById('edit_concentrado_racion').value = racion;
    document.getElementById('edit_concentrado_costo').value = costo;
    document.getElementById('edit_concentrado_etapa').value = etapa;
    document.getElementById('edit_concentrado_producto').value = producto;


    var editModal = new bootstrap.Modal(document.getElementById('editConcentradoModal'));
    editModal.show();
}

// Function to delete concentrado entries
function deleteconcentradoEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_concentrado.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>


<div style="max-width: 1300px; margin: 40px auto;">
    <h4 style="text-align: center;">Inversion Acumulada Alimento Concentrado</h4>
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
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS MELAZA</h4>
</div>
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Melaza</h5>
    <!-- Add New Melaza Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addMelazaForm">
        <i class="fas fa-plus"></i> Registrar
    </button>


<div class="collapse mb-3" id="addMelazaForm">
    <div class="card card-body">
        <form id="melazaForm" action="process_melaza.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Etapa</label>
                    <input type="text" class="form-control" name="etapa" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ración (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="racion" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo</label>
                    <input type="number" step="0.01" class="form-control" name="costo" required>
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
        <table id="melazaTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Etapa</th>
                    <th style="text-align: center;">Producto</th>
                    <th style="text-align: center;">Ración (kg)</th>
                    <th style="text-align: center;">Costo ($/kg)</th>
                    <th style="text-align: center;">Total ($)</th>
                    <th style="text-align: center;"></th>

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
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_melaza_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_melaza_etapa']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_melaza_producto']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_melaza_racion']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_melaza_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . number_format($total, 2) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='d-flex text-center justify-content-center gap-2'>
                                    <button class='btn btn-sm btn-success' onclick='openEditMelazaModal(" .
                                        $row['id'] . ", \"" .
                                        $row['vh_melaza_tagid'] . "\", \"" .
                                        $row['vh_melaza_racion'] . "\", \"" .
                                        $row['vh_melaza_costo'] . "\", \"" .
                                        $row['vh_melaza_etapa'] . "\", \"" .
                                        $row['vh_melaza_producto'] . "\", \"" .
                                        $row['vh_melaza_fecha'] . "\")'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-sm btn-danger' onclick='deleteMelazaEntry(" . $row['id'] . ")'>
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
<script>
$(document).ready(function() {
    $('#melazaTable').DataTable({
        // Basic configuration
        pageLength: 5,
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],
        order: [[0, 'desc']],
        
        // Spanish language configuration
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Responsive configuration
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRow,
                type: 'column',
                target: 'tr'
            }
        },

        // DOM and button configuration
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column definitions
        columnDefs: [
            {
                // Control column for expand/collapse
                className: 'control',
                orderable: false,
                targets: 0
            },
            {
                // Format numeric columns
                targets: [3, 4, 5], // Ración, Costo, Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                // Format date column
                targets: [0],
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                // Actions column
                targets: -1,
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
</div>

<!-- Edit Melaza Modal -->
<div class="modal fade" id="editMelazaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Melaza</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editMelazaForm" action="process_melaza.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_melaza_id">
                    <input type="hidden" name="tagid" id="edit_melaza_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_melaza_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Etapa</label>
                        <input type="text" class="form-control" name="etapa" id="edit_melaza_etapa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ración (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="racion" id="edit_melaza_racion" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_melaza_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_melaza_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Function to open edit modal for melaza entries
function openEditMelazaModal(id, tagid, racion, costo, etapa, producto, fecha) {
    document.getElementById('edit_melaza_id').value = id;
    document.getElementById('edit_melaza_tagid').value = tagid;
    document.getElementById('edit_melaza_producto').value = producto;
    document.getElementById('edit_melaza_etapa').value = etapa;
    document.getElementById('edit_melaza_racion').value = racion;
    document.getElementById('edit_melaza_costo').value = costo;
    document.getElementById('edit_melaza_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editMelazaModal'));
    editModal.show();
}

// Function to delete melaza entries
function deleteMelazaEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_melaza.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>


<div style="max-width: 1300px; margin: 40px auto;">
<h4>Inversion Acumulada Melaza</h4>
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
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS SAL MINERAL</h4>
</div>

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Sal</h5>

    <!-- Add New Sal Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addSalForm">
        <i class="fas fa-plus"></i> Registrar
    </button>
    <div class="collapse mb-3" id="addSalForm">
    <div class="card card-body">
        <form id="salForm" action="process_sal.php" method="POST">
        <input type="hidden" name="action" value="insert">
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
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Etapa</label>
                    <input type="text" class="form-control" name="etapa" required>
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
</div>
<div class="container">
    <div class="table-responsive">
        <table id="salTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Producto</th>
                    <th style="text-align: center;">Etapa</th>
                    <th style="text-align: center;">Ración (kg)</th>
                    <th style="text-align: center;">Costo</th>
                    <th style="text-align: center;">Total</th>
                    <th style="text-align: center;">Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM vh_sal WHERE vh_sal_tagid = '$tagid' ORDER BY vh_sal_fecha DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $total = $row['vh_sal_racion'] * $row['vh_sal_costo'];
                        echo "<tr>
                                <td style='text-align: center;'>" . date('d/m/Y', strtotime($row['vh_sal_fecha'])) . "</td>
                                <td style='text-align: center;'>" . htmlspecialchars($row['vh_sal_producto']) . "</td>
                                <td style='text-align: center;'>" . htmlspecialchars($row['vh_sal_etapa']) . "</td>
                                <td style='text-align: center;'>" . number_format($row['vh_sal_racion'], 2) . "</td>
                                <td style='text-align: center;'>$" . number_format($row['vh_sal_costo'], 2) . "</td>
                                <td style='text-align: center;'>$" . number_format($total, 2) . "</td>
                                <td style='text-align: center;'>
                                    <div class='d-flex text-center justify-content-center gap-2'>
                                        <button class='btn btn-sm btn-success' onclick='openEditSalModal(" .
                                            $row['id'] . ", \"" .
                                            htmlspecialchars($row['vh_sal_tagid'], ENT_QUOTES) . "\", \"" .
                                            htmlspecialchars($row['vh_sal_racion'], ENT_QUOTES) . "\", \"" .
                                            htmlspecialchars($row['vh_sal_costo'], ENT_QUOTES) . "\", \"" .
                                            htmlspecialchars($row['vh_sal_etapa'], ENT_QUOTES) . "\", \"" .
                                            htmlspecialchars($row['vh_sal_producto'], ENT_QUOTES) . "\", \"" .
                                            $row['vh_sal_fecha'] . "\")'>
                                            <i class='fas fa-edit'></i>
                                        </button>
                                        <button class='btn btn-sm btn-danger' onclick='deleteSalEntry(" . $row['id'] . ")'>
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </div>
                                </td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
<script>
$(document).ready(function() {
    $('#salTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[0, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

         // Column specific settings
         columnDefs: [
            {
                targets: [3], // Dosis column
                render: function(data, type, row) {
                    if (type === 'display') {
                        // Remove any currency symbols or spaces before parsing
                        const value = parseFloat(String(data).replace(/[^\d.-]/g, ''));
                        return value.toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Costo column
                render: function(data, type, row) {
                    if (type === 'display') {
                        // Clean the data before parsing
                        const value = parseFloat(String(data).replace(/[^\d.-]/g, ''));
                        if (isNaN(value)) {
                            console.log('Invalid Costo value:', data); // Debug log
                            return '$ 0.00';
                        }
                        return '$ ' + value.toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [0], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [6], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
</div>

<!-- Edit Sal Modal -->
<div class="modal fade" id="editSalModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Sal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editSalForm" action="process_sal.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_sal_id">
                    <input type="hidden" name="tagid" id="edit_sal_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_sal_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Etapa</label>
                        <input type="text" class="form-control" name="etapa" id="edit_sal_etapa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ración (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="racion" id="edit_sal_racion" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_sal_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_sal_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
// Function to open edit modal for sal entries
function openEditSalModal(id, tagid, racion, costo, etapa, producto, fecha) {
    document.getElementById('edit_sal_id').value = id;
    document.getElementById('edit_sal_tagid').value = tagid;
    document.getElementById('edit_sal_producto').value = producto;
    document.getElementById('edit_sal_etapa').value = etapa;
    document.getElementById('edit_sal_racion').value = racion;
    document.getElementById('edit_sal_costo').value = costo;
    document.getElementById('edit_sal_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editSalModal'));
    editModal.show();
}

// Function to delete sal entries
function deleteSalEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_sal.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>
<div class="container" style="max-width: 1300px; margin: 40px auto;">
    <h4>Inversion Acumulada Sal Mineral</h4>
    <canvas id="sal-acumulado-mensual"></canvas>
</div>
<div class="container" style="max-width: 800px; margin: 40px auto;">
    <h4>Distribución de Inversión en Alimentación</h4>
    <canvas id="investment-distribution-pie"></canvas>
</div>

<h3  class="container mt-4 text-white" class="collapse" id="section-historial-salud-vacuno">
REGISTROS DE SALUD
</h3>
<!-- Aftosa Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_aftosa = "SELECT a.*, v.nombre
                      FROM vh_aftosa a
                      LEFT JOIN vacuno v ON a.vh_aftosa_tagid = v.tagid
                      WHERE a.vh_aftosa_tagid = '$tagid'";
} else {
    $baseQuery_aftosa = "SELECT a.*, v.nombre
                      FROM vh_aftosa a
                      LEFT JOIN vacuno v ON a.vh_aftosa_tagid = v.tagid";
}
$result_aftosa = $conn->query($baseQuery_aftosa);
?>
<!-- Registros de Aftosa -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">REGISTROS VACUNACION AFTOSA</h4>
</div>
<!-- Aftosa: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <h5 class="container">Control Aftosa</h5>
    <!-- Add New Aftosa Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addAftosaForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW AFTOSA FORM -->

    <div class="collapse mb-3" id="addAftosaForm">
        <div class="card card-body">
            <form id="aftosaForm" action="process_aftosa.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Aftosa DataTable -->

    <div class="table-responsive">
        <table id="aftosaTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Producto</th>
                    <th>Dosis</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_aftosa->num_rows > 0) {
                    while($row = $result_aftosa->fetch_assoc()) {
                        $valor_total = floatval($row['vh_aftosa_costo']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_aftosa_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_aftosa_producto'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_aftosa_dosis']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_aftosa_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_aftosa_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-aftosa'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editAftosaModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_aftosa_tagid']) . "'
                                            data-dosis='" . htmlspecialchars($row['vh_aftosa_dosis']) . "'
                                            data-costo='" . htmlspecialchars($row['vh_aftosa_costo']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_aftosa_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm onclick='deleteAftosaEntry(" . $row['id'] . ")''
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

<!--  Peso Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#aftosaTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[4, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [5], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit Aftosa Modal -->

<div class="modal fade" id="editAftosaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Vacunacion Aftosa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAftosaForm" action="process_aftosa.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" id="edit_dosis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Aftosa JS -->

<script>
    // Handle edit button click
    $('.edit-aftosa').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const tagid = button.data('tagid');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_tagid').val(tagid);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditAftosa').click(function() {
        const form = $('#editAftosaForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_aftosa.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editAftosaModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });

// Function to delete concentrado entries
function deleteAftosaEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_aftosa.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>


<!-- IBR Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_ibr = "SELECT i.*, v.nombre
                      FROM vh_ibr i
                      LEFT JOIN vacuno v ON i.vh_ibr_tagid = v.tagid
                      WHERE i.vh_ibr_tagid = '$tagid'";
} else {
    $baseQuery_ibr = "SELECT i.*, v.nombre
                      FROM vh_ibr i
                      LEFT JOIN vacuno v ON i.vh_ibr_tagid = v.tagid";
}
$result_ibr = $conn->query($baseQuery_ibr);
?>
<!-- Registros de IBR -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">REGISTROS VACUNACION IBR</h4>
</div>
<!-- Ibr: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <h5 class="container">Control IBR</h5>
    <!-- Add New Ibr Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addAftosaForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW IBR FORM -->

    <div class="collapse mb-3" id="addIbrForm">
        <div class="card card-body">
            <form id="ibrForm" action="process_ibr.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- IBR DataTable -->

    <div class="table-responsive">
        <table id="ibrTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Producto</th>
                    <th>Dosis</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_ibr->num_rows > 0) {
                    while($row = $result_ibr->fetch_assoc()) {
                        $valor_total = floatval($row['vh_ibr_costo']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_ibr_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_ibr_producto'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_ibr_dosis']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_ibr_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_ibr_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-ibr'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editIbrModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_ibr_tagid']) . "'
                                            data-dosis='" . htmlspecialchars($row['vh_ibr_dosis']) . "'
                                            data-costo='" . htmlspecialchars($row['vh_ibr_costo']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_ibr_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm onclick='deleteIbrEntry(" . $row['id'] . ")''
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

<!--  Ibr Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#ibrTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[4, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [5], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit IBR Modal -->

<div class="modal fade" id="editIbrModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Vacunacion IBR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editIbrForm" action="process_ibr.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" id="edit_dosis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Aftosa JS -->

<script>
    // Handle edit button click
    $('.edit-ibr').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const tagid = button.data('tagid');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_tagid').val(tagid);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditIbr').click(function() {
        const form = $('#editIbrForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_ibr.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editIbrModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });

// Function to delete concentrado entries
function deleteIbrEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_ibr.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>

<!-- CBR Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_cbr = "SELECT c.*, v.nombre
                      FROM vh_cbr c
                      LEFT JOIN vacuno v ON c.vh_cbr_tagid = v.tagid
                      WHERE c.vh_cbr_tagid = '$tagid'";
} else {
    $baseQuery_cbr = "SELECT c.*, v.nombre
                      FROM vh_cbr c
                      LEFT JOIN vacuno v ON c.vh_cbr_tagid = v.tagid";
}
$result_cbr = $conn->query($baseQuery_cbr);
?>
<!-- Registros de CBR -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">REGISTROS VACUNACION CBR</h4>
</div>
<!-- CBR: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <h5 class="container">Control CBR</h5>
    <!-- Add New CBR Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addCbrForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW CBR FORM -->

    <div class="collapse mb-3" id="addCbrForm">
        <div class="card card-body">
            <form id="cbrForm" action="process_cbr.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- CBR DataTable -->

    <div class="table-responsive">
        <table id="cbrTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Producto</th>
                    <th>Dosis</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_cbr->num_rows > 0) {
                    while($row = $result_cbr->fetch_assoc()) {
                        $valor_total = floatval($row['vh_cbr_costo']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_cbr_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_cbr_producto'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_cbr_dosis']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_cbr_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_cbr_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-Cbr'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editCbrModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_cbr_tagid']) . "'
                                            data-dosis='" . htmlspecialchars($row['vh_cbr_dosis']) . "'
                                            data-costo='" . htmlspecialchars($row['vh_cbr_costo']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_cbr_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm onclick='deleteCbrEntry(" . $row['id'] . ")''
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

<!--  CBR Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#cbrTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[4, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [5], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit CBR Modal -->

<div class="modal fade" id="editCbrModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Vacunacion CBR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCbrForm" action="process_cbr.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" id="edit_dosis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Aftosa JS -->

<script>
    // Handle edit button click
    $('.edit-Cbr').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const tagid = button.data('tagid');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_tagid').val(tagid);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditCbr').click(function() {
        const form = $('#editCbrForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_cbr.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editCbrModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });

// Function to delete concentrado entries
function deleteCbrEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_cbr.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>


<!-- BRUCELOSIS Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_brucelosis = "SELECT b.*, v.nombre
                      FROM vh_brucelosis b
                      LEFT JOIN vacuno v ON b.vh_brucelosis_tagid = v.tagid
                      WHERE b.vh_brucelosis_tagid = '$tagid'";
} else {
    $baseQuery_brucelosis = "SELECT b.*, v.nombre
                      FROM vh_brucelosis b
                      LEFT JOIN vacuno v ON b.vh_brucelosis_tagid = v.tagid";
}
$result_brucelosis = $conn->query($baseQuery_brucelosis);
?>
<!-- Registros de BRUCELOSIS -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">REGISTROS VACUNACION BRUCELOSIS</h4>
</div>
<!-- BRUCELOSIS: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <h5 class="container">Control Brucelosis</h5>
    <!-- Add New BRUCELOSIS Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addBrucelosisForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW BRUCELOSIS FORM -->

    <div class="collapse mb-3" id="addBrucelosisForm">
        <div class="card card-body">
            <form id="brucelosisForm" action="process_brucelosis.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- BRUCELOSIS DataTable -->

    <div class="table-responsive">
        <table id="brucelosisTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Producto</th>
                    <th>Dosis</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_brucelosis->num_rows > 0) {
                    while($row = $result_brucelosis->fetch_assoc()) {
                        $valor_total = floatval($row['vh_brucelosis_costo']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_brucelosis_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_brucelosis_producto'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_brucelosis_dosis']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_brucelosis_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_brucelosis_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-brucelosis'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editBrucelosisModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_brucelosis_tagid']) . "'
                                            data-dosis='" . htmlspecialchars($row['vh_brucelosis_dosis']) . "'
                                            data-costo='" . htmlspecialchars($row['vh_brucelosis_costo']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_brucelosis_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm onclick='editBrucelosisEntry(" . $row['id'] . ")''
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

<!--  BRUCELOSIS Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#brucelosisTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[4, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [5], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit BRUCELOSIS Modal -->

<div class="modal fade" id="editBrucelosisModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Vacunacion BRUCELOSIS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editBrucelosisForm" action="process_brucelosis.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" id="edit_dosis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Brucelosis JS -->

<script>
    // Handle edit button click
    $('.edit-brucelosis').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const tagid = button.data('tagid');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_tagid').val(tagid);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditbrucelosis').click(function() {
        const form = $('#editBrucelosisForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_brucelosis.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editBrucelosisModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });

// Function to delete concentrado entries
function editBrucelosisEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_brucelosis.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>

<!-- CARBUNCO Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_carbunco = "SELECT c.*, v.nombre
                      FROM vh_carbunco c
                      LEFT JOIN vacuno v ON c.vh_carbunco_tagid = v.tagid
                      WHERE c.vh_carbunco_tagid = '$tagid'";
} else {
    $baseQuery_carbunco = "SELECT c.*, v.nombre
                      FROM vh_carbunco c
                      LEFT JOIN vacuno v ON c.vh_carbunco_tagid = v.tagid";
}
$result_carbunco = $conn->query($baseQuery_carbunco);
?>
<!-- Registros de CARBUNCO -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">REGISTROS VACUNACION CARBUNCO</h4>
</div>
<!-- CARBUNCO: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <h5 class="container">Control Carbunco</h5>
    <!-- Add New Carbunco Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addCarbuncoForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW Carbunco FORM -->

    <div class="collapse mb-3" id="addCarbuncoForm">
        <div class="card card-body">
            <form id="carbuncoForm" action="process_carbunco.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Carbunco DataTable -->

    <div class="table-responsive">
        <table id="carbuncoTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Producto</th>
                    <th>Dosis</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_carbunco->num_rows > 0) {
                    while($row = $result_carbunco->fetch_assoc()) {
                        $valor_total = floatval($row['vh_carbunco_costo']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_carbunco_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_carbunco_producto'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_carbunco_dosis']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_carbunco_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_carbunco_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-carbunco'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editCarbuncoModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_carbunco_tagid']) . "'
                                            data-dosis='" . htmlspecialchars($row['vh_carbunco_dosis']) . "'
                                            data-costo='" . htmlspecialchars($row['vh_carbunco_costo']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_carbunco_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm onclick='editCarbuncoEntry(" . $row['id'] . ")''
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

<!--  Carbunco Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#carbuncoTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[4, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [5], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit Carbunco Modal -->

<div class="modal fade" id="editCarbuncoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Vacunacion Carbunco</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCarbuncoForm" action="process_carbunco.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" id="edit_dosis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Carbunco JS -->

<script>
    // Handle edit button click
    $('.edit-carbunco').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const tagid = button.data('tagid');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_tagid').val(tagid);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditCarbunco').click(function() {
        const form = $('#editCarbuncoForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_carbunco.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editCarbuncoModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });

// Function delete Carbunco Table entries
function editCarbuncoEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_carbunco.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>

<!-- Garrapatas Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_garrapatas = "SELECT g.*, v.nombre
                      FROM vh_garrapatas g
                      LEFT JOIN vacuno v ON g.vh_garrapatas_tagid = v.tagid
                      WHERE g.vh_garrapatas_tagid = '$tagid'";
} else {
    $baseQuery_garrapatas = "SELECT g.*, v.nombre
                      FROM vh_garrapatas g
                      LEFT JOIN vacuno v ON g.vh_garrapatas_tagid = v.tagid";
}
$result_garrapatas = $conn->query($baseQuery_garrapatas);
?>
<!-- Registros de Garrapatas -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">REGISTROS VACUNACION GARRAPATAS</h4>
</div>
<!-- Garrapatas: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <h5 class="container">Control Garrapatas</h5>
    <!-- Add New Garrapatas Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addGarrapatasForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW Garrapatas FORM -->

    <div class="collapse mb-3" id="addGarrapatasForm">
        <div class="card card-body">
            <form id="garrapatasForm" action="process_garrapatas.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Garrapatas DataTable -->

    <div class="table-responsive">
        <table id="garrapatasTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Producto</th>
                    <th>Dosis</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_garrapatas->num_rows > 0) {
                    while($row = $result_garrapatas->fetch_assoc()) {
                        $valor_total = floatval($row['vh_garrapatas_costo']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_garrapatas_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_garrapatas_producto'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_garrapatas_dosis']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_garrapatas_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_garrapatas_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-garrapatas'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editGarrapatasModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_garrapatas_tagid']) . "'
                                            data-dosis='" . htmlspecialchars($row['vh_garrapatas_dosis']) . "'
                                            data-costo='" . htmlspecialchars($row['vh_garrapatas_costo']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_garrapatas_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm onclick='editGarrapatasEntry(" . $row['id'] . ")''
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

<!--  Garrapatas Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#garrapatasTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[4, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [5], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit Garrapatas Modal -->

<div class="modal fade" id="editGarrapatasModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Vacunacion Garrapatas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editGarrapatasForm" action="process_garrapatas.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" id="edit_dosis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Garrapatas JS -->

<script>
    // Handle edit button click
    $('.edit-garrapatas').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const tagid = button.data('tagid');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_tagid').val(tagid);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditGarrapatas').click(function() {
        const form = $('#editGarrapatasForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_garrapatas.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editGarrapatasModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });

// Function delete Garrapatas Table entries
function editGarrapatasEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_garrapatas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>


<!-- Mastitis Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_mastitis = "SELECT m.*, v.nombre
                      FROM vh_mastitis m
                      LEFT JOIN vacuno v ON m.vh_mastitis_tagid = v.tagid
                      WHERE m.vh_mastitis_tagid = '$tagid'";
} else {
    $baseQuery_mastitis = "SELECT m.*, v.nombre
                      FROM vh_mastitis m
                      LEFT JOIN vacuno v ON m.vh_mastitis_tagid = v.tagid";
}
$result_mastitis = $conn->query($baseQuery_mastitis);
?>
<!-- Registros de Mastitis -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">REGISTROS VACUNACION GARRAPATAS</h4>
</div>
<!-- Mastitis: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <h5 class="container">Control Mastitis</h5>
    <!-- Add New Mastitis Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addMastitisForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW Mastitis FORM -->

    <div class="collapse mb-3" id="addMastitisForm">
        <div class="card card-body">
            <form id="mastitisForm" action="process_mastitis.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Mastitis DataTable -->

    <div class="table-responsive">
        <table id="mastitisTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Producto</th>
                    <th>Dosis</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_mastitis->num_rows > 0) {
                    while($row = $result_mastitis->fetch_assoc()) {
                        $valor_total = floatval($row['vh_mastitis_costo']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_mastitis_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_mastitis_producto'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_mastitis_dosis']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_mastitis_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_mastitis_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-mastitis'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editMastitisModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_mastitis_tagid']) . "'
                                            data-dosis='" . htmlspecialchars($row['vh_mastitis_dosis']) . "'
                                            data-costo='" . htmlspecialchars($row['vh_mastitis_costo']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_mastitis_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm onclick='editMastitisEntry(" . $row['id'] . ")''
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

<!--  Mastitis Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#mastitisTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[4, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [5], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit Mastitis Modal -->

<div class="modal fade" id="editMastitisModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Vacunacion Mastitis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editMastitisForm" action="process_mastitis.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" id="edit_dosis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Mastitis JS -->

<script>
    // Handle edit button click
    $('.edit-mastitis').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const tagid = button.data('tagid');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_tagid').val(tagid);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditMastitis').click(function() {
        const form = $('#editMastitisForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_mastitis.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editMastitisModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });

// Function delete Mastitis Table entries
function editMastitisEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_mastitis.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>
<!-- Lombrices Table Section -->
<?php
// First, update the query to include the JOIN
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_lombrices = "SELECT l.*, v.nombre
                      FROM vh_lombrices l
                      LEFT JOIN vacuno v ON l.vh_lombrices_tagid = v.tagid
                      WHERE l.vh_lombrices_tagid = '$tagid'";
} else {
    $baseQuery_lombrices = "SELECT l.*, v.nombre
                      FROM vh_lombrices l
                      LEFT JOIN vacuno v ON l.vh_lombrices_tagid = v.tagid";
}
$result_lombrices = $conn->query($baseQuery_lombrices);
?>
<!-- Registros de Lombrices -->
<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h4 class="container text-center">REGISTROS VACUNACION LOMBRICES</h4>
</div>
<!-- Lombrices: Nuevo Registro Form -->
<div class="container table-section" style="display: block;">

    <h5 class="container">Control Lombrices</h5>
    <!-- Add New Lombrices Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addLombricesForm">
        <i class="fas fa-plus"></i> Registrar
    </button>

    <!-- NEW Lombrices FORM -->

    <div class="collapse mb-3" id="addLombricesForm">
        <div class="card card-body">
            <form id="lombricesForm" action="process_lombrices.php" method="POST">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Lombrices DataTable -->

    <div class="table-responsive">
        <table id="lombricesTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tag ID</th>
                    <th>Producto</th>
                    <th>Dosis</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_lombrices->num_rows > 0) {
                    while($row = $result_lombrices->fetch_assoc()) {
                        $valor_total = floatval($row['vh_lombrices_costo']);

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_lombrices_tagid']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_lombrices_producto'] ?? 'N/A') . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_lombrices_dosis']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_lombrices_costo']) . "</td>";
                        echo "<td style='text-align: center;'>" . htmlspecialchars($row['vh_lombrices_fecha']) . "</td>";
                        echo "<td style='text-align: center;'>
                                <div class='btn-group' role='group'>
                                    <button class='btn btn-success text-center btn-sm edit-lombrices'
                                            data-bs-toggle='modal'
                                            data-bs-target='#editLombricesModal'
                                            data-id='" . htmlspecialchars($row['id']) . "'
                                            data-tagid='" . htmlspecialchars($row['vh_lombrices_tagid']) . "'
                                            data-dosis='" . htmlspecialchars($row['vh_lombrices_dosis']) . "'
                                            data-costo='" . htmlspecialchars($row['vh_lombrices_costo']) . "'
                                            data-fecha='" . htmlspecialchars($row['vh_lombrices_fecha']) . "'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm onclick='editLombricesEntry(" . $row['id'] . ")''
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

<!--  Lombrices Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#lombricesTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[4, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: true,

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2, 3], // Peso, Precio, Valor Total columns
                render: function(data, type, row) {
                    if (type === 'display') {
                        return parseFloat(data).toLocaleString('es-ES', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    return data;
                }
            },
            {
                targets: [4], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [5], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
</div>
<!-- Edit Lombrices Modal -->

<div class="modal fade" id="editLombricesModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Vacunacion Lombrices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editLombricesForm" action="process_lombrices.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="dosis" id="edit_dosis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Lombrices JS -->

<script>
    // Handle edit button click
    $('.edit-lombrices').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const tagid = button.data('tagid');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_tagid').val(tagid);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle save changes
    $('#saveEditLombrices').click(function() {
        const form = $('#editLombricesForm');

        // Validate form
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Show loading state
        const saveButton = $(this);
        const originalText = saveButton.text();
        saveButton.prop('disabled', true).text('Guardando...');

        // Send AJAX request
        $.ajax({
            url: 'process_lombrices.php',
            type: 'POST',
            data: form.serialize(),
            action: 'update',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response);
                try {
                    if (response.success) {
                        $('#editLombricesModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error al actualizar: ' + (response.error || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error al procesar la respuesta del servidor');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr, status, error});
                alert('Error al procesar la solicitud: ' + error);
            },
            complete: function() {
                // Reset button state
                saveButton.prop('disabled', false).text(originalText);
            }
        });
    });

// Function delete Lombrices Table entries
function editLombricesEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_lombrices.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


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
                        text: 'Precio'
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

<h3  class="container mt-4 text-white" class="collapse" id="section-historial-reproduccion-vacuno">
REGISTROS DE REPRODUCCION
</h3>

<!-- Inseminacion Table Section -->
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS INSEMINACIONES</h4>
</div>
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

<!-- Edit Inseminacion Modal -->
<div class="modal fade" id="editInseminacionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Inseminacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editInseminacionForm" action="process_inseminacion.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_inseminacion_id">
                    <input type="hidden" name="tagid" id="edit_inseminacion_tagid">
                    <div class="mb-3">
                        <label class="form-label">Numero</label>
                        <input type="number" step="0.01" class="form-control" name="numero" id="edit_inseminacion_numero" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_inseminacion_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_inseminacion_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Inseminaciones</h5>

    <!-- Add New Inseminacion Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addInseminacionForm">
        <i class="fas fa-plus"></i> Registrar
    </button>
    <div class="collapse mb-3" id="addInseminacionForm">
    <div class="card card-body">
        <form id="inseminacionForm" action="process_inseminacion.php" method="POST">
        <input type="hidden" name="action" value="insert">
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
                    <label class="form-label">Numero</label>
                    <input type="number" step="0.01" class="form-control" name="numero" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo</label>
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
      <table id="inseminacionTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Numero</th>
                  <th style="text-align: center;">Costo</th>
                  <th style="text-align: center;">Acciones</th>

              </tr>
          </thead>
          <tbody>
              <?php
              $sql = "SELECT * FROM vh_inseminacion WHERE vh_inseminacion_tagid = '$tagid' ORDER BY vh_inseminacion_fecha DESC";
              $result = $conn->query($sql);
              $total_costo_inseminacion = 0;

              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $total += $row['vh_inseminacion_costo'];
                      echo "<tr>
                              <td style='text-align: center;'>" . date('d/m/Y', strtotime($row['vh_inseminacion_fecha'])) . "</td>
                              <td style='text-align: center;'>" . number_format($row['vh_inseminacion_numero'], 2) . "</td>
                              <td style='text-align: center;'>$" . number_format($row['vh_inseminacion_costo'], 2) . "</td>
                              <td style='text-align: center;'>


                                  <div class='d-flex text-center justify-content-center gap-2'>
                                      <button class='btn btn-sm btn-success' onclick='openEditInseminacionModal(" .
                                          $row['id'] . ", \"" .
                                          htmlspecialchars($row['vh_inseminacion_tagid'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_inseminacion_numero'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_inseminacion_costo'], ENT_QUOTES) . "\", \"" .
                                          $row['vh_inseminacion_fecha'] . "\")'>
                                          <i class='fas fa-edit'></i>
                                      </button>
                                      <button class='btn btn-sm btn-danger' onclick='deleteInseminacionEntry(" . $row['id'] . ")'>
                                          <i class='fas fa-trash'></i>
                                      </button>
                                  </div>
                              </td>
                            </tr>";
                  }
              }
              ?>
          </tbody>
      </table>
      <script>
$(document).ready(function() {
    $('#inseminacionTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[0, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: {
            details: {
                type: 'column',
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            },
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [5], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [3], // Acciones column
                orderable: false,
                searchable: false
            }
        ],

        // Responsive priority settings
        responsivePriority: [1, 2, 3]
    });
});
</script>
    </div>
</div>

<script>
// Function to open edit modal for Inseminacion entries
function openEditInseminacionModal(id, tagid, numero, costo, fecha) {
    document.getElementById('edit_inseminacion_id').value = id;
    document.getElementById('edit_inseminacion_tagid').value = tagid;
    document.getElementById('edit_inseminacion_numero').value = numero;
    document.getElementById('edit_inseminacion_costo').value = costo;
    document.getElementById('edit_inseminacion_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editInseminacionModal'));
    editModal.show();
}

// Function to delete Inseminacion entries
function deleteInseminacionEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_inseminacion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>
<!-- Gestacion Table Section -->
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS GESTACIONES</h4>
</div>
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

<!-- Edit Gestacion Modal -->
<div class="modal fade" id="editGestacionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Gestacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editGestacionForm" action="process_gestacion.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_gestacion_id">
                    <input type="hidden" name="tagid" id="edit_gestacion_tagid">
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="numero" id="edit_gestacion_numero" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" name="costo" id="edit_gestacion_costo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_gestacion_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Gestaciones</h5>

    <!-- Add New Gestacion Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addGestacionForm">
        <i class="fas fa-plus"></i> Registrar
    </button>
    <div class="collapse mb-3" id="addGestacionForm">
    <div class="card card-body">
        <form id="gestacionForm" action="process_gestacion.php" method="POST">
        <input type="hidden" name="action" value="insert">
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
                    <label class="form-label">Numero</label>
                    <input type="number" step="0.01" class="form-control" name="numero" required>
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
      <table id="gestacionTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Numero</th>
                  <th style="text-align: center;">Acciones</th>
              </tr>

          </thead>
          <tbody>
              <?php
              $sql = "SELECT * FROM vh_gestacion WHERE vh_gestacion_tagid = '$tagid' ORDER BY vh_gestacion_fecha DESC";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>
                              <td style='text-align: center;'>" . date('d/m/Y', strtotime($row['vh_gestacion_fecha'])) . "</td>
                              <td style='text-align: center;'>" . number_format($row['vh_gestacion_numero'], 2) . "</td>
                              <td style='text-align: center;'>
                                  <div class='d-flex text-center justify-content-center gap-2'>
                                      <button class='btn btn-sm btn-success' onclick='openEditGestacionModal(" .
                                          $row['id'] . ", \"" .
                                          htmlspecialchars($row['vh_gestacion_tagid'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_gestacion_numero'], ENT_QUOTES) . "\", \"" .
                                          $row['vh_gestacion_fecha'] . "\")'>
                                          <i class='fas fa-edit'></i>
                                      </button>
                                      <button class='btn btn-sm btn-danger' onclick='deleteGestacionEntry(" . $row['id'] . ")'>
                                          <i class='fas fa-trash'></i>
                                      </button>
                                  </div>
                              </td>
                            </tr>";
                  }
              }
              ?>
          </tbody>
      </table>
      <script>
$(document).ready(function() {
    $('#gestacionTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[0, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: {
            details: {
                type: 'column',
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            },
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [2], // Acciones column
                orderable: false,
                searchable: false
            }
        ],

        // Responsive priority settings
        responsivePriority: [1, 2, 3]
    });
});
</script>
    </div>
</div>

<script>
// Function to open edit modal for Gestacion entries
function openEditGestacionModal(id, tagid, numero, fecha) {
    document.getElementById('edit_gestacion_id').value = id;
    document.getElementById('edit_gestacion_tagid').value = tagid;
    document.getElementById('edit_gestacion_numero').value = numero;
    document.getElementById('edit_gestacion_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editGestacionModal'));
    editModal.show();
}

// Function to delete Gestacion entries
function deleteGestacionEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_gestacion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>

<!-- Parto Table Section -->
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS PARTOS</h4>
</div>
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

<!-- Edit Parto Modal -->
<div class="modal fade" id="editPartoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Parto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPartoForm" action="process_parto.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_parto_id">
                    <input type="hidden" name="tagid" id="edit_parto_tagid">
                    <div class="mb-3">
                        <label class="form-label">Dosis</label>
                        <input type="number" step="0.01" class="form-control" name="numero" id="edit_parto_numero" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_parto_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Partos</h5>

    <!-- Add New Parto Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addPartoForm">
        <i class="fas fa-plus"></i> Registrar
    </button>
    <div class="collapse mb-3" id="addPartoForm">
    <div class="card card-body">
        <form id="partoForm" action="process_parto.php" method="POST">
        <input type="hidden" name="action" value="insert">
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
                    <label class="form-label">Numero</label>
                    <input type="number" step="0.01" class="form-control" name="numero" required>
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
      <table id="partoTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Numero</th>
                  <th style="text-align: center;">Acciones</th>
              </tr>
          </thead>
          <tbody>
              <?php
              $sql = "SELECT * FROM vh_parto WHERE vh_parto_tagid = '$tagid' ORDER BY vh_parto_fecha DESC";
              $result = $conn->query($sql);


              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>
                              <td style='text-align: center;'>" . date('d/m/Y', strtotime($row['vh_parto_fecha'])) . "</td>
                              <td style='text-align: center;'>" . number_format($row['vh_parto_numero'], 2) . "</td>
                              <td style='text-align: center;'>
                                  <div class='d-flex justify-content-center gap-2'>
                                      <button class='btn btn-sm btn-success' onclick='openEditPartoModal(" .
                                          $row['id'] . ", \"" .
                                          htmlspecialchars($row['vh_parto_tagid'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_parto_numero'], ENT_QUOTES) . "\", \"" .
                                          $row['vh_parto_fecha'] . "\")'>
                                          <i class='fas fa-edit'></i>
                                      </button>
                                      <button class='btn btn-sm btn-danger' onclick='deletePartoEntry(" . $row['id'] . ")'>
                                          <i class='fas fa-trash'></i>
                                      </button>
                                  </div>
                              </td>
                            </tr>";
                  }
              }
              ?>
          </tbody>
      </table>
      <script>
$(document).ready(function() {
    $('#partoTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[0, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: {
            details: {
                type: 'column',
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            },
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [0], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [2], // Acciones column
                orderable: false,
                searchable: false
            }
        ],

        // Responsive priority settings
        responsivePriority: [1, 2, 3]
    });
});
</script>
    </div>
</div>

<script>
// Function to open edit modal for Parto entries
function openEditPartoModal(id, tagid, numero, fecha) {
    document.getElementById('edit_parto_id').value = id;
    document.getElementById('edit_parto_tagid').value = tagid;
    document.getElementById('edit_parto_numero').value = numero;
    document.getElementById('edit_parto_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editPartoModal'));
    editModal.show();
}

// Function to delete Parto entries
function deletePartoEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_parto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>

<!-- Aborto Table Section -->
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS ABORTOS</h4>
</div>
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

<!-- Edit Aborto Modal -->
<div class="modal fade" id="editAbortoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Aborto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAbortoForm" action="process_aborto.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_aborto_id">
                    <input type="hidden" name="tagid" id="edit_aborto_tagid">
                    <div class="mb-3">
                        <label class="form-label">Causa</label>
                        <input type="text" class="form-control" name="causa" id="edit_aborto_causa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_aborto_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Abortos</h5>

    <!-- Add New Aborto Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addAbortoForm">
        <i class="fas fa-plus"></i> Registrar
    </button>
    <div class="collapse mb-3" id="addAbortoForm">
    <div class="card card-body">
        <form id="abortoForm" action="process_aborto.php" method="POST">
        <input type="hidden" name="action" value="insert">
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
                    <label class="form-label">Causa</label>
                    <input type="text" class="form-control" name="causa" required>
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
      <table id="abortoTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Causa</th>
                  <th style="text-align: center;">Acciones</th>
              </tr>
          </thead>
          <tbody>
              <?php
              $sql = "SELECT * FROM vh_aborto WHERE vh_aborto_tagid = '$tagid' ORDER BY vh_aborto_fecha DESC";
              $result = $conn->query($sql);


              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>
                              <td style='text-align: center;'>" . date('d/m/Y', strtotime($row['vh_aborto_fecha'])) . "</td>
                              <td style='text-align: center;'>" . htmlspecialchars($row['vh_aborto_causa']) . "</td>
                              <td style='text-align: center;'>
                                  <div class='d-flex justify-content-center gap-2'>
                                      <button class='btn btn-sm btn-success' onclick='openEditAbortoModal(" .
                                          $row['id'] . ", \"" .
                                          htmlspecialchars($row['vh_aborto_tagid'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_aborto_causa'], ENT_QUOTES) . "\", \"" .
                                          $row['vh_aborto_fecha'] . "\")'>
                                          <i class='fas fa-edit'></i>
                                      </button>
                                      <button class='btn btn-sm btn-danger' onclick='deleteAbortoEntry(" . $row['id'] . ")'>
                                          <i class='fas fa-trash'></i>
                                      </button>
                                  </div>
                              </td>
                            </tr>";
                  }
              }
              ?>
          </tbody>
      </table>
      <script>
$(document).ready(function() {
    $('#abortoTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[0, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: {
            details: {
                type: 'column',
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            },
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [0], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [2], // Acciones column
                orderable: false,
                searchable: false
            }
        ],

        // Responsive priority settings
        responsivePriority: [1, 2, 3]
    });
});
</script>
    </div>
</div>

<script>
// Function to open edit modal for Aborto entries
function openEditAbortoModal(id, tagid, causa, fecha) {
    document.getElementById('edit_aborto_id').value = id;
    document.getElementById('edit_aborto_tagid').value = tagid;
    document.getElementById('edit_aborto_causa').value = causa
    document.getElementById('edit_aborto_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editAbortoModal'));
    editModal.show();
}

// Function to delete Aborto entries
function deleteAbortoEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_aborto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>

<h3  class="container mt-4 text-white" class="collapse" id="section-historial-otros-vacuno">
OTROS REGISTROS
</h3>

<!-- Venta Table Section -->
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS VENTAS</h4>
</div>
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

<!-- Edit Venta Modal -->
<div class="modal fade" id="editVentaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editVentaForm" action="process_venta.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_venta_id">
                    <input type="hidden" name="tagid" id="edit_venta_tagid">
                    <div class="mb-3">
                        <label class="form-label">Peso</label>
                        <input type="number" step="0.01" class="form-control" name="peso" id="edit_venta_peso" required>
                    </div>			<div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" name="precio" id="edit_venta_precio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_venta_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Ventas</h5>

    <!-- Add New Venta Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addVentaForm">
        <i class="fas fa-plus"></i> Registrar
    </button>
    <div class="collapse mb-3" id="addVentaForm">
    <div class="card card-body">
        <form id="ventaForm" action="process_venta.php" method="POST">
        <input type="hidden" name="action" value="insert">
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
                    <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_venta_fecha" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Peso</label>
                        <input type="number" step="0.01" class="form-control" name="peso" id="edit_venta_peso" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Precio</label>
                    <input type="number" step="0.01" class="form-control" name="precio" id="edit_venta_precio" required>
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
      <table id="ventaTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Peso</th>
		              <th style="text-align: center;">Precio</th>
                  <th style="text-align: center;">Acciones</th>

              </tr>
          </thead>
          <tbody>
              <?php
              $sql = "SELECT * FROM vh_venta WHERE vh_venta_tagid = '$tagid' ORDER BY vh_venta_fecha DESC";
              $result = $conn->query($sql);


              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>
                              	<td style='text-align: center;'>" . date('d/m/Y', strtotime($row['vh_venta_fecha'])) . "</td>
                              	<td style='text-align: center;'>" . number_format($row['vh_venta_peso'], 2) . "</td>
				                <td style='text-align: center;'>" . number_format($row['vh_venta_precio'], 2) . "</td>
                                <td style='text-align: center;'>
                                  <div class='d-flex text-center justify-content-center gap-2'>
                                      <button class='btn btn-sm btn-success' onclick='openEditVentaModal(" .
                                          $row['id'] . ", \"" .
                                          htmlspecialchars($row['vh_venta_tagid'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_venta_peso'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_venta_precio'], ENT_QUOTES) . "\", \"" .
                                          $row['vh_venta_fecha'] . "\")'>
                                          <i class='fas fa-edit'></i>
                                      </button>
                                      <button class='btn btn-sm btn-danger' onclick='deleteVentaEntry(" . $row['id'] . ")'>
                                          <i class='fas fa-trash'></i>
                                      </button>
                                  </div>
                              </td>
                            </tr>";
                  }
              }
              ?>
          </tbody>
      </table>
      <script>
$(document).ready(function() {
    $('#ventaTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[0, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: {
            details: {
                type: 'column',
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            },
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [0], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [3], // Acciones column
                orderable: false,
                searchable: false
            }
        ],

        // Responsive priority settings
        responsivePriority: [1, 2, 3]
    });
});
</script>
    </div>
</div>

<script>
// Function to open edit modal for Venta entries
function openEditVentaModal(id, tagid, peso, precio, fecha) {
    document.getElementById('edit_venta_id').value = id;
    document.getElementById('edit_venta_tagid').value = tagid;
    document.getElementById('edit_venta_peso').value = peso;
    document.getElementById('edit_venta_precio').value = precio;
    document.getElementById('edit_venta_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editVentaModal'));
    editModal.show();
}

// Function to delete Venta entries
function deleteVentaEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_venta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>

<!-- Destete Table Section -->
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS DESTETE</h4>
</div>

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

<!-- Edit Destete Modal -->
<div class="modal fade" id="editDesteteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Destete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editDesteteForm" action="process_destete.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_destete_id">
                    <input type="hidden" name="tagid" id="edit_destete_tagid">
                    <div class="mb-3">
                        <label class="form-label">Peso</label>
                        <input type="number" step="0.01" class="form-control" name="peso" id="edit_destete_peso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_destete_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Destetes</h5>

    <!-- Add New Destete Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addDesteteForm">
        <i class="fas fa-plus"></i> Registrar
    </button>
    <div class="collapse mb-3" id="addDesteteForm">
    <div class="card card-body">
        <form id="desteteForm" action="process_destete.php" method="POST">
        <input type="hidden" name="action" value="insert">
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
                    <label class="form-label">Peso</label>
                        <input type="number" step="0.01" class="form-control" name="peso" id="edit_destete_peso" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" id="edit_destete_fecha" required>
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
      <table id="desteteTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Peso</th>
                  <th style="text-align: center;">Acciones</th>
              </tr>
          </thead>
          <tbody>
              <?php
              $sql = "SELECT * FROM vh_destete WHERE vh_destete_tagid = '$tagid' ORDER BY vh_destete_fecha DESC";
              $result = $conn->query($sql);


              if ($result_destete->num_rows > 0) {
                  while($row = $result_destete->fetch_assoc()) {
                      echo "<tr>
                              	<td style='text-align: center;'>" . date('d/m/Y', strtotime($row['vh_destete_fecha'])) . "</td>
                              	<td style='text-align: center;'>" . number_format($row['vh_destete_peso'], 2) . "</td>
                              <td style='text-align: center;'>
                                  <div class='d-flex text-center justify-content-center gap-2'>
                                      <button class='btn btn-sm btn-success' onclick='openEditDesteteModal(" .
                                          $row['id'] . ", \"" .
                                          htmlspecialchars($row['vh_destete_tagid'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_destete_peso'], ENT_QUOTES) . "\", \"" .
                                          $row['vh_destete_fecha'] . "\")'>
                                          <i class='fas fa-edit'></i>
                                      </button>
                                      <button class='btn btn-sm btn-danger' onclick='deleteDesteteEntry(" . $row['id'] . ")'>
                                          <i class='fas fa-trash'></i>
                                      </button>
                                  </div>
                              </td>
                            </tr>";
                  }
              }
              ?>
          </tbody>
      </table>
      <script>
$(document).ready(function() {
    $('#desteteTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[0, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: {
            details: {
                type: 'column',
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            },
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [0], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [2], // Acciones column
                orderable: false,
                searchable: false
            }
        ],

        // Responsive priority settings
        responsivePriority: [1, 2, 3]
    });
});
</script>
    </div>
</div>

<script>
// Function to open edit modal for Destete entries
function openEditDesteteModal(id, tagid, peso, fecha) {
    document.getElementById('edit_destete_id').value = id;
    document.getElementById('edit_destete_tagid').value = tagid;
    document.getElementById('edit_destete_peso').value = peso;
    document.getElementById('edit_destete_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editDesteteModal'));
    editModal.show();
}

// Function to delete Destete entries
function deleteDesteteEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_destete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
</script>

<!-- Descarte Table Section -->
<div class="container mt-4">
    <h4 id="section-registros-concentrado" style="text-align: center;">REGISTROS DESCARTE</h4>
</div>
<!-- Descarte Table Section -->
<?php
// Build the base query for Descarte
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tagid = $conn->real_escape_string($_GET['search']);
    $baseQuery_descarte = "SELECT * FROM vh_descarte WHERE vh_descarte_tagid = '$tagid'";
} else {
    $baseQuery_descarte = "SELECT * FROM vh_descarte";
}
$result_descarte = $conn->query($baseQuery_descarte);
?>

<!-- Edit Descarte Modal -->
<div class="modal fade" id="editDescarteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Descartes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editDescarteForm" action="process_descarte.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_descarte_id">
                    <input type="hidden" name="tagid" id="edit_descarte_tagid">
                    <div class="mb-3">
                        <label class="form-label">Peso</label>
                        <input type="number" step="0.01" class="form-control" name="peso" id="edit_descarte_peso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="edit_descarte_fecha" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mb-4" style="display:block; justify-content: center; align-items: center;">
    <h5 class="container">Control Descartes</h5>

    <!-- Add New Descarte Form -->
    <button class="btn btn-success mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#addDescarteForm">
        <i class="fas fa-plus"></i> Registrar
    </button>
    <div class="collapse mb-3" id="addDescarteForm">
    <div class="card card-body">
        <form id="descarteForm" action="process_descarte.php" method="POST">
        <input type="hidden" name="action" value="insert">
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
                    <label class="form-label">Peso</label>
                        <input type="number" step="0.01" class="form-control" name="peso" id="edit_descarte_peso" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" id="edit_descarte_fecha" required>
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
      <table id="descarteTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Peso</th>
                  <th style="text-align: center;">Acciones</th>
              </tr>
          </thead>


          <tbody>
              <?php
              $sql = "SELECT * FROM vh_descarte WHERE vh_descarte_tagid = '$tagid' ORDER BY vh_descarte_fecha DESC";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>
                              	<td style='text-align: center;'>" . date('d/m/Y', strtotime($row['vh_descarte_fecha'])) . "</td>
                              	<td style='text-align: center;'>" . number_format($row['vh_descarte_peso'], 2) . "</td>
                              <td style='text-align: center;'>
                                  <div class='d-flex text-center justify-content-center gap-2'>
                                      <button class='btn btn-sm btn-success' onclick='openEditDescarteModal(" .
                                          $row['id'] . ", \"" .
                                          htmlspecialchars($row['vh_descarte_tagid'], ENT_QUOTES) . "\", \"" .
                                          htmlspecialchars($row['vh_descarte_peso'], ENT_QUOTES) . "\", \"" .
                                          $row['vh_descarte_fecha'] . "\")'>
                                          <i class='fas fa-edit'></i>
                                      </button>
                                      <button class='btn btn-sm btn-danger' onclick='deleteDescarteEntry(" . $row['id'] . ")'>
                                          <i class='fas fa-trash'></i>
                                      </button>
                                  </div>
                              </td>
                            </tr>";
                  }
              }
              ?>
          </tbody>
      </table>
      <script>
$(document).ready(function() {
    $('#descarteTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[0, 'desc']],

        // Spanish language
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },

        // Enable responsive features
        responsive: {
            details: {
                type: 'column',
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            },
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },

        // Configure DOM layout and buttons
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12 col-md-6"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],

        // Column specific settings
        columnDefs: [
            {
                targets: [0], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        return new Date(data).toLocaleDateString('es-ES');
                    }
                    return data;
                }
            },
            {
                targets: [2], // Acciones column
                orderable: false,
                searchable: false
            }
        ],

        // Responsive priority settings
        responsivePriority: [1, 2, 3]
    });
});
</script>
    </div>
</div>

<script>
// Function to open edit modal for Descarte entries
function openEditDescarteModal(id, tagid, peso, fecha) {
    document.getElementById('edit_descarte_id').value = id;
    document.getElementById('edit_descarte_tagid').value = tagid;
    document.getElementById('edit_descarte_peso').value = peso;
    document.getElementById('edit_descarte_fecha').value = fecha;

    var editModal = new bootstrap.Modal(document.getElementById('editDescarteModal'));
    editModal.show();
}

// Function to delete Descarte entries
function deleteDescarteEntry(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        fetch('process_descarte.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=delete&id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el registro');
            }
        });
    }
}
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

<script>
// Back to top functionality
window.onscroll = function() {
    const backToTopButton = document.getElementById("backToTop");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        backToTopButton.style.display = "flex";
    } else {
        backToTopButton.style.display = "none";
    }
};

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Optional: Add scroll offset adjustment for fixed header
document.addEventListener('DOMContentLoaded', function() {
    // Adjust scroll position for anchor links
    if (window.location.hash) {
        const header = document.querySelector('header');
        const headerHeight = header ? header.offsetHeight : 0;

        setTimeout(function() {
            window.scrollTo({
                top: window.pageYOffset - headerHeight - 20,
                behavior: 'smooth'
            });
        }, 1);
    }
});
</script>

<!-- Back to top button -->
<button id="backToTop" class="back-to-top" onclick="scrollToTop()" title="Volver arriba">
    <div class="arrow-up"><i class="fa-solid fa-arrow-up"></i></div>
</button>


<script>
window.onscroll = function() {
    const backToTopButton = document.getElementById("backToTop");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        backToTopButton.style.display = "flex";
    } else {
        backToTopButton.style.display = "none";
    }
};

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
</script>