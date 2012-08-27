
<?php


	   
//$time2="3秒前";
//$time2="1小时20分钟30秒前";
//$time2="今天 20:11";
//$time2="昨天 13:47";
//$time2="8-11 20:11";
//$time2="1998   8-11 20:11";
//$time2="2011  8-11 20:11";
$time2="今天 13:27";

include_once("0_time_to_strtotime.php");

$strtotime = getStrtotime($time2);
	   
echo "整型时间是：".$strtotime."<br>";

?>


