<?php
	
	//销毁session
	session_destroy();
	
	//删除cookie
//	setcookie('username',time()-100);
//	setcookie('pwd',time()-100);
	
	//返回到登陆页面
//	echo "
//				<script>
//					alert('用户已登出');
//					location.href = 'login.php';
//				</script>
//			";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
    	span{
    		font-weight: bold;
    		color: red;
    	}
    </style>
</head>
<body>
<div id="div">页面将于<span>5</span>秒后回到登陆页面</div>
<div><a href="admin.php">跳转到登录页面</a></div>
</body>
</html>
<script>
	var div = document.getElementById("div");
	
	setInterval(add,1000);
	var i = 5;
	function add(){
		i--;
		div.innerHTML = "页面将于<span>"+i+"</span>秒后回到登陆页面";
		if(i == 0){
			location.href = "admin.php";
		}
	}

</script>