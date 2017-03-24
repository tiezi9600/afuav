<?php /* Smarty version 2.6.13, created on 2011-12-21 06:59:00
         compiled from admincp_attachments.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body style="background:#F8F8F8;"><table border="0" cellpadding="4" cellspacing="1" class="commontable" width="730"><form action='admincp.php?action=attachments&id=<?php echo $this->_tpl_vars['id']; ?>
' method='post'><tr class="header"><td width="20" align='center'><?php echo $this->_tpl_vars['lan']['del']; ?>
</td><td width="20">ID</td><td><?php echo $this->_tpl_vars['lan']['filename']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['date']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['description']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['order']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['filesize']; ?>
</td></tr><?php if ($this->_tpl_vars['attachments'] == ''): ?><tr><td colspan='9'><?php echo $this->_tpl_vars['lan']['attach_no']; ?>
</td></tr><?php else:  echo $this->_tpl_vars['attachments']; ?>
<tr><td colspan='9' align='center'><input type='submit' value='<?php echo $this->_tpl_vars['lan']['save'];  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['attach']; ?>
'></td></tr><?php endif; ?></table></form></body></html>