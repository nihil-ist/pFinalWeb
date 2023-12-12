<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="shadow m-5 p-5 maincontainer">
    <div class="form">
        <form action="ticket.php" method="post" target="_blank" enctype="multipart/form-data" id="checkoutForm">
            <p id="titulo_form" class="pt-0 pb-5">Checkout</p>

            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
            <br><br>

            <label for="eaddress">Email Address:</label>
            <input type="text" id="eaddress" name="eaddress" required>
            <br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            <br><br>

            <label for="country">Country:</label>
                <select id="country" name="country" required>
                    <option value="" disabled selected>Select a country</option>
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
            <br><br>

            <label for="pc">Postal Code:</label>
            <input type="text" id="pc" name="pc" required>
            <br><br>

            <label for="tel">Phone Number:</label>
            <input type="tel" id="tel" name="tel" required>
            <br><br>

            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method">
                <option value="credit_card">Credit Card</option>
                <option value="oxxo">Oxxo</option>
            </select>
            <br><br>

            <div id="credit_card_fields">
            <label class="preg" for="nombre_apellidos">Card Number: </label>
            <input type="text" id="nombre" name="nombre_apellidos" maxlength="19" oninput="formatCardNumber(this)" required>
            <br><br>

            <script>
            function formatCardNumber(input) {
                var cardNumber = input.value.replace(/\D/g, '');

                if (cardNumber.length > 0) {
                    cardNumber = cardNumber.match(new RegExp('.{1,4}', 'g')).join('-');
                }

                input.value = cardNumber;
            }
            </script>

            <label class="preg" for="apellido_">Expiring Date:</label>
            <input type="month" id="apellido_p" name="apellido_p" required>
            <br><br>

            <label class="preg" for="apellido_m">Name:</label>
            <input type="text" id="apellido_m" name="apellido_m" required>
            <br><br>

            <label class="preg" for="telefono">CVV: </label>
            <input type="text" id="telefono" name="telefono" maxlength="3" oninput="validateCVV(this)" required>
            <br><br>

            <script>
            function validateCVV(input) {
                var cvv = input.value.replace(/\D/g, '');

                if (cvv.length > 3) {
                    cvv = cvv.slice(0, 3);
                }

                input.value = cvv;
            }
            </script>

            <label class="preg" for="credit_card">Credit Card: </label>
            <br><br>
            <input type="radio" id="credit_card" name="credit_card" value="BBVA" checked>
            <label for="credit_card">BBVA</label>
            <input type="radio" id="credit_card" name="credit_card" value="Nu">
            <label for="credit_card">Nu</label>
            <input type="radio" id="credit_card" name="credit_card" value="Santander">
            <label for="credit_card">Santander</label>
            <br>
            </div>

            <div id="oxxo_fields" style="display: none;">
                <label for="oxxo_reference">Make sure that your current country has an Oxxo available.</label>
            </div>
            <br>

            <label for="coupon_code">Coupon Code:</label>
                <input type="text" id="coupon_code" name="coupon_code">
                <button type="button" onclick="applyCoupon()">Apply Coupon</button>
            <br><br>

            <label for="s">Selected Items:</label>
            <ul>
                <?php
                $cartItems = isset($_POST['cart_items']) ? $_POST['cart_items'] : array();

                foreach ($cartItems as $item) {
                    $productName = $item['name'];
                    $productPrice = $item['price'];
                    $quantity = $item['quantity'];
                    $totalPrice = $item['total'];

                    echo "<li>{$productName} - Quantity: {$quantity} - Price: {$productPrice}</li>";
                }
                echo "<input type='hidden' name='cart_items' value='" . htmlspecialchars(json_encode($cartItems)) . "'>";
                ?>
            </ul>

            <label for="total_amount">Total Amount:</label>
            <?php
                // Retrieve the total amount from the hidden input field
                $totalAmount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0;
                echo '<p id="total_amount"> $' . number_format($totalAmount, 2) . '</p>';
            ?>

            <label for="taxes">Taxes:</label>
            <p id="taxes" name="taxes">0.00</p>

            <label for="package">Shipping:</label>
            <p id="package_cost" name="package_cost">0.00</p>

            <label for="final_amount">Final Amount:</label>
            <p id="final_amount" name="final_amount">0.00</p>

            <input type="hidden" id="coupon_price" name="coupon_price" value="">
            <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $_POST['total_amount'] ?>">
            <input type="hidden" id="taxesl" name="taxes">
            <input type="hidden" id="package_costl" name="package_cost">
            <input type="hidden" id="final_amountl" name="final_amount">

            <div class="boton mt-5 pt-5">
                <button id="submitButton" type="button" onclick="generateAndOpenPDF()">Purchase</button>
            </div>
        </form>
    </div>
    </div>
    
    <script>
        var couponApplied = false;

        function applyCoupon() {
            if (couponApplied) {
                
                return;
            }

            var couponCode = document.getElementById('coupon_code').value;
            var totalAmountElement = document.getElementById('total_amount');
            var totalAmount = parseFloat(totalAmountElement.innerText.replace('$', '').replace(',', ''));

            switch (couponCode) {
                case 'XMAS20':
                    totalAmount *= 0.8; // 20% 
                    break;
                case 'EMAIL10':
                case 'SOCIAL10':
                    totalAmount *= 0.9; // 10% 
                    break;
                default:
                    return;
            }

            totalAmountElement.innerText = '$' + totalAmount.toFixed(2);
            couponApplied = true;

            document.getElementById('coupon_code').disabled = true;

            var countryElement = document.getElementById('country');
            var taxesElement = document.getElementById('taxes');
            var taxRate = countryElement.value === 'Mexico' ? 0.16 : 0.22;
            var taxes = totalAmount * taxRate;
            taxesElement.innerText = '$' + taxes.toFixed(2);
            updateTaxes();
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
            applyCoupon();
            updateTaxes();
            updatePackageCost();
            updateFinalAmount();

            var selectedItems = document.getElementById('checkoutForm').querySelectorAll('[name^="cart_items"]');
            selectedItems.forEach(function(item) {
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = item.name;
                hiddenInput.value = item.value;
                document.getElementById('checkoutForm').appendChild(hiddenInput);
            });

            document.getElementById('coupon_price').value = document.getElementById('coupon_code').value;
            document.getElementById('total_amount').value = document.getElementById('total_amount').innerText;
            document.getElementById('taxes').value = document.getElementById('taxes').innerText;
            document.getElementById('package_cost').value = document.getElementById('package_cost').innerText;
            document.getElementById('final_amount').value = document.getElementById('final_amount').innerText;

            document.getElementById('checkoutForm').submit();

            window.open('path/to/generated/ticket.pdf', '_blank');
        }


    document.getElementById('country').addEventListener('change', updateTaxes);
    document.getElementById('total_amount').addEventListener('change', updatePackageCost);
    document.getElementById('total_amount').addEventListener('change', updateFinalAmount);

    updateTaxes();
    updatePackageCost();
    updateFinalAmount();
</script>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>