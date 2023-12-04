<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $cuenta = $_POST["cuenta"];
    $email = $_POST["email"];
    $pregunta = $_POST["pregunta"];
    $password = $_POST["password"];

    // Generar el salt
    $salt = uniqid(mt_rand(), true);

    // El hash a la salt
    $hashed_password = password_hash($password . $salt, PASSWORD_BCRYPT);

    $host = "localhost";
    $usuario_bd = "root";
    $contraseña_bd = "";
    $nombre_bd = "infoo";

    $conexion = new mysqli($host, $usuario_bd, $contraseña_bd, $nombre_bd);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, cuenta, email, pregunta, hashed_password, salt) VALUES (?, ?, ?, ?, ?, ?)");

    $consulta->bind_param("ssssss", $nombre, $cuenta, $email, $pregunta, $hashed_password, $salt);
    $resultado = $consulta->execute();

    if ($resultado) {
        echo "Registro exitoso. ¡Bienvenido, $nombre!";
    } else {
        echo "Error al registrar el usuario: " . $conexion->error;
    }

    $consulta->close();
    $conexion->close();
} else {
    
    header("Location: index.php");
    exit();
}
?>
