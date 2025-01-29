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
// Initialize counters
$counter1 = 0;
$counter2 = 0;
$counter3 = 0;
// SQL query to join vh_gestacion and vh_inseminacion
$sql = "
    SELECT 
        g.vh_gestacion_tagid, 
        g.vh_gestacion_fecha, 
        i.vh_inseminacion_fecha, 
        i.vh_inseminacion_numero
    FROM 
        vh_gestacion g
    JOIN 
        vh_inseminacion i ON g.vh_gestacion_tagid = i.vh_inseminacion_tagid
    WHERE 
        g.vh_gestacion_numero = i.vh_inseminacion_numero AND
        DATEDIFF(g.vh_gestacion_fecha, i.vh_inseminacion_fecha) < 31
";

// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['vh_inseminacion_numero']) {
            case 1:
                $counter1++;
                break;
            case 2:
                $counter2++;
                break;
            case 3:
                $counter3++;
                break;
        }
    }
}

$porcentaje_1era_inseminacion = $counter1/($counter1 + $counter2 + $counter3)*100;
$porcentaje_2da_inseminacion = $counter2/($counter1 + $counter2 + $counter3)*100;
$porcentaje_3era_inseminacion = $counter3/($counter1 + $counter2 + $counter3)*100;


// Initialize variables
$totalDays = 0;
$count = 0;

// SQL query to join vh_parto and vh_gestacion
$sql = "
    SELECT 
        DATEDIFF(p.vh_parto_fecha, g.vh_gestacion_fecha) AS days_difference
    FROM 
        vh_parto p
    JOIN 
        vh_gestacion g ON p.vh_parto_tagid = g.vh_gestacion_tagid
    WHERE 
        p.vh_parto_numero = g.vh_gestacion_numero
";

// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $totalDays += $row['days_difference']; // Accumulate total days
        $count++; // Increment count of entries
    }
}

// Calculate average if count is greater than 0 to avoid division by zero
$averageDays = $count > 0 ? $totalDays / $count : 0;

// Now you can use $averageDays as needed

// Initialize variables
$totalEmptyDays = 0;
$count = 0;

// SQL query to calculate empty days
$sql = "
    SELECT 
        g.vh_gestacion_fecha,
        g.vh_gestacion_numero,
        p.vh_parto_numero,
        COALESCE(p.vh_parto_fecha, '0000-00-00') AS parto_fecha
    FROM 
        vh_gestacion g
    RIGHT JOIN 
        vh_parto p ON g.vh_gestacion_tagid = p.vh_parto_tagid 
        AND g.vh_gestacion_numero - 1 = p.vh_parto_numero
";

// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate the difference in days
        if ($row['parto_fecha'] !== '0000-00-00') {
            $daysDifference = abs((strtotime($row['vh_gestacion_fecha']) - strtotime($row['parto_fecha'])) / (60 * 60 * 24));
            $totalEmptyDays += $daysDifference; // Accumulate total empty days
            $count++; // Increment count of entries
        } else {
            // If there is no previous birth, empty days are considered zero
            $totalEmptyDays += 0; // This line is optional as it does not change the total
            $count++; // Still count this entry
        }
    }
}

// Calculate average if count is greater than 0 to avoid division by zero
$averageEmptyDays = $count > 0 ? $totalEmptyDays / $count : 0;

// Now you can use $averageEmptyDays as needed

// Initialize variables
$totalDaysDifference = 0;
$count = 0;

// SQL query to calculate days between consecutive births
$sql = "
    SELECT 
        p1.vh_parto_fecha AS fecha_n,
        p2.vh_parto_fecha AS fecha_n_plus_1
    FROM 
        vh_parto p1
    JOIN 
        vh_parto p2 ON p1.vh_parto_tagid = p2.vh_parto_tagid 
        AND p2.vh_parto_numero = p1.vh_parto_numero + 1
";

// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate the difference in days
        $daysDifference = abs((strtotime($row['fecha_n_plus_1']) - strtotime($row['fecha_n'])) / (60 * 60 * 24));
        $totalDaysDifference += $daysDifference; // Accumulate total days difference
        $count++; // Increment count of entries
    }
}

// Calculate average if count is greater than 0 to avoid division by zero
$averageDaysDifference = $count > 0 ? $totalDaysDifference / $count : 0;

// Now you can use $averageDaysDifference as needed

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Indice Reproduccion</title>
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
    #chart-1er-celo,
    #chart-2do-celo,
    #chart-3er-celo,
    #chart-enordeno,
    #chart-dias-gestacion,
    #chart-dias-vacios,
    #chart-dias-entre-partos,
    #chart-partos-anuales
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
<!-- Indices Preñez-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">PREÑEZ</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-1er-celo"></figure>
      <figure id="chart-2do-celo"></figure>
      <figure id="chart-3er-celo"></figure>
</div>
<!-- Indices Gestacion-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">GESTACION</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-dias-gestacion"></figure>
      <figure id="chart-dias-vacios"></figure>
</div>
<!-- Indices Paricion-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">PARICION</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-dias-entre-partos"></figure>
      <figure id="chart-partos-anuales"></figure>
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

<!-- INDICE: Preñez 1er Celo -->
<script>
var dom = document.getElementById('chart-1er-celo');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Preñez 1er Celo",    
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
      min: 0,
      max: 100,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#7efa48'],
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
          value: <?php echo number_format($porcentaje_1era_inseminacion, 2); ?>
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
<!-- INDICE: Preñez 2do Celo -->
<script>
var dom = document.getElementById('chart-2do-celo');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Preñez 2do Celo",    
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
      min: 0,
      max: 100,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#7efa48'],
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
          value: <?php echo number_format($porcentaje_2da_inseminacion, 2); ?>
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
<!-- INDICE: Preñez 3er Celo -->
<script>
var dom = document.getElementById('chart-3er-celo');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Preñez 3er Celo",    
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
      min: 0,
      max: 100,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#7efa48'],
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
          value: <?php echo number_format($porcentaje_3era_inseminacion, 2); ?>
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

<!-- INDICE: Dias entre Partos -->
<script>
var dom = document.getElementById('chart-dias-gestacion');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  series: [
    {
      type: 'gauge',
      startAngle: 180,
      endAngle: 0,
      min: 200,
      max: 300,
      splitNumber: 8,
      itemStyle: {
        color: '#9aca8a',
        shadowColor: 'rgba(0,138,255,0.45)',
        shadowBlur: 10,
        shadowOffsetX: 2,
        shadowOffsetY: 2
      },
      progress: {
        show: true,
        roundCap: true,
        width: 10
      },
      pointer: {
        icon: 'path://M2090.36389,615.30999 L2090.36389,615.30999 C2091.48372,615.30999 2092.40383,616.194028 2092.44859,617.312956 L2096.90698,728.755929 C2097.05155,732.369577 2094.2393,735.416212 2090.62566,735.56078 C2090.53845,735.564269 2090.45117,735.566014 2090.36389,735.566014 L2090.36389,735.566014 C2086.74736,735.566014 2083.81557,732.63423 2083.81557,729.017692 C2083.81557,728.930412 2083.81732,728.84314 2083.82081,728.755929 L2088.2792,617.312956 C2088.32396,616.194028 2089.24407,615.30999 2090.36389,615.30999 Z',
        length: '75%',
        width: 10,
        offsetCenter: [0, '5%']
      },
      axisLine: {
        roundCap: true,
        lineStyle: {
          width: 2
        }
      },
      axisTick: {
        splitNumber: 2,
        lineStyle: {
          width: 2,
          color: '#999'
        }
      },
      splitLine: {
        length: 10,
        lineStyle: {
          width: 3,
          color: '#999'
        }
      },
      axisLabel: {
        distance: 10,
        color: '#999',
        fontSize: 8
      },
      title: {
        show: true
      },
      detail: {
        width: '100%',
        lineHeight: 40,
        height: 40,
        borderRadius: 8,
        offsetCenter: [0, '35%'],
        valueAnimation: true,
        formatter: function (value) {
          return '{value|' + value.toFixed(0) + '}{unit|Dias de Gestacion}';
        },
        rich: {
          value: {
            fontSize: 18,
            fontWeight: 'bolder',
            color: '#777'
          },
          unit: {
            fontSize: 20,
            color: '#999',
            padding: [0, 0, -0, 10]
          }
        }
      },
      data: [
        {
          value: <?php echo number_format($averageDays, 0); ?>
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
<!-- INDICE: Dias Vacios -->
<script>
var dom = document.getElementById('chart-dias-vacios');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  series: [
    {
      type: 'gauge',
      startAngle: 180,
      endAngle: 0,
      min: 45,
      max: 100,
      splitNumber: 8,
      itemStyle: {
        color: '#9aca8a',
        shadowColor: 'rgba(0,138,255,0.45)',
        shadowBlur: 10,
        shadowOffsetX: 2,
        shadowOffsetY: 2
      },
      progress: {
        show: true,
        roundCap: true,
        width: 10
      },
      pointer: {
        icon: 'path://M2090.36389,615.30999 L2090.36389,615.30999 C2091.48372,615.30999 2092.40383,616.194028 2092.44859,617.312956 L2096.90698,728.755929 C2097.05155,732.369577 2094.2393,735.416212 2090.62566,735.56078 C2090.53845,735.564269 2090.45117,735.566014 2090.36389,735.566014 L2090.36389,735.566014 C2086.74736,735.566014 2083.81557,732.63423 2083.81557,729.017692 C2083.81557,728.930412 2083.81732,728.84314 2083.82081,728.755929 L2088.2792,617.312956 C2088.32396,616.194028 2089.24407,615.30999 2090.36389,615.30999 Z',
        length: '75%',
        width: 10,
        offsetCenter: [0, '5%']
      },
      axisLine: {
        roundCap: true,
        lineStyle: {
          width: 2
        }
      },
      axisTick: {
        splitNumber: 2,
        lineStyle: {
          width: 2,
          color: '#999'
        }
      },
      splitLine: {
        length: 10,
        lineStyle: {
          width: 3,
          color: '#999'
        }
      },
      axisLabel: {
        distance: 10,
        color: '#999',
        fontSize: 8
      },
      title: {
        show: true
      },
      detail: {
        width: '100%',
        lineHeight: 40,
        height: 40,
        borderRadius: 8,
        offsetCenter: [0, '35%'],
        valueAnimation: true,
        formatter: function (value) {
          return '{value|' + value.toFixed(0) + '}{unit|Dias Vacios}';
        },
        rich: {
          value: {
            fontSize: 18,
            fontWeight: 'bolder',
            color: '#777'
          },
          unit: {
            fontSize: 20,
            color: '#999',
            padding: [0, 0, -0, 10]
          }
        }
      },
      data: [
        {
          value: <?php echo number_format($averageEmptyDays, 0); ?>
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
<!-- INDICE: Dias Entre Partos -->
<script>
var dom = document.getElementById('chart-dias-entre-partos');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  series: [
    {
      type: 'gauge',
      startAngle: 180,
      endAngle: 0,
      min: 300,
      max: 400,
      splitNumber: 8,
      itemStyle: {
        color: '#9aca8a',
        shadowColor: 'rgba(0,138,255,0.45)',
        shadowBlur: 10,
        shadowOffsetX: 2,
        shadowOffsetY: 2
      },
      progress: {
        show: true,
        roundCap: true,
        width: 10
      },
      pointer: {
        icon: 'path://M2090.36389,615.30999 L2090.36389,615.30999 C2091.48372,615.30999 2092.40383,616.194028 2092.44859,617.312956 L2096.90698,728.755929 C2097.05155,732.369577 2094.2393,735.416212 2090.62566,735.56078 C2090.53845,735.564269 2090.45117,735.566014 2090.36389,735.566014 L2090.36389,735.566014 C2086.74736,735.566014 2083.81557,732.63423 2083.81557,729.017692 C2083.81557,728.930412 2083.81732,728.84314 2083.82081,728.755929 L2088.2792,617.312956 C2088.32396,616.194028 2089.24407,615.30999 2090.36389,615.30999 Z',
        length: '75%',
        width: 10,
        offsetCenter: [0, '5%']
      },
      axisLine: {
        roundCap: true,
        lineStyle: {
          width: 2
        }
      },
      axisTick: {
        splitNumber: 2,
        lineStyle: {
          width: 2,
          color: '#999'
        }
      },
      splitLine: {
        length: 10,
        lineStyle: {
          width: 3,
          color: '#999'
        }
      },
      axisLabel: {
        distance: 10,
        color: '#999',
        fontSize: 8
      },
      title: {
        show: true
      },
      detail: {
        width: '100%',
        lineHeight: 40,
        height: 40,
        borderRadius: 8,
        offsetCenter: [0, '35%'],
        valueAnimation: true,
        formatter: function (value) {
          return '{value|' + value.toFixed(0) + '}{unit|Dias Entre Partos}';
        },
        rich: {
          value: {
            fontSize: 18,
            fontWeight: 'bolder',
            color: '#777'
          },
          unit: {
            fontSize: 20,
            color: '#999',
            padding: [0, 0, -0, 10]
          }
        }
      },
      data: [
        {
          value: <?php echo number_format($averageDaysDifference, 0); ?>
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
<!-- INDICE: Partos anuales -->
<script>
var dom = document.getElementById('chart-partos-anuales');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  series: [
    {
      type: 'gauge',
      startAngle: 180,
      endAngle: 0,
      min: 0.5,
      max: 1.5,
      splitNumber: 8,
      itemStyle: {
        color: '#9aca8a',
        shadowColor: 'rgba(0,138,255,0.45)',
        shadowBlur: 10,
        shadowOffsetX: 2,
        shadowOffsetY: 2
      },
      progress: {
        show: true,
        roundCap: true,
        width: 10
      },
      pointer: {
        icon: 'path://M2090.36389,615.30999 L2090.36389,615.30999 C2091.48372,615.30999 2092.40383,616.194028 2092.44859,617.312956 L2096.90698,728.755929 C2097.05155,732.369577 2094.2393,735.416212 2090.62566,735.56078 C2090.53845,735.564269 2090.45117,735.566014 2090.36389,735.566014 L2090.36389,735.566014 C2086.74736,735.566014 2083.81557,732.63423 2083.81557,729.017692 C2083.81557,728.930412 2083.81732,728.84314 2083.82081,728.755929 L2088.2792,617.312956 C2088.32396,616.194028 2089.24407,615.30999 2090.36389,615.30999 Z',
        length: '75%',
        width: 10,
        offsetCenter: [0, '5%']
      },
      axisLine: {
        roundCap: true,
        lineStyle: {
          width: 2
        }
      },
      axisTick: {
        splitNumber: 2,
        lineStyle: {
          width: 2,
          color: '#999'
        }
      },
      splitLine: {
        length: 10,
        lineStyle: {
          width: 3,
          color: '#999'
        }
      },
      axisLabel: {
        distance: 10,
        color: '#999',
        fontSize: 8
      },
      title: {
        show: true
      },
      detail: {
        width: '100%',
        lineHeight: 40,
        height: 40,
        borderRadius: 8,
        offsetCenter: [0, '35%'],
        valueAnimation: true,
        formatter: function (value) {
          return '{value|' + value.toFixed(2) + '}{unit|Partos por Año}';
        },
        rich: {
          value: {
            fontSize: 18,
            fontWeight: 'bolder',
            color: '#777'
          },
          unit: {
            fontSize: 20,
            color: '#999',
            padding: [0, 0, -0, 10]
          }
        }
      },
      data: [
        {
          value: <?php echo number_format(365/$averageDaysDifference, 2); ?>
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