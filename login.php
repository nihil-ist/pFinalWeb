<?php

include "login2.php";

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
</head>
<body class="bg-dark text-white">



<h1 id="namePage" class="text-center mt-5">Log in</h1>

<?php include "navbar.php"; ?>

<form class="m-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<div class="form-outline form-floating mb-4">
    <input type="text" id="form2Example1" name="user" value="<?php if(isset($_COOKIE["user"])){ echo $_COOKIE["user"]; } ?>" class="text-white form-control bg-transparent" placeholder="email">
    <label class="form-label text-white bg-transparent" for="form2Example1">Username</label>
</div>

<div class="form-outline bg-transparent form-floating mb-4">
    <input type="text" id="form2Example2" name="password" value="<?php if(isset($_COOKIE["password"])){ echo $_COOKIE["password"]; } ?>" class="text-white form-control bg-transparent" placeholder="password">
    <label class="form-label text-white bg-transparent" for="form2Example2">Password</label>
</div>

<div class="form-check mb-4">
  <input class="form-check-input" id="remember" name="remember" type="checkbox" />
  <label class="form-check-label" for="remember">
    Remember login
  </label>
</div>

<input type="hidden" name="form_name" value="login">

<div class="text-center">
    <button type="submit"  class="btn btn-primary text-white mb-4">Log in</button>
</div>

<div class="text-center">
    <p>Not a member? <a href="signIn.php" class="text-primary">Register</a></p>
</div>
</form>

<?php include "footer.php" ?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>
