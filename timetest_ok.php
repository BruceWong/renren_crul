<?php

/****

****/


//$time="3秒前";
//$time="1小时20分钟30秒前";
//$time="今天 20:11";
//$time="昨天 20:11";
//$time="8-11 20:11";
$time="1998   8-11 20:11";
//$time="2011  8-11 20:11";
echo "未换算前的时间是：<br>".$time."<p>";
//function getTime($time){	
	if(preg_match("/前/",$time,$arr)){
		echo "ok1<br>";
        $time=str_replace('前', ' ago', $time);//用ago替换，并且“空格”好
        $time=str_replace('秒', 'seconds', $time);//替换为英文
        $time=str_replace('分钟', 'minutes', $time);//替换为英文
        $time=str_replace('小时', 'hours', $time);//替换为英文
	    $time=strtotime("$time");
	}elseif(preg_match("/今天/",$time,$arr)){
		echo "ok2<br>";        
		$time=str_replace("今天", "today ",$time);//多个空格，以免连接在一起
		$time=strtotime($time);	
	}elseif(preg_match("/昨天/",$time,$arr)){
		echo "ok3<br>";
        $time=str_replace('昨天', 'yesterday', $time);
		$time=strtotime("yesterday.$time");
		//判断是否存在年份
	}elseif(!preg_match("/200/",$time,$arr) && !preg_match("/201/",$time,$arr) &&  !preg_match("/199/",$time,$arr)){
		echo "ok4<br>";
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		//没有年份，则视为”今年“，替换为”this year“
		$time="this year ".$time;
		$time=strtotime($time);
    }else{
		echo "ok5<br>";
        //$time="2011 8-11 20:11";
		//需要把年份后面的第一个空格替换成”/“，以连接起日期。
		$time=preg_replace("/\s+/",'/',$time,1);
		//echo $time."<p>";
		//preg_replace("/\s+/","-",$title)
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		$time=strtotime($time);
	}
			
//}
echo "换算好的整型时间是：<br>".$time."<p>";

echo "<hr>";


echo "今天是".date("Ymd")."<p>";

echo "现在的整型时间是".strtotime("now")."<br>";
echo "今天时间是".strtotime("today")."<br>";
echo "1小时前时间是".strtotime("1 hours ago")."<br>";
echo "今天20点时间是".strtotime("today 20:00")."<br>";
echo "昨天20点时间是".strtotime("yesterday 20:00")."<br>";
echo "今年8月15日20点时间是".strtotime("this year 8/15 20:00")."<br>";
echo "今年8月15日20点时间是".strtotime("2011/8/15 20:00")."<br>";//-不能输出
echo "昨天时间是".strtotime("yesterday")."<br>";
echo "明天的时间是".strtotime("+1 day")."<br>";
echo "1分钟前时间是".strtotime("-1minutes")."<p>";
echo "2000年9月10日时间是".strtotime("10 September 2000")."<br>";
echo "2000年9月10日时间是".strtotime("2000/9/10 00:00")."<br>";//需要格式化年月日，才能输出
echo "下周时间是".strtotime("+1 week")."<br>";
echo "再过9天4小时2秒时间是".strtotime("+1 week 2 days 4 hours 2 seconds")."<br>";
echo "下周四".strtotime("next Thursday")."<br>";
echo "上周一时间是".strtotime("last Monday")."<p>";

echo "2011.06.26 00:00:01整型时间是".strtotime(str_replace('.', '/', '2011.06.26 00:00:01'))."<br>";
echo "2011.06.26 00:00:01整型时间是".strtotime(str_replace('.', '', '2011.06.26 00:00:01'))."<p>";

echo "<hr>";
//50秒前、52分钟前、今天 13:58、昨天 21:05、08月11日 22:32、1小时前
//“前”替换为-，
//如果存在“前”字，则给时间变量加“-”负号；
//如果存在“今天”、“昨天”，则
//如果只是采集到“08-15 15:03”，并且没有年份，则需要补充“this year”，同时把“-”改成“/”
//如果只是采集到“2011 08-15 15:03”，则只需要把“-”改成“/”即可


?>