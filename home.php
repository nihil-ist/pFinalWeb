<?php

include "login2.php";

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">
    <?php include "navbar.php" ?>

    <main role="main">

<div class="shadow-lg container-fluid p-0 cover shadow-lg border-bottom border-5 border-dark" style="background-image: url(assets/kidA.jpg); background-size: cover;">
    <div class="mb-5">
        <h1 id="title">Haven Records</h1>
    </div>
    <div class="mb-5">
        <h2 id="slogan">&nbsp;Haven? More Like Heaven&nbsp;</h2>
    </div>
</div>

<div class="bg-dark p-5 shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">
<h2 class="heading m-5 mt-0 text-light card-text">Our best <span>Sellers</span></h2>

  <div class="row row-cols-1 row-cols-md-3">
  <div class="col mb-4">
    <div class="card h-100 border-0">
      <img src="img/blue.jpg" class="card-img-top" alt="...">
      <div class="card-body bg-primary text-white">
        <h3 class="card-title fw-bold">BLUE</h3>
        <h5 class="card-text">Blue is the fourth studio album by Canadian singer-songwriter Joni Mitchell, released on June 22, 1971, by Reprise Records..</h5>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 border-0">
      <img src="img/grace.jpg" class="card-img-top" alt="...">
      <div class="card-body bg-primary text-white">
        <h3 class="card-title fw-bold">GRACE</h3>
        <h5 class="card-text">Grace is the only studio album by American singer-songwriter Jeff Buckley, released on August 23, 1994, by Columbia Records</h5>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 border-0">
      <img src="img/petsounds.jpg" class="card-img-top" alt="...">
      <div class="card-body bg-primary text-white">
        <h3 class="card-title fw-bold">PET SOUNDS</h3>
        <h5 class="card-text">Pet Sounds is the eleventh studio album by the American rock band the Beach Boys, released on May 16, 1966 by Capitol Records.</h5>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 border-0">
      <img src="img/burnin.jpg" class="card-img-top" alt="...">
      <div class="card-body bg-primary text-white">
        <h3 class="card-title fw-bold">Burnin'</h3>
        <h5 class="card-text">Burnin' is the sixth album by Jamaican reggae group the Wailers released in October 1973.</h5>
      </div>
    </div>
  </div>
  <div class="col h-100 mb-4">
    <div class="card border-0">
      <img src="img/madvillainy.jpg" class="card-img-top" alt="...">
      <div class="card-body bg-primary text-white">
        <h3 class="card-title fw-bold">MADVILLAINY</h3>
        <h5 class="card-text">Madvillainy is the only studio album by American hip hop duo Madvillain, consisting of British-American rapper MF Doom and American record producer Madlib.</h5>
      </div>
    </div>
  </div>
  <div class="col h-100 mb-4">
    <div class="card border-0">
      <img src="img/abraxas.jpg" class="card-img-top" alt="...">
      <div class="card-body bg-primary text-white">
        <h3 class="card-title fw-bold">ABRAXAS</h3>
        <h5 class="card-text">Abraxas is the second studio album by Latin rock band Santana. It was released on September 23, 1970 by Columbia Records and became the band's first album to reach number one in the United States.</h5>
      </div>
    </div> 
  </div>
</div>
</div>
</main>

<?php include "footer.php"?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>

<?php
if(isset($_SESSION["newLogin"])){
  if($_SESSION["newLogin"]){

    ?>
    <h1>HOLAAAAA</h1>
    <script type="text/javascript">
loginAlert();
</script>        
    <?php $_SESSION["newLogin"] = false;

}}
?>