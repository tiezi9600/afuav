<?php /* Smarty version 2.6.13, created on 2011-10-22 15:29:37
         compiled from phpmodules.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><base target="_blank"><body><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['phpmodule']; ?>
</td></tr><tr><td><table cellspacing="1" cellpadding="4" class="commontable" align="center"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['modulename']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['support']; ?>
</td></tr><?php $_from = $this->_tpl_vars['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['option']):
?><tr><td><?php echo $this->_tpl_vars['key']; ?>
</td><?php if ($this->_tpl_vars['option']): ?><td><?php echo $this->_tpl_vars['lan']['support']; ?>
</td><?php else: ?><td><?php echo $this->_tpl_vars['lan']['nosupport']; ?>
</td><?php endif; ?></tr><?php endforeach; endif; unset($_from); ?></table></td></tr></table></body></html>