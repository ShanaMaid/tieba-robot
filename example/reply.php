<?php
	require('../lib/Baidu.php');
	$baidu = new  Baidu($cookie,$name);//账户cookie，贴吧名字
	$content= array(
					"tid"=>"",
					"content"=>"伟大的PHP，PHP是世界上最好的语言！"//内容
					);
	$baidu->reply($content);
?>