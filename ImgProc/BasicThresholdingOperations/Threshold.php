<?php
namespace CV;

$threshold_value = 0;
$threshold_type = 3;
$max_value = 255;
$max_type = 4;
$max_BINARY_value = 255;
$t1=null;
$t2=null;

$src = null;
$src_gray = null;
$dst = null;

$window_name = "Threshold Demo";
$trackbar_type = "Type: \n 0: Binary \n 1: Binary Inverted \n 2: Truncate \n 3: To Zero \n 4: To Zero Inverted";
$trackbar_value = "Value";


$imageName = "./stuff.jpg";
$src = imread($imageName, IMREAD_COLOR ); // Load an image
if(empty($src)) { 
  return -1; 
}
$src_gray = cvtColor($src, COLOR_BGR2GRAY);// Convert the image to Gray
namedWindow($window_name, WINDOW_AUTOSIZE ); // Create a window to display results

//change type
$Threshold_Demo1 = function($type,$tmp=0) use($t1,$t2,$threshold_type,$threshold_value, $max_BINARY_value,$window_name,$src_gray) {
  echo "demo1 is called\n";
  global $t1,$t2;
   $t1= $type;
    echo "t1 is: $t1 \n";
    echo "t2 is: $t2 \n";
  threshold($src_gray, $dst, $t2, $max_BINARY_value,$type );
  imshow($window_name, $dst);
};

//change threshold
$Threshold_Demo2 = function($threshold,$tmp=0) use($t1,$t2,$max_BINARY_value,$threshold_type,$threshold_value,$window_name,$src_gray) {
  echo "demo2 is called\n";
  global $t1,$t2;
    $t2 = $threshold;
    echo "t1 is: $t1 \n";
    echo "t2 is: $t2 \n";
  threshold($src_gray, $dst, $threshold, $max_BINARY_value,$t1 );
  imshow($window_name, $dst);
};

createTrackbar( $trackbar_type, 
                $window_name, 
                $threshold_type,
                $max_type, $Threshold_Demo1);

createTrackbar( $trackbar_value, 
                $window_name, 
                $threshold_value,
                $max_value, $Threshold_Demo2);

$Threshold_Demo1(0,0);
$Threshold_Demo2(0,0);

for(;;) {
  $c = waitKey( 20 );
  if( $c == 27 ) { 
    break; 
  }    
}
