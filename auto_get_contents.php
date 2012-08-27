<?php
/*
 * 如下：           方法有点笨
 * 抓取网页内容用 PHP 的正则
 * 用JS每隔5分钟刷新当前页面---即重新获取网页内容
 *
 * 注： $mode中--<title></title>-更改为所需内容（如 $mode = "#<a(.*)</a>#";>获取所有链接）
 *
 * window.location.href="http://localhost/baidu/refesh.php";中的http://localhost/baidu/refesh.php
 * 更改为自己的URL----作用：即刷新当前页面
 *
 * setInterval("ref()",300000);是每隔300000毫秒（即 5 * 60 *1000 毫秒即5分钟）执行一次函数 ref()
 *
 * print_r($arr);输出获得的所有内容 $arr是一个数组 可根据所需输出一部分（如 echo $arr[1][0];）
 * 若要获得所有内容 可去掉
 *   $mode = "#<title>(.*)</title>#";
   if(preg_match_all($mode,$content,$arr)){
	   print_r($arr);
	   echo "<br/>";
	   echo $arr[1][0];
   }
   再加上 echo  $content；
 */



 $url = "http://www.baidu.com"; //目标站
 $fp = @fopen($url, "r") or die("超时");


 $content=file_get_contents($url);
 $mode = "#<title>(.*)</title>#";
 if(preg_match_all($mode,$content,$arr)){
	 //print_r($arr);
	 echo "<br/>";
	 echo $arr[1][0];
 }
 ?>

 <script language="JavaScript" type="text/javascript">
 <--
 function ref(){
	 window.location.href="http://localhost/baidu/refesh.php";
 }
  setInterval("ref()",300000);
  //-->
 </script>