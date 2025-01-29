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
// AFTOSA
$total_animals = 0;
$total_aftosa_vaccinated = 0;
$aftosa_vaccinated_percentage = 0;

// SQL query to count unique tagids from vacuno table
$sql_animals = "
    SELECT COUNT(DISTINCT tagid) AS total_animals
    FROM vacuno
";

// Execute the query for total animals
$result_animals = mysqli_query($conn, $sql_animals);
if ($result_animals) {
    $row = mysqli_fetch_assoc($result_animals);
    $total_animals = $row['total_animals'];
}

// SQL query to count distinct vh_aftosa_tagid from vh_aftosa table
$sql_aftosa = "
    SELECT COUNT(DISTINCT vh_aftosa_tagid) AS total_aftosa_vaccinated
    FROM vh_aftosa
";

// Execute the query for total aftosa vaccinated
$result_aftosa = mysqli_query($conn, $sql_aftosa);
if ($result_aftosa) {
    $row = mysqli_fetch_assoc($result_aftosa);
    $total_aftosa_vaccinated = $row['total_aftosa_vaccinated'];
}

// Calculate the percentage of animals vaccinated with aftosa
if ($total_animals > 0) {
    $aftosa_vaccinated_percentage = ($total_aftosa_vaccinated / $total_animals) * 100;
} else {
    $aftosa_vaccinated_percentage = 0; // Avoid division by zero
}

// BRUCELOSIS
$total_animals = 0;
$total_brucelosis_vaccinated = 0;
$brucelosis_vaccinated_percentage = 0;

// SQL query to count unique tagids from vacuno table
$sql_animals = "
    SELECT COUNT(DISTINCT tagid) AS total_animals
    FROM vacuno
";

// Execute the query for total animals
$result_animals = mysqli_query($conn, $sql_animals);
if ($result_animals) {
    $row = mysqli_fetch_assoc($result_animals);
    $total_animals = $row['total_animals'];
}

// SQL query to count distinct vh_brucelosis_tagid from vh_brucelosis table
$sql_brucelosis = "
    SELECT COUNT(DISTINCT vh_brucelosis_tagid) AS total_brucelosis_vaccinated
    FROM vh_brucelosis
";

// Execute the query for total brucelosis vaccinated
$result_brucelosis = mysqli_query($conn, $sql_brucelosis);
if ($result_brucelosis) {
    $row = mysqli_fetch_assoc($result_brucelosis);
    $total_brucelosis_vaccinated = $row['total_brucelosis_vaccinated'];
}

// Calculate the percentage of animals vaccinated with brucelosis
if ($total_animals > 0) {
    $brucelosis_vaccinated_percentage = ($total_brucelosis_vaccinated / $total_animals) * 100;
} else {
    $brucelosis_vaccinated_percentage = 0;
}

// IBR
$total_animals = 0;
$total_ibr_vaccinated = 0;
$ibr_vaccinated_percentage = 0;

// SQL query to count unique tagids from vacuno table
$sql_animals = "
    SELECT COUNT(DISTINCT tagid) AS total_animals
    FROM vacuno
";

// Execute the query for total animals
$result_animals = mysqli_query($conn, $sql_animals);
if ($result_animals) {
    $row = mysqli_fetch_assoc($result_animals);
    $total_animals = $row['total_animals'];
}

// SQL query to count distinct vh_ibr_tagid from vh_ibr table
$sql_ibr = "
    SELECT COUNT(DISTINCT vh_ibr_tagid) AS total_ibr_vaccinated
    FROM vh_ibr
";

// Execute the query for total ibr vaccinated
$result_ibr = mysqli_query($conn, $sql_ibr);
if ($result_ibr) {
    $row = mysqli_fetch_assoc($result_ibr);
    $total_ibr_vaccinated = $row['total_ibr_vaccinated'];
}

// Calculate the percentage of animals vaccinated with ibr
if ($total_animals > 0) {
    $ibr_vaccinated_percentage = ($total_ibr_vaccinated / $total_animals) * 100;
} else {
    $ibr_vaccinated_percentage = 0; // Avoid division by zero
}

// Carbunco
$total_animals = 0;
$total_carbunco_vaccinated = 0;
$carbunco_vaccinated_percentage = 0;

// SQL query to count unique tagids from vacuno table
$sql_animals = "
    SELECT COUNT(DISTINCT tagid) AS total_animals
    FROM vacuno
";

// Execute the query for total animals
$result_animals = mysqli_query($conn, $sql_animals);
if ($result_animals) {
    $row = mysqli_fetch_assoc($result_animals);
    $total_animals = $row['total_animals'];
}

// SQL query to count distinct vh_carbunco_tagid from vh_carbunco table
$sql_carbunco = "
    SELECT COUNT(DISTINCT vh_carbunco_tagid) AS total_carbunco_vaccinated
    FROM vh_carbunco
";

// Execute the query for total carbunco vaccinated
$result_carbunco = mysqli_query($conn, $sql_carbunco);
if ($result_carbunco) {
    $row = mysqli_fetch_assoc($result_carbunco);
    $total_carbunco_vaccinated = $row['total_carbunco_vaccinated'];
}

// Calculate the percentage of animals vaccinated with carbunco
if ($total_animals > 0) {
    $carbunco_vaccinated_percentage = ($total_carbunco_vaccinated / $total_animals) * 100;
} else {
    $ibr_vaccinated_percentage = 0;
}

// CBR
$total_animals = 0;
$total_cbr_vaccinated = 0;
$cbr_vaccinated_percentage = 0;

// SQL query to count unique tagids from vacuno table
$sql_animals = "
    SELECT COUNT(DISTINCT tagid) AS total_animals
    FROM vacuno
";

// Execute the query for total animals
$result_animals = mysqli_query($conn, $sql_animals);
if ($result_animals) {
    $row = mysqli_fetch_assoc($result_animals);
    $total_animals = $row['total_animals'];
}

// SQL query to count distinct vh_cbr_tagid from vh_cbr table
$sql_cbr = "
    SELECT COUNT(DISTINCT vh_cbr_tagid) AS total_cbr_vaccinated
    FROM vh_cbr
";

// Execute the query for total CBR vaccinated
$result_cbr = mysqli_query($conn, $sql_cbr);
if ($result_cbr) {
    $row = mysqli_fetch_assoc($result_cbr);
    $total_cbr_vaccinated = $row['total_cbr_vaccinated'];
}

// Calculate the percentage of animals vaccinated with CBR
if ($total_animals > 0) {
    $cbr_vaccinated_percentage = ($total_cbr_vaccinated / $total_animals) * 100;
} else {
    $cbr_vaccinated_percentage = 0;
}

// Garrapatas
$total_animals = 0;
$total_garrapatas_vaccinated = 0;
$garrapatas_vaccinated_percentage = 0;

// SQL query to count unique tagids from vacuno table
$sql_animals = "
    SELECT COUNT(DISTINCT tagid) AS total_animals
    FROM vacuno
";

// Execute the query for total animals
$result_animals = mysqli_query($conn, $sql_animals);
if ($result_animals) {
    $row = mysqli_fetch_assoc($result_animals);
    $total_animals = $row['total_animals'];
}

// SQL query to count distinct vh_garrapatas_tagid from vh_garrapatas table
$sql_garrapatas = "
    SELECT COUNT(DISTINCT vh_garrapatas_tagid) AS total_garrapatas_vaccinated
    FROM vh_garrapatas
";

// Execute the query for total CBR vaccinated
$result_garrapatas = mysqli_query($conn, $sql_garrapatas);
if ($result_garrapatas) {
    $row = mysqli_fetch_assoc($result_garrapatas);
    $total_garrapatas_vaccinated = $row['total_garrapatas_vaccinated'];
}

// Calculate the percentage of animals vaccinated with garrapatas
if ($total_animals > 0) {
    $garrapatas_vaccinated_percentage = ($total_garrapatas_vaccinated / $total_animals) * 100;
} else {
    $garrapatas_vaccinated_percentage = 0;
}

// Mastitis
$total_animals = 0;
$total_mastitis_vaccinated = 0;
$mastitis_vaccinated_percentage = 0;

// SQL query to count unique tagids from vacuno table
$sql_animals = "
    SELECT COUNT(DISTINCT tagid) AS total_animals
    FROM vacuno
";

// Execute the query for total animals
$result_animals = mysqli_query($conn, $sql_animals);
if ($result_animals) {
    $row = mysqli_fetch_assoc($result_animals);
    $total_animals = $row['total_animals'];
}

// SQL query to count distinct vh_mastitis_tagid from vh_mastitis table
$sql_mastitis = "
    SELECT COUNT(DISTINCT vh_mastitis_tagid) AS total_mastitis_vaccinated
    FROM vh_mastitis
";

// Execute the query for total mastitis vaccinated
$result_mastitis = mysqli_query($conn, $sql_mastitis);
if ($result_mastitis) {
    $row = mysqli_fetch_assoc($result_mastitis);
    $total_mastitis_vaccinated = $row['total_mastitis_vaccinated'];
}

// Calculate the percentage of animals vaccinated with mastitis
if ($total_animals > 0) {
    $mastitis_vaccinated_percentage = ($total_mastitis_vaccinated / $total_animals) * 100;
} else {
    $mastitis_vaccinated_percentage = 0;
}
// Parasitos
$total_animals = 0;
$total_parasitos_vaccinated = 0;
$parasitos_vaccinated_percentage = 0;

// SQL query to count unique tagids from vacuno table
$sql_animals = "
    SELECT COUNT(DISTINCT tagid) AS total_animals
    FROM vacuno
";

// Execute the query for total animals
$result_animals = mysqli_query($conn, $sql_animals);
if ($result_animals) {
    $row = mysqli_fetch_assoc($result_animals);
    $total_animals = $row['total_animals'];
}

// SQL query to count distinct vh_parasitos_tagid from vh_parasitos table
$sql_parasitos = "
    SELECT COUNT(DISTINCT vh_parasitos_tagid) AS total_parasitos_vaccinated
    FROM vh_parasitos
";

// Execute the query for total Parasitos vaccinated
$result_parasitos = mysqli_query($conn, $sql_parasitos);
if ($result_parasitos) {
    $row = mysqli_fetch_assoc($result_parasitos);
    $total_parasitos_vaccinated = $row['total_parasitos_vaccinated'];
}

// Calculate the percentage of animals vaccinated with parasitos
if ($total_animals > 0) {
    $parasitos_vaccinated_percentage = ($total_parasitos_vaccinated / $total_animals) * 100;
} else {
    $parasitos_vaccinated_percentage = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Indices Salud</title>
  <link rel="icon" type="image/x-icon" href="/images/Ganagram_ico.ico">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <!-- Font Awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- DataTable JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Responsive dataTables Js -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <!-- Responsive dataTables Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.css">
   <!-- Fixed Header for Column Search -->
   <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
   <!-- HighCharts CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://code.highcharts.com/css/highcharts.css"></link>
    <!-- HighCharts JS CDN -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/xrange.js"></script>
    <!-- HighCharts CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://code.highcharts.com/css/highcharts.css"></link>
    <!--Script de eCharts.js para los Indices-->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <!-- Custom CSS-->
    <link rel="stylesheet" href="https://ganagram.com/ganagram/css/ganagram.css" />
    
<style>
  body{
    font-family: sans-serif;      
  }
  .filtros-graficos
  {
    background-color:rgb(230, 234, 225,.7);
    backdrop-filter: blur(7px);
    box-shadow: 0 .4rem .8rem #0005;
    border:1px solid #ccc;
    border-radius:3%;
    margin-top:0.3rem;
  }
    #chart-lactancia,
    #chart-enordeno,
    #chart-aftosa,
    #chart-brucelosis,
    #chart-ibr,
    #chart-cbr,
    #chart-carbunco,
    #chart-garrapatas,
    #chart-parasitos,
    #chart-mastitis
    
  {
    width:20rem;
    height:20rem;
    margin-top:1rem;
    margin-right:1rem;
    background-color:rgb(230, 234, 225,.70);
    backdrop-filter: blur(7px);
    box-shadow: 0 .4rem .8rem #0005;
    border:1px solid #ccc;
    border-radius:3%;
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
<!-- Indices Vacunacion-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">Vacunacion</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">
      <figure id="chart-aftosa"></figure>
      <figure id="chart-brucelosis"></figure>
      <figure id="chart-ibr"></figure>
</div>
<div class="container d-flex justify-content-center flex-wrap">
<figure id="chart-cbr"></figure>
      <figure id="chart-carbunco"></figure>
</div>
<!-- Indices Baños-->
<div class="container" style="margin-top: 20px;width:90%;">
    <h3 class="section-title">Baños</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
    <figure id="chart-parasitos"></figure>
    <figure id="chart-garrapatas"></figure>
</div>
<!-- Indices Parasitos-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">TRATAMIENTOS</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">
      <figure id="chart-mastitis"></figure>
</div>

<!-- Librerias -->
<!-- Bootstrap  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- Librerias -->
<!-- Bootstrap  -->
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<!-- Popper Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<!-- para usar botones en datatables JS -->  
    <script src="http://ganagram.com/ganagram/crud/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="http://ganagram.com/ganagram/crud/datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="http://ganagram.com/ganagram/crud/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="http://ganagram.com/ganagram/crud/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="http://ganagram.com/ganagram/crud/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<!-- Ion Icon Js -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>    
<!-- Custom Menu Js -->
<script src="https://ganagram.com/ganagram/html/js/menu.js"></script>

<!-- INDICE: Vacas en Ordeño -->
<!-- Fiebre Aftosa -->
<script>
var dom = document.getElementById('chart-aftosa');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "% Vacunados Aftosa",    
    subtext: "",
    left: "center",
    top:"bottom",    
    textStyle: {
      fontSize: 14,
      color:'#696868',
    },
    subtextStyle: {
      fontSize: 10     
    }
  },
  series: [
    {
      type: 'gauge',
      min: 80,
      max: 90,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#c9ffb8'],
            [0.8, '#9aca8a'],
            [0.9, '#9aca8a'],
            [1, '#9aca8a']
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 30,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'inherit',
        distance: 25,
        fontSize: 8
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'inherit',
        margin:20,
        padding: 20,
        fontSize:12
      },
      data: [
        {
          value: <?php echo number_format($aftosa_vaccinated_percentage, 2); ?>
        }
      ]
    }
  ]
};
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
window.addEventListener('resize', myChart.resize);
</script>
<!-- Brucelosis -->
<script>
var dom = document.getElementById('chart-brucelosis');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "% Vacunados Brucelosis",    
    subtext: "",
    left: "center",
    top:"bottom",    
    textStyle: {
      fontSize: 14,
      color:'#696868',
    },
    subtextStyle: {
      fontSize: 10     
    }
  },
  series: [
    {
      type: 'gauge',
      min: 80,
      max: 90,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#c9ffb8'],
            [0.8, '#9aca8a'],
            [0.9, '#9aca8a'],
            [1, '#9aca8a']
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 30,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'inherit',
        distance: 25,
        fontSize: 8
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'inherit',
        margin:20,
        padding: 20,
        fontSize:12
      },
      data: [
        {
          value: <?php echo number_format($brucelosis_vaccinated_percentage, 2); ?>
        }
      ]
    }
  ]
};
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
window.addEventListener('resize', myChart.resize);
</script>
<!-- IBR -->
<script>
var dom = document.getElementById('chart-ibr');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "% Vacunados IBR",    
    subtext: "",
    left: "center",
    top:"bottom",    
    textStyle: {
      fontSize: 14,
      color:'#696868',
    },
    subtextStyle: {
      fontSize: 10     
    }
  },
  series: [
    {
      type: 'gauge',
      min: 80,
      max: 90,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#c9ffb8'],
            [0.8, '#9aca8a'],
            [0.9, '#9aca8a'],
            [1, '#9aca8a']
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 30,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'inherit',
        distance: 25,
        fontSize: 8
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'inherit',
        margin:20,
        padding: 20,
        fontSize:12
      },
      data: [
        {
          value: <?php echo number_format($ibr_vaccinated_percentage, 2); ?>
        }
      ]
    }
  ]
};
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
window.addEventListener('resize', myChart.resize);
</script>
<!-- Carbunco -->
<script>
var dom = document.getElementById('chart-carbunco');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "% Vacunados Carbunco",    
    subtext: "",
    left: "center",
    top:"bottom",    
    textStyle: {
      fontSize: 14,
      color:'#696868',
    },
    subtextStyle: {
      fontSize: 10     
    }
  },
  series: [
    {
      type: 'gauge',
      min: 80,
      max: 90,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#c9ffb8'],
            [0.8, '#9aca8a'],
            [0.9, '#9aca8a'],
            [1, '#9aca8a']
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 30,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'inherit',
        distance: 25,
        fontSize: 8
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'inherit',
        margin:20,
        padding: 20,
        fontSize:12
      },
      data: [
        {
          value: <?php echo number_format($carbunco_vaccinated_percentage, 2); ?>
        }
      ]
    }
  ]
};
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
window.addEventListener('resize', myChart.resize);
</script>
<!-- CBR -->
<script>
var dom = document.getElementById('chart-cbr');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "% Vacunados CBR",    
    subtext: "",
    left: "center",
    top:"bottom",    
    textStyle: {
      fontSize: 14,
      color:'#696868',
    },
    subtextStyle: {
      fontSize: 10     
    }
  },
  series: [
    {
      type: 'gauge',
      min: 80,
      max: 90,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#c9ffb8'],
            [0.8, '#9aca8a'],
            [0.9, '#9aca8a'],
            [1, '#9aca8a']
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 30,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'inherit',
        distance: 25,
        fontSize: 8
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'inherit',
        margin:20,
        padding: 20,
        fontSize:12
      },
      data: [
        {
          value: <?php echo number_format($cbr_vaccinated_percentage, 2); ?>
        }
      ]
    }
  ]
};
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
window.addEventListener('resize', myChart.resize);
</script>
<!-- Garrapatas -->
<script>
var dom = document.getElementById('chart-garrapatas');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "% Bañados Garrapatas",    
    subtext: "",
    left: "center",
    top:"bottom",    
    textStyle: {
      fontSize: 14,
      color:'#696868',
    },
    subtextStyle: {
      fontSize: 10     
    }
  },
  series: [
    {
      type: 'gauge',
      min: 80,
      max: 90,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#c9ffb8'],
            [0.8, '#9aca8a'],
            [0.9, '#9aca8a'],
            [1, '#9aca8a']
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 30,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'inherit',
        distance: 25,
        fontSize: 8
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'inherit',
        margin:20,
        padding: 20,
        fontSize:12
      },
      data: [
        {
          value: <?php echo number_format($garrapatas_vaccinated_percentage, 2); ?>
        }
      ]
    }
  ]
};
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
window.addEventListener('resize', myChart.resize);
</script>
<!-- Parasitos -->
<script>
var dom = document.getElementById('chart-parasitos');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "% Desparasitados",    
    subtext: "",
    left: "center",
    top:"bottom",    
    textStyle: {
      fontSize: 14,
      color:'#696868',
    },
    subtextStyle: {
      fontSize: 10     
    }
  },
  series: [
    {
      type: 'gauge',
      min: 80,
      max: 90,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#c9ffb8'],
            [0.8, '#9aca8a'],
            [0.9, '#9aca8a'],
            [1, '#9aca8a']
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 30,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'inherit',
        distance: 25,
        fontSize: 8
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'inherit',
        margin:20,
        padding: 20,
        fontSize:12
      },
      data: [
        {
          value: <?php echo number_format($parasitos_vaccinated_percentage, 2); ?>
        }
      ]
    }
  ]
};
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
window.addEventListener('resize', myChart.resize);
</script>
<!-- Mastitis -->
<script>
var dom = document.getElementById('chart-mastitis');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "% Tratados Mastitis",    
    subtext: "",
    left: "center",
    top:"bottom",    
    textStyle: {
      fontSize: 14,
      color:'#696868',
    },
    subtextStyle: {
      fontSize: 10     
    }
  },
  series: [
    {
      type: 'gauge',
      min: 80,
      max: 90,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#c9ffb8'],
            [0.8, '#9aca8a'],
            [0.9, '#9aca8a'],
            [1, '#9aca8a']
          ]
        }
      },
      pointer: {
        itemStyle: {
          color: 'auto'
        }
      },
      axisTick: {
        distance: -30,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      splitLine: {
        distance: -30,
        length: 30,
        lineStyle: {
          color: '#fff',
          width: 4
        }
      },
      axisLabel: {
        color: 'inherit',
        distance: 25,
        fontSize: 8
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'inherit',
        margin:20,
        padding: 20,
        fontSize:12
      },
      data: [
        {
          value: <?php echo number_format($mastitis_vaccinated_percentage, 2); ?>
        }
      ]
    }
  ]
};
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
window.addEventListener('resize', myChart.resize);
</script>
</body>
</html>