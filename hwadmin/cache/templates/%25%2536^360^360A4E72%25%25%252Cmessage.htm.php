<?php /* Smarty version 2.6.13, created on 2011-12-21 06:54:14
         compiled from %2Cmessage.htm */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<title><?php echo $this->_tpl_vars['title']; ?>
_<?php echo $this->_tpl_vars['v_siteName']; ?>
</title>
<meta name="keywords" content="<?php echo $this->_tpl_vars['title']; ?>
,<?php echo $this->_tpl_vars['v_siteName']; ?>
">
<meta name="description" content="<?php echo $this->_tpl_vars['title']; ?>
,<?php echo $this->_tpl_vars['v_siteName']; ?>
">
<LINK rel=stylesheet type=text/css href="/images/Style.css">
<script src="/images/jquery.js" type="text/javascript"></script>
<script src="/images/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$.validator.setDefaults({
	submitHandler: function() { alert("submitted!"); }
});
$(document).ready(function() {
	$("#form1").validate({
		rules: {
		         book_name: "required",
                            book_web: "url:true",
                            book_qq: "digits:true",
                            book_mail:{
				required: true,
				email: true
			},
                            book_title: "required",
                            book_bz: "required"
		},
		messages: {
			book_name: "请输入姓名！",
			book_web: "请输入正确的网址！",
			book_qq: "请输入正确的QQ号！",
			book_mail: {
				required: "请输入E-mail",
				email: "E-mail格式不正确！"
			},
			book_title: "请输入留言主题！",
			book_bz: "请输入留言内容"
		}
	});
});
</script>
</HEAD>
<BODY>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-bottom:10px">
  <tr>
    <td width="241" valign="top" style="background:url(/images/07.jpg) repeat-x top; border:1px solid #BACBDB; background-color:#F0F4FD;">
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sider.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </td> 
    <td width="11">&nbsp;</td>
    <td width="708" valign="top" style="border:1px solid #CED7DF; padding:2px 10px 10px 10px">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(images/r_picbg.gif) bottom left no-repeat; margin-bottom:15px">
      <tr>
        <td width="54%" height="45" class="lm_title"><div style="padding:0px 0px 1px 19px"><?php echo $this->_tpl_vars['title']; ?>
</div></td>
          <td width="46%" align="right"><strong>现在的位置：</strong><a href="/" >首页</a> &gt; <span class="location"><?php echo $this->_tpl_vars['title']; ?>
</span>&nbsp;&nbsp;&nbsp; </td>
      </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><span style="font-family:'新宋体'; line-height:24px">
          
  <div align="center">
    <form action="/message/insert.php" method="post" name="form1" id="form1">
      <br />
      <table width="95%" border="0" cellpadding="0" cellspacing="0" bgcolor="#dddddd" class="hei2">
        <tr>
          <td height="30" colspan="3" bgcolor="#F7F7F7" style="padding-left: 5px"><p align="center"><a><span style="color:#CC0000;">请填写下面的表单给我们留言</span></a></p></td>
        </tr>
        <tr>
          <td height="10" colspan="3" align="right" bgcolor="#FFFFFF"></td>
          </tr>
        <tr>
          <td width="15%" height="30" align="left" bgcolor="#FFFFFF">你的姓名： </td>
          <td height="24" colspan="2" align="left" bgcolor="#FFFFFF" class="pad"><input name="book_name" type="text" id="book_name" class="STYLE3"/>
            &nbsp;&nbsp;* </td>
          </tr>
        <tr>
          <td height="30" align="left" bgcolor="#FFFFFF">你的网页地址： </td>
          <td height="24" colspan="2" align="left" bgcolor="#FFFFFF" class="pad"><input name="book_web" type="url" id="book_web" value="http://" size="30" class="STYLE3"/></td>
          </tr>
        <tr>
          <td height="30" align="left" bgcolor="#FFFFFF">你的QQ： </td>
          <td height="24" colspan="2" align="left" bgcolor="#FFFFFF" class="pad"><input name="book_qq" type="digits" id="book_qq" class="STYLE3"/></td>
          </tr>
        <tr>
          <td height="30" align="left" bgcolor="#FFFFFF">你的EMAIL： </td>
          <td height="24" colspan="2" align="left" bgcolor="#FFFFFF" class="pad"><input name="book_mail" type="email" id="book_mail" class="STYLE3"/>
            &nbsp;&nbsp;* 请仔细填写（如：888888@163.com）</td>
          </tr>
        <tr>
          <td height="30" align="left" bgcolor="#FFFFFF">留言主题： </td>
          <td height="24" colspan="2" align="left" bgcolor="#FFFFFF" class="pad"><input name="book_title" type="text" id="book_title" size="40" class="STYLE3"/>
            &nbsp;&nbsp;* 请仔细填写</td>
          </tr>
        <tr>
          <td height="30" align="left" bgcolor="#FFFFFF">验证码：</td>
          <td height="24" colspan="2" align="left" bgcolor="#FFFFFF" class="pad"><input name="book_code" type="text" id="book_code" size="10" class="STYLE3" />
              <img src="/message/random.php" height="20"/></td>
          </tr>
        <tr>
          <td height="135" align="left" bgcolor="#FFFFFF"><p>留言内容：</p></td>
          <td width="69%" align="left" bgcolor="#FFFFFF">
              <textarea name="book_bz" cols="60" rows="8" id="book_bz" class="STYLE3"></textarea>
              <div valign="middle" ></div> </td>
          <td width="16%" align="left" bgcolor="#FFFFFF">* 请仔细填写</td>
        </tr>
        <tr>
          <td height="10" colspan="3" align="right" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td height="35" colspan="3" align="right" bgcolor="#F7F7F7"><p align="center">
              <input name="submit" type="submit" class="submit" value="提交留言" />
            &nbsp;&nbsp;&nbsp;
            <input name="reset" type="reset" class="submit" value="清除重置" />
          </p></td>
        </tr>
      </table>
      </form>
  </div>
  
        </span></td>
      </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="41" align="right" style="line-height:24px; padding-top:12px"><img src="/images/top.gif" width="40" height="14"></td>
        </tr>
    </table></td>
  </tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</BODY>
</HTML>