<?php
namespace Trade\Controller;
use Think\Controller;
class AjaxController extends GlobalController {
	function _initialize()
	{
		parent::_initialize();
	} 

	public function index(){
		$this->display();

	}
	public function content()
	{

		$url="https://www.dcard.tw".$_GET['class']."?latest=true";
		$start='"PostEntry_entry_2rsgm" href="';
		$end='"';
		$content=file_get_contents($url);
		$num=1;
		//echo $content;
		while(strpos($content, $start,$num)>0 && strpos($content, $end,$num)>0 && $num>0){

			$retu=$this->search($content,$start,$end,$num);
			if(preg_match("/[0-9]+/", $retu,$match)){
				$data['id']=$match[0];
				$data['url']="https://www.dcard.tw".$retu;
				$data['time']=time();
				$count=D("article")->where("id=".$data['id'])->count();
				if(!$count){
					echo date("Y-m-d H:i:s")."  ".$data['url']."<br>";
					D("article")->data($data)->add();
				}
			}
			$num=strpos($content,$start,strpos($content, $start,$num)+strlen($start));
		}
		$url="https://www.dcard.tw".$_GET['class'];
		$start='"PostEntry_entry_2rsgm" href="';
		$end='"';
		$content=file_get_contents($url);
		$num=1;
		//echo $content;
		while(strpos($content, $start,$num)>0 && strpos($content, $end,$num)>0 && $num>0){

			$retu=$this->search($content,$start,$end,$num);
			if(preg_match("/[0-9]+/", $retu,$match)){
				$data['id']=$match[0];
				$data['url']="https://www.dcard.tw".$retu;
				$data['time']=time();
				$count=D("article")->where("id=".$data['id'])->count();
				if(!$count){
					echo date("Y-m-d H:i:s")."  ".$data['url']."<br>";
					D("article")->data($data)->add();
				}
			}
			$num=strpos($content,$start,strpos($content, $start,$num)+strlen($start));
		}
		echo "<p  style='color:red;'>".$_GET['class']."結束</p><br>";
	}

	public function classif(){


		$url="https://www.dcard.tw/f";
		$start='<ul class="ForumEntryGroup_list_cdSR2"';
		$end='</ul>';
		$content=file_get_contents($url);
		$num=1;

		//echo $content;
		$retu='<ul class="ForumEntryGroup_list_cdSR2"'.$this->search($content,$start,$end)."</ul>";
		echo $retu;
			//dump(strip_tags($retu)); 
		preg_match_all("/\/f\/(\w)+/", $retu,$match);
		preg_match_all("/([\x7f-\xffa-z0-9A-Z]+)<\/a>/",$retu,$amatch);
		foreach ($match[0] as $key => $value) {
			$data[tag]=$value;
			$data[title]=strip_tags("<a>".$amatch[0][$key]);
			dump($data[title]);
			$count=D("classif")->where("tag='".$data[tag]."'")->count();
			if(!$count){
				D("classif")->data($data)->add();

			}else{
				D("classif")->data($data)->where("tag='".$value."'")->save();
			}
		}

		dump($match);
		dump($amatch);
	}

	public function article(){
		$article=D("article")->where("status=0")->select();
		foreach ($article as $key => $value) {
			$url=$value['url'];
			$content=file_get_contents($url);
			$start='"title":"';
			$end='"';
			$data[title]=$this->search($content,$start,$end);

			$data[title]=utf8_encode($data[title]);
			$start='<div class="Post_content_1xpMb"';
			$end='<footer';
			$data[content]='<div class="Post_content_1xpMb"'.$this->search($content,$start,$end);
			//$data[content]=str_replace("'",'"',$data[content]);
			$data[content]=utf8_encode($data[content]);
			$start='"forumName":"';
			$end='"';
			$data[classif]=$this->search($content,$start,$end);
			$data[status]=1;
			@D("article")->where("id=".$value[id])->data($data)->save();

		}
		echo  date("Y-m-d H:i:s")."  <p  style='color:red;'>資料庫重整</p><br>";
	}
	function search($content,$start,$end,$startkey=0){
		$head=$start;
		$end=$end;
		$url= substr($content,
			strpos($content, $head,$startkey)+strlen($head),
			strpos($content,$end,strpos($content, $head,$startkey)+strlen($head))
			-strpos($content, $head,$startkey)-strlen($head));
		return $url;
	}
	function hiddcheck(){

		D("article")->where("hidd=0 and status=1 and url like '%公告%'")->data("status=0")->save();
		$article=D("article")->where("hidd=0 and status=1")->select();
		foreach ($article as $key => $value) {
		$url=$value['url'];

		$content=file_get_contents($url);

		preg_match("/<title data-react-helmet=\"true\">.+<\/title>/",$content,$match);
		if($match[0]=='<title data-react-helmet="true">Dcard</title>'){
			D("article")->data("hidd=1")->where("id=".$value['id'])->save();
		}
		}

	}
}	//http://together.nuucloud.com/index.php/Ajax/article.html