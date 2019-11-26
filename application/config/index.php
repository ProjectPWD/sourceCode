<?php
use Gregwar\Image\Image;

require 'vendor/autoload.php';

$coba=Image::open('joker-1.pnasdg')->setFallback('error')->zoomCrop(550,550)->save('out.jpg');

if ($coba!="cache/images/f/a/l/l/b/fallback.jpg") {
	echo "SUKSES";
} else {
	print_r($coba);
	echo "GAGAL";
}
?>