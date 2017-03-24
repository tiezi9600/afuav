<?php /* Smarty version 2.6.13, created on 2011-12-28 06:47:40
         compiled from %2Cdownload.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getcategories', ',download.htm', 20, false),array('function', 'getitems', ',download.htm', 27, false),array('function', 'getindexs', ',download.htm', 36, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<title><?php echo $this->_tpl_vars['keywords']; ?>
-<?php echo $this->_tpl_vars['v_siteName']; ?>
</title>
<meta name="Keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
" />
<meta name="Description" content="<?php echo $this->_tpl_vars['description']; ?>
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
    <td width="241" valign="top" style="background:url(/images/07.jpg) repeat-x top; border:1px solid #BACBDB; background-color:#F0F4FD;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sider.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
    <td width="11">&nbsp;</td>
    <td width="708" valign="top" style="border:1px solid #CED7DF; padding:2px 10px 10px 10px"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(/images/r_picbg.gif) bottom left no-repeat; margin-bottom:15px">
        <tr>
          <td width="54%" height="45" class="lm_title"><div style="padding:0px 0px 1px 19px"><?php echo $this->_tpl_vars['categoryname']; ?>
</div></td>
          <td width="46%" align="right"><strong>现在的位置：</strong><a href="/" title="<?php echo $this->_tpl_vars['keywords']; ?>
" >首页</a>
<?php echo getcategories(array('id' => $this->_tpl_vars['category'],'template' => "<#ak_if(#)[#id](#)&gt;<a href='[%url]' title='[%category]'><span class='location'>[%category]</span></a>&nbsp;&nbsp;&nbsp;#>"), $this);?>
</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><span class="lan12" style="padding-top:15px;padding-bottom:15px;">
            <table  width="98%" border="0" align="center" cellpadding="2" cellspacing="0">
			<?php echo getitems(array('bandindex' => '1','category' => $this->_tpl_vars['category'],'page' => $this->_tpl_vars['page'],'orderby' => 'id_reverse','num' => '20','includesubcategory' => '1','timelimit' => '1','template' => "
              <tr>
                <td style=()background:url(/images/newline.gif) repeat-x bottom; padding-top:5px;() height=()30()><span style=()color:#FF6600()>·</span> <#getattachments(#)itemid=[%itemid](#)template=<a class='a1'  href='[filename]' title='[%title]'>[%title]</a>#>&nbsp;&nbsp;&nbsp;([y]-[m]-[d])</td>
              </tr>"), $this);?>

            </table>
            <table width="98%" height="50" align="center" cellpadding="1" cellspacing="0" class="hei2">
              <tr>
                <td height="10" colspan="3" align="left"  bordercolor="#999999" border="1"></td>
              </tr>
            <?php echo getindexs(array('page' => $this->_tpl_vars['page'],'template' => "
              <tr>
                <td width=()13%() align=()left()  bordercolor=()#999999() border=()1() bgcolor=()#F5F5F5() height=()24()>&nbsp;总计[total]条记录，共[lastid]页</td>
                <td width=()52%() align=()right() bgcolor=()#F5F5F5() height=()24()><a class=()a1() href=()[first]()>首页</a>|<a href=()[pre]() class=()a1()>上页</a> [indexs]<a href=()[next]() class=()a1()>下页</a> | <a href=()[last]() class=()a1()>尾页</a>&nbsp;&nbsp;</td>
              </tr>",'firstpage' => "/category.php?id=".($this->_tpl_vars['category']),'linktemplate' => "[link]",'baseurl' => "/category.php?id=".($this->_tpl_vars['category'])."&page=[page]"), $this);?>

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