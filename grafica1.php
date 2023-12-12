<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de los 15 productos con más existencias</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
        <canvas id="myChart" width="400" height="400"></canvas>
    

    <?php
    // Conexión a la base de datos
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

    // Consulta SQL para obtener los 15 productos con más existencias
    $sql = "SELECT nombreProducto, existencias FROM productos ORDER BY existencias DESC LIMIT 15";
    $result = $conn->query($sql);

    $labels = [];
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row["nombreProducto"];
            $data[] = $row["existencias"];
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
            type: 'line',
            data: {
                labels: labelsFromPHP,
                datasets: [{
                    label: 'Existencias',
                    data: dataFromPHP,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        // ... Puedes añadir más colores si tienes más datos
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Esto evita que el gráfico se ajuste automáticamente
                maintainAspectRatio: false, 
            }
        });
    </script>
</body>
</html>
