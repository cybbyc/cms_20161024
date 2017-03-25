<?php
//判断用户名是否登录
if(empty($_SESSION["username"])){
	//当用户没有登录，则返回登录页面
	header("location:http://localhost/cms/login.php");
}

//声明一个数组，统一存放查询出来的分类列表数据
/*$classifytree = array();

//查找出顶级分类
$row = search_duo('news_classify','where p_id=0');
//使用foreach查询出顶级分类下的子分类
foreach($row as $val){
	$classifytree[] = $val;
//	查询子分类，该处已将子分类封装成了search_duo()函数
	$row1 = search_duo('news_classify','where p_id='.$val['classify_id']);
	foreach($row1 as $val1){
		$classifytree[] = $val1;
	//	查询子分类
		$row2 = search_duo('news_classify','where p_id='.$val1['classify_id']);
		foreach($row2 as $val2){
			$classifytree[] = $val2;
			//	查询子分类
			$row3 = search_duo('news_classify','where p_id='.$val2['classify_id']);
		}
	}
}

print_r($classifytree);*/

/*
 *
 * 将所有的子级的分类查询出来
 *
 * */
/*function getClassifyTrees( $id = 0,$classifytree = array(),$level = 0){
	// 顶级
	$row = search_duo('news_classify','where p_id='.$id);
	//使用foreach查询出顶级分类下的子分类
	foreach($row as $val) {
//      通过等级设置在各个分类名前面加“|-”个数
		$str = '';
		$l = '&nbsp&nbsp';
		for($i=0;$i<=$level;$i++) {
			$str .= $l;
		}
		for($i=0;$i<=$level;$i++){

			$str .='<span style="color:red">|-</span>';
		}
		$val['classify_name']  = $str.$val['classify_name'];

//      存放顶级分类
		$classifytree[$val['classify_id']] = $val;
//      递归方式：在函数内部调用函数自身
		$classifytree = getClassifyTrees($val['classify_id'],$classifytree,$level+1);
	}
	return $classifytree;
}*/

$row['data'] = getClassifyTrees();
/*
 *
 * 数组内容过多时使用分页
 *
 *参数：
 * $a:控制器a文件夹
 * $c:控制器c文件
 * $page_pre:设置每页显示的条数
 * $arr:需要分页的数组
 *
 *
 *
 * */
/*function fenye_arr1($a,$c,$page_pre,$arr){
//    计算数组的总条数
	$num_all = count($arr);
	echo $num_all;
}


fenye_arr1('classify','index',5,$row['data']);*/


//die();

html("classify","index",$row);




