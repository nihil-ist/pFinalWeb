<?php

include "login2.php";

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">
<?php include "navbar.php"; ?>
<div class="bg-dark shadow-lg m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">

<h1 id="namePage" class="text-center mt-5">Sign up</h1>


<form class="m-5" action="registroProceso.php" method="post" onsubmit="return validarContraseña()">
    <div class="form-outline form-floating mb-4">
        <input type="text" id="nombre" name="nombre" class="text-white form-control bg-transparent" placeholder="nombre" required>
        <label for="nombre" class="form-label text-white bg-transparent">Name</label>
    </div>
    <div class="form-outline form-floating mb-4">
        <input type="text" id="cuenta" name="cuenta" class="text-white form-control bg-transparent" placeholder="cuenta" required>
        <label for="cuenta" class="form-label text-white bg-transparent">Account Name</label>
    </div>
    <div class="form-outline form-floating mb-4">
        <input type="email" id="email" name="email" class="text-white form-control bg-transparent" placeholder="email" required>
        <label for="email" class="form-label text-white bg-transparent">Email</label>
    </div>
    <div class="form-outline form-floating mb-4">
        <input type="text" id="pregunta" name="pregunta" class="text-white form-control bg-transparent" placeholder="pregunta" required>
        <label for="pregunta" class="form-label text-white bg-transparent">What is your favorite artist? (Security Question)</label>
    </div>
    <div class="form-outline form-floating mb-4">
        <input type="password" id="password" name="password" class="text-white form-control bg-transparent" placeholder="password" required>
        <label for="password" class="form-label text-white bg-transparent">Password</label>
    </div>
    <div class="form-outline form-floating mb-4">
        <input type="password" id="repetir_password" name="repetir_password" class="text-white form-control bg-transparent" placeholder="repetir_password" required>
        <label for="repetir_password" class="form-label text-white bg-transparent">Repeat Password</label>
    </div>

    <div class="text-center">
        <input class="btn btn-primary text-white mb-4 fs-5" type="submit" value="Sign Up">
    </div>
</form>

</div>
<?php include "footer.php" ?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>

