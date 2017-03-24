<?php /* Smarty version 2.6.13, created on 2011-12-20 08:50:09
         compiled from admincp_modules.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><table cellspacing="1" cellpadding="4" align="center" class="commontable"><tr class="header"><td colspan="3"><div class="righttop"></div><?php echo $this->_tpl_vars['lan']['managemodules']; ?>
</td></tr><tr><td><table border="0" cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td width="35">ID</td><td><?php echo $this->_tpl_vars['lan']['modulename']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['del']; ?>
</td></tr><?php echo $this->_tpl_vars['moduleslist']; ?>
<tr><td colspan="5"><input type="button" onclick="document.location='admincp.php?action=modules&job=addmodule'" value="<?php echo $this->_tpl_vars['lan']['addmodules']; ?>
"></td></tr></table></td></tr></table></body></html>