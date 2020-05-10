<?php

$image_url = "http://www.yubnub.org/images/yubnub.png";
if (isset($_GET["u"])) {
  $image_url = $_GET["u"];
  if ($image_url == "")
    $image_url = "http://www.yubnub.org/images/yubnub.png";
}

$rotate_angle = 45;
if (isset($_GET["r"])) {
  $rotate_angle = $_GET["r"];
  if ($rotate_angle == "")
    $rotate_angle = 45;
}

//echo "image URL: $image_url<br>";
//echo "rotation angle: $rotate_angle<br>";

$image_type = exif_imagetype($image_url);

$mime_type = image_type_to_mime_type($image_type);

$source_image = so_imagecreate($image_url, $image_type);

if (!$source_image) {
  echo "failed to create image ($image_url)<br>";
  exit;
}

if (!imageistruecolor($source_image)) {
  $w = imagesx($source_image);
  $h = imagesy($source_image);
  $t_im = imagecreatetruecolor($w,$h);
  imagecopy($t_im,$source_image,0,0,0,0,$w,$h);
  $source_image = $t_im;
}

$bgd_color = imagecolorclosest($source_image, 255, 255, 255);

$rotated_image = imagerotate($source_image, $rotate_angle, $bgd_color);

header('Content-type: $mime_type');
so_image($rotated_image, $image_type);

function so_imagecreate($image_url, $type) {
  switch ($type) {
    case IMAGETYPE_PNG:
      $im = imagecreatefrompng($image_url);
      break;
    case IMAGETYPE_GIF:
      $im = imagecreatefromgif($image_url);
      break;
    case IMAGETYPE_JPEG:
      $im = imagecreatefromjpeg($image_url);
      break;
  }
  return $im;
}

function so_image($im, $type) {
  switch ($type) {
    case IMAGETYPE_PNG:
      imagepng($im);
      break;
    case IMAGETYPE_GIF:
      imagegif($im);
      break;
    case IMAGETYPE_JPEG:
      imagejpeg($im);
      break;
  }
}

?>