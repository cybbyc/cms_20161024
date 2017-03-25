<?php
//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}



//分页显示新闻
$row = fenye_n("manage","index",6,"admin",5);


//include(V_PATH."header.html");
//include(V_PATH."news/index.html");
//include(V_PATH."bottom.html");

html("manage","index",$row);




