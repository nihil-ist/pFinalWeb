<?php
    ob_start();
?>
<?php

include "login2.php";

if(isset($_SESSION["user"])){
    header("Location: home.php");
}

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">

<?php include "navbar.php"; ?>
<div class="bg-dark shadow-lg m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">
<h1 id="namePage" class="text-center mt-5">Sign In</h1>


<form class="m-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<div class="form-outline form-floating mb-4">
    <input type="text" id="form2Example1" name="user" value="<?php if(isset($_COOKIE["user"])){ echo $_COOKIE["user"]; } ?>" class="text-white form-control bg-transparent" placeholder="email" required>
    <label class="form-label text-white bg-transparent" for="form2Example1">Username</label>
</div>

<div class="form-outline bg-transparent form-floating mb-4">
    <input type="password" id="form2Example2" name="password" value="<?php if(isset($_COOKIE["password"])){ echo $_COOKIE["password"]; } ?>" class="text-white form-control bg-transparent" placeholder="password" required>
    <label class="form-label text-white bg-transparent" for="form2Example2">Password</label>
</div>



<div class="d-flex form-outline bg-transparent  mb-4">
    
    <input type="text" id="captcha" name="captcha" class="m-5 ms-0 text-white form-control bg-transparent" placeholder="Enter the text displayed" required>
    <img src="captcha.php" width="300">
</div>

<div class="form-check mb-4">
  <input class="form-check-input" id="remember" name="remember" type="checkbox" />
  <label class="form-check-label" for="remember">
    Remember me
  </label>
</div>

<input type="hidden" name="form_name" value="login">

<div class="text-center mb-4">
    <button type="submit"  class="btn btn-primary text-white mb-4 fs-5">Sign In</button>
</div>

<div class="text-center">
    <h4>Not a member? <a href="signup.php" class="text-primary">Sign Up</a></h4>
</div>
</form>

<?php 
    if($band == 5){
?>
<form id="recoveryForm" method="post" action="recovery.php" style="display: none;">
  <input type="hidden" name="myData" id="myData">
  <input type="hidden" name="form_name" value="access">
</form>

<?php } ?>

</div>

<?php include "footer.php" ?>




<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>
<script>
function recoveryAlert(){
  Swal.fire({
    title: "Your Account Has Been Blocked",
    text: "You have only 3 attempts to sign in",
    icon: "error",
    showCancelButton: true,
    confirmButtonColor: "#6a5acd",
    cancelButtonColor: "#ff6188",
    confirmButtonText: "Go to Recovery Page",
    background: "url(assets/mcatisb.jpg)",
    color: "#fff"
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('myData').value = "<?php echo htmlspecialchars($_POST['user']); ?>";
      document.getElementById('recoveryForm').submit();
    }
  });
}
</script>
<?php if($band == 5){?>
<script type="text/javascript">
  recoveryAlert();
</script>
<?php }
?>

<?php if(isset($incorrectLogin)){ if($incorrectLogin || $band==0){?>
<script type="text/javascript">
  incorrectLogin();
</script>
<?php }}
?>

<?php
    ob_end_flush();
?>