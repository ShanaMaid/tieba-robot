<?php
	class Spider{
		protected $name;
		function __construct($name)
		{
			$this->name = $name;
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

		public function getCardId($content){
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

		public function getSumPage(){

		}

		public function getTargetCard(){

		}

		public function setUrl($name){
			$this->name = $name;
		}

	}

?>