<?php

include "login2.php";

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - Haven Records</title>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/501c828013.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/style_qa.css">
</head>
<body class=" text-white" style="background-image: url('assets/mcatis2.jpg'); background-size: cover;">
<?php include "navbar.php"; ?>
<div class="bg-dark shadow-lg text-center m-5" style="opacity: 0.85 !important; margin-top: 6% !important;">
<fieldset class="container" style="width: 71rem;">
        <br><br>
        <!-- NEW -->
        <div class="card d-flex justify-content-center text-bg-dark" style="height: 20rem;">
            <div class="">
            <img src="images/fondo4.png" class=" card-img" alt="...">
            </div>
            <div class="card-img-overlay">
                <h1 class="card-title text-black fw-bold">Questions and Answers</h1>
                <br>
                <p class="card-text  text-black fs-5 fw-bold text-justify"> Welcome to Haven Records! We're thrilled to provide you with an extensive collection of classic and contemporary vinyl records. As passionate curators of music, we understand that navigating the world of vinyl may raise some questions. To assist you in your vinyl journey and ensure a seamless shopping experience, we've compiled a list of frequently asked questions below. Whether you're new to vinyl or a seasoned collector, these answers aim to address common queries regarding orders, shipping, returns, and more. If you can't find the information you seek, don't hesitate to reach out to our dedicated support team. Let's dive in and explore the world of vinyl together! </p>
            </div>
        </div>
        <div class="mt-5 accordion bg-dark " id="accordionExample" style="width: 71rem;">
            <div class="accordion-item bg-dark">
                <h2 class="accordion-header">
                    <button class="accordion-button text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Do you offer records in physical formats such as vinyl, CD or cassette?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse text-white show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Yes, in our store you can find a variety of formats of your favorite albums so that it is within your reach.
                    </div>
                </div>
            </div>
            <div class="accordion-item ">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How long does it take to process and ship record orders?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        There is no precise delivery time, as it depends on several factors such as the demand of shipments, the distance and the shipping time of the parcel, but we will assure you that delivery is less than 12 working days.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Can international orders be placed and what are the shipping costs?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        At the moment we do not have the possibility to ship abroad, but we are working to make our catalog available to all music lovers in the near future.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Do you have a return or exchange policy in case of defective discs?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    Yes, in order to be entitled to the return policy you must report it to our email havenrecordamx@gmail.com, complying with the following points:
                        <ul>
                            <li>The report must be sent no later than 3 days after receiving the delivery of your products.</li>
                            <li>The return policy will only be respected if the product has damages not caused by the customer.</li>
                            <li>These are the ways to return the purchased product:</li>
                                <ul>
                                    <li>Delivery of the same product purchased (Subject to product availability)</li>
                                    <li>Refund of your money back to your credit card</li>
                                </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Can I order discs that are not currently in your catalog?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    We currently do not handle this sales format, we only sell the discs that are available on our website.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        What is your packaging policy to ensure the safety of the discs during shipment?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        All our products are well packed in a cardboard box with packing padding to avoid the possibility of a defective product in transit.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        ¿Do they provide detailed information on the quality and condition of the records, especially if they are second-hand or vintage?
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    All our products are new and factory sealed. We do not handle the sale of second hand or vintage records.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Is there an order tracking system for customers to track the status of their shipment?
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    Yes, in all orders with our partner DHL courier shipping, when you buy the product gives you a tracking key so you can track your products on their page.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        ¿Are special discounts or promotions offered during specific events or dates of the year?
                    </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    Yes, in our social networks you can find our discounts and promotions on specific dates, for more information follow us on our social networks as Haven Records.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        What express shipping options do you offer for those who want to receive their discs quickly?
                    </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    Currently we only have in our shipping types the standard (regular) shipping.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                        Do you offer gift options or special wrapping for purchased discs?
                    </button>
                </h2>
                <div id="collapseEleven" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Only during the Christmas season, all the products sold are wrapped with a Christmas theme to give the best gift to someone special.
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </fieldset></div>
    <?php include "footer.php" ?>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>