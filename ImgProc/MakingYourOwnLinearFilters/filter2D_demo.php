<?php
namespace CV;

$window_name = "filter2D Demo";
$imageName = "./lena.jpg"; // by default

$src = imread( $imageName, IMREAD_COLOR ); // Load an image
if( empty($src) ) {
	return -1; 
}

$anchor = new Point(-1, -1);
$delta = 0;
$ddepth = -1;
$ind = 0;
for(;;) {
	 $c = waitKey(500);
	 if( $c == 27 ) {   //ESC键的ASCII码为27
	 	break; 			//在图片窗口界面按ESC键方可退出
	 }
	 $kernel_size = 3 + 2*( $ind%5 );
	 $kernel = Mat::ones( $kernel_size, $kernel_size, CV_32F )->divide($kernel_size*$kernel_size);
	 filter2D($src, $dst, $ddepth , $kernel, $anchor, $delta, BORDER_DEFAULT );
	 imshow($window_name, $dst);
	 $ind++;
}
return 0;
