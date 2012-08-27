<?php

/****
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

echo "今天是".date("Ymd")."<p>";

echo strtotime("now")."<br>";
echo "今天时间是".strtotime("today")."<p>";
echo "昨天时间是".strtotime("yesterday")."<p>";
echo "1分钟前时间是".strtotime("-1minutes")."<p>";
echo strtotime("10 September 2000")."<br>";
echo "明天的时间是".strtotime("+1 day")."<br>";
echo "下周时间是".strtotime("+1 week")."<br>";
echo "再过9天4小时2秒时间是".strtotime("+1 week 2 days 4 hours 2 seconds")."<br>";
echo "下周四".strtotime("next Thursday")."<br>";
echo "上周一时间是".strtotime("last Monday")."<br>"."<br>";

echo strtotime(str_replace('.', '/', '2011.06.26 00:00:01'))."<br>"."<br>";
echo strtotime(str_replace('.', '', '2011.06.26 00:00:01'))."<p>";

//50秒前、52分钟前、今天 13:58、昨天 21:05、08月11日 22:32、1小时前
//“前”替换为-，
//如果存在“前”字，则给时间变量加“-”负号；
//如果存在“今天”、“昨天”，则

//date("Ymd")
function getTime($time){
	if(preg_match("/前/",$time,$ar)){
		$time="-".$time; //“前”字变负号
        str_replace('前', '', $time);//删除“前”字
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
	    $time=strtotime(str_replace(':', '', 'date("Ymd").$time'));
		return $time;
	}
	if(preg_match("/昨天/",$time,$ar)){
        str_replace('昨天 ', '昨天', $time);//删除空格【人人后面有空格】
        str_replace('昨天', '', $time);//删除“昨天”【人人后面有空格】
	    $time=$time.":00";//加上秒数
	    $time=strtotime(str_replace(':', '', 'date("Ymd").$time'));
	    $time=$time-86400;//减去一天产生的秒数，就是昨天
		return $time;
	}
}

$time="今天 11:44";
echo $time->getTime($time);
	   
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

**/


/****
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

****/



?>