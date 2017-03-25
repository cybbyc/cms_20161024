<?php
/**
 * Created by PhpStorm.
 * User: cyb
 * Date: 2016/10/24
 * Time: 10:03
 */

/*
 * 该文件用于数据库配置
 *同时封装了数据库操作相关的函数
 *
 * 要使用这一套函数需要把表单元素的名称与数据库表的列名保持一致
 *
 *
 * */

//链接数据库
function connect($host,$user,$pwd,$dbname){
    @mysql_connect($host,$user,$pwd) or die('链接服务器失败！');
    mysql_select_db($dbname) or die('链接数据库失败1');
//编码
    mysql_query('set names utf8');
}



/*
 * 该函数用于查询多条数据
 * 可以设置相关的where条件、order by排序、limit限制查询
 * 其中需要判断数据库表中是否包含有数据，所以调用了查询条数的函数
 *查询成功返回一个数据数组，失败则返回false
 *
 * */
function search_duo($tbname,$where="",$orderby="",$limit=""){
    $sql = 'select * from '.$tbname.' '.$where.' '.$orderby.' '.$limit;
    $result = mysql_query($sql);
    $num = search_num($sql);
//   判断数据库表中是否有数据，如果有数据把数据写入数组
    if($num){
        while($row = mysql_fetch_assoc($result)){
            $data[] = $row;
        }
        return $data;
    }else{
//        返回一个空数组是为了在调用时需要返回数组而不是其他类型
        return array();
    }
}

/*
 * 单条数据查询函数
 *参数：
 * 1.$tbname：数据库名称
 * 2.$where：帅选条件
 *
 * 返回值：查询成功返回一条数据，失败返回false
 *
 * */
function search($tbname,$where){
    $sql = 'select * from '.$tbname.' where '.$where;
    $result = mysql_query($sql);
    $num =mysql_num_rows($result);
    if($num){
       return mysql_fetch_assoc($result);
    }else{
        return false;
    }
}



/*
 *
 * 数据库表数据条数查询函数
 * 查询成功返回数据的条数，失败则返回false
 *
 * */
function search_num($sql){
    $result=mysql_query($sql);
    if($result){
        return mysql_num_rows($result);
    }else {
        return false;
    }
}


/*
 *
 * 数据插入函数 （当要插入的字符串中不包含双引号时用该函数）
 * 把需要插入的数据以数组的形式传递给函数
 * 注意：该数组以数据库表的列名为键(key)，数据值为值(value),然后在函数中进行分解拼接成sql语句
 * 需要两个参数：1.数据表名称  2.需要插入的数据数组
 *返回结果：插入成功返回true,失败返回false
 *
 *	$sql = 'insert into news(news_title,news_content,news_time,news_user) values("'.$title.'","'.$content.'","'.$time.'","'.$user.'")';

 * */
function insert($tbname,$arr){
    $l = '';
    $l .= 'insert into '.$tbname.' (';
    foreach($arr as $k=>$v){
        $l .= $k.',';
    }
    $l = rtrim($l,",");
    $l .=') values(';
    foreach($arr as $val){
        $l .= '"'.$val.'",';
    }
    $l = rtrim($l,",");
    $l .=')';
    $l = trim($l," ");
//    echo $l;
//    die();
    $result = mysql_query($l);
    if($result){
        return true;
    }else {
        return false;
    }
}

/*
 *
 * 数据插入函数 （当要插入的字符串中包含双引号时用该函数）
 * 把需要插入的数据以数组的形式传递给函数
 * 注意：该数组以数据库表的列名为键(key)，数据值为值(value),然后在函数中进行分解拼接成sql语句
 * 需要两个参数：1.数据表名称  2.需要插入的数据数组
 *返回结果：插入成功返回true,失败返回false
 *
 *	$sql = 'insert into news(news_title,news_content,news_time,news_user) values("'.$title.'","'.$content.'","'.$time.'","'.$user.'")';

 * */
function insert1($tbname,$arr){
    $l = "";
    $l .= "insert into ".$tbname." (";
    foreach($arr as $k=>$v){
        $l .= $k.",";
    }
    $l = rtrim($l,",");
    $l .=") values(";
    foreach($arr as $val){
        $l .= "'".$val."',";
    }
    $l = rtrim($l,",");
    $l .=")";
    $l = trim($l," ");
//    echo $l;
//    die();
    $result = mysql_query($l);
    if($result){
        return true;
    }else {
        return false;
    }
}



/*
 *
 * 修改数据库中数据的函数
 *因为该数组合成字符串时id要分开，所以html页面把隐藏id的域放在第一位，以便删除
 * 需要两个参数：1.数据表名称  2.需要修改的数据数组
 *返回结果：修改成功返回true,失败返回false
 *
 *
 * */
function update($tbname,$arr){
    $l = '';
    //获取数组键名组成新的数组
    foreach($arr as $k=>$v){
        $a[] = $k;
    }
    //去掉$arr数组的第一个元素，即id，以便其他需要修改的属性列能组成一个字符串，同时把id值留下来
    $id = array_shift($arr);
    foreach($arr as $key=>$val){
        //组成形式：news_title="....",news_content=".." where news_id = ... ;
        $l .=$key.' = "'.$val.'",';
    }
    $l =rtrim($l,',');
    $sql = 'update '.$tbname.' set '.$l.' where '.$a[0].'='.$id;
    $result = mysql_query($sql);
    if($result){
        return true;
    }else{
        return false;
    }
}


/*
 *
 * 修改数据库中数据的函数 ,(字符串中包含双引号时使用该函数)
 *因为该数组合成字符串时id要分开，所以html页面把隐藏id的域放在第一位，以便删除
 * 需要两个参数：1.数据表名称  2.需要修改的数据数组
 *返回结果：修改成功返回true,失败返回false
 *
 *
 * */
function update1($tbname,$arr){
    $l = "";
    //获取数组键名组成新的数组
    foreach($arr as $k=>$v){
        $a[] = $k;
    }
    //去掉$arr数组的第一个元素，即id，以便其他需要修改的属性列能组成一个字符串，同时把id值留下来
    $id = array_shift($arr);
    foreach($arr as $key=>$val){
        //组成形式：news_title="....",news_content=".." where news_id = ... ;
        $l .=$key." = '".$val."',";
    }
    $l =rtrim($l,',');
    $sql = "update ".$tbname." set ".$l." where ".$a[0]."=".$id;
//    echo $sql;
//    die;
    $result = mysql_query($sql);
    if($result){
        return true;
    }else{
        return false;
    }
}






/*
 *
 * 数据库单条数据删除函数
 *需要两个参数：1.数据表名称  2.完整的帅选条件
 * 返回结果：删除成功返回true,失败返回false
 *
 * */
function delete_one($tbname,$where){
    $sql = 'delete from '.$tbname.' where  '.$where;
    $result = mysql_query($sql);
    if($result){
        return true;
    }else{
        return false;
    }
}
