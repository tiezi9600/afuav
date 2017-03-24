<?php /* Smarty version 2.6.13, created on 2011-10-22 16:21:46
         compiled from admincp_moduleitem.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if(!empty($GLOBALS['xheditor'])) {echo '<script type="text/javascript" charset="utf-8" src="include/xh/xheditor-1.1.10-zh-cn.min.js"></script>';} ?><script language="javascript" type="text/javascript">function confirmdelete() {if(!confirm('<?php echo $this->_tpl_vars['lan']['suredelitem']; ?>
')) {return false;} else {document.location = "admincp.php?action=deleteitem&id=<?php echo $this->_tpl_vars['id']; ?>
&returnlist=1";}}function checksubmit() {if($('#title').val() == "") {alert("<?php echo $this->_tpl_vars['lan']['notitle']; ?>
");$('#title').focus();return false;}if($('#category').val() == "" || $('#category').val() == 0) {alert("<?php echo $this->_tpl_vars['lan']['nocategory']; ?>
");$('#category0').focus();return false;}$('#s').attr("disabled", true);}function selectcategory(l, c) {if(c == 0) {if(l > 1) $("#category").val($("#category" + (l - 2)).val());} else {$("#category").val(c);}for(i = l; i < 10 ;i ++) {$("#category" + i).get(0).options.length = 0 ; $("#category" + i).hide();}$("#category" + l).prepend("<option value='0'><?php echo $this->_tpl_vars['lan']['pleasechoose']; ?>
</option>");if(c > 0 || l == 0) {var fileref = document.createElement("script");fileref.setAttribute("type", "text/javascript");fileref.setAttribute("src", "admincp.php?action=selectcategories&up="+c+"&level="+l+"&module=<?php echo $this->_tpl_vars['moduleid']; ?>
&defaultlist=<?php echo $this->_tpl_vars['categorylist']; ?>
");document.body.appendChild(fileref);}}function SetframeHeight(obj) {var iframeid = document.getElementById(obj);if(iframeid.contentDocument && iframeid.contentDocument.body.offsetHeight) {iframeid.height = iframeid.contentDocument.body.offsetHeight;} else {iframeid.height = iframeid.Document.body.scrollHeight;}}</script><body><div class="block"></div><form enctype="multipart/form-data" action="admincp.php?action=saveitem" method="post" onsubmit="return checksubmit()"><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" /><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $this->_tpl_vars['maxattachsize']; ?>
" /><table width="100%" border="0" cellpadding="4" cellspacing="1" class="commontable" align="center"><tr class="header"><td colspan="2"><div class="righttop"><a href="admincp.php?action=modules&job=editmodule&id=<?php echo $this->_tpl_vars['moduleid']; ?>
"><?php echo $this->_tpl_vars['lan']['modifyfield']; ?>
</a></div><?php echo $this->_tpl_vars['operate'];  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['data']; ?>
</td></tr><?php echo $this->_tpl_vars['htmlfields']; ?>
</table><div class="block"></div><div id="extfieldstable"></div><div class="block2"></div><center><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
" id="s"></center></form></body></html>