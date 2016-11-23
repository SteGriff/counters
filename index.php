<?php

require 'DAL.php';
require 'flare.php';

function textMetrics($text, $font, $size){
	$bbox = imagettfbbox ($size, 0, $font, $text);
	$res = array(
		'top' => $bbox[7],
		'bottom' => abs($bbox[5]),
		'left' => $bbox[6],
		'height' => abs($bbox[5] - $bbox[1]),
		'width' => abs($bbox[4] - $bbox[0]),
		'size' => $size
	);
	return $res;
}

function imageFromText($text, $font, $fontSize, $r, $g, $b){
	//Returns image resource
	
	$margin = 10;
	
	$tbox = textMetrics($text, $font, $fontSize);
	$width = $tbox['width'] + (2 * $margin);
	$height = $tbox['height'] + (2 * $margin);
	$top = $tbox['top'];
	
	//Do a load of dumb stuff to make a transparent background
	$im = imagecreatetruecolor($width, $height);
	imagealphablending($im,false);
	$transparent = imagecolorallocatealpha($im, 0,0,0,127);
	imagefilledrectangle($im,0,0,$width,$height,$transparent);
	imagealphablending( $im, true );

	// Color and add the text
	$foreground = imagecolorallocate($im, $r, $g, $b);
	
	imagettftext(
		$im,			//image resource
		$fontSize,		//font size
		0,				//angle
		$margin,		//x
		$margin - $top,	//y
		$foreground,	//fg colour
		$font,			//font file
		$text			//text
	);

	imagealphablending($im, false);
	imagesavealpha($im, true);
	return $im;
}

//Start

if (empty($_GET['debug']))
{
	header('Content-Type: image/png');
}
$im = null;

if(isset($_GET['n'])){
	$name = $_GET['n'];
	$counter = getNamedCounter($name);
	
	$text = $counter->Counter;
	$text = getFlare($text, $counter);
		
	//Private? - don't show image
	if (isset($_GET['p'])){
		$im = imageFromText('');
	}
	else{
		$im = imageFromText($text, $counter->FontFile, $counter->FontSize, $counter->Red, $counter->Green, $counter->Blue);
	}
	
	//Increment?
	if (empty($_GET['review'])){
		$id = $counter->ID;
		trackVisit($id);
	}
}
else{
	$font = !empty($_GET['Font'])
		? $_GET['Font'] : 'fonts/ARIAL.TTF';
	$fontSize = !empty($_GET['FontSize'])
		? $_GET['FontSize'] : 16;
		
	$r = !empty($_GET['R'])
		? $_GET['R'] : 10;
	$g = !empty($_GET['G'])
		? $_GET['G'] : 10;
	$b = !empty($_GET['B'])
		? $_GET['B'] : 10;
	
	$im = imageFromText('1234', $font, $fontSize, $r, $g, $b);
}

imagepng( $im );
imagedestroy($im);
?>