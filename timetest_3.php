<?php

/****

****/

echo "今天是".date("Ymd")."<p>";

echo "现在的整型时间是".strtotime("now")."<br>";
echo "今天时间是".strtotime("today")."<br>";
echo "1小时前时间是".strtotime("1 hours ago")."<br>";
echo "今天20点时间是".strtotime("today 20:00")."<br>";
echo "昨天20点时间是".strtotime("yesterday 20:00")."<br>";
echo "今年8月15日20点时间是".strtotime("this year 8/15 20:00")."<br>";
echo "今年8月15日20点时间是".strtotime("this year 8-15 20:00")."<br>";//-不能输出
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

//date("Ymd")
$time="8-11 20:11";
//function getTime($time){	
	//$this->init_conn();
	//$this->name = $name;
    //$this->time = $time;
	//if(ereg("前",$time,$ar)){
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
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		$time=strtotime($time);
	}
			

echo "换算好的整型时间是：".$time."<p>";

/***

	//如果没有年份，则添加“this year”
	//判断年份，假如有1999x，2000x或者201x，则视为年份，因为时间有“:”标记
	if !(preg_match("/2000/",$time,$arr)) && !(preg_match("/201/",$time,$arr)) && !(preg_match("/199/",$time,$arr)){
		echo "ok4<br>";
        $time=str_replace('昨天', 'yesterday', $time);
	    $time=strtotime("yesterday.$time");
	}

	
//}
//$time="今天 11:44";
//echo $time->getTime();
***/

//$time="今天 11:44";
//echo $time->getTime($time);
	   
/**
       //52分钟前、今天 13:58、昨天 21:05、08月11日 22:32、1小时前
	   //strtotime("now")."<br>";
	   $time=$arr[14][$key];
	   if (preg_match("/前/",$arr[14][$key]，$matche)){
		   //把秒换成seconds、分钟变成minutes，把小时换成hours，数字不变
		   //今天换成今天的整型，然后加上显示的时间；
		   //昨天换成昨天的整型，然后加上显示的时间；
		   str_replace('.', '', '2011.06.26 00:00:01')
		   $arr[14][$key]=strtotime("-1 week 2 days 4 hours 2 seconds");
	   }

//date("Ymd")
function getTime($time){
	
    $time="今天 11:44";
	//if(ereg("前",$time,$ar)){
	if(preg_match("/前/",$time,$ar)){
        str_replace('前', ' ago', $time);//用ago替换，并且“空格”好
        str_replace('秒', 'seconds', $time);//替换为英文
        str_replace('分钟', 'minutes', $time);//替换为英文
        str_replace('小时', 'hours', $time);//替换为英文
	    $time=strtotime("$time");
		return $time;
		}
	if(preg_match("/今天/",$time,$ar)){
        str_replace('今天 ', '今天', $time);//删除空格【人人后面有空格】
        str_replace('今天', '', $time);//删除“今天”
	    $time=$time.":00";//加上秒数
	    $time=strtotime('date("Ymd").$time');
	    //$time=strtotime(str_replace(':', '', 'date("Ymd").$time'));
		//不需要替换，因为日期是标准格式，而时间也是标准格式:
		return $time;
	}
	if(preg_match("/昨天/",$time,$ar)){
        str_replace('昨天 ', '昨天', $time);//删除空格【人人后面有空格】
        str_replace('昨天', '', $time);//删除“昨天”【人人后面有空格】
	    $time=$time.":00";//加上秒数
	    $time=strtotime('date("Ymd").$time');
	    $time=$time-86400;//减去一天产生的秒数，就是昨天
		return $time;
	}
}


php精确匹配日期和时间
2009-09-20 16:02
写程序需要,匹配验证:
xxxx-xx-xx xx:xx
日期和时间的合理性.
用正则表达式手工写了个:

/^[0-9]{4}-([1-9]|(0[1-9])|(1[0-2]))-([1-9]|(0[1-9])|([1-2][0-9])|3[0-1])\s([1-9]|(0[1-9])|(1[0-9])|(2[0-3])):([1-9]|(0[1-9])|([1-5][0-9]))$/

省去pear、类或其它模板的麻烦.

$strSQL = "select count(*) from ties where tdate = '".date('Y-m-d',strtotime('-1day'))."'";
$strSQL = "select count(*) from ties where tdate = '".date('Y-m-d',time() - 86400)."'"; 
//当前时间戳减去一天的秒数86400



//时间戳转日期
$date_time_array = getdate(1297845628); //1311177600  1316865566
$hours = $date_time_array["hours"];
$minutes = $date_time_array["minutes"];
$seconds = $date_time_array["seconds"];
$month = $date_time_array["mon"];
$day = $date_time_array["mday"];
$year = $date_time_array["year"];

echo "year:$year\nmonth:$month\nday:$day\nhour:$hours\nminutes:$minutes\nseconds:$seconds\n";

$date_time_array = getdate (time()); 
echo $date_time_array[ "weekday"]; 




echo mktime(0, 0, 0, 9, 18, 2011)."\n";
echo mktime(0, 0, 0, 9, 25, 2011)."\n";

echo "time()显示年月日时分秒:" . date("Y-m-d H:i:s",time(now))."\n";
//这样连时,分秒一起显示
echo "time()只显示年月日：".date("Y-m-d",time(now))."\n"; //只年示年月日

echo "时间戳格式化：".date("Y-m-d H:i:s",1297845628)."\n"; //直接使用时间戳

function getTime($date) { 
 $mon=array( 'Jan'=>1,'Feb'=>2,'Mar'=>3,'Apr'=>4,'May'=>5,'June'=>6,'July'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12 ); 
$m=substr($date,0,strpos($date,'/')); 
$good=str_replace($m,$mon[$m],$date); 
// 返回整形的时间戳returnstrtotime($good); 
} 

$str=strtotime("2012-03-09 10:49:56");  
echo date("Y-m-d H:i:s",$str)  

存数据库时用time()来获取时间并存储，
读取数据库的时候用date来获取，具体是date("Y-m-d H:i:s",$time)。

注册时间用time()提取，这是一个整形数，将它存入数据库
显示注册时间的时候用date("Y-m-d H:i:s", time())来显示成2010-09-15 10:30:01格式

****/



?>