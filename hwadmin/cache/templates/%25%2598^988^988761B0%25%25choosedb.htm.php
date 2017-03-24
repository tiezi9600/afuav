<?php /* Smarty version 2.6.13, created on 2011-10-22 12:25:45
         compiled from choosedb.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block2"></div><table cellspacing="0" cellpadding="0" align="center" class="commontable" width="300"><tr><td><table border="0" cellspacing="1" cellpadding="4" width="100%"><tr class="header"><td colspan="4"><?php echo $this->_tpl_vars['sysname']; ?>
 <?php echo $this->_tpl_vars['sysedition']; ?>
 Install</td></tr><tr><td><select id="dbtype"><option value=""><?php echo $this->_tpl_vars['lan']['pleasechoosedb']; ?>
</option><?php $_from = $this->_tpl_vars['drivers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['driver']):
?><option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['driver']; ?>
</option><?php endforeach; endif; unset($_from); ?></select>&nbsp;&nbsp;&nbsp;<a href="http://www.akcms.com/manual/mysql-sqlite.htm" target="_blank"><?php echo $this->_tpl_vars['lan']['dbtypedescription']; ?>
</a><br><br><center><input type="button" value="<?php echo $this->_tpl_vars['lan']['next']; ?>
" onclick="document.location='install.php?language=<?php echo $_GET['language']; ?>
&dbtype='+document.getElementById('dbtype').value"><br /><?php echo $this->_tpl_vars['lan']['sqlitecannotupdate']; ?>
</center></td></tr></table></td></tr></table></body></html>