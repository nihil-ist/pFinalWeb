<?php

// Generamos una imagen con un patrón giratorio
$image = imagecreatetruecolor(200, 100);

// Rellenamos el fondo de la imagen
$color = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $color);

// Generamos el patrón giratorio
$patron = array_fill(0, 100, 1);

// Giramos el patrón
$angle = rand(-90, 90);
imagerotate($image, $angle, 0);

// Almacenamos la respuesta correcta
$respuesta = $patron;

// Guardamos la imagen
imagejpeg($image, 'captcha.jpg');

// Liberamos la memoria
imagedestroy($image);

// Eventos

// Evento de clic en el botón "Girar"
function girar($image) {
  // Obtenemos el ángulo de rotación
  $angle = rand(-90, 90);

  // Giramos la imagen
  imagerotate($image, $angle, 0);

  // Actualizamos la imagen
  echo '<img src="captcha.jpg" alt="Captcha giratorio">';
}

// Inicializamos el evento

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Captcha giratorio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <img src="captcha.jpg" alt="Captcha giratorio">
    <button type="button" id="girar">Girar</button>
  </div>
  <script>
        document.getElementById('girar').onclick = girar;
    </script>
</body>
</html>