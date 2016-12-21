<?php
	require('../lib/Baidu.php');
	$baidu = new  Baidu($cookie,$name);//账户cookie，贴吧名字
	$baidu->sign();
?>