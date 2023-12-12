<?php
    ob_start();
?>
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
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $host = "localhost";
    $usuario_bd = "id21662341_root";
    $contraseña_bd = "iFz5:=h,V@73u~}";
    $nombre_bd = "id21662341_havenrecords";

    $conexion = new mysqli($host, $usuario_bd, $contraseña_bd, $nombre_bd);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, cuenta, email, preguntaSeguridad, contrasena) VALUES (?, ?, ?, ?, ?)");

    $consulta->bind_param("sssss", $nombre, $cuenta, $email, $pregunta, $hashed_password);
    $resultado = $consulta->execute();

    if ($resultado) {
        header("Location: login.php");
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
<?php
    ob_end_flush();
?>