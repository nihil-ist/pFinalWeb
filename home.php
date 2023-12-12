<?php

include "login2.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$bandSubmit=0;
if(isset($_POST['submit'])){
    $bandSubmit=1;
    //Load Composer's autoloader

    require 'phpmailer/Exception.php';
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';

    $name= $_POST["name"];
    $email= $_POST["email"];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'havenrecordsmx@gmail.com';                     //SMTP username
        $mail->Password   = 'nsaw lirr auyg jxyy';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('havenrecordsmx@gmail.com', 'Haven Records');
        $mail->addAddress( $email , $name );

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Confirmation of message received';
        $mail->Body    = "<p>Welcome to the club, $name!</p>
                        <p>You may be surprised by this email, but we wanted you to receive a coupon, because we want to welcome you the best way possible!!</p>
                        <p>You can use this coupon on whichever purchase you want and it will be applied to it, it is a pleasure to hear about you joining.</p>
                        <p>We really hope you enjoy the benefits of being a suscriber, enjoy and be happy :)</p>
                        ";
        $mail->addAttachment('images/email_coupon.jpg');
        
        
        $mail->send();

    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    //we are gonna set the suscription attribute to 1 since there is  a suscription for this user
    $servername = "localhost:33066";
    $username = "root";
    $bd = "havenrecords";
    $password = "";
    
    $conn = new mysqli($servername, $username, $password, $bd);
    
    if ($conn->connect_error) {
    die("Can't connect to the database: " . $conn->connect_error);
    }
    $sql = "UPDATE usuarios SET suscripcion=1 WHERE cuenta='$name'";
    $result = $conn->query($sql);
    $conn->close();
  }?>

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
<div class="bg-dark p-5 shadow-lg text-center m-5 mb-0" style="opacity: 0.85 !important; margin-top: 6% !important;">
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
<?php if(isset($_SESSION["user"])){
  $servername = "localhost:33066";
  $username = "root";
  $bd = "havenrecords";
  $password = "";
  
  $conn = new mysqli($servername, $username, $password, $bd);
  
  if ($conn->connect_error) {
    die("Can't connect to the database: " . $conn->connect_error);
  }
  $sql = "SELECT suscripcion FROM usuarios WHERE cuenta='".$_SESSION['user']."'";
  $result = $conn->query($sql);
  
  if ($result->num_rows == 1){ 
    $row = $result->fetch_assoc();
    ?>
  <div class="row mb-0 mx-5 cover" style="background-image: url(images/banner.jpg); background-size: cover;">
    <?php if($row["suscripcion"]==0){?>
      <div class="col-sm-12 text-white h1 text-center" style="display: flex; justify-content:space-around; align-items:center;">
        JOIN OUR CLUB OF SAVIORS
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <input type="submit" class="btn btn-primary fs-2 p-3" value="Subscribe to us" name="submit">
          <input type="hidden" name="name" value="<?php echo $_SESSION["user"] ?>">
          <input type="hidden" name="email" value="<?php echo $_SESSION["uemail"] ?>">
      </form>
      </div>
    <?php }else{?>
      <div class="col-sm-12 text-white h1 text-center">THANKS FOR BEING A LOYAL SUBSCRIBER OF THIS RECORD LABEL</div>
  </div>
<?php }}
  $conn->close();
} ?>
<div class="bg-dark p-5 shadow-lg text-center m-5 mt-0" style="opacity: 0.85 !important;">
  <p class="text-center"><img src="images/xmas_coupon.png" alt=""></p>
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
    <script type="text/javascript">
loginAlert();
</script>        
    <?php $_SESSION["newLogin"] = false;

}}
if($bandSubmit==1){?>
  <script type="text/javascript">
    sorpresa();
  </script>   
<?php } ?> 