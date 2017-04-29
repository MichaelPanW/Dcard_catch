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
		if($_GET['title']!=""){
			$where="title like '%".utf8_encode($_GET['title'])."%' and ";
		}
		if($_GET['class']!=""){
			$where="classif='".$_GET['class']."' and ";
		}
		$count = D("article")->where($where."status=1")->count();
		$pagwAllA = new \Think\Page($count, 30);
		$pagwAllA->setConfig('prev',"上頁");
		$pagwAllA->setConfig('next',"下頁");
		$pagwAllA->setConfig('theme',"%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%");
		$pageShowA = $pagwAllA->show();
		$article=D("article")->where($where."status=1")->limit($pagwAllA->firstRow,$pagwAllA->listRows)->select();
		foreach ($article as $key => $value) {
			$article[$key]['title']=utf8_decode($value['title']);
			$article[$key]['content']=utf8_decode($value['content']);
			$article[$key]['content']=strip_tags($article[$key]['content']);
			# code...
		}
		//dump($article);
		$this->assign('article',$article);
		$this->assign('pageShowA',$pageShowA);
		$this->display();
	}
	public function show(){
		$article=D("article")->where("id='".$_GET['id']."'")->find();
		if(!$article){
			$this->redirect("Index/index");
		}
			$article['title']=utf8_decode($article['title']);
			$article['content']=utf8_decode($article['content']);
		$this->assign('article',$article);
		$this->display();
	}
}	