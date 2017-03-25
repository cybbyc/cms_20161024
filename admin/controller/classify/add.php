<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}


//查询所有分类
//$row['data'] = getClassifyTrees();
$row['data'] = search_duo('news_classify','where p_id=0');
//获取表单数据
if(!empty($_POST["classify_name"]) && !empty($_POST["p_id"])){
	$arr = $_POST;
//	$arr["news_time"] = date("Y-m-d H:i:s",time());
//	$arr["news_user"] = $_SESSION["username"];

//	编写数据库插入语句
	$result = insert("news_classify",$arr);
	if($result){
		echo '<script>
				alert("插入成功");
				location.href = "admin.php?a=classify&c=index";
			</script>';
	}else{
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=classify&c=add";
			</script>';
	}
}

//print_r($row['data']);
//die();

//加载视图
//include(V_PATH."header.html");
//include(V_PATH."news/add.html");
//include(V_PATH."bottom.html");

html("classify","add",$row);