<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 9:35
 */

/*
 *
 * 该系统配置文件为前后台公用
 *该文件为基本配置文件
 *
 *
 * */


//模板加载函数
/*
 *
 * 参数：
 * $a:模板所在文件夹
 * $c:模板文件夹名称
 * $row:调用模板时传递的参数数组
 *
*/
function html($a,$c,$row=array()){
//    把传递过来的参数数组变换回变量形式
    extract($row);
//   根据 $a 和 $c 调用相应模板
    include(V_PATH."header.html");
    include(V_PATH.$a.'/'.$c.".html");
    include(V_PATH."bottom.html");
}


/*
 *
 * 将所有的子级的分类查询出来
 *
 * */
function getClassifyTrees( $id = 0,$classifytree = array(),$level = 0){
    // 顶级
    $row = search_duo('news_classify','where p_id='.$id);
    //使用foreach查询出顶级分类下的子分类
    foreach($row as $val) {
//      通过等级设置在各个分类名前面加“|-”个数
        $str = '';
        $l = '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
        for($i=0;$i<=$level;$i++) {
            $str .= $l;
        }
        for($i=0;$i<=$level;$i++){

            $str .= '<span style="color:#ff1705">|-</span>';
        }
        $val['classify_name']  = $str.$val['classify_name'];

//      存放顶级分类
        $classifytree[$val['classify_id']] = $val;
//      递归方式：在函数内部调用函数自身
        $classifytree = getClassifyTrees($val['classify_id'],$classifytree,$level+1);
    }
    return $classifytree;
}


/*
 * 从当前分类往上查询
 * 在分类修改页面，从选择的分类开始向父级分类查询，把查询出来的所有分类放置到一个数组中返回
 *
 * 注意：该函数递归方式出现问题，未解决
 *
 * */
function select_up($pid,$data = array()){
    if($pid == 0){
//        return $data;
        return "abc";
    }
    //  根据本级分类的p_id查找出所有的本级的所有分类
    $data = search_duo("news_classify","where p_id=".$pid);
//  查找上一级分类
    $row1 = search("news_classify",'classify_id='.$pid);
//    函数递归继续往上级查找
    select_up($row1['p_id'],$data);
}