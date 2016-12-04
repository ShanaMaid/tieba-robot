<?php 
	class Baidu
	{
		private $cookie;
		function __construct($cookie)
		{
			$this->cookie = $cookie;
		}

		public function getTBS(){
			$ch = curl_init("http://tieba.baidu.com/dc/common/tbs");
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);  
			curl_setopt($ch,CURLOPT_COOKIE,$this->cookie); 
			$content = curl_exec($ch); 
			preg_match("/{.*?}/", $content,$result);
			$result = json_decode($result[0]);
			return $result;
		}

		public function reply($arr){
			$ch = curl_init("http://tieba.baidu.com/f/commit/post/add");
			$data = "ie=utf-8&files=[]&__type__=reply&mouse_pwd_isclick=0&vcode_md5=&kw=".$arr["kw"]."&fid=".$arr["fid"]."&tid=".$arr["tid"]."&rich_text=1&floor_num=0&mouse_pwd_t=".time()."&mouse_pwd=".$arr["mouse_pwd"].time()."0&content=".$arr["content"]."&tbs=".$arr["tbs"];
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);  
			curl_setopt($ch,CURLOPT_HEADER,true);  
			curl_setopt($ch,CURLOPT_COOKIE,$this->cookie); 
			curl_setopt($ch, CURLOPT_POST, 1);
		 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$content = curl_exec($ch);
			preg_match("/{.*}/", $content,$result);
			$result = json_decode($result[0]);
			return $result;
		}

		public function getmouse_pwd(){
			$arr = array();
			for ($i=0; $i < 45; $i++) 
				$arr[$i] = rand(30,60).",";
			return join("",$arr);
		}

		public function getfid($name){
			$handle =fopen('http://tieba.baidu.com/f?kw='.$name, "r");
			$content = stream_get_contents($handle,-1,-1);
			preg_match("/PageData.forum = {(.|\n)*?}/", $content,$fid);
			preg_match("/[0-9]{7}/", $fid[0],$fid);
			return $fid[0];
		}

		public function setCookie($cookie)
		{
			$this->cookie = $cookie;
		}
	}