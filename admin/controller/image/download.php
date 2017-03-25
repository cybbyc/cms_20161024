<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/2
 * Time: 15:12
 */

if(isset($_GET["id"])) {
    $id = $_GET["id"];

//    向数据库查询图片路径
    $data = search('image', 'img_id=' . $id);
//    得到原图路径，而非缩略图
    $img_url = $data['img_url'];

//    得到下载后文件名称：与服务器上名称相同，所以需要对图片完整路径进行字符串截取
    $last = strrpos($img_url,'/');
    $filename = substr($img_url,$last+1);
//    echo $filename;
//    获得后缀名：
    $node_last = strrpos($filename,'.');
    $last_name = substr($filename,$node_last+1);
//    echo $last_name;
//    die();

/*
 * 向浏览器发送下载文件必要的头信息
 * 发送了一下三行头信息，图片就不会直接在浏览器中显示，而是让浏览器将该文件形成下载的形式
 *
 * */


//发送指定文件MIME类型的头信息
header('Content-Type:imge/'.$last_name);
//发送描述文件的头信息，说明点开的文件是附件并且规定下载后的文件名
header('Content-Disposition:attachment; filename="'.$filename.'"');
//发送指定文件大小的信息，单位字节
header('Content-Length:'.filesize($img_url).'');


//将文件内容读取出来并直接输出，以便下载。但如果只是用readfile()函数，碰到中文名的话无法正常下载,就需要用到其他方式
    readfile($img_url);

}