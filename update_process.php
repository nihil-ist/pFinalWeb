<!DOCTYPE html>	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambios - Haven Records</title>
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
    </style>
</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">

<?php include "navbar.php"?>

<div class="bg-dark shadow-lg text-center p-5 m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">
<?php
    $servidor = "localhost";
    $cuenta = "id21662341_root";
    $password = "iFz5:=h,V@73u~}";
    $bd = "id21662341_havenrecords";

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
            echo "<h2 class='text-center m-5'>Record Successfully Updated</h2>";
        } else {
            echo "<h2 class='text-center m-5'>An Error Occurred While Updating the Record: " . $conexion->error ."</h2>";
        }
    }

    $conexion->close();
?>

<form action="cambios.php">
    <div class="text-center m-5">
        <input type="submit" value="Back to Updates" class="btn btn-success">
    </div>
</form>
</div>

<?php include "footer.php"?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>
