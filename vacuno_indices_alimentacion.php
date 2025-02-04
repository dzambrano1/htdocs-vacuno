<?php

require_once '../conexion.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Calculos Graficos de Alimento Concentrado
$sql = "SELECT vh_concentrado_etapa, SUM(vh_concentrado_racion * vh_concentrado_costo) AS total
        FROM vh_concentrado
        GROUP BY vh_concentrado_etapa";

$result = mysqli_query($conn, $sql);

$inicio_percentaje = 0;
$crecimiento_percentaje = 0;
$finalizacion_percentaje = 0;
$total = 0; // Initialize total variable

if ($result) {
    // First pass to calculate total
    while ($row = mysqli_fetch_assoc($result)) {
        $total += $row['total']; // Accumulate total
    }
    // Reset result pointer to fetch data again
    mysqli_data_seek($result, 0);

    // Second pass to calculate percentages
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['vh_concentrado_etapa']) {
            case 'Inicio':
                $inicio_percentaje = ($row['total'] / $total) * 100;
                break;
            case 'Crecimiento':
                $crecimiento_percentaje = ($row['total'] / $total) * 100;
                break;
            case 'Finalizacion':
                $finalizacion_percentaje = ($row['total'] / $total) * 100;
                break;
        }
    }
}

// Calculos Graficos de Sal
$sql = "SELECT vh_sal_etapa, SUM(vh_sal_racion * vh_sal_costo) AS total
        FROM vh_sal
        GROUP BY vh_sal_etapa";

$result = mysqli_query($conn, $sql);

$inicio_sal_percentaje = 0;
$crecimiento_sal_percentaje = 0;
$finalizacion_sal_percentaje = 0;
$total = 0; // Initialize total variable

if ($result) {
    // First pass to calculate total
    while ($row = mysqli_fetch_assoc($result)) {
        $total += $row['total']; // Accumulate total
    }
    // Reset result pointer to fetch data again
    mysqli_data_seek($result, 0);

    // Second pass to calculate percentages
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['vh_sal_etapa']) {
            case 'Inicio':
                $inicio_sal_percentaje = ($row['total'] / $total) * 100;
                break;
            case 'Crecimiento':
                $crecimiento_sal_percentaje = ($row['total'] / $total) * 100;
                break;
            case 'Finalizacion':
                $finalizacion_sal_percentaje = ($row['total'] / $total) * 100;
                break;
        }
    }
}

// Calculos Graficos de Melaza
$sql = "SELECT vh_melaza_etapa, SUM(vh_melaza_racion * vh_melaza_costo) AS total
        FROM vh_melaza
        GROUP BY vh_melaza_etapa";

$result = mysqli_query($conn, $sql);

$inicio_melaza_percentaje = 0;
$crecimiento_melaza_percentaje = 0;
$finalizacion_melaza_percentaje = 0;
$total = 0; // Initialize total variable

if ($result) {
    // First pass to calculate total
    while ($row = mysqli_fetch_assoc($result)) {
        $total += $row['total']; // Accumulate total
    }
    // Reset result pointer to fetch data again
    mysqli_data_seek($result, 0);

    // Second pass to calculate percentages
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['vh_melaza_etapa']) {
            case 'Inicio':
                $inicio_melaza_percentaje = ($row['total'] / $total) * 100;
                break;
            case 'Crecimiento':
                $crecimiento_melaza_percentaje = ($row['total'] / $total) * 100;
                break;
            case 'Finalizacion':
                $finalizacion_melaza_percentaje = ($row['total'] / $total) * 100;
                break;
        }
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Indice Alimentacion</title>
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
    #chart-becerros-concentrado,
    #chart-novillos-concentrado,
    #chart-adultos-concentrado,
    #chart-becerros-sal,
    #chart-novillos-sal,
    #chart-adultos-sal,
    #chart-becerros-melaza,
    #chart-novillos-melaza,
    #chart-adultos-melaza
    
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
<!-- Alimento Concentrado-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">Concentrado</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-becerros-concentrado"></figure>
      <figure id="chart-novillos-concentrado"></figure>
      <figure id="chart-adultos-concentrado"></figure>
</div>
<!-- Sal-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">Sal</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-becerros-sal"></figure>
      <figure id="chart-novillos-sal"></figure>
      <figure id="chart-adultos-sal"></figure>
</div>
<!-- Indices Melaza-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">Melaza</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-becerros-melaza"></figure>
      <figure id="chart-novillos-melaza"></figure>
      <figure id="chart-adultos-melaza"></figure>
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

<!-- INDICES: Concentrado x Etapas -->

<!-- INDICE: Inicio -->
<script>
var dom = document.getElementById('chart-becerros-concentrado');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion en Iniciador",    
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
          value: <?php echo number_format($inicio_percentaje, 2); ?>
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
<!-- INDICE: Crecimiento -->
<script>
var dom = document.getElementById('chart-novillos-concentrado');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion en Crecimiento",    
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
          value: <?php echo number_format($crecimiento_percentaje, 2); ?>
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
<!-- INDICE: Finalizador -->
<script>
var dom = document.getElementById('chart-adultos-concentrado');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion en Finalizador",    
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
          value: <?php echo number_format($finalizacion_percentaje, 2); ?>
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
<!-- INDICE: Sal x Etapas -->
<!-- Sal Inicio  -->
<script>
var dom = document.getElementById('chart-becerros-sal');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion en Iniciador",    
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
          value: <?php echo number_format($inicio_sal_percentaje, 2); ?>
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
<!-- Sal Crecimiento  -->
<script>
var dom = document.getElementById('chart-novillos-sal');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion en Crecimiento",    
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
          value: <?php echo number_format($crecimiento_sal_percentaje, 2); ?>
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
<!-- Sal Finalizador  -->
<script>
var dom = document.getElementById('chart-adultos-sal');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion en Finalizacion",    
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
          value: <?php echo number_format($finalizacion_sal_percentaje, 2); ?>
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
<!-- INDICE: Melaza x Etapas -->
 <!-- INDICE: Inicio -->
<script>
var dom = document.getElementById('chart-becerros-melaza');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion Inicio",    
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
          value: <?php echo number_format($inicio_melaza_percentaje, 2); ?>
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
<!-- INDICE: Crecimiento -->
<script>
var dom = document.getElementById('chart-novillos-melaza');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion Crecmiento",    
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
          value: <?php echo number_format($crecimiento_melaza_percentaje, 2); ?>
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
<!-- INDICE: Finalizador -->
<script>
var dom = document.getElementById('chart-adultos-melaza');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Inversion Finalizacion",    
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
          value: <?php echo number_format($finalizacion_melaza_percentaje, 2); ?>
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