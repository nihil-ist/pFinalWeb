<?php
$nombre_servidor = "localhost:33066";
$nombre_usuario = "root";
$contraseña = "";
$nombre_base_datos = "havenrecords";

$conn = new mysqli($nombre_servidor, $nombre_usuario, $contraseña, $nombre_base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SHOW TABLES";
$resultado = $conn->query($sql);

$tablas = array();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_row()) {
        if (strpos($fila[0], 'rel_') !== 0) {
            $tablas[] = $fila[0];
        }
    }
}

$insertR = false;
$errorR = false;
$sql_columnas = "SHOW COLUMNS FROM productos";
$resultado_columnas = $conn->query($sql_columnas);

 // Preparar los nombres de las columnas para la inserción
$column_names = [];
    while ($fila = $resultado_columnas->fetch_assoc()) {
        $column_names[] = $fila['Field'];
    }

    // Insertar datos en la tabla seleccionada
    if (isset($_POST['submit'])) {
        $values = [];
        foreach ($column_names as $column) {
            if (isset($_POST[$column])) {
                $values[] = "'" . $conn->real_escape_string($_POST[$column]) . "'";
            } else {
                $values[] = "NULL";
            }
        }

        $sql_insert = "INSERT INTO productos (" . implode(', ', $column_names) . ") VALUES (" . implode(', ', $values) . ")";
        if ($conn->query($sql_insert) === TRUE) {
            $insertR = true;
        } else {
            $errorR = true;
        }
    }


$conn->close();
?>

<!-- INICIO -->

<!DOCTYPE html>	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Altas - Haven Records</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <link href="css/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>    <style>
        td, th{
            padding: 10px;
        }
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
<body class="bg-dark text-white">
<!-- NAVEGACION -->
<?php include "navbar.php"?>
<!-- FIN NAVEGACION -->
<div class="m-5 content d-flex flex-column justify-content-center align-items-center flex-grow-1">
<div class="text-center">
    <h1 class="title mb-5">Altas</h1>
<h2 class="text-center">Selecciona una tabla</h2>
        <div class="mt-4">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table>
            <?php foreach ($column_names as $column): ?>
                <tr>
                <td><label class="form-label" for="<?php echo $column; ?>"><?php echo $column; ?>:</label></td>
                <td><input id="<?php echo $column; ?>" class="form-control bg-dark text-white" type="text" name="<?php echo $column; ?>"><br></td>
                </tr>
            <?php endforeach; ?>
            </table>
            <div class="text-center">
                <input class="mt-3 btn btn-success" type="submit" name="submit" value="Insertar Registro">
            </div>
        </form>
        </div>
        
    <?php
    if($insertR){
        echo "<h2 class='mt-5'>Registro insertado correctamente en la tabla precios</h2>";
    } else if($errorR){
        echo "<h2 class='mt-5'>Error al insertar el registro: " . $conn->error . "</h2>";
    }
    ?>
</div>
<?php include "footer.php"?>

</body>
</html>