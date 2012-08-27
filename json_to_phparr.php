<?php
include('json.class.php');

$json_str = "[{0:{s_id:'1999',name:'元素'},1:{s_id:'2049',name:'时韵'},2:{s_id:'2050',name:'里程'},3:{s_id:'2051',name:'CIVIC'},4:{s_id:'2927',name:'pilot'},5:{s_id:'2857',name:'insight'},6:{s_id:'2904',name:'S2000'}}]";

$json = new MY_JSON();

echo $json_str;
echo '<hr><pre>';
var_dump($json->decode($json_str));
echo '</pre><hr>';
?>