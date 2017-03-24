<?php /* Smarty version 2.6.13, created on 2011-10-22 15:31:05
         compiled from admincp_manageaccounts.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><iframe name="work" style="display:none"></iframe><table cellspacing="1" cellpadding="4" align="center" class="commontable"><tr class="header"><td colspan="3"><?php echo $this->_tpl_vars['lan']['accountmanage']; ?>
</td></tr><tr><td><table cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['account']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['delete']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['status']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['changestatus']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['resetpassword']; ?>
</strong></td><td><?php echo $this->_tpl_vars['lan']['itemnum']; ?>
</td></tr><?php echo $this->_tpl_vars['users']; ?>
</table><div class="block"></div><table cellpadding="4" cellspacing="1" class="commontable width100"><form action="account.php?action=manageaccounts&job=newaccount" method="post"><tr class="header"><td colspan="10"><?php echo $this->_tpl_vars['lan']['newaccount']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['account']; ?>
</td><td><input type="text" value="" name="account" class="mustoffer"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['password']; ?>
</td><td><input type="password" name="password" class="mustoffer"></td></tr><tr><td colspan="10" align="center"><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
" name="section_new_submit"></td></tr></form></table></td></tr></table></body></html>