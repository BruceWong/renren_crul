<?php
/*
-------------------------------------------------------
����΢���ѿ��źܾõ�������һֱ���ṩapi.����Ҳû��������Ӧ�ģ���˷����Լ�д��һ�����������Է��͵�����΢��������ҷ���ϣ���ٷ��ܼ��翪��API����������Ӧ��.

@����:����CURL������΢���ӿ�
@��ʾ:http://demos.fengyin.name/apps/sina-microblog-api.php
@����:����
@����:http://fengyin.name/
@����:2009��11��6�� 17:15:54
@��Ȩ:Copyright (c) ������Ȩ����ת���뱣��ע�ͣ�������Ϊ��Դ����(����Դ����)��
ֻҪ������ MIT licence Э��.���Ϳ������ɵش������޸�Դ���Լ�����������Ʒ.
-------------------------------------------------------
���÷�ʽ:
sendmicroblog([�ʺ�],[����],[����]);
*/
function sendweibo($a, $b, $c) {
    $d = tempnam('./', 'cookie.txt'); //���������ʱ�ļ�����cookie.
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
    unlink($d);//ɾ����ʱ�ļ�.

}
/*
ʹ�÷�ʽ:
sendmicroblog('6045527@qq.com','*************','�Ұ����� - ͨ������API����');
*/
?>