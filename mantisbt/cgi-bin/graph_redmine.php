<?php

include( '../core.php' );

require_api( 'access_api.php' );
require_api( 'authentication_api.php' );
require_api( 'config_api.php' );
require_api( 'constant_inc.php' );
require_api( 'database_api.php' );
require_api( 'gpc_api.php' );
require_api( 'helper_api.php' );
require_api( 'html_api.php' );
require_api( 'lang_api.php' );
require_api( 'print_api.php' );
require_api( 'summary_api.php' );
require_api( 'user_api.php' );
require_api( 'custom_func.php' );


//Устанавливаем отображение сообщений об ошибках
//  ini_set ("display_errors", "1");
//  error_reporting(E_ALL);

$res_ids = $_GET['redmine_id'];
$total = $_GET['total'];

$percent = round($res_ids/$total, 2)*100;

// создание изображения
$width = 500;
$height = 300;

$image = imagecreatetruecolor($width, $height);

// определение цветов
/*
$white    = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($image, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($image, 0x90, 0x00, 0x00);
*/
$red		= imagecolorallocate($image, 0xFF, 0x00, 0x00);
$gray		= imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
$darkgray	= imagecolorallocate($image, 0x90, 0x90, 0x90);
$white		= imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
$black		= imagecolorallocate($image, 0x00, 0x00, 0x00);
$black_text	= imagecolorallocate($image, 0x01, 0x01, 0x01);
$green		= imagecolorallocate($image, 0x33, 0xFF, 0x00);
$blue		= imagecolorallocate($image, 0x33, 0x66, 0xCC);
$yellow		= imagecolorallocate($image, 0xFF, 0xAA, 0x00);
imagecolortransparent($image, $black);

//imagefill($image, 0, 0, $white);
// делаем эффект 3Д
/*
for ($i = 60; $i > 50; $i--) {
   imagefilledarc($image, 50, $i, 100, 50, 0, 45, $darknavy, IMG_ARC_PIE);
   imagefilledarc($image, 50, $i, 100, 50, 45, 75 , $darkgray, IMG_ARC_PIE);
   imagefilledarc($image, 50, $i, 100, 50, 75, 360 , $darkred, IMG_ARC_PIE);
}

imagefilledarc($image, 50, 50, 100, 50, 0, 45, $navy, IMG_ARC_PIE);
imagefilledarc($image, 50, 50, 100, 50, 45, 75 , $gray, IMG_ARC_PIE);
imagefilledarc($image, 50, 50, 100, 50, 75, 360 , $red, IMG_ARC_PIE);
*/

$center_x = (int) $width/2-100;
$center_y = (int) $height/2;

$rad_1 = 230;
$rad_2 = 230;

$ang_start = 0;
$ang_end = 360;

// ImageFilledArc( $image, $center_x, $center_y, $rad_2, $rad_1, $ang_start+round(3.6 * $percent), $ang_end,$green, IMG_ARC_PIE );
//ImageFilledArc( $image, $center_x, $center_y, $rad_2, $rad_1, $ang_start, $ang_start+round(3.6 * $percent),$green, IMG_ARC_PIE );

ImageFilledArc( $image, $center_x, $center_y, $rad_2, $rad_1, $ang_start, $ang_end, $blue, IMG_ARC_PIE );

ImageFilledArc( $image, $center_x, $center_y, $rad_2, $rad_1, $ang_start, $ang_start+round(3.6 * $percent),$green, IMG_ARC_PIE );

$text_x1 = 305; //5
$text_y1 = 45; //5
$text_x2 = 345; //45
$text_y2 = 65; //45

ImageFilledRectangle( $image, $text_x1, $text_y1, $text_x1+35, 60, $green );
imagestring($image, 5, $text_x1+10, $text_y1, $res_ids, $red);
imagestring($image, 5, $text_x2, $text_y1, 'L3', $black_text);

ImageFilledRectangle( $image, $text_x1, $text_y2, $text_x1+35, 80, $blue );
imagestring($image, 5, $text_x1+10, $text_y2, $total-$res_ids, $yellow);
imagestring($image, 5, $text_x2, $text_y2, 'L2', $black_text);

//Сохраняем файл в формате png и выводим его
imagepng($image);

//Чистим использованную память
imagedestroy($image);

?>
