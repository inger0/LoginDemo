<?php
session_start();
$img   = imagecreatetruecolor(100, 35);
$black = imagecolorallocate($img, 0x00, 0x00, 0x00);
$green = imagecolorallocate($img, 0x00, 0xFF, 0x00);
$white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
imagefill($img, 0, 0, $white);

$code                     = random_str(4);
$_SESSION['verification'] = $code;  //
imagestring($img, 30, 28, 10, $code, $black);

for ($i = 0; $i < 200; $i++) {
    imagesetpixel($img, rand(0, 100), rand(0, 100), $black);
    imagesetpixel($img, rand(0, 100), rand(0, 100), $green);
}

header("content-type: image/png");
imagepng($img);
imagedestroy($img);

/**
 * 生成随机字符串
 * @param $length
 * @return string
 */
function random_str($length)
{
    $arr     = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
    $str     = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $arr_len - 1);
        $str  .= $arr[$rand];
    }
    return $str;
}