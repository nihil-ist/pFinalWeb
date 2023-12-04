<?php

include "login2.php";

$servername = "localhost:33065";
$username = "root";
$bd = "havenrecords";
$password = "";

$conn = new mysqli($servername, $username, $password, $bd);

if ($conn->connect_error) {
  die("Can't connect to the database: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinyl Records - Haven Records</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <style>
        .card {
            transition: background-color 0.2s ease !important;
        }

        .card:hover {
            background-color: rgba(0, 0, 0, 0.15) !important;
        }
        #namePage{
            font-size: 5em;
        }
        #card-container{
            margin: 0 auto;
            /* width: fit-content; */
        }
    </style>
</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">

  <?php include "navbar.php" ?>

  <div class="shadow-lg container-fluid p-0 cover shadow-lg border-bottom border-5 border-dark" style="background-image: url(assets/kidA.jpg); background-size: cover;">
    <div class="mb-5">
        <h1 id="slogan">&nbsp;Vinyl Records&nbsp;</h1>
    </div>
</div>

    <div class="m-5 bg-dark shadow-lg p-5" style="opacity: 0.85 !important;" id="main-container">

    <?php 
    $sql = "SELECT * FROM productos WHERE categoria='Vinyl'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      echo "<div id='card-container' class=\"container\">";
      echo "<div class=\"row justify-content-center\">";
      while($row = $result->fetch_assoc()) {
        echo "<div class=\"col-xxl-3 col-xl-4 col-md-5 text-center mx-auto\">";
        echo "<form action='product.php' method='post'><button style='background: none; color: inherit; border: none;' type='submit'>";
        echo "<div class=\"card zoom mb-5 bg-dark mx-auto border-0 text-white\" style=\"width: 18rem;\">";
        echo "<img src=\"img/" . $row["imagen"] . "\" class=\"shadow-lg card-img-top\" alt=\"". $row["nombreProducto"] ."\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title text-center\">" . $row["nombreProducto"] . "</h5>";
        echo "<p class=\"card-text text-center\">by " . $row["artista"] . "</p>";
        if($row["descuento"]>0){
            $discount = $row["descuento"]*0.01;
            $newprice =  $row["precio"]-($row["precio"]*$discount);
            echo "<p class=\"card-text text-center fs-6\"><span class='text-decoration-line-through'>$" . $row["precio"] . "</span><span class='fw-bold'> $". $newprice ."</span></p>";
        } else{
            echo "<p class=\"card-text text-center fw-bold fs-6\">$" . $row["precio"] . "</p>";
        }
        if($row["existencias"]<=0){
            echo "<p class=\"card-text text-center fs-6\">Out of stock</p>";
        }
        echo "</div>";
        echo "</div>";
        echo "<input type='hidden' name='id' value='" . $row["idProducto"] . "'>";
        echo "<input type='hidden' name='page' value='Vinyl Records'>";
        echo "<input type='hidden' name='file' value='vinyl.php'>";
        echo "</button></form>";
        echo "</div>";

      }
    
      echo "</div>";
      echo "</div>";

    } else {
      echo "0 resultados";
    }
    $conn->close();
    ?>
    </div>
    
    <?php include "footer.php" ?>
    
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>