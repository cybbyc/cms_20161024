/**
 * Created by cyb on 2016/11/2.
 *
 * 下面函数用于多条数据删除的选择操作
 *
 *
 */

var tbody = document.getElementById("cyb_s");
var input = tbody.getElementsByTagName("input");
var k = true;
//全选和全部选函数--按钮
function all_select(){
    if(k){
        for(var i=0;i<input.length;i++){
            input[i].checked = true;
        }
        k = !k;
    }else{
        for(var i=0;i<input.length;i++){
            input[i].checked = false;
        }
        k = !k;
    }
}

//全选、全不选--同为多选框
function all_select_1(che){
    for(var i=0;i<input.length;i++){
        input[i].checked = che;
    }
}

//    反选
function fan_select(){
    for(var i=0;i<input.length;i++){
        if(input[i].checked == true){
            input[i].checked = false;
        }else{
            input[i].checked = true;
        }
    }
    k = !k;
}

//    多条数据删除提示
function delete_duo(){
    var id_arr = new Array();
    var j = 0;
    for(var i=0;i<input.length;i++) {
        if(input[i].checked == true){
            id_arr[j] = input[i].value;
            j++;
        }
    }
    if(id_arr.length ==0){
        alert("还没有选择数据");
        return false;
    }else{
        return confirm("确定要删除id = "+id_arr+"的数据吗？");
    }
}