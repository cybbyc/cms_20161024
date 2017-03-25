//window.onload = function(){
		var div = document.getElementById("tab");
		var images = div.getElementsByTagName('img');
		var p = div.getElementsByTagName("p");
		var li = div.getElementsByTagName("li");
		var bnt = div.getElementsByTagName("div");
		var pos = 0;	//用作下标
		var len = images.length;
		
		//图片描述数组
		var arr = Array("第一个图片描述","第二个图片描述","第三个图片描述","第四个图片描述","第五个图片描述","第六个图片描述");
		//自动轮播
		lunbo = setInterval(function(){
			
			for(var i=0;i<li.length;i++){
				li[i].className = "";
				p[0].innerHTML="";
			}
			images[pos].style.display = 'none';
			pos = ++pos;
   			if(pos == len){
   				pos = 0;
   			}
   			li[pos].className = "li";
   			p[0].innerHTML=arr[pos];
			images[pos].style.display = 'inline';
		},2000);
		
		//鼠标移入时停止
		div.onmouseover = function(){
			clearInterval(lunbo);
			//显示左右控件
			bnt[0].className = "left";
			bnt[1].className = "right";
//alert("asdf");
		}
		
		//鼠标移出后继续
		div.onmouseout = function(){
			lunbo = setInterval(function(){
			for(i=0;i<li.length;i++){
				li[i].className = "";
				p[0].innerHTML="";
			}
		
			images[pos].style.display = 'none';
			pos = ++pos;
   			if(pos == len){
   				pos = 0;
   			}
   			li[pos].className = "li";
   			p[0].innerHTML=arr[pos];
			images[pos].style.display = 'inline';
		},2000);
			//左右控件消失
			bnt[0].className = "";
			bnt[1].className = "";
		}
		
		
		//鼠标点击某个点调到对应的图片
		for(i=0;i<li.length;i++){
			li[i].index = i;
			//点击 i=0
			li[i].onclick = function(){
				for(j=0;j<li.length;j++){
					images[j].style.display = 'none';
					li[j].className = "";
					p[0].innerHTML="";
				}
				this.className = "li";
				p[0].innerHTML=arr[this.index];
				images[this.index].style.display = 'inline';
				//点击后把当前的下标赋给pos变量，以便图片从当前图片继续往下轮播
				pos = this.index;
			}
		}
		//点击左控件，图片到上一张
		bnt[0].onclick = function(){
			for(i=0;i<li.length;i++){
				li[i].className = "";
				p[0].innerHTML="";
			}
			images[pos].style.display = 'none';
			//pos=0
			pos = --pos;
			//pos=-1
   			if(pos == -1){
   				pos = len-1;
   			}
   			li[pos].className = "li";
   			p[0].innerHTML=arr[pos];
   			images[pos].style.display = 'inline';
		}

		//点击右控件，图片到下一张
		bnt[1].onclick = function(){
			for(i=0;i<li.length;i++){
				li[i].className = "";
				p[0].innerHTML="";
			}
			images[pos].style.display = 'none';
			pos = ++pos;
   			if(pos == len){
   				pos = 0;
   			}
   			li[pos].className = "li";
   			p[0].innerHTML=arr[pos];
   			images[pos].style.display = 'inline';
		}
	
	//}