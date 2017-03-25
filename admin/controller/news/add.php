<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}


//查询数据
//$data = search_duo("news");

//获取表单数据
if(!empty($_POST["news_title"]) && !empty($_POST["news_content"])){
	$arr = $_POST;
	$arr["news_time"] = date("Y-m-d H:i:s",time());
	$arr["news_user"] = $_SESSION["username"];


//	编写数据库插入语句
	$result = insert("news",$arr);
	if($result){
		echo '<script>
				alert("插入成功");
				location.href = "admin.php?a=news&c=index";
			</script>';
	}else{
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=news&c=add";
			</script>';
	}
}



//加载视图
//include(V_PATH."header.html");
//include(V_PATH."news/add.html");
//include(V_PATH."bottom.html");

html("news","add");