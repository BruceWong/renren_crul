<?php
/*
-------------------------------------------------------
新浪微博已开放很久但是无奈一直不提供api.网上也没搜索到相应的，因此风吟自己写了一个函数。可以发送到新浪微博。跟大家分享，希望官方能及早开放API。诞生更多应用.

@名称:基于CURL的新浪微博接口
@演示:http://demos.fengyin.name/apps/sina-microblog-api.php
@作者:风吟
@博客:http://fengyin.name/
@更新:2009年11月6日 17:15:54
@版权:Copyright (c) 风吟版权所有转载请保留注释，本程序为开源程序(开放源代码)。
只要你遵守 MIT licence 协议.您就可以自由地传播和修改源码以及创作衍生作品.
-------------------------------------------------------
调用方式:
sendmicroblog([帐号],[密码],[内容]);
*/
function sendweibo($a, $b, $c) {
    $d = tempnam('./', 'cookie.txt'); //创建随机临时文件保存cookie.
    $ch = curl_init("https://login.sina.com.cn/sso/login.php?username=$a&password=$b&returntype=TEXT");
    curl_setopt($ch, CURLOPT_COOKIEJAR, $d);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, "FengYin");
    curl_exec($ch);
    curl_close($ch);
    unset($ch);
    $ch = curl_init($ch);
    curl_setopt($ch, CURLOPT_URL, "http://t.sina.com.cn/mblog/publish.php");
    curl_setopt($ch, CURLOPT_REFERER, "http://t.sina.com.cn");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "content=".urlencode($c));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $d);
    curl_exec($ch);
    curl_close($ch);
    unlink($d);//删除临时文件.

}
/*
使用方式:
sendmicroblog('6045527@qq.com','*************','我爱新浪 - 通过风吟API发送');
*/
?>