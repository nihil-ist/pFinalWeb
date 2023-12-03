<?php
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
    <title>Store - Haven Records</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
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
<body class="bg-dark text-white">

    <h1 id="namePage" class="text-center mt-5">All Products</h1>

    <div class="m-5" id="main-container">
    <?php 
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // Contador para las tarjetas
      $cardCount = 0;
    
      // Imprimir datos de cada fila
      while($row = $result->fetch_assoc()) {
        // Si es la primera tarjeta de la fila
        if ($cardCount % 4 == 0) {
          echo "<div id='card-container' class=\"row mb-5\">";
        }
        
        echo "<div class=\"col-md-3\">";
        echo "<form action='product.php' method='post'><button style='background: none; color: inherit; border: none;' type='submit'>";
        echo "<div class=\"card bg-dark border-0 text-white\" style=\"width: 18rem;\">";
        echo "<img src=\"img/" . $row["imagen"] . ".jpg\" class=\"card-img-top\" alt=\"". $row["nombreProducto"] ."\">";
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
        //echo "<div class=\"text-center\"><a href=\"#\" class=\"btn btn-primary\">Comprar</a></div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<input type='hidden' name='id' value='" . $row["idProducto"] . "'>";
        echo "<input type='hidden' name='page' value='All Products'>";
        echo "<input type='hidden' name='file' value='store.php'>";
        echo "</button></form>";
    
        // Si es la última tarjeta de la fila
        if ($cardCount % 4 == 3) {
          echo "</div>";
        }
    
        $cardCount++;
      }
    
      // Si la última fila no tiene 4 tarjetas
      if ($cardCount % 4 != 0) {
        echo "</div>";
      }
    } else {
      echo "0 resultados";
    }
    $conn->close();
    ?>
    </div>
    

</body>
</html>