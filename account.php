<?php

include "login2.php";

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(!empty($_SESSION["user"])) echo $_SESSION["user"]." - "; else header("Location: login.php"); ?>Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">

<?php include "navbar.php"; ?>

<div class="bg-dark shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">


<h1 id="namePage" class="text-center m-5">Hello, <?php if(!empty($_SESSION["user"])) echo $_SESSION["user"] ?>!</h1>

<h2>Name: <strong><?php if(!empty($_SESSION["uname"])) echo $_SESSION["uname"] ?></strong></h2>
<h2>Account name: <strong><?php if(!empty($_SESSION["user"])) echo $_SESSION["user"] ?></strong></h2>
<h2>Email: <strong><?php if(!empty($_SESSION["uemail"])) echo $_SESSION["uemail"] ?></strong></h2>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="hidden" name="form_name" value="signout">
    <div class="text-center">
        <input class="btn btn-primary text-white m-5 fs-4" type="submit" name="signout" value="Sign Out">
    </div>
</form>
</div>
<?php include "footer.php" ?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>