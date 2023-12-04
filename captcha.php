<?php
session_start();

// Cargar la imagen de fondo
$background_image = imagecreatefromjpeg('images/pattern2.jpg');

// Crear una imagen en blanco del mismo tamaño que la imagen de fondo
$image = imagecreatetruecolor(imagesx($background_image), imagesy($background_image));

// Copiar la imagen de fondo en la imagen en blanco
imagecopy($image, $background_image, 0, 0, 0, 0, imagesx($background_image), imagesy($background_image));

// Crear un color blanco para el texto
$text_color = imagecolorallocate($image, 0, 0, 255);

// Generar un texto aleatorio
$random_text = substr(md5(rand()), 0, 5);

// Almacenar el texto en la sesión para su verificación posterior
$_SESSION['captcha'] = $random_text;

// Definir el tamaño de la fuente más grande
$font_size = 25;

// Definir la posición inicial de la primera letra
$x_position = 1;

// Incluir cada letra con una inclinación diferente
for ($i = 0; $i < strlen($random_text); $i++) {
    $angle = rand(-10, 10); // Ángulo único para cada letra
    $char = $random_text[$i];
    $y_position = 45 + rand(-5, 5); // Posición vertical aleatoria para cada letra
    imagettftext($image, $font_size, $angle, $x_position, $y_position, $text_color, 'fonts/arial.ttf', $char);
    $x_position += imagefontwidth($font_size) + 20  ; // Ajustar la posición para la siguiente letra
}

// Distorsionar la imagen
$distortion_amount = 5;
imagefilter($image, IMG_FILTER_SMOOTH, 5);
imagefilter($image, IMG_FILTER_CONTRAST, -20);

// Rotar la imagen en su conjunto
$angle = rand(-10, 10);
$image = imagerotate($image, 0, 0);

// Mostrar la imagen en el navegador
header("Content-type: image/png");
imagepng($image);

// Liberar recursos
imagedestroy($background_image);
imagedestroy($image);
?>
