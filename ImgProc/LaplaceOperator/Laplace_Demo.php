<?php
namespace CV;

$src = null;
$src_gray = null;
$dst = null;
$kernel_size = 3;
$scale = 1;
$delta = 0;
$ddepth = CV_16S;
$window_name = "Laplace Demo";
$imageName = "./lena.jpg"; // by default

$src = imread( $imageName, IMREAD_COLOR ); // Load an image
if( empty($src) ) {
	return -1;
}
GaussianBlur( $src, $src, new Size(3,3), 0, 0, BORDER_DEFAULT );
$src_gray = cvtColor( $src, COLOR_BGR2GRAY ); // Convert the image to grayscale
$abs_dst = null;
Laplacian( $src_gray, $dst, $ddepth, $kernel_size, $scale, $delta, BORDER_DEFAULT );
convertScaleAbs( $dst, $abs_dst );
imshow( $window_name, $abs_dst );
waitKey(0);
return 0;
