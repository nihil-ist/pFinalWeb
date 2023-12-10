<?php

include "login2.php";

$servername = "localhost:33066";
$username = "root";
$bd = "havenrecords";
$password = "";

$conn = new mysqli($servername, $username, $password, $bd);

if ($conn->connect_error) {
  die("Can't connect to the database: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST["id"];
    $page = $_POST["page"];
    $file = $_POST["file"];
} else { 
    $id = 1;
    $page = "All Products";
    $file = "store.php";
}

$name;
$description;
$stock;
$price;
$discount;
$category;
$songs;
$artist;
$year;
$image;

$sql = "SELECT * FROM productos WHERE idProducto=$id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $name = $row["nombreProducto"];
        $description = $row["descripcion"];
        $stock = $row["existencias"];
        $price = $row["precio"];
        $image = $row["imagen"];
        $category = $row["categoria"];
        $songs = $row["noCanciones"];
        $artist = $row["artista"];
        $year = $row["ano"];
        $discount = $row["descuento"];
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name ?> - Haven Records</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <style>
        .link:hover{
            text-decoration: underline !important;
        }
    </style>
</head>
<body class="text-white" style="background-image: url('assets/mcatis3.jpg'); background-size: cover;">
    
    <?php include "navbar.php" ?>

    <div class="m-5"id="main-product">

    <a class="text-decoration-none text-white link" href="<?php echo $file ?>"><br><br><br><h3 class="mb-5"><i class="fa-solid fa-chevron-left fa-2xs"></i> Back to <?php echo $page ?></h3></a>

    <div class="card  bg-dark border-5 border-dark text-white mb-3" style="border-width: 20px !important; opacity: 0.85 !important;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="<?php echo "img/".$image ?>" class="zoom img-fluid rounded-2 shadow-lg" width="100%">
            </div>
            <div class="col-md-8">
            <div class="card-body mx-5">
                <h1 class="card-title"><?php echo $name ?></h1>
                <h3 class="card-text mb-4"><span class="fs-4">by </span> <?php echo $artist ?></h3>
                <h4 class="card-text mb-4">Product ID: <strong><?php echo $id ?></strong></h4>
                <h4 class="card-text mb-4">Year: <strong><?php echo $year ?></strong></h4>
                <h4 class="card-text mb-4">No. of Songs: <strong><?php echo $songs ?></strong></h4>
                <h4 class="card-text mb-4 mt-4">Format: <strong><?php echo $category ?></strong></h4>
                <hr>
                <?php if($discount==0){ ?>
                <h1 class="card-text mb-4"><span class="fs-3">Price:</span> <strong>$<?php echo $price ?></strong></h1>
                <?php } else { 
                $newdiscount = $discount*0.01;
                $newprice =  $price-($price*$newdiscount);
                ?>
                <h3>%<?php echo $discount ?> Off</h3>
                <h1 class="card-text mb-4"><span class="fs-3">Price:</span> <span class="text-decoration-line-through">$<?php echo $price ?></span> <strong><span>$<?php echo $newprice ?></span></strong></h1>
                <?php } ?>
                <?php if($stock>0 && $stock<=5){ ?>
                <h3 class="card-text mb-4">Only <strong><?php echo $stock ?></strong> left in stock</h3>
                <?php } else if($stock>0) {?>
                <h3 class="card-text mb-4"><strong><?php echo $stock ?></strong> left in stock</h3>
                <?php } else {?>
                <h3 class="card-text mb-4">Out of stock</h3>
                <?php } ?>
                <hr>
            </div>
            </div>
        </div>
        <p class="card-text m-5 fs-4"><?php echo $description ?></p>

    </div>
    <div style="opacity: 0.90 !important;">
    <a href="#addToCart">
        <!-- <form> -->
        <?php if($stock>0){ ?>
        <input type="submit" value="Add to Cart" class="shadow-lg rounded-5 fs-2 p-3 mt-5 mb-3 btn btn-lg btn-primary btn-fluid w-100">
        <?php } else {?>
        <input type="submit" value="Add to Cart" class="shadow-lg rounded-5 fs-2 p-3 mt-5 mb-3 btn btn-lg btn-primary btn-fluid w-100" disabled>
        <?php } ?>    
         <!-- </form> -->
    </a>
    
    </div>
    
    </div>

    <?php include "footer.php" ?>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>