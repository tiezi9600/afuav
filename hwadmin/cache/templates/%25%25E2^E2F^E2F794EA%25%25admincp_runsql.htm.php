<?php /* Smarty version 2.6.13, created on 2011-10-22 15:30:27
         compiled from admincp_runsql.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><?php echo $this->_tpl_vars['result']; ?>
<table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td colspan="3"><?php echo $this->_tpl_vars['lan']['runsql']; ?>
</td></tr><tr><form action="welcome.php?action=runsql" method="POST"><td align="center"><textarea name="sql" style="width:100%;height:400px;"><?php echo $this->_tpl_vars['sql']; ?>
</textarea><br /><input type="submit" value="<?php echo $this->_tpl_vars['lan']['runsql']; ?>
"></td></form></tr></table></body></html>