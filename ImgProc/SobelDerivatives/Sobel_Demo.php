<?php
namespace CV;

$src = null;
$src_gray = null;
$grad = null;
$window_name = "Sobel Demo - Simple Edge Detector";
$scale = 1;
$delta = 0;
$ddepth = CV_16S;
$imageName = "./lena.jpg"; // by default

$src = imread( $imageName, IMREAD_COLOR ); // Load an image
if( empty($src) ) {
	return -1;
}

GaussianBlur( $src, $src, new Size(3,3), 0, 0, BORDER_DEFAULT );
$src_gray = cvtColor( $src,  COLOR_BGR2GRAY );
$grad_x = null;
$grad_y = null;
$abs_grad_x = null;
$abs_grad_y = null;
// Scharr( $src_gray, $grad_x, $ddepth, 1, 0, $scale, $delta, BORDER_DEFAULT );
Sobel( $src_gray, $grad_x, $ddepth, 1, 0, 3, $scale, $delta, BORDER_DEFAULT );
// Scharr( $src_gray, $grad_y, $ddepth, 0, 1, $scale, $delta, BORDER_DEFAULT );
Sobel( $src_gray, $grad_y, $ddepth, 0, 1, 3, $scale, $delta, BORDER_DEFAULT );
convertScaleAbs( $grad_x, $abs_grad_x );
convertScaleAbs( $grad_y, $abs_grad_y );
addWeighted( $abs_grad_x, 0.5, $abs_grad_y, 0.5, 0, $grad );
imshow( $window_name, $grad );
waitKey(0);
return 0;
