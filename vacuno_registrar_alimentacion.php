<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registros Alimentacion</title>
<!-- Link to the Favicon -->
<link rel="icon" href="images/Ganagram_icono.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!--Bootstrap 5 Css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


<!-- Include Chart.js and Chart.js DataLabels Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

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

<!-- Custom -->
<link rel="stylesheet" href="./vacuno.css">

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
    <button class="btn btn-outline-secondary mb-3" onclick="window.location.href='./inventario_vacuno.php'" data-tooltip="Poblacion">
        <img src="./images/vaca.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" onclick="window.location.href='./vacuno_registrar_pesaje_animal.php'" data-tooltip="Pesaje Carne">
        <img src="./images/carne.png" alt="Pesaje Carne" class="nav-icon">
    </button>
    
    <button class="btn btn-outline-secondary mb-3" onclick="window.location.href='./vacuno_registrar_pesaje_leche.php'" data-tooltip="Pesaje Leche">
        <img src="./images/leche-cantaro.png" alt="Pesajes Leche" class="nav-icon">
    </button>
    
    <button class="icon-button" type="button" data-bs-toggle="collapse" data-tooltip="Alimentacion">
        <img src="./images/harina-de-trigo.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" onclick="window.location.href='./vacuno_registrar_vacunacion.php'" data-tooltip="Salud">
        <img src="./images/proteger.png" alt="Salud" class="nav-icon">
    </button>
       
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#section-inventario-reproduccion-vacuno" data-tooltip="Reproducion">
        <img src="./images/el-embarazo.png" alt="Razas" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#section-inventario-otros-vacuno" data-tooltip="Otros">
        <img src="./images/bolsa-de-dinero.png" alt="Razas" class="nav-icon">
    </button>
</div>

<!-- Add back button before the header container -->
    
<a href="./inventario_vacuno.php" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a>   

<?php
// REGISTROS ALIMENTACION
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_concentrado WHERE vh_concentrado_tagid = ? ORDER BY vh_concentrado_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_concentrado ORDER BY vh_concentrado_fecha ASC");
        $stmt->execute();
    }
    
    $concentradoData = [];
    $concentradoFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process concentrado data
    $concentradoData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($concentradoData as $row) {
        $date = new DateTime($row['vh_concentrado_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_concentrado_racion']);
        $concentradoFechaLabels[] = $row['vh_concentrado_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($concentradoFechaLabels), null);
    foreach ($concentradoFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyWeights[$month])) {
            $monthlyData[$index] = end($monthlyWeights[$month]);
        }
    }

    // Calculate regression
    $x = [];
    $y = [];
    $n = 0;

    foreach ($monthlyData as $index => $weight) {
        if ($weight !== null) {
            $x[] = $n;
            $y[] = $weight;
            $n++;
        }
    }

    if (count($x) > 1) {
        $x_mean = array_sum($x) / count($x);
        $y_mean = array_sum($y) / count($y);

        $numerator = 0;
        $denominator = 0;

        for ($i = 0; $i < count($x); $i++) {
            $numerator += ($x[$i] - $x_mean) * ($y[$i] - $y_mean);
            $denominator += pow($x[$i] - $x_mean, 2);
        }

        $slope = $denominator != 0 ? $numerator / $denominator : 0;
        $y_intercept = $y_mean - ($slope * $x_mean);

        $regressionLine = array_fill(0, count($monthlyData), null);
        $point_count = 0;

        foreach ($monthlyData as $index => $weight) {
            if ($weight !== null) {
                $regressionLine[$index] = $y_intercept + ($slope * $point_count);
                $point_count++;
            }
        }
    }

    // Calculate monthly prices
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyPrices = [];
    $monthlyPriceData = array_fill(0, count($concentradoFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_concentrado_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_concentrado_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($concentradoFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($concentradoFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_concentrado_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_concentrado_racion']) * floatval($row['vh_concentrado_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($concentradoFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyValues[$month]) && $monthlyValues[$month]['count'] > 0) {
            $monthlyValueData[$index] = $monthlyValues[$month]['sum'] / $monthlyValues[$month]['count'];
        }
    }
  }
  catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

?>

<!-- Concentrado Table Section -->
<?php
    // Get animal name if tagid is provided
    $animalName = '';
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $tagid = $_GET['search'];
        $stmt = $conn->prepare("SELECT nombre FROM vacuno WHERE tagid = ?");
        $stmt->execute([$tagid]);
        if ($row = $stmt->fetch()) {
            $animalName = $row['nombre'];
        }
    }

    // Fetch all concentrado records with animal name and total value calculation
    $concentradoQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_concentrado_racion * p.vh_concentrado_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_concentrado p 
                  LEFT JOIN vacuno v ON p.vh_concentrado_tagid = v.tagid 
                  ORDER BY p.vh_concentrado_fecha DESC";
    $stmt = $conn->prepare($concentradoQuery);
    $stmt->execute();
    $concentradoResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container">
    <!-- Search Form -->
    <form method="GET" class="search-form mb-4">
        <div class="search-wrapper">
            <div class="input-group">
                <input 
                    type="text" 
                    id="search" 
                    name="search" 
                    class="form-control search-input" 
                    placeholder="Buscar por número de identificación..." 
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                >
                <button type="submit" class="btn btn-search">
                    <i class="fas fa-search"></i>
                    Buscar
                </button>
            </div>
            <label class="required-label">* Obligatorio para nuevo registro</label>
        </div>
    </form>
</div>

<h3 class="container mt-4 text-white">CONCENTRADO</h3>

<!-- Alimento Concentrado INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addConcentradoForm">
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
                    <label class="form-label">Racion (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="racion" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Precio por kg ($)</label>
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

<!-- PESO Insertar Script-->
<script>
$(document).ready(function() {
    $('#concentradoForm').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea guardar este registro?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#83956e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = this;
                const formData = new FormData(form);
                formData.append('action', 'insert'); // Add action parameter
                
                fetch('./process_concentrado.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Guardado!',
                            text: 'El registro ha sido guardado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_alimentacion.php';
                        });
                    } else {
                        throw new Error(data.message || 'Error al guardar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al procesar la solicitud'
                    });
                });
            }
        });
    });
});
</script>
<!-- Concentrado DataTable -->

<div class="table-responsive">
  <!-- Add New Concentrado Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addConcentradoForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="concentradoTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Alimento</th>
              <th class="text-center">Etapa</th>
              <th class="text-center">Racion (kg)</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total Diario ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($concentradoResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_etapa']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_racion']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_concentrado_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-concentrado'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_concentrado_producto']) . "'
                    data-etapa='" . htmlspecialchars($row['vh_concentrado_etapa']) . "'
                    data-racion='" . htmlspecialchars($row['vh_concentrado_racion']) . "'
                    data-costo='" . htmlspecialchars($row['vh_concentrado_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_concentrado_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editConcentradoModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-concentrado'
                    data-id='" . htmlspecialchars($row['id']) . "'>
                <i class='fas fa-trash'></i>
            </button>
          </td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
<!--  Concentrado Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#concentradoTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[7, 'desc']],

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
        // Add custom classes for styling
        pagingType: "simple_numbers",
        classes: {
            sPageButton: "paginate_button",
        },

 // Column specific settings
 columnDefs: [
            {
                targets: [4, 5, 6], // Precio, Valor y Total columns formato decimal
                render: function(data, type, row) {
                    if (type === 'display') {
                        // Clean the data and ensure it's a valid number
                        const cleanNumber = data ? data.toString().replace(/[^\d.-]/g, '') : '0';
                        const number = parseFloat(cleanNumber);
                        
                        if (isNaN(number)) {
                            console.log('Invalid number:', data); // Debug log
                            return '0.00';
                        }
                        
                        return number.toFixed(2);
                    }
                    return data;
                }
            },
            {
                targets: [7], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        const parts = data.split('-');  // Split YYYY-MM-DD
                        const date = new Date(parts[0], parts[1] - 1, parts[2]);
                        const day = parts[2];  // Keep original day
                        const month = date.toLocaleDateString('es-ES', { month: 'short' });
                        const year = parts[0].slice(-2);  // Get last 2 digits of year
                        return `${day} ${month} '${year}`;
                    }
                    return data;
                }
            },
            {
                targets: [8], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
<!-- Add SweetAlert2 library in the head section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Delete Concentrado Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-concentrado').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            
            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción no se puede revertir",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#83956e',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./process_concentrado.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=delete&id=${id}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'El registro ha sido eliminado.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Error al eliminar el registro'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la solicitud'
                        });
                    });
                }
            });
        });
    });
});
</script>
<!-- Edit Concentrado Modal -->

<div class="modal fade" id="editConcentradoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Concentrado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editConcentradoForm" action="process_concentrado.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Etapa</label>
                        <input type="text" class="form-control" name="etapa" id="edit_etapa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Racion (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="racion" id="edit_racion" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo por kg ($)</label>
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

<!-- Edit Concentrado JS -->
<script>
    // Handle edit button click
    $('.edit-concentrado').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const producto = button.data('producto');
        const etapa = button.data('etapa');
        const racion = button.data('racion');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_etapa').val(etapa);
        $('#edit_racion').val(racion);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editConcentradoForm').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea guardar los cambios?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#83956e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = this;
                const formData = new FormData(form);
                formData.append('action', 'update'); // Add action parameter
                
                fetch('process_concentrado.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        $('#editConcentradoModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_alimentacion.php';
                        });
                    } else {
                        throw new Error(data.message || 'Error al actualizar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al procesar la solicitud'
                    });
                });
            }
        });
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

<!-- Chart Container -->
<div class="chart-container">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title">Evolución Inversión Alimento Concentrado</h5>
            <div class="chart-wrapper">
                <canvas id="weightChart"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
/* Chart responsive styling */
.chart-container {
    height: calc(100vh - 150px); /* Adjust for header/navigation */
    margin: 20px auto;
    padding: 0 15px;
}

.card {
    height: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-body {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 20px;
}

.card-title {
    color: #83956e;
    margin-bottom: 20px;
    flex-shrink: 0;
}

.chart-wrapper {
    flex-grow: 1;
    position: relative;
    min-height: 0; /* Important for flex container */
}

.search-form {
    max-width: 600px;
    margin: 2rem auto;
}

.search-wrapper {
    position: relative;
    padding: 1rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.input-group {
    display: flex;
    gap: 10px;
}

.search-input {
    height: 45px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #83956e;
    box-shadow: 0 0 0 0.2rem rgba(131, 149, 110, 0.25);
    outline: none;
}

.search-input::placeholder {
    color: #999;
}

.btn-search {
    background-color: #83956e;
    color: white;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-search:hover {
    background-color: #6f8159;
    color: white;
    transform: translateY(-1px);
}

.btn-search i {
    font-size: 0.9rem;
}

.required-label {
    display: block;
    margin-top: 0.5rem;
    color: #dc3545;
    font-size: 0.875rem;
    font-style: italic;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .input-group {
        flex-direction: column;
    }
    
    .btn-search {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('weightChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($concentradoFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const weightChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Racion (kg)',
                    data: monthlyData,
                    borderColor: '#83956e',
                    backgroundColor: '#83956e33',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointHoverRadius: 8
                },
                {
                    label: 'Línea de Tendencia',
                    data: regressionLine,
                    borderColor: '#ff6b6b',
                    borderDash: [5, 5],
                    fill: false,
                    pointRadius: 0,
                    tension: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,  // Allow chart to fill container
            plugins: {
                title: {
                    display: true,
                    text: 'Tendencia de Inversión',
                    font: {
                        size: 16
                    }
                },
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed.y.toFixed(2)} kg`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: 'Racion (kg)'
                    }
                }
            }
        }
    });
});
</script>

<!-- Add this script after your form -->
<script>
$(document).ready(function() {
    // Initially collapse the form
    $('#addConcentradoForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addConcentradoForm"]').click(function(e) {
        e.preventDefault(); // Prevent default toggle behavior
        const tagid = $('#search').val().trim();
        
        if (!tagid) {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Por favor, ingrese un número de identificación válido primero',
                confirmButtonColor: '#83956e'
            });
            
            // Ensure form stays collapsed
            $('#addConcentradoForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addConcentradoForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addConcentradoForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addConcentradoForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addConcentradoForm').collapse('hide');
    }
});
</script>

<!-- Melaza -->

<?php
// REGISTROS MELAZA
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_melaza WHERE vh_melaza_tagid = ? ORDER BY vh_melaza_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_melaza ORDER BY vh_melaza_fecha ASC");
        $stmt->execute();
    }
    
    $melazaData = [];
    $melazaFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process melaza data
    $melazaData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($melazaData as $row) {
        $date = new DateTime($row['vh_melaza_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_melaza_racion']);
        $melazaFechaLabels[] = $row['vh_melaza_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($melazaFechaLabels), null);
    foreach ($melazaFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyWeights[$month])) {
            $monthlyData[$index] = end($monthlyWeights[$month]);
        }
    }

    // Calculate regression
    $x = [];
    $y = [];
    $n = 0;

    foreach ($monthlyData as $index => $weight) {
        if ($weight !== null) {
            $x[] = $n;
            $y[] = $weight;
            $n++;
        }
    }

    if (count($x) > 1) {
        $x_mean = array_sum($x) / count($x);
        $y_mean = array_sum($y) / count($y);

        $numerator = 0;
        $denominator = 0;

        for ($i = 0; $i < count($x); $i++) {
            $numerator += ($x[$i] - $x_mean) * ($y[$i] - $y_mean);
            $denominator += pow($x[$i] - $x_mean, 2);
        }

        $slope = $denominator != 0 ? $numerator / $denominator : 0;
        $y_intercept = $y_mean - ($slope * $x_mean);

        $regressionLine = array_fill(0, count($monthlyData), null);
        $point_count = 0;

        foreach ($monthlyData as $index => $weight) {
            if ($weight !== null) {
                $regressionLine[$index] = $y_intercept + ($slope * $point_count);
                $point_count++;
            }
        }
    }

    // Calculate monthly prices
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyPrices = [];
    $monthlyPriceData = array_fill(0, count($melazaFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_melaza_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_melaza_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($melazaFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($melazaFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_melaza_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_melaza_racion']) * floatval($row['vh_melaza_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($melazaFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyValues[$month]) && $monthlyValues[$month]['count'] > 0) {
            $monthlyValueData[$index] = $monthlyValues[$month]['sum'] / $monthlyValues[$month]['count'];
        }
    }
  }
  catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

?>

<!-- Melaza Table Section -->
<?php
    // Get animal name if tagid is provided
    $animalName = '';
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $tagid = $_GET['search'];
        $stmt = $conn->prepare("SELECT nombre FROM vacuno WHERE tagid = ?");
        $stmt->execute([$tagid]);
        if ($row = $stmt->fetch()) {
            $animalName = $row['nombre'];
        }
    }

    // Fetch all melaza records with animal name and total value calculation
    $melazaQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_melaza_racion * p.vh_melaza_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_melaza p 
                  LEFT JOIN vacuno v ON p.vh_melaza_tagid = v.tagid 
                  ORDER BY p.vh_melaza_fecha DESC";
    $stmt = $conn->prepare($melazaQuery);
    $stmt->execute();
    $melazaResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container">
    <!-- Search Form -->
    <form method="GET" class="search-form mb-4">
        <div class="search-wrapper">
            <div class="input-group">
                <input 
                    type="text" 
                    id="search" 
                    name="search" 
                    class="form-control search-input" 
                    placeholder="Buscar por número de identificación..." 
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                >
                <button type="submit" class="btn btn-search">
                    <i class="fas fa-search"></i>
                    Buscar
                </button>
            </div>
            <label class="required-label">* Obligatorio para nuevo registro</label>
        </div>
    </form>
</div>

<h3 class="container mt-4 text-white">MELAZA</h3>

<!-- Alimento Melaza INSERT FORM -->

<div class="container table-section" style="display: block;">
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
                    <label class="form-label">Racion (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="racion" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Precio por kg ($)</label>
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

<!-- Melaza Insertar Script-->
<script>
$(document).ready(function() {
    $('#melazaForm').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea guardar este registro?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#83956e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = this;
                const formData = new FormData(form);
                formData.append('action', 'insert'); // Add action parameter
                
                fetch('./process_melaza.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Guardado!',
                            text: 'El registro ha sido guardado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_alimentacion.php';
                        });
                    } else {
                        throw new Error(data.message || 'Error al guardar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al procesar la solicitud'
                    });
                });
            }
        });
    });
});
</script>
<!-- Melaza DataTable -->

<div class="table-responsive">
  <!-- Add New Melaza Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addMelazaForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="melazaTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Etapa</th>
              <th class="text-center">Racion (kg)</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total Diario ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($melazaResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_etapa']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_racion']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_melaza_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-melaza'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_melaza_producto']) . "'
                    data-etapa='" . htmlspecialchars($row['vh_melaza_etapa']) . "'
                    data-racion='" . htmlspecialchars($row['vh_melaza_racion']) . "'
                    data-costo='" . htmlspecialchars($row['vh_melaza_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_melaza_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editMelazaModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-melaza'
                    data-id='" . htmlspecialchars($row['id']) . "'>
                <i class='fas fa-trash'></i>
            </button>
          </td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
<!--  Melaza Inicializacion DataTable -->
<script>
$(document).ready(function() {
    $('#melazaTable').DataTable({
        // Set initial page length to 5
        pageLength: 5,

        // Configure length menu options
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "Todos"]
        ],

        // Order by fecha (date) column descending
        order: [[7, 'desc']],

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
        // Add custom classes for styling
        pagingType: "simple_numbers",
        classes: {
            sPageButton: "paginate_button",
        },

 // Column specific settings
 columnDefs: [
            {
                targets: [4, 5, 6], // Precio, Valor y Total columns formato decimal
                render: function(data, type, row) {
                    if (type === 'display') {
                        // Clean the data and ensure it's a valid number
                        const cleanNumber = data ? data.toString().replace(/[^\d.-]/g, '') : '0';
                        const number = parseFloat(cleanNumber);
                        
                        if (isNaN(number)) {
                            console.log('Invalid number:', data); // Debug log
                            return '0.00';
                        }
                        
                        return number.toFixed(2);
                    }
                    return data;
                }
            },
            {
                targets: [7], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        const parts = data.split('-');  // Split YYYY-MM-DD
                        const date = new Date(parts[0], parts[1] - 1, parts[2]);
                        const day = parts[2];  // Keep original day
                        const month = date.toLocaleDateString('es-ES', { month: 'short' });
                        const year = parts[0].slice(-2);  // Get last 2 digits of year
                        return `${day} ${month} '${year}`;
                    }
                    return data;
                }
            },
            {
                targets: [8], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
<!-- Add SweetAlert2 library in the head section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Delete Melaza Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-melaza').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            
            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción no se puede revertir",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#83956e',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./process_melaza.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=delete&id=${id}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'El registro ha sido eliminado.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Error al eliminar el registro'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la solicitud'
                        });
                    });
                }
            });
        });
    });
});
</script>
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
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Etapa</label>
                        <input type="text" class="form-control" name="etapa" id="edit_etapa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Racion (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="racion" id="edit_racion" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo por kg ($)</label>
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

<!-- Edit Melaza JS -->
<script>
    // Handle edit button click
    $('.edit-melaza').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const producto = button.data('producto');
        const etapa = button.data('etapa');
        const racion = button.data('racion');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_etapa').val(etapa);
        $('#edit_racion').val(racion);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editMelazaForm').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea guardar los cambios?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#83956e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = this;
                const formData = new FormData(form);
                formData.append('action', 'update'); // Add action parameter
                
                fetch('process_melaza.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        $('#editMelazaModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_alimentacion.php';
                        });
                    } else {
                        throw new Error(data.message || 'Error al actualizar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al procesar la solicitud'
                    });
                });
            }
        });
    });
</script>

<!-- Chart Container -->
<div class="chart-container">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title">Evolución Inversión Melaza</h5>
            <div class="chart-wrapper">
                <canvas id="melazaChart"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
/* Chart responsive styling */
.chart-container {
    height: calc(100vh - 150px); /* Adjust for header/navigation */
    margin: 20px auto;
    padding: 0 15px;
}

.card {
    height: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-body {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 20px;
}

.card-title {
    color: #83956e;
    margin-bottom: 20px;
    flex-shrink: 0;
}

.chart-wrapper {
    flex-grow: 1;
    position: relative;
    min-height: 0; /* Important for flex container */
}

.search-form {
    max-width: 600px;
    margin: 2rem auto;
}

.search-wrapper {
    position: relative;
    padding: 1rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.input-group {
    display: flex;
    gap: 10px;
}

.search-input {
    height: 45px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #83956e;
    box-shadow: 0 0 0 0.2rem rgba(131, 149, 110, 0.25);
    outline: none;
}

.search-input::placeholder {
    color: #999;
}

.btn-search {
    background-color: #83956e;
    color: white;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-search:hover {
    background-color: #6f8159;
    color: white;
    transform: translateY(-1px);
}

.btn-search i {
    font-size: 0.9rem;
}

.required-label {
    display: block;
    margin-top: 0.5rem;
    color: #dc3545;
    font-size: 0.875rem;
    font-style: italic;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .input-group {
        flex-direction: column;
    }
    
    .btn-search {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('melazaChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($melazaFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const melazaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Racion (kg)',
                    data: monthlyData,
                    borderColor: '#83956e',
                    backgroundColor: '#83956e33',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointHoverRadius: 8
                },
                {
                    label: 'Línea de Tendencia',
                    data: regressionLine,
                    borderColor: '#ff6b6b',
                    borderDash: [5, 5],
                    fill: false,
                    pointRadius: 0,
                    tension: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,  // Allow chart to fill container
            plugins: {
                title: {
                    display: true,
                    text: 'Tendencia de Inversión',
                    font: {
                        size: 16
                    }
                },
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed.y.toFixed(2)} kg`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: 'Racion (kg)'
                    }
                }
            }
        }
    });
});
</script>

<!-- Add this script after your form -->
<script>
$(document).ready(function() {
    // Initially collapse the form
    $('#addMelazaForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addMelazaForm"]').click(function(e) {
        e.preventDefault(); // Prevent default toggle behavior
        const tagid = $('#search').val().trim();
        
        if (!tagid) {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Por favor, ingrese un número de identificación válido primero',
                confirmButtonColor: '#83956e'
            });
            
            // Ensure form stays collapsed
            $('#addMelazaForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addMelazaForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addMelazaForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addMelazaForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addMelazaForm').collapse('hide');
    }
});
</script>

<!-- SAL -->

<?php
// REGISTROS SAL
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_sal WHERE vh_sal_tagid = ? ORDER BY vh_sal_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_sal ORDER BY vh_sal_fecha ASC");
        $stmt->execute();
    }
    
    $salData = [];
    $salFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process sal data
    $salData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($salData as $row) {
        $date = new DateTime($row['vh_sal_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_sal_racion']);
        $salFechaLabels[] = $row['vh_sal_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($salFechaLabels), null);
    foreach ($salFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyWeights[$month])) {
            $monthlyData[$index] = end($monthlyWeights[$month]);
        }
    }

    // Calculate regression
    $x = [];
    $y = [];
    $n = 0;

    foreach ($monthlyData as $index => $weight) {
        if ($weight !== null) {
            $x[] = $n;
            $y[] = $weight;
            $n++;
        }
    }

    if (count($x) > 1) {
        $x_mean = array_sum($x) / count($x);
        $y_mean = array_sum($y) / count($y);

        $numerator = 0;
        $denominator = 0;

        for ($i = 0; $i < count($x); $i++) {
            $numerator += ($x[$i] - $x_mean) * ($y[$i] - $y_mean);
            $denominator += pow($x[$i] - $x_mean, 2);
        }

        $slope = $denominator != 0 ? $numerator / $denominator : 0;
        $y_intercept = $y_mean - ($slope * $x_mean);

        $regressionLine = array_fill(0, count($monthlyData), null);
        $point_count = 0;

        foreach ($monthlyData as $index => $weight) {
            if ($weight !== null) {
                $regressionLine[$index] = $y_intercept + ($slope * $point_count);
                $point_count++;
            }
        }
    }

    // Calculate monthly prices
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyPrices = [];
    $monthlyPriceData = array_fill(0, count($salFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_sal_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_sal_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($salFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($salFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_sal_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_sal_racion']) * floatval($row['vh_sal_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($salFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyValues[$month]) && $monthlyValues[$month]['count'] > 0) {
            $monthlyValueData[$index] = $monthlyValues[$month]['sum'] / $monthlyValues[$month]['count'];
        }
    }
  }
  catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

?>

<!-- SAL Table Section -->
<?php
    // Get animal name if tagid is provided
    $animalName = '';
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $tagid = $_GET['search'];
        $stmt = $conn->prepare("SELECT nombre FROM vacuno WHERE tagid = ?");
        $stmt->execute([$tagid]);
        if ($row = $stmt->fetch()) {
            $animalName = $row['nombre'];
        }
    }

    // Fetch all sal records with animal name and total value calculation
    $salQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_sal_racion * p.vh_sal_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_sal p 
                  LEFT JOIN vacuno v ON p.vh_sal_tagid = v.tagid 
                  ORDER BY p.vh_sal_fecha DESC";
    $stmt = $conn->prepare($salQuery);
    $stmt->execute();
    $salResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container">
    <!-- Search Form -->
    <form method="GET" class="search-form mb-4">
        <div class="search-wrapper">
            <div class="input-group">
                <input 
                    type="text" 
                    id="search" 
                    name="search" 
                    class="form-control search-input" 
                    placeholder="Buscar por número de identificación..." 
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                >
                <button type="submit" class="btn btn-search">
                    <i class="fas fa-search"></i>
                    Buscar
                </button>
            </div>
            <label class="required-label">* Obligatorio para nuevo registro</label>
        </div>
    </form>
</div>

<h3 class="container mt-4 text-white">SAL</h3>

<!-- Alimento Sal INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addSalForm">
    <div class="card card-body">
        <form id="salForm" action="process_sal.php" method="POST">
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
                    <label class="form-label">Racion (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="racion" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Precio por kg ($)</label>
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

<!-- PESO Insertar Script-->
<script>
$(document).ready(function() {
    $('#salForm').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea guardar este registro?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#83956e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = this;
                const formData = new FormData(form);
                formData.append('action', 'insert'); // Add action parameter
                
                fetch('./process_sal.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Guardado!',
                            text: 'El registro ha sido guardado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_alimentacion.php';
                        });
                    } else {
                        throw new Error(data.message || 'Error al guardar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al procesar la solicitud'
                    });
                });
            }
        });
    });
});
</script>
<!-- Sal DataTable -->

<div class="table-responsive">
  <!-- Add New Sal Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addSalForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="salTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Etapa</th>
              <th class="text-center">Racion (kg)</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total Diario ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($salResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_etapa']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_racion']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_sal_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-sal'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_sal_producto']) . "'
                    data-etapa='" . htmlspecialchars($row['vh_sal_etapa']) . "'
                    data-racion='" . htmlspecialchars($row['vh_sal_racion']) . "'
                    data-costo='" . htmlspecialchars($row['vh_sal_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_sal_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editSalModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-sal'
                    data-id='" . htmlspecialchars($row['id']) . "'>
                <i class='fas fa-trash'></i>
            </button>
          </td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
<!--  Sal Inicializacion DataTable -->
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
        order: [[7, 'desc']],

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
        // Add custom classes for styling
        pagingType: "simple_numbers",
        classes: {
            sPageButton: "paginate_button",
        },

 // Column specific settings
 columnDefs: [
            {
                targets: [4, 5, 6], // Precio, Valor y Total columns formato decimal
                render: function(data, type, row) {
                    if (type === 'display') {
                        // Clean the data and ensure it's a valid number
                        const cleanNumber = data ? data.toString().replace(/[^\d.-]/g, '') : '0';
                        const number = parseFloat(cleanNumber);
                        
                        if (isNaN(number)) {
                            console.log('Invalid number:', data); // Debug log
                            return '0.00';
                        }
                        
                        return number.toFixed(2);
                    }
                    return data;
                }
            },
            {
                targets: [7], // Fecha column
                render: function(data, type, row) {
                    if (type === 'display') {
                        const parts = data.split('-');  // Split YYYY-MM-DD
                        const date = new Date(parts[0], parts[1] - 1, parts[2]);
                        const day = parts[2];  // Keep original day
                        const month = date.toLocaleDateString('es-ES', { month: 'short' });
                        const year = parts[0].slice(-2);  // Get last 2 digits of year
                        return `${day} ${month} '${year}`;
                    }
                    return data;
                }
            },
            {
                targets: [8], // Acciones column
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
<!-- Add SweetAlert2 library in the head section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Delete Sal Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-sal').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            
            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción no se puede revertir",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#83956e',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./process_sal.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=delete&id=${id}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'El registro ha sido eliminado.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Error al eliminar el registro'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la solicitud'
                        });
                    });
                }
            });
        });
    });
});
</script>
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
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="tagid" id="edit_tagid">
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="producto" id="edit_producto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Etapa</label>
                        <input type="text" class="form-control" name="etapa" id="edit_etapa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Racion (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="racion" id="edit_racion" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo por kg ($)</label>
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

<!-- Edit Sal JS -->
<script>
    // Handle edit button click
    $('.edit-sal').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const producto = button.data('producto');
        const etapa = button.data('etapa');
        const racion = button.data('racion');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_etapa').val(etapa);
        $('#edit_racion').val(racion);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editSalForm').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea guardar los cambios?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#83956e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = this;
                const formData = new FormData(form);
                formData.append('action', 'update'); // Add action parameter
                
                fetch('process_sal.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        $('#editSalModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_alimentacion.php';
                        });
                    } else {
                        throw new Error(data.message || 'Error al actualizar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al procesar la solicitud'
                    });
                });
            }
        });
    });
</script>

<!-- Chart Container -->
<div class="chart-container">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title">Evolución Inversión Sal</h5>
            <div class="chart-wrapper">
                <canvas id="salChart"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
/* Chart responsive styling */
.chart-container {
    height: calc(100vh - 150px); /* Adjust for header/navigation */
    margin: 20px auto;
    padding: 0 15px;
}

.card {
    height: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-body {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 20px;
}

.card-title {
    color: #83956e;
    margin-bottom: 20px;
    flex-shrink: 0;
}

.chart-wrapper {
    flex-grow: 1;
    position: relative;
    min-height: 0; /* Important for flex container */
}

.search-form {
    max-width: 600px;
    margin: 2rem auto;
}

.search-wrapper {
    position: relative;
    padding: 1rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.input-group {
    display: flex;
    gap: 10px;
}

.search-input {
    height: 45px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #83956e;
    box-shadow: 0 0 0 0.2rem rgba(131, 149, 110, 0.25);
    outline: none;
}

.search-input::placeholder {
    color: #999;
}

.btn-search {
    background-color: #83956e;
    color: white;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-search:hover {
    background-color: #6f8159;
    color: white;
    transform: translateY(-1px);
}

.btn-search i {
    font-size: 0.9rem;
}

.required-label {
    display: block;
    margin-top: 0.5rem;
    color: #dc3545;
    font-size: 0.875rem;
    font-style: italic;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .input-group {
        flex-direction: column;
    }
    
    .btn-search {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($salFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const salChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Racion (kg)',
                    data: monthlyData,
                    borderColor: '#83956e',
                    backgroundColor: '#83956e33',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointHoverRadius: 8
                },
                {
                    label: 'Línea de Tendencia',
                    data: regressionLine,
                    borderColor: '#ff6b6b',
                    borderDash: [5, 5],
                    fill: false,
                    pointRadius: 0,
                    tension: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,  // Allow chart to fill container
            plugins: {
                title: {
                    display: true,
                    text: 'Tendencia de Inversión',
                    font: {
                        size: 16
                    }
                },
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed.y.toFixed(2)} kg`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: 'Racion (kg)'
                    }
                }
            }
        }
    });
});
</script>

<!-- Add this script after your form -->
<script>
$(document).ready(function() {
    // Initially collapse the form
    $('#addSalForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addSalForm"]').click(function(e) {
        e.preventDefault(); // Prevent default toggle behavior
        const tagid = $('#search').val().trim();
        
        if (!tagid) {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Por favor, ingrese un número de identificación válido primero',
                confirmButtonColor: '#83956e'
            });
            
            // Ensure form stays collapsed
            $('#addSalForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addSalForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addSalForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addSalForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addSalForm').collapse('hide');
    }
});
</script>
</body>
</html> 