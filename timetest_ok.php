<?php

/****

****/


//$time="3��ǰ";
//$time="1Сʱ20����30��ǰ";
//$time="���� 20:11";
//$time="���� 20:11";
//$time="8-11 20:11";
$time="1998   8-11 20:11";
//$time="2011  8-11 20:11";
echo "δ����ǰ��ʱ���ǣ�<br>".$time."<p>";
//function getTime($time){	
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
        //$time="2011 8-11 20:11";
		//��Ҫ����ݺ���ĵ�һ���ո��滻�ɡ�/���������������ڡ�
		$time=preg_replace("/\s+/",'/',$time,1);
		//echo $time."<p>";
		//preg_replace("/\s+/","-",$title)
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		$time=strtotime($time);
	}
			
//}
echo "����õ�����ʱ���ǣ�<br>".$time."<p>";

echo "<hr>";


echo "������".date("Ymd")."<p>";

echo "���ڵ�����ʱ����".strtotime("now")."<br>";
echo "����ʱ����".strtotime("today")."<br>";
echo "1Сʱǰʱ����".strtotime("1 hours ago")."<br>";
echo "����20��ʱ����".strtotime("today 20:00")."<br>";
echo "����20��ʱ����".strtotime("yesterday 20:00")."<br>";
echo "����8��15��20��ʱ����".strtotime("this year 8/15 20:00")."<br>";
echo "����8��15��20��ʱ����".strtotime("2011/8/15 20:00")."<br>";//-�������
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


?>