var text=[];
text['1']={
'thumb':'/testcms/UPDIR20160412/20160412213203856.png',
'link':'http://www.weibo.com'
};
text['2']={
'thumb':'/testcms/UPDIR20160412/20160412200919546.png',
'link':'http://www.qq.com'
};
var i=Math.floor(Math.random()*2+1);
document.write('<a class="adv" href="'+text[i].link+'" target="_blank">'+'<img src="'+text[i].thumb+'"></img>'+"</a>");