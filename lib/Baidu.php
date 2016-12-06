<?php 
	class Baidu
	{
		private $cookie; //账号cookie
		private $name; //贴吧名字
		private $fid; //贴吧id
		function __construct($cookie,$name)
		{
			$this->cookie = $cookie;
			$this->name = $name;
			$this->fid = $this->getfid();
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
			$data = "ie=utf-8&files=[]&__type__=reply&mouse_pwd_isclick=0&vcode_md5=&kw=".$this->name."&fid=".$this->fid."&tid=".$arr["tid"]."&rich_text=1&floor_num=0&mouse_pwd_t=".time()."&mouse_pwd=".$this->getmouse_pwd().time()."0&content=".$arr["content"]."&tbs=".$this->getTBS()->tbs;
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

		public function getfid(){
			$handle =fopen('http://tieba.baidu.com/f?kw='.$this->name, "r");
			$content = stream_get_contents($handle,-1,-1);
			preg_match("/PageData.forum = {(.|\n)*?}/", $content,$fid);
			preg_match("/[0-9]{7}/", $fid[0],$fid);
			return $fid[0];
		}


		public function getPageContents($page){
			$handle =fopen('http://tieba.baidu.com/f?kw='.$this->name.'&ie=utf-8&pn='.$page*50, "r");
			if ($handle) {
				$content = stream_get_contents($handle,-1,-1);
				return $content;
			}
			else{
				return -1;
			}
		}

		public function getCardId($page){
			$content = $this->getPageContents($page);
			$id = "/\/p\/[0-9]{10}\" title/";
			if(preg_match_all($id, $content,$content)){
				for ($i=0; $i <sizeof($content[0]) ; $i++){
					$content[0][$i] = str_replace("/p/","", $content[0][$i]);
					$content[0][$i] = str_replace("\" title","", $content[0][$i]);
				}
				return  array_merge(array_unique($content[0]),array());
			}
			else
				return -1;
		}

		public function setCookie($cookie)
		{
			$this->cookie = $cookie;
		}
	}