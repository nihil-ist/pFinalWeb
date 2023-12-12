<?php
    ob_start();
?>

<?php

include "login2.php";

if(!isset($_SESSION['cart'])){
    header("Location: index.php");
}

?>  

<!DOCTYPE html>	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout - Haven Records</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<div class="bg-dark shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">
<div class="m-5 maincontainer">
    <div class="form mx-5">
        <form action="ticket.php" method="post" enctype="multipart/form-data" id="checkoutForm" >
            <h1 id="titulo_form" class="pt-0 pb-5 heading">Checkout</h1>

            <div class="form-outline form-floating mb-3">
                <input type="text" class="text-white form-control bg-transparent" id="fullname" name="fullname" placeholder="full name" required>
                <label for="fullname" class="form-label text-white bg-transparent">Full Name</label>
            </div>
            <div class="form-outline form-floating mb-3">
                <input type="text" class="text-white form-control bg-transparent" id="eaddress" name="eaddress" placeholder="email" required>
                <label for="eaddress" class="form-label text-white bg-transparent">Email Address</label>
            </div>
            <div class="form-outline form-floating mb-3">
                <input type="text" class="text-white form-control bg-transparent" id="address" name="address" placeholder="address" required>
                <label for="address" class="form-label text-white bg-transparent">Address</label>   
            </div>

            <select id="country" class="py-3 form-select bg-dark text-white mb-3 custom-select" name="country" required>
                <option value="" disabled selected>Select a Country</option>
                <option value="USA">United States</option>
                <option value="Canada">Canada</option>
                <option value="Mexico">Mexico</option>
                <option value="UK">United Kingdom</option>
                <option value="Germany">Germany</option>
                <option value="France">France</option>
                <option value="Spain">Spain</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Australia">Australia</option>
            </select>

            <div class="form-outline form-floating mb-3">
                <input type="text" class="text-white form-control bg-transparent" id="pc" name="pc" placeholder="postalcode" required>
                <label for="pc" class="form-label text-white bg-transparent">Postal Code</label>
            </div>

            <div class="form-outline form-floating mb-3">
                <input type="tel" class="text-white form-control bg-transparent" id="tel" name="tel" placeholder="tel" required>
                <label for="tel" class="form-label text-white bg-transparent">Phone Number:</label>
            </div>

            <select id="payment_method" class="py-3 form-select bg-dark text-white mb-3 custom-select" name="payment_method" required>
                <option value="" disabled selected>Select a Payment Method</option>
                <option value="credit_card">Credit Card</option>
                <option value="oxxo">Oxxo</option>
            </select>

            <div id="credit_card_fields">
                <div class="form-outline form-floating mb-3">
                    <input type="text" class="text-white form-control bg-transparent" id="nombre" name="nombre_apellidos" maxlength="19" oninput="formatCardNumber(this)" placeholder="cnumber" required>
                    <label class="preg form-label text-white bg-transparent" for="nombre_apellidos">Card Number</label>
                </div>

            <script>
            function formatCardNumber(input) {
                var cardNumber = input.value.replace(/\D/g, '');

                if (cardNumber.length > 0) {
                    cardNumber = cardNumber.match(new RegExp('.{1,4}', 'g')).join('-');
                }

                input.value = cardNumber;
            }
            </script>

            <div class="form-outline form-floating mb-3">
                <input type="month" class="text-white form-control bg-transparent" id="apellido_p" name="apellido_p" placeholder="expiring" required>
                <label class="preg form-label text-white bg-transparent" for="apellido_">Expiring Date</label>
            </div>

            <div class="form-outline form-floating mb-3">
                <input type="text" class="text-white form-control bg-transparent" id="apellido_m" name="apellido_m" placeholder="name" required>
                <label class="preg form-label text-white bg-transparent" for="apellido_m">Name</label>
            </div>

            <div class="form-outline form-floating mb-3">
                <input type="text" class="text-white form-control bg-transparent" id="telefono" name="telefono" maxlength="3" placeholder="cvv" oninput="validateCVV(this)" required>
                <label class="preg form-label text-white bg-transparent" for="telefono">CVV</label>
            </div>

            <script>
            function validateCVV(input) {
                var cvv = input.value.replace(/\D/g, '');

                if (cvv.length > 3) {
                    cvv = cvv.slice(0, 3);
                }

                input.value = cvv;
            }
            </script>

            <div class="text-center fs-5 d-flex" style="margin: auto;">
                <label class="preg form-check-label" for="credit_card">Credit Card: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                <div>
                    <input class="form-check-input" type="radio" id="credit_card" name="credit_card" value="BBVA" checked>
                    <label class="form-check-label" for="credit_card">BBVA&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" id="credit_card" name="credit_card" value="Nu">
                    <label class="form-check-label" for="credit_card">Nu&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" id="credit_card" name="credit_card" value="Santander">
                    <label class="form-check-label" for="credit_card">Santander&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
            </div>
            <br>
            </div>

            <div id="oxxo_fields" class="my-3 fs-3" style="display: none;">
                <label for="oxxo_reference">Make sure that your current country has an Oxxo available</label>
            </div>
            <br>
            <div class="d-flex align-items-center mb-5">
            <div class="form-outline form-floating flex-grow-1 me-5">
                <input type="text" class="text-white form-control bg-transparent" id="coupon_code" name="coupon_code" placeholder="cupon">
                <label class="form-label text-white bg-transparent" for="coupon_code">Coupon Code</label>
            </div>
            <button type="button" onclick="applyCoupon()" class="btn btn-primary p-3">Apply Coupon</button>
            </div>

            <label for="s" class="fs-2 form-label fw-bold">Selected Items:</label>
            <br>
                <?php
                $cartItems = isset($_POST['cart_items']) ? $_POST['cart_items'] : array();

                foreach ($cartItems as $item) {
                    $productName = $item['name'];
                    $productPrice = $item['price'];
                    $quantity = $item['quantity'];
                    $totalPrice = $item['total'];

                    echo "<h3>{$productName} - Quantity: {$quantity} - Price: {$productPrice}</h3>";
                }
                echo "<input type='hidden' name='cart_items' value='" . htmlspecialchars(json_encode($cartItems)) . "'>";
                ?>

            <label for="total_amount" class="mt-3 fs-2 form-label fw-bold">Total Amount:</label>
            <?php
                // Retrieve the total amount from the hidden input field
                $totalAmount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0;
                echo '<h3 id="total_amount"> $' . number_format($totalAmount, 2) . '</h3>';
            ?>

            <label for="taxes" class="mt-3 fs-2 form-label fw-bold">Taxes:</label>
            <h3 id="taxes" name="taxes">0.00</h3>

            <label for="package" class="mt-3 fs-2 form-label fw-bold">Shipping:</label>
            <h3 id="package_cost" name="package_cost">0.00</h3>

            <label for="final_amount" class="mt-3 fs-2 form-label fw-bold">Final Amount:</label>
            <h3 id="final_amount" name="final_amount">0.00</h3>

            <input type="hidden" id="coupon_price" name="coupon_price" value="">
            <input type="hidden" id="total_amountl" name="total_amountl">
            <input type="hidden" id="taxesl" name="taxes">
            <input type="hidden" id="package_costl" name="package_cost">
            <input type="hidden" id="final_amountl" name="final_amount">

            <div class="boton mt-5 pt-3">
                <button id="submitButton" type="button" onclick="generateAndOpenPDF()" class="btn btn-primary fs-4 px-3">Purchase</button>
            </div>
        </form>
    </div>
    </div>
    
    <script>
        var couponApplied = false;
        function applyCoupon() {
            var couponCode = document.getElementById('coupon_code').value;
            var totalAmountElement = document.getElementById('total_amount');
            var totalAmount = parseFloat(totalAmountElement.innerText.replace('$', '').replace(',', ''));

            switch (couponCode) {
                case 'XMAS20':
                    totalAmount *= 0.8; // 20% 
                    Swal.fire({
                        icon: "success",
                        title: "Coupon Applied!",
                        text: "There will be a discount applied",
                        background: "url(assets/mcatisb.jpg)",
                        color: "#fff"
                    });
                    break;
                case 'EMAIL10':
                    totalAmount *= 0.9; // 10% 
                    Swal.fire({
                        icon: "success",
                        title: "Coupon Applied!",
                        text: "There will be a discount applied",
                        background: "url(assets/mcatisb.jpg)",
                        color: "#fff"
                    });
                    break;
                case 'SOCIAL10':
                    totalAmount *= 0.9; // 10% 
                    Swal.fire({
                        icon: "success",
                        title: "Coupon Applied!",
                        text: "There will be a discount applied",
                        background: "url(assets/mcatisb.jpg)",
                        color: "#fff"
                    });
                    break;
                default:
                    Swal.fire({
                        icon: "error",
                        title: "Whoops!",
                        text: "That coupon code doesn't exist",
                        background: "url(assets/mcatisb.jpg)",
                        color: "#fff"
                    });
                    return;
            }

            couponApplied = true;
            totalAmountElement.innerText = '$' + totalAmount.toFixed(2);

            document.getElementById('coupon_code').disabled = true;

            var countryElement = document.getElementById('country');
            var taxesElement = document.getElementById('taxes');
            var taxRate = countryElement.value === 'Mexico' ? 0.16 : 0.22;
            var taxes = totalAmount * taxRate;
            taxesElement.innerText = '$' + taxes.toFixed(2);
            updateTaxes();
            updateFinalAmount();
        }

        function updateTaxes() {
            var countryElement = document.getElementById('country');
            var taxesElement = document.getElementById('taxes');
            var totalAmountElement = document.getElementById('total_amount');
            var totalAmount = parseFloat(totalAmountElement.innerText.replace('$', '').replace(',', ''));
            var taxRate = countryElement.value === 'Mexico' ? 0.16 : 0.22;
            var taxes = totalAmount * taxRate;
            taxesElement.innerText = '$' + taxes.toFixed(2);
            document.getElementById('taxesl').value = taxes.toFixed(2);
            updatePackageCost();
        }

        function updatePackageCost() {
            var totalAmountElement = document.getElementById('total_amount');
            var packageCostElement = document.getElementById('package_cost');
            var totalAmount = parseFloat(totalAmountElement.innerText.replace('$', '').replace(',', ''));

            var packageCost = totalAmount >= 80 ? 0 : 5;

            packageCostElement.innerText = '$' + packageCost.toFixed(2);
            document.getElementById('package_costl').value = packageCost.toFixed(2);
        }

        function updateFinalAmount() {
            var totalAmountElement = document.getElementById('total_amount');
            var taxesElement = document.getElementById('taxes');
            var packageCostElement = document.getElementById('package_cost');
            var finalAmountElement = document.getElementById('final_amount');

            var totalAmount = parseFloat(totalAmountElement.innerText.replace('$', '').replace(',', ''));
            var taxes = parseFloat(taxesElement.innerText.replace('$', '').replace(',', ''));
            var packageCost = parseFloat(packageCostElement.innerText.replace('$', '').replace(',', ''));

            var finalAmount = totalAmount + taxes + packageCost;
            finalAmountElement.innerText = '$' + finalAmount.toFixed(2);
            document.getElementById('final_amountl').value = finalAmount.toFixed(2);
        }

        function generateAndOpenPDF() {

            var selectedItems = document.getElementById('checkoutForm').querySelectorAll('[name^="cart_items"]');
            selectedItems.forEach(function(item) {
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = item.name;
                hiddenInput.value = item.value;
                document.getElementById('checkoutForm').appendChild(hiddenInput);
            });

            var totalAmountElement = document.getElementById('total_amount');
            var totalAmount = parseFloat(totalAmountElement.innerText.replace('$', '').replace(',', ''));

            document.getElementById('coupon_price').value = document.getElementById('coupon_code').value;
            document.getElementById('taxes').value = document.getElementById('taxesl').innerText;
            document.getElementById('package_cost').value = document.getElementById('package_costl').innerText;
            document.getElementById('final_amount').value = document.getElementById('final_amountl').innerText;
            document.getElementById('total_amountl').value = totalAmount;


            document.getElementById('checkoutForm').submit();
        }


    document.getElementById('country').addEventListener('change', updateTaxes);
    document.getElementById('total_amount').addEventListener('change', updatePackageCost);
    document.getElementById('total_amount').addEventListener('change', updateFinalAmount);

    updateTaxes();
    updatePackageCost();
    updateFinalAmount();
</script>
</div>

<?php include "footer.php"?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>

<?php
    ob_end_flush();
?>