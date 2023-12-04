<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style/style_contactus.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h2>Contact us</h2>
    <form action="enviar.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="You name.." required>
    <br>
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" placeholder="You email.." required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" placeholder="Write a message.." style="height:150px" required></textarea>

        <input type="submit" value="Enviar">
    </form>
</div>
</body>
</html>
