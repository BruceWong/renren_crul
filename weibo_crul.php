<?php

<?php
$username =base64_encode("xxxxxx@sina.com"); 
$data = file_get_contents('http://login.sina.com.cn/sso/prelogin.php?entry=miniblog&callback=&user='.$username.'&client=ssologin.js(v1.3.16)');
$json = json_decode($data);
$pw = strtolower(sha1(strtolower(sha1(strtolower("111111"))).$json->servertime.$json->nonce));
$CookieFile = '/sinacookie/'.$username.'_sinacookie.tmp';        
$post_data = array(
        "entry"=>"weibo",
        "gateway"=>"1",
        "from"=>"",
        "savestate"=>"7",
        "useticket"=>"1",
        "ssosimplelogin"=>"1",
        "username"=>$username, // base 64之后的用户名
        "service"=>"miniblog",
        "servertime"=>$json->servertime, //上步得到的服务器时间
        "nonce"=>$json->nonce, //上步得到随机生成的字符串
        "pwencode"=>"wsse",
        "password"=>$pw, //加密的密码
        "encoding"=>"utf-8",
        "url"=>"+ HttpUtility.UrlEncode('http:'//'weibo.com/ajaxlogin.php?framelogin=1&callback=parent.sinaSSOController.feedBackUrlCallBack')",
        "returntype"=>"META"
);         
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://login.sina.com.cn/sso/login.php?client=ssologin.js(v1.3.16)");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
curl_setopt($ch, CURLOPT_COOKIEJAR, $CookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $CookieFile);
curl_exec($ch);
curl_close($ch);
?>

?>