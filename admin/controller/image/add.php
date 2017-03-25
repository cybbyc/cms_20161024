<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}



//获取表单数据
if(!empty($_POST["img_name"]) && $_FILES['img_url']['error'] ==0){

//	规定上传格式
	$type_arr = array('image/jpeg','image/gif','image/png');
//	调用文件上传文件处理函数
	$arr = upload($_FILES['img_url'],$type_arr,5*1024*1024,'upload',3);


//	压缩函数调用
	$file_name_suo = suolue_p(0.5,$arr['file_name'],$_FILES['img_url']['type'],3);

//	组合上传到数据库的数据数组
	$row = $_POST;
	$row['img_url'] = $arr['file_name'];
	$row['img_time'] = date("Y-m-d H:i:s",time());
	$row['img_user'] = $_SESSION["username"];
	$row['img_suolue'] = $file_name_suo;

//调用数据库插入函数
	$result = insert('image',$row);
	if($result){
		echo '<script>
				alert("插入成功");
				location.href = "admin.php?a=image&c=index";
			</script>';
	}else{
		echo '<script>
				alert("出错");
				location.href = "admin.php?a=image&c=add";
			</script>';
	}
}


//加载视图
//include(V_PATH."header.html");
//include(V_PATH."image/add.html");
//include(V_PATH."bottom.html");

html("image","add");