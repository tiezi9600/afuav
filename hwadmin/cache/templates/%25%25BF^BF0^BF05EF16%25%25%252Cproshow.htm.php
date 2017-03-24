<?php /* Smarty version 2.6.13, created on 2012-02-17 13:54:04
         compiled from %2Cproshow.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getcategories', ',proshow.htm', 25, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<title><?php echo $this->_tpl_vars['keywords']; ?>
_<?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="Keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
" />
<meta name="Description" content="<?php echo $this->_tpl_vars['digest']; ?>
" />
<LINK rel=stylesheet type=text/css href="/images/Style.css">
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
    <td width="708" valign="top" style="border:1px solid #CED7DF; padding:2px 10px 10px 10px"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(/images/r_picbg.gif) bottom left no-repeat; margin-bottom:15px">
        <tr>
          <td width="54%" height="45" class="lm_title"><div style="padding:0px 0px 1px 19px"><?php echo $this->_tpl_vars['categoryname']; ?>
</div></td>
          <td width="46%" align="right"><strong>现在的位置：</strong><a href="/" title="<?php echo $this->_tpl_vars['keywords']; ?>
" >首页</a>
<?php echo getcategories(array('id' => $this->_tpl_vars['category'],'template' => "<#ak_if(#)[#id](#)&gt;<a href='[%url]' title='[%category]'>[%category]</a>#>"), $this);?>
&gt; <span class="location">详细介绍            </span>&nbsp;&nbsp;&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><span class="lan12" style="padding-top:15px;padding-bottom:15px;">
            <table width="97%" border="0" align="center" cellpadding="4" cellspacing="0"  >
              <tr>
                <td align="center" bgcolor="#FFFFFF" height="30" style="border-bottom: #E6E6E6 solid 1px;"><div style="font-size:14px; font-weight:bold"><?php echo $this->_tpl_vars['title']; ?>
</div></td>
              </tr>
              <tr>
                <td height="20" align="center"></td>
              </tr>


<!--  注释掉缩略图  -->              
<!--
 <tr>
                <td align="center" valign="Top" bgcolor="#FFFFFF" style="color:#333333; line-height:24px"><P><IMG border=0 src="<?php echo $this->_tpl_vars['picture']; ?>
" width="550"></P></td>
              </tr>
-->
<!--  注释掉缩略图  -->    


			   <tr>
                <td style="color:#333333; line-height:24px"><?php echo $this->_tpl_vars['data']; ?>
</td>
              </tr>
            </table>
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