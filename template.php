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
$step = 20;
if ( isset($_GET['step'] ) ) {
  $step = intval($_GET['step']);
}
$scale = 30;
if ( isset($_GET['scale'] ) ) {
  $scale = intval($_GET['scale']);
}
$trans = 20;
if ( isset($_GET['trans'] ) ) {
  $trans = intval($_GET['trans']);
}

$template_size = intval(2000/$scale)*$scale;
//$multi = 4;
//$scale = $template_size/100*$multi;
$img = imagecreatetruecolor($template_size, $template_size);

$alpha = array(4);
$alpha[0] = 120-$trans*3;
$alpha[1] = 120-$trans*2;
$alpha[2] = 120-$trans;
$alpha[3] = 120;

$color = array(4);
$blu = array(4);
$blu[0] = imagecolorallocatealpha($img,  50, 50,200, $alpha[0]);
$blu[1] = imagecolorallocatealpha($img,  50, 50,200, $alpha[1]);
$blu[2] = imagecolorallocatealpha($img,  50, 50,200, $alpha[2]);
$blu[3] = imagecolorallocatealpha($img,  50, 50,200, $alpha[3]);
$color[0] = $blu;
$blu[0] = imagecolorallocatealpha($img,  200, 50,50, $alpha[0]);
$blu[1] = imagecolorallocatealpha($img,  200, 50,50, $alpha[1]);
$blu[2] = imagecolorallocatealpha($img,  200, 50,50, $alpha[2]);
$blu[3] = imagecolorallocatealpha($img,  200, 50,50, $alpha[3]);
$color[1] = $blu;
$blu[0] = imagecolorallocatealpha($img,  200, 200,50, $alpha[0]);
$blu[1] = imagecolorallocatealpha($img,  200, 200,50, $alpha[1]);
$blu[2] = imagecolorallocatealpha($img,  200, 200,50, $alpha[2]);
$blu[3] = imagecolorallocatealpha($img,  200, 200,50, $alpha[3]);
$color[2] = $blu;
$blu[0] = imagecolorallocatealpha($img,  50, 200,50, $alpha[0]);
$blu[1] = imagecolorallocatealpha($img,  50, 200,50, $alpha[1]);
$blu[2] = imagecolorallocatealpha($img,  50, 200,50, $alpha[2]);
$blu[3] = imagecolorallocatealpha($img,  50, 200,50, $alpha[3]);
$color[3] = $blu;
$trans = imagecolorallocatealpha($img,  0, 0, 0, 127);

//imagealphablending($img, false);
//imagesavealpha($img, true);
imagefill($img,100,100,$trans);

for ($x = -1; $x < $template_size/$scale; $x++) {
    for ($y = -1; $y < $template_size/$scale; $y++) {
        $poly = array (
            $x*$scale, $y*$scale,
            $x*$scale + $step, $y*$scale,
            $x*$scale + $step, $y*$scale + $step,
            $x*$scale,  $y*$scale + $step
        );
        imagefilledpolygon($img, $poly, 4, $color[rand(0,3)][rand(0,3)]);
    }
}

$small_size = 200;
$smallImg = imagecreatetruecolor( $small_size, $small_size );
imagealphablending($smallImg, false);
imagesavealpha($smallImg, true);
imagecopyresampled( $smallImg, $img, 0, 0, 0, 0, $small_size, $small_size, $template_size, $template_size );

header('Content-type: image/png');
imagepng($smallImg);

imagedestroy($img);
imagedestroy($smallImg);
?>
