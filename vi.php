


<?php
/*
 * praview v1.0
 * Programmer : bruce_xie@qq.com (54981216)
 * www.praview.com Develop a project PHP - MySQL - Apache
 * Window 7 - Preferences - PHPeclipse - PHP - Code Templates
 */

/*php100��82�ڿ�
 //$con=file_get_contents("http://tech.sina.com.cn/t/2012-05-22/17217147726.shtml");
 @ $con=file_get_contents($_GET['url']);

 //$preg="#<title>(.*)</title>#iUs";
 echo zz("#<title>(.*)</title>#iUs",$con);

 echo zz("#<!-- �������� begin -->(.*)<!-- publish_helper_end -->#iUs",$con);

 //preg_match($preg,$con,$arr);
  //echo $arr[1];

 function zz($preg,$con,$num=1){
	 preg_match($preg, $con, $arr); 
	 return @$arr[$num];
	 //�˴�����@�ϱ���Notice: Undefined offset����֪��ɶԭ��
}
 */

 /****php100��83�ڿ�
 include_once("conn.php");

 $sql="select * from tmp_url limit 10";
 $q=mysql_query($sql);

 while($row=mysql_fetch_array($q)){

	 //echo $row['url']."<br>";

	 @ $con=file_get_contents($_GET['url']);

	 echo zz("#<title>(.*)</title>#iUs",$con);

	 echo zz("#<!-- �������� begin -->(.*)<!-- publish_helper_end -->#iUs",$con);

	 echo "<hr>";

 }

 function zz($preg,$con,$num=1){
	 preg_match($preg, $con, $arr); 
	 return @$arr[$num];
	 //�˴�����@�ϱ���Notice: Undefined offset����֪��ɶԭ��
 }

 ****/
 /****php100��84�ڿ�****/
 include_once("conn.php");

 @ $qid=(int)$_GET['id'];

 $sql="select * from tmp_url whiere id='$qid'";
 $query=mysql_query($sql);
 @ $row=mysql_fetch_array($query);
 //����expects parameter 1 to be resource, boolean given
 //��һ�����û��ִ�гɹ�,
 //���ȷ�ϱ���û��д��Ļ�����Ӧ�������ݿ����ӵ�����
 //���ݿ�û�в�ѯ������������Դ�ӡ��$query��Ӧ��Ϊ�ա�

 //echo $row[0]."<br>".$row[1]."<br>";

 	 @ $con=file_get_contents($row['url']);

	 echo $title="<b>".zz("#<title>(.*)</title>#iUs",$con)."</b>";

	 echo $conts=zz("#<!-- �������� begin -->(.*)<!-- publish_helper_end -->#iUs",$con);

	 $intosql="INSERT INTO 'caiji'.`news`(`id`, `title`, `contents`) VALUES (null,'$title','$conts'";

	 mysql_query($intosql);

	 //============������ʵ�ʲ����ģ��¶��������жϺͻ�ȡ��ַ�õġ�


 $sql2="select * from tmp_url whiere id>'$qid' order by id asc limit 1";
 $query2=mysql_query($sql);
 @ $row2=mysql_fetch_array($query2);
 echo $row2[0]."<br>".$row2[1]."<br>";

 if($row2[0]){
	 echo "<script>location.href='vi.php?id=".$row2[0]."'</script>";
 //��ת���Է���ѭ��������
 }

 
 //while($row=mysql_fetch_array($q)){

	 //echo $row['url']."<br>";

	 //@ $con=file_get_contents($_GET['url']);

	 //echo "<b>".zz("#<title>(.*)</title>#iUs",$con)."</b>";

	 //echo zz("#<!-- �������� begin -->(.*)<!-- publish_helper_end -->#iUs",$con);

	 //echo "<hr>";

 //}

 function zz($preg,$con,$num=1){
	 preg_match($preg, $con, $arr); 
	 return @$arr[$num];
 }




?>
