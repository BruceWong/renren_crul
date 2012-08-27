<?php

/****
如何打包为一个功能？


//$time="3秒前";
//$time="1小时20分钟30秒前";
//$time="今天 20:11";
$time="昨天 20:11";
//$time="8-11 20:11";
//$time="1998   8-11 20:11";
//$time="2011  8-11 20:11";
echo "未换算前的时间是：<br>".$time."<p>";

//class TIME{

****/

function getStrtotime($time){	
	if(preg_match("/前/",$time,$arr)){
		echo "ok1<br>";
        $time=str_replace('前', ' ago', $time);//用ago替换，并且前面预留“空格”
        $time=str_replace('秒', 'seconds', $time);//替换为英文
        $time=str_replace('分钟', 'minutes', $time);//替换为英文
        $time=str_replace('小时', 'hours', $time);//替换为英文
	    $strtotime=strtotime("$time");
	}elseif(preg_match("/今天/",$time,$arr)){
		echo "ok2<br>";        
		$time=str_replace("今天", "today ",$time);//多个空格，以免连接在一起
		$strtotime=strtotime($time);	
	}elseif(preg_match("/昨天/",$time,$arr)){
		echo "ok3<br>";
        $time=str_replace('昨天', 'yesterday', $time);
		$strtotime=strtotime("yesterday.$time");
		//判断是否存在年份
	}elseif(!preg_match("/200/",$time,$arr) && !preg_match("/201/",$time,$arr) &&  !preg_match("/199/",$time,$arr)){
		echo "ok4<br>";
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		//没有年份，则视为”今年“，前面加上”this year “
		$time="this year ".$time;
		$strtotime=strtotime($time);
    }else{
		echo "ok5<br>";
        //$time="2011 8-11 20:11";
		//需要把年份后面的第一个空格替换成”/“，以连接起日期。
		//转义字符”\s“，表示包含空白区域如回车、换行、分页等[\f\n\r]
		$time=preg_replace("/\s+/",'/',$time,1);
		//echo $time."<p>";
		//preg_replace("/\s+/","-",$title)
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		$strtotime=strtotime($time);

		//其他转义：
		//转义字符”\d“，表示所有数字[0-9]
		//转义字符”\B“，表示所有数字以外的[^0-9]
		//转义字符”\w“，表示包含所有英文字符[a-zA-Z]
		//转义字符”\W“，表示包含所有英文字符[^a-zA-Z]
	}

	return $strtotime;
			
}
//}
//echo "换算好的整型时间是：<br>".$time."<p>";

//$file = get_url_content("http://www.hao123.com",'f');

  
//$time = new TIME;  

//$time="3秒前";
//$time="1小时20分钟30秒前";
//$time="今天 20:11";
//$time="昨天 13:47";
//$time="8-11 20:11";
//$arr[14][$key]="1998   8-11 20:11";
//$time="1998   8-11 20:11";
//$time="2011  8-11 20:11";
$time="08-19 20:44";
echo "未换算前的时间是：<br>".$time."<p>";

$strtotime = getStrtotime($time);  

//$arr[14][$key]= $time;
  
echo "换算好的整型时间是：<br>".$strtotime."<p>";


/***

$str="<div style='background:blue'>i  j  k</div> "; 
$pat="/(<div[^>]*>)(.*)(<\/div>)/iU"; 
function rep($arr){
	return $arr[1].preg_replace("/ /","&nbsp;",$arr[2]).$arr[3];
} 
$str=preg_replace_callback($pat,rep,$str); 
echo $str;

***/
?>