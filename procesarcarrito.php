<?php 
session_start();

$accion = $_POST['accion'];
$idProducto = $_POST['id_producto'];

if ($accion == 'aumentar') {
  $_SESSION['cart'][$idProducto]++;
} elseif ($accion == 'disminuir') {
  $_SESSION['cart'][$idProducto]--;
  
  // Si la cantidad es 0, elimina el producto del cart
  if ($_SESSION['cart'][$idProducto] == 0) {
    unset($_SESSION['cart'][$idProducto]);
  }
}

// Redirige de vuelta a la página del carrito
header('Location: cart.php');
?>