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

include_once("conn.php");

//给数据库添加内容来源标记及匹配原站id
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
	   
/**
	   //把采集到的时间换成整型
	   //$time=$arr[14][$key];
	   if(preg_match("/前/",$arr[14][$key],$arr)){
		   echo "ok1<br>";
		   $arr[14][$key]=str_replace('前', ' ago', $arr[14][$key]);//用ago替换，并且“空格”好
		   $arr[14][$key]=str_replace('秒', 'seconds', $arr[14][$key]);//替换为英文
		   $arr[14][$key]=str_replace('分钟', 'minutes', $arr[14][$key]);//替换为英文
		   $arr[14][$key]=str_replace('小时', 'hours', $arr[14][$key]);//替换为英文
		   $arr[14][$key]=strtotime("$arr[14][$key]");
	   }elseif(preg_match("/今天/",$arr[14][$key],$arr)){
		   echo "ok2<br>";        
		   $arr[14][$key]=str_replace("今天", "today ",$arr[14][$key]);//多个空格，以免连接在一起
		   $arr[14][$key]=strtotime($arr[14][$key]);	
	   }elseif(preg_match("/昨天/",$arr[14][$key],$arr)){
		   echo "ok3<br>";
           $arr[14][$key]=str_replace('昨天', 'yesterday', $arr[14][$key]);
		   $arr[14][$key]=strtotime("yesterday.$arr[14][$key]");
		   //判断是否存在年份
	   }elseif(!preg_match("/200/",$arr[14][$key],$arr) && !preg_match("/201/",$arr[14][$key],$arr) &&  !preg_match("/199/",$arr[14][$key],$arr)){
		   echo "ok4<br>";
		   $arr[14][$key]=str_replace('.', '/', $arr[14][$key]);
		   $arr[14][$key]=str_replace('-', '/', $arr[14][$key]);
		   //没有年份，则视为”今年“，替换为”this year“
		   $arr[14][$key]="this year ".$arr[14][$key];
		   $arr[14][$key]=strtotime($arr[14][$key]);
       }else{
		   echo "ok5<br>";
		   $arr[14][$key]=str_replace('.', '/', $arr[14][$key]);
		   $arr[14][$key]=str_replace('-', '/', $arr[14][$key]);
		   $arr[14][$key]=strtotime($arr[14][$key]);
	   }
	   //$arr[14][$key]=$time;
***/

       //判断内容是否已经采集，如不存在，则执行入库操作
       $rows=mysql_query("SELECT * FROM `praview_renren` WHERE `article_id`='".$source.$arr[1][$key]."'");
	   $a=mysql_num_rows($rows);
	   if($a>0){
		   echo "已经有这条记录了！"."<p>";
	   }else{
		   $sql="INSERT INTO `praview_renren`(`id`, `bozhu_id`, `bozhu`, `bozhu_url`, `touxiang_url`, `article_id`, `article_url`, `article_title`, `time`) VALUES ('','".$source.$arr[2][$key]."','".$arr[3][$key]."','".$arr[6][$key]."','".$arr[8][$key]."','".$source.$arr[1][$key]."','".$arr[11][$key]."','".$arr[12][$key]."','".$arr[14][$key]."')"; 		   
		   mysql_query($sql);
		   echo "添加记录成功！"."<p>";
	   }
		   
	 }


//清理cookie文件
unlink($cookie_file);


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