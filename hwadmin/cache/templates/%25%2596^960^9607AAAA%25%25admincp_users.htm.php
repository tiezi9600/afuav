<?php /* Smarty version 2.6.13, created on 2011-10-22 13:22:51
         compiled from admincp_users.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script language="javascript">function confirmoperate() {if(!confirm('<?php echo $this->_tpl_vars['lan']['makesure']; ?>
')) {return false;}}</script><body><div class="block"></div><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="commontable"><form action="admincp.php" method="get"><input type="hidden" name="action" value="users"><tr class="header"><td colspan="99"><div class="righttop"><a href="admincp.php?action=modules&job=editmodule&id=<?php echo $this->_tpl_vars['moduleid']; ?>
"><?php echo $this->_tpl_vars['lan']['modifyfield']; ?>
</a></div><?php echo $this->_tpl_vars['lan']['query']; ?>
</td></tr><tr><td colspan="99">ID&nbsp;<input type="text" value="<?php echo $this->_tpl_vars['get']['id']; ?>
" name="id" size="5"><?php echo $this->_tpl_vars['lan']['username']; ?>
&nbsp;<input type="text" value="<?php echo $this->_tpl_vars['get']['username']; ?>
" name="username" size="10">Email&nbsp;<input type="text" value="<?php echo $this->_tpl_vars['get']['email']; ?>
" name="email" size="10">IP&nbsp;<input type="text" value="<?php echo $this->_tpl_vars['get']['ip']; ?>
" name="ip" size="15"><input type="submit" value="<?php echo $this->_tpl_vars['lan']['query']; ?>
"></td></tr></form><tr class="header"><td width="35">ID</td><td width="90"><?php echo $this->_tpl_vars['lan']['username']; ?>
</td><td>Email</td><td width="60"><?php echo $this->_tpl_vars['lan']['time']; ?>
</td><td width="60">IP</td><td align="center"><strong><?php echo $this->_tpl_vars['lan']['resetpassword']; ?>
</strong></td><td align="center"><strong><?php echo $this->_tpl_vars['lan']['status']; ?>
</strong></td><td width="50" align="center"><strong><?php echo $this->_tpl_vars['lan']['delete']; ?>
</strong></td></tr><?php echo $this->_tpl_vars['list']; ?>
<form action="<?php echo $this->_tpl_vars['indexurl']; ?>
" method="post"><tr class="header"><td colspan="99"><ul class="index"><?php echo $this->_tpl_vars['str_index']; ?>
</ul></td></tr></form></table></body></html>