<?php
session_start();
 header("Content-Type: text/html; charset=utf-8");
 require_once('config.ini.php');

 $title=$_POST['book_title'];
 $name=$_POST['book_name'];
 $web=$_POST['book_web'];
 $qq=$_POST['book_qq'];
 $mail=$_POST['book_mail'];
 $bz=$_POST['book_bz'];
 $code=$_POST['book_code'];
 $category=6;
 if ($code != $_SESSION['random'] ) {
    echo "<center>请正确填写验证码！</center>";
    exit();
}else{
 //判断留言信息
 if(empty($name)){
     echo "<center>姓名不能为空</center>";
     exit();
 }else{
     if(empty($mail)){
         echo "<center>请填写联系邮箱</center>";
     exit();
     }else{
		 if(empty($title)){
         echo "<center>请填写留言主题</center>";
         exit();
     }else{
        
             if(empty($bz)){
                 echo "<center>留言内容不能为空！</center>";
              exit();
             }
		}
     }
 }
}




 $sql="insert into hw_items (title,shorttitle,category,aimurl,author,source,digest) values ('$title','$name','$category','$web','$qq','$mail','$bz')";
 $result=@mysql_query($sql,$conn)or die(mysql_error());
 if($result){
  
	 echo "<center><font color=red><br><br><br><br>恭喜,留言成功。</font><br>";
     echo "<a href=/>如果3秒后，浏览器没有自动返回，请点击此处返回</a>";
     echo "<meta http-equiv=\"refresh\" content=\"3; url=/\">";
 }else{
	 echo $result;
 }
 ?>