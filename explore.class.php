<? php
 // 原作者：epsilon7 
//SonyMusic(sonymusic@163.net)  
 class BrowserDetector { 
 var $UA = "";  // $HTTP_USER_AGENT的内容  
 var $BROWSER = " Unknown";  // 浏览器类型  
 var $PLATFORM = " Unknown";  // 操作系统  
 var $VERSION = "";  // 浏览器版本号  
 var $MAJORVER = "";  // 浏览器主版本号  
 var $MINORVER = "";  // 浏览器副版本号  
/*  构造函数开始  */  
 function BrowserDetector(){ 
	$this -> UA = getenv(HTTP_USER_AGENT); 

	$preparens = ""; 
	$parens = ""; 
	$i = strpos($this -> UA,"("); 
	if($i >= 0 ){ 
		$preparens = trim( substr( $this -> UA , 0 , $i )); 
		$parens = substr( $this ->UA,$i+1,strlen($this -> UA)); 
		$j = strpos ($parens,")"); 
		if($j>=0){
			$parens = substr($parens,0,$j); 
		}
	}else{
		$preparens = $this -> UA; 
	} 

	$browVer = $preparens ; 
	$token = trim(strtok($parens,";")); 
	while($token){
		if($token == "compatible") {
		}elseif( preg_match("/MSIE/i","$token")) {
			$browVer   =   $token; 
		}elseif( preg_match("/Opera/i","$token")) {
			$browVer   =   $token ; 
		}elseif(preg_match("/X11/i","$token")||preg_match("/SunOS/i","$token")||preg_match("/Linux/i","$token")){
			$this -> PLATFORM = "Unix";
		}elseif(preg_match("/Win/i","$token")){
			$this -> PLATFORM  = $token;
		}elseif( preg_match ("/Mac/i","$token")||preg_match("/PPC/i","$token")){
			$this -> PLATFORM = $token;
		}
		$token = strtok(";");
	}

	$msieIndex = strpos($browVer,"MSIE");
	if($msieIndex >= 0){
		$browVer = substr($browVer,$msieIndex,strlen($browVer));
	}

	$leftover = "";
	if(substr($browVer,0,strlen("Mozilla")) == "Mozilla"){
		$this -> BROWSER = "Netscape";
		$leftover = substr($browVer,strlen("Mozilla")+1,strlen($browVer));
	}elseif(substr($browVer,0,strlen("Lynx"))=="Lynx"){
		$this -> BROWSER = "Lynx";
		$leftover = substr($browVer,strlen("Lynx")+1,strlen($browVer));
	}elseif(substr($browVer,0,strlen("MSIE"))=="MSIE"){
		$this -> BROWSER = "IE";
		$leftover = substr($browVer,strlen("MSIE")+1,strlen($browVer));
	}elseif(substr($browVer,0,strlen("Microsoft Internet Explorer")) == "Microsoft Internet Explorer"){
		$this -> BROWSER = "IE";
		$leftover = substr($browVer,strlen("Microsoft Internet Explorer")+1,strlen($browVer));
	}elseif(substr($browVer,0,strlen("Opera"))=="Opera"){
		$this -> BROWSER = "Opera";
		$leftover=substr($browVer,strlen("Opera")+1,strlen($browVer));
	} 
	
	$leftover = trim($leftover);
	$i = strpos($leftover,"");
	if($i > 0){
		$this -> VERSION=substr($leftover,0,$i);
	}else{
		$this -> VERSION = $leftover;
	}

	$j = strpos($this -> VERSION,".");
	if($j >= 0){
		$this -> MAJORVER = substr($this -> VERSION,0,$j);
		$this -> MINORVER = substr($this -> VERSION,$j+1,strlen($this -> VERSION));
	}else{
		$this -> MAJORVER = $this -> VERSION;
	} 
} 
}

 // 测试程序开始  
 $test = new  browserdetector; 
 echo   $test -> UA . " <br> " ; 
 echo   $test -> BROWSER . " <br> " ; 
 echo   $test -> PLATFORM . " <br> " ; 
 echo   $test -> VERSION . " <br> " ; 
 echo   $test -> MAJORVER . " <br> " ; 
 echo   $test -> MINORVER . " <br> " ; 
 ?>  
