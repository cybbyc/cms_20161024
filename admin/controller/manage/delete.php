<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}


//查询数据
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$result = delete_one('admin','admin_id='.$id);
	if($result){
		echo '<script>
				alert("已注销该管理员");
				location.href = "admin.php?a=manage&c=index";
			</script>';
	}else{
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=manage&c=index";
			</script>';
	}
}