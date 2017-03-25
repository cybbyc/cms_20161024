<?php

//用户输入用户名密码点击提交按钮--》将信息提交到login.php--->login.php接收用户提交信息，--》查询数据库是否存在用户名和密码--》如果存在就跳转index.php  --->否则登陆失败

/**
1. 创建数据库 建表装用户信息
2.用户输入用户名密码点击提交按钮将信息提交到login.php
3.login.php接收用户提交信息
4.查询数据库是否存在用户名和密码(链接数据库--》sql-->送入数据库---》返回查询这条语句)
5.判断查询是否为空，如果为空留在登陆页面，如果不为空就登陆进index.php
*/



if(!empty($_POST['username']))
{
//	print_r($_POST);
//	die();
	$uname = $_POST['username'];
	$pwd = $_POST['pwd'];
	//随机验证码
	$yz = $_SESSION['yz'];
	
	//输入验证码
	$yanzheng = $_POST['yanzheng'];

	//是否勾上保存用户信息
	$baocun = !empty($_POST['bc'])?$_POST['bc']:null;
	//当需要不区分大小写匹配时使用strcasecmp()函数
	if(strcasecmp($yz,$yanzheng) == 0){
		$sql = 'select * from admin where admin_name="'.$uname.'" and admin_pwd="'.$pwd.'"';
		//echo $sql;
		$query = mysql_query($sql);
		//echo $query;
		if($query)
		{
			$row = mysql_fetch_assoc($query);
			if($row)
			{
				//如果用户名验证成功，则把用户名保存到session中
				$_SESSION["username"] = $uname;
				//把登录用户的权限记录下来
				$limit_str = $row["admin_limit"];
				$limit_arr = json_decode($limit_str);
				//把权限放到session数组
				$_SESSION["limit"] = $limit_arr;

				//当勾选了保存用户名和密码时，把用户名和密码写在cookie中
				if($baocun == "on"){
					setcookie('username',$uname,time()+60*60*24);
					setcookie('pwd',$pwd,time()+60*60*24);
				}

				header('location:'.URL_PATH.'admin.php?a=news&c=index');
			}
			else
			{
				echo "
					<script>
						alert('用户名或密码错误，请重新输入');
						location.href = 'admin.php';
					</script>
				";
	//			header('location:http://localhost/E1420/cms/login.php');
			}
		}
	}else{
		echo "
			<script>
				alert('验证码错误');
				location.href = 'admin.php';
			</script>
		";
	}


}


include(V_PATH."login/login.html" );
