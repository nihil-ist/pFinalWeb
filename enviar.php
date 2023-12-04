<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$name= $_POST["name"];
$email= $_POST["email"];
$msg= $_POST["message"];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'havenrecordsmx@gmail.com';                     //SMTP username
    $mail->Password   = 'nsaw lirr auyg jxyy';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('havenrecordsmx@gmail.com', 'Haven Records');
    $mail->addAddress( $email , $name );     //Add a recipient
    //$mail->addAddress('ellen@example.com'); 

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Confirmation of message received';
    $mail->Body    = "<p>Howdy, $name !</p>
                    <br>
                    <p>We have received confirmation that you have sent us a message to contact us at our <strong></strong> Haven Records store </strong>, a store specialized in the sale of musical products such as vinyls and CD's of your favorite albums and other products. Be patient, listen to your favorite album and we will give you an answer from our team.</p>
                    ";
    $mail->addAttachment('images/logo.png');
    
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}