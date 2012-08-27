<?php
/*****
获取新浪微博的信息（缓存版）2011年4月24日



在这篇文章中我将WordPress 博客日志同步到了新浪微博，那么同样的道理也可以将新浪微博的信息更新到本地，如我的微博显示页面：http://loosky.net/?page_id=1579&wptheme=loosky

http://loosky.net/?p=1582

实现步骤：

1、还是需要下载新浪微博的认证文件，并将你的博客和微博进行连接。

需要的相关文件下载：点击下载

2、获取新浪微博的信息，并进行缓存，代码如下：

******/


//获取新浪微博的内容

function get_sina_t($limit = 10,$length=’140′,$before = ‘<li> ‘, $after = ‘</li>’){

$tok = get_option(‘sina_access_token’);
if(!$tok) return;

if(!$json = wp_cache_get(‘sinaWB’, ‘Loosky’)){
$sina_client = new SinaClient(Loosky_AKEY, Loosky_SKEY,$tok['oauth_token'], $tok['oauth_token_secret']);
$sina_profile = $sina_client->verify_credentials();

$u_name = $sina_profile['name'];
$u_id = $sina_profile['id'];
$json = $sina_client->user_timeline($page = 1 , $count = 20 , $uid_or_name =$u_name);

if ($json === false || $json === null){
echo “Error occured”;
return false;
}
if (isset($json['error_code']) && isset($json['error'])){
echo (‘Error_code: ‘.$json['error_code'].’; Error: ‘.$json['error'] );
return false;
}

wp_cache_add(‘sinaWB’,$json, ‘Loosky’);
}

foreach ($json AS $message){
if (!strpos($message['source'],’未通过审核应用’))
{
$message['source'] = strtoupper($message['source']);
}
else
{
$message['source'] = ‘<A HREF=”HTTP://loosky.net” REL=”NOFOLLOW”>自由的风</A>’;
}
$created_at=date(“Y-m-d H:i:s”,strtotime($message['created_at']));
$link = “http://t.sina.com.cn/”.$u_id; //链接
$form = $message['source']; //来源
$w_id=$message['id']; //微博ID
$WB_name=$message['user']['screen_name']; //微博昵称
$WB_id=$message['user']['id']; //用户UID
$url = “http://api.t.sina.com.cn/”.$WB_id.”/statuses/”.$w_id; //根据微博ID和用户ID跳转到单条微博页面

$output .=  $before . ‘<div>’.philnaSubstr($message['text'],$length).’</div><div><span>’.$created_at.’</span><span>来自：’.$form.’</span>原文：<a target=”_blank” href=”‘.$url.’”>’.$WB_name.’</a></div>’.$after;

}
echo $output;
}

//当然了，还得添加一些CSS内容到你的CSS文件：

.mircoblog ul li{border:1px solid #DFDFDF;-moz-border-radius:5px 5px 5px 5px;-webkit-border-radius:5px 5px 5px 5px;list-style-type:none;padding:.5em;margin-bottom:.5em;color:#666;}
.mircoblog ul li .top{margin-bottom:.5em;font-size:14px;}
.mircoblog ul li .mPic{margin-bottom:.5em;}
.mircoblog ul li .mPic img{padding:3px;border:1px solid #E7E7E7;}
.mircoblog ul li .bottom{color:#1E5494;}
.mircoblog span {padding-right:10px;}

//3、新建一个微博的模版页面，调用方法：
/*****
<div class=”content mircoblog”>
<ul>
<?php get_sina_t(20);?>
</ul>
</div>


//4、在后台新建一个页面，使用微博模版即可。

演示：http://loosky.net/?page_id=1579&wptheme=loosky

PS：如果你发现你微博的发布时间跟实际时间有出入，如相差了八个小时，那么你需要在函数中添加一段代码：

date_default_timezone_set(‘PRC’);

这样就正常了。

*****/



?>