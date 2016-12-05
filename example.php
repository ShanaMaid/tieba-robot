<?php
	require('lib/Baidu.php');

	$baidu = new  Baidu("");//cookie
	$content= array("name"=>"剑网3",//贴吧名字
					"tid"=>"4887240082",
					"content"=>"伟大的PHP，PHP是世界上最好的语言！"//内容
					);
	$baidu->reply($content);

?>