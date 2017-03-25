/**
 * Created by cyb on 2016/12/24.
 */

/*
* 该页面为表单正则表达式验证
*
* */

    //var register = docuemnt.getElementById("register");
    //var input = register.getElementsByTagName("input");
    //for(var i=0;i<input.length;i++){
    //    //input[i].style.border ="3px solid red";
    //    alert("aa");
    //}
//$(function(){
//    $("#register input[type='text']]").sibling().style("","1px solid red");
//});

function user(username){
//    匹配至少六个字符,之多12个字符的用户名，只能用字母开头，区分大小写
    var zz = /^[a-zA-Z]\w{5,11}$/;
    if(zz.test()){
        alert("aa");
        $(this).next("span").html("√");
    }else{
        $(this).next("span").html("×");
    }
}

$(function () {
    //设置当前一个控件填写不通过则下面的无法填写
    $("#username").blur(function () {
        var zz = /^[a-zA-Z]\w{5,11}$/;
        if(zz.test($(this).val())){
            $(this).next("span").html("√ 用户名可用").css("color","green");
        }else{
            $(this).next("span").html("× 请输入6~12个非中文字符的用户名").css("color","red");
        }
    });

    $("#nicheng").blur(function () {
        var zz = /^[\w\u4e00-\u9fa5|]{2,6}$/;
        if(zz.test($(this).val())){
            $(this).next("span").html("√ 昵称可用").css("color","green");
        }else{
            $(this).next("span").html("× 请输入2~6个非特殊字符的昵称").css("color","red");
        }
    });

    $("#pwd1").blur(function () {
        var zz = /^[a-zA-Z0-9]{6,18}$/i;
        if(zz.test($(this).val())){
            $(this).next("span").html("√ 密码可用").css("color","green");
        //    记录第一次的正确密码
            pwd = $(this).val();
        }else{
            $(this).next("span").html("× 请输入6~18由数字和英文组成的密码").css("color","red");
        }
    });
    $("#pwd2").blur(function () {
        var zz = /^[a-zA-Z0-9]{6,18}$/i;
        if(zz.test($(this).val())){
            //$(this).next("span").html("√ 昵称可用").css("color","green");
            //    记录第一次的正确密码
            if(typeof(pwd) !="undefined"){
                if($(this).val() == pwd){
                    $(this).next("span").html("√ 密码正确").css("color","green");
                }else{
                    $(this).next("span").html("√ 两次密码输入不一致").css("color","green");
                    $(this).val("");
                }
            }else{
                $(this).next("span").html("× 请先输入密码再验证").css("color","red");
            }

        }else{
            $(this).next("span").html("× 请输入6~18由数字和英文组成的密码").css("color","red");
        }
    });
    $("#email").blur(function () {
        var zz = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if(zz.test($(this).val())){
            $(this).next("span").html("√ 邮箱格式正确").css("color","green");
            //    记录第一次的正确密码
            pwd = $(this).val();
        }else{
            $(this).next("span").html("× 邮箱格式错误").css("color","red");
        }
    });


});