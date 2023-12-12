<?php

include "login2.php";

?>  
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
<div class="bg-dark shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">

<?php
    $servidor= 'localhost:33066';
    $cuenta='root';
    $password='';
    $bd= 'havenrecords';

    $conexion =mysqli_connect($servidor,$cuenta,$password,$bd);
    if(mysqli_connect_errno()){die("Error en la conexion");}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtén los datos del formulario
        $id = $_POST['cEliminar'][0];

        $sql = "SHOW KEYS FROM productos WHERE Key_name = 'PRIMARY'";
        $resultado = $conexion->query($sql);
        $clave = $resultado->fetch_assoc();
        $nombre_clave_primaria = $clave['Column_name'];
        
        // Obtén los datos actuales del registro
        $sql = "SELECT * FROM productos WHERE $nombre_clave_primaria ='$id'";
        $resultado = $conexion->query($sql);
        $registro = $resultado->fetch_assoc();

        // Obtén información sobre los campos
        $campos = $resultado->fetch_fields();
    }

    // Cierra la conexión
    $conexion->close();
?>
    <div class="m-5">
    <form action="update_process.php" method="post">
        <?php foreach ($campos as $campo): ?>
            <label class="form-label" for="<?php echo $campo->name; ?>"><?php echo $campo->name; ?>:</label><br>
            <?php 
            if($campo->name == $nombre_clave_primaria){
            ?>
            <input class="form-control bg-dark text-white" type="text" id="<?php echo $campo->name; ?>" name="<?php echo $campo->name; ?>" value="<?php echo $registro[$campo->name]; ?>"><br>
            <?php 
            } else {
            ?>
            <input class="form-control bg-dark text-white" type="text" id="<?php echo $campo->name; ?>" name="<?php echo $campo->name; ?>" value="<?php echo $registro[$campo->name]; ?>"><br>
            <?php } ?>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="nombreID" value="<?php echo $nombre_clave_primaria ?>">
            <?php endforeach; ?>
            <div class="text-center">
                <input class="btn btn-success" type="submit" value="Update">
            </div>
        
    </form>
    </div>
    </div>

    <?php include "footer.php"?>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>