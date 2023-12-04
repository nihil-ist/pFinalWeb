<?php
session_start();
$background_image = imagecreatefromjpeg('images/pattern2.jpg');
$image = imagecreatetruecolor(imagesx($background_image), imagesy($background_image));
imagecopy($image, $background_image, 0, 0, 0, 0, imagesx($background_image), imagesy($background_image));
$text_color = imagecolorallocate($image, 0,0,255);//azul

// Generar un texto aleatorio
$random_text = substr(md5(rand()), 0, 5);

// Almacenar el texto en la sesión para su verificación posterior
$_SESSION['captcha'] = $random_text;

$font_size = 25;
$x_position = 1;

// Incluir cada letra con una inclinación diferente
for ($i = 0; $i < strlen($random_text); $i++) {
    $angle = rand(-10, 10); // Ángulo único para cada letra
    $char = $random_text[$i];
    $y_position = 45 + rand(-5, 5); // Posición vertical aleatoria para cada letra
    imagettftext($image, $font_size, $angle, $x_position, $y_position, $text_color, 'fonts/arial.ttf', $char);
    $x_position += imagefontwidth($font_size) + 20; // Ajustar la posición para la siguiente letra
}

imagefilter($image, IMG_FILTER_SMOOTH, 5);
imagefilter($image, IMG_FILTER_CONTRAST, -20);

header("Content-type: image/png");
imagepng($image);

imagedestroy($background_image);
imagedestroy($image);
?>