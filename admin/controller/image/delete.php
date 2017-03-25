<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/1
 * Time: 16:55
 */
/*
 * 图片删除需要考虑：
 * 数据库中的数据需要删除
 * 需要根据数据库中的原图和缩略图路径把图片从图库中删除
 *
 *
 * */

if(isset($_GET["id"])) {
    $id = $_GET["id"];
//    查询数据，获得原图的路径和缩略图路径，用于删除图片文件
    $data = search('image', 'img_id=' . $id);
    $old_img = $data['img_url'];
    $old_suo = $data['img_suolue'];

//    删除图片文件

    $result = delete_one("image", "img_id=" . $id);
    if ($result) {
        if (unlink($old_img) && unlink($old_suo)) {
            echo '<script>
				alert("文件和缩略以及数据库数据成功");
				location.href = "admin.php?a=image&c=index";
			</script>';
        }
    } else {
        echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=image&c=index";
			</script>';
    }
}


//$_POST传递的是一个要删除的数组，如果数组为空，在前端js中已经判断不能跳转,前端页面跳提示
if(!empty($_POST["select"])) {
    $id_arr = $_POST['select'];

    //    查询数据，获得原图的路径和缩略图路径，用于删除图片文件
    foreach($id_arr as $v){
        $data = search('image', 'img_id=' . $v);
        $old_img[] = $data['img_url'];
        $old_suo[] = $data['img_suolue'];
    }

//	根据选择的id号进行删除数据
    foreach ($id_arr as $v) {
        $result = delete_one("image", "img_id=" . $v);
    }
    if ($result) {
//       删除图片文件
        foreach($old_img as $val1){
            unlink($val1);
        }
//        删除缩略图文件
        foreach($old_suo as $val2){
            unlink($val2);
        }
        echo '<script>
            alert("文件和缩略以及数据库数据成功");
            location.href = "admin.php?a=image&c=index";
        </script>';

    } else {
        echo '<script>
				alert("sql语句出错");
				location.href = "admin.php?a=image&c=index";
			</script>';
    }
}
