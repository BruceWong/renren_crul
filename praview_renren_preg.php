<?php
$login_url = 'http://www.renren.com/PLogin.do';

$post_fields['email'] = 'xahuo@yahoo.com.cn';
$post_fields['password'] = 'brucexie7392';
$post_fields['origURL'] = 'http://www.renren.com';
$post_fields['domain'] = 'renren.com';
//cookie�ļ��������վ��Ŀ¼��temp�ļ�����
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

//����cookie�ļ���������������ҳ
$send_url='http://www.renren.com/home';
$ch = curl_init($send_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
//һ��Ҫ��������δ��룬����$contents=1������������ҳ������
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
$contents = curl_exec($ch);
curl_close($ch);

//echo "<p/>".$contents;
//���ת��url��ַ
preg_match("<a href=\"(.*)\">",$contents,$matches);
//preg_match("/<meta\s*http-equiv=\"refresh\"\s*content=\"0;\s*url=(.*?)\">/is",$content, $matches)
$praview_url = $matches[1];



//����cookie�ļ���������������ҳ�Զ�ת���ĵ�ַ����ͬ�û�url��ַ��ͬ��
$ch = curl_init($praview_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
$contents = curl_exec($ch);
curl_close($ch);



//������Ҫ�����ݣ����ݲ���������ͷ�񡢲���url�����±��⡢����url������ʱ��
//#Ϊ��ʼ���źͽ������ţ�iΪ���ִ�Сд��UΪ̰��ƥ�䣬sΪȥ���س�

$preg = "#<article id=\"newsfeed-(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=\"(.*)\" href=\"(.*)\"\n       namecard=(.*)>\n\n       <img src=\"(.*)\" width=(.*)><p class=\"title\"><a stats=\"(.*)\" href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";


preg_match_all($preg,$contents,$arr);

print_r ($arr);

/**

	   foreach($arr[1] as $id=>$value){
		   echo "<a href=vi.php?url=".$value.">".$arr[2][$id]."  ".$arr[3][$id]."</a><br>";
	   




	   foreach($arr[1] as $id=>$value){
		   echo "<a href=vi.php?url=".$value.">".$arr[2][$id]."  ".$arr[3][$id]."</a><br>";

//

//��ȫok
$preg = "#<article id=\"newsfeed-(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=\"(.*)\" href=\"(.*)\"\n       namecard=(.*)>\n\n       <img src=\"(.*)\" width=(.*)><p class=\"title\"><a stats=\"(.*)\" href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";


//��ȫok
<article id="newsfeed-(.*����Ҫ������1)" class="a-feed a-n-feed"><aside><figure class="newsfeed-user" data-id=\"(.*����id2)\" data-name=\"(.*��������3)\" data-mark=(.*����Ҫ������4)>\n    <a stats="(.*����Ҫ������5)" href=\"(.*������ҳurl6)\"\n       namecard=(.*����Ҫ������7)>\n\n       <img src=\"(.*����ͷ��url��ַ8)\" width=(.*����Ҫ������9)><p class="title"><a stats="(.*����Ҫ������10)" href=\"(.*��������url��ַ11)\" target="_blank">(.*���±���12)</a></p><p class=(.*����Ҫ������13)</p></div>\n    </div></div><div class="details">\n  <div class="legend">\n    <span class="duration">(.*����ʱ��14)</span>
	   
//ok1
<article id="newsfeed-(.*����Ҫ������1)" class="a-feed a-n-feed"><aside><figure class="newsfeed-user" data-id=\"(.*����id2)\" data-name=\"(.*��������3)\" data-mark=(.*����Ҫ������4)>\n    <a stats="(.*����Ҫ������5)" href=\"(.*������ҳurl6)\"\n       namecard=(.*����Ҫ������7)>\n\n       <img src=\"(.*����ͷ��8)\" width=(.*����Ҫ������9) href=\"(.*��������url��ַ10)\" target="_blank">(.*���±���11)</a></p><p class=(.*����Ҫ������12)</p></div>\n    </div></div><div class="details">\n  <div class="legend">\n    <span class="duration">(.*����ʱ��13)</span>

//ok
$preg = "#<article id=\"newsfeed-(.*)\" class=\"a-feed a-n-feed\"><aside><figure class=\"newsfeed-user\" data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=\"(.*)\" href=\"(.*)\"\n       namecard=(.*)>\n\n       <img src=\"(.*)\" width=(.*) href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";


//ok2
$preg = "#<article id=(.*) data-id=\"(.*)\" data-name=\"(.*)\" data-mark=(.*)>\n    <a stats=(.*) href=\"(.*)\"\n       namecard=(.*) target=\"_blank\">\n\n       <img src=\"(.*)\" width=(.*)/></a></figure>\n</aside><h3(.*)href=\"(.*)\" target=\"_blank\">(.*)</a></p><p class=(.*)</p></div>\n    </div></div><div class=\"details\">\n  <div class=\"legend\">\n    <span class=\"duration\">(.*)</span>#iUs";




**/


//����cookie�ļ�
unlink($cookie_file);

//�����������ҳ������
//print_r($contents);


?>