<?php
	require('../lib/Baidu.php');
	$baidu = new  Baidu($cookie,$name);//账户cookie，贴吧名字
	$content= array(
					"title"=>"PHP强！无敌！",
					"content"=>"伟大的PHP，PHP是世界上最好的语言！"//内容
					);
	print_r($baidu->post($content));
?>