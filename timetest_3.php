<?php

/****

****/

echo "������".date("Ymd")."<p>";

echo "���ڵ�����ʱ����".strtotime("now")."<br>";
echo "����ʱ����".strtotime("today")."<br>";
echo "1Сʱǰʱ����".strtotime("1 hours ago")."<br>";
echo "����20��ʱ����".strtotime("today 20:00")."<br>";
echo "����20��ʱ����".strtotime("yesterday 20:00")."<br>";
echo "����8��15��20��ʱ����".strtotime("this year 8/15 20:00")."<br>";
echo "����8��15��20��ʱ����".strtotime("this year 8-15 20:00")."<br>";//-�������
echo "����ʱ����".strtotime("yesterday")."<br>";
echo "�����ʱ����".strtotime("+1 day")."<br>";
echo "1����ǰʱ����".strtotime("-1minutes")."<p>";
echo "2000��9��10��ʱ����".strtotime("10 September 2000")."<br>";
echo "2000��9��10��ʱ����".strtotime("2000/9/10 00:00")."<br>";//��Ҫ��ʽ�������գ��������
echo "����ʱ����".strtotime("+1 week")."<br>";
echo "�ٹ�9��4Сʱ2��ʱ����".strtotime("+1 week 2 days 4 hours 2 seconds")."<br>";
echo "������".strtotime("next Thursday")."<br>";
echo "����һʱ����".strtotime("last Monday")."<p>";

echo "2011.06.26 00:00:01����ʱ����".strtotime(str_replace('.', '/', '2011.06.26 00:00:01'))."<br>";
echo "2011.06.26 00:00:01����ʱ����".strtotime(str_replace('.', '', '2011.06.26 00:00:01'))."<p>";

echo "<hr>";
//50��ǰ��52����ǰ������ 13:58������ 21:05��08��11�� 22:32��1Сʱǰ
//��ǰ���滻Ϊ-��
//������ڡ�ǰ���֣����ʱ������ӡ�-�����ţ�
//������ڡ����족�������족����
//���ֻ�ǲɼ�����08-15 15:03��������û����ݣ�����Ҫ���䡰this year����ͬʱ�ѡ�-���ĳɡ�/��
//���ֻ�ǲɼ�����2011 08-15 15:03������ֻ��Ҫ�ѡ�-���ĳɡ�/������

//date("Ymd")
$time="8-11 20:11";
//function getTime($time){	
	//$this->init_conn();
	//$this->name = $name;
    //$this->time = $time;
	//if(ereg("ǰ",$time,$ar)){
	if(preg_match("/ǰ/",$time,$arr)){
		echo "ok1<br>";
        $time=str_replace('ǰ', ' ago', $time);//��ago�滻�����ҡ��ո񡱺�
        $time=str_replace('��', 'seconds', $time);//�滻ΪӢ��
        $time=str_replace('����', 'minutes', $time);//�滻ΪӢ��
        $time=str_replace('Сʱ', 'hours', $time);//�滻ΪӢ��
	    $time=strtotime("$time");
	}elseif(preg_match("/����/",$time,$arr)){
		echo "ok2<br>";        
		$time=str_replace("����", "today ",$time);//����ո�����������һ��
		$time=strtotime($time);	
	}elseif(preg_match("/����/",$time,$arr)){
		echo "ok3<br>";
        $time=str_replace('����', 'yesterday', $time);
		$time=strtotime("yesterday.$time");
		//�ж��Ƿ�������
	}elseif(!preg_match("/200/",$time,$arr) && !preg_match("/201/",$time,$arr) &&  !preg_match("/199/",$time,$arr)){
		echo "ok4<br>";
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		//û����ݣ�����Ϊ�����ꡰ���滻Ϊ��this year��
		$time="this year ".$time;
		$time=strtotime($time);
    }else{
		echo "ok5<br>";
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		$time=strtotime($time);
	}
			

echo "����õ�����ʱ���ǣ�".$time."<p>";

/***

	//���û����ݣ�����ӡ�this year��
	//�ж���ݣ�������1999x��2000x����201x������Ϊ��ݣ���Ϊʱ���С�:�����
	if !(preg_match("/2000/",$time,$arr)) && !(preg_match("/201/",$time,$arr)) && !(preg_match("/199/",$time,$arr)){
		echo "ok4<br>";
        $time=str_replace('����', 'yesterday', $time);
	    $time=strtotime("yesterday.$time");
	}

	
//}
//$time="���� 11:44";
//echo $time->getTime();
***/

//$time="���� 11:44";
//echo $time->getTime($time);
	   
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

//date("Ymd")
function getTime($time){
	
    $time="���� 11:44";
	//if(ereg("ǰ",$time,$ar)){
	if(preg_match("/ǰ/",$time,$ar)){
        str_replace('ǰ', ' ago', $time);//��ago�滻�����ҡ��ո񡱺�
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
	    $time=strtotime('date("Ymd").$time');
	    //$time=strtotime(str_replace(':', '', 'date("Ymd").$time'));
		//����Ҫ�滻����Ϊ�����Ǳ�׼��ʽ����ʱ��Ҳ�Ǳ�׼��ʽ:
		return $time;
	}
	if(preg_match("/����/",$time,$ar)){
        str_replace('���� ', '����', $time);//ɾ���ո����˺����пո�
        str_replace('����', '', $time);//ɾ�������족�����˺����пո�
	    $time=$time.":00";//��������
	    $time=strtotime('date("Ymd").$time');
	    $time=$time-86400;//��ȥһ���������������������
		return $time;
	}
}


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



?>