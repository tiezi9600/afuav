<?php /* Smarty version 2.6.13, created on 2011-10-22 15:49:58
         compiled from admincp_template.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_xheader.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><form action="admincp.php?action=template&job=save" method="POST"><input type="hidden" name="template" value="<?php echo $this->_tpl_vars['template']; ?>
"><table cellspacing="1" cellpadding="4" align="center" class="commontable width100"><tr class="header"><td colspan="3"><?php echo $this->_tpl_vars['lan']['system_templates']; ?>
(<?php echo $this->_tpl_vars['template']; ?>
)</td></tr><tr><td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td><textarea name="html" rows="25" class="template"><?php echo $this->_tpl_vars['str_template']; ?>
</textarea></td><td width="185" style="width:185px;" valign="top"></td></tr></table></td></tr></table><center><br /><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
" name="save_template"></center></form></body></html>