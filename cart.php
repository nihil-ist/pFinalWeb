<?php

include "login2.php";

$servername = "localhost";
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
    <title>My Cart - Haven Records</title>
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

    </style>
</head>
<body class="text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">

  <?php include "navbar.php" ?>

  <div class="shadow-lg container-fluid p-0 cover shadow-lg border-bottom border-5 border-dark" style="background-image: url(assets/kidA.jpg); background-size: cover;">
    <div class="mb-5">
        <h1 id="slogan">&nbsp;My Cart&nbsp;</h1>
    </div>
</div>
    <div class="m-5 p-5 bg-dark shadow-lg" style="opacity: 0.85 !important;" id="main-container">
    <?php 
    if(isset($_SESSION["cart"]))  { if($_SESSION['cart']){
    ?>
    <table class="p-5">
        

    <tr>
        <th class="fs-3 px-5 text-center" colspan="2">Product Details</th>
        <th class="fs-3 px-5 text-center">Quantity</th>
        <th class="fs-3 px-5 text-center">Price</th>
        <th class="fs-3 px-5 text-center">Total</th>
    </tr>
    <?php
    $totalall = 0;
    foreach ($_SESSION['cart'] as $idProducto => $cantidad): ?>
    <?php
    // Obtiene los detalles del producto de tu base de datos
    $consulta = "SELECT * FROM productos WHERE idProducto = ?";
    $sentencia = $conn->prepare($consulta);
    $sentencia->bind_param("i", $idProducto);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $producto = $resultado->fetch_assoc();
    ?>
    <tr>
      <td class="align-middle p-5"><img src="img/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombreProducto']; ?>" width="200"></td>
      <td class="align-middle p-5  w-40 fs-5"><strong class="fs-4"><?php echo $producto['nombreProducto']; ?></strong><br><br><?php echo $producto['descripcion']; ?><br><br>Format: <strong><?php echo $producto['categoria']; ?></strong></td>
      <td class="align-middle p-5 fs-4 text-nowrap">
      <form class="d-inline-block" action="procesarcarrito.php" method="post">
          <input type="hidden" name="id_producto" value="<?php echo $idProducto; ?>">
          <input type="hidden" name="accion" value="disminuir">
          <button class="btn text-white fs-4" type="submit"><i class="fa-solid fa-minus"></i></button>
        </form>
        <?php echo $cantidad; ?>
        <form class="d-inline-block" action="procesarcarrito.php" method="post">
          <input type="hidden" name="id_producto" value="<?php echo $idProducto; ?>">
          <input type="hidden" name="accion" value="aumentar">
          <?php if($producto['existencias']>$cantidad){?>
            <button class="btn text-white fs-4" type="submit"><i class="fa-solid fa-plus"></i></button>
          <?php } else {?>
            <button class="btn text-white border-0 fs-4" type="submit" disabled><i class="fa-solid fa-plus"></i></button>
            <?php } ?>
        </form>
    </td>
      <td class="p-5 align-middle fs-4 text-center">$<?php
        $discount = $producto["descuento"]*0.01;
        $newprice =  $producto["precio"]-($producto["precio"]*$discount);
        echo $newprice ?>
      </td>
      <td class="p-5 align-middle fs-4 text-center">
        $<?php
        $discount = $producto["descuento"]*0.01;
        $newprice =  $producto["precio"]-($producto["precio"]*$discount);
        $totalprice = $newprice*$cantidad;
        $totalall += $totalprice;
        echo $totalprice ?>
      </td>
    </tr>
  <?php endforeach; ?>
  <tr>
    <td class="text-end fs-3 align-middle" colspan="3"></td>
    <td class="text-center fs-3 align-middle">Total:</td>
    <td class="text-center fs-3 align-middle fw-bold">$<?php echo $totalall; ?></td>
  </tr>
</table>

<div class="text-center mt-5">
  <form action="checkout.php" method="post">
  <?php foreach ($_SESSION['cart'] as $idProducto => $cantidad): ?>
          <?php
              $consulta = "SELECT * FROM productos WHERE idProducto = ?";
              $sentencia = $conn->prepare($consulta);
              $sentencia->bind_param("i", $idProducto);
              $sentencia->execute();
              $resultado = $sentencia->get_result();
              $producto = $resultado->fetch_assoc();
          ?>
          <input type="hidden" name="cart_items[<?php echo $idProducto; ?>][id]" value="<?php echo $idProducto; ?>">
          <input type="hidden" name="cart_items[<?php echo $idProducto; ?>][name]" value="<?php echo $producto['nombreProducto']; ?>">
          <input type="hidden" name="cart_items[<?php echo $idProducto; ?>][quantity]" value="<?php echo $cantidad; ?>">
          <input type="hidden" name="cart_items[<?php echo $idProducto; ?>][price]" value="<?php echo $producto['precio']; ?>">
          <input type="hidden" name="cart_items[<?php echo $idProducto; ?>][total]" value="<?php echo $totalprice; ?>">
      <?php endforeach; ?>
      
      <!-- Hidden input field for the total amount -->
      <input type="hidden" name="total_amount" value="<?php echo $totalall; ?>">

      <!-- Submit button -->
      <input type="submit" class="btn btn-primary p-3 py-2 fs-3" value="Go to Checkout">
  </form>
</div>


<?php } else { ?>

  <div class="text-center m-5">
<h1 class="mb-5">Your cart is empty</h1>
<a class="btn btn-primary fs-3" href="store.php">Browse Our Products</a>
</div>
  
<?php } } else {?>
  
<div class="text-center m-5">
<h1 class="mb-5">Your cart is empty</h1>
<a class="btn btn-primary fs-3" href="store.php">Browse Our Products</a>
</div>

<?php }?>
    
    </div>
    
    <?php include "footer.php" ?>
    
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>