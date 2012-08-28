<?php
//首先设置程序的执行时间为不限制
set_time_limit(0);
//检查是否加载了CURL扩展，如果未加载则退出
!extension_loaded('curl') && exit('CURL扩展未加载，程序终止运行');

//设置登录校内的用户名
define('email','xxxxx@xxxxx');
//设置密码
define('password','xxxxx');
//登录页面
define('LOGIN_PAGE','http://www.renren.com/PLogin.do');
//首页
define('INDEX_PAGE','http://www.renren.com/SysHome.do');
//搜索页面
define('SEARCH_PAGE','http://www.renren.com/275424829');

/**
*
* 向指定的$url提交$request请求，并设置$cookie
*
* @param string $url 
* @param string $request 
* @param string $cookie 
* @return void
*
**/

function makeRequert($url,$request=false,$cookie){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        if($request)curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
}

//登录校内

if(@ !$_COOKIE['cookie_jar']||!is_file($_COOKIE['cookie_jar'])){
                //生成COOKIE文件
                $cookie_jar = tempnam('./tmp','cookie');
                //设置COOKIE
                setcookie('cookie_jar',$cookie_jar);
                //组建请求,打开校内的登录页面查看源代码，会发现需要提交email和password两项
                $request = 'email='.urlencode(email).'&password='.urlencode(password);
                //发起登录请求
                makeRequert(LOGIN_PAGE,$request,$cookie_jar);
}else{
                $cookie_jar = $_COOKIE['cookie_jar'];
}


//访问首页
print makeRequert(INDEX_PAGE,false,$cookie_jar);

/*

//发起搜索,打开校内后，查看源代码，发现搜索好友的功能那里，需要提交一个参数q
//设置参数q,值为test
$request = 'q=test';
print makeRequert(SEARCH_PAGE,$request,$cookie_jar);

*/

//OK,就说到这里吧，剩下的大家自由发挥吧。