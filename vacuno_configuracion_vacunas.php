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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion Vacunas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
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
        #vacunaTable {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        #vacunaTable thead {
            background-color:rgb(126, 146, 81);
            color: white;
            border-radius: 10px;
        }
        #vacunaTable th, #vacunaTable td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        #vacunaTable tbody tr:nth-child(even) {
            background-color:rgb(234, 250, 219);
            border-radius: 10px;
        }
        #vacunaTable tbody tr:hover {
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
    </style>
</head>
<body>
   
<div class="container">
    <h3 class="section-title text-center bg-success text-white">VACUNAS</h3>
</div>
<!-- Add back button before the header container -->
<a href="./inventario_vacuno.php" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a> 
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
    <table id="vacunaTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Dosis [ml]</th>
                <th>Costo [$]</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $conn = new mysqli('localhost', $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from vacunas table
            $sql = "SELECT id, vacunas_nombre_comercial, vacunas_dosis, vacunas_costo FROM v_vacunas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['vacunas_nombre_comercial']}</td>
                            <td>{$row['vacunas_dosis']}</td>
                            <td>{$row['vacunas_costo']}</td>
                            <td>
                                <button class='btn btn-danger' onclick='deleteEntry({$row['id']})'>Delete</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#vacunaTable').DataTable();
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
</body>
</html>
