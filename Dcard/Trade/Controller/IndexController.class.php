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
	}	