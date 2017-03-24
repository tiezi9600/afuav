<?php /* Smarty version 2.6.13, created on 2011-10-22 12:29:52
         compiled from admincp_categories.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script language="javascript">function d(id) {if(confirm('<?php echo $this->_tpl_vars['lan']['suredelcategory']; ?>
')) {document.location='admincp.php?action=deletecategory&vc=<?php echo $this->_tpl_vars['vc']; ?>
&id='+id;}}c = new Array();function i(id) {if(typeof(c[id]) == 'undefined' || c[id] == 0) {c[id] = 1;$("#c" + id).hide();$("#f" + id).attr('class', "f3");} else {c[id] = 0;$("#c" + id).show();$("#f" + id).attr('class', "f2");}$("#f" + id).focus();}</script><body><div class="block"></div><div class="commontable"><div class="header" style="padding:0px;height:26px;"><div style="padding:6px;"><?php echo $this->_tpl_vars['lan']['category']; ?>
</div></div><div class="content"><b><?php echo $this->_tpl_vars['lan']['tools']; ?>
</b> <a href="admincp.php?action=refreshcategory"><?php echo $this->_tpl_vars['lan']['refreshcategories']; ?>
</a></div><div class="content" id="categoriestree"><?php echo $this->_tpl_vars['categoriestree']; ?>
<div style="clear:both;"></div></div></div></body></html>