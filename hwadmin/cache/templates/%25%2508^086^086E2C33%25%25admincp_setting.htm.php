<?php /* Smarty version 2.6.13, created on 2011-10-22 12:45:28
         compiled from admincp_setting.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><form action="setting.php" method="post"><?php echo $this->_tpl_vars['str_settings']; ?>
</table><input type="hidden" value="<?php echo $this->_tpl_vars['action']; ?>
" name="action"><center><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
" name="setting_submit"></center></form></body></html>