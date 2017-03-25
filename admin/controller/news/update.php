<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}


//获取要修改数据行的id
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$data = search("news","news_id=".$id);
//	print_r($data);
//	die();
}

//获取表单数据
if(!empty($_POST["news_title"]) && !empty($_POST["news_content"])){
	$arr = $_POST;
	$arr["news_time"] = date("Y-m-d H:i:s",time());
//	$arr["news_user"] = $_SESSION["username"];
//	print_r($arr);

//	调用数据修改函数
	$result = update("news",$arr);
	if($result){
		echo '<script>
				alert("修改成功");
				location.href = "admin.php?a=news&c=index";
			</script>';
	}else{
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=news&c=update";
			</script>';
	}
}



//加载视图
//include(V_PATH."header.html");
//include(V_PATH."news/update.html");
//include(V_PATH."bottom.html");
html("news","update",$data);