var text=[];
text['1']={
'thumb':'/testcms/UPDIR20160412/20160412213553169.png',
'link':'http://www.360.com'
};
text['2']={
'thumb':'/testcms/UPDIR20160412/20160412192151241.png',
'link':'http://www.sina.com.cn'
};
var i=Math.floor(Math.random()*2+1);
document.write('<a class="adv" href="'+text[i].link+'" target="_blank">'+'<img src="'+text[i].thumb+'"></img>'+"</a>");