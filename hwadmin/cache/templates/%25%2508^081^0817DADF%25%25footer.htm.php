<?php /* Smarty version 2.6.13, created on 2012-02-17 08:09:32
         compiled from footer.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getlists', 'footer.htm', 24, false),)), $this); ?>
<!--  防右键复制代码  -->
    <script language="JavaScript"> 
        document.oncontextmenu=new Function("event.returnValue=false;"); 
        document.onselectstart=new Function("event.returnValue=false;"); 
    </script>
<!--  防右键复制代码  -->

<STYLE type=text/css>
.STYLE4 {
	COLOR: #ffffff; FONT-SIZE: 11px
}
.STYLE5 {
	COLOR: #ff4a05; FONT-WEIGHT: bold
}
.STYLE7 {
	COLOR: #999999
}
</STYLE>
<TABLE style="BACKGROUND: url(/images/14.jpg) repeat-x" border=0 cellSpacing=0 
cellPadding=0 width=960 align=center height=80>
  <TBODY>
    <TR>
      <TD style="LINE-HEIGHT: 23px; PADDING-LEFT: 15px" width=740>
<?php echo getlists(array('template' => "<a href=()/()>[item]</a>&nbsp;&nbsp;&nbsp;",'list' => $this->_tpl_vars['v_indexKeywords']), $this);?>

<A href="/sitemap.html">网站地图</A><BR>
        Copyright 
        © 2010 <A href="/"><?php echo $this->_tpl_vars['v_siteName']; ?>
</A>&nbsp;All Rights 
        Reserved&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['v_siteICP']; ?>
 
        &nbsp;&nbsp;&nbsp;服务热线：<?php echo $this->_tpl_vars['v_sitePhone']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;技术支持：[powered]&nbsp; </TD>
      <TD width=220><IMG src="/images/mii.gif" width=35 height=40>
      <?php echo $this->_tpl_vars['v_siteStat']; ?>

      </TD>
    </TR>
  </TBODY>
</TABLE>