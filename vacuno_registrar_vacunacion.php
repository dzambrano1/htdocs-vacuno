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
    
    <button class="btn btn-outline-secondary mb-3" onclick="window.location.href='./vacuno_registrar_alimentacion.php'" data-tooltip="Alimentacion">
        <img src="./images/harina-de-trigo.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button  class="icon-button" type="button" data-bs-toggle="collapse" data-bs-target="#" data-tooltip="Salud">
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
// REGISTROS Aftosa
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_aftosa WHERE vh_aftosa_tagid = ? ORDER BY vh_aftosa_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_aftosa ORDER BY vh_aftosa_fecha ASC");
        $stmt->execute();
    }
    
    $aftosaData = [];
    $aftosaFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process aftosa data
    $aftosaData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($aftosaData as $row) {
        $date = new DateTime($row['vh_aftosa_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_aftosa_dosis']);
        $aftosaFechaLabels[] = $row['vh_aftosa_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($aftosaFechaLabels), null);
    foreach ($aftosaFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($aftosaFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_aftosa_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_aftosa_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($aftosaFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($aftosaFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_aftosa_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_aftosa_dosis']) * floatval($row['vh_aftosa_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($aftosaFechaLabels as $index => $date) {
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

<!-- Aftosa Table Section -->
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

    // Fetch all aftosa records with animal name and total value calculation
    $aftosaQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_aftosa_dosis * p.vh_aftosa_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_aftosa p 
                  LEFT JOIN vacuno v ON p.vh_aftosa_tagid = v.tagid 
                  ORDER BY p.vh_aftosa_fecha DESC";
    $stmt = $conn->prepare($aftosaQuery);
    $stmt->execute();
    $aftosaResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h3 class="container mt-4 text-white">AFTOSA</h3>

<!-- Aftosa INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addAftosaForm">
    <div class="card card-body">
        <form id="aftosaForm" action="process_aftosa.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dosis</label>
                    <input type="number" step="0.01" class="form-control" name="dosis" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($)</label>
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

<!-- Aftosa Insertar Script-->
<script>
$(document).ready(function() {
    $('#aftosaForm').on('submit', function(e) {
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
                
                fetch('./process_aftosa.php', {
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
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
<!-- Aftosa DataTable -->

<div class="table-responsive">
  <!-- Add New Aftosa Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addAftosaForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="aftosaTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Dosis</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($aftosaResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_aftosa_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_aftosa_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_aftosa_dosis']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_aftosa_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_aftosa_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-aftosa'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_aftosa_producto']) . "'
                    data-dosis='" . htmlspecialchars($row['vh_aftosa_dosis']) . "'
                    data-costo='" . htmlspecialchars($row['vh_aftosa_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_aftosa_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editAftosaModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-aftosa'
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
<!--  Aftosa Inicializacion DataTable -->
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
        order: [[6, 'desc']],

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
                targets: [3, 4, 5], // Precio, Valor y Total columns formato decimal
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
                targets: [6], // Fecha column
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
                targets: [7], // Acciones column
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
<!-- Delete Aftosa Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-aftosa').forEach(button => {
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
                    fetch('./process_aftosa.php', {
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
<!-- Edit Aftosa Modal -->

<div class="modal fade" id="editAftosaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Aftosa</h5>
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
                        <label class="form-label">Costo $</label>
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
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editAftosaForm').on('submit', function(e) {
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
                
                fetch('process_aftosa.php', {
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
                        $('#editAftosaModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
            <h5 class="card-title">Evolución Inversión Alimento Aftosa</h5>
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
    const labels = <?php echo json_encode($aftosaFechaLabels); ?>;
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
                    label: 'Dosis',
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
                        text: 'Dosis'
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
    $('#addAftosaForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addAftosaForm"]').click(function(e) {
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
            $('#addAftosaForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addAftosaForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addAftosaForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addAftosaForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addAftosaForm').collapse('hide');
    }
});
</script>

<!-- Ibr -->

<?php
// REGISTROS IBR
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_ibr WHERE vh_ibr_tagid = ? ORDER BY vh_ibr_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_ibr ORDER BY vh_ibr_fecha ASC");
        $stmt->execute();
    }
    
    $ibrData = [];
    $ibrFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process ibr data
    $ibrData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($ibrData as $row) {
        $date = new DateTime($row['vh_ibr_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_ibr_dosis']);
        $ibrFechaLabels[] = $row['vh_ibr_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($ibrFechaLabels), null);
    foreach ($ibrFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($ibrFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_ibr_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_ibr_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($ibrFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($ibrFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_ibr_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_ibr_dosis']) * floatval($row['vh_ibr_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($ibrFechaLabels as $index => $date) {
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

<!-- Ibr Table Section -->
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

    // Fetch all ibr records with animal name and total value calculation
    $ibrQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_ibr_dosis * p.vh_ibr_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_ibr p 
                  LEFT JOIN vacuno v ON p.vh_ibr_tagid = v.tagid 
                  ORDER BY p.vh_ibr_fecha DESC";
    $stmt = $conn->prepare($ibrQuery);
    $stmt->execute();
    $ibrResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h3 class="container mt-4 text-white">IBR</h3>

<!-- Alimento Ibr INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addIbrForm">
    <div class="card card-body">
        <form id="ibrForm" action="process_ibr.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dosis</label>
                    <input type="number" step="0.01" class="form-control" name="dosis" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($)</label>
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

<!-- Ibr Insertar Script-->
<script>
$(document).ready(function() {
    $('#ibrForm').on('submit', function(e) {
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
                
                fetch('./process_ibr.php', {
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
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
<!-- Ibr DataTable -->

<div class="table-responsive">
  <!-- Add New Ibr Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addIbrForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="ibrTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Dosis</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($ibrResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_ibr_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_ibr_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_ibr_dosis']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_ibr_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_ibr_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-ibr'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_ibr_producto']) . "'                    
                    data-dosis='" . htmlspecialchars($row['vh_ibr_dosis']) . "'
                    data-costo='" . htmlspecialchars($row['vh_ibr_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_ibr_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editIbrModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-ibr'
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
        order: [[6, 'desc']],

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
                targets: [3, 4, 5], // Precio, Valor y Total columns formato decimal
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
                targets: [6], // Fecha column
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
                targets: [7], // Acciones column
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
<!-- Delete Ibr Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-ibr').forEach(button => {
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
                    fetch('./process_ibr.php', {
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
<!-- Edit Ibr Modal -->

<div class="modal fade" id="editIbrModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Ibr</h5>
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

<!-- Edit Ibr JS -->
<script>
    // Handle edit button click
    $('.edit-ibr').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editIbrForm').on('submit', function(e) {
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
                
                fetch('./process_ibr.php', {
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
                        $('#editIbrModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
            <h5 class="card-title">Evolución Inversión Ibr</h5>
            <div class="chart-wrapper">
                <canvas id="ibrChart"></canvas>
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
    const ctx = document.getElementById('ibrChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($ibrFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const ibrChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Dosis',
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
                        text: 'Dosis'
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
    $('#addIbrForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addIbrForm"]').click(function(e) {
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
            $('#addIbrForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addIbrForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addIbrForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addIbrForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addIbrForm').collapse('hide');
    }
});
</script>

<!-- SAL -->

<?php
// REGISTROS CBR
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_cbr WHERE vh_cbr_tagid = ? ORDER BY vh_cbr_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_cbr ORDER BY vh_cbr_fecha ASC");
        $stmt->execute();
    }
    
    $cbrData = [];
    $cbrFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process cbr data
    $cbrData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($cbrData as $row) {
        $date = new DateTime($row['vh_cbr_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_cbr_dosis']);
        $cbrFechaLabels[] = $row['vh_cbr_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($cbrFechaLabels), null);
    foreach ($cbrFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($cbrFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_cbr_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_cbr_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($cbrFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($cbrFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_cbr_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_cbr_dosis']) * floatval($row['vh_cbr_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($cbrFechaLabels as $index => $date) {
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

    // Fetch all cbr records with animal name and total value calculation
    $cbrQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_cbr_dosis * p.vh_cbr_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_cbr p 
                  LEFT JOIN vacuno v ON p.vh_cbr_tagid = v.tagid 
                  ORDER BY p.vh_cbr_fecha DESC";
    $stmt = $conn->prepare($cbrQuery);
    $stmt->execute();
    $cbrResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h3 class="container mt-4 text-white">CBR</h3>

<!-- Cbr INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addCbrForm">
    <div class="card card-body">
        <form id="cbrForm" action="process_cbr.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dosis</label>
                    <input type="number" step="0.01" class="form-control" name="dosis" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($)</label>
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
    $('#cbrForm').on('submit', function(e) {
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
                
                fetch('./process_cbr.php', {
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
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
<!-- Cbr DataTable -->

<div class="table-responsive">
  <!-- Add New Cbr Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addCbrForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="cbrTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Dosis</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($cbrResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_cbr_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_cbr_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_cbr_dosis']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_cbr_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_cbr_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-cbr'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_cbr_producto']) . "'
                    data-dosis='" . htmlspecialchars($row['vh_cbr_dosis']) . "'
                    data-costo='" . htmlspecialchars($row['vh_cbr_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_cbr_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editCbrModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-cbr'
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
<!--  Cbr Inicializacion DataTable -->
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
        order: [[6, 'desc']],

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
                targets: [3, 4, 5], // Precio, Valor y Total columns formato decimal
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
                targets: [6], // Fecha column
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
                targets: [7], // Acciones column
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
<!-- Delete Cbr Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-cbr').forEach(button => {
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
                    fetch('./process_cbr.php', {
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
<!-- Edit Cbr Modal -->

<div class="modal fade" id="editCbrModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cbr</h5>
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

<!-- Edit Cbr JS -->
<script>
    // Handle edit button click
    $('.edit-cbr').click(function() {
        const button = $(this);

        // Get data from data attributes
        const id = button.data('id');
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editCbrForm').on('submit', function(e) {
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
                
                fetch('./process_cbr.php', {
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
                        $('#editCbrModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
            <h5 class="card-title">Evolución Inversión Cbr</h5>
            <div class="chart-wrapper">
                <canvas id="cbrChart"></canvas>
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
    const ctx = document.getElementById('cbrChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($cbrFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const cbrChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Dosis',
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
                        text: 'Dosis'
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
    $('#addCbrForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addCbrForm"]').click(function(e) {
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
            $('#addCbrForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addCbrForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addCbrForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addCbrForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addCbrForm').collapse('hide');
    }
});
</script>

<!-- Brucelosis -->
<?php
// REGISTROS Brucelosis
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_brucelosis WHERE vh_brucelosis_tagid = ? ORDER BY vh_brucelosis_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_brucelosis ORDER BY vh_brucelosis_fecha ASC");
        $stmt->execute();
    }
    
    $brucelosisData = [];
    $brucelosisFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process brucelosis data
    $brucelosisData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($brucelosisData as $row) {
        $date = new DateTime($row['vh_brucelosis_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_brucelosis_dosis']);
        $brucelosisFechaLabels[] = $row['vh_brucelosis_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($brucelosisFechaLabels), null);
    foreach ($brucelosisFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($brucelosisFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_brucelosis_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_brucelosis_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($brucelosisFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($brucelosisFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_brucelosis_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_brucelosis_dosis']) * floatval($row['vh_brucelosis_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($brucelosisFechaLabels as $index => $date) {
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

<!-- Brucelosis Table Section -->
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

    // Fetch all brucelosis records with animal name and total value calculation
    $brucelosisQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_brucelosis_dosis * p.vh_brucelosis_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_brucelosis p 
                  LEFT JOIN vacuno v ON p.vh_brucelosis_tagid = v.tagid 
                  ORDER BY p.vh_brucelosis_fecha DESC";
    $stmt = $conn->prepare($brucelosisQuery);
    $stmt->execute();
    $brucelosisResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h3 class="container mt-4 text-white">BRUCELOSIS</h3>

<!-- Brucelosis INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addBrucelosisForm">
    <div class="card card-body">
        <form id="brucelosisForm" action="process_brucelosis.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dosis</label>
                    <input type="number" step="0.01" class="form-control" name="dosis" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($)</label>
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

<!-- Brucelosis Insertar Script-->
<script>
$(document).ready(function() {
    $('#brucelosisForm').on('submit', function(e) {
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
                
                fetch('./process_brucelosis.php', {
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
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
<!-- Brucelosis DataTable -->

<div class="table-responsive">
  <!-- Add New Brucelosis Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addBrucelosisForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="brucelosisTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Dosis</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($brucelosisResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_brucelosis_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_brucelosis_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_brucelosis_dosis']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_brucelosis_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_brucelosis_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-brucelosis'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_brucelosis_producto']) . "'
                    data-dosis='" . htmlspecialchars($row['vh_brucelosis_dosis']) . "'
                    data-costo='" . htmlspecialchars($row['vh_brucelosis_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_brucelosis_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editBrucelosisModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-brucelosis'
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
<!--  Brucelosis Inicializacion DataTable -->
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
        order: [[6, 'desc']],

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
                targets: [3, 4, 5], // Precio, Valor y Total columns formato decimal
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
                targets: [6], // Fecha column
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
                targets: [7], // Acciones column
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
<!-- Delete Brucelosis Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-brucelosis').forEach(button => {
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
                    fetch('./process_brucelosis.php', {
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
<!-- Edit Brucelosis Modal -->

<div class="modal fade" id="editBrucelosisModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Brucelosis</h5>
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
                        <label class="form-label">Costo $</label>
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
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editBrucelosisForm').on('submit', function(e) {
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
                
                fetch('process_brucelosis.php', {
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
                        $('#editBrucelosisModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
            <h5 class="card-title">Evolución Inversión Brucelosis</h5>
            <div class="chart-wrapper">
                <canvas id="brucelosisChart"></canvas>
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
    const ctx = document.getElementById('brucelosisChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($brucelosisFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const brucelosisChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Dosis',
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
                        text: 'Dosis'
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
    $('#addBrucelosisForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addBrucelosisForm"]').click(function(e) {
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
            $('#addBrucelosisForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addBrucelosisForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addBrucelosisForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addBrucelosisForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addBrucelosisForm').collapse('hide');
    }
});
</script>

<!-- Carbunco -->
<?php
// REGISTROS Carbunco
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_carbunco WHERE vh_carbunco_tagid = ? ORDER BY vh_carbunco_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_carbunco ORDER BY vh_carbunco_fecha ASC");
        $stmt->execute();
    }
    
    $carbuncoData = [];
    $carbuncoFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process carbunco data
    $carbuncoData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($carbuncoData as $row) {
        $date = new DateTime($row['vh_carbunco_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_carbunco_dosis']);
        $carbuncoFechaLabels[] = $row['vh_carbunco_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($carbuncoFechaLabels), null);
    foreach ($carbuncoFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($carbuncoFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_carbunco_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_carbunco_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($carbuncoFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($carbuncoFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_carbunco_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_carbunco_dosis']) * floatval($row['vh_carbunco_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($carbuncoFechaLabels as $index => $date) {
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

<!-- Carbunco Table Section -->
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

    // Fetch all carbunco records with animal name and total value calculation
    $carbuncoQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_carbunco_dosis * p.vh_carbunco_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_carbunco p 
                  LEFT JOIN vacuno v ON p.vh_carbunco_tagid = v.tagid 
                  ORDER BY p.vh_carbunco_fecha DESC";
    $stmt = $conn->prepare($carbuncoQuery);
    $stmt->execute();
    $carbuncoResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h3 class="container mt-4 text-white">CARBUNCO</h3>

<!-- Carbunco INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addCarbuncoForm">
    <div class="card card-body">
        <form id="carbuncoForm" action="process_carbunco.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dosis</label>
                    <input type="number" step="0.01" class="form-control" name="dosis" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($)</label>
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

<!-- Carbunco Insertar Script-->
<script>
$(document).ready(function() {
    $('#carbuncoForm').on('submit', function(e) {
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
                
                fetch('./process_carbunco.php', {
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
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
<!-- Carbunco DataTable -->

<div class="table-responsive">
  <!-- Add New Carbunco Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addCarbuncoForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="carbuncoTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Dosis</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($carbuncoResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_carbunco_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_carbunco_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_carbunco_dosis']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_carbunco_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_carbunco_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-carbunco'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_carbunco_producto']) . "'
                    data-dosis='" . htmlspecialchars($row['vh_carbunco_dosis']) . "'
                    data-costo='" . htmlspecialchars($row['vh_carbunco_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_carbunco_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editCarbuncoModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-carbunco'
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
        order: [[6, 'desc']],

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
                targets: [3, 4, 5], // Precio, Valor y Total columns formato decimal
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
                targets: [6], // Fecha column
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
                targets: [7], // Acciones column
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
<!-- Delete Carbunco Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-carbunco').forEach(button => {
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
                    fetch('./process_carbunco.php', {
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
<!-- Edit Carbunco Modal -->

<div class="modal fade" id="editCarbuncoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Carbunco</h5>
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
                        <label class="form-label">Costo $</label>
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
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editCarbuncoForm').on('submit', function(e) {
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
                
                fetch('process_carbunco.php', {
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
                        $('#editCarbuncoModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
            <h5 class="card-title">Evolución Inversión Carbunco</h5>
            <div class="chart-wrapper">
                <canvas id="carbuncoChart"></canvas>
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
    const ctx = document.getElementById('carbuncoChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($carbuncoFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const carbuncoChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Dosis',
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
                        text: 'Dosis'
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
    $('#addCarbuncoForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addCarbuncoForm"]').click(function(e) {
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
            $('#addCarbuncoForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addCarbuncoForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addCarbuncoForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addCarbuncoForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addCarbuncoForm').collapse('hide');
    }
});
</script>

<!-- Garrapatas -->
<?php
// REGISTROS Garrapatas
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_garrapatas WHERE vh_garrapatas_tagid = ? ORDER BY vh_garrapatas_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_garrapatas ORDER BY vh_garrapatas_fecha ASC");
        $stmt->execute();
    }
    
    $garrapatasData = [];
    $garrapatasFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process garrapatas data
    $garrapatasData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($garrapatasData as $row) {
        $date = new DateTime($row['vh_garrapatas_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_garrapatas_dosis']);
        $garrapatasFechaLabels[] = $row['vh_garrapatas_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($garrapatasFechaLabels), null);
    foreach ($garrapatasFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($garrapatasFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_garrapatas_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_garrapatas_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($garrapatasFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($garrapatasFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_garrapatas_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_garrapatas_dosis']) * floatval($row['vh_garrapatas_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($garrapatasFechaLabels as $index => $date) {
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

<!-- Garrapatas Table Section -->
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

    // Fetch all garrapatas records with animal name and total value calculation
    $garrapatasQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_garrapatas_dosis * p.vh_garrapatas_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_garrapatas p 
                  LEFT JOIN vacuno v ON p.vh_garrapatas_tagid = v.tagid 
                  ORDER BY p.vh_garrapatas_fecha DESC";
    $stmt = $conn->prepare($garrapatasQuery);
    $stmt->execute();
    $garrapatasResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h3 class="container mt-4 text-white">GARRAPATAS</h3>

<!-- Garrapatas INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addGarrapatasForm">
    <div class="card card-body">
        <form id="garrapatasForm" action="process_garrapatas.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dosis</label>
                    <input type="number" step="0.01" class="form-control" name="dosis" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($)</label>
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

<!-- Garrapatas Insertar Script-->
<script>
$(document).ready(function() {
    $('#garrapatasForm').on('submit', function(e) {
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
                
                fetch('./process_garrapatas.php', {
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
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
<!-- Garrapatas DataTable -->

<div class="table-responsive">
  <!-- Add New Garrapatas Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addGarrapatasForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="garrapatasTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Dosis</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($garrapatasResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_garrapatas_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_garrapatas_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_garrapatas_dosis']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_garrapatas_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_garrapatas_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-garrapatas'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_garrapatas_producto']) . "'
                    data-dosis='" . htmlspecialchars($row['vh_garrapatas_dosis']) . "'
                    data-costo='" . htmlspecialchars($row['vh_garrapatas_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_garrapatas_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editGarrapatasModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-garrapatas'
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
        order: [[6, 'desc']],

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
                targets: [3, 4, 5], // Precio, Valor y Total columns formato decimal
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
                targets: [6], // Fecha column
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
                targets: [7], // Acciones column
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
<!-- Delete Garrapatas Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-garrapatas').forEach(button => {
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
                    fetch('./process_garrapatas.php', {
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
<!-- Edit Garrapatas Modal -->

<div class="modal fade" id="editGarrapatasModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Garrapatas</h5>
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
                        <label class="form-label">Costo $</label>
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
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editGarrapatasForm').on('submit', function(e) {
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
                
                fetch('./process_garrapatas.php', {
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
                        $('#editGarrapatasModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
            <h5 class="card-title">Evolución Inversión Garrapatas</h5>
            <div class="chart-wrapper">
                <canvas id="garrapatasChart"></canvas>
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
    const ctx = document.getElementById('garrapatasChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($garrapatasFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const garrapatasChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Dosis',
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
                        text: 'Dosis'
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
    $('#addGarrapatasForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addGarrapatasForm"]').click(function(e) {
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
            $('#addGarrapatasForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addGarrapatasForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addGarrapatasForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addGarrapatasForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addGarrapatasForm').collapse('hide');
    }
});
</script>

<!-- Lombrices -->
<?php
// REGISTROS Aftosa
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_lombrices WHERE vh_lombrices_tagid = ? ORDER BY vh_lombrices_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_lombrices ORDER BY vh_lombrices_fecha ASC");
        $stmt->execute();
    }
    
    $lombricesData = [];
    $lombricesFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process lombrices data
    $lombricesData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($lombricesData as $row) {
        $date = new DateTime($row['vh_lombrices_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_lombrices_dosis']);
        $lombricesFechaLabels[] = $row['vh_lombrices_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($lombricesFechaLabels), null);
    foreach ($lombricesFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($lombricesFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_lombrices_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_lombrices_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($lombricesFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($lombricesFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_lombrices_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_lombrices_dosis']) * floatval($row['vh_lombrices_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($lombricesFechaLabels as $index => $date) {
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

<!-- Lombrices Table Section -->
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

    // Fetch all lombrices records with animal name and total value calculation
    $lombricesQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_lombrices_dosis * p.vh_lombrices_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_lombrices p 
                  LEFT JOIN vacuno v ON p.vh_lombrices_tagid = v.tagid 
                  ORDER BY p.vh_lombrices_fecha DESC";
    $stmt = $conn->prepare($lombricesQuery);
    $stmt->execute();
    $lombricesResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h3 class="container mt-4 text-white">LOMBRICES</h3>

<!-- Lombrices INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addLombricesForm">
    <div class="card card-body">
        <form id="lombricesForm" action="process_lombrices.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dosis</label>
                    <input type="number" step="0.01" class="form-control" name="dosis" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($)</label>
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

<!-- Lombrices Insertar Script-->
<script>
$(document).ready(function() {
    $('#lombricesForm').on('submit', function(e) {
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
                
                fetch('./process_lombrices.php', {
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
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
<!-- Lombrices DataTable -->

<div class="table-responsive">
  <!-- Add New Lombrices Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addLombricesForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="lombricesTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Dosis</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($lombricesResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_lombrices_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_lombrices_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_lombrices_dosis']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_lombrices_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_lombrices_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-lombrices'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_lombrices_producto']) . "'
                    data-dosis='" . htmlspecialchars($row['vh_lombrices_dosis']) . "'
                    data-costo='" . htmlspecialchars($row['vh_lombrices_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_lombrices_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editLombricesModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-lombrices'
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
        order: [[6, 'desc']],

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
                targets: [3, 4, 5], // Precio, Valor y Total columns formato decimal
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
                targets: [6], // Fecha column
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
                targets: [7], // Acciones column
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
<!-- Delete Lombrices Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-lombrices').forEach(button => {
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
                    fetch('./process_lombrices.php', {
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
<!-- Edit Lombrices Modal -->

<div class="modal fade" id="editLombricesModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Lombrices</h5>
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
                        <label class="form-label">Costo $</label>
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
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editLombricesForm').on('submit', function(e) {
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
                
                fetch('process_lombrices.php', {
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
                        $('#editLombricesModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
            <h5 class="card-title">Evolución Inversión Lombrices</h5>
            <div class="chart-wrapper">
                <canvas id="lombricesChart"></canvas>
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
    const ctx = document.getElementById('lombricesChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($lombricesFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const lombricesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Dosis',
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
                        text: 'Dosis'
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
    $('#addLombricesForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addLombricesForm"]').click(function(e) {
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
            $('#addLombricesForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addLombricesForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addLombricesForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addLombricesForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addLombricesForm').collapse('hide');
    }
});
</script>

<!-- Mastitis -->
<?php
// REGISTROS Mastitis
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_mastitis WHERE vh_mastitis_tagid = ? ORDER BY vh_mastitis_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_mastitis ORDER BY vh_mastitis_fecha ASC");
        $stmt->execute();
    }
    
    $mastitisData = [];
    $mastitisFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process mastitis data
    $mastitisData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($mastitisData as $row) {
        $date = new DateTime($row['vh_mastitis_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_mastitis_dosis']);
        $mastitisFechaLabels[] = $row['vh_mastitis_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($mastitisFechaLabels), null);
    foreach ($mastitisFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($mastitisFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_mastitis_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_mastitis_costo']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($mastitisFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($mastitisFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_mastitis_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_mastitis_dosis']) * floatval($row['vh_mastitis_costo']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($mastitisFechaLabels as $index => $date) {
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

<!-- Mastitis Table Section -->
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

    // Fetch all mastitis records with animal name and total value calculation
    $mastitisQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_mastitis_dosis * p.vh_mastitis_costo) AS DECIMAL(10,2)) as total_value
                  FROM vh_mastitis p 
                  LEFT JOIN vacuno v ON p.vh_mastitis_tagid = v.tagid 
                  ORDER BY p.vh_mastitis_fecha DESC";
    $stmt = $conn->prepare($mastitisQuery);
    $stmt->execute();
    $mastitisResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h3 class="container mt-4 text-white">MASTITIS</h3>

<!-- Mastitis INSERT FORM -->

<div class="container table-section" style="display: block;">
<div class="collapse mb-3" id="addMastitisForm">
    <div class="card card-body">
        <form id="mastitisForm" action="process_mastitis.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="tagid" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dosis</label>
                    <input type="number" step="0.01" class="form-control" name="dosis" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo ($)</label>
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

<!-- Mastitis Insertar Script-->
<script>
$(document).ready(function() {
    $('#mastitisForm').on('submit', function(e) {
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
                
                fetch('./process_mastitis.php', {
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
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
<!-- Mastitis DataTable -->

<div class="table-responsive">
  <!-- Add New Mastitis Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addMastitisForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="mastitisTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Producto</th>
              <th class="text-center">Dosis</th>
              <th class="text-center">Costo ($)</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($mastitisResult as $row) {
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_mastitis_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_mastitis_producto']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_mastitis_dosis']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_mastitis_costo']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_mastitis_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-mastitis'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-producto='" . htmlspecialchars($row['vh_mastitis_producto']) . "'
                    data-dosis='" . htmlspecialchars($row['vh_mastitis_dosis']) . "'
                    data-costo='" . htmlspecialchars($row['vh_mastitis_costo']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_mastitis_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editMastitisModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-mastitis'
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
        order: [[6, 'desc']],

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
                targets: [3, 4, 5], // Precio, Valor y Total columns formato decimal
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
                targets: [6], // Fecha column
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
                targets: [7], // Acciones column
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
<!-- Delete Mastitis Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-mastitis').forEach(button => {
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
                    fetch('./process_mastitis.php', {
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
<!-- Edit Mastitis Modal -->

<div class="modal fade" id="editMastitisModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Mastitis</h5>
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
                        <label class="form-label">Costo $</label>
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
        const producto = button.data('producto');
        const dosis = button.data('dosis');
        const costo = button.data('costo');
        const fecha = button.data('fecha');

        // Populate modal fields
        $('#edit_id').val(id);
        $('#edit_producto').val(producto);
        $('#edit_dosis').val(dosis);
        $('#edit_costo').val(costo);
        $('#edit_fecha').val(fecha);
    });

    // Handle form submission
    $('#editMastitisForm').on('submit', function(e) {
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
                
                fetch('process_mastitis.php', {
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
                        $('#editMastitisModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_registrar_vacunacion.php';
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
            <h5 class="card-title">Evolución Inversión Mastitis</h5>
            <div class="chart-wrapper">
                <canvas id="mastitisChart"></canvas>
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
    const ctx = document.getElementById('mastitisChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($mastitisFechaLabels); ?>;
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const regressionLine = <?php echo json_encode($regressionLine); ?>;

    // Format dates for display
    const formattedLabels = labels.map(date => {
        const d = new Date(date);
        const month = d.toLocaleString('es-ES', { month: 'short' });
        const year = d.getFullYear().toString().slice(-2);
        return `${month} '${year}`;
    });

    const mastitisChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedLabels,
            datasets: [
                {
                    label: 'Dosis',
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
                        text: 'Dosis'
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
    $('#addMastitisForm').collapse('hide');

    // Handle the click on the button that opens the form
    $('[data-bs-toggle="collapse"][data-bs-target="#addMastitisForm"]').click(function(e) {
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
            $('#addMastitisForm').collapse('hide');
        } else {
            // Only toggle if there's a tagid
            $('#addMastitisForm').collapse('toggle');
        }
    });

    // Also collapse form when search input is cleared
    $('#search').on('input', function() {
        if (!$(this).val().trim()) {
            $('#addMastitisForm').collapse('hide');
        }
    });

    // Additional safety: prevent form from being shown if no tagid
    $('#addMastitisForm').on('show.bs.collapse', function(e) {
        const tagid = $('#search').val().trim();
        if (!tagid) {
            e.preventDefault();
            $(this).collapse('hide');
        }
    });

    // Ensure form is hidden on page load if no tagid
    if (!$('#search').val().trim()) {
        $('#addMastitisForm').collapse('hide');
    }
});
</script>
</body>
</html> 