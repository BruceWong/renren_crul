


<?php
/*
 * praview v1.0
 * Programmer : bruce_xie@qq.com (54981216)
 * www.praview.com Develop a project PHP - MySQL - Apache
 * Window 7 - Preferences - PHPeclipse - PHP - Code Templates
 */


 /*

   $con=file_get_contents("http://roll.news.sina.com.cn/s/channel.php?ch=05#col=30&spec=&type=&ch=05&k=&offset_page=0&offset_num=0&num=60&asc=&page=2");
   //$con.=file_get_contents("http://roll.news.sina.com.cn/s/channel.php?ch=05#col=30&spec=&type=&ch=05&k=&offset_page=0&offset_num=0&num=60&asc=&page=3");
   //$con.=file_get_contents("http://roll.news.sina.com.cn/s/channel.php?ch=05#col=30&spec=&type=&ch=05&k=&offset_page=0&offset_num=0&num=60&asc=&page=4");
   //$con.=file_get_contents("http://roll.news.sina.com.cn/s/channel.php?ch=05#col=30&spec=&type=&ch=05&k=&offset_page=0&offset_num=0&num=60&asc=&page=5");
   //$con.=file_get_contents("http://roll.news.sina.com.cn/s/channel.php?ch=05#col=30&spec=&type=&ch=05&k=&offset_page=0&offset_num=0&num=60&asc=&page=6");

   //echo $con;

   /*
   $preg = "#<li><span class=\"c_tit\"><a href=\"(.*)\" target=\"_blank\">(.*)</a></span>#iUs";
   //print_r($arr);
   //a href=\"(.*)\"此处不能用单引号，因为目标内容是双引号，所以需要转义。
   

   $preg = "#<li><span class=\"c_tit\"><a href=\"(.*)\" target=\"_blank\">(.*)</a></span><span class=\"c_time\">(.*)</span></li>#iUs";
   //增加采集时间，共3项：url、新闻标题、时间

   preg_match_all($preg,$con,$arr);

   //print_r($arr);

   foreach($arr[1] as $id=>$value){
	   //echo $value."<br>";
	   //echo $value."  ".$arr[2][$id]."  ".$arr[3][$id]."<br>";
	   //echo "<a href=".$value.">".$arr[2][$id]."  ".$arr[3][$id]."</a><br>";
	   echo "<a href=vi.php?url=".$value.">".$arr[2][$id]."  ".$arr[3][$id]."</a><br>";
	   //如此，新浪新闻即可在本地显示全文内容。
   }
   */   


   /*   

   if(@ $_GET['id']<=20){
	   $con=file_get_contents("http://roll.news.sina.com.cn/s/channel.php?ch=05#col=30&spec=&type=&ch=05&k=&offset_page=0&offset_num=0&num=60&asc=&page=".$_GET['id']."");

	   $preg = "#<li><span class=\"c_tit\"><a href=\"(.*)\" target=\"_blank\">(.*)</a></span><span class=\"c_time\">(.*)</span></li>#iUs";
       //增加采集时间，共3项：url、新闻标题、时间

	   preg_match_all($preg,$con,$arr);

	   foreach($arr[1] as $id=>$value){
		   echo "<a href=vi.php?url=".$value.">".$arr[2][$id]."  ".$arr[3][$id]."</a><br>";
	   //如此，新浪新闻即可在本地显示全文内容。
	   }

	   @ $_GET['id']++;
	   echo "<script>location.href='ls.php?id=".$_GET['id']."'</script>";
	   //通过javascript进行跳转，页面不会死掉，而php则可能。

	   


   }
   */


   /*  

   include_once("conn.php");

   //if(@ $_GET['id']<=20){
	   @ $con=file_get_contents("http://roll.news.sina.com.cn/s/channel.php?ch=05#col=30&spec=&type=&ch=05&k=&offset_page=0&offset_num=0&num=60&asc=&page=".$_GET['id']."");
	   
	   $preg = "#<li><span class=\"c_tit\"><a href=\"(.*)\" target=\"_blank\">(.*)</a></span><span class=\"c_time\">(.*)</span></li>#iUs";
	   
	   preg_match_all($preg,$con,$arr);
	   
	   foreach($arr[1] as $id=>$value){
		   $sql="INSERT INTO `tmp_url` (`id`, `title`, `url`, `time`) VALUES (NULL, '".$arr[2][$id]."', '".$value."', '".$arr[3][$id]."');";	
		   mysql_query($sql);
	   }
	   1.服务器传输编码是否是UTF-8
	   2，PHP页面编码设置是否UTF-8
	   3。IDE编码环境是否为UTF-8
	   4.数据库连接时，是否有UTF-8的设置。
	   5。数据库安装时是否设置编码为UTF-8 
	   */


   include_once("conn.php");

   if(@ $_GET['id']<=5 && @ $_GET['id']){
	   @ $con=file_get_contents("http://roll.news.sina.com.cn/s/channel.php?ch=05#col=30&spec=&type=&ch=05&k=&offset_page=0&offset_num=0&num=60&asc=&page=".$_GET['id']."");
	   
	   $preg = "#<li><span class=\"c_tit\"><a href=\"(.*)\" target=\"_blank\">(.*)</a></span><span class=\"c_time\">(.*)</span></li>#iUs";
	   
	   preg_match_all($preg,$con,$arr);
	   
	   foreach($arr[1] as $id=>$value){
		   $sql="INSERT INTO `tmp_url` (`id`, `title`, `url`, `time`) VALUES (NULL, '".$arr[2][$id]."', '".$value."', '".$arr[3][$id]."')";	
		   mysql_query($sql);
	   }

	   @ $_GET['id']++;
	   echo "正在采集列表……".$_GET['id'];
	   echo "<script>location.href='ls.php?id=".$_GET['id']."'</script>";
   }else{
	   echo "采集完毕！";
   }









?>
