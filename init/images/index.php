<?php 
header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");

//开启session，保存随机生成的字符
session_start();

//声明要调用GD库的函数
header("Content-type: image/jpeg;charset=utf8"); 
$x_width = 100;
$y_height = 50;

$image = imagecreatetruecolor($x_width,$y_height);    //创造一个真彩图像

//背景颜色
$bg_color = imagecolorallocate($image,240,240,240);
//画背景
imagefilledrectangle($image,0,0,$x_width,$y_height,$bg_color);

//矩形颜色
$rect_color = imagecolorallocate($image,255,0,0); //三元色  0-255  
//画矩形
imagerectangle($image,0,0,$x_width-1,$y_height-1,$rect_color);  //rectangle矩形  triangle三角形
 
//画干扰点 
for($i=0;$i<100;$i++)
{
	//干扰点颜色
	$pixel_color = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
	//画干扰点
	imagesetpixel($image,rand(0,$x_width),rand(0,$y_height),$pixel_color);
}

//画直线
for($j=0;$j<10;$j++)
{
	//直线颜色
	$line_color = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
	imageline($image,rand(0,$x_width),rand(0,$y_height),rand(0,$x_width),rand(0,$y_height),$line_color);	
}
for($k=0;$k<10;$k++)
{
	//弧线颜色
	$arc_color = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
	imagearc($image,rand(0,$x_width),rand(0,$y_height),rand(0,100),rand(0,50),rand(-90,90),rand(0,360),$arc_color);
}

//写字
$str = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
$x = 10;	//x坐标点
$y = 30;	//y坐标点
$strr = '';	//设置一个空字符串
for($n=0;$n<4;$n++)
{ 
	$char = $str[rand(0,strlen($str)-1)];
	$strr .= $char;
	$font_color = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
	imagefttext($image,20,rand(-45,45),$x+$n*20,$y,$font_color,'ariblk.ttf',$char);
}
//把字符组成的字符串放到session中
$_SESSION['yz'] = $strr;

imagejpeg($image);  //生成图片

