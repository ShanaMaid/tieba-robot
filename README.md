#  tieba-robot
百度贴吧机器人！自动回复帖子

## 说明               
lib/xxx.php 函数库
example/  一些例子      
err_code.md 记录一些返回值的错误信息             

 


## Baidu.php

###  Constructor
$baidu = new Baidu($cookie);

### $baidu->getTBS(),获取tbs
返回形式：
{"tbs":"c361372910cd57ef1478325339","is_login":1}      

$baidu->getTBS()->tbs  c361372910cd57ef1478325339   
$baidu->getTBS()->is_login 1               1代表cookie正确，用户登录成功！       

###  $baidu->sign() 签到
$baidu->sign();


###  $baidu->reply($arr) 回复帖子

```
$content= array(
				"tid"=>"4887240082",//帖子id
				"content"=>"伟大的PHP，PHP是世界上最好的语言！"//内容
				);
```
* #### Warning!帖子必须是对应贴吧的帖子才能发帖成功！  

###  $baidu->post($arr) 发帖子

```
$content= array(
				"title"=>"PHP强！无敌！",//帖子题目
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
  

### $baidu->getPageContents($page)                
$content = $spider->getPageContents(1); //获取第一页内容  获取失败返回-1 成功返回str!   

### $baidu->getCardId($page);        
$id = $spider->getCardId(1); //获取第一页帖子id 获取失败返回-1 成功返回id数组!            


