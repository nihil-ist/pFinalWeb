<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de cantidad de CDs y Vinilos en la base de datos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="400"></canvas>

    <?php
    // Tu código PHP para conectarte a la base de datos y realizar la consulta aquí...

    // Datos para la conexión a la base de datos
    $servername = "localhost:33065";
    $username = "root";
    $password = "";
    $dbname = "havenrecords";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para contar la cantidad de CDs y Vinilos
    $sql = "SELECT categoria, COUNT(*) AS cantidad FROM productos WHERE categoria IN ('CD', 'Vinyl') GROUP BY categoria";
    $result = $conn->query($sql);

    $labels = [];
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row["categoria"];
            $data[] = $row["cantidad"];
        }
    }

    // Cerrar conexión a la base de datos
    $conn->close();

    // Convertir los datos a formato JSON para pasarlo a Chart.js
    $labels_json = json_encode($labels);
    $data_json = json_encode($data);
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var labelsFromPHP = <?php echo $labels_json; ?>;
        var dataFromPHP = <?php echo $data_json; ?>;

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labelsFromPHP,
                datasets: [{
                    label: 'Cantidad de CDs y Vinilos',
                    data: dataFromPHP,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)', // Color para CDs
                        'rgba(54, 162, 235, 0.5)' // Color para Vinilos
                        // Puedes añadir más colores aquí si tienes más categorías
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                // Configuraciones adicionales del gráfico
                responsive: false, // Esto evita que el gráfico se ajuste automáticamente
                maintainAspectRatio: false, 
            }
        });
    </script>
</body>
</html>
