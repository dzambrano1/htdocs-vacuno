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

?>
<!DOCTYPE html>
<html lang="en">
<link>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Config Alimento</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css"></link>
    <link href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css"></link>
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css"></link>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgba(220, 241, 202, 0);
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 20px;
            width: 90%;
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
    </style>
</head>
<body>
   
<div class="container">
    <h3 class="section-title text-center bg-success text-white">ALIMENTACION</h3>
</div>
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

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
<script>
    $(document).ready(function() {
        
        new DataTable('#alimentacionTable', {
    fixedHeader: true,
    responsive: true
    });
    });
</script>

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
</body>
</html>
