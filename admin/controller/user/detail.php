<?php
//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}

//获取要修改数据行的id
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$data = search("user","user_id=".$id);
//	print_r($data);
//	die();
}

$row['data'] = $data;
html("user","detail",$row);




