<?php
//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}

//接受传递的值
if(isset($_GET['id'])){
	$id = $_GET['id'];
//	根据传递的id查询本级分类下的所有子分类
	$data = getClassifyTrees($id);
// 删除所有子分类
	foreach($data as $k=>$v){
		$result[] = delete_one('news_classify','classify_id='.$k);
	}
//  删除本分类
	$result[] = delete_one('news_classify','classify_id='.$id);
	if(!in_array(false,$result)){
		echo '<script>
				alert("删除成功");
				location.href = "admin.php?a=classify&c=index";
			</script>';
	}else{
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=classify&c=index";
			</script>';
	}
}
