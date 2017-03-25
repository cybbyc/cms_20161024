<?php

//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}
/*
 * 图片修改需要做的事情：
 * 确定需要修改的图片信息
 * 记录下旧图片的原图路径和缩略图路径（当新图片成功上传时需要把就图删除掉---该选项可选）
 * 选择新的图片进行上传，并把新图片保存到相应路径和创建缩略图
 * 把新图片信息保存到数据库中
 *
 * */



//获取要修改数据行的id
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$data = search("image","img_id=".$id);
//	print_r($data);
//	die();
	//创建两个变量用于存放旧图片路径和其缩略图路径，保存在session中
//	$_SESSION["OLD_IMG"] = $data["img_url"];
//	$_SESSION['OLD_SUO'] = $data["img_suolue"];
//	使用常量无法实现存储
	define("IMG",$data["img_url"]);
}

//获取表单数据
if(!empty($_POST["img_name"]) && $_FILES['img_url']['error'] ==0){
	$old_img = $_SESSION["OLD_IMG"];
	$old_suo = $_SESSION['OLD_SUO'];
//	规定上传格式
	$type_arr = array('image/jpeg','image/gif','image/png');
//	调用文件上传文件处理函数
	$arr = upload($_FILES['img_url'],$type_arr,5*1024*1024,'upload',3);

//	压缩函数调用
	$file_name_suo = suolue_p(0.5,$arr['file_name'],$_FILES['img_url']['type'],3);
	$row = $_POST;
	$row['img_url'] = $arr['file_name'];
	$row['img_time'] = date("Y-m-d H:i:s",time());
	$row['img_suolue'] = $file_name_suo;

//	调用数据修改函数
	$result = update("image",$row);
	if($result){
//		新图片上传成功，删除图片
		if(unlink($old_img) && unlink($old_suo)){
			echo '<script>
				alert("旧文件和旧缩略图删除成功，数据库修改成功");
				location.href = "admin.php?a=image&c=index";
			</script>';
		}
	}else{
		echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=image&c=update";
			</script>';
	}
}


//加载视图
html("image","update",$data);