<?php /* Smarty version 2.6.13, created on 2011-10-22 15:30:25
         compiled from import.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_xheader.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><form action="db.php?action=import" method="POST"><table align="center" cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td colspan="2"><?php echo $this->_tpl_vars['lan']['restoredb']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['datapertime']; ?>
</td><td><input type="text" name="step" size="6" value="1000" /></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['storepath']; ?>
</td><td><input type="text" name="path" size="6" value="data" /></td></tr></table><br /><center><input type="submit" value="<?php echo $this->_tpl_vars['lan']['restoredb']; ?>
"></center></form></body></html>