<?php
	date_default_timezone_set("Asia/Shanghai");
	require('lib/Spider.php');
	require('lib/Baidu.php');

	$file_id = fopen("logs/visited.logs", "a+");
	$visited_id = explode("\r\n",file_get_contents("logs/visited.logs"));
	
	$words = array();
	$words_num = sizeof(scandir("words/"))-2;
	for ($i=0; $i < $words_num; $i++) { 
		$words[$i] = str_replace("\r\n", "[br]", file_get_contents("words/".($i+1).".txt")) ;
	}
	$spider = new Spider("剑网3");//贴吧名字
	$baidu = new  Baidu("");//cookie

	while (true) {
		$id = $spider->getCardId($spider->getPageContents(1));
		for ($i=1; $i < sizeof($id); $i++) {
			if (array_search($id[$i], $visited_id,false)) 
			 	continue;
			$content= array("kw"=>"剑网3",//贴吧名字
						"fid"=>"1185508",//贴吧id
						"tid"=>"$id[$i]",
						"mouse_pwd"=>"36,34,33,58,35,35,46,46,31,39,58,38,58,39,58,38,58,39,58,38,58,39,58,38,58,39,58,38,31,39,37,32,47,34,36,31,39,47,36,38,58,39,38,46,38,",//mouse_pwd
						"content"=>$words[rand(0,$words_num-1)]."[br][br]————————来自伟大的PHP，PHP是世界上最好的语言！",//内容
						"tbs"=>$baidu->getTBS()->tbs);
			$return = $baidu->reply($content);
			if ($return->err_code == 0) {
				echo "$id[$i] success! \r\n";
				$visited_id[sizeof($visited_id)] = $id[$i];
				fwrite($file_id, "$id[$i]\r\n");
			}
			else
				print_r($return);

			sleep(10);
		}
	}
	


?>