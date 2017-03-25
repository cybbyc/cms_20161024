/**
 * Created by cyb on 2016/12/24.
 */
window.onload = function(){
    /*
    * 用于header.html中导航栏nav的效果
    *
    * */

     //从php传值获得页面的$c文件名
    var c = document.getElementById("c");
    //alert(c.value);
    var nav = document.getElementById("nav");
    var li = nav.getElementsByTagName("li");
    var arr = ['index','piclist','list','content','about','register'];
    for(var i=0;i<li.length;i++){
    //    清空classname
        li[i].className = "";
    }
    //    判断哪个该用class
    for(var j=0;j<arr.length;j++){
        if(c.value == arr[j]){
            li[j].className = "current";
        }
    }

}