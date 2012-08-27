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
$praview_url=$matches[1];



//带上cookie文件，访问人人网首页自动转向后的地址（不同用户url地址不同）
$ch = curl_init($praview_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
$contents = curl_exec($ch);
curl_close($ch);



	   

/**



$preg = "#<article id=\"(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark="" data-source=\"(.*)\" data-stype=\"(.*)\" data-fid=\"(.*)\">
    <a stats=\"(.*)\" href=\"(.*)\"
       namecard=\"(.*)\" title=\"(.*)\" target=\"_blank\">

       <img src=\"(.*)\" width=\"50\" alt=\"头像\" title=\"(.*)\" /></a></figure>
</aside><h3><a target=\"_blank\" namecard=\"(.*)\" href=\"(.*)\" stats=\"(.*)\">(.*)</a>&nbsp;<img src=\"(.*)\" title=\"(.*)\"/>&nbsp;<span class=\"action\">(.*)</span></h3><div class=\"content\">(.*)</a></div><div class=\"content-main\"><p class=\"title\"><a stats=\"(.*)\" href=\"(.*)\" target=\"_blank\">(.*)</a></p>(.*)</div>
    </div></div><div class=\"details\">
  <div class=\"legend\">
    <span class=\"duration\">(.*)</span>#iUs";

preg_match_all($preg,$contents,$arr);

print_r ($arr);



$preg = "#<article id=\"(.*)\" class="a-feed a-n-feed"><aside><figure class="newsfeed-user" data-id=\"(.*)\" data-name=\"(.*)\" data-mark="" data-source=\"(.*)\" data-stype=\"(.*)\" data-fid=\"(.*)\">
    <a stats=\"(.*)\" href=\"(.*)\"
       namecard=\"(.*)\" title=\"(.*)\" target="_blank">

       <img src=\"(.*)\" width="50" alt="头像" title=\"(.*)\" /></a></figure>
</aside><h3><a target="_blank" namecard=\"(.*)\" href=\"(.*)\" stats=\"(.*)\">(.*)</a>&nbsp;<img src=\"(.*)\" title=\"(.*)\"/>&nbsp;<span class="action">(.*)</span></h3><div class="content">(.*)</a></div><div class="content-main"><p class="title"><a stats=\"(.*)\" href=\"(.*)\" target="_blank">(.*)</a></p>(.*)</div>
    </div></div><div class="details">
  <div class="legend">
    <span class="duration">(.*)</span>#iUs";


**/


//清理cookie文件
unlink($cookie_file);

//输出人人网首页的内容
print_r($contents);


?>