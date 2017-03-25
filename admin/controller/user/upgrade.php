<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}


//获取要修改数据行的id
if(isset($_GET["id"]) && isset($_GET["classify"])){
	$id = $_GET["id"];
	$classify = $_GET['classify'];
//  查找id=$id的普通用户的用户名和密码
	$row = search("user","user_id=".$id);
	$data['admin_name'] = $row['user_name'];
	$data['admin_pwd'] = $row['user_pwd'];


	//	设置给予的权限，分为4级：
	$arr1 = ["1","1.1","1.2"];
	$arr2 = ["2","2.1","2.2"];
	$arr3 = ["4","4.1","4.2"];
	$arr4 = ["5","5.1","5.2"];

//  通过判断管理员权限级别赋予用户管理权限
	switch($classify){
		case 1:
			$arr =  $arr1;
			break;
		case 2:
			$arr =  array_merge($arr1,$arr2);
			break;
		case 3:
			$arr =  array_merge($arr1,$arr2,$arr3);
			break;
		case 4:
			$arr =  array_merge($arr1,$arr2,$arr3,$arr4);
			break;
		default:
			$arr =  array();
			break;
	}
//	生成json字符串
	$data['admin_limit'] = json_encode($arr);

//  把用户放入管理员数据表（注意：用户与已有管理员不能重名）
//	查看用户名在管理员列表中是否存在
	$num = search_num("select * from admin where admin_name='".$row['user_name']."'");
	if($num > 0){
//////	如果用户名不存在，则把用户升级为管理员
		echo json_encode(0);
	}else{
		$result =  insert1("admin",$data);
		echo json_encode(1);
	}


//  组合数组
//	echo json_encode($data['admin_name']);
}
