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

print_r ($arr);

/**

	   foreach($arr[1] as $id=>$value){
		   echo "<a href=vi.php?url=".$value.">".$arr[2][$id]."  ".$arr[3][$id]."</a><br>";
	   




	   foreach($arr[1] as $id=>$value){
		   echo "<a href=vi.php?url=".$value.">".$arr[2][$id]."  ".$arr[3][$id]."</a><br>";

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