<?php
session_start();

$image=imagecreatetruecolor(120,40);
$bgcolor=imagecolorallocate($image, rand(200,255), rand(200,255), rand(200,255));
$textcolor=imagecolorallocate($image, rand(0,150), rand(0,150), rand(0,150));
imagefill($image, 0, 0, $bgcolor);
$str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$temp=null;
 for($i=0;$i<4;$i++){	
	$temp.=$str[rand(0,strlen($str)-1)];	
}
//把验证码保存到session中
$_SESSION['captcha']=$temp;

for($i=0;$i<4;$i++){
	$textcolor=imagecolorallocate($image, rand(0,150), rand(0,150), rand(0,150));	
	$size=rand(10,18);	
	$angle=rand(-15,15);
	$x=floor(120/4)*$i+rand(2,8);
	$y=rand(24,28);
	imagettftext($image,$size,$angle,$x,$y,$textcolor,"georgiab.ttf",$temp[$i]);	
} 

imagepng($image);
?>