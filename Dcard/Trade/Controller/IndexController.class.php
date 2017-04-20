<?php
	namespace Trade\Controller;
	use Think\Controller;
	class IndexController extends GlobalController {
		function _initialize()
		{
			parent::_initialize();
		} 
		
		public function index()
		{
			$classif=D("classif")->where("status=1")->select();
			$this->assign("class",$classif);
			$this->display();
		}
		public function show(){
			$article=D("article")->limit(50)->select();
			foreach ($article as $key => $value) {
				# code...
				echo utf8_decode(($value[title]))."<br>";
			}
		}
	}	