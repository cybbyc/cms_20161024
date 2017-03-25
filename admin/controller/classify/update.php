<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}

//接受传递的值
if(isset($_GET['id'])){
	$id = $_GET['id'];
	echo $id;
//	die;
//  根据id值查询出本分类
	$result = search("news_classify",'classify_id='.$id);
	$row["result"] = $result;
	do{
		//  根据本级分类的p_id查找出所有的本级的所有分类
		$arr[$result['classify_id']] = search_duo("news_classify","where p_id=".$result['p_id']);
		//  查找上一级分类
		$result = search("news_classify",'classify_id='.$result['p_id']);
	} while($result);

//	将数组反序排序
	$arr = array_reverse($arr,true);
	$row["arr"] =$arr;
//	print_r($arr);
//	die;

}

//获取表单数据
if(!empty($_POST["classify_name"]) && !empty($_POST["p_id"])){
	$arr = $_POST;
//	$arr["news_time"] = date("Y-m-d H:i:s",time());
//	$arr["news_user"] = $_SESSION["username"];

//	编写数据库插入语句
	$result = update("news_classify",$arr);
	if($result){
		echo '<script>
				alert("修改成功");
				location.href = "admin.php?a=classify&c=index";
			</script>';
	}else{
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=classify&c=index";
			</script>';
	}
}

//print_r($row['data']);
//die();


html("classify","update",$row);