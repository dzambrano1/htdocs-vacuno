<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

?>

<!DOCTYPE html>
<html lang="en">
<link>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css"></link>
    <link rel="stylesheet" href="./vacuno.css" />
<style>
    :root { 
    --primary-color: #e0e8dc;
    --secondary-color: #4a5d23;
    --background-color: #f8f9fa;
    --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.nav-icons-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 0;

    gap: 50px;
    flex-wrap: wrap;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    margin: 10px 0;
}
.scroll-Icons-container{
  width: 90%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px 0;
  gap: 10px;
  flex-wrap: wrap;
}

@media (max-width: 768px) {
    .icon-nav-container {
        gap: 15px;
    }
}

.icon-nav-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 0px;
    padding-top: 0px;
    margin-top: 0px;
    padding-bottom: 0px;
    margin-bottom: 0px;
    padding-left: 0px;
    margin-left: 0px;
    padding-right: 0px;
    margin-right: 0px;
}

.icon-button {
    background: white;
    border: 1px solid #ccc;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    padding: 0;
}

.nav-icon {
    width: 24px;
    height: 24px;
    transition: all 0.3s ease;
}

.icon-button:hover .nav-icon {
    transform: scale(1.2);
}

.icon-button:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Tooltip Styles */
.icon-button::before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: -30px;
    left: 50%;
    transform: translateX(-50%);
    padding: 4px 8px;
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    font-size: 12px;
    border-radius: 4px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.icon-button:hover::before {
    opacity: 1;
    visibility: visible;
}

@media (max-width: 768px) {
    .icon-nav-container {
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .icon-button {
        width: 40px;
        height: 40px;
    }
    
    .nav-icon {
        width: 20px;
        height: 20px;
    }
}
body {
    font-family: Arial, sans-serif;
    background-color:rgba(220, 241, 202, 0);
    margin: 0;
    padding: 0;
}
.section-title {
    padding: 10px;
    border-radius: 5px;
}
.modal-header {
    background-color:rgb(157, 179, 108);
    color: white;
}
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}
.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}
.btn-primary {
    background-color:rgb(90, 151, 111);
    border-color:rgb(220, 233, 195);
}
.btn-primary:hover {
    background-color:rgb(77, 105, 59);
    border-color:rgb(41, 41, 41);
}
#alimentacionTable {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}
#alimentacionTable thead {
    background-color:rgb(126, 146, 81);
    color: white;
    border-radius: 10px;
}
#alimentacionTable th, #alimentacionTable td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 10px;
}
#alimentacionTable tbody tr:nth-child(even) {
    background-color:rgb(234, 250, 219);
    border-radius: 10px;
}
#alimentacionTable tbody tr:hover {
    background-color: rgb(219, 243, 205);
}
.back-btn {
    position: fixed;
    top: 40px;
    left: 50px;
    font-size: 80px;
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
        font-size: 40px;
        left: 20px;
        top: 80px;
    }
}

@media screen and (max-width: 480px) {
    .back-btn {
        font-size: 48px;
        left: 10px;
        top: 10px;
    }
}

/* Responsive Table Styles */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto; /* Enable horizontal scrolling */
    }

    .table {
        width: 100%; /* Full width for the table */
        display: block; /* Make the table block-level */
        overflow-x: auto; /* Enable horizontal scrolling */
        white-space: nowrap; /* Prevent text wrapping */
    }

    th, td {
        text-align: left; /* Align text to the left */
        padding: 8px; /* Add padding for better spacing */
    }

    /* Style for toggle arrows */
    .toggle-arrow {
        color: black; /* Change arrow color to black */
        font-size: 0.75em; /* Make the arrow 50% smaller */
        cursor: pointer; /* Change cursor to pointer */
        padding: 5px; /* Add padding for better click area */
        background-color: rgba(255, 255, 255, 0.8); /* Light background for visibility */
        border-radius: 5px; /* Rounded corners */
        margin-left: 5px; /* Space between button and arrow */
        display: inline-block; /* Ensure it behaves like a block for padding */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Add shadow for depth */
    }

    /* Initially hide extra columns */
    .extra-column {
        display: none; /* Hide extra columns by default */
    }

    /* Style for delete icon */
    .delete-icon {
        color: red; /* Red color for the delete icon */
        cursor: pointer; /* Change cursor to pointer */
        font-size: 1.5em; /* Size of the icon */
    }
}

/* Ensure toggle arrows are styled consistently on larger screens */
@media (min-width: 769px) {
    .toggle-arrow {
        font-size: 0.75em; /* Maintain size on larger screens */
        color: black; /* Maintain color on larger screens */
    }

    /* Ensure delete icon remains red on larger screens */
    .delete-icon {
        color: red; /* Red color for the delete icon */
    }
}

/* Center all table content including Acciones column */
.table td, .table th {
    text-align: center !important;
    vertical-align: middle !important;
}

/* Specific styling for the Acciones column and delete icon */
.delete-icon {
    color: red;
    cursor: pointer;
    font-size: 1.2em;
    display: inline-block; /* Ensures the icon stays centered */
}

/* Center the content of the last column (Acciones) */
.table td:last-child {
    text-align: center !important;
    width: 100px; /* Fixed width for consistency */
}

/* Ensure the trash icon container is centered */
.table td:last-child i {
    display: block;
    margin: 0 auto;
    width: fit-content;
}
</style>
</head>
<body>

<div class="container" id="nav-buttons">
  <!-- Icon Navigation Buttons -->
  <div class="container nav-icons-container">
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
</div>

<!-- Scroll Icons Container -->
<div class="container scroll-Icons-container">
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#Section-configuracion-alimentacion-vacuno" data-tooltip="Alimentacion">
        <img src="./images/bolso.png" alt="Alimentacion" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#Section-configuracion-salud-vacuno" data-tooltip="Salud">
        <img src="./images/vacunacion.png" alt="Salud" class="nav-icon">
    </button>
       
    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#Section-configuracion-razas-vacuno" data-tooltip="Razas">
        <img src="./images/raza.png" alt="Razas" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#Section-configuracion-grupos-vacuno" data-tooltip="Grupos">
        <img src="./images/grupo.png" alt="Grupo" class="nav-icon">
    </button>

    <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-target="#Section-configuracion-estatus-vacuno" data-tooltip="Estatus">
        <img src="./images/estatus.png" alt="Estatus" class="nav-icon">
    </button>
</div>

<h3  class="container mt-4" class="collapse" id="Section-configuracion-alimentacion-vacuno">
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
<h3  class="container mt-4" class="collapse" id="Section-configuracion-salud-vacuno">
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
<h3  class="container mt-4" class="collapse" id="Section-configuracion-razas-vacuno">
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
<h3  class="container mt-4" class="collapse" id="Section-configuracion-grupos-vacuno">
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
<h3  class="container mt-4" class="collapse" id="Section-configuracion-estatus-vacuno">
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

<!-- Back to top button -->
<button id="backToTop" class="back-to-top" onclick="scrollToTop()" title="Volver arriba">
    <div class="arrow-up"></div>
</button>
<style>
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 45px;
    height: 45px;
    background-color: #ffffff;
    border: 2px solid #4caf50;
    border-radius: 50%;
    display: none;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    z-index: 9999;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.arrow-up {
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-bottom: 12px solid #4caf50;
}

.back-to-top:hover {
    background-color: #4caf50;
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.back-to-top:hover .arrow-up {
    border-bottom-color: #ffffff;
}

@media (max-width: 768px) {
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
    }
    
    .arrow-up {
        border-left-width: 6px;
        border-right-width: 6px;
        border-bottom-width: 10px;
    }
}
</style>

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

