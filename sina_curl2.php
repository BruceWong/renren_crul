<?php

/** 

PHP CURL模拟登录新浪微博抓取页面内容 基于EaglePHP框架开发，需要的朋友可以参考下。

* CURL请求 
* @param String $url 请求地址 
* @param Array $data 请求数据 
*/ 
function curlRequest($url,$data='',$cookieFile=''){
	$ch = curl_init();
	$option = array(CURLOPT_URL => $url,CURLOPT_HEADER =>0,CURLOPT_RETURNTRANSFER => 1,);

	if($cookieFile){
		$option[CURLOPT_COOKIEJAR] = $cookieFile;
		$option[CURLOPT_COOKIEFILE] = $cookieFile;
		//$option[CURLOPT_COOKIESESSION] = true;
		//$option[CURLOPT_COOKIE] = 'prov=42;city=1';
	}

	if($data){
		$option[CURLOPT_POST] = 1;
		$option[CURLOPT_POSTFIELDS] = $data;
	}
	
	curl_setopt_array($ch,$option);
	$response = curl_exec($ch);
	if(curl_errno($ch) > 0){
		throw_exception("CURL ERROR:$url ".curl_error($ch));
	}

	curl_close($ch);
	return $response; 
}


function login($username,$password){
	if($username && $password){
		$preLoginData = curlRequest('http://login.sina.com.cn/sso/prelogin.php?entry=weibo&callback=sinaSSOController.preloginCallBack&su='.base64_encode($username).'&client=ssologin.js(v1.3.16)','',self::COOKIE_FILE);
		preg_match('/sinaSSOController.preloginCallBack\((.*)\)/',$preLoginData,$preArr);
		$jsonArr = json_decode($preArr[1],true);
		if(is_array($jsonArr)){
			$postArr = array('entry' => 'weibo','gateway' => 1,'from' => '','savestate' => 7,'useticket' => 1,'ssosimplelogin' => 1,'su' =>ase64_encode(urlencode($username)),'service' => 'miniblog','servertime' => $jsonArr['servertime'],'nonce' => $jsonArr['nonce'],'pwencode' => 'wsse','sp' => sha1(sha1(sha1($password)).$jsonArr['servertime'].$jsonArr['nonce']),'encoding' => 'UTF-8','url' => 'http://weibo.com/ajaxlogin.php?framelogin=1&callback=parent.sinaSSOController.feedBackUrlCallBack','returntype' => 'META');
			$loginData = curlRequest('http://login.sina.com.cn/sso/login.php?client=ssologin.js(v1.3.16)',$postArr,self::COOKIE_FILE);
			if($loginData){
				$matchs = array();
				preg_match('/replace\(\'(.*?)\'\)/',$loginData,$matchs);
				$loginResult = curlRequest($matchs[1],'',self::COOKIE_FILE);
				$loginResultArr = array();
				preg_match('/feedBackUrlCallBack\((.*?)\)/',$loginResult,$loginResultArr);
				//$userInfo = json_decode($loginResultArr[1],true);
				//Log::info(var_export($loginResultArr[1]));
			}else{
				throw_exception('Login sina fail.');
			}
		}else{
			throw_exception($preLoginData);
		}
	}else{
		throw_exception('Param error.');
	}
} 

?>