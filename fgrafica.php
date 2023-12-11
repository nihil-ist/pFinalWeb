<!DOCTYPE html>
<html>
<head>
    <title>Gráficos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
    <h1>Gráfico de los 15 productos con más existencias</h1>
    <canvas id="chartProductos" width="400" height="400"></canvas>

    <h1>Gráfico de cantidad de usuarios por país</h1>
    <canvas id="chartUsuariosPorPais" width="400" height="400"></canvas>

    <h1>Gráfico de cantidad de CDs y Vinilos en la base de datos</h1>
    <canvas id="chartCDsVinilos" width="400" height="400"></canvas>
    </div>

    <?php
    // Tu código PHP para conectarte a la base de datos y realizar las consultas aquí...

    // Datos para la conexión a la base de datos
    $servername = "localhost:3310";
    $username = "root";
    $password = "";
    $dbname = "havenrecords";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para obtener los 15 productos con más existencias
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

    <script>
        var ctxProductos = document.getElementById('chartProductos').getContext('2d');
        var labelsProductosFromPHP = <?php echo $labelsProductos_json; ?>;
        var dataProductosFromPHP = <?php echo $dataProductos_json; ?>;

        var chartProductos = new Chart(ctxProductos, {
            type: 'line',
            data: {
                labels: labelsProductosFromPHP,
                datasets: [{
                    label: 'Existencias',
                    data: dataProductosFromPHP,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
            }
        });

        var ctxUsuariosPorPais = document.getElementById('chartUsuariosPorPais').getContext('2d');
        var labelsUsuariosPorPaisFromPHP = <?php echo $labelsUsuariosPorPais_json; ?>;
        var dataUsuariosPorPaisFromPHP = <?php echo $dataUsuariosPorPais_json; ?>;

        var chartUsuariosPorPais = new Chart(ctxUsuariosPorPais, {
            type: 'pie',
            data: {
                labels: labelsUsuariosPorPaisFromPHP,
                datasets: [{
                    label: 'Cantidad de usuarios por país',
                    data: dataUsuariosPorPaisFromPHP,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(204, 255, 153, 0.5)',
                        'rgba(255, 153, 255, 0.5)', 
                        'rgba(255, 204, 153, 0.5)', 
                        'rgba(179, 226, 240, 0.5)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
            }
        });

        var ctxCDsVinilos = document.getElementById('chartCDsVinilos').getContext('2d');
        var labelsCDsVinilosFromPHP = <?php echo $labelsCDsVinilos_json; ?>;
        var dataCDsVinilosFromPHP = <?php echo $dataCDsVinilos_json; ?>;

        var chartCDsVinilos = new Chart(ctxCDsVinilos, {
            type: 'pie',
            data: {
                labels: labelsCDsVinilosFromPHP,
                datasets: [{
                    label: 'Cantidad de CDs y Vinilos',
                    data: dataCDsVinilosFromPHP,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
            }
        });
    </script>
</body>
</html>
