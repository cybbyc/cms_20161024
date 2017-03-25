<?php
//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}



//分页显示新闻
$row = fenye_n("image","index",4,"image",5,"order by img_id desc");


//加载视图
//include(V_PATH."header.html");
//include(V_PATH."image/index.html");
//include(V_PATH."bottom.html");

html("image","index",$row);



