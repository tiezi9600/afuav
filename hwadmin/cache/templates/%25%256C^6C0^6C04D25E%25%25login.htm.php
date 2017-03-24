<?php /* Smarty version 2.6.13, created on 2011-10-22 12:26:09
         compiled from login.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_xheader.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><title><?php echo $this->_tpl_vars['sitename']; ?>
 <?php echo $this->_tpl_vars['lan']['cp']; ?>
</title><body><div class="block"></div><form name="loginform" method="post" action="login.php"><table border="0" cellspacing="1" cellpadding="4" class="commontable"><tr class="header"><td colspan="2"><?php echo $this->_tpl_vars['sysname']; ?>
 <?php echo $this->_tpl_vars['lan']['login']; ?>
<input name="action" type="hidden" id="action" value="login"></td></tr><tr><td align="right"><?php echo $this->_tpl_vars['lan']['username']; ?>
</td><td><input name="username" type="text" size="15" id="username"></td></tr><tr><td valign="top" align="right"><?php echo $this->_tpl_vars['lan']['password']; ?>
</td><td><input name="password" type="password" size="15" id="password"></td></tr><tr><td></td><td><input type="checkbox" name="rememberlogin" id="rememberlogin" value="1"><label for="rememberlogin"><?php echo $this->_tpl_vars['lan']['rememberlogin']; ?>
</label></td></tr></table><div class="block"></div><center><input type="submit" name="loginsubmit" value="<?php echo $this->_tpl_vars['lan']['login']; ?>
"></center></form></body></html>