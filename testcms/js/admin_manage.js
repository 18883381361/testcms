/**
 * 
 */
 window.onload=function(){
 	
 	//修改时选定下拉等级
 	var level=document.getElementById('level');
 	var options=document.getElementById('options');
	if(level){
	 	for(i=0;i<options.length;i++){
	 		if(level.value==options[i].value){
	 			options[i].setAttribute('selected','selected');
	 		}
	 	}
	}
	
	//第二级导航样式
 	var title=document.getElementById('title');
 	var ol=document.getElementsByTagName('ol');
 	var a=ol[0].getElementsByTagName('a');
 	//alert(a[0].className);
 	for(i=0;i<a.length;i++){
 		a[i].className = null;
 		if(title.innerHTML==a[i].innerHTML){
 			a[i].className="selected";
 		}
 	}
 	
 	//数字分页样式
 	var div=document.getElementsByTagName('div')[0];
 	var a=div.getElementsByTagName('a')
 	var input=div.getElementsByTagName('input');
 	for(i=0;i<a.length;i++){
 		if(input[0].title==a[i].innerHTML){
 			a[i].className="pageList";
 		}
 	}
 	 	
 };
  //是否显示logo链接
 function link(type){
 	var fm=document.add;
 	var logo=document.getElementById('logo');
 	if(fm.type.value==1){
 		logo.style.display='none';
 	}else{
 		logo.style.display='block';
 	}
 }
 //广告
 function adver(type){
 	var adver=document.getElementById('adver');
 	var advertype=document.getElementById('advertype');
 	var thumb=document.getElementById('url');
 	var img=document.getElementById('showimg');
 	var adv=document.getElementById('adv');
 	if(adv.value==type) return;
 	thumb.value='';
 	img.src='';
 	img.style.display='none';
 	switch(type){
 		case 1:	adver.style.display='none';
 				advertype.innerHTML='';
 				adv.value='1';
 				break;
 		case 2:	adver.style.display='block';
 				advertype.innerHTML="<input type=\"button\" value=\"上传头部广告690x80\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=690*80','upfile','400','200')\" />";
 				adv.value='2';
 				break;
 		case 3:	adver.style.display='block';
 				advertype.innerHTML="<input type=\"button\" value=\"上传侧栏广告270x200\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=270*200','upfile','400','200')\" />";
 				adv.value='3';
 				break;
 	}
 }
  //选择头像
 function selectFace(){
 	var fm=document.getElementsByName('add')[0];
 	var index=fm.face.selectedIndex;
 	var img=fm.img;
 	img.src='../images/'+fm.face.options[index].value;

 }
 //验证权限新增
  function checkPremission(){
 	var fm=document.getElementsByTagName('form')[0]
	 	if(fm.premission_name.value==""){
			alert('权限名称不得为空哈');
			return false;
		}
 		//是否小于2位
		if(fm.premission_name.value.length<2){
			alert('权限名称不得小于2位哈');
			return false;
		}
		//是否大于20位
		if(fm.premission_name.value.length>100){
			alert('权限名称不得大于20位哈');
			return false;
		}
		//导航信息是否大于200位
		if(fm.premission_name.value.length>200){
			alert('权限信息不得大于200位哈');
			return false;
		}
 		return true;
 };
 //验证新增轮广告表单
 function checkAdverAdd(){
 	var fm=document.add;
 	var adv=document.getElementById('adv');
 	if(adv.value=='2' || adv.value=='3'){
		if(fm.thumb.value==""){
			alert('广告图片不得为空哈');
			return false;
		}
 	}
	if(fm.link.value==""){
		alert('链接不得为空哈');
		return false;
	}
	if(fm.title.value==""){
		alert('广告标题不得为空哈');
		return false;
	}
	//是否大于20位
	if(fm.title.value.length>20){
		alert('标题不得大于20位哈');
		return false;
	}
	if(fm.info.value.length>200){
		alert('描述信息不得大于200位哈');
		return false;
	}
 	return true;
 };
 //验证新增轮播图表单
 function checkRotationAdd(){
 	var fm=document.add;
	if(fm.thumb.value==""){
		alert('轮播图不得为空哈');
		return false;
	}
	if(fm.link.value==""){
		alert('链接不得为空哈');
		return false;
	}
	//是否大于20位
	if(fm.title.value.length>20){
		alert('标题不得大于20位哈');
		return false;
	}
	if(fm.info.value.length>200){
		alert('描述信息不得大于200位哈');
		return false;
	}
 	return true;
 };
 
 //验证修改会员表单
 function checkUserUpdate(){
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
	//密码是否小于6为
	if(fm.password.value!='' && fm.password.value.length<6){
		alert('密码不得小于6位哈');
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
 	return true;
 };
 //验证新增管理员表单
 function checkManageAdd(){
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
 	return true;
 };
 
 //验证修改管理员表单
  function checkManageUpdate(){
 	var fm=document.update;
	//用户名是否为空
	if(fm.username.value==""){
		alert('用户名不得为空哈');
		return false;
		fm.username.focus();
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
	//密码是否小于6为
	if(fm.password.value!="" && fm.password.value.length<6){
		alert('密码不得小于6位哈');
		return false;
	}
	//验证密码和密码确认是否一致
	if(fm.password.value!=fm.notpassword.value){
		alert('密码和密码确认必须一致哈');
		return false;
	}
 	return true;
 };
 
 //验证等级
 function checkLevel(){
 	var fm=document.getElementsByTagName('form')[0]
 	fm.onsubmit=function(){
 		if(fm.level.value==""){
 			alert('等级不得为空哈');
 			return false;
 		}
 		//验证是否为数字
 		if(isNaN(fm.level.value)){
 			alert('必须是数字哈');
 			return false;
 		}
 		//是否小于2位
		if(fm.level_name.value.length<2){
			alert('等级名称不得小于2位哈');
			return false;
		}
		//是否大于20位
		if(fm.level_name.value.length>20){
			alert('等级名称不得大于20位哈');
			return false;
		}
		//等级信息是否大于200位
		if(fm.level_info.value.length>200){
			alert('等级信息不得大于200位哈');
			return false;
		}
 		return true;
 	}
 };
 //验证管理员登录
 function checkAdminLogin(){
 	//var fm=document.login;
 	var fm=document.getElementsByTagName('form')[0];
 	//用户名是否为空
	if(fm.admin_name.value==""){
		alert('用户名不得为空哈');
		return false;
	}
	//是否小于2为
	if(fm.admin_name.value.length<2){
		alert('用户名不得小于2位哈');
		return false;
	}
	//是否大于20位
	if(fm.admin_name.value.length>20){
		alert('用户名不得大于20位哈');
		return false;
	}
	//密码是否为空
	if(fm.admin_pass.value==""){
		alert('密码不得为空哈');
		return false;
	}
	//密码是否小于6为
	if(fm.admin_pass.value.length<6){
		alert('密码不得小于6位哈');
		return false;
	}
	//验证码是否是4位
	if(fm.code.value.length<4){
		alert('验证码必须是4位哈');
		return false;
	}
 	return true;
 };
 //刷新验证码
 function freshCode(){
 	var code=document.getElementById('code');
 	code.src="../config/code.php?"+Math.random();
 };
 //验证导航新增
  function checkNav(){
 	var fm=document.getElementsByTagName('form')[0]
	 	if(fm.nav_name.value==""){
			alert('导航名称不得为空哈');
			return false;
		}
 		//是否小于2位
		if(fm.nav_name.value.length<2){
			alert('导航名称不得小于2位哈');
			return false;
		}
		//是否大于20位
		if(fm.nav_name.value.length>20){
			alert('导航名称不得大于20位哈');
			return false;
		}
		//导航信息是否大于200位
		if(fm.nav_info.value.length>200){
			alert('导航信息不得大于200位哈');
			return false;
		}
 		return true;
 };
 
 //居中弹窗
 function centerWindow(url,name,width,height){
 	var left=(screen.width-width)/2;
 	var top=(screen.height-height)/2;
 	window.open(url,name,'width='+width+',height= '+height+',top='+top+',left='+left);
 };
 
 //验证新增文档表单
 function checkContentAdd(){
 	var fm=document.add;
	//标题是否为空
	if(fm.title.value==""){
		alert('标题不得为空哈');
		return false;
	}
	//标题是否小于2为
	if(fm.title.value.length<2){
		alert('标题不得小于2位哈');
		return false;
	}
	//标题是否大于20位
	if(fm.title.value.length>50){
		alert('标题不得大于50位哈');
		return false;
	}
	//栏目是否为空
	if(fm.nav.value==""){
		alert('必须选择一个栏目哈');
		return false;
	}
	//标签是否大于30位
	if(fm.tag.value.length>30){
		alert('标签不得大于30位哈');
		return false;
	}
	if(fm.keyword.value.length>30){
		alert('关键字不得大于30位哈');
		return false;
	}
	if(fm.source.value.length>20){
		alert('文章来源不得大于20位哈');
		return false;
	}
	if(fm.author.value.length>10){
		alert('作者不得大于10位哈');
		return false;
	}
	if(fm.info.value.length>200){
		alert('内容摘要不得大于200位哈');
		return false;
	}
	if(CKEDITOR.instances.TextArea1.getData()==""){
		alert('内容不得为空哈');
		return false;
	}
	if(isNaN(fm.count.value)){
 			alert('浏览次数必须是数字哈');
 			return false;
 	}
 	if(isNaN(fm.gold.value)){
 			alert('金币必须是数字哈');
 			return false;
 	}
 	return true;
 };