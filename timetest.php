<?php

/****
echo mktime(0, 0, 0, 9, 18, 2011)."\n";
echo mktime(0, 0, 0, 9, 25, 2011)."\n";

echo "time()��ʾ������ʱ����:" . date("Y-m-d H:i:s",time(now))."\n";
//������ʱ,����һ����ʾ
echo "time()ֻ��ʾ�����գ�".date("Y-m-d",time(now))."\n"; //ֻ��ʾ������

echo "ʱ�����ʽ����".date("Y-m-d H:i:s",1297845628)."\n"; //ֱ��ʹ��ʱ���

function getTime($date) { 
 $mon=array( 'Jan'=>1,'Feb'=>2,'Mar'=>3,'Apr'=>4,'May'=>5,'June'=>6,'July'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12 ); 
$m=substr($date,0,strpos($date,'/')); 
$good=str_replace($m,$mon[$m],$date); 
// �������ε�ʱ���returnstrtotime($good); 
} 

$str=strtotime("2012-03-09 10:49:56");  
echo date("Y-m-d H:i:s",$str)  

�����ݿ�ʱ��time()����ȡʱ�䲢�洢��
��ȡ���ݿ��ʱ����date����ȡ��������date("Y-m-d H:i:s",$time)��

ע��ʱ����time()��ȡ������һ���������������������ݿ�
��ʾע��ʱ���ʱ����date("Y-m-d H:i:s", time())����ʾ��2010-09-15 10:30:01��ʽ

****/

echo "������".date("Ymd")."<p>";

echo strtotime("now")."<br>";
echo "����ʱ����".strtotime("today")."<p>";
echo "����ʱ����".strtotime("yesterday")."<p>";
echo "1����ǰʱ����".strtotime("-1minutes")."<p>";
echo strtotime("10 September 2000")."<br>";
echo "�����ʱ����".strtotime("+1 day")."<br>";
echo "����ʱ����".strtotime("+1 week")."<br>";
echo "�ٹ�9��4Сʱ2��ʱ����".strtotime("+1 week 2 days 4 hours 2 seconds")."<br>";
echo "������".strtotime("next Thursday")."<br>";
echo "����һʱ����".strtotime("last Monday")."<br>"."<br>";

echo strtotime(str_replace('.', '/', '2011.06.26 00:00:01'))."<br>"."<br>";
echo strtotime(str_replace('.', '', '2011.06.26 00:00:01'))."<p>";

//50��ǰ��52����ǰ������ 13:58������ 21:05��08��11�� 22:32��1Сʱǰ
//��ǰ���滻Ϊ-��
//������ڡ�ǰ���֣����ʱ������ӡ�-�����ţ�
//������ڡ����족�������족����

//date("Ymd")
function getTime($time){
	if(preg_match("/ǰ/",$time,$ar)){
		$time="-".$time; //��ǰ���ֱ为��
        str_replace('ǰ', '', $time);//ɾ����ǰ����
        str_replace('��', 'seconds', $time);//�滻ΪӢ��
        str_replace('����', 'minutes', $time);//�滻ΪӢ��
        str_replace('Сʱ', 'hours', $time);//�滻ΪӢ��
	    $time=strtotime("$time");
		return $time;
		}
	if(preg_match("/����/",$time,$ar)){
        str_replace('���� ', '����', $time);//ɾ���ո����˺����пո�
        str_replace('����', '', $time);//ɾ�������족
	    $time=$time.":00";//��������
	    $time=strtotime(str_replace(':', '', 'date("Ymd").$time'));
		return $time;
	}
	if(preg_match("/����/",$time,$ar)){
        str_replace('���� ', '����', $time);//ɾ���ո����˺����пո�
        str_replace('����', '', $time);//ɾ�������족�����˺����пո�
	    $time=$time.":00";//��������
	    $time=strtotime(str_replace(':', '', 'date("Ymd").$time'));
	    $time=$time-86400;//��ȥһ���������������������
		return $time;
	}
}

$time="���� 11:44";
echo $time->getTime($time);
	   
/**
       //52����ǰ������ 13:58������ 21:05��08��11�� 22:32��1Сʱǰ
	   //strtotime("now")."<br>";
	   $time=$arr[14][$key];
	   if (preg_match("/ǰ/",$arr[14][$key]��$matche)){
		   //���뻻��seconds�����ӱ��minutes����Сʱ����hours�����ֲ���
		   //���컻�ɽ�������ͣ�Ȼ�������ʾ��ʱ�䣻
		   //���컻����������ͣ�Ȼ�������ʾ��ʱ�䣻
		   str_replace('.', '', '2011.06.26 00:00:01')
		   $arr[14][$key]=strtotime("-1 week 2 days 4 hours 2 seconds");
	   }

**/


/****
php��ȷƥ�����ں�ʱ��
2009-09-20 16:02
д������Ҫ,ƥ����֤:
xxxx-xx-xx xx:xx
���ں�ʱ��ĺ�����.
��������ʽ�ֹ�д�˸�:

/^[0-9]{4}-([1-9]|(0[1-9])|(1[0-2]))-([1-9]|(0[1-9])|([1-2][0-9])|3[0-1])\s([1-9]|(0[1-9])|(1[0-9])|(2[0-3])):([1-9]|(0[1-9])|([1-5][0-9]))$/

ʡȥpear���������ģ����鷳.

$strSQL = "select count(*) from ties where tdate = '".date('Y-m-d',strtotime('-1day'))."'";
$strSQL = "select count(*) from ties where tdate = '".date('Y-m-d',time() - 86400)."'"; 
//��ǰʱ�����ȥһ�������86400



//ʱ���ת����
$date_time_array = getdate(1297845628); //1311177600  1316865566
$hours = $date_time_array["hours"];
$minutes = $date_time_array["minutes"];
$seconds = $date_time_array["seconds"];
$month = $date_time_array["mon"];
$day = $date_time_array["mday"];
$year = $date_time_array["year"];

echo "year:$year\nmonth:$month\nday:$day\nhour:$hours\nminutes:$minutes\nseconds:$seconds\n";

$date_time_array = getdate (time()); 
echo $date_time_array[ "weekday"]; 

****/



?>