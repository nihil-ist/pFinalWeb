<?php

include "login2.php";

?>  
<?php
    $nomImg = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"]) && !(empty($_FILES["imagen"]["tmp_name"]))) {
        $targetDir = "img/";  // Directorio donde se guardarán las imágenes
        $targetFile = $targetDir . basename($_FILES["imagen"]["name"]);
        $nomImg = htmlspecialchars(basename($_FILES["imagen"]["name"]));
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
            }
        }
    }
    $nombre_servidor = "localhost:33065";
    $nombre_usuario = "root";
    $contraseña = "";
    $nombre_base_datos = "havenrecords";

    $conn = new mysqli($nombre_servidor, $nombre_usuario, $contraseña, $nombre_base_datos);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
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
            }
            elseif (isset($_FILES[$column])) {
                $values[] = "'" . $nomImg . "'";
            }
             else {
                $values[] = "NULL";
            }
        }
    
        $sql_insert = "INSERT INTO productos (" . implode(', ', $column_names) . ") VALUES (" . implode(', ', $values) . ")";
        if ($conn->query($sql_insert) === TRUE) {
            $insertR = true;
        } else {
            $errorR = true;
            echo "Error al insertar en la base de datos: " . $conn->error;
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
    <title>Create - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <style>
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
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">
<!-- NAVEGACION -->
<?php include "navbar.php"?>
<!-- FIN NAVEGACION -->
<div class="bg-dark shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">

<div class="m-5 content d-flex flex-column justify-content-center align-items-center flex-grow-1">
<div class="text-center">
    <h1 class="title mb-5">Create</h1>
    <h2 class="text-center mb-5"></h2>
        <div class="mt-4">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label class="form-label" for="idProducto">Product ID:</label></td>
                    <td><input id="idProducto" class="form-control bg-dark text-white" type="number" name="idProducto"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="nombreProducto">Product Name:</label></td>
                    <td><input id="nombreProducto" class="form-control bg-dark text-white" type="text" name="nombreProducto"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="descripcion">Description:</label></td>
                    <td><input id="descripcion" class="form-control bg-dark text-white" type="text" name="descripcion"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="existencias">Stock:</label></td>
                    <td><input id="existencias" class="form-control bg-dark text-white" type="number" name="existencias"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="precio">Price:</label></td>
                    <td><input id="precio" class="form-control bg-dark text-white" type="number" name="precio"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="imagen">Image:</label></td>
                    <td><input id="imagen" class="form-control bg-dark text-white" type="file" name="imagen"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="descuento">Discount:</label></td>
                    <td><input id="descuento" class="form-control bg-dark text-white" type="number" name="descuento"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="categoria">Format:</label></td>
                    <td><select id="categoria" class="form-select bg-dark text-white" name="categoria">
                        <option value="Vinyl">Vinyl</option>
                        <option value="CD">CD</option>
                    </select><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="noCanciones">No. of Songs:</label></td>
                    <td><input id="noCanciones" class="form-control bg-dark text-white" type="number" name="noCanciones"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="artista">Artist:</label></td>
                    <td><input id="artista" class="form-control bg-dark text-white" type="text" name="artista"><br></td>
                </tr>
                <tr>
                    <td><label class="form-label" for="ano">Year:</label></td>
                    <td><input id="ano" class="form-control bg-dark text-white" type="number" name="ano"><br></td>
                </tr>
            </table>
            <div class="text-center">
                <input class="mt-3 btn btn-success" type="submit" name="submit" value="Add Record">
            </div>
        </form>
        </div>
        

</div>
</div>
<?php
    if($insertR){
        echo "<h2 class='mt-5 mb-5'>Record Successfully Added</h2>";
    } else if($errorR){
        echo "<h2 class='mt-5 mb-5'>Error While Adding The Record: " . $conn->error . "</h2>";
    }
    ?>
</div>

<?php include "footer.php"?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>