<?php /* Smarty version 2.6.13, created on 2013-03-11 02:51:32
         compiled from %2Cindex.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getcategories', ',index.htm', 44, false),array('function', 'getitems', ',index.htm', 84, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">


<HEAD>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<TITLE><?php echo $this->_tpl_vars['v_indexTitle']; ?>
</TITLE>
<META name=keywords content="<?php echo $this->_tpl_vars['v_indexKeywords']; ?>
">
<META name=description content="<?php echo $this->_tpl_vars['v_indexDescription']; ?>
">
<LINK rel=stylesheet type=text/css href="/images/Style.css">
<SCRIPT src="/images/focus.js" type="text/javascript"></SCRIPT>
</HEAD>


<BODY>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=960 align=center>
  <TBODY>
    <TR>
      <TD height=600 vAlign=top rowSpan=2 width=253 align=left><TABLE border=0 cellSpacing=0 cellPadding=0 width=241>
          <TBODY>
            <TR>
              <TD><IMG src="/images/05.jpg" width=241 height=5></TD>
            </TR>
            <TR>
              <TD 
          style="BORDER-LEFT: #bacbdb 1px solid; BACKGROUND: url(/images/07.jpg) repeat-x 50% top; BORDER-RIGHT: #bacbdb 1px solid;PADDING-TOP: 5px " 
          height=570 vAlign=top><TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" 
            align=center>
                  <TBODY>
                    <TR>
                      <TD align=center>
<SCRIPT type=text/javascript>
<?php echo $this->_tpl_vars['v_siteFocus']; ?>

focus(pics,links,texts)
</SCRIPT>
                      </TD>
                    </TR>
                  </TBODY>
                </TABLE>
                <TABLE style="MARGIN-TOP: 10px" class=line cellSpacing=0 
            cellPadding=0 width=212 align=center>
                  <TBODY>
<?php echo getcategories(array('num' => '20','rootcategory' => '2','template' => "
                    <TR>
                      <TD height=27 width=10><IMG src=()/images/icon.gif() width=4 
                  height=6></TD>
                      <TD><A 
                  href=()[url]()>[category]</A>&nbsp;&nbsp;<IMG 
                  src=()/images/hot.gif() width=23 height=11></TD>
                    </TR>"), $this);?>

                     </TBODY>
                </TABLE>
                <TABLE style="MARGIN-TOP: 15px" border=0 cellSpacing=7 cellPadding=0 
            width=222 align=center>
                  <TBODY>
                    <TR>
                      <TD><A href="/aboutus/message.html"><IMG 
                  border=0  src="/images/online_01.jpg" 
                  width=214 height=42></A></TD>
                    </TR>
                    <TR>
                      <TD><A 
                  href="http://wpa.qq.com/msgrd?v=3&uin=362341301&site=qq&menu=yes"><IMG 
                  border=0 alt=QQ咨询 src="/images/online_02.jpg" 
                  width=214 height=42></A></TD>
                    </TR>
                    <TR>
                      <TD><A href="/aboutus/hr.html"><IMG 
                  border=0  src="/images/online_03.jpg" 
                  width=214 height=42></A></TD>
                    </TR>
                  </TBODY>
                </TABLE>
                <TABLE style="MARGIN-TOP: 15px" border=0 cellSpacing=0 cellPadding=0 
            width=212 align=center>
                  <TBODY>
                    <TR>
                      <TD><SELECT style="WIDTH: 214px" 
                  onchange=javascript:window.open(this.options[this.selectedIndex].value) 
                  size=1 name=link>
                          <OPTION selected>-------- 友情链接 
                          --------</OPTION>
                         <?php echo getitems(array('num' => '20','category' => '4','orderby' => 'id_reverse','includesubcategory' => '1','template' => "
                            <OPTION  value=()[aimurl]()>[title]</OPTION>"), $this);?>

                        </SELECT></TD>
                    </TR>
                  </TBODY>
                </TABLE></TD>
            </TR>
            <TR>
              <TD><IMG src="/images/06.jpg" width=241 
      height=5></TD>
            </TR>
          </TBODY>
        </TABLE></TD>
    </TR>
    <TR>
      <TD height=370 vAlign=top><TABLE border=0 cellSpacing=0 cellPadding=0 width=706>
          <TBODY>
            <TR>
              <TD height=180 vAlign=top width=455><TABLE border=0 cellSpacing=0 cellPadding=0 width=446>
                  <TBODY>
                    <TR>
                      <TD 
                style="PADDING-BOTTOM: 0px; PADDING-LEFT: 26px; PADDING-RIGHT: 0px; BACKGROUND: url(/images/08.jpg) no-repeat; HEIGHT: 32px; PADDING-TOP: 4px" 
                class=lm_title>新闻动态</TD>
                    </TR>
                    <TR>
                      <TD 
                style="BACKGROUND: url(/images/newsbg.gif) repeat-x 50% top; PADDING-TOP: 8px" 
                height=134 vAlign=top><TABLE border=0 cellSpacing=0 cellPadding=0 width="95%" 
                  align=center>
                          <TBODY>
<?php echo getitems(array('num' => '5','category' => '1','orderby' => 'id_reverse','includesubcategory' => '1','template' => "
                            <TR>
                              <TD 
                      style=()BACKGROUND: url(/images/newline.gif) repeat-x 50% bottom()
                      height=26 align=left><SPAN 
                        style=()COLOR: #ff6600()>·</SPAN><A 
                        title=()[title]() 
                        href=()[url]()>[title]</A></TD>
                            </TR>"), $this);?>

                           </TBODY>
                        </TABLE></TD>
                    </TR>
                  </TBODY>
                </TABLE></TD>
              <TD style="BACKGROUND: url(/images/20.jpg) no-repeat right top" 
          vAlign=top width=251><TABLE border=0 cellSpacing=0 cellPadding=0 width="97%" 
align=center>
                  <TBODY>
                    <TR>
                      <TD 
                style="PADDING-BOTTOM: 0px; PADDING-LEFT: 25px; PADDING-RIGHT: 0px; PADDING-TOP: 4px" 
                class=lm_title height=33>资料下载</TD>
                    </TR>
                   </TBODY>
                </TABLE>
                <TABLE style="MARGIN-TOP: 8px" border=0 cellSpacing=0 cellPadding=2 
            width="95%" align=center>
                  <TBODY>
<?php echo getitems(array('num' => '5','category' => '3','orderby' => 'id_reverse','includesubcategory' => '1','template' => "
                    <TR>
<#getattachments(#)itemid=[%itemid](#)template=
                      <TD height=25>· <A title=[%title] 
                  href='[filename]'>[%title]</A></TD>#>
                    </TR>"), $this);?>

                   </TBODY>
                </TABLE></TD>
            </TR>
          </TBODY>
        </TABLE>
 


       <TABLE 
      style="MARGIN-TOP: 10px; BACKGROUND: url(/images/13.jpg) repeat-x 50% top" 
      border=0 cellSpacing=0 cellPadding=0 width="100%">
          <TBODY>
            <TR>
              <TD width="1%"><IMG src="/images/11.jpg" width=6 height=161></TD>
             

 <TD width="98%"><DIV style="WIDTH: 195px; FLOAT: left"><IMG alt="<?php echo $this->_tpl_vars['v_siteName']; ?>
"
            src="/pictures/2012/02/zr052n.jpg" <!-- 替换原图  "/images/19.jpg" --> </DIV>



                <DIV 
            style="LINE-HEIGHT: 24px; PADDING-RIGHT: 5px; FLOAT: right; PADDING-TOP: 10px"><?php echo $this->_tpl_vars['v_siteAboutus']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A 
            href="/aboutus/company.html"><STRONG><SPAN 
            style="COLOR: #ff7e00">详细&gt;&gt;</SPAN></STRONG></A></DIV></TD>
              <TD width="1%"><IMG src="/images/12.jpg" width=6 
        height=161></TD>
            </TR>
          </TBODY>
        </TABLE>
        <TABLE style="MARGIN-TOP: 10px" border=0 cellSpacing=0 cellPadding=0 
      width="100%">
          <TBODY>
            <TR>
              <TD 
          style="BACKGROUND-IMAGE: url(/images/09.jpg); PADDING-BOTTOM: 0px; PADDING-LEFT: 26px; PADDING-RIGHT: 0px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 32px; PADDING-TOP: 2px" 
          class=lm_title><?php echo $this->_tpl_vars['v_siteName']; ?>
产品展示<!-- &amp; --></TD>
            </TR>
            <TR>
              <TD style="PADDING-TOP: 5px"><DIV 
            style="Z-INDEX: 1; WIDTH: 706px; OVERFLOW: hidden; align: center" 
            id=demo>
                  <TABLE border=0 cellSpacing=0 cellPadding=0 align=center 
            cellspace="10">
                    <TBODY>
                      <TR>
                        <TD id=marquePic1 vAlign=top><TABLE width="100%">
                            <TBODY>
                              <TR>
<?php echo getitems(array('num' => '8','category' => '2','orderby' => 'id_reverse','includesubcategory' => '1','template' => "
                                <TD align=center><TABLE style=()MARGIN-BOTTOM: 10px() cellSpacing=2 
                        cellPadding=0>
                                    <TBODY>
                                      <TR>
                                        <TD><A class=a2 
                              href=()[url]()><IMG 
                              border=0 alt=()[title]() 
                              src=()[picture]() width=150 
                              height=150></A></TD>
                                      </TR>
                                    </TBODY>
                                  </TABLE>
                                  <A 
                        href=()[url]()>[title]</A></TD>"), $this);?>

                              </TR>
                            </TBODY>
                          </TABLE></TD>
                        <TD id=marquePic2 vAlign=top></TD>
                        <TD id=marquePic3 vAlign=top></TD>
                        <TD id=marquePic4 vAlign=top></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                </DIV>
                <SCRIPT type=text/javascript> 
var marquee_speed=20
marquePic2.innerHTML=marquePic1.innerHTML 
marquePic3.innerHTML=marquePic1.innerHTML 
marquePic4.innerHTML=marquePic1.innerHTML
 
function Marquee(){ 
if(demo.scrollLeft>=marquePic1.scrollWidth){ 
demo.scrollLeft=0 
}else{ 
demo.scrollLeft++ 
} 
} 
var MyMar=setInterval(Marquee,marquee_speed) 
demo.onmouseover=function() {clearInterval(MyMar)} 
demo.onmouseout=function() {MyMar=setInterval(Marquee,marquee_speed)} 
</SCRIPT>
              </TD>
            </TR>
          </TBODY>
        </TABLE></TD>
    </TR>
  </TBODY>
</TABLE>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</BODY>
</HTML>