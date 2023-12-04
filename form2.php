<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>form 2</title>
</head>
<body>

    <p class="fs-2 text-center fw-bold">Contact us</p>
        <br>
<div class="d-flex justify-content-evenly">
    <form action="enviar.php" method="post">
        <div class="mb-3" style="width: 45rem;">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control bg-light-subtle" id="email" name="email" placeholder="name@example.com" required>
        </div>
        <div class="mb-3" style="width: 45rem;">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" class="form-control bg-light-subtle" id="name" name="name" placeholder="You name" required>
        </div>
        <div class="mb-3" style="width: 45rem;">
            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
            <textarea class="form-control bg-light-subtle" id="message" name="message" rows="3" required></textarea>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Send</button>
        </div>
    </form>
</div>

</body>
</html>