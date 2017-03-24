<?php /* Smarty version 2.6.13, created on 2011-12-28 05:32:09
         compiled from admincp_spiders.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><table border="0" align="center" cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td colspan="3"><div class="righttop"></div><?php echo $this->_tpl_vars['lan']['spiderlistrule']; ?>
</td></tr><tr><td><table border="0" align="center" cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td width="35">ID</td><td><?php echo $this->_tpl_vars['lan']['name']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['preview']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['spidernow']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['export']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['delete']; ?>
</td></tr><?php echo $this->_tpl_vars['listrules']; ?>
<tr><td colspan="10"><input type="button" onclick="document.location='spider.php?action=newspiderlist'" value="<?php echo $this->_tpl_vars['lan']['add']; ?>
">&nbsp;<input type="button" onclick="document.location='spider.php?action=importlistrule'" value="<?php echo $this->_tpl_vars['lan']['import']; ?>
"></td></tr></table></td></tr></table><div class="block"></div><table border="0" align="center" cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td colspan="3"><div class="righttop"></div><?php echo $this->_tpl_vars['lan']['spidercontentrule']; ?>
</td></tr><tr><td><table border="0" align="center" cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td width="35">ID</td><td><?php echo $this->_tpl_vars['lan']['name']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['preview']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['export']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['delete']; ?>
</td></tr><?php echo $this->_tpl_vars['contentrules']; ?>
<tr><td colspan="5"><input type="button" onclick="document.location='spider.php?action=newspidercontent'" value="<?php echo $this->_tpl_vars['lan']['add']; ?>
">&nbsp;<input type="button" onclick="document.location='spider.php?action=importcontentrule'" value="<?php echo $this->_tpl_vars['lan']['import']; ?>
"></td></tr></table></td></tr></table></body></html>