<?php

/****
��δ��Ϊһ�����ܣ�

****/


//$time="3��ǰ";
//$time="1Сʱ20����30��ǰ";
//$time="���� 20:11";
$time="���� 20:11";
//$time="8-11 20:11";
//$time="1998   8-11 20:11";
//$time="2011  8-11 20:11";
echo "δ����ǰ��ʱ���ǣ�<br>".$time."<p>";
//function getTime($time){	
	if(preg_match("/ǰ/",$time,$arr)){
		echo "ok1<br>";
        $time=str_replace('ǰ', ' ago', $time);//��ago�滻������ǰ��Ԥ�����ո�
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
		//û����ݣ�����Ϊ�����ꡰ��ǰ����ϡ�this year ��
		$time="this year ".$time;
		$time=strtotime($time);
    }else{
		echo "ok5<br>";
        //$time="2011 8-11 20:11";
		//��Ҫ����ݺ���ĵ�һ���ո��滻�ɡ�/���������������ڡ�
		//ת���ַ���\s������ʾ�����հ�������س������С���ҳ��[\f\n\r]
		$time=preg_replace("/\s+/",'/',$time,1);
		//echo $time."<p>";
		//preg_replace("/\s+/","-",$title)
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		$time=strtotime($time);

		//����ת�壺
		//ת���ַ���\d������ʾ��������[0-9]
		//ת���ַ���\B������ʾ�������������[^0-9]
		//ת���ַ���\w������ʾ��������Ӣ���ַ�[a-zA-Z]
		//ת���ַ���\W������ʾ��������Ӣ���ַ�[^a-zA-Z]
	}
			
//}
echo "����õ�����ʱ���ǣ�<br>".$time."<p>";

?>