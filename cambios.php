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
    
<?php include "navbar.php"?>
<div class="bg-dark shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">

<div class="content d-flex flex-column justify-content-center align-items-center flex-grow-1">
<div class="m-5">
    <div class="text-center">
        <h1 class="title mb-5">Update</h1>
    </div>
    
    <form action="update.php" method="post">
    <?php
        $servidor= 'localhost:33065';
        $cuenta='root';
        $password='';
        $bd= 'havenrecords';
        $conexion =mysqli_connect($servidor,$cuenta,$password,$bd);
        if(mysqli_connect_errno()){die("Error en la conexion");}
        $sql_data = "SELECT * FROM productos";
        $result_data = $conexion->query($sql_data);
        $bandera = false;
        if ($result_data->num_rows > 0) {
            echo "<table border='1' style='text-align:center;' class='shadow-lg table-hover table table-dark table-striped mt-5'><tr>";
            while ($fieldinfo = $result_data->fetch_field()) {
                if ($bandera === false){
                    echo "<th class='align-middle'>Cambios</th>";
                    $bandera = true;
                }
                echo "<th class='align-middle'>" . $fieldinfo->name . "</th>";
            }
            echo "</tr>";
            $bandera = false;
            while ($row = $result_data->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    if ($bandera === false){
                        echo "<td class='align-middle'><input class='form-check-input' type='radio' name='cEliminar[]' value=$value required/></td>";
                        $bandera = true;
                    }
                    if (substr($value, -4) === ".jpg" or substr($value, -4) === ".png" or substr($value, -5) === ".jpeg"){
                        echo "<td class='align-middle'> <img src='img/$value' width='100' alt='$value'></td>";
                    }else{
                        echo "<td class='align-middle'>" . $value . "</td>";
                    }                              }
                $bandera = false;
                echo "</tr>";
            }
            echo "</table>";
        }   
?>
    <input type="hidden" name="tabla" value="<?php echo $tabla_seleccionada?>">
    <div class="text-center">
        <input type="submit" value="Update Record" class="mt-5 btn btn-success">
    </div>
    </form>
</div>
</div>
</div>

<?php include "footer.php"?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>