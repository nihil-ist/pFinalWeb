<?php

include "login2.php";

if(isset($_SESSION["user"])){
    if($_SESSION["user"]!="admin"){
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

$servername = "localhost:33065";
$username = "root";
$bd = "havenrecords";
$password = "";

$conn = new mysqli($servername, $username, $password, $bd);

if ($conn->connect_error) {
  die("Can't connect to the database: " . $conn->connect_error);
}

?>

<?php

$bsales = false;

$sqlProductos = "SELECT nombreProducto, existencias FROM productos ORDER BY existencias DESC LIMIT 15";
$resultProductos = $conn->query($sqlProductos);

$labelsProductos = [];
$dataProductos = [];

if ($resultProductos->num_rows > 0) {
    while ($row = $resultProductos->fetch_assoc()) {
        $labelsProductos[] = $row["nombreProducto"];
        $dataProductos[] = $row["existencias"];
    }
}

// Consulta SQL para contar la cantidad de usuarios por país
$sqlUsuariosPorPais = "SELECT pais, COUNT(*) AS cantidad FROM usuarios WHERE pais IS NOT NULL GROUP BY pais";
$resultUsuariosPorPais = $conn->query($sqlUsuariosPorPais);

$labelsUsuariosPorPais = [];
$dataUsuariosPorPais = [];

if ($resultUsuariosPorPais->num_rows > 0) {
    while ($row = $resultUsuariosPorPais->fetch_assoc()) {
        $labelsUsuariosPorPais[] = $row["pais"];
        $dataUsuariosPorPais[] = $row["cantidad"];
    }
} else {
    $bsales = true;
}

// Consulta SQL para contar la cantidad de CDs y Vinilos
$sqlCDsVinilos = "SELECT categoria, COUNT(*) AS cantidad FROM productos WHERE categoria IN ('CD', 'Vinyl') GROUP BY categoria";
$resultCDsVinilos = $conn->query($sqlCDsVinilos);

$labelsCDsVinilos = [];
$dataCDsVinilos = [];

if ($resultCDsVinilos->num_rows > 0) {
    while ($row = $resultCDsVinilos->fetch_assoc()) {
        $labelsCDsVinilos[] = $row["categoria"];
        $dataCDsVinilos[] = $row["cantidad"];
    }
}

// Cerrar conexión a la base de datos
$conn->close();

// Convertir los datos a formato JSON para pasarlo a Chart.js
$labelsProductos_json = json_encode($labelsProductos);
$dataProductos_json = json_encode($dataProductos);

$labelsUsuariosPorPais_json = json_encode($labelsUsuariosPorPais);
$dataUsuariosPorPais_json = json_encode($dataUsuariosPorPais);

$labelsCDsVinilos_json = json_encode($labelsCDsVinilos);
$dataCDsVinilos_json = json_encode($dataCDsVinilos);
?>

<!DOCTYPE html>	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stadistics - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;

        }
        footer {
            margin-top: auto;
        }
        h1.title{
            font-size: 3em;
        }
    </style>
</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">
    
<?php include "navbar.php"?>
<div class="bg-dark shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">

<div class="content d-flex flex-column justify-content-center align-items-center flex-grow-1">
<div class="m-5">
    <div class="text-center">
        <h1 class="title mb-5">Update</h1>
    </div>
    <div class="container d-flex flex-column align-items-center">
    <h1 >15 Products With More Stock</h1>
    <canvas class="m-5" id="chartProductos" width="400" height="400"></canvas>

    <h1 class="mt-5">Number of CDs and Vinyl Records in the Database</h1>
    <canvas class="m-5" id="chartCDsVinilos" width="400" height="400"></canvas>

    <h1 class="mt-5">Sales by Country</h1>
    <?php 
    if($bsales){ 
        echo"<h1 class=\"m-5\">There have been no sales yet :(</h1>";
    } else { 
        echo "<canvas class=\"m-5\" id=\"chartUsuariosPorPais\" width=\"400\" height=\"400\"></canvas> ";
    }
    ?>
    </div>

    



    <script>
        var ctxProductos = document.getElementById('chartProductos').getContext('2d');
        var labelsProductosFromPHP = <?php echo $labelsProductos_json; ?>;
        var dataProductosFromPHP = <?php echo $dataProductos_json; ?>;

        var chartProductos = new Chart(ctxProductos, {
            type: 'line',
            data: {
                labels: labelsProductosFromPHP,
                datasets: [{
                    label: 'Stock',
                    data: dataProductosFromPHP,
                    backgroundColor: 'rgba(106, 90, 205, 1)',
                    
                    borderWidth: 1
                    
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                color: '#fff',
                scales: {
                    x: {
                    ticks: {
                        color: 'white'
                    }},
                    y: {
                    ticks: {
                        color: 'white' 
                }}
                }
                
            }
        });
        
        <?php if(!$bsales){ ?>
        var ctxUsuariosPorPais = document.getElementById('chartUsuariosPorPais').getContext('2d');
        var labelsUsuariosPorPaisFromPHP = <?php echo $labelsUsuariosPorPais_json; ?>;
        var dataUsuariosPorPaisFromPHP = <?php echo $dataUsuariosPorPais_json; ?>;

        var chartUsuariosPorPais = new Chart(ctxUsuariosPorPais, {
            type: 'pie',
            data: {
                labels: labelsUsuariosPorPaisFromPHP,
                datasets: [{
                    label: 'Sales',
                    data: dataUsuariosPorPaisFromPHP,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(204, 255, 153, 1)',
                        'rgba(255, 153, 255, 1)', 
                        'rgba(255, 204, 153, 1)', 
                        'rgba(179, 226, 240, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                color: '#fff'
            }
        });
        <?php } ?>
        var ctxCDsVinilos = document.getElementById('chartCDsVinilos').getContext('2d');
        var labelsCDsVinilosFromPHP = <?php echo $labelsCDsVinilos_json; ?>;
        var dataCDsVinilosFromPHP = <?php echo $dataCDsVinilos_json; ?>;

        var chartCDsVinilos = new Chart(ctxCDsVinilos, {
            type: 'pie',
            data: {
                labels: labelsCDsVinilosFromPHP,
                datasets: [{
                    label: 'Quantity',
                    data: dataCDsVinilosFromPHP,
                    backgroundColor: [
                        'rgb(106, 90, 205)',
                        'rgb(255, 180, 53)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                color: '#fff'
            }
        });
    </script>
    
</div>
</div>
</div>

<?php include "footer.php"?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>

<body>

</body>
</html>
