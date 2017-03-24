<?php /* Smarty version 2.6.13, created on 2011-10-22 15:31:07
         compiled from admincp_changepass.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><form action="account.php?action=changepassword&submit=1" method="post"><table cellspacing="1" align="center" cellpadding="4" class="commontable"><tr class="header"><td colspan="3"><?php echo $this->_tpl_vars['lan']['changepassword']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['oldpassword']; ?>
</td><td><input type="password" value="" name="oldpassword"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['newpassword']; ?>
</td><td><input type="password" value="" name="newpassword"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['newpassword2']; ?>
</td><td><input type="password" value="" name="newpassword2"></td></tr><tr><td colspan="2" align="center"><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
"></td></tr></table></form></body></html>