<?php

include "login2.php";

?>  
<!DOCTYPE html>	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bajas - Haven Records</title>
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

<?php include "navbar.php"?>
<div class="bg-dark shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">

<div class="content d-flex flex-column justify-content-center align-items-center flex-grow-1">
<?php
    $servidor= 'localhost:33065';
    $cuenta='root';
    $password='';
    $bd= 'havenrecords';

    $rBorrados = false;

    $conexion =mysqli_connect($servidor,$cuenta,$password,$bd);
    if(mysqli_connect_errno()){die("Error en la conexion");}
    else{//la conexion se ha hecho
        if(isset($_POST['submit'])){
            $eliminar = $_POST['cEliminar'];
            $primary = $_POST['idT'];
            foreach ($eliminar as $id) {
                $sql = "DELETE FROM productos WHERE $primary='$id'";
                $conexion->query($sql);
            }
            $rBorrados = true;
        }
        $conexion->close();
    }
?>
<div class="m-5 text-center">
    <h1 class="title mb-5">Delete</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
        $conexion =mysqli_connect($servidor,$cuenta,$password,$bd);
        if(mysqli_connect_errno()){die("Error en la conexion");}
        $sql_data = "SELECT * FROM productos";
        $result_data = $conexion->query($sql_data);
        $bandera = false;
        if ($result_data->num_rows > 0) {
            echo "<table class='shadow-lg table table-striped table-dark' style='text-align:center;'><tr>";
            while ($fieldinfo = $result_data->fetch_field()) {
                if ($bandera === false){
                    echo "<th class='align-middle'>Delete</th>";
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
                        echo "<td class='align-middle'><input class='form-check-input' type='checkbox' name='cEliminar[]' value=$value onchange='checkSubmitButton()'/></td>";
                        $bandera = true;
                    }
                    if (substr($value, -4) === ".jpg" or substr($value, -4) === ".png" or substr($value, -5) === ".jpeg"){
                        echo "<td class='align-middle'> <img src='img/$value' width='100' alt='$value'></td>";
                    }else{
                        echo "<td class='align-middle'>" . $value . "</td>";
                    }                 
                }
                $bandera = false;
                echo "</tr>";
            }
            $sql = "SHOW KEYS FROM productos WHERE Key_name = 'PRIMARY'";
            $resultado = $conexion->query($sql);
            $clave = $resultado->fetch_assoc();
            $nombre_clave_primaria = $clave['Column_name'];
            echo "</table> 
            <input type='hidden' name='idT' value='$nombre_clave_primaria'>
            <div class='text-center'>
                <input type='submit' class='btn btn-success mt-4' name='submit' value='Borrar registros' disabled>
            </div>";
            if($rBorrados){
                ?>
                <h2 class="text-center mt-5">Registros borrados</h2>
                <?php
            }
        }
?>
        </form>
        <script>
            function checkSubmitButton() {
            let checkedCheckboxes = document.querySelectorAll('input[name="cEliminar[]"]:checked');
            document.querySelector('input[name="submit"]').disabled = checkedCheckboxes.length === 0;
            }
        </script>
</div>
</div>
</div>

<?php include "footer.php"?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>