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


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Funcion que cuenta cuantos animales hay por cada clase y actualiza la tabla Indices
$sql = "SELECT clasificacion, COUNT(*) AS clasificacion_count
        FROM vacuno
        GROUP BY clasificacion";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    
    $sql_indices_clasificaciones ="UPDATE `indices` SET `total_novillas` = '0',`total_novillos` = '0',`total_vacas` = '0',`total_terneras` = '0',`total_terneros` = '0',`total_toros` = '0',`total_becerros` = '0',`total_becerras` = '0' WHERE `id` = 1";
    mysqli_query($conn, $sql_indices_clasificaciones);
    
    while ($row = $result->fetch_assoc()) {
        $clase = $row["clasificacion"];
        $count = $row["clasificacion_count"];
        
        if($clase === 'Novilla'){
            $sql_novilla ="UPDATE `indices` SET `total_novillas` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_novilla);
        }
        if($clase === 'Novillo'){
            $sql_novillo ="UPDATE `indices` SET `total_novillos` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_novillo);
        }
        if($clase == 'Vaca'){
            $sql_vaca ="UPDATE `indices` SET `total_vacas` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_vaca);
        }
        if($clase == 'Ternera'){
            $sql_ternera ="UPDATE `indices` SET `total_terneras` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_ternera);
        }
        if($clase == 'Ternero'){
            $sql_ternero ="UPDATE `indices` SET `total_terneros` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_ternero);
        }
        if($clase == 'Toro'){
            $sql_toro ="UPDATE `indices` SET `total_toros` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_toro);
        }
        if($clase == 'Padrote'){
            $sql_padrotes ="UPDATE `indices` SET `total_padrotes` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_padrotes);
        }
        if($clase == 'Becerro'){
            $sql_becerro ="UPDATE `indices` SET `total_becerros` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_becerro);
        }
        if($clase == 'Becerra'){
            $sql_becerra ="UPDATE `indices` SET `total_becerras` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_becerra);
        }
        
}
}
// Funcion que cuenta cuantos animales hay por cada estatus y actualiza la tabla Indices
$sql = "SELECT estatus, COUNT(*) AS estatus_count
        FROM vacuno
        GROUP BY estatus";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    
    $sql_indices_estatus ="UPDATE `indices` SET `total_vacias` = '0',`total_prenadas` = '0',`total_descartes` = '0',`total_paridas` = '0',`total_destetes` = '0',`total_lactantes` = '0',`total_sanos` = '0' = '0' WHERE `id` = 1";
    mysqli_query($conn, $sql_indices_estatus);
    
    while ($row = $result->fetch_assoc()) {
        $estatus = $row["estatus"];
        $count = $row["estatus_count"];
        
        if($estatus === 'Vacias'){
            $sql_vacias ="UPDATE `indices` SET `total_vacias` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_vacias);
        }
        if($estatus === 'Preñadas'){
            $sql_preñadas ="UPDATE `indices` SET `total_prenadas` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_preñadas);
        }
        if($estatus == 'Descartes'){
            $sql_descartes ="UPDATE `indices` SET `total_descartes` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_descartes);
        }
        if($estatus == 'Paridas'){
            $sql_paridas ="UPDATE `indices` SET `total_paridas` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_paridas);
        }
        if($estatus == 'Destetes'){
            $sql_destetes ="UPDATE `indices` SET `total_destetes` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_destetes);
        }
        if($estatus == 'Lactantes'){
            $sql_lactantes ="UPDATE `indices` SET `total_lactantes` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_lactantes);
        }
        if($estatus == 'Sanos'){
            $sql_sanos ="UPDATE `indices` SET `total_sanos` = '$count' WHERE `id` = 1";
            mysqli_query($conn, $sql_sanos);
        }
        if($estatus == 'Vendidos'){
          $sql_vendidos ="UPDATE `indices` SET `total_vendidos` = '$count' WHERE `id` = 1";
          mysqli_query($conn, $sql_vendidos);
      }
      if($estatus == 'Muertos'){
        $sql_muertos ="UPDATE `indices` SET `total_muertos` = '$count' WHERE `id` = 1";
        mysqli_query($conn, $sql_muertos);
    }
}
}

?>