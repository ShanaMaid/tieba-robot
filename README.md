#  tieba-robot
百度贴吧机器人！自动回复帖子

## 说明
logs/visited.logs 用于存放已经回复过的帖子，即回复过的帖子不会再回复      
words/xxx.txt   用于存放回复的句子，每次回复随机抽取一个              
lib/xxx.php 函数库     
err_code.md 记录一些返回值的错误信息             

example.php 一个例子，填入你的百度账号的cookies后运行会发帖！  
```
<?php
	require('lib/Baidu.php');

	$baidu = new  Baidu("");//cookie
	$content= array("name"=>"剑网3",//贴吧名字
					"tid"=>"4887240082",
					"content"=>"伟大的PHP，PHP是世界上最好的语言！"//内容
					);
	$baidu->reply($content);

?>
```

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
$content= array("name"=>"剑网3",//贴吧名字
				"tid"=>"4887240082",//帖子id
				"content"=>"伟大的PHP，PHP是世界上最好的语言！"//内容
				);
```

### $baidu->getmouse_pwd()  
获取mouse_pwd  

### $baidu->getfid($name)  $name 贴吧名字
获取贴吧fid  

### $baidu->setCookie($cookie)  
修改cookie  

[如何获取这些数据，如fid！点击](https://github.com/ShanaMaid/baidu-tieba-api/blob/master/content/reply.md)      
  



## Spider.php
### Constructor
$spider = new Spider("剑网3");//贴吧名字    

### $spider->getPageContents($page)                
$content = $spider->getPageContents(1); //获取第一页内容  获取失败返回-1 成功返回str!   

### $spider->getCardId($content);        
$id = $spider->getCardId($spider->getPageContents(1)); //获取id 获取失败返回-1 成功返回id数组!            


