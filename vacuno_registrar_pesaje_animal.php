<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registros Pesaje Animal</title>
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
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#" data-tooltip="Poblacion">
        <img src="./images/vaca.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button type="button" data-bs-toggle="collapse" data-bs-target="#"  class="icon-button" data-tooltip="Pesaje Animal">
        <img src="./images/carne.png" alt="Pesaje Animal" class="nav-icon">
    </button>
    
    <button class="btn btn-outline-secondary mb-3" onclick="window.location.href='./vacuno_registrar_pesaje_leche.php'" data-tooltip="Pesaje Leche">
        <img src="./images/leche-cantaro.png" alt="Inicio" class="nav-icon">
    </button>
    
    <button class="btn btn-outline-secondary mb-3" onclick="window.location.href='./vacuno_registrar_alimentacion.php'" class="icon-button" data-tooltip="Configurar Tablas">
        <img src="./images/trigo.png" alt="Inicio" class="nav-icon">
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
// REGISTROS PESAJE ANIMAL
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM vh_peso WHERE vh_peso_tagid = ? ORDER BY vh_peso_fecha ASC");
        $stmt->execute([$_GET['search']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM vh_peso ORDER BY vh_peso_fecha ASC");
        $stmt->execute();
    }
    
    $pesoData = [];
    $pesoFechaLabels = [];
    $monthlyWeights = [];
    $regressionLine = [];
    
    // Process peso data
    $pesoData = $stmt->fetchAll(); // Fetch all records at once
    foreach ($pesoData as $row) {
        $date = new DateTime($row['vh_peso_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyWeights[$monthKey])) {
            $monthlyWeights[$monthKey] = [];
        }
        $monthlyWeights[$monthKey][] = floatval($row['vh_peso_animal']);
        $pesoFechaLabels[] = $row['vh_peso_fecha'];
    }

    // Initialize and calculate monthly data
    $monthlyData = array_fill(0, count($pesoFechaLabels), null);
    foreach ($pesoFechaLabels as $index => $date) {
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
    $monthlyPriceData = array_fill(0, count($pesoFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_peso_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyPrices[$monthKey])) {
            $monthlyPrices[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $monthlyPrices[$monthKey]['sum'] += floatval($row['vh_peso_precio']);
        $monthlyPrices[$monthKey]['count']++;
    }

    foreach ($pesoFechaLabels as $index => $date) {
        $month = (new DateTime($date))->format('Y-m');
        if (isset($monthlyPrices[$month]) && $monthlyPrices[$month]['count'] > 0) {
            $monthlyPriceData[$index] = $monthlyPrices[$month]['sum'] / $monthlyPrices[$month]['count'];
        }
    }

    // Calculate monthly values
    $stmt->execute(); // Re-execute to reset the cursor
    $monthlyValues = [];
    $monthlyValueData = array_fill(0, count($pesoFechaLabels), null);

    while ($row = $stmt->fetch()) {
        $date = new DateTime($row['vh_peso_fecha']);
        $monthKey = $date->format('Y-m');

        if (!isset($monthlyValues[$monthKey])) {
            $monthlyValues[$monthKey] = ['sum' => 0, 'count' => 0];
        }

        $totalValue = floatval($row['vh_peso_animal']) * floatval($row['vh_peso_precio']);
        $monthlyValues[$monthKey]['sum'] += $totalValue;
        $monthlyValues[$monthKey]['count']++;
    }

    foreach ($pesoFechaLabels as $index => $date) {
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

<!-- Peso Table Section -->
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

    // Fetch all peso records with animal name and total value calculation
    $pesoQuery = "SELECT p.*, 
                         v.nombre as animal_nombre,
                         CAST((p.vh_peso_animal * p.vh_peso_precio) AS DECIMAL(10,2)) as total_value
                  FROM vh_peso p 
                  LEFT JOIN vacuno v ON p.vh_peso_tagid = v.tagid 
                  ORDER BY p.vh_peso_fecha DESC";
    $stmt = $conn->prepare($pesoQuery);
    $stmt->execute();
    $pesosResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Remove the redundant total calculation query since it's now included above

?>
<div class="container text-center">
    <!-- Search Form -->
    <form method="GET" class="text-center mb-4">
        <div class="input-group text-center">
            <input type="text" id="search" name="search" placeholder="Buscar por Numero..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-success">Buscar</button>
        </div>
    </form>
</div>

<h3  class="container mt-4 text-white" class="collapse" id="section-historial-produccion-vacuno">
REGISTROS PESAJE ANIMAL
</h3>



<!-- NEW PESO FORM -->

<div class="container table-section" style="display: block;">
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

<!-- PESO Insertar Script-->
<script>
$(document).ready(function() {
    $('#pesoForm').on('submit', function(e) {
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
                
                fetch('process_peso.php', {
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
                            window.location.href = data.redirect || 'vacuno_historial.php';
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
<!-- PESO DataTable -->

<div class="table-responsive">
  <!-- Add New Peso Form -->
  <button class="btn btn-success mb-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#addPesoForm">
  <i class="fas fa-plus"></i> Registrar
  </button>
  <table id="pesosTable" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Peso (kg)</th>
              <th class="text-center">Precio</th>
              <th class="text-center">Total ($)</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>

          </tr>
      </thead>
      <tbody>
<?php
// Display tables
foreach ($pesosResult as $row) {
    if ($row['vh_peso_tagid'] == '3000') {
        error_log("Debug - TagID 3000:");
        error_log("peso_animal: " . $row['vh_peso_animal']);
        error_log("peso_precio: " . $row['vh_peso_precio']);
        error_log("total_value: " . $row['total_value']);
    }
    echo "<tr>";    
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_peso_tagid']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['animal_nombre']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_peso_animal']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_peso_precio']) . "</td>";
    echo "<td class='text-center'>" . number_format($row['total_value'], 2, '.', ',') . "</td>"; // Format with 2 decimal places
    echo "<td class='text-center'>" . htmlspecialchars($row['vh_peso_fecha']) . "</td>";
    echo "<td class='text-center'>

            <button class='btn btn-success btn-sm edit-peso'
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-peso='" . htmlspecialchars($row['vh_peso_animal']) . "'
                    data-precio='" . htmlspecialchars($row['vh_peso_precio']) . "'
                    data-fecha='" . htmlspecialchars($row['vh_peso_fecha']) . "'
                    data-bs-toggle='modal'
                    data-bs-target='#editPesoModal'>
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-danger btn-sm delete-peso'
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
        // Add custom classes for styling
        pagingType: "simple_numbers",
        classes: {
            sPageButton: "paginate_button",
        },

 // Column specific settings
 columnDefs: [
            {
                targets: [2, 3, 4], // Peso, Precio, Valor Total columns
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
                targets: [5], // Fecha column
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
                targets: [6], // Acciones column
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
<!-- Delete Peso Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all delete buttons
    document.querySelectorAll('.delete-peso').forEach(button => {
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
                    fetch('./process_peso.php', {
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

    // Handle form submission
    $('#editPesoForm').on('submit', function(e) {
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
                
                fetch('process_peso.php', {
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
                        $('#editPesoModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El registro ha sido actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = data.redirect || 'vacuno_historial.php';
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

<!-- Scroll to Section-->

<script>
// Add event listeners to all scroll buttons
document.querySelectorAll('.scroll-Icons-container button').forEach(button => {
    button.addEventListener('click', function() {
        // Get the target section ID from data-bs-target attribute
        const targetId = this.getAttribute('data-bs-target').substring(1); // Remove the # from the ID
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

<!-- Chart Container -->
<div class="chart-container">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title">Evolución Produccion Carnica</h5>
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('weightChart').getContext('2d');
    
    // Prepare data for the chart
    const labels = <?php echo json_encode($pesoFechaLabels); ?>;
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
                    label: 'Peso Mensual (kg)',
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
                    text: 'Evolución Carnica (Tendencia)',
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
                        text: 'Peso (kg)'
                    }
                }
            }
        }
    });
});
</script>
</body>
</html> 