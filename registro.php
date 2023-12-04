<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Registro</title>
    <script>
        function validarContraseña() {
            var contraseña = document.getElementById("password").value;
            var repetirContraseña = document.getElementById("repetir_password").value;

            if (contraseña !== repetirContraseña) {
                alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<h2>Formulario de Registro</h2>

<form action="registroProceso.php" method="post" onsubmit="return validarContraseña()">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label for="cuenta">Cuenta:</label>
    <input type="text" name="cuenta" required><br>

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required><br>

    <label for="pregunta">Pregunta de Seguridad (Coco o Diego):</label>
    <input type="text" name="pregunta" required><br>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" required><br>

    <label for="repetir_password">Repetir Contraseña:</label>
    <input type="password" name="repetir_password" id="repetir_password" required><br>

    <input type="submit" value="Registrarse">
</form>

</body>
</html>
