#  tieba-robot
百度贴吧机器人！自动回复帖子

## 说明
logs/visited.logs 用于存放已经回复过的帖子，即回复过的帖子不会再回复      
words/xxx.txt   用于存放回复的句子，每次回复随机抽取一个              
lib/xxx.php 函数库     
err_code.md 记录一些返回值的错误信息             

example.php 一个例子，填入你的百度账号的cookies后运行会发帖！  

## Baidu.php

###  Constructor
$baidu = new Baidu($cookie);

### $baidu->getTBS(),获取tbs
返回形式：
{"tbs":"c361372910cd57ef1478325339","is_login":1}      

$baidu->getTBS()->tbs  c361372910cd57ef1478325339   
$baidu->getTBS()->is_login 1               1代表cookie正确，用户登录成功！       

###  $baidu->reply($arr) 回复帖子

```
$arr= array("kw"=>"剑网3",//贴吧名字
			"fid"=>"1185508",//贴吧id
			"tid"=>"4886120962",//帖子id eg: http://tieba.baidu.com/p/4886120962     4886120962
			"mouse_pwd"=>"36,34,33,58,35,35,46,46,31,39,58,38,58,39,58,38,58,39,58,38,58,39,58,38,58,39,58,38,31,39,37,32,47,34,36,31,39,47,36,38,58,39,38,46,38,",//mouse_pwd
			"content"=>"some words",//内容
			"tbs"=>$baidu->getTBS()->tbs);
```
[如何获取这些数据，如fid！点击](https://github.com/ShanaMaid/baidu-tieba-api/blob/master/content/reply.md)      
  
### $baidu->setCookie($cookie)
修改cookie


## Spider.php
### Constructor
$spider = new Spider("剑网3");//贴吧名字    

### $spider->getPageContents($page)                
$content = $spider->getPageContents(1); //获取第一页内容  获取失败返回-1 成功返回str!   

### $spider->getCardId($content);        
$id = $spider->getCardId($spider->getPageContents(1)); //获取id 获取失败返回-1 成功返回id数组!            


