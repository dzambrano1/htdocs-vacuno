<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

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
<div class="container nav-icons-container" id="nav-buttons">

    <button onclick="window.location.href='../inicio.php'" class="icon-button" data-tooltip="Inicio">
        <img src="./images/Ganagram_New_Logo-png.png" alt="Inicio" class="nav-icon">
    </button>
    
    <button onclick="window.location.href='./vacuno_historial.php'" class="icon-button" data-tooltip="Registrar Ganado">
        <img src="./images/registros.png" alt="Inicio" class="nav-icon">
    </button>
        
    <button onclick="window.location.href='./inventario_vacuno.php'" class="icon-button" data-tooltip="Inventario Vacuno">
        <img src="./images/vacas.png" alt="Inventario" class="nav-icon">
    </button>

    <button onclick="window.location.href='./vacuno_indices.php'" class="icon-button" data-tooltip="Indices Vacunos">
        <img src="./images/fondo-indexado.png" alt="Inicio" class="nav-icon">
    </button>

</div>

<!-- Scroll Icons Container -->
<div class="container scroll-icons-container">
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#Section-configuracion-alimentacion-vacuno" data-tooltip="Alimentacion">
        <img src="./images/bolso.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#Section-configuracion-salud-vacuno" data-tooltip="Salud">
        <img src="./images/vacunacion.png" alt="Salud" class="nav-icon">
    </button>
       
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#Section-configuracion-razas-vacuno" data-tooltip="Razas">
        <img src="./images/raza.png" alt="Razas" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#Section-configuracion-grupos-vacuno" data-tooltip="Grupos">
        <img src="./images/grupo.png" alt="Grupo" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#Section-configuracion-estatus-vacuno" data-tooltip="Estatus">
        <img src="./images/estatus.png" alt="Estatus" class="nav-icon">
    </button>
</div>

<h3 class="container mt-4 text-white" class="collapse" id="Section-configuracion-alimentacion-vacuno">
ALIMENTACION
</h3>
<!-- Add back button before the header container -->
<a href="./inventario_vacuno.php" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a> 
<!-- Button to Open the Modal -->
<div class="container mt-3 text-center">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#alimentoModal">
        <i class="fas fa-plus"></i>
    </button>
</div>
<!-- The Modal -->
<div class="modal fade" id="alimentoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Alimento</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="process_alimento.php" method="post" id="concentrado-form">
                    <div class="form-group">
                        <label for="alimento">Nombre Producto:</label>
                        <input type="text" class="form-control" id="alimento" name="alimento" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="Concentrado">Concentrado</option>
                            <option value="Sal">Sal</option>
                            <option value="Melaza">Melaza</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="etapa">Etapa:</label>
                        <select class="form-control" id="etapa" name="etapa" required>
                            <option value="Inicio">Inicio</option>
                            <option value="Crecimiento">Crecimiento</option>
                            <option value="Finalizacion">Finalización</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="racion">Ración [Kg]:</label>
                        <input type="text" class="form-control" id="racion" name="racion" required>
                    </div>
                    <div class="form-group">
                        <label for="costo">Costo [$]:</label>
                        <input type="text" class="form-control" id="costo" name="costo" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTable -->
<div class="container mt-5">
    <div class="table-responsive"> <!-- Add responsive wrapper -->
        <table id="alimentacionTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th> <!-- Column for toggle arrows -->                    
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Etapa</th> <!-- Extra column -->
                    <th>Ración [Kg]</th> <!-- Extra column -->
                    <th>Costo [$]</th> <!-- Extra column -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from alimento table
                $sql = "SELECT id, nombre_producto, tipo, etapa, racion, costo FROM v_alimento";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>
                                    <span class='toggle-arrow' onclick='toggleRowColumns(this)'>▶</span> <!-- Toggle arrow -->
                                </td>                                
                                <td>{$row['nombre_producto']}</td>
                                <td>{$row['tipo']}</td>
                                <td>{$row['etapa']}</td>
                                <td>{$row['racion']}</td>
                                <td>{$row['costo']}</td>
                                <td>
                                    <i class='fas fa-trash delete-icon' onclick='deleteEntry({$row['id']})'></i> <!-- Red basket icon -->
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Salud -->
<h3 class="container mt-4 text-white" class="collapse" id="Section-configuracion-salud-vacuno">
SALUD
</h3>

<!-- Add back button before the header container --> 
<!-- Button to Open the Modal -->
<div class="container mt-3 text-center">

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#vacunaModal">
        <i class="fas fa-plus"></i>
    </button>
</div>
<!-- The Modal -->
<div class="modal fade" id="vacunaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Vacuna</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="process_vacunas.php" method="post" id="vacunas-form">
                    <div class="form-group">
                        <label for="vacunas">Nombre Producto:</label>
                        <input type="text" class="form-control" id="vacunas" name="vacunas_nombre_comercial" required>
                    </div>
                    <div class="form-group">
                        <label for="dosis">Dosis [ml]:</label>
                        <input type="text" class="form-control" id="dosis" name="vacunas_dosis" required>
                    </div>
                    <div class="form-group">
                        <label for="vacunas_costo">Costo [$]:</label>
                        <input type="text" class="form-control" id="vacunas_costo" name="vacunas_costo" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTable -->
<div class="container mt-5">
    <div class="table-responsive">
        <table id="vacunaTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Dosis [ml]</th>
                    <th>Costo [$]</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT id, vacunas_nombre_comercial, vacunas_dosis, vacunas_costo FROM v_vacunas";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><span class='toggle-arrow' onclick='toggleRowColumns(this)'>▶</span></td>
                                <td>{$row['vacunas_nombre_comercial']}</td>
                                <td class='extra-column'>{$row['vacunas_dosis']}</td>
                                <td class='extra-column'>{$row['vacunas_costo']}</td>
                                <td>
                                    <i class='fas fa-trash delete-icon' onclick='deleteEntry({$row['id']})'></i>
                                </td>
                              </tr>";
                    }
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Razas -->

<!-- Razas -->
<h3  class="container mt-4 text-white" class="collapse" id="Section-configuracion-razas-vacuno">
RAZAS
</h3>

<!-- Button to Open the Modal -->
<div class="container mt-3 text-center">

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#razaModal">
        <i class="fas fa-plus"></i>

    </button>
</div>
<!-- The Modal -->
<div class="modal fade" id="razaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Raza</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="process_razas.php" method="post" id="razas-form">
                    <div class="form-group">
                        <label for="razas">Raza:</label>
                        <input type="text" class="form-control" id="razas" name="razas_nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTable -->
<div class="container mt-5">
    <div class="table-responsive">
        <table id="razasTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Razas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT id, razas_nombre FROM v_razas";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><span class='toggle-arrow' onclick='toggleRowColumns(this)'>▶</span></td>
                                <td>{$row['razas_nombre']}</td>
                                <td>
                                    <i class='fas fa-trash delete-icon' onclick='deleteEntry({$row['id']})'></i>
                                </td>
                              </tr>";
                    }
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Grupos -->
<h3 class="container mt-4 text-white" class="collapse" id="Section-configuracion-grupos-vacuno">
GRUPOS
</h3>


<!-- Button to Open the Modal -->
<div class="container mt-3 text-center">

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#grupoModal">
        <i class="fas fa-plus"></i>
    </button>
</div>
<!-- The Modal -->
<div class="modal fade" id="grupoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Grupo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="process_grupos.php" method="post" id="grupos-form">
                    <div class="form-group">
                        <label for="grupos">Grupo:</label>
                        <input type="text" class="form-control" id="grupos" name="grupos_nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTable -->
<div class="container mt-5">
    <div class="table-responsive">
        <table id="gruposTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Grupos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT id, grupos_nombre FROM v_grupos";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><span class='toggle-arrow' onclick='toggleRowColumns(this)'>▶</span></td>
                                <td>{$row['grupos_nombre']}</td>
                                <td>
                                    <i class='fas fa-trash delete-icon' onclick='deleteEntry({$row['id']})'></i>
                                </td>
                              </tr>";
                    }
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Estatus -->
<h3 class="container mt-4 text-white" class="collapse" id="Section-configuracion-estatus-vacuno">
ESTATUS
</h3>

<!-- Button to Open the Modal -->
<div class="container mt-3 text-center">

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#estatusModal">
        <i class="fas fa-plus"></i>
    </button>
</div>
<!-- The Modal -->
<div class="modal fade" id="estatusModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Estatus</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="process_estatus.php" method="post" id="estatus-form">
                    <div class="form-group">
                        <label for="estatus">Estatus:</label>
                        <input type="text" class="form-control" id="estatus" name="estatus_nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTable -->
<div class="container mt-5">
    <div class="table-responsive">
        <table id="estatusTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT id, estatus_nombre FROM v_estatus";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><span class='toggle-arrow' onclick='toggleRowColumns(this)'>▶</span></td>
                                <td>{$row['estatus_nombre']}</td>
                                <td>
                                    <i class='fas fa-trash delete-icon' onclick='deleteEntry({$row['id']})'></i>
                                </td>
                              </tr>";
                    }
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>

<script>
function deleteEntry(id) {
    if (confirm("Are you sure you want to delete this entry?")) {
        // Make an AJAX request to delete the entry
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_entry.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Reload the page or update the table
                location.reload(); // Reload the page to see the changes
            }
        };
        xhr.send("id=" + id);
    }
}
</script>

<script>
    function toggleRowColumns(element) {
        // Get the parent row of the clicked toggle arrow
        const row = element.closest('tr');
        // Get all extra columns in this row
        const extraColumns = row.querySelectorAll('.extra-column');
        const isHidden = extraColumns[0].style.display === 'none';

        // Toggle visibility of extra columns in this row
        extraColumns.forEach(col => {
            col.style.display = isHidden ? 'table-cell' : 'none'; // Show or hide
        });

        // Change the arrow direction
        element.innerHTML = isHidden ? '▼' : '▶'; // Change arrow direction
    }
</script>
<!-- Scroll to Section-->

<script>
document.querySelectorAll('.scroll-icons-container button').forEach(button => {
    button.addEventListener('click', function() {
        // Get the target section ID from data-bs-target attribute
        const targetId = this.getAttribute('data-bs-target');
        const targetElement = document.getElementById(targetId.substring(1)); // Remove the # from the ID
        
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

</body>
</html>

