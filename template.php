<?php
/*
$template = 0;
if ( isset($_GET['template'] ) ) {
  $template = intval($_GET['template']);
}
if ( isset($_GET['template_size'] ) ) {
  $template_size = intval($_GET['template_size']);
}
$mini = false;
$layer = "no";
if ( isset($_GET['layer'])) {
  $layer = $_GET['layer'];
}
if ($layer == "yes") {
    $mini = true;
}
*/

$template_size = 100;
$multi = 4;
$scale = $template_size/100*$multi;
$img = imagecreatetruecolor(500*$multi, 500*$multi);

$color = array(4);
$blu = array(4);
$blu[0] = imagecolorallocatealpha($img,  50, 50,200, 30);
$blu[1] = imagecolorallocatealpha($img,  50, 50,200, 60);
$blu[2] = imagecolorallocatealpha($img,  50, 50,200, 90);
$blu[3] = imagecolorallocatealpha($img,  50, 50,200, 120);
$color[0] = $blu;
$blu[0] = imagecolorallocatealpha($img,  200, 50,50, 30);
$blu[1] = imagecolorallocatealpha($img,  200, 50,50, 60);
$blu[2] = imagecolorallocatealpha($img,  200, 50,50, 90);
$blu[3] = imagecolorallocatealpha($img,  200, 50,50, 120);
$color[1] = $blu;
$blu[0] = imagecolorallocatealpha($img,  200, 200,50, 30);
$blu[1] = imagecolorallocatealpha($img,  200, 200,50, 60);
$blu[2] = imagecolorallocatealpha($img,  200, 200,50, 90);
$blu[3] = imagecolorallocatealpha($img,  200, 200,50, 120);
$color[2] = $blu;
$blu[0] = imagecolorallocatealpha($img,  50, 200,50, 30);
$blu[1] = imagecolorallocatealpha($img,  50, 200,50, 60);
$blu[2] = imagecolorallocatealpha($img,  50, 200,50, 90);
$blu[3] = imagecolorallocatealpha($img,  50, 200,50, 120);
$color[3] = $blu;
$trans = imagecolorallocatealpha($img,  0, 0, 0, 127);

//imagealphablending($img, false);
//imagesavealpha($img, true);
imagefill($img,100,100,$trans);

$step = 20;
$scale = 30;
for ($x = 0; $x < 2000/$scale; $x++) {
    for ($y = 0; $y < 2000/$scale; $y++) {
        $poly = array (
            $x*$scale, $y*$scale,
            $x*$scale + $step, $y*$scale,
            $x*$scale + $step, $y*$scale + $step,
            $x*$scale,  $y*$scale + $step
        );
        imagefilledpolygon($img, $poly, 4, $color[rand(0,3)][rand(0,3)]);
    }
}

$small_size = 300;
$smallImg = imagecreatetruecolor( $small_size, $small_size );
imagealphablending($smallImg, false);
imagesavealpha($smallImg, true);
imagecopyresampled( $smallImg, $img, 0, 0, 0, 0, $small_size, $small_size, $multi*500, $multi*500 );

header('Content-type: image/png');
imagepng($smallImg);

imagedestroy($img);
imagedestroy($smallImg);
?>
