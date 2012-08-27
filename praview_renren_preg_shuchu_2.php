<?php
$login_url = 'http://www.renren.com/PLogin.do';

$post_fields['email'] = 'xahuo@yahoo.com.cn';
$post_fields['password'] = 'brucexie7392';
$post_fields['origURL'] = 'http://www.renren.com';
$post_fields['domain'] = 'renren.com';
//cookie文件存放在网站根目录的temp文件夹下
$cookie_file = tempnam('./temp','cookie');

$ch = curl_init($login_url);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
curl_exec($ch);
curl_close($ch);

//带上cookie文件，访问人人网首页
$send_url='http://www.renren.com/home';
$ch = curl_init($send_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
//一定要有下面这段代码，否则，$contents=1，而不是完整页面内容
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
$contents = curl_exec($ch);
curl_close($ch);

//echo "<p/>".$contents;
//获得转向url地址
preg_match("<a href=\"(.*)\">",$contents,$matches);
//preg_match("/<meta\s*http-equiv=\"refresh\"\s*content=\"0;\s*url=(.*?)\">/is",$content, $matches)
$praview_url = $matches[1];



//带上cookie文件，访问人人网首页自动转向后的地址（不同用户url地址不同）
$ch = curl_init($praview_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
$contents = curl_exec($ch);
curl_close($ch);



//正则需要的内容：内容博主、博主头像、博主url、文章标题、文章url、发布时间
//#为开始符号和结束符号，i为区分大小写，U为贪婪匹配，s为去除回车

$preg = "#<article id=\"newsfeed-(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=\"(.*)\" href=\"(.*)\"\n       namecard=(.*)>\n\n       <img src=\"(.*)\" width=(.*)><p class=\"title\"><a stats=\"(.*)\" href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";


preg_match_all($preg,$contents,$arr);


//print_r ($arr);


//error_reporting(0);

include_once("conn.php");
   //foreach($arr[1] as $id=>$value){
   foreach($arr[1] as $key=>$v){
	   echo "第".$key."组<br>";
	   echo "博主id是：".$arr[2][$key]."<br>";
	   echo "博主名称是：".$arr[3][$key]."<br>";
	   echo "博主主页url地址：".$arr[6][$key]."<br>";
	   echo "博主头像地址：".$arr[8][$key]."<br>";
	   echo "文章url地址：".$arr[11][$key]."<br>";
	   echo "文章标题：".$arr[12][$key]."<br>";
	   echo "发布时间：".$arr[14][$key]."<p/>";

	   //需要判断数据库里面是否已经有相同信息了，有则不插入
	   //1、通过判断内容id是否相同【需要对不同的内容商进行标记，如人人前加rr】：最准确
	   //？、通过判断时间戳，相同时间戳，不采集。【不准确，因为可能同一时间戳有多个内容】

	   

	   //strtotime("now")."<br>";
	   
/**
	   //奇怪问题：会循环到第0-14组，而实际只有2-5组有结果
	   //不应该用value去遍历，而是应该先获得有几列数组结果，再根据结果进行遍历
	   //？如何让程序自动判断并循环得到的仅有结果，而不是空循环。
	   //报错：Undefined offset: 
	   //?原因：你的数组中没有下标为1的项. php中数组第一个元素的下标为0
	   //下标数量未知，导致循环不严谨！

	   //但是，理论上是没错的：
	   //遍历，$id是$arr中的键值[说明是默认的]，$v则是$id相对应的数组值。
	   //解决方法，在94行$arr上加下标:$arr[1]
	   //遍历$arr[1]，并不表示要输出$arr[1]，只是作为一个判断标准，否则无法判断有几个数组。
**/

	   $sql="INSERT INTO `praview_renren`(`id`, `content_id`, `bozhu`, `bozhu_url`, `touxiang_url`, `article_title`, `article_url`, `time`) VALUES ('','".$arr[2][$key]."','".$arr[3][$key]."','".$arr[6][$key]."','".$arr[8][$key]."','".$arr[12][$key]."','".$arr[11][$key]."','".$arr[14][$key]."')";	
	   mysql_query($sql);
   }



/**

//时间需要换算成整型才能入库
strtotime -- 将任何英文文本的日期时间描述解析为 Unix 时间戳
echo strtotime("now"), "\n";
echo strtotime("10 September 2000"), "\n";
echo strtotime("+1 day"), "\n";
echo strtotime("+1 week"), "\n";
echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
echo strtotime("next Thursday"), "\n";
echo strtotime("last Monday"), "\n";


//时间戳转日期
$date_time_array = getdate(1297845628); //1311177600  1316865566
$hours = $date_time_array["hours"];
$minutes = $date_time_array["minutes"];
$seconds = $date_time_array["seconds"];
$month = $date_time_array["mon"];
$day = $date_time_array["mday"];
$year = $date_time_array["year"];

echo "year:$year\nmonth:$month\nday:$day\nhour:$hours\nminutes:$minutes\nseconds:$seconds\n";

 
/*
time();
是获得当前时间,但获得的是一整型


//

//完全ok
$preg = "#<article id=\"newsfeed-(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=\"(.*)\" href=\"(.*)\"\n       namecard=(.*)>\n\n       <img src=\"(.*)\" width=(.*)><p class=\"title\"><a stats=\"(.*)\" href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";


//完全ok
<article id="newsfeed-(.*不需要的内容1)" class="a-feed a-n-feed"><aside><figure class="newsfeed-user" data-id=\"(.*博主id2)\" data-name=\"(.*博主名称3)\" data-mark=(.*不需要的内容4)>\n    <a stats="(.*不需要的内容5)" href=\"(.*博主主页url6)\"\n       namecard=(.*不需要的内容7)>\n\n       <img src=\"(.*博主头像url地址8)\" width=(.*不需要的内容9)><p class="title"><a stats="(.*不需要的内容10)" href=\"(.*文章链接url地址11)\" target="_blank">(.*文章标题12)</a></p><p class=(.*不需要的内容13)</p></div>\n    </div></div><div class="details">\n  <div class="legend">\n    <span class="duration">(.*发布时间14)</span>
	   
//ok1
<article id="newsfeed-(.*不需要的内容1)" class="a-feed a-n-feed"><aside><figure class="newsfeed-user" data-id=\"(.*博主id2)\" data-name=\"(.*博主名称3)\" data-mark=(.*不需要的内容4)>\n    <a stats="(.*不需要的内容5)" href=\"(.*博主主页url6)\"\n       namecard=(.*不需要的内容7)>\n\n       <img src=\"(.*博主头像8)\" width=(.*不需要的内容9) href=\"(.*文章链接url地址10)\" target="_blank">(.*文章标题11)</a></p><p class=(.*不需要的内容12)</p></div>\n    </div></div><div class="details">\n  <div class="legend">\n    <span class="duration">(.*发布时间13)</span>

//ok
$preg = "#<article id=\"newsfeed-(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=\"(.*)\" href=\"(.*)\"\n       namecard=(.*)>\n\n       <img src=\"(.*)\" width=(.*) href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";


//ok2
$preg = "#<article id=(.*) data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=(.*) href=\"(.*)\"\n       namecard=(.*) target=\"_blank\">\n\n       <img src=\"(.*)\" width=(.*)/></a></figure>\n</aside><h3(.*)href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";




**/


//清理cookie文件
unlink($cookie_file);

//输出人人网首页的内容
//print_r($contents);


?>