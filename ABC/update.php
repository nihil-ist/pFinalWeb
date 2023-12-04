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
                <input class="btn btn-success" type="submit" value="Actualizar">
            </div>
        
    </form>
    </div>
    
    <?php include "footer.php"?>

</body>
</html>