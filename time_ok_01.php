<?php

/****
��δ��Ϊһ�����ܣ�


//$time="3��ǰ";
//$time="1Сʱ20����30��ǰ";
//$time="���� 20:11";
$time="���� 20:11";
//$time="8-11 20:11";
//$time="1998   8-11 20:11";
//$time="2011  8-11 20:11";
echo "δ����ǰ��ʱ���ǣ�<br>".$time."<p>";

//class TIME{

****/

function getStrtotime($time){	
	if(preg_match("/ǰ/",$time,$arr)){
		echo "ok1<br>";
        $time=str_replace('ǰ', ' ago', $time);//��ago�滻������ǰ��Ԥ�����ո�
        $time=str_replace('��', 'seconds', $time);//�滻ΪӢ��
        $time=str_replace('����', 'minutes', $time);//�滻ΪӢ��
        $time=str_replace('Сʱ', 'hours', $time);//�滻ΪӢ��
	    $strtotime=strtotime("$time");
	}elseif(preg_match("/����/",$time,$arr)){
		echo "ok2<br>";        
		$time=str_replace("����", "today ",$time);//����ո�����������һ��
		$strtotime=strtotime($time);	
	}elseif(preg_match("/����/",$time,$arr)){
		echo "ok3<br>";
        $time=str_replace('����', 'yesterday', $time);
		$strtotime=strtotime("yesterday.$time");
		//�ж��Ƿ�������
	}elseif(!preg_match("/200/",$time,$arr) && !preg_match("/201/",$time,$arr) &&  !preg_match("/199/",$time,$arr)){
		echo "ok4<br>";
		$time=str_replace('.', '/', $time);
		$time=str_replace('-', '/', $time);
		//û����ݣ�����Ϊ�����ꡰ��ǰ����ϡ�this year ��
		$time="this year ".$time;
		$strtotime=strtotime($time);
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
		$strtotime=strtotime($time);

		//����ת�壺
		//ת���ַ���\d������ʾ��������[0-9]
		//ת���ַ���\B������ʾ�������������[^0-9]
		//ת���ַ���\w������ʾ��������Ӣ���ַ�[a-zA-Z]
		//ת���ַ���\W������ʾ��������Ӣ���ַ�[^a-zA-Z]
	}

	return $strtotime;
			
}
//}
//echo "����õ�����ʱ���ǣ�<br>".$time."<p>";

//$file = get_url_content("http://www.hao123.com",'f');

  
//$time = new TIME;  

//$time="3��ǰ";
//$time="1Сʱ20����30��ǰ";
//$time="���� 20:11";
//$time="���� 13:47";
//$time="8-11 20:11";
//$arr[14][$key]="1998   8-11 20:11";
//$time="1998   8-11 20:11";
//$time="2011  8-11 20:11";
$time="08-19 20:44";
echo "δ����ǰ��ʱ���ǣ�<br>".$time."<p>";

$strtotime = getStrtotime($time);  

//$arr[14][$key]= $time;
  
echo "����õ�����ʱ���ǣ�<br>".$strtotime."<p>";


/***

$str="<div style='background:blue'>i  j  k</div> "; 
$pat="/(<div[^>]*>)(.*)(<\/div>)/iU"; 
function rep($arr){
	return $arr[1].preg_replace("/ /","&nbsp;",$arr[2]).$arr[3];
} 
$str=preg_replace_callback($pat,rep,$str); 
echo $str;

***/
?>