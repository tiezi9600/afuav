<?php
$conn=@mysql_connect("localhost","root","synergy")or die(mysql_error());
$select_db=@mysql_select_db("afuav",$conn)or die(mysql_error());
mysql_query("set names utf8");
//管理帐户
//$username="admin";
//管理密码
//$password="666666";
//禁止留言间隔时间
$ngs=60;
?>