<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26
 * Time: 16:43
 */


/*
 *
 * 新闻列表页分页显示函数
 *参数：
 * $a:控制器a文件夹
 * $c:控制器c文件
 * $page_pre:设置每页显示的条数
 *$dtname:分页显示数据需要查询的表
 * $orderby:设置排序信息，可选
 *
 * 返回值：返回一个包含数据数组和控件字符串的数组
 *
 * */

function fenye($a,$c,$page_pre,$dtname,$orderby=" "){
//确定每页显示条数:
//    $page_pre = 6;

//确定当前页,刚加载页面时默认为第一页
    $p = isset($_GET['p'])?$_GET['p']:1;

//确定每一页查询的起始数据的位置
    $offset = $page_pre*($p-1);

//通过查询函数，获得每一页需要显示的数据   'order by news_id desc'
    $data = search_duo($dtname,$orderby,'limit '.$offset.','.$page_pre);

//获得数据总条数
    $news_num = search_num('select * from '.$dtname);

//计算获得总页数：总条数/每页显示条数；取上取整
    $page_num = ceil($news_num/$page_pre);

//    $str字符串为html页面显示的分页控件信息，可根据自己所需自有更改样式
    $str = '';

    $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p=1" title="First Page">&laquo; First</a>';

//前一页：当当前页p=1时，上一页也为p=1
    $pre = ($p>1)?($p-1):1;
    $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p='.$pre.'" title="Previous Page">&laquo; Previous</a>';

//对页数进行循环显示出来
    for($i = 1;$i<=$page_num;$i++){
//	判断当前页的的控件，使当前页控件样式不同
        $current = ($i==$p)?"current":"";
        $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p='.$i.'" class="number '.$current.'" title="'.$i.'">'.$i.'</a>';
    }

//后一页：当当前页p=$page_num时，下一页也为$page_num
    $next = ($p<$page_num)?($p+1):$page_num;
    $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p='.$next.'" title="Next Page">Next &raquo;</a>';
    $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p='.$page_num.'" title="Last Page">Last &raquo;</a>';

/*
 * 需要返回的数据有$data和$str
 * */
    $row["data"] = $data;
    $row["str"] = $str;

    return $row;
}


/*
 *
 * 规定分页显示页数的函数
 *参数：
 * $a:控制器a文件夹
 * $c:控制器c文件
 * $page_pre:设置每页显示的条数
 *$dtname:分页显示数据需要查询的表
 * $center:规定需要显示的页数
 * $orderby:设置排序信息，可选
 *
 *
 * 返回值：返回一个包含数据数组和控件字符串的数组
 *
 * */
function fenye_n($a,$c,$page_pre,$dtname,$center=5,$orderby=" "){
//确定每页显示条数:
//    $page_pre = 6;

//确定当前页,刚加载页面时默认为第一页
    $p = isset($_GET['p'])?$_GET['p']:1;

//确定每一页查询的起始数据的位置
    $offset = $page_pre*($p-1);

//通过查询函数，获得每一页需要显示的数据   'order by news_id desc'
    $data = search_duo($dtname,$orderby,'limit '.$offset.','.$page_pre);

//获得数据总条数
    $news_num = search_num('select * from '.$dtname);

//计算获得总页数：总条数/每页显示条数；取上取整
    $page_num = ceil($news_num/$page_pre);


//    获得起始页,判断需要显示的页数为奇数页还是偶数页
    $page_start = ($center%2==0)? ($p - $center / 2+1):($p - floor($center / 2));

//    获得结束页
    $page_end = $p+floor($center/2);

//  当总页数小于规定页数时
    if($page_num < $center){
        $page_start = 1;
        $page_end = $page_num;
    }

//  当起始页小于1时
    if($page_start<1){
        $page_start = 1;
        $page_end = $center;
    }

//    当结束页大于总页数时
    if($page_end >$page_num){
        $page_end = $page_num;
        $page_start = $page_num-$center+1;
    }

//    $str字符串为html页面显示的分页控件信息，可根据自己所需自有更改样式
    $str = '';

    $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p=1" title="First Page">&laquo; First</a>';

//前一页：当当前页p=1时，上一页也为p=1
    $pre = ($p>1)?($p-1):1;
    $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p='.$pre.'" title="Previous Page">&laquo; Previous</a>';

//对页数进行循环显示出来
    for($i = $page_start;$i<=$page_end;$i++){
//	判断当前页的的控件，使当前页控件样式不同
        $current = ($i==$p)?"current":"";
        $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p='.$i.'" class="number '.$current.'" title="'.$i.'">'.$i.'</a>';
    }

//后一页：当当前页p=$page_num时，下一页也为$page_num
    $next = ($p<$page_num)?($p+1):$page_num;
    $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p='.$next.'" title="Next Page">Next &raquo;</a>';
    $str .= '<a href="admin.php?a='.$a.'&c='.$c.'&p='.$page_num.'" title="Last Page">Last &raquo;</a>';

    /*
     * 需要返回的数据有$data和$str
     * */
    $row["data"] = $data;
    $row["str"] = $str;

    return $row;
}

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
function fenye_arr($a,$c,$page_pre,$arr){
//    计算数组的总条数
    $num_all = count($arr);
}




