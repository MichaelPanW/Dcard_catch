	<?php
	$url="https://www.dcard.tw/f/pokemon";
	$start='"PostEntry_entry_2rsgm" href="';
	$end='"';
	$content=file_get_contents($url);
	$num=1;
	//echo $content;
	while(strpos($content, $start,$num)>0 && strpos($content, $end,$num)>0 && $num>0){

		search($content,$start,$end,$num);
		$num=strpos($content,$start,strpos($content, $start,$num)+strlen($start));
	}

	function search($content,$start,$end,$startkey=0){
		$head=$start;
		$end=$end;
		$url= substr($content,
			strpos($content, $head,$startkey)+strlen($head),
			 strpos($content,$end,strpos($content, $head,$startkey)+strlen($head))
			-strpos($content, $head,$startkey)-strlen($head));
		echo "<a href='".$url."'>".$url."</a><br><br>";
	}


	?>