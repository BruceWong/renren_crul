


<?php
/*
 * praview v1.0
 * Programmer : bruce_xie@qq.com (54981216)
 * www.praview.com Develop a project PHP - MySQL - Apache
 * Window 7 - Preferences - PHPeclipse - PHP - Code Templates
 */

/*php100第82节课
 //$con=file_get_contents("http://tech.sina.com.cn/t/2012-05-22/17217147726.shtml");
 @ $con=file_get_contents($_GET['url']);

 //$preg="#<title>(.*)</title>#iUs";
 echo zz("#<title>(.*)</title>#iUs",$con);

 echo zz("#<!-- 正文内容 begin -->(.*)<!-- publish_helper_end -->#iUs",$con);

 //preg_match($preg,$con,$arr);
  //echo $arr[1];

 function zz($preg,$con,$num=1){
	 preg_match($preg, $con, $arr); 
	 return @$arr[$num];
	 //此处不加@老报错：Notice: Undefined offset，不知道啥原因
}
 */

 /****php100第83节课
 include_once("conn.php");

 $sql="select * from tmp_url limit 10";
 $q=mysql_query($sql);

 while($row=mysql_fetch_array($q)){

	 //echo $row['url']."<br>";

	 @ $con=file_get_contents($_GET['url']);

	 echo zz("#<title>(.*)</title>#iUs",$con);

	 echo zz("#<!-- 正文内容 begin -->(.*)<!-- publish_helper_end -->#iUs",$con);

	 echo "<hr>";

 }

 function zz($preg,$con,$num=1){
	 preg_match($preg, $con, $arr); 
	 return @$arr[$num];
	 //此处不加@老报错：Notice: Undefined offset，不知道啥原因
 }

 ****/
 /****php100第84节课****/
 include_once("conn.php");

 @ $qid=(int)$_GET['id'];

 $sql="select * from tmp_url whiere id='$qid'";
 $query=mysql_query($sql);
 @ $row=mysql_fetch_array($query);
 //报错：expects parameter 1 to be resource, boolean given
 //这一条语句没有执行成功,
 //如果确认表名没有写错的话，就应该是数据库连接的问题
 //数据库没有查询到东西！你可以打印下$query，应该为空。

 //echo $row[0]."<br>".$row[1]."<br>";

 	 @ $con=file_get_contents($row['url']);

	 echo $title="<b>".zz("#<title>(.*)</title>#iUs",$con)."</b>";

	 echo $conts=zz("#<!-- 正文内容 begin -->(.*)<!-- publish_helper_end -->#iUs",$con);

	 $intosql="INSERT INTO 'caiji'.`news`(`id`, `title`, `contents`) VALUES (null,'$title','$conts'";

	 mysql_query($intosql);

	 //============上面是实际操作的，下段则是作判断和获取地址用的。


 $sql2="select * from tmp_url whiere id>'$qid' order by id asc limit 1";
 $query2=mysql_query($sql);
 @ $row2=mysql_fetch_array($query2);
 echo $row2[0]."<br>".$row2[1]."<br>";

 if($row2[0]){
	 echo "<script>location.href='vi.php?id=".$row2[0]."'</script>";
 //跳转，以防死循环崩溃。
 }

 
 //while($row=mysql_fetch_array($q)){

	 //echo $row['url']."<br>";

	 //@ $con=file_get_contents($_GET['url']);

	 //echo "<b>".zz("#<title>(.*)</title>#iUs",$con)."</b>";

	 //echo zz("#<!-- 正文内容 begin -->(.*)<!-- publish_helper_end -->#iUs",$con);

	 //echo "<hr>";

 //}

 function zz($preg,$con,$num=1){
	 preg_match($preg, $con, $arr); 
	 return @$arr[$num];
 }




?>
