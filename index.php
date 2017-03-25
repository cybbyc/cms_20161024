<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 9:31
 */

/*
 *
 * 该页面为前端加载唯一入口
 *
 **/
//设置php文件的编码格式
header("content-type:text/html; charset=utf-8");

//设置项目根目录路径常量
define("PATH",dirname(__FILE__)."/");

//前后台公用模型路径
define("M_HOME_PATH",PATH."init/");

//后台控制器路径
define("C_HOME_PATH",PATH."home/controller/");

//后台视图路径
define("V_HOME_PATH",PATH."home/view/");

//php页面跳转URL根目录路径
//define("URL_PATH",$_SERVER['HTTP_REFERER']);
define("URL_PATH","http://localhost/cms/");
//echo "跳转路径：".URL_PATH;

//加载配置文件
include_once(M_HOME_PATH."base.php");
//数据库相关配置及函数
include_once(M_HOME_PATH."mysql.php");
//分页
//include_once(M_HOME_PATH."fenye.php");
//文件上传处理函数
//include_once(M_HOME_PATH."upload_manage.php");

//开启session
session_start();

//连接数据库
connect("localhost","root","","cms_20161024");

//所有时间时区调整为中国时区
date_default_timezone_set("PRC");

//后台路由规则:通过判断参数a、c判断页面跳转到a文件夹中的c文件
//$a = isset($_GET["a"])?$_GET["a"]:"index";
$c =  isset($_GET["c"])?$_GET["c"]:"index";
define("C",$c);

include(C_HOME_PATH.C.".php");















