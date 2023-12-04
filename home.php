<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card" style="width: 300px;">
        <div class="card-body">
            <h5 class="card-title text-center">Registro</h5>
            <form>
                <div class="row mb-3">
                    <div class="col">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="col">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username">
                    </div>
                    <div class="col">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
