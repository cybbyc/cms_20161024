<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}


//查询数据
//$data = search_duo("news");

//获取表单数据
if(!empty($_POST["admin_name"]) && !empty($_POST["admin_limit"])){
	$arr = $_POST;
//	把权限选择的数组化为json字符串，一边保存到数据库中
	$json_limit = json_encode($_POST['admin_limit']);
	$arr['admin_limit'] = $json_limit;
//
//	$arr = $_POST;
//	$arr["news_time"] = date("Y-m-d H:i:s",time());
//	$arr["news_user"] = $_SESSION["username"];


//	编写数据库插入语句
	$result = insert1("admin",$arr);
	if($result){
		echo '<script>
				alert("成功添加管理员：'.$arr['admin_name'].'");
				location.href = "admin.php?a=manage&c=index";
			</script>';
	}else{
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=manage&c=add";
			</script>';
	}
}



//加载视图
//include(V_PATH."header.html");
//include(V_PATH."news/add.html");
//include(V_PATH."bottom.html");

html("manage","add");