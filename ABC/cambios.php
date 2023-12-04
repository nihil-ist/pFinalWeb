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
        h1.title{
            font-size: 3em;
        }
    </style>
</head>
<body class="bg-dark text-white">
    
<?php include "navbar.php"?>

<div class="content d-flex flex-column justify-content-center align-items-center flex-grow-1">
<div class="m-5">
    <div class="text-center">
        <h1 class="title mb-5">Cambios</h1>
    </div>
    
    <form action="update.php" method="post">
    <?php
        $servidor= 'localhost:33066';
        $cuenta='root';
        $password='';
        $bd= 'havenrecords';
        $conexion =mysqli_connect($servidor,$cuenta,$password,$bd);
        if(mysqli_connect_errno()){die("Error en la conexion");}
        $sql_data = "SELECT * FROM productos";
        $result_data = $conexion->query($sql_data);
        $bandera = false;
        if ($result_data->num_rows > 0) {
            echo "<table border='1' style='text-align:center;' class='shadow-lg table table-dark table-striped mt-5'><tr>";
            while ($fieldinfo = $result_data->fetch_field()) {
                if ($bandera === false){
                    echo "<th>Cambios</th>";
                    $bandera = true;
                }
                echo "<th>" . $fieldinfo->name . "</th>";
            }
            echo "</tr>";
            $bandera = false;
            while ($row = $result_data->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    if ($bandera === false){
                        echo "<td><input class='form-check-input' type='radio' name='cEliminar[]' value=$value required/></td>";
                        $bandera = true;
                    }
                    echo "<td>" . $value . "</td>";
                }
                $bandera = false;
                echo "</tr>";
            }
            echo "</table>";
        }   
?>
    <input type="hidden" name="tabla" value="<?php echo $tabla_seleccionada?>">
    <div class="text-center">
        <input type="submit" value="Modificar Registro" class="mt-5 btn btn-success">
    </div>
    </form>
</div>
</div>
<?php include "footer.php"?>

</body>
</html>