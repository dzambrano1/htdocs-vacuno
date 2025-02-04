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

// Retrieve the tagid from the request using the 'search' parameter
$tagid = isset($_GET['search']) ? $_GET['search'] : null; // Get the 'search' parameter

// Fetch the latest vh_peso_animal, vh_peso_fecha, vh_peso_precio value from the vh_peso table for the given tagid
$latestPesoAnimal = null;
$latestPesoAnimalFecha = null;
$latestPesoAnimalPrecio = null;
if ($tagid) {
    $query = "SELECT * FROM vh_peso WHERE vh_peso_tagid = ? ORDER BY vh_peso_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestPesoAnimal = $row['vh_peso_animal'] ?? null;
        $latestPesoAnimalFecha = $row['vh_peso_fecha'] ?? null;
        $latestPesoAnimalPrecio = $row['vh_peso_precio'] ?? null;
    }
}

// Fetch the latest vh_leche_peso, vh_leche_costo, vh_leche_fecha value from the vh_leche table for the given tagid
$latestLechePeso = null;
$latestLecheFecha = null;
$latestLechePrecio = null;
if ($tagid) {
    $query = "SELECT * FROM vh_leche WHERE vh_leche_tagid = ? ORDER BY vh_leche_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestLechePeso = $row['vh_leche_peso'] ?? null;
        $latestLecheFecha = $row['vh_leche_fecha'] ?? null;
        $latestLechePrecio = $row['vh_leche_precio'] ?? null;
    }
}

// Fetch the latest vh_queso_peso, vh_queso_costo, vh_queso_fecha value from the vh_queso table for the given tagid
$latestQuesoPeso = null;
$latestQuesoFecha = null;
$latestQuesoPrecio = null;
if ($tagid) {
    $query = "SELECT * FROM vh_queso WHERE vh_queso_tagid = ? ORDER BY vh_queso_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestQuesoPeso = $row['vh_queso_peso'] ?? null;
        $latestQuesoFecha = $row['vh_queso_fecha'] ?? null;
        $latestQuesoPrecio = $row['vh_queso_precio'] ?? null;
    }
}

// Fetch the latest vh_Aftosa_producto, vh_aftosa_costo, vh_aftosa_fecha value from the vh_aftosa table for the given tagid
$latestAftosaProducto = null;
$latestAftosaDosis = null;
$latestAftosaCosto = null;
$latestAftosafecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_aftosa WHERE vh_aftosa_tagid = ? ORDER BY vh_aftosa_fecha DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestAftosaProducto = $row['vh_aftosa_producto'] ?? null;
        $latestAftosaDosis = $row['vh_aftosa_dosis'] ?? null;
        $latestAftosaCosto = $row['vh_aftosa_costo'] ?? null;
        $latestAftosaFecha = $row['vh_aftosa_fecha'] ?? null;
    }
}

// Fetch the latest vh_ibr_producto, vh_ibr_costo, vh_ibr_fecha value from the vh_ibr table for the given tagid
$latestIbrProducto =null;
$latestIbrDosis =null;
$latestIbrCosto = null;
$latestIbrfecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_ibr WHERE vh_ibr_tagid = ? ORDER BY vh_ibr_fecha DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestIbrProducto = $row['vh_ibr_producto'] ?? null;
        $latestIbrDosis = $row['vh_ibr_dosis'] ?? null;
        $latestIbrCosto = $row['vh_ibr_costo'] ?? null;
        $latestIbrFecha = $row['vh_ibr_fecha'] ?? null;
    }
}

// Fetch the latest vh_cbr_producto, vh_cbr_costo, vh_cbr_fecha value from the vh_cbr table for the given tagid
$latestCbrProducto =null;
$latestCbrDosis =null;
$latestCbrCosto = null;
$latestCbrfecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_cbr WHERE vh_cbr_tagid = ? ORDER BY vh_cbr_fecha DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestCbrProducto = $row['vh_cbr_producto'] ?? null;
        $latestCbrDosis = $row['vh_cbr_dosis'] ?? null;
        $latestCbrCosto = $row['vh_cbr_costo'] ?? null;
        $latestCbrFecha = $row['vh_cbr_fecha'] ?? null;
    }
}

// Fetch the latest vh_brucelosis_producto, vh_brucelosis_costo, vh_brucelosis_fecha value from the vh_brucelosis table for the given tagid
$latestBrucelosisProducto =null;
$latestBrucelosisDosis =null;
$latestBrucelosisCosto = null;
$latestBrucelosisfecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_brucelosis WHERE vh_brucelosis_tagid = ? ORDER BY vh_brucelosis_fecha DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestBrucelosisProducto = $row['vh_brucelosis_producto'] ?? null;
        $latestBrucelosisDosis = $row['vh_brucelosis_dosis'] ?? null;
        $latestBrucelosisCosto = $row['vh_brucelosis_costo'] ?? null;
        $latestBrucelosisFecha = $row['vh_brucelosis_fecha'] ?? null;
    }
}

// Fetch the latest vh_carbunco_producto, vh_carbunco_costo, vh_carbunco_fecha value from the vh_carbunco table for the given tagid
$latestCarbuncoProducto =null;
$latestCarbuncoDosis =null;
$latestCarbuncoCosto = null;
$latestCarbuncofecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_carbunco WHERE vh_carbunco_tagid = ? ORDER BY vh_carbunco_fecha DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestCarbuncoProducto = $row['vh_carbunco_producto'] ?? null;
        $latestCarbuncoDosis = $row['vh_carbunco_dosis'] ?? null;
        $latestCarbuncoCosto = $row['vh_carbunco_costo'] ?? null;
        $latestCarbuncoFecha = $row['vh_carbunco_fecha'] ?? null;
    }
}

// Fetch the latest vh_garrapatas, vh_garrapatas_costo, vh_garrapatas_fecha value from the vh_garrapatas table for the given tagid
$latestGarrapatasProducto = null;
$latestGarrapatasDosis = null;
$latestGarrapatasCosto = null;
$latestGarrapatasFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_garrapatas WHERE vh_garrapatas_tagid = ? ORDER BY vh_garrapatas_fecha DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestGarrapatasProducto = $row['vh_garrapatas_producto'] ?? null;
        $latestGarrapatasDosis = $row['vh_garrapatas_dosis'] ?? null;
        $latestGarrapatasCosto = $row['vh_garrapatas_costo'] ?? null;
        $latestGarrapatasFecha = $row['vh_garrapatas_fecha'] ?? null;        
    }
}

// Fetch the latest vh_parasitos, vh_parasitos_costo, vh_parasitos_fecha value from the vh_parasitos table for the given tagid
$latestParasitosProducto = null;
$latestParasitosDosis = null;
$latestParasitosFecha = null;
$latestParasitosCosto = null;
if ($tagid) {
    $query = "SELECT * FROM vh_parasitos WHERE vh_parasitos_tagid = ? ORDER BY vh_parasitos_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestParasitosProducto = $row['vh_parasitos_producto'] ?? null;
        $latestParasitosDosis = $row['vh_parasitos_dosis'] ?? null;
        $latestParasitosFecha = $row['vh_parasitos_fecha'] ?? null;
        $latestParasitosCosto = $row['vh_parasitos_costo'] ?? null;
    }
}

// Fetch the latest vh_mastitis, vh_mastitis_costo, vh_mastitis_fecha value from the vh_mastitis table for the given tagid
$latestMastitisProducto = null;
$latestMastitisDosis = null;
$latestMastitisCosto = null;
$latestMastitisFecha = null;

if ($tagid) {
    $query = "SELECT * FROM vh_mastitis WHERE vh_mastitis_tagid = ? ORDER BY vh_mastitis_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestMastitisProducto = $row['vh_mastitis_producto'] ?? null;
        $latestMastitisDosis = $row['vh_mastitis_dosis'] ?? null;
        $latestMastitisCosto = $row['vh_mastitis_costo'] ?? null;
        $latestMastitisFecha = $row['vh_mastitis_fecha'] ?? null;        
    }
}

// Fetch the latest vh_lombrices, vh_lombrices_costo, vh_lombrices_fecha value from the vh_lombrices table for the given tagid
$latestlombricesProducto = null;
$latestlombricesDosis = null;
$latestlombricesCosto = null;
$latestlombricesFecha = null;

if ($tagid) {
    $query = "SELECT * FROM vh_lombrices WHERE vh_lombrices_tagid = ? ORDER BY vh_lombrices_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestlombricesProducto = $row['vh_lombrices_producto'] ?? null;
        $latestlombricesDosis = $row['vh_lombrices_dosis'] ?? null;
        $latestlombricesCosto = $row['vh_lombrices_costo'] ?? null;
        $latestlombricesFecha = $row['vh_lombrices_fecha'] ?? null;        
    }
}

// Fetch the latest vh_concentrado, vh_concentrado_peso, vh_concentrado_fecha vh_concentrado_costo,  value from the vh_concentrado table for the given tagid
$latestConcentrado = null;
$latestConcentradoEtapa = null;
$latestConcentradoRacion = null;
$latestConcentradoFecha = null;
$latestConcentradoCosto = null;
if ($tagid) {
    $query = "SELECT * FROM vh_concentrado WHERE vh_concentrado_tagid = ? ORDER BY vh_concentrado_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestConcentrado = $row['vh_concentrado_producto'] ?? null; 
        $latestConcentradoEtapa = $row['vh_concentrado_etapa'] ?? null;
        $latestConcentradoRacion = $row['vh_concentrado_racion'] ?? null; 
        $latestConcentradoFecha = $row['vh_concentrado_fecha'] ?? null; 
        $latestConcentradoCosto = $row['vh_concentrado_costo'] ?? null; 
    }
}

// Fetch the latest vh_sal, vh_sal_costo, vh_sal_fecha value from the vh_sal table for the given tagid
$latestSalEtapa = null;
$latestSalProducto = null;
$latestSalRacion = null;
$latestSalCosto = null;
$latestSalFecha = null;

if ($tagid) {
    $query = "SELECT * FROM vh_sal WHERE vh_sal_tagid = ? ORDER BY vh_sal_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestSalEtapa = $row['vh_sal_etapa'] ?? null;
        $latestSalProducto = $row['vh_sal_producto'] ?? null;
        $latestSalRacion = $row['vh_sal_racion'] ?? null;
        $latestSalCosto = $row['vh_sal_costo'] ?? null;
        $latestSalFecha = $row['vh_sal_fecha'] ?? null;
    }
}

// Fetch the latest vh_melaza, vh_melaza_costo, vh_melaza_fecha value from the vh_melaza table for the given tagid
$latestMelazaEtapa = null;
$latestMelazaProducto = null;
$latestMelazaRacion = null;
$latestMelazaCosto = null;
$latestMelazaFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_melaza WHERE vh_melaza_tagid = ? ORDER BY vh_melaza_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestMelazaEtapa = $row['vh_melaza_etapa'] ?? null;
        $latestMelazaProducto = $row['vh_melaza_producto'] ?? null;
        $latestMelazaRacion = $row['vh_melaza_racion'] ?? null;
        $latestMelazaCosto = $row['vh_melaza_costo'] ?? null;
        $latestMelazaFecha = $row['vh_melaza_fecha'] ?? null;
        
    }
}

// Fetch the latest vh_inseminacion, vh_inseminacion_costo, vh_inseminacion_fecha value from the vh_inseminacion table for the given tagid
$latestInseminacionNumero = null;
$latestInseminacionFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_inseminacion WHERE vh_inseminacion_tagid = ? ORDER BY vh_inseminacion_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestInseminacionNumero = $row['vh_inseminacion_numero'] ?? null;
        $latestInseminacionFecha = $row['vh_inseminacion_fecha'] ?? null;
    }
}

// Fetch the latest vh_gestacion, vh_gestacion_costo, vh_gestacion_fecha value from the vh_gestacion table for the given tagid
$latestGestacionNumero = null;
$latestGestacionFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_gestacion WHERE vh_gestacion_tagid = ? ORDER BY vh_gestacion_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestGestacionNumero = $row['vh_gestacion_numero'] ?? null;
        $latestGestacionFecha = $row['vh_gestacion_fecha'] ?? null;        
    }
}

// Fetch the latest vh_parto, vh_parto_costo, vh_parto_fecha value from the vh_parto table for the given tagid
$latestPartoNumero = null;
$latestPartoFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_parto WHERE vh_parto_tagid = ? ORDER BY vh_parto_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestPartoNumero = $row['vh_parto_numero'] ?? null;
        $latestPartoFecha = $row['vh_parto_fecha'] ?? null;        
    }
}

// Fetch the latest vh_aborto, vh_aborto_costo, vh_aborto_fecha value from the vh_aborto table for the given tagid
$latestAbortoCausa = null;
$latestAbortoFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_aborto WHERE vh_aborto_tagid = ? ORDER BY vh_aborto_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestAbortoCausa = $row['vh_aborto_causa'] ?? null;
        $latestAbortoFecha = $row['vh_aborto_fecha'] ?? null;   
    }
}

// Fetch the latest vh_venta, vh_venta_costo, vh_venta_fecha value from the vh_venta table for the given tagid
$latestVentaMonto = null;
$latestVentaFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_venta WHERE vh_venta_tagid = ? ORDER BY vh_venta_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestVentaMonto = $row['vh_venta_monto'] ?? null;
        $latestVentaFecha = $row['vh_venta_fecha'] ?? null;        
    }
}

// Fetch the latest vh_destete, vh_destete_costo, vh_destete_fecha value from the vh_destete table for the given tagid
$latestDestetePeso = null;
$latestDesteteFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_destete WHERE vh_destete_tagid = ? ORDER BY vh_destete_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestDestetePeso = $row['vh_destete_peso'] ?? null;
        $latestDesteteFecha = $row['vh_destete_fecha'] ?? null;        
    }
}

// Fetch the latest vh_destete, vh_destete_costo, vh_destete_fecha value from the vh_destete table for the given tagid
$latestDescartePeso = null;
$latestDescarteFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_descarte WHERE vh_descarte_tagid = ? ORDER BY vh_descarte_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestDescartePeso = $row['vh_descarte_peso'] ?? null;
        $latestDescarteFecha = $row['vh_descarte_fecha'] ?? null;        
    }
}

// Fetch the latest vh_robo, vh_robo_costo, vh_robo_fecha value from the vh_robo table for the given tagid
$latestRoboMonto = null;
$latestRoboFecha = null;
if ($tagid) {
    $query = "SELECT * FROM vh_robo WHERE vh_robo_tagid = ? ORDER BY vh_robo_fecha DESC LIMIT 1"; // Adjust 'fecha' to your actual date column
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagid); // Assuming tagid is a string; adjust type as necessary
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $latestRoboMonto = $row['vh_robo_monto'] ?? null;
        $latestRoboFecha = $row['vh_robo_fecha'] ?? null;        
    }
}

// Task Card HTML
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vacunos Tareas</title>
<!-- Link to the Favicon -->
<link rel="icon" href="images/ganagram_ico.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!--Bootstrap 5 Css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
.card-icon{
  width: 50px;
}
.section-title {
background-color: #83956e;
color: white;
padding: 10px;
margin-bottom: 20px;
border-radius: 5px;
font-weight: bold;
text-align: center;
}
/* Custom styles for input fields */
.form-control {
    border: 1px solid #ced4da; /* Light gray border */
    border-radius: 0.25rem; /* Rounded corners */
    padding: 0.375rem 0.75rem; /* Padding for a better look */
    transition: border-color 0.2s ease-in-out; /* Smooth transition */
}
.form-control:focus {
    border-color: #80bdff; /* Blue border on focus */
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Shadow effect */
}
.btn-custom {
    background-color: #466142; /* Light green background */
    color: #fff; /* Text color */
    width: 100%; /* Full width */
    border: none; /* Remove border */
}
.btn-custom:hover {
    background-color: #76c76a; /* Darker green on hover */
    color: #000; /* Text color */
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


</style>
</head>
<body>
<!-- Add back button before the header container -->
<a href="./inventario_vacuno.php" class="back-btn">
  <i class="fas fa-arrow-left"></i>
</a>
<!-- Tareas Produccion-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">REGISTRO PRODUCCION</h3>
</div>
<div class="container mt-4 text-center">
  <div class="row">
    <!-- First Row of Cards -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header text-center">
          <img src="./images/bascula.png" class="card-icon">
          <h5 class="card-title">Pesaje Animal</h5>
        </div>
        <div class="card-body">
          <form action="vacuno_update_pesaje_animal.php" method="POST" id="peso-form">
            <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
            <label for="pesaje-animal">Peso [Kg]:</label>
            <input type="number" step="0.1" id="pesaje-animal" name="vh_peso_animal" class="form-control" value="<?php echo isset($latestPesoAnimal) ? $latestPesoAnimal : ''; ?>" required />
            <label for="precio-peso-animal">Precio [$/Kg]:</label>
            <input type="number" step="0.1" id="precio-peso-animal" name="vh_peso_precio" class="form-control" value="<?php echo isset($latestPesoAnimalPrecio) ? $latestPesoAnimalPrecio : ''; ?>" required />
            <label for="fecha-pesaje-animal">Fecha:</label>
            <input type="date" id="fecha-pesaje-animal" name="vh_peso_fecha" class="form-control" value="<?php echo isset($latestPesoAnimalFecha) ? $latestPesoAnimalFecha : ''; ?>" required />                            
            <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header text-center">
        <img src="./images/leche.png" class="card-icon">
            <h5 class="card-title">Pesaje Leche</h5>
        </div>
        <div class="card-body">
          <form action="vacuno_update_leche.php" method="POST">
            <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
            <label for="peso-leche">Peso [Kg]:</label>
            <input type="number" step="0.1" id="peso-leche" name="vh_leche_peso" class="form-control" value="<?php echo isset($latestLechePeso) ? $latestLechePeso : ''; ?>" required />
            <label for="precio-leche">Precio [$/Kg]:</label>
            <input type="number" step="0.1" id="precio-leche" name="vh_leche_costo" class="form-control"  value="<?php echo isset($latestLechePrecio) ? $latestLechePrecio : ''; ?>" required />
            <label for="fecha-leche">Fecha:</label>
            <input type="date" id="fecha-leche" name="vh_leche_fecha" class="form-control"  value="<?php echo isset($latestLecheFecha) ? $latestLecheFecha : ''; ?>" required />                
            <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header text-center">
          <img src="./images/queso.png" class="card-icon">
          <h5 class="card-title">Pesaje Queso</h5>
        </div>
          <div class="card-body">
          <form action="vacuno_update_queso.php" method="POST">
          <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" />
            <label for="queso-peso">Peso [Kg]:</label>
            <input type="number" step="0.1" id="queso-peso" name="vh_queso_peso" class="form-control" value="<?php echo isset($latestQuesoPeso) ? $latestQuesoPeso : ''; ?>"  required />                            
            <label for="queso-precio">Precio [$/Kg]:</label>
            <input type="number" step="0.1" id="queso-precio" name="vh_queso_precio" class="form-control" value="<?php echo isset($latestQuesoPrecio) ? $latestQuesoPrecio : ''; ?>"  required />
            <label for="queso-fecha">Fecha:</label>
            <input type="date" id="queso-fecha" name="vh_queso_fecha" class="form-control" value="<?php echo isset($latestQuesoFecha) ? $latestQuesoFecha : ''; ?>"  required />                            
            <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
          </form>
          </div>
      </div>
    </div>
</div>
</div>
<div>
<!-- REGISTRO Salud-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">REGISTRO SALUD</h3>
</div>
<div class="container mt-4 text-center">    
    <div class="row">    
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                <img src="./images/vacuna.png" class="card-icon">
                    <h5 class="card-title">Aftosa</h5>
                </div>
                <div class="card-body">                
                    <form action="vacuno_update_aftosa.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                      <label for="aftosa-producto">Producto:</label>
                      <select id="aftosa-producto" name="vh_aftosa_producto" class="form-control" required>
                          <option value="">Seleccionar Producto</option>
                          <?php
                          // Fetch unique productos from vh_aftosa table AQUI
                          $conn_aftosa_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_aftosa_producto->connect_error) {
                              die("Connection failed: " . $conn_aftosa_producto->connect_error);
                          }

                          $sql_aftosa_producto = "SELECT DISTINCT vh_aftosa_producto FROM vh_aftosa";
                          $result_aftosa_producto = $conn_aftosa_producto->query($sql_aftosa_producto);

                          if ($result_aftosa_producto->num_rows > 0) {
                              while ($row = $result_aftosa_producto->fetch_assoc()) {
                                  $selected = (isset($latestAftosaProducto) && $latestAftosaProducto === $row['vh_aftosa_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_aftosa_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_aftosa_producto']) . '</option>';
                              }
                          }
                          $conn_aftosa_producto->close();
                          ?>
                      </select>
                      
                      <label for="aftosa-dosis">Dosis [ml]:</label>
                      <select id="aftosa-dosis" name="vh_aftosa_dosis" class="form-control" required>
                          <option value="">Selecionar Dosis</option>
                          <?php
                          // Fetch unique dosis from vh_aftosa table
                          $conn_aftosa_dosis = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_aftosa_dosis->connect_error) {
                              die("Connection failed: " . $conn_aftosa_dosis->connect_error);
                          }

                          $sql_aftosa_dosis = "SELECT DISTINCT vh_aftosa_dosis FROM vh_aftosa";
                          $result_aftosa_dosis = $conn_aftosa_dosis->query($sql_aftosa_dosis);

                          if ($result_aftosa_dosis->num_rows > 0) {
                              while ($row = $result_aftosa_dosis->fetch_assoc()) {
                                  $selected = (isset($latestAftosaDosis) && $latestAftosaDosis === $row['vh_aftosa_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_aftosa_dosis']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_aftosa_dosis']) . '</option>';
                              }
                          }
                          $conn_aftosa_dosis->close();
                          ?>
                      </select>
                      
                      <label for="aftosa-costo">Costo [$/Kg]:</label>
                      <select id="aftosa-costo" name="vh_aftosa_costo" class="form-control" required>
                          <option value="">Select Costo</option>
                          <?php
                          // Fetch unique costos from vh_aftosa table
                          $conn_aftosa_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_aftosa_costo->connect_error) {
                              die("Connection failed: " . $conn_aftosa_costo->connect_error);
                          }

                          $sql_aftosa_costo = "SELECT DISTINCT vh_aftosa_costo FROM vh_aftosa";
                          $result_aftosa_costo = $conn_aftosa_costo->query($sql_aftosa_costo);

                          if ($result_aftosa_costo->num_rows > 0) {
                              while ($row = $result_aftosa_costo->fetch_assoc()) {
                                  $selected = (isset($latestAftosaCosto) && $latestAftosaCosto === $row['vh_aftosa_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_aftosa_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_aftosa_costo']) . '</option>';
                              }
                          }
                          $conn_aftosa_costo->close();
                          ?>
                      </select>                      
                      <label for="aftosa-fecha">Fecha:</label>
                      <input type="date" id="aftosa-fecha" name="vh_aftosa_fecha" class="form-control" value="<?php echo isset($latestAftosaFecha) ? $latestAftosaFecha : ''; ?>" required />                      
                      <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                <img src="./images/vacuna.png" class="card-icon">
                    <h5 class="card-title">IBR</h5>
                </div>
                <div class="card-body">                
                    <form action="vacuno_update_ibr.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                      <label for="ibr-producto">Producto:</label>
                      <select id="ibr-producto" name="vh_ibr_producto" class="form-control" required>
                          <option value="">Selecionar Producto</option>
                          <?php
                          // Fetch unique productos from vh_ibr table
                          $conn_ibr_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_ibr_producto->connect_error) {
                              die("Connection failed: " . $conn_ibr_producto->connect_error);
                          }

                          $sql_ibr_producto = "SELECT DISTINCT vh_ibr_producto FROM vh_ibr";
                          $result_ibr_producto = $conn_ibr_producto->query($sql_ibr_producto);

                          if ($result_ibr_producto->num_rows > 0) {
                              while ($row = $result_ibr_producto->fetch_assoc()) {
                                  $selected = (isset($latestIbrProducto) && $latestIbrProducto === $row['vh_ibr_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_ibr_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_ibr_producto']) . '</option>';
                              }
                          }
                          $conn_ibr_producto->close();
                          ?>
                      </select>                      
                      <label for="ibr-dosis">Dosis [ml]:</label>
                      <select id="ibr-dosis" name="vh_ibr_dosis" class="form-control" required>
                          <option value="">Selecionar Dosis</option>
                      <?php
                          // Fetch unique dosis from vh_ibr table
                          $conn_ibr_dosis = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_ibr_dosis->connect_error) {
                              die("Connection failed: " . $conn_ibr_dosis->connect_error);
                          }

                          $sql_ibr_dosis = "SELECT DISTINCT vh_ibr_dosis FROM vh_ibr";
                          $result_ibr_dosis = $conn_ibr_dosis->query($sql_ibr_dosis);

                          if ($result_ibr_dosis->num_rows > 0) {
                              while ($row = $result_ibr_dosis->fetch_assoc()) {
                                  $selected = (isset($latestIbrDosis) && $latestIbrDosis === $row['vh_ibr_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_ibr_dosis']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_ibr_dosis']) . '</option>';
                              }
                          }
                          $conn_ibr_dosis->close();
                          ?>
                      </select>
                      <label for="ibr-costo">Costo [$/Kg]:</label>
                      <select id="ibr-costo" name="vh_ibr_costo" class="form-control" required>
                          <option value="">Seleccionar Costo</option>
                          <?php
                          // Fetch unique costos from vh_ibr table
                          $conn_ibr_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_ibr_costo->connect_error) {
                              die("Connection failed: " . $conn_ibr_costo->connect_error);
                          }

                          $sql_ibr_costo = "SELECT DISTINCT vh_ibr_costo FROM vh_ibr";
                          $result_ibr_costo = $conn_ibr_costo->query($sql_ibr_costo);

                          if ($result_ibr_costo->num_rows > 0) {
                              while ($row = $result_ibr_costo->fetch_assoc()) {
                                  $selected = (isset($latestIbrCosto) && $latestIbrCosto === $row['vh_ibr_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_ibr_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_ibr_costo']) . '</option>';
                              }
                          }
                          $conn_ibr_costo->close();
                          ?>
                        </select>s                   
                      <label for="ibr-fecha">Fecha:</label>
                      <input type="date" id="ibr-fecha" name="vh_ibr_fecha" class="form-control" value="<?php echo isset($latestIbrFecha) ? $latestIbrFecha : ''; ?>" required />                    
                      <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                <img src="./images/vacuna.png" class="card-icon">
                    <h5 class="card-title">CBR</h5>
                </div>
                <div class="card-body">                
                <form action="vacuno_update_cbr.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                      <label for="cbr-producto">Producto:</label>
                      <select id="cbr-producto" name="vh_cbr_producto" class="form-control" required>
                          <option value="">Selecionar Producto</option>
                          <?php
                          $conn_cbr_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_cbr_producto->connect_error) {
                              die("Connection failed: " . $conn_cbr_producto->connect_error);
                          }

                          $sql_cbr_producto = "SELECT DISTINCT vh_cbr_producto FROM vh_cbr";
                          $result_cbr_producto = $conn_cbr_producto->query($sql_cbr_producto);

                          if ($result_cbr_producto->num_rows > 0) {
                              while ($row = $result_cbr_producto->fetch_assoc()) {
                                  $selected = (isset($latestCbrProducto) && $latestCbrProducto === $row['vh_cbr_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_cbr_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_cbr_producto']) . '</option>';
                              }
                          }
                          $conn_cbr_producto->close();
                          ?>
                      </select>                      
                      <label for="cbr-dosis">Dosis [ml]:</label>
                      <select id="cbr-dosis" name="vh_cbr_dosis" class="form-control" required>
                          <option value="">Selecionar Dosis</option>
                      <?php
                          $conn_cbr_dosis = new mysqli('localhost', $username, $password, $dbname);


                          if ($conn_cbr_dosis->connect_error) {
                              die("Connection failed: " . $conn_cbr_dosis->connect_error);
                          }

                          $sql_cbr_dosis = "SELECT DISTINCT vh_cbr_dosis FROM vh_cbr";
                          $result_cbr_dosis = $conn_cbr_dosis->query($sql_cbr_dosis);

                          if ($result_cbr_dosis->num_rows > 0) {
                              while ($row = $result_cbr_dosis->fetch_assoc()) {
                                  $selected = (isset($latestCbrDosis) && $latestCbrDosis === $row['vh_cbr_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_cbr_dosis']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_cbr_dosis']) . '</option>';
                              }
                          }
                          $conn_cbr_dosis->close();
                          ?>
                      </select>
                      <label for="cbr-costo">Costo [$/Kg]:</label>
                      <select id="cbr-costo" name="vh_cbr_costo" class="form-control" required>
                          <option value="">Selecionar Costo</option>
                          <?php
                          $conn_cbr_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_cbr_costo->connect_error) {
                              die("Connection failed: " . $conn_cbr_costo->connect_error);
                          }

                          $sql_cbr_costo = "SELECT DISTINCT vh_cbr_costo FROM vh_cbr";
                          $result_cbr_costo = $conn_cbr_costo->query($sql_cbr_costo);

                          if ($result_cbr_costo->num_rows > 0) {
                              while ($row = $result_cbr_costo->fetch_assoc()) {
                                  $selected = (isset($latestCbrCosto) && $latestCbrCosto === $row['vh_cbr_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_cbr_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_cbr_costo']) . '</option>';
                              }
                          }
                          $conn_cbr_costo->close();
                          ?>
                        </select>s                   
                      <label for="cbr-fecha">Fecha:</label>
                      <input type="date" id="cbr-fecha" name="vh_cbr_fecha" class="form-control" value="<?php echo isset($latestCbrFecha) ? $latestCbrFecha : ''; ?>" required />                    
                      <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                <img src="./images/vacuna.png" class="card-icon">
                    <h5 class="card-title">Brucelosis</h5>
                </div>
                <div class="card-body">                
                <form action="vacuno_update_brucelosis.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                      <label for="brucelosis-producto">Producto:</label>
                      <select id="brucelosis-producto" name="vh_brucelosis_producto" class="form-control" required>
                          <option value="">Selecionar Producto</option>
                          <?php
                          $conn_brucelosis_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_brucelosis_producto->connect_error) {
                              die("Connection failed: " . $conn_brucelosis_producto->connect_error);
                          }

                          $sql_brucelosis_producto = "SELECT DISTINCT vh_brucelosis_producto FROM vh_brucelosis";
                          $result_brucelosis_producto = $conn_brucelosis_producto->query($sql_brucelosis_producto);

                          if ($result_brucelosis_producto->num_rows > 0) {
                              while ($row = $result_brucelosis_producto->fetch_assoc()) {
                                  $selected = (isset($latestBrucelosisProducto) && $latestBrucelosisProducto === $row['vh_brucelosis_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_brucelosis_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_brucelosis_producto']) . '</option>';
                              }
                          }
                          $conn_brucelosis_producto->close();
                          ?>
                      </select>                      
                      <label for="brucelosis-dosis">Dosis [ml]:</label>
                      <select id="brucelosis-dosis" name="vh_brucelosis_dosis" class="form-control" required>
                          <option value="">Selecionar Dosis</option>
                      <?php
                          $conn_brucelosis_dosis = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_brucelosis_dosis->connect_error) {
                              die("Connection failed: " . $conn_brucelosis_dosis->connect_error);
                          }

                          $sql_brucelosis_dosis = "SELECT DISTINCT vh_brucelosis_dosis FROM vh_brucelosis";
                          $result_brucelosis_dosis = $conn_brucelosis_dosis->query($sql_brucelosis_dosis);

                          if ($result_brucelosis_dosis->num_rows > 0) {
                              while ($row = $result_brucelosis_dosis->fetch_assoc()) {
                                  $selected = (isset($latestBrucelosisDosis) && $latestBrucelosisDosis === $row['vh_brucelosis_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_brucelosis_dosis']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_brucelosis_dosis']) . '</option>';
                              }
                          }
                          $conn_brucelosis_dosis->close();
                          ?>
                      </select>
                      <label for="brucelosis-costo">Costo [$/Kg]:</label>
                      <select id="brucelosis-costo" name="vh_brucelosis_costo" class="form-control" required>
                          <option value="">Selecionar Costo</option>
                          <?php
                          $conn_brucelosis_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_brucelosis_costo->connect_error) {
                              die("Connection failed: " . $conn_brucelosis_costo->connect_error);
                          }

                          $sql_brucelosis_costo = "SELECT DISTINCT vh_brucelosis_costo FROM vh_brucelosis";
                          $result_brucelosis_costo = $conn_brucelosis_costo->query($sql_brucelosis_costo);

                          if ($result_brucelosis_costo->num_rows > 0) {
                              while ($row = $result_brucelosis_costo->fetch_assoc()) {
                                  $selected = (isset($latestBrucelosisCosto) && $latestBrucelosisCosto === $row['vh_brucelosis_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_brucelosis_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_brucelosis_costo']) . '</option>';
                              }
                          }
                          $conn_brucelosis_costo->close();
                          ?>
                        </select>s                   
                      <label for="brucelosis-fecha">Fecha:</label>
                      <input type="date" id="brucelosis-fecha" name="vh_brucelosis_fecha" class="form-control" value="<?php echo isset($latestBrucelosisFecha) ? $latestBrucelosisFecha : ''; ?>" required />                    
                      <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                <img src="./images/vacuna.png" class="card-icon">
                    <h5 class="card-title">Carbunco</h5>
                </div>
                <div class="card-body">                
                <form action="vacuno_update_carbunco.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                      <label for="carbunco-producto">Producto:</label>
                      <select id="carbunco-producto" name="vh_carbunco_producto" class="form-control" required>
                          <option value="">Selecionar Producto</option>
                          <?php
                          $conn_carbunco_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_carbunco_producto->connect_error) {
                              die("Connection failed: " . $conn_carbunco_producto->connect_error);
                          }

                          $sql_carbunco_producto = "SELECT DISTINCT vh_carbunco_producto FROM vh_carbunco";
                          $result_carbunco_producto = $conn_carbunco_producto->query($sql_carbunco_producto);

                          if ($result_carbunco_producto->num_rows > 0) {
                              while ($row = $result_carbunco_producto->fetch_assoc()) {
                                  $selected = (isset($latestCarbuncoProducto) && $latestCarbuncoProducto === $row['vh_carbunco_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_carbunco_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_carbunco_producto']) . '</option>';
                              }
                          }
                          $conn_carbunco_producto->close();
                          ?>
                      </select>                      
                      <label for="carbunco-dosis">Dosis [ml]:</label>
                      <select id="carbunco-dosis" name="vh_carbunco_dosis" class="form-control" required>
                          <option value="">Selecionar Dosis</option>
                      <?php
                          $conn_carbunco_dosis = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_carbunco_dosis->connect_error) {
                              die("Connection failed: " . $conn_brucelosis_dosis->connect_error);
                          }

                          $sql_carbunco_dosis = "SELECT DISTINCT vh_carbunco_dosis FROM vh_carbunco";
                          $result_carbunco_dosis = $conn_carbunco_dosis->query($sql_carbunco_dosis);

                          if ($result_carbunco_dosis->num_rows > 0) {
                              while ($row = $result_carbunco_dosis->fetch_assoc()) {
                                  $selected = (isset($latestCarbuncoDosis) && $latestCarbuncoDosis === $row['vh_carbunco_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_carbunco_dosis']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_carbunco_dosis']) . '</option>';
                              }
                          }
                          $conn_carbunco_dosis->close();
                          ?>
                      </select>
                      <label for="carbunco-costo">Costo [$/Kg]:</label>
                      <select id="carbunco-costo" name="vh_carbunco_costo" class="form-control" required>
                          <option value="">Seleccionar Costo</option>
                          <?php
                          $conn_carbunco_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_carbunco_costo->connect_error) {
                              die("Connection failed: " . $conn_carbunco_costo->connect_error);
                          }

                          $sql_carbunco_costo = "SELECT DISTINCT vh_carbunco_costo FROM vh_carbunco";
                          $result_carbunco_costo = $conn_carbunco_costo->query($sql_carbunco_costo);

                          if ($result_carbunco_costo->num_rows > 0) {
                              while ($row = $result_carbunco_costo->fetch_assoc()) {
                                  $selected = (isset($latestCarbuncoCosto) && $latestCarbuncoCosto === $row['vh_carbunco_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_carbunco_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_carbunco_costo']) . '</option>';
                              }
                          }
                          $conn_carbunco_costo->close();
                          ?>
                        </select>                  
                      <label for="carbunco-fecha">Fecha:</label>
                      <input type="date" id="carbunco-fecha" name="vh_carbunco_fecha" class="form-control" value="<?php echo isset($latestCarbuncoFecha) ? $latestCarbuncoFecha : ''; ?>" required />                    
                      <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                <img src="./images/vacuna.png" class="card-icon">
                    <h5 class="card-title">Garrapatas</h5>
                </div>
                <div class="card-body">                
                <form action="vacuno_update_garrapatas.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                      <label for="garrapatas-producto">Producto:</label>
                      <select id="garrapatas-producto" name="vh_garrapatas_producto" class="form-control" required>
                          <option value="">Selecionar Producto</option>
                          <?php
                          $conn_garrapatas_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_garrapatas_producto->connect_error) {
                              die("Connection failed: " . $conn_garrapatas_producto->connect_error);
                          }

                          $sql_garrapatas_producto = "SELECT DISTINCT vh_garrapatas_producto FROM vh_garrapatas";
                          $result_garrapatas_producto = $conn_garrapatas_producto->query($sql_garrapatas_producto);

                          if ($result_garrapatas_producto->num_rows > 0) {
                              while ($row = $result_garrapatas_producto->fetch_assoc()) {
                                  $selected = (isset($latestGarrapatasProducto) && $latestGarrapatasProducto === $row['vh_garrapatas_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_garrapatas_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_garrapatas_producto']) . '</option>';
                              }
                          }
                          $conn_garrapatas_producto->close();
                          ?>
                      </select>                      
                      <label for="garrapatas-dosis">Dosis [ml]:</label>
                      <select id="garrapatas-dosis" name="vh_garrapatas_dosis" class="form-control" required>
                          <option value="">Selecionar Dosis</option>
                      <?php
                          $conn_garrapatas_dosis = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_garrapatas_dosis->connect_error) {
                              die("Connection failed: " . $conn_garrapatas_dosis->connect_error);
                          }

                          $sql_garrapatas_dosis = "SELECT DISTINCT vh_garrapatas_dosis FROM vh_garrapatas";
                          $result_garrapatas_dosis = $conn_garrapatas_dosis->query($sql_garrapatas_dosis);

                          if ($result_garrapatas_dosis->num_rows > 0) {
                              while ($row = $result_garrapatas_dosis->fetch_assoc()) {
                                  $selected = (isset($latestGarrapatasDosis) && $latestGarrapatasDosis === $row['vh_garrapatas_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_garrapatas_dosis']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_garrapatas_dosis']) . '</option>';
                              }
                          }
                          $conn_garrapatas_dosis->close();
                          ?>
                      </select>
                      <label for="garrapatas-costo">Costo [$/Kg]:</label>
                      <select id="garrapatas-costo" name="vh_garrapatas_costo" class="form-control" required>
                          <option value="">Selecionar Costo</option>
                      <?php
                          $conn_garrapatas_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_garrapatas_costo->connect_error) {
                              die("Connection failed: " . $conn_garrapatas_costo->connect_error);
                          }

                          $sql_garrapatas_costo = "SELECT DISTINCT vh_garrapatas_costo FROM vh_garrapatas";
                          $result_garrapatas_costo = $conn_garrapatas_costo->query($sql_garrapatas_costo);

                          if ($result_garrapatas_costo->num_rows > 0) {
                              while ($row = $result_garrapatas_costo->fetch_assoc()) {
                                  $selected = (isset($latestGarrapatasCosto) && $latestGarrapatasCosto === $row['vh_garrapatas_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_garrapatas_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_garrapatas_costo']) . '</option>';
                              }
                          }
                          $conn_garrapatas_costo->close();
                          ?>
                      </select>                   
                      <label for="garrapatas-fecha">Fecha:</label>
                      <input type="date" id="garrapatas-fecha" name="vh_garrapatas_fecha" class="form-control" value="<?php echo isset($latestGarrapatasFecha) ? $latestGarrapatasFecha : ''; ?>" required />                    
                      <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                <img src="./images/vacuna.png" class="card-icon">
                    <h5 class="card-title">Mastitis</h5>
                </div>
                <div class="card-body">                
                <form action="vacuno_update_mastitis.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                      <label for="mastitis-producto">Producto:</label>
                      <select id="mastitis-producto" name="vh_mastitis_producto" class="form-control" required>
                          <option value="">Selecionar Producto</option>
                          <?php
                          $conn_mastitis_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_mastitis_producto->connect_error) {
                              die("Connection failed: " . $conn_mastitis_producto->connect_error);
                          }

                          $sql_mastitis_producto = "SELECT DISTINCT vh_mastitis_producto FROM vh_mastitis";
                          $result_mastitis_producto = $conn_mastitis_producto->query($sql_mastitis_producto);

                          if ($result_mastitis_producto->num_rows > 0) {
                              while ($row = $result_mastitis_producto->fetch_assoc()) {
                                  $selected = (isset($latestMastitisProducto) && $latestMastitisProducto === $row['vh_mastitis_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_mastitis_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_mastitis_producto']) . '</option>';
                              }
                          }
                          $conn_mastitis_producto->close();
                          ?>
                      </select>                      
                      <label for="mastitis-dosis">Dosis [ml]:</label>
                      <select id="mastitis-dosis" name="vh_mastitis_dosis" class="form-control" required>
                          <option value="">Selecionar Dosis</option>
                      <?php
                          $conn_mastitis_dosis = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_mastitis_dosis->connect_error) {
                              die("Connection failed: " . $conn_mastitis_dosis->connect_error);
                          }

                          $sql_mastitis_dosis = "SELECT DISTINCT vh_mastitis_dosis FROM vh_mastitis";
                          $result_mastitis_dosis = $conn_mastitis_dosis->query($sql_mastitis_dosis);

                          if ($result_mastitis_dosis->num_rows > 0) {
                              while ($row = $result_mastitis_dosis->fetch_assoc()) {
                                  $selected = (isset($latestMastitisDosis) && $latestMastitisDosis === $row['vh_mastitis_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_mastitis_dosis']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_mastitis_dosis']) . '</option>';
                              }
                          }
                          $conn_mastitis_dosis->close();
                          ?>
                      </select>
                      <label for="mastitis-costo">Costo [$/Kg]:</label>
                      <select id="mastitis-costo" name="vh_mastitis_costo" class="form-control" required>
                          <option value="">Selecionar Costo</option>
                          <?php
                          $conn_mastitis_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_mastitis_costo->connect_error) {
                              die("Connection failed: " . $conn_mastitis_costo->connect_error);
                          }

                          $sql_mastitis_costo = "SELECT DISTINCT vh_mastitis_costo FROM vh_mastitis";
                          $result_mastitis_costo = $conn_mastitis_costo->query($sql_mastitis_costo);

                          if ($result_mastitis_costo->num_rows > 0) {
                              while ($row = $result_mastitis_costo->fetch_assoc()) {
                                  $selected = (isset($latestMastitisCosto) && $latestMastitisCosto === $row['vh_mastitis_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_mastitis_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_mastitis_costo']) . '</option>';
                              }
                          }
                          $conn_mastitis_costo->close();
                          ?>
                        </select>                  
                      <label for="mastitis-fecha">Fecha:</label>
                      <input type="date" id="mastitis-fecha" name="vh_mastitis_fecha" class="form-control" value="<?php echo isset($latestMastitisFecha) ? $latestMastitisFecha : ''; ?>" required />                    
                      <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                <img src="./images/vacuna.png" class="card-icon">
                    <h5 class="card-title">Lombrices</h5>
                </div>
                <div class="card-body">                
                <form action="vacuno_update_lombrices.php" method="POST">
                    <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                      <label for="lombrices-producto">Producto:</label>
                      <select id="lombrices-producto" name="vh_lombrices_producto" class="form-control" required>
                          <option value="">Selecionar Producto</option>
                          <?php
                          $conn_lombrices_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_lombrices_producto->connect_error) {
                              die("Connection failed: " . $conn_lombrices_producto->connect_error);
                          }

                          $sql_lombrices_producto = "SELECT DISTINCT vh_lombrices_producto FROM vh_lombrices";
                          $result_lombrices_producto = $conn_lombrices_producto->query($sql_lombrices_producto);

                          if ($result_lombrices_producto->num_rows > 0) {
                              while ($row = $result_lombrices_producto->fetch_assoc()) {
                                  $selected = (isset($latestLombricesProducto) && $latestLombricesProducto === $row['vh_lombrices_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_lombrices_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_lombrices_producto']) . '</option>';
                              }
                          }
                          $conn_lombrices_producto->close();
                          ?>
                      </select>                      
                      <label for="lombrices-dosis">Dosis [ml]:</label>
                      <select id="lombrices-dosis" name="vh_lombrices_dosis" class="form-control" required>
                          <option value="">Selecionar Dosis</option>
                      <?php
                          $conn_lombrices_dosis = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_lombrices_dosis->connect_error) {
                              die("Connection failed: " . $conn_lombrices_dosis->connect_error);
                          }

                          $sql_lombrices_dosis = "SELECT DISTINCT vh_lombrices_dosis FROM vh_lombrices";
                          $result_lombrices_dosis = $conn_lombrices_dosis->query($sql_lombrices_dosis);

                          if ($result_lombrices_dosis->num_rows > 0) {
                              while ($row = $result_lombrices_dosis->fetch_assoc()) {
                                  $selected = (isset($latestLombricesDosis) && $latestLombricesDosis === $row['vh_lombrices_dosis']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_lombrices_dosis']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_lombrices_dosis']) . '</option>';
                              }
                          }
                          $conn_lombrices_dosis->close();
                          ?>
                      </select>
                      <label for="lombrices-costo">Costo [$/Kg]:</label>
                      <select id="lombrices-costo" name="vh_lombrices_costo" class="form-control" required>
                          <option value="">Selecionar Costo</option>
                          <?php
                          $conn_lombrices_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_lombrices_costo->connect_error) {
                              die("Connection failed: " . $conn_lombrices_costo->connect_error);
                          }

                          $sql_lombrices_costo = "SELECT DISTINCT vh_lombrices_costo FROM vh_lombrices";
                          $result_lombrices_costo = $conn_lombrices_costo->query($sql_lombrices_costo);

                          if ($result_lombrices_costo->num_rows > 0) {
                              while ($row = $result_lombrices_costo->fetch_assoc()) {
                                  $selected = (isset($latestLombricesCosto) && $latestLombricesCosto === $row['vh_lombrices_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_lombrices_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_lombrices_costo']) . '</option>';
                              }
                          }
                          $conn_lombrices_costo->close();
                          ?>
                        </select>                  
                      <label for="lombrices-fecha">Fecha:</label>
                      <input type="date" id="lombrices-fecha" name="vh_lombrices_fecha" class="form-control" value="<?php echo isset($latestLombricesFecha) ? $latestLombricesFecha : ''; ?>" required />                    
                      <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>                  
  <!-- REGISTRO Alimentacion -->
  <div class="container" style="margin-top: 20px;width:90%;">
    <h3 class="section-title">REGISTRO ALIMENTACION</h3>
  </div>
    <div class="container mt-4 text-center">
      <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header text-center">
              <img src="./images/saco-de-trigo.png" class="card-icon">
                <h5 class="card-title">Concentrado</h5>
              </div>
              <div class="card-body">
                <form action="vacuno_update_concentrado.php" method="POST">
                  <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                  <label for="concentrado-etapa">Etapa:</label>
                  <select id="concentrado-etapa" name="vh_concentrado_etapa" class="form-control" required>
                      <option value="">Seleccionar Etapa ↓</option>
                      <option value="Inicio" <?php echo (isset($latestConcentradoEtapa) && $latestConcentradoEtapa === 'Inicio') ? 'selected' : ''; ?>>Inicio</option>
                      <option value="Crecimiento" <?php echo (isset($latestConcentradoEtapa) && $latestConcentradoEtapa === 'Crecimiento') ? 'selected' : ''; ?>>Crecimiento</option>
                      <option value="Finalización" <?php echo (isset($latestConcentradoEtapa) && $latestConcentradoEtapa === 'Finalización') ? 'selected' : ''; ?>>Finalización</option>
                  </select>
                  <label for="concentrado-producto">Producto:</label>
                  <select id="concentrado-producto" name="vh_concentrado_producto" class="form-control" required>
                          <option value="">Selecionar Producto ↓</option>
                          <?php
                          $conn_concentrado_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_concentrado_producto->connect_error) {
                              die("Connection failed: " . $conn_concentrado_producto->connect_error);
                          }

                          $sql_concentrado_producto = "SELECT DISTINCT vh_concentrado_producto FROM vh_concentrado";
                          $result_concentrado_producto = $conn_concentrado_producto->query($sql_concentrado_producto);

                          if ($result_concentrado_producto->num_rows > 0) {
                              while ($row = $result_concentrado_producto->fetch_assoc()) {
                                  $selected = (isset($latestConcentradoProducto) && $latestConcentradoProducto === $row['vh_concentrado_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_concentrado_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_concentrado_producto']) . '</option>';
                              }
                          }
                          $conn_concentrado_producto->close();
                          ?>
                        </select>
                        <label for="concentrado-racion">Racion [Kg]:</label>
                        <input type="number" step="0.1" id="concentrado-racion" name="vh_concentrado_racion" class="form-control" value="<?php echo isset($latestConcentradoRacion) ? $latestConcentradoRacion : ''; ?>" required />
                        <label for="concentrado-costo">Costo [$/Kg]:</label>
                        <select id="concentrado-costo" name="vh_concentrado_costo" class="form-control" required>
                          <option value="">Selecionar Costo ↓</option>
                          <?php
                          $conn_concentrado_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_concentrado_costo->connect_error) {
                              die("Connection failed: " . $conn_concentrado_costo->connect_error);
                          }

                          $sql_concentrado_costo = "SELECT DISTINCT vh_concentrado_costo FROM vh_concentrado";
                          $result_concentrado_costo = $conn_concentrado_costo->query($sql_concentrado_costo);

                          if ($result_concentrado_costo->num_rows > 0) {
                              while ($row = $result_concentrado_costo->fetch_assoc()) {
                                  $selected = (isset($latestConcentradoCosto) && $latestConcentradoCosto === $row['vh_concentrado_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_concentrado_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_concentrado_costo']) . '</option>';
                              }
                          }
                          $conn_concentrado_costo->close();
                          ?>
                        </select>
                  <label for="concentrado-fecha">Fecha:</label>
                  <input type="date" id="concentrado-fecha" name="vh_concentrado_fecha" class="form-control" value="<?php echo isset($latestConcentradoFecha) ? $latestConcentradoFecha : ''; ?>" required />                            
                  <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                </form>
              </div>
          </div>
        </div>
      <div class="col-md-4">          
        <div class="card">
          <div class="card-header text-center">
            <img src="./images/sal-y-azucar.png" class="card-icon">
            <h5 class="card-title">Sal</h5>
          </div>
          <div class="card-body">
            <form action="vacuno_update_sal.php" method="POST">
              <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
              <label for="sal-etapa">Etapa:</label>
              <select id="sal-etapa" name="vh_sal_etapa" class="form-control" required>
                      <option value="">Seleccionar Etapa ↓</option>
                      <option value="Inicio" <?php echo (isset($latestSalEtapa) && $latestSalEtapa === 'Inicio') ? 'selected' : ''; ?>>Inicio</option>
                      <option value="Crecimiento" <?php echo (isset($latestSalEtapa) && $latestSalEtapa === 'Crecimiento') ? 'selected' : ''; ?>>Crecimiento</option>
                      <option value="Finalización" <?php echo (isset($latestSalEtapa) && $latestSalEtapa === 'Finalización') ? 'selected' : ''; ?>>Finalización</option>
                  </select>
              <label for="sal-producto">Producto:</label>
                      <select id="sal-producto" name="vh_sal_producto" class="form-control" required>
                          <option value="">Selecionar Producto ↓</option>
                          <?php
                          $conn_sal_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_sal_producto->connect_error) {
                              die("Connection failed: " . $conn_sal_producto->connect_error);
                          }

                          $sql_sal_producto = "SELECT DISTINCT vh_sal_producto FROM vh_sal";
                          $result_sal_producto = $conn_sal_producto->query($sql_sal_producto);

                          if ($result_sal_producto->num_rows > 0) {
                              while ($row = $result_sal_producto->fetch_assoc()) {
                                  $selected = (isset($latestSalCosto) && $latestSalCosto === $row['vh_sal_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_sal_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_sal_producto']) . '</option>';
                              }
                          }
                          $conn_sal_producto->close();
                          ?>
                      </select>
              <label for="sal-racion">Racion [Kg]:</label>
                  <input type="number" id="sal-racion" name="vh_sal_racion" class="form-control" value="<?php echo isset($latestSalRacion) ? $latestSalRacion : ''; ?>" required />                            
              <label for="sal-costo">Costo [$/Kg]:</label>
              <select id="sal-costo" name="vh_sal_costo" class="form-control" required>
                          <option value="">Selecionar Costo ↓</option>
                          <?php
                          $conn_sal_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_sal_costo->connect_error) {
                              die("Connection failed: " . $conn_sal_costo->connect_error);
                          }

                          $sql_sal_costo = "SELECT DISTINCT vh_sal_costo FROM vh_sal";
                          $result_sal_costo = $conn_sal_costo->query($sql_sal_costo);

                          if ($result_sal_costo->num_rows > 0) {
                              while ($row = $result_sal_costo->fetch_assoc()) {
                                  $selected = (isset($latestSalCosto) && $latestSalCosto === $row['vh_sal_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_sal_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_sal_costo']) . '</option>';
                              }
                          }
                          $conn_sal_costo->close();
                          ?>
                </select>
              <label for="sal-fecha">Fecha:</label>
              <input type="date" id="sal-fecha" name="vh_sal_fecha" class="form-control" value="<?php echo isset($latestSalFecha) ? $latestSalFecha : ''; ?>" required />                            
              <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
            </form>
          </div>
      </div>
    </div>
    <div class="col-md-4">          
      <div class="card">
        <div class="card-header text-center">
          <img src="./images/miel.png" class="card-icon">
          <h5 class="card-title">Melaza</h5>
        </div>
        <div class="card-body">
            <form action="vacuno_update_melaza.php" method="POST">
              <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
              <label for="melaza-etapa">Etapa:</label>
              <select id="melaza-etapa" name="vh_melaza_etapa" class="form-control" required>
                      <option value="">Seleccionar Etapa ↓</option>
                      <option value="Inicio" <?php echo (isset($latestMelazaEtapa) && $latestMelazaEtapa === 'Inicio') ? 'selected' : ''; ?>>Inicio</option>
                      <option value="Crecimiento" <?php echo (isset($latestMelazaEtapa) && $latestMelazaEtapa === 'Crecimiento') ? 'selected' : ''; ?>>Crecimiento</option>
                      <option value="Finalización" <?php echo (isset($latestMelazaEtapa) && $latestMelazaEtapa === 'Finalización') ? 'selected' : ''; ?>>Finalización</option>
                </select>
              <label for="melaza-producto">Producto:</label>
              <select id="melaza-producto" name="vh_melaza_producto" class="form-control" required>
                          <option value="">Selecionar Producto ↓</option>
                          <?php
                          $conn_melaza_producto = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_melaza_producto->connect_error) {
                              die("Connection failed: " . $conn_melaza_producto->connect_error);
                          }

                          $sql_melaza_producto = "SELECT DISTINCT vh_melaza_producto FROM vh_melaza";
                          $result_melaza_producto = $conn_melaza_producto->query($sql_melaza_producto);

                          if ($result_melaza_producto->num_rows > 0) {
                              while ($row = $result_melaza_producto->fetch_assoc()) {
                                  $selected = (isset($latestMelazaCosto) && $latestMelazaCosto === $row['vh_melaza_producto']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_melaza_producto']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_melaza_producto']) . '</option>';
                              }
                          }
                          $conn_melaza_producto->close();
                          ?>
                      </select>
              <label for="melaza-racion">Racion [Kg]:</label>
              <input type="number" step="0.1" id="melaza-racion" name="vh_melaza_racion" class="form-control" value="<?php echo isset($latestMelazaRacion) ? $latestMelazaRacion : ''; ?>" required />
              <label for="melaza-costo">Costo [$/Kg]:</label>
              <select id="melaza-costo" name="vh_melaza_costo" class="form-control" required>
                          <option value="">Selecionar Costo ↓</option>
                          <?php
                          $conn_melaza_costo = new mysqli('localhost', $username, $password, $dbname);

                          if ($conn_melaza_costo->connect_error) {
                              die("Connection failed: " . $conn_melaza_costo->connect_error);
                          }

                          $sql_melaza_costo = "SELECT DISTINCT vh_melaza_costo FROM vh_melaza";
                          $result_melaza_costo = $conn_melaza_costo->query($sql_melaza_costo);

                          if ($result_melaza_costo->num_rows > 0) {
                              while ($row = $result_melaza_costo->fetch_assoc()) {
                                  $selected = (isset($latestMelazaCosto) && $latestMelazaCosto === $row['vh_melaza_costo']) ? 'selected' : '';
                                  echo '<option value="' . htmlspecialchars($row['vh_melaza_costo']) . '" ' . $selected . '>' . htmlspecialchars($row['vh_melaza_costo']) . '</option>';
                              }
                          }
                          $conn_melaza_costo->close();
                          ?>
                </select>
              <label for="melaza-fecha">Fecha:</label>
              <input type="date" id="melaza-fecha" name="vh_melaza_fecha" class="form-control" value="<?php echo isset($latestMelazaFecha) ? $latestMelazaFecha : ''; ?>" required />                            
              <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  </div>          
  <!-- REGISTRO Reproduccion -->
  <div class="container" style="margin-top: 20px;width:90%;">
    <h3 class="section-title">REGISTRO REPRODUCCION</h3>
  </div>
    <div class="container mt-4 text-center">
    <div class="row">  
      <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center">
            <img src="./images/ovulo.png" class="card-icon">
                <h5 class="card-title">Inseminacion</h5>
            </div>
            <div class="card-body">
              <form action="vacuno_update_inseminacion.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" />
                <label for="inseminacion-numero">Numero:</label>
                <input type="number" id="inseminacion-numero" name="vh_inseminacion_numero" class="form-control" value="<?php echo isset($latestInseminacionNumero) ? $latestInseminacionNumero : ''; ?>" required />
                <label for="inseminacion-fecha">Fecha:</label>
                <input type="date" id="inseminacion-fecha" name="vh_inseminacion_fecha" class="form-control" value="<?php echo isset($latestInseminacionFecha) ? $latestInseminacionFecha : ''; ?>" required />                            
                <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
              </form>
            </div>                    
        </div>
      </div>
      <div class="col-md-3">
          <div class="card">
            <div class="card-header text-center">
            <img src="./images/feto.png" class="card-icon">
                <h5 class="card-title">Gestacion</h5>
            </div>
            <div class="card-body">
              <form action="vacuno_update_gestacion.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" />
                <label for="gestacion-numero">Numero:</label>
                <input type="number" id="gestacion-numero" name="vh_gestacion_numero" class="form-control" value="<?php echo isset($latestGestacionNumero) ? $latestGestacionNumero : ''; ?>" required />
                <label for="gestacion-fecha">Fecha:</label>
                <input type="date" id="gestacion-fecha" name="vh_gestacion_fecha" class="form-control" value="<?php echo isset($latestGestacionFecha) ? $latestGestacionFecha : ''; ?>" required />                            
                <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
              </form>
            </div>
          </div>
      </div>
      <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center">
            <img src="./images/vaca.png" class="card-icon">
                <h5 class="card-title">Parto</h5>
            </div>
            <div class="card-body">
              <form action="vacuno_update_parto.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                <label for="parto-numero">Numero:</label>
                <input type="number" id="parto-numero" name="vh_parto_numero" class="form-control"  value="<?php echo isset($latestPartoNumero) ? $latestPartoNumero : ''; ?>" required />
                <label for="parto-fecha">Fecha:</label>
                <input type="date" id="parto-fecha" name="vh_parto_fecha" class="form-control"  value="<?php echo isset($latestPartoFecha) ? $latestPartoFecha : ''; ?>" required />                            
                <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
              </form>
            </div>                    
          </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header text-center">
          <img src="./images/craneo-de-toro.png" class="card-icon">
              <h5 class="card-title">Aborto</h5>
          </div>
          <div class="card-body">
            <form action="vacuno_update_aborto.php" method="POST">
              <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
              <label for="aborto-causa">Causa:</label>
              <input type="text" id="aborto-causa" name="vh_aborto_causa" class="form-control" value="<?php echo isset($latestAbortoCausa) ? $latestAbortoCausa : ''; ?>" required />
              <label for="aborto-fecha">Fecha:</label>
              <input type="date" id="aborto-fecha" name="vh_aborto_fecha" class="form-control" value="<?php echo isset($latestAbortoFecha) ? $latestAbortoFecha : ''; ?>" required />                            
              <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
            </form>
          </div>                    
        </div>
      </div>
    </div> 
    </div>
<!-- REGISTRO Operacines -->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">REGISTRO OTRAS OPERACIONES</h3>
</div>
  <div class="container mt-4 text-center">
    <div class="row">  
      <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center">
            <img src="./images/venta-metodo-de-pago.png" class="card-icon">
                <h5 class="card-title">Venta</h5>
            </div>
            <div class="card-body">
              <form action="vacuno_update_venta.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                <label for="venta-monto">Monto:</label>
                <input type="number" step="0.1" id="venta-monto" name="vh_venta_monto" class="form-control" value="<?php echo isset($latestVentaMonto) ? $latestVentaMonto : ''; ?>" required />
                <label for="venta-fecha">Fecha:</label>
                <input type="date" id="venta-fecha" name="vh_venta_fecha" class="form-control" value="<?php echo isset($latestVentaFecha) ? $latestVentaFecha : ''; ?>" required />                            
                <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
              </form>
            </div>                    
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center">
            <img src="./images/destete.png" class="card-icon">
                <h5 class="card-title">Destete</h5>
            </div>
            <div class="card-body">
              <form action="vacuno_update_destete.php" method="POST">
                <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                <label for="destete-peso">Peso:</label>
                <input type="number" step="0.1" id="destete-peso" name="vh_destete_peso" class="form-control" value="<?php echo isset($latestDestetePeso) ? $latestDestetePeso : ''; ?>" required />
                <label for="destete-fecha">Fecha:</label>
                <input type="date" id="destete-fecha" name="vh_destete_fecha" class="form-control" value="<?php echo isset($latestDesteteFecha) ? $latestDesteteFecha : ''; ?>" required />                            
                <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
              </form>
            </div>
        </div>
      </div>
      <div class="col-md-3">
          <div class="card">
            <div class="card-header text-center">
            <img src="./images/cuchillo.png" class="card-icon">
                <h5 class="card-title">Descarte</h5>
            </div>
              <div class="card-body">
                <form action="vacuno_update_descarte.php" method="POST">
                  <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
                  <label for="descarte-peso">Peso:</label>
                  <input type="text" id="descarte-peso" name="vh_descarte_peso" class="form-control" value="<?php echo isset($latestDescartePeso) ? $latestDescartePeso : ''; ?>" required />
                  <label for="descarte-fecha">Fecha:</label>
                  <input type="date" id="descarte-fecha" name="vh_descarte_fecha" class="form-control" value="<?php echo isset($latestDescarteFecha) ? $latestDescarteFecha : ''; ?>" required />                            
                  <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
                </form>
              </div>
          </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header text-center">
          <img src="./images/ladron.png" class="card-icon">
              <h5 class="card-title">Robo</h5>
          </div>
          <div class="card-body">
            <form action="vacuno_update_robo.php" method="POST">
              <input type="hidden" name="tagid" value="<?php echo htmlspecialchars($tagid); ?>" /> 
              <label for="robo-monto">Monto:</label>
              <input type="number" step="0.1" id="robo-monto" name="vh_robo_monto" class="form-control" value="<?php echo isset($latestRoboMonto) ? $latestRoboMonto : ''; ?>" required />
              <label for="robo-fecha">Fecha:</label>
              <input type="date" id="robo-fecha" name="vh_robo_fecha" class="form-control" value="<?php echo isset($latestRoboFecha) ? $latestRoboFecha : ''; ?>" required />                            
              <button type="submit" class="btn btn-custom mt-2">GUARDAR</button>
            </form>
          </div>
        </div>
      </div>            
  </div>   
</div>
</body>
