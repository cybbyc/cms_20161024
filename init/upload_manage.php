<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/28
 * Time: 15:27
 */

/*
 *
 * 该文件放置的是文件上传处理相关的函数
 *
 *
 * */



/*
 * 上传文件处理函数：把上传的文件放置到相应位置，规定文件上传的格式、大小规范
 *参数：
 * 1.$file_arr--文件上传的数组
 * 2.$type_arr--规定格式的数组
 * 3.$max_size--规定文件的最大值，单位b
 * 4.$dir_name--文件放置位置的初始文件夹名称
 * 5.$level--规定文件位置是否需要按照年月日设置树形结构文件夹
 *      默认0：不使用年月日树形结构
 *      1：使用年文件夹
 *      2：使用年月文件夹
 *      3：使用年月日文件夹
 *      其他：不使用年月日树形结构
 * 6.$filename:规定文件命名规则
 *      ‘’：默认使用已有规则
 *       '自定义'：输入自定义规则
 *
 * 返回一个带有三个值的数组：
 * type:返回true表示格式正确，false表示格式错误
 * size:返回true表示文件大小正常，false表示文件过大
 * file_name:返回上传文件上传成功后的完整文件路径
 *
 * */

function upload($file_arr,$type_arr,$max_size,$dir_name,$level=0,$filename=""){

    /*
         * 通过字符串截取获得文件后缀名
         * 1.找到 ‘.’最后出现的位置
         *2.通过字符串截取函数截取出文件后缀名
         * */
    $node_last = strrpos($file_arr['name'],'.');

    $last_name = substr($file_arr['name'],$node_last);
    /*
     * 图片上传需要考虑的几点：
     * 1.图片格式是否符合
     * 2.图片大小
     * 3.图片存储位置
     *
     * */
//	设置允许上传的图片的格式数组
    if(!in_array($file_arr['type'],$type_arr)){
//        echo '
//			<script>
//				alert("无法上传该格式的文件，请选择jpeg/png/gif的格式文件");
//				location.href = "admin.php?a=image&c=add";
//			</script>
//		';
        $data['type'] = false;
    }else{
        $data['type'] = true;
    }

//	设置允许上传图片文件的最大空间
    if($file_arr['size'] > $max_size){
//        echo '
//			<script>
//				alert("文件大于允许上传的大小，请选择10M以下的文件");
//				location.href = "admin.php?a=image&c=add";
//			</script>
//		';
        $data['size'] = false;
    }else{
        $data['size'] = true;
    }
    /*
     * 下面根据年、月、日对存储上传文件进行树形文件夹分布设置
     * 首先确定年份的文件夹是否存在，若存在则查找月份文件夹，若不存在则新建年份文件夹
     * 确定月份文件夹是否存在，若存在则查找当日文件夹，若不存在则新建月份文件夹
     *
     * */
    $file = $dir_name.'/';
//	判断年
    if($level ==1 || $level ==2 || $level ==3){
        if(!file_exists($file.date('Y',time()))){
            mkdir($file.date('Y',time()));
        }
        $file .=date('Y',time()).'/';
    }
    if($level ==2 || $level ==3) {
        //	判断月
        if (!file_exists($file . date('m', time()))) {
            mkdir($file . date('m', time()));
        }
        $file .= date('m', time()) . '/';
    }
    if( $level ==3) {
        //	判断日
        if (!file_exists($file . date('d', time()))) {
            mkdir($file . date('d', time()));
        }
        $file .= date('d', time()) . '/';
    }

//	拼凑完整路径的文件
//    判断用户是否输入了自定义命名规则
    $filename = ($filename == "")?(date("YmdHis",time()).md5(rand(100000,999999)).$last_name):($filename.$last_name);
    $file_name = $file.$filename;
    $data['filename'] = $filename;

//	把上传的文件移动到规定的位置
    move_uploaded_file($file_arr['tmp_name'],$file_name);

    $data['file_name'] =  $file_name;

    return $data;
}


/*
 * 下面是固定压缩比的压缩图制作函数
 * 该函数是以图片上传处理函数为基础
 *
 * 缩略图制作：
 * 确定图片压缩后的宽高
 * 原图片路径，原图片大小信息
 * 按比例压缩
 * 得到缩略图
 * 保存缩略图
 * 参数：
 * 1.$p--规定压缩比
 * 2.$file_name--源图像文件路径
 * 3.$type--上传图片的类型
 *4.$level--规定文件位置是否需要按照年月日设置树形结构文件夹
 *      默认0：不使用年月日树形结构
 *      1：使用年文件夹
 *      2：使用年月文件夹
 *      3：使用年月日文件夹
 *      其他：不使用年月日树形结构
 *
 * 返回值：返回新生成的缩略图的路径
 *
 * */
function suolue_p($p,$file_name,$type,$level=0){

//	取得源文件宽高
    list($yw,$yh) = getimagesize($file_name);
//	确定压缩图的尺寸
    $new_w = $yw*$p;
    $new_h = $yh*$p;

//	重新采样
//	创建一张真彩图
    $image_new = imagecreatetruecolor($new_w,$new_h);
//	把源文件靠内容拷贝到服务器中
    if($type =="image/jpeg"){
        $image = imagecreatefromjpeg($file_name);
    }else if($type =="image/png"){
        $image = imagecreatefrompng($file_name);
    }else if($type =="image/gif"){
        $image = imagecreatefromgif($file_name);
    }
//	重采样拷贝部分图像并调整大小
    imagecopyresampled($image_new,$image,0,0,0,0,$new_w,$new_h,$yw,$yh);

//	确定文件保存路径及文件名
    $file = 'upload/suolue/';
//	判断年
	if($level ==1 || $level ==2 || $level ==3){
        if(!file_exists($file.date('Y',time()))){
            mkdir($file.date('Y',time()));
        }
        $file .=date('Y',time()).'/';
	}
	if($level ==2 || $level ==3) {
        //	判断月
        if (!file_exists($file . date('m', time()))) {
            mkdir($file . date('m', time()));
        }
        $file .= date('m', time()) . '/';
	}
	if( $level ==3) {
        //	判断日
        if (!file_exists($file . date('d', time()))) {
            mkdir($file . date('d', time()));
        }
        $file .= date('d', time()) . '/';
	}

//	拼凑完整路径的文件
    $node_last = strrpos($file_name,'/');
    $filename = substr($file_name,$node_last+1);
    $file_name = $file.$filename;
//	把压缩后的图像输出保存到文件夹中，通过判断上传图片的类型确定新图像输出的函数
    if($type =="image/jpeg"){
        imagejpeg($image_new,$file_name);
    }else if($type =="image/png"){
        imagepng($image_new,$file_name);
    }else if($type =="image/gif"){
        imagegif($image_new,$file_name);
    }

//    die();
    return $file_name;

}




