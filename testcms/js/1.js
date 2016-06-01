var text=[];
text['1']={
'title':'西南大学',
'link':'http://www.swu.edu.cn'
};
text['2']={
'title':'百度啊',
'link':'http://www.baidu.com'
};
var i=Math.floor(Math.random()*2+1);
document.write('<a class="adv" href="'+text[i].link+'" target="_blank">'+text[i].title+"</a>");