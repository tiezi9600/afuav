<?php /* Smarty version 2.6.13, created on 2011-10-22 15:49:56
         compiled from admincp_templates.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script>function confirmdelete() {return confirm("<?php echo $this->_tpl_vars['lan']['suredeltemplate']; ?>
");}</script><body><div class="block"></div><table cellspacing="1" cellpadding="4" align="center" class="commontable width100"><tr class="header"><td colspan="3"><?php echo $this->_tpl_vars['lan']['maintemplate']; ?>
</td></tr><tr><td><table  cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td width="20">ID</td><td><?php echo $this->_tpl_vars['lan']['filename']; ?>
</td></tr><?php echo $this->_tpl_vars['str_maintemplates']; ?>
</table><div class="block"></div><table  cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['addnewtemplate']; ?>
</td></tr><form action="admincp.php?action=templates" method="post"><input type="hidden" name="prefix" value=","><tr><td colspan="4"><input type="text" name="templatename" size="10" class="mustoffer">.htm&nbsp;<input type="submit" name="addnewtemplate" value="<?php echo $this->_tpl_vars['lan']['add']; ?>
"></td></tr></form></table></td></tr></table><div class="block"></div><table cellspacing="1" cellpadding="4" align="center" class="commontable width100"><tr class="header"><td colspan="3"><?php echo $this->_tpl_vars['lan']['subtemplate']; ?>
</td></tr><tr><td><table cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td width="20">ID</td><td><?php echo $this->_tpl_vars['lan']['filename']; ?>
</td></tr><?php echo $this->_tpl_vars['str_subtemplates']; ?>
</table><div class="block"></div><table cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['addnewtemplate']; ?>
</td></tr><form action="admincp.php?action=templates" method="post"><input type="hidden" name="prefix" value=""><tr><td colspan="4"><input type="text" name="templatename" size="10" class="mustoffer">.htm&nbsp;<input type="submit" name="addnewtemplate" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
"></td></tr></form></table></td></tr></table></body></html>