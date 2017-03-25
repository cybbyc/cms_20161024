<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}



//$_POST传递的是一个要删除的数组，如果数组为空，在前端js中已经判断不能跳转,前端页面跳提示
if(!empty($_POST["select"])) {
	$id_arr = $_POST['select'];
//	die();

//	根据选择的id号进行删除数据
	foreach ($id_arr as $v) {
		$result = delete_one("news", "news_id=" . $v);
	}
	if ($result) {
		echo '<script>
				location.href = "admin.php?a=news&c=index";
			</script>';
	} else {
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=news&c=index";
			</script>';
	}
}



//获取要删除数据行的id
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$result = delete_one("news","news_id=".$id);
	if($result){
		echo '<script>
//				alert("删除数据成功");
			location.href = "admin.php?a=news&c=index";
		</script>';
	}else{
		echo '<script>
			alert("sql语句出错");
			location.href = "admin.php?a=news&c=index";
		</script>';
	}
}