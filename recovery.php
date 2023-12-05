<?php

include "login2.php";

$servername = "localhost:33065";
$username = "root";
$bd = "havenrecords";
$password = "";

$band = 0;

$conn = new mysqli($servername, $username, $password, $bd);

if ($conn->connect_error) {
  die("Can't connect to the database: " . $conn->connect_error);
}


if(!isset($_SESSION['recover'])){
    header("Location: index.php");
}

if (empty($_SESSION["user"])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_name'] == "recovery") {
        $answer = $_POST["security"];
        $_POST['form_name'] = "";
        unset($_POST['form_name']);

        $sql = "SELECT * FROM usuarios WHERE cuenta = \"".$_SESSION['recover']."\"";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($answer == $row["preguntaSeguridad"]){
                    $band = 1;
                    break;
                }
            }
        }

        if ($band == 1) { 
            $_SESSION["attempts"]=0;
            $_SESSION["recovered"]=1;
        }else{
            $band = 6;
        }


    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_name'] == "changepassword") {
        $password1 = $_POST["newpassword"];
        $password2 = $_POST["repeatpassword"];
        $_POST['form_name'] = "";
        unset($_POST['form_name']);

        if($password1==$password2){
            $newpassword = password_hash($password1, PASSWORD_BCRYPT);
            $sql = "UPDATE usuarios SET bloqueado = 0 WHERE cuenta = \"".$_SESSION['recover']."\"";
            $result = $conn->query($sql);
            $sql = "UPDATE usuarios SET contrasena = '$newpassword' WHERE cuenta = \"".$_SESSION['recover']."\"";
            $result = $conn->query($sql);
            $sql = "UPDATE usuarios SET intentos = 0 WHERE cuenta = \"".$_SESSION['recover']."\"";
            $result = $conn->query($sql);
        }

    }
} 
$conn->close();

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link rel="stylesheet" href="@sweetalert2/theme-dark/dark.css"> -->


</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">

<?php include "navbar.php"; ?>

<div class="bg-dark shadow-lg m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">

<h1 id="namePage" class="text-center mt-5">Account Recovery</h1>
<?php if(!isset($_SESSION["recovered"])){ 
?>

<h2 class="text-center m-5">Answer Correctly the Question to Change Your Password</h2>

<form class="m-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<div class="form-outline form-floating mb-4">
    <input type="text" id="security" name="security" class="text-white form-control bg-transparent" placeholder="recoveryaccount" required>
    <label class="form-label text-white bg-transparent" for="security">What is your favorite artist?</label>
</div>

<input type="hidden" name="form_name" value="recovery">

<div class="text-center">
    <button type="submit"  class="btn btn-primary text-white mb-4">Submit</button>
</div>
</form>
<?php } else {?>
    <h2 class="text-center m-5">Set a New Password</h2>
    <form class="m-5" onsubmit="return validarContrasena2()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
    <div class="form-outline form-floating mb-4">
        <input type="password" id="password" name="newpassword" class="text-white form-control bg-transparent" placeholder="changepassword" required>
        <label class="form-label text-white bg-transparent" for="password">New Password</label>
    </div>
    <div class="form-outline form-floating mb-4">
        <input type="password" id="repetir_password" name="repeatpassword" class="text-white form-control bg-transparent" placeholder="changepassword" required>
        <label class="form-label text-white bg-transparent" for="repetir_password">Repeat Password</label>
    </div>
    <input type="hidden" name="form_name" value="changepassword">

    <div class="text-center">
        <button type="submit"  class="btn btn-primary text-white mb-4">Submit</button>
    </div>
    </form>
<?php } ?>
</div>
<?php include "footer.php" ?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>

<?php
if($band ==6){
    ?>
    <script type="text/javascript">
validarPregunta();
</script>        
    <?php

}
?>