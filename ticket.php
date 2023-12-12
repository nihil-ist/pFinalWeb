<?php

include "login2.php";


require('fpdf/fpdf.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$fullName = $_POST['fullname'];
$emailAddress = $_POST['eaddress'];
$address = $_POST['address'];
$country = $_POST['country'];
$postalCode = $_POST['pc'];
$phoneNumber = $_POST['tel'];
$paymentMethod = $_POST['payment_method'];

$creditCardNumber = isset($_POST['nombre_apellidos']) ? $_POST['nombre_apellidos'] : '';
$expiringDate = isset($_POST['apellido_p']) ? $_POST['apellido_p'] : '';
$cardHolderName = isset($_POST['apellido_m']) ? $_POST['apellido_m'] : '';
$cvv = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$creditCard = isset($_POST['credit_card']) ? $_POST['credit_card'] : '';

$totalAmount = isset($_POST['total_amountl']) ? floatval($_POST['total_amountl']) : 0;


$taxes = isset($_POST['taxes']) ? floatval($_POST['taxes']) : 0;
$packageCost = isset($_POST['package_cost']) ? floatval($_POST['package_cost']) : 0;
$finalAmount = isset($_POST['final_amount']) ? floatval($_POST['final_amount']) : 0;
$cartItems = isset($_POST['cart_items']) ? json_decode($_POST['cart_items'], true) : array();

$referenceNumber = '';
if ($paymentMethod === 'oxxo') {
    $referenceNumber = generateRandomString(10);
} 

sendEmail($fullName,$emailAddress,$address,$country,$postalCode,$phoneNumber,$paymentMethod,$creditCardNumber,
          $expiringDate,$cardHolderName,$creditCard,$totalAmount,$taxes,$packageCost,$finalAmount,$cartItems,$referenceNumber);

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Helvetica', 'I', 24);

$pdf->Cell(0, 10, 'Purchase Receipt', 0, 1, 'C');
$pdf->Ln(1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '--------------------------------------------------------------------------------------------------------------------------------------', 0, 1);

$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, 'Haven Records', 0, 1, 'C');
$pdf->Cell(0, 10, 'Sierra Pintada 108, Bosques del Prado Sur', 0, 1, 'C');
$pdf->Cell(0, 10, '20130 Aguascalientes, Ags', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '--------------------------------------------------------------------------------------------------------------------------------------', 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Selected Items:', 0, 1);
$pdf->SetFont('Arial', '', 12);

foreach ($cartItems as $item) {
    $productName = $item['name'];
    $quantity = $item['quantity'];
    $productPrice = $item['price'];
    $totalPrice = $item['total'];

    $totaltotal = $productPrice * $quantity;

    $pdf->Cell(0, 10, "{$productName} (Qty: {$quantity}) - $" . number_format($totaltotal, 2), 0, 1);
}

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Customer Details:', 0, 1);
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 10, "Full Name: {$fullName}", 0, 1);
$pdf->Cell(0, 10, "Email Address: {$emailAddress}", 0, 1);
$pdf->Cell(0, 10, "Address: {$address}, {$country}, {$postalCode}", 0, 1);
$pdf->Cell(0, 10, "Phone Number: {$phoneNumber}", 0, 1);

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Payment Details:', 0, 1);
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 10, "Payment Method: {$paymentMethod}", 0, 1);

if ($paymentMethod === 'credit_card') {
    $pdf->Cell(0, 10, "Credit Card: {$creditCard}", 0, 1);
} elseif ($paymentMethod === 'oxxo') {
    $pdf->Cell(0, 10, "Reference Number: {$referenceNumber}", 0, 1);
}

$pdf->Ln(1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '--------------------------------------------------------------------------------------------------------------------------------------', 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Order Summary:', 0, 1);
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 10, "Total Amount: $" . number_format($totalAmount, 2), 0, 1);
// $pdf->Cell(0, 10, "Total Amount: $" . $totalAmount, 0, 1);

$pdf->Cell(0, 10, "Taxes: $" . number_format($taxes, 2), 0, 1);
$pdf->Cell(0, 10, "Shipping Cost: $" . number_format($packageCost, 2), 0, 1);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, "Final Amount: $" . number_format($finalAmount, 2), 0, 1);

// Output the PDF to a file
$pdfFileName = 'shopping_ticket-'.$_SESSION["user"].'.pdf';
$pdf->Output($pdfFileName, 'F');

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function sendEmail($fullName,$emailAddress,$address,$country,$postalCode,$phoneNumber,$paymentMethod,$creditCardNumber,
                   $expiringDate,$cardHolderName,$creditCard,$totalAmount,$taxes,$packageCost,$finalAmount,$cartItems,$referenceNumber){
    $productList="";
    foreach ($cartItems as $item) {
        $productName = $item['name'];
        $quantity = $item['quantity'];
        $productPrice = $item['price'];
        $totalPrice = $item['total'];
        $productList .= "$productName (Quantity: $quantity) - \$$productPrice <br>";
    }
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
        $mail->addAddress( $emailAddress , $fullName );     //Add a recipient
        //$mail->addAddress('ellen@example.com'); 

        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        if($paymentMethod == 'oxxo'){
            $paymentMethod.="<br>Reference number: $referenceNumber";
        }
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Your Purchase Receipt';
        $mail->Body    = "
                        <h1>Purchase receipt</h1>
                        <hr>
                        <em>Haven Records</em>
                        <em>Sierra Pintada 108, Bosques del Prado Sur</em>
                        <em>20130 Aguascalientes, Ags</em>
                        <hr>
                        <strong>Selected items</strong>
                        <p>$productList</p>
                        <strong>Customer details</strong>
                        <p>Full name: $fullName</p>
                        <p>Email address: $emailAddress</p>
                        <p>Address: $address</p>
                        <p>Phone number: $phoneNumber</p>
                        <strong>Payment details</strong>
                        <p>Payment method: $paymentMethod</p>
                        <hr>
                        <strong>Order summary</strong>
                        <p>Total amount: $totalAmount</p>
                        <p>Taxes: $taxes</p>
                        <p>Shipping cost: $packageCost</p>
                        <strong>Final amount: $finalAmount</strong>
                        <br>
                        <br>
                        <em>Thank you for your purchase, $fullName; there you have your receipt, come back soon!</em>
                        <strong> Haven Records </strong>
                        ";
        $mail->addAttachment('images/logo.png');
        
        $mail->send();

    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
$servername = "localhost";
      $username = "id21662341_root";
      $password = "iFz5:=h,V@73u~}";
      $bd = "id21662341_havenrecords";

$conn = new mysqli($servername, $username, $password, $bd);

if ($conn->connect_error) {
  die("Can't connect to the database: " . $conn->connect_error);
}

$sql = "UPDATE usuarios SET pais='$country' WHERE cuenta='".$_SESSION['user']."'";
$result = $conn->query($sql);

foreach ($cartItems as $item) {
    $productName = $item['name'];
    $quantity = $item['quantity'];
    $sql = "SELECT existencias FROM productos WHERE nombreProducto='$productName'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $existenciasNow = $row['existencias'] - $quantity;
    $sql = "UPDATE productos SET existencias=$existenciasNow WHERE nombreProducto='$productName'";
    $result = $conn->query($sql);
}
unset($_SESSION['cart']);

$conn->close();

?>

<!DOCTYPE html>	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Ticket - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <style>
        td, th{
            padding: 10px;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        footer {
            margin-top: auto;
        }
        h1.title{
            font-size: 3em;
        }
        .custom-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23FFF' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">
<!-- NAVEGACION -->
<?php include "navbar.php"?>
<!-- FIN NAVEGACION -->
<div class="bg-dark shadow-lg text-center m-5 p-5" style="opacity: 0.85 !important; margin-top: 6% !important;">
<h1 class="heading mb-5">Shopping Ticket Generated Successfully!</h1>
    <h1 class="mb-5">Your Shopping Ticket has been generated: <a href="<?php echo $pdfFileName; ?>" target="_blank">View Shopping Ticket (PDF)</a></h1>

    <!-- Add download link -->
    <h1>Alternatively, you can download the PDF file: <a class="fs-1" href="<?php echo $pdfFileName; ?>" download>Download Shopping Ticket (PDF)</a></h1>
    
    <h1>Also, we have sent you an email with your ticket</h1>

</div>

<?php include "footer.php"?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>