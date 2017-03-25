<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22
 * Time: 10:17
 *
 * 该页面是新闻分类页面ajax响应页面
 * 根据ajax传递过来的父级id查询出该父级分类下的子分类
 */
if(isset($_GET['id'])){
    $p_id = $_GET['id'];
    $row = search_duo('news_classify','where p_id='.$p_id);
    echo json_encode($row);
}
//   echo json_encode("abc");