<?php
$login_url = 'http://www.renren.com/PLogin.do';

$post_fields['email'] = 'xxxxx@xxxx';
$post_fields['password'] = 'xxxxx';
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
//获得url转向地址
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



//正则需要的内容：内容、博主、博主头像、博主url、文章标题、文章url、发布时间
//#为开始符号和结束符号，i为区分大小写，U为贪婪匹配，s为去除回车

$preg = "#<article id=\"newsfeed-(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=\"(.*)\" href=\"(.*)\"\n       namecard=(.*)>\n\n       <img src=\"(.*)\" width=(.*)><p class=\"title\"><a stats=\"(.*)\" href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";


preg_match_all($preg,$contents,$arr);

include_once("conn.php");

//采集入库
//1、给数据库添加内容来源标记及匹配原站id
$source="renren";
   
   foreach($arr[1] as $key=>$v){
	   $conid=$key+1;
	   echo "第".$conid."组<br>";
	   echo "文章id是：".$source.$arr[1][$key]."<br>";
	   echo "博主id是：".$source.$arr[2][$key]."<br>";
	   echo "博主名称是：".$arr[3][$key]."<br>";
	   echo "博主主页url地址：".$arr[6][$key]."<br>";
	   echo "博主头像地址：".$arr[8][$key]."<br>";
	   echo "文章url地址：".$arr[11][$key]."<br>";
	   echo "文章标题：".$arr[12][$key]."<br>";
	   echo "发布时间：".$arr[14][$key]."<br>";
	   

	   //2、把采集到的时间换成整型
	   //$time=$arr[14][$key];
	   //include("0_time_to_strtotime.php");//奇怪，不能用这，非要用_once
	   //奇怪，单独测试没问题，但是放到这边来却是不起作用？？？？
	   //问题找到，是因为编码没有存统一，导致采集到的中文识别不了，自然正则不来。
	   include_once("00_time_to_strtotime.php");
	   $strtotime = getStrtotime($arr[14][$key]);
	   echo "整型时间是：".$strtotime."<br>";


       //3、判断内容是否已经采集，如不存在，则执行入库操作
       $rows=mysql_query("SELECT * FROM `praview` WHERE `article_id`='".$source.$arr[1][$key]."'");
	   $a=mysql_num_rows($rows);
	   if($a>0){
		   echo "已经有这条记录了！"."<p>";
	   }else{
		   $sql="INSERT INTO `praview`(`id`, `bozhu_id`, `bozhu`, `bozhu_url`, `touxiang_url`, `article_id`, `article_url`, `article_title`, `time`) VALUES ('','".$source.$arr[2][$key]."','".$arr[3][$key]."','".$arr[6][$key]."','".$arr[8][$key]."','".$source.$arr[1][$key]."','".$arr[11][$key]."','".$arr[12][$key]."','".$strtotime."')"; 		   
		   mysql_query($sql);
		   echo "记录添加成功！"."<p>";
	   }
		   
	 }

//4、问题：如何采集历史内容，而不是主页上显示的少数内容
//5、如何批量采集更多历史内容，实现完成一定任务后自动跳转，以免造成超载。


//清理cookie文件
//unlink($cookie_file);


/**




//

//完全ok 
$preg = "#<article id=\"newsfeed-(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=\"(.*)\" href=\"(.*)\"\n       namecard=(.*)>\n\n       <img src=\"(.*)\" width=(.*)><p class=\"title\"><a stats=\"(.*)\" href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";


//完全ok 01
<article id="newsfeed-(.*不需要的内容1)" class="a-feed a-n-feed"><aside><figure class="newsfeed-user" data-id=\"(.*博主id2)\" data-name=\"(.*博主名称3)\" data-mark=(.*不需要的内容4)>\n    <a stats="(.*不需要的内容5)" href=\"(.*博主主页url6)\"\n       namecard=(.*不需要的内容7)>\n\n       <img src=\"(.*博主头像url地址8)\" width=(.*不需要的内容9)><p class="title"><a stats="(.*不需要的内容10)" href=\"(.*文章链接url地址11)\" target="_blank">(.*文章标题12)</a></p><p class=(.*不需要的内容13)</p></div>\n    </div></div><div class="details">\n  <div class="legend">\n    <span class="duration">(.*发布时间14)</span>
	   
//ok  01
<article id="newsfeed-(.*不需要的内容1)" class="a-feed a-n-feed"><aside><figure class="newsfeed-user" data-id=\"(.*博主id2)\" data-name=\"(.*博主名称3)\" data-mark=(.*不需要的内容4)>\n    <a stats="(.*不需要的内容5)" href=\"(.*博主主页url6)\"\n       namecard=(.*不需要的内容7)>\n\n       <img src=\"(.*博主头像8)\" width=(.*不需要的内容9) href=\"(.*文章链接url地址10)\" target="_blank">(.*文章标题11)</a></p><p class=(.*不需要的内容12)</p></div>\n    </div></div><div class="details">\n  <div class="legend">\n    <span class="duration">(.*发布时间13)</span>

**/

?>