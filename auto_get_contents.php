<?php
/*
 * ���£�           �����е㱿
 * ץȡ��ҳ������ PHP ������
 * ��JSÿ��5����ˢ�µ�ǰҳ��---�����»�ȡ��ҳ����
 *
 * ע�� $mode��--<title></title>-����Ϊ�������ݣ��� $mode = "#<a(.*)</a>#";>��ȡ�������ӣ�
 *
 * window.location.href="http://localhost/baidu/refesh.php";�е�http://localhost/baidu/refesh.php
 * ����Ϊ�Լ���URL----���ã���ˢ�µ�ǰҳ��
 *
 * setInterval("ref()",300000);��ÿ��300000���루�� 5 * 60 *1000 ���뼴5���ӣ�ִ��һ�κ��� ref()
 *
 * print_r($arr);�����õ��������� $arr��һ������ �ɸ����������һ���֣��� echo $arr[1][0];��
 * ��Ҫ����������� ��ȥ��
 *   $mode = "#<title>(.*)</title>#";
   if(preg_match_all($mode,$content,$arr)){
	   print_r($arr);
	   echo "<br/>";
	   echo $arr[1][0];
   }
   �ټ��� echo  $content��
 */



 $url = "http://www.baidu.com"; //Ŀ��վ
 $fp = @fopen($url, "r") or die("��ʱ");


 $content=file_get_contents($url);
 $mode = "#<title>(.*)</title>#";
 if(preg_match_all($mode,$content,$arr)){
	 //print_r($arr);
	 echo "<br/>";
	 echo $arr[1][0];
 }
 ?>

 <script language="JavaScript" type="text/javascript">
 <--
 function ref(){
	 window.location.href="http://localhost/baidu/refesh.php";
 }
  setInterval("ref()",300000);
  //-->
 </script>