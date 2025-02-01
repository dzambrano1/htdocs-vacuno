<?php
// Hostinger credentials
// $servername = "localhost";
// $username = "u568157883_root";
// $password = "Sebastian7754*";
// $dbname = "u568157883_ganagram";

// local Credentials
// header("Access-Control-Allow-Headers:*");
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ganagram";

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


// Initialize variables
$totalLactancyDays = 0;
$count = 0;

// Get today's date
$currentDate = date('Y-m-d');

// SQL query to calculate average lactancy days
$sql = "
    SELECT 
        n.tagid,
        n.fecha_nacimiento,
        COALESCE(d.vh_destete_fecha, '$currentDate') AS end_date
    FROM 
        vacuno n
    LEFT JOIN 
        vh_destete d ON n.tagid = d.vh_destete_tagid
    WHERE 
        n.etapa = 'inicio'
";

// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate the difference in days
        $lactancyDays = (strtotime($row['end_date']) - strtotime($row['fecha_nacimiento'])) / (60 * 60 * 24);
        
        // Only count if lactancyDays is non-negative
        if ($lactancyDays >= 0) {
            $totalLactancyDays += $lactancyDays; // Accumulate total lactancy days
            $count++; // Increment count of entries
        }
    }
}

// Calculate average if count is greater than 0 to avoid division by zero
$averageLactancyDays = $count > 0 ? $totalLactancyDays / $count : 0;

// Now you can use $averageLactancyDays as needed

// Indice Vacas en Ordeño

$totalInicio = 0;
$totalVacas = 0;
$vacasEnOrdenoPercentage = 0;

// SQL query to count tagids with etapa equal to 'Inicio'
$sql_inicio = "
    SELECT COUNT(DISTINCT tagid) AS total_inicio
    FROM vacuno
    WHERE clase = 'Becerro' OR clase = 'Becerra'
";

// Execute the query for total inicio
$result_inicio = mysqli_query($conn, $sql_inicio);
if ($result_inicio) {
    $row = mysqli_fetch_assoc($result_inicio);
    $totalInicio = $row['total_inicio'];
}

// SQL query to count tagids with clase equal to 'Vaca'
$sql_vacas = "
    SELECT COUNT(DISTINCT tagid) AS total_vacas
    FROM vacuno
    WHERE clase = 'Vaca'
";

// Execute the query for total vacas
$result_vacas = mysqli_query($conn, $sql_vacas);
if ($result_vacas) {
    $row = mysqli_fetch_assoc($result_vacas);
    $totalVacas = $row['total_vacas'];
}

// Calculate the percentage of vacas en ordeño
if ($totalVacas > 0) {
    $vacasEnOrdenoPercentage = ($totalInicio / $totalVacas) * 100;
} else {
    $vacasEnOrdenoPercentage = 0; // Avoid division by zero
}

// Now you can use $vacasEnOrdenoPercentage as needed

// Fetch average monthly Leche production
$avgLecheQuery = "
    SELECT 
        DATE_FORMAT(vh_leche_fecha, '%Y-%m') AS production_month, 
        AVG(vh_leche_peso) AS average_leche
    FROM 
        vh_leche
    GROUP BY 
        production_month
    ORDER BY 
        production_month ASC
";

$avgLecheResult = mysqli_query($conn, $avgLecheQuery);

$avgLecheLabels = [];
$avgLecheData = [];

if ($avgLecheResult && mysqli_num_rows($avgLecheResult) > 0) {
    while ($row = mysqli_fetch_assoc($avgLecheResult)) {
        $avgLecheLabels[] = $row['production_month'];
        $avgLecheData[] = round($row['average_leche'], 2);
    }
} else {
    // Handle case when there are no records
    $avgLecheLabels = ['No Data'];
    $avgLecheData = [0];
}

// Fetch monthly revenue from Leche production
$monthlyRevenueQuery = "
    SELECT 
        DATE_FORMAT(vh_leche_fecha, '%Y-%m') AS revenue_month, 
        SUM(vh_leche_peso * vh_leche_precio) AS total_revenue
    FROM 
        vh_leche
    GROUP BY 
        revenue_month
    ORDER BY 
        revenue_month ASC
";

$monthlyRevenueResult = $conn->query($monthlyRevenueQuery);

$revenueLabels = [];
$revenueData = [];
$cumulativeRevenueData = [];
$cumulativeTotal = 0;

if ($monthlyRevenueResult && $monthlyRevenueResult->num_rows > 0) {
    while ($row = $monthlyRevenueResult->fetch_assoc()) {
        $revenueLabels[] = $row['revenue_month'];
        $revenueData[] = round($row['total_revenue'], 2);
        
        // Calculate cumulative revenue
        $cumulativeTotal += round($row['total_revenue'], 2);
        $cumulativeRevenueData[] = $cumulativeTotal;
    }
} else {
    $revenueLabels = ['No Data'];
    $revenueData = [0];
    $cumulativeRevenueData = [0];
}

// Fetch monthly average weight data
$monthlyAverageWeightQuery = "
    SELECT 
        DATE_FORMAT(ah_peso_fecha, '%Y-%m') AS weight_month, 
        AVG(ah_peso_animal) AS average_weight
    FROM 
        ah_peso
    GROUP BY 
        weight_month
    ORDER BY 
        weight_month ASC
";

$monthlyAverageWeightResult = $conn->query($monthlyAverageWeightQuery);

$weightLabels = [];
$averageWeightData = [];

if ($monthlyAverageWeightResult && $monthlyAverageWeightResult->num_rows > 0) {
    while ($row = $monthlyAverageWeightResult->fetch_assoc()) {
        $weightLabels[] = $row['weight_month'];
        $averageWeightData[] = round($row['average_weight'], 2);
    }
} else {
    $weightLabels = ['No Data'];
    $averageWeightData = [0];
}

// Fetch monthly average revenue data
$monthlyAverageRevenueQuery = "
    SELECT 
        DATE_FORMAT(ah_peso_fecha, '%Y-%m') AS revenue_month, 
        AVG(ah_peso_animal * ah_peso_precio) AS average_revenue
    FROM 
        ah_peso
    GROUP BY 
        revenue_month
    ORDER BY 
        revenue_month ASC
";

$monthlyAverageRevenueResult = $conn->query($monthlyAverageRevenueQuery);

$revenueLabels = [];
$averageRevenueData = [];

if ($monthlyAverageRevenueResult && $monthlyAverageRevenueResult->num_rows > 0) {
    while ($row = $monthlyAverageRevenueResult->fetch_assoc()) {
        $revenueLabels[] = $row['revenue_month'];
        $averageRevenueData[] = round($row['average_revenue'], 2);
    }
} else {
    $revenueLabels = ['No Data'];
    $averageRevenueData = [0];
}

// Peso Promedio Mensual
$monthlyAverages = [];

// SQL query to calculate the average weight per month
$sql = "
    SELECT 
        DATE_FORMAT(vh_peso_fecha, '%Y-%m') AS peso_month, 
        AVG(vh_peso_animal) AS average_weight 
    FROM 
        vh_peso 
    GROUP BY 
        peso_month 
    ORDER BY 
        peso_month ASC
";

// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $monthlyAverages[$row['peso_month']] = $row['average_weight'];
    }
}

// Calculate month-by-month average change
$averageChanges = [];
$previousMonth = null;
$previousAverage = null;

foreach ($monthlyAverages as $month => $average) {
    if ($previousMonth !== null) {
        // Calculate the change from the previous month
        $change = $average - $previousAverage;
        $averageChanges[$previousMonth . ' to ' . $month] = $change;
    }
    // Update previous values
    $previousMonth = $month;
    $previousAverage = $average;
}

// Initialize the average monthly weight variable
$averageMonthlyWeight = 0;

// Calculate the total change and count of entries
$totalChange = 0;
$countChanges = count($averageChanges);

foreach ($averageChanges as $change) {
    $totalChange += $change; // Accumulate total change
}

// Calculate the average if there are changes
if ($countChanges > 0) {
    $averageMonthlyWeight = $totalChange / $countChanges;
} else {
    $averageMonthlyWeight = 0; // Avoid division by zero
}

// Now you can use $averageMonthlyWeight as needed

// Initialize the total costo concentrado variable
$total_costo_concentrado = 0;

// Get today's date
$currentDate = date('Y-m-d');

// SQL query to calculate total costo concentrado
$sql = "
    SELECT 
        SUM(vh_concentrado_racion * vh_concentrado_costo * DATEDIFF('$currentDate', vh_concentrado_fecha)) AS total_costo
    FROM 
        vh_concentrado
";

// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_costo_concentrado = $row['total_costo'] ?? 0; // Use null coalescing to avoid undefined index
}

// Now you can use $total_costo_concentrado as needed

// Initialize the total market value variable
$totalMarketValue = 0;

// SQL query to calculate the market value of all animals
$sql = "
    SELECT 
        p.vh_peso_tagid,
        p.vh_peso_animal,
        p.vh_peso_precio
    FROM 
        vh_peso p
    INNER JOIN (
        SELECT 
            vh_peso_tagid, 
            MAX(vh_peso_fecha) AS max_date
        FROM 
            vh_peso
        GROUP BY 
            vh_peso_tagid
    ) AS latest ON p.vh_peso_tagid = latest.vh_peso_tagid AND p.vh_peso_fecha = latest.max_date
";

// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate the market value for each animal
        $marketValue = $row['vh_peso_animal'] * $row['vh_peso_precio'];
        $totalMarketValue += $marketValue; // Accumulate total market value
    }
}

// Now you can use $totalMarketValue as needed
$concentradoImpact = $total_costo_concentrado/$totalMarketValue;

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Indices Produccion</title>
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
        #chart-lactancia,
        #chart-enordeno,
        #chart-aumento-mensual-peso,
        #chart-Carne-Alimento
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
        
</style>
</head>
<body>
<!-- Add back button before the header container -->
<a href="./inventario_vacuno.php" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-leche"></figure>
</div>
<!-- Indices Produccion-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">Indices Produccion Leche</h3>
</div>
<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Producción Promedio de Leche Mensual</h3>
    <canvas id="avgLecheChart" width="600" height="400"></canvas>
</div>
<div style="text-align: center; margin: 20px;">
    <button id="exportAvgLechePdf" class="btn btn-primary">Exportar a PDF</button>
</div>
<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Ingresos Mensuales y Acumulativos por Leche</h3>
    <canvas id="monthlyRevenueChart" width="600" height="400"></canvas>
</div>
<div style="text-align: center; margin: 20px;">
    <button id="exportPdf" class="btn btn-primary">Exportar a PDF</button>
</div>
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">Indices Produccion Leche</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-lactancia"></figure>
      <figure id="chart-enordeno"></figure>
</div>
<!-- Indices Alimentacion-->
<div class="container" style="margin-top: 40px;width:90%;">
  <h3 class="section-title">Indices Produccion Carne</h3>
</div>
<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Peso Vacuno Promedio</h3>
    <canvas id="monthlyAverageWeightChart" width="600" height="400"></canvas>
</div>

<div style="text-align: center; margin: 20px;">
    <button id="exportAvgWeightPdf" class="btn btn-primary">Exportar a PDF (Promedio Mensual de Peso)</button>
</div>

<div style="max-width: 1300px; margin: 40px auto;">
    <h3 style="text-align: center;">Ingreso Promedio Mensual</h3>
    <canvas id="monthlyAverageRevenueChart" width="600" height="400"></canvas>
</div>

<div style="text-align: center; margin: 20px;">
    <button id="exportAvgRevenuePdf" class="btn btn-primary">Exportar a PDF (Promedio Mensual de Ingresos)</button>
</div>
<!-- Indices Produccion Carne-->
<div class="container" style="margin-top: 20px;width:90%;">
  <h3 class="section-title">Indices Produccion Carne</h3>
</div>
<div class="container d-flex justify-content-center flex-wrap">      
      <figure id="chart-aumento-mensual-peso"></figure>
      <figure id="chart-Carne-Alimento"></figure>
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

<!-- Average Leche Chart -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctxAvgLeche = document.getElementById('avgLecheChart').getContext('2d');
        var avgLecheChart = new Chart(ctxAvgLeche, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($avgLecheLabels); ?>,
                datasets: [{
                    label: 'Promedio Produccion Leche ',
                    data: <?php echo json_encode($avgLecheData); ?>,
                    borderColor: '#FF6384',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Producción Promedio de Leche Mensual'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Mes (Año-Mes)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Promedio Produccion Leche'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<!-- Monthly Huevo revenue Chart -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctxMonthlyRevenue = document.getElementById('monthlyRevenueChart').getContext('2d');
        var monthlyRevenueChart = new Chart(ctxMonthlyRevenue, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($revenueLabels); ?>,
                datasets: [{
                    label: 'Ingresos Totales (USD)',
                    data: <?php echo json_encode($revenueData); ?>,
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    fill: true,
                    tension: 0.1
                },
                {
                    label: 'Ingresos Cumulativos (USD)',
                    data: <?php echo json_encode($cumulativeRevenueData); ?>,
                    borderColor: '#FF6384',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': $' + context.parsed.y;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Ingresos Mensuales y Acumulativos Leche'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Mes (Año-Mes)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Ingresos (USD)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('exportPdf').addEventListener('click', function() {
            // Use html2canvas to capture the chart
            html2canvas(document.getElementById('monthlyRevenueChart')).then(function(canvas) {
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('l', 'pt', 'a4'); // Landscape orientation
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 280; // Adjust width as needed
                const pageHeight = pdf.internal.pageSize.height;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                let heightLeft = imgHeight;

                let position = 10;

                // Add image to PDF and handle page breaks if necessary
                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                // Save the PDF
                pdf.save('monthly_revenue_chart.pdf');
            }).catch(function(error) {
                console.error('Error capturing the chart:', error);
            });
        });
    });
</script>
<!-- Average Leche Chart -->
<script>
    document.getElementById('exportAvgLechePdf').addEventListener('click', function() {
        // Use html2canvas to capture the avgLecheChart
        html2canvas(document.getElementById('avgLecheChart')).then(function(canvas) {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('l', 'pt', 'a4'); // Landscape orientation
            const imgData = canvas.toDataURL('image/png');
            const imgWidth = 280; // Adjust width as needed
            const pageHeight = pdf.internal.pageSize.height;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;

            let position = 10;

            // Add image to PDF and handle page breaks if necessary
            pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            // Save the PDF
            pdf.save('avg_leche_chart.pdf');
        }).catch(function(error) {
            console.error('Error capturing the chart:', error);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctxMonthlyAverageWeight = document.getElementById('monthlyAverageWeightChart').getContext('2d');
        var monthlyAverageWeightChart = new Chart(ctxMonthlyAverageWeight, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($weightLabels); ?>,
                datasets: [{
                    label: 'Promedio de Peso (Kg)',
                    data: <?php echo json_encode($averageWeightData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' Kg';
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Todas las Aves'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Mes (Año-Mes)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Promedio de Peso (Kg)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<script>
    document.getElementById('exportAvgWeightPdf').addEventListener('click', function() {
        // Use html2canvas to capture the monthlyAverageWeightChart
        html2canvas(document.getElementById('monthlyAverageWeightChart')).then(function(canvas) {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('l', 'pt', 'a4'); // Landscape orientation
            const imgData = canvas.toDataURL('image/png');
            const imgWidth = 280; // Adjust width as needed
            const pageHeight = pdf.internal.pageSize.height;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;

            let position = 10;

            // Add image to PDF and handle page breaks if necessary
            pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            // Save the PDF
            pdf.save('promedio_mensual_peso_chart.pdf');
        }).catch(function(error) {
            console.error('Error capturing the chart:', error);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctxMonthlyAverageRevenue = document.getElementById('monthlyAverageRevenueChart').getContext('2d');
        var monthlyAverageRevenueChart = new Chart(ctxMonthlyAverageRevenue, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($revenueLabels); ?>,
                datasets: [{
                    label: 'Promedio de Ingresos (USD)',
                    data: <?php echo json_encode($averageRevenueData); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': $' + context.parsed.y;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Peso de todas las Aves'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Mes (Año-Mes)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Promedio de Ingresos (USD)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        // Export to PDF functionality
        document.getElementById('exportAvgRevenuePdf').addEventListener('click', function() {
            html2canvas(document.getElementById('monthlyAverageRevenueChart')).then(function(canvas) {
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('l', 'pt', 'a4'); // Landscape orientation
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 800; // Adjust width as needed
                const pageHeight = pdf.internal.pageSize.height;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                let heightLeft = imgHeight;

                let position = 10;

                // Add image to PDF and handle page breaks if necessary
                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                // Save the PDF
                pdf.save('promedio_mensual_ingresos_chart.pdf');
            }).catch(function(error) {
                console.error('Error capturing the chart:', error);
            });
        });
    });
</script>
<!-- INDICE: Dias de Lactancia -->
<script>
var dom = document.getElementById('chart-lactancia');
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
      min: 100,
      max: 200,
      splitNumber: 8,
      itemStyle: {
        color: '#215429',
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
        height: 40,
        borderRadius: 8,
        offsetCenter: [0, '35%'],
        valueAnimation: true,
        formatter: function (value) {
          return '{value|' + value.toFixed(0) + '}{unit|Dias Lactancia}';
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
          value: <?php echo number_format($averageLactancyDays, 2); ?>
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
<!-- INDICE: Vacas en Ordeño -->
<script>
var dom = document.getElementById('chart-enordeno');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Vacas en Ordeño",    
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
            [0.6, '#52d165'],
            [0.8, '#358741'],
            [0.9, '#215429'],
            [1, '#215429']
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
          value: <?php echo number_format($vacasEnOrdenoPercentage, 2); ?>
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
<!-- INDICE: Incremento Mensual del Peso -->
<script>
var dom = document.getElementById('chart-aumento-mensual-peso');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Incremento Mensual Peso",    
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
            [0.6, '#52d165'],
            [0.8, '#358741'],
            [0.9, '#215429'],
            [1, '#215429']
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
          value: <?php echo number_format($averageMonthlyWeight, 2); ?>
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
<!-- INDICE: Produccion Carnica Vs Costo del Alimento -->
<script>
var dom = document.getElementById('chart-Carne-Alimento');
var myChart = echarts.init(dom, null, {
  renderer: 'svg',
  useDirtyRect: false
});
var app = {};
var option;
option = {
  title: {
    text: "Impacto Concentrado Vs Valor en Pie",    
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
      max: 50,
      axisLine: {
        lineStyle: {
          width: 20,
          color: [
            [0.2, '#fd666d'],
            [0.4, '#ffa270'],
            [0.6, '#52d165'],
            [0.8, '#358741'],
            [0.9, '#215429'],
            [1, '#215429']
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
          value: <?php echo number_format($concentradoImpact, 2); ?>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</body>
</html>