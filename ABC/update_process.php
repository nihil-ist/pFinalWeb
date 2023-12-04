<!DOCTYPE html>	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambios - Haven Records</title>
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
    </style>
</head>
<body class="bg-dark text-white">

<?php include "navbar.php"?>

<div class="content d-flex flex-column justify-content-center align-items-center flex-grow-1">
<?php
    $servidor= 'localhost:33066';
    $cuenta='root';
    $password='';
    $bd= 'havenrecords';

    $conexion =mysqli_connect($servidor,$cuenta,$password,$bd);
    if(mysqli_connect_errno()){die("Error en la conexion");}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nombre_clave_primaria = $_POST['nombreID'];

        $sql = "UPDATE productos SET ";
        foreach ($_POST as $campo => $valor) {
            if ($campo != 'id' && $campo != 'nombreID') {
                $sql .= "$campo = \"$valor\", ";
            }
        }

        $sql = rtrim($sql, ', '); 
        $sql .= " WHERE $nombre_clave_primaria ='$id'";
        if ($conexion->query($sql) === TRUE) {
            echo "<h2 class='text-center m-5'>Registro actualizado con éxito</h2>";
        } else {
            echo "<h2 class='text-center m-5'>Error actualizando registro: " . $conexion->error ."</h2>";
        }
    }

    $conexion->close();
?>

<form action="cambios.php">
    <div class="text-center m-5">
        <input type="submit" value="Realizar otro cambio" class="btn btn-success">
    </div>
</form>
</div>
<?php include "footer.php"?>

</body>
</html>
