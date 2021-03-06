<?php

$sat = 25;
if ( isset($_GET['sat'] ) ) {
  $sat = intval($_GET['sat']);
}
$c = 125;

$colors = array(
    array('R' => $c + 3*$sat, 'G' => $c - 3*$sat,   'B' => $c - 3*$sat ), // R
    array('R' => $c + 3*$sat, 'G' => $c - $sat,       'B' => $c - 3*$sat ), // Ry
    array('R' => $c + 3*$sat, 'G' => $c + $sat,      'B' => $c - 3*$sat ), // Yr
    array('R' => $c + 3*$sat, 'G' => $c + 3*$sat,  'B' => $c - 3*$sat ), // Y
    array('R' => $c + $sat,     'G' => $c + $sat,      'B' => $c - 3*$sat ), // Yg
    array('R' => $c - $sat,      'G' => $c + $sat,      'B' => $c - 3*$sat ), // Gy
    array('R' => $c - 3*$sat,  'G' => $c + 3*$sat, 'B' => $c - 3*$sat  ), // G
    array('R' => $c - 3*$sat,  'G' => $c + 3*$sat, 'B' => $c - $sat      ), // Gc
    array('R' => $c - 3*$sat,  'G' => $c + 3*$sat, 'B' => $c + $sat     ), // Cg
    array('R' => $c - 3*$sat,  'G' => $c + 3*$sat, 'B' => $c + 3*$sat ), // C
    array('R' => $c - 3*$sat,  'G' => $c + $sat,     'B' => $c + 3*$sat ), // Cb
    array('R' => $c - 3*$sat,  'G' => $c - $sat,      'B' => $c + 3*$sat ), // Bc
    array('R' => $c - 3*$sat,  'G' => $c - 3*$sat, 'B' => $c + 3*$sat ), // B
    array('R' => $c - $sat,      'G' => $c - 3*$sat, 'B' => $c + 3*$sat ), // Bm
    array('R' => $c + $sat,     'G' => $c - 3*$sat, 'B' => $c + 3*$sat ), // Mb
    array('R' => $c + 3*$sat,  'G' => $c - 3*$sat, 'B' => $c + 3*$sat ), // M
    array('R' => $c + 3*$sat,  'G' => $c - 3*$sat, 'B' => $c + $sat     ), // Mr
    array('R' => $c + 3*$sat,  'G' => $c - 3*$sat, 'B' => $c - $sat      ), // Rm
);

$step = 10;
if ( isset($_GET['step'] ) ) {
  $step = intval($_GET['step']);
}
$scale = 20;
if ( isset($_GET['scale'] ) ) {
  $scale = intval($_GET['scale']);
}
$trans = 11;
if ( isset($_GET['trans'] ) ) {
  $trans = intval($_GET['trans']);
}
$colorh = 0;
if ( isset($_GET['colorh'] ) ) {
  $colorh = intval($_GET['colorh']);
}
$colorq = 3;
if ( isset($_GET['colorq'] ) ) {
  $colorq = intval($_GET['colorq']);
}
$colorqn = 6;
if ( isset($_GET['colorqn'] ) ) {
  $colorqn = intval($_GET['colorqn']);
}

$shapes = array( "sq", "para", "rhom" );    
$age = 0;
$shape = "sq";
if ( isset($_GET['shape'] ) ) {
  $shape = $_GET['shape'];
} else if ( isset($_GET['age'] ) ) {
  $shape = $shapes[intval($_GET['age']) % count($shapes)];
}

$uc = array();
for ($i = 0; $i < $colorqn; $i++) {
    $uc[] = $colors[$colorh];
    $colorh += $colorq;
    if ( $colorh >= 18 ) {
        $colorh -= 18;
    }
}

$template_size = intval(2000/$scale)*$scale;
//$multi = 4;
//$scale = $template_size/100*$multi;
$img = imagecreatetruecolor($template_size, $template_size);

$alpha_adj = 1.0;
if ( $shape == "rhom" ) {
    $alpha_adj = 0.7;
}

$alpha = array(4);
$alpha[0] = 120-$trans*3*$alpha_adj;
$alpha[1] = 120-$trans*2*$alpha_adj;
$alpha[2] = 120-$trans*$alpha_adj;
$alpha[3] = 120;

$color = array(6);
for ($i = 0; $i < $colorqn; $i++) {
    $blu = array(4);
    $blu[0] = imagecolorallocatealpha($img, $uc[$i]['R'], $uc[$i]['G'], $uc[$i]['B'], $alpha[0]);
    $blu[1] = imagecolorallocatealpha($img, $uc[$i]['R'], $uc[$i]['G'], $uc[$i]['B'], $alpha[1]);
    $blu[2] = imagecolorallocatealpha($img, $uc[$i]['R'], $uc[$i]['G'], $uc[$i]['B'], $alpha[2]);
    $blu[3] = imagecolorallocatealpha($img, $uc[$i]['R'], $uc[$i]['G'], $uc[$i]['B'], $alpha[3]);
    $color[$i] = $blu;
}

$trans = imagecolorallocatealpha($img,  0, 0, 0, 127);

//imagealphablending($img, false);
//imagesavealpha($img, true);
imagefill($img,100,100,$trans);

switch ($shape) {
    case "rhom": //rhombus
        $end_color_x = array();
        for ($x = -1; $x < $template_size/$scale; $x++) {
            $end_color_y = $color[rand(0,$colorqn-1)][rand(0,3)];
            for ($y = -1; $y < $template_size/$scale; $y++) {
                $poly = array (
                    $x*$scale, $y*$scale + $step,
                    $x*$scale + $step, $y*$scale,
                    $x*$scale + 2*$step, $y*$scale + $step,
                    $x*$scale + $step,  $y*$scale + 2*$step
                );
                if ( $y == -1 || $y == $template_size/$scale - 1 ) {
                    imagefilledpolygon($img, $poly, 4, $end_color_y);
                } else if ( $x == -1 ) {
                    $end_color_x[$y] = $color[rand(0,$colorqn-1)][rand(0,3)];
                    imagefilledpolygon($img, $poly, 4, $end_color_x[$y]);
                } else if ( $x == $template_size/$scale - 1 ) {
                    imagefilledpolygon($img, $poly, 4, $end_color_x[$y]);
                } else {
                    imagefilledpolygon($img, $poly, 4, $color[rand(0,$colorqn-1)][rand(0,3)]);
                }
            }
        }
        break;
    case "para": //parallelogram:
        for ($x = -1; $x < $template_size/$scale; $x++) {
            $end_color = $color[rand(0,$colorqn-1)][rand(0,3)];
            for ($y = -1; $y < $template_size/$scale; $y++) {
                $poly = array (
                    $x*$scale, $y*$scale,
                    $x*$scale + $step, $y*$scale + $step/2,
                    $x*$scale + $step, $y*$scale + 3*$step/2,
                    $x*$scale,  $y*$scale + $step
                );
                if ( $y == -1 || $y == $template_size/$scale - 1 ) {
                    imagefilledpolygon($img, $poly, 4, $end_color);
                } else {
                    imagefilledpolygon($img, $poly, 4, $color[rand(0,$colorqn-1)][rand(0,3)]);
                }
            }
        }
        break;
    default: //square:
        for ($x = -1; $x < $template_size/$scale; $x++) {
            for ($y = -1; $y < $template_size/$scale; $y++) {
                $poly = array (
                    $x*$scale, $y*$scale,
                    $x*$scale + $step, $y*$scale,
                    $x*$scale + $step, $y*$scale + $step,
                    $x*$scale,  $y*$scale + $step
                );
                imagefilledpolygon($img, $poly, 4, $color[rand(0,$colorqn-1)][rand(0,3)]);
            }
        }
        break;
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
