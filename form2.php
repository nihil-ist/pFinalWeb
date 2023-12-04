<?php

include "login2.php";

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>

</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">
<?php include "navbar.php"; ?>
<div class="bg-dark shadow-lg text-center m-5 p-5" style="opacity: 0.85 !important; margin-top: 6% !important;">

    <h1 id="namePage" class="text-center mb-5">Contact us</h1>
        <br>
<div class="d-flex justify-content-evenly">
    <form action="enviar.php" method="post">
        <div class="form-outline form-floating mb-4" style="width: 45rem;">
        <input type="email" class="text-white form-control bg-transparent" id="email" name="email" placeholder="name@example.com" required>
<label for="exampleFormControlInput1" class="form-label text-white bg-transparent">Email address</label>
        </div>
        <div class="form-outline form-floating mb-4" style="width: 45rem;">
        <input type="text" class="text-white form-control bg-transparent" id="name" name="name" placeholder="You name" required>
<label for="exampleFormControlInput1" class="form-label text-white bg-transparent">Name</label>
        </div>
        <div class="form-outline form-floating mb-4" style="width: 45rem;">
        <textarea class="text-white form-control bg-transparent" id="message" name="message" rows="3" required></textarea>
<label for="exampleFormControlTextarea1" class="form-label text-white bg-transparent">Message</label>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
</div>
<?php include "footer.php" ?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>