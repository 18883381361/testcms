/**
 * 
 */
 window.onload=function(){
 	//数字分页样式
 	var div=document.getElementById('page');
 	var a=div.getElementsByTagName('a')
 	var input=div.getElementsByTagName('input');
 	for(i=0;i<a.length;i++){
 		if(input[0].title==a[i].innerHTML){
 			a[i].className="pageList";
 		}
 	}
 }
 //选择头像
 function selectFace(){
 	var fm=document.getElementsByName('add')[0];
 	var index=fm.face.selectedIndex;
 	var img=fm.img;
 	img.src='images/'+fm.face.options[index].value;

 }
 //是否显示logo链接
 function link(type){
 	var fm=document.friendlink;
 	var logo=document.getElementById('logo');
 	if(fm.type.value==1){
 		logo.style.display='none';
 	}else{
 		logo.style.display='block';
 	}
 }
  //刷新验证码
 function freshCode(){
 	var code=document.getElementById('code');
 	code.src="config/code.php?"+Math.random();
 };
 //验证新增评论表单
 function checkCommend(){
 	var fm=document.commend;
	//评论是否为空
	if(fm.content.value==""){
		alert('评论内容不得为空哈');
		return false;
	}
	//是否大于255位
	if(fm.content.value.length>255){
		alert('评论内容不得大于255位哈');
		return false;
	}
	//验证码
	if(fm.code.value.length!=4){
		alert('验证码必须是4位哈');
		return false;
	}
 	return true;
 };
 
 //验证新增会员表单
 function checkUserAdd(){
 	var fm=document.add;
	//用户名是否为空
	if(fm.username.value==""){
		alert('用户名不得为空哈');
		return false;
	}
	//是否小于2为
	if(fm.username.value.length<2){
		alert('用户名不得小于2位哈');
		return false;
	}
	//是否大于20位
	if(fm.username.value.length>20){
		alert('用户名不得大于20位哈');
		return false;
	}
	//密码是否为空
	if(fm.password.value==""){
		alert('密码不得为空哈');
		return false;
	}
	//密码是否小于6为
	if(fm.password.value.length<6){
		alert('密码不得小于6位哈');
		return false;
	}
	//验证密码和密码确认是否一致
	if(fm.password.value!=fm.notpassword.value){
		alert('密码和密码确认必须一致哈');
		return false;
	}
	//邮箱不得为空
	if(fm.email.value==""){
		alert('邮箱不得为空哈');
		return false;
	}
	//验证邮箱格式
	if(!/^(\w)+@([\w\.]+)$/.test(fm.email.value)){
 			alert('邮件格式不正确哈');
 			fm.email.focus();
 			fm.email.value='';
 			return false;
 	}
	//验证码
	if(fm.code.value.length!=4){
		alert('验证码必须是4位哈');
		return false;
	}
 	return true;
 };
 
 //验证登录会员表单
 function checkLogin(){
 	var fm=document.login;
	//用户名是否为空
	if(fm.username.value==""){
		alert('用户名不得为空哈');
		return false;
	}
	//是否小于2为
	if(fm.username.value.length<2){
		alert('用户名不得小于2位哈');
		return false;
	}
	//是否大于20位
	if(fm.username.value.length>20){
		alert('用户名不得大于20位哈');
		return false;
	}
	//密码是否为空
	if(fm.password.value==""){
		alert('密码不得为空哈');
		return false;
	}
	//密码是否小于6为
	if(fm.password.value.length<6){
		alert('密码不得小于6位哈');
		return false;
	}
	//验证码
	if(fm.code.value.length!=4){
		alert('验证码必须是4位哈');
		return false;
	}
 	return true;
 };