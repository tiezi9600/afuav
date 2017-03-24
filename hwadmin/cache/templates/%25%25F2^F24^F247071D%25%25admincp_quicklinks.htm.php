<?php /* Smarty version 2.6.13, created on 2011-10-22 12:26:18
         compiled from admincp_quicklinks.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_xheader.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><base target="mainFrame"><body><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td align="center" style="color:yellow"><?php echo $this->_tpl_vars['lan']['qiucklinks']; ?>
</td></tr><tr><td><a href="<?php echo $this->_tpl_vars['homepage']; ?>
" target="_blank"><?php echo $this->_tpl_vars['lan']['returntodefault']; ?>
</a><br /><a href="welcome.php"><?php echo $this->_tpl_vars['lan']['returntosystemdefault']; ?>
</a></td></tr></table><?php if ($this->_tpl_vars['iscreator'] == 1): ?><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td align="center"><?php echo $this->_tpl_vars['lan']['setting']; ?>
</td></tr><tr><td><a href="setting.php?action=generally"><?php echo $this->_tpl_vars['lan']['generallysetting']; ?>
</a><br /><a href="setting.php?action=functions"><?php echo $this->_tpl_vars['lan']['functionssetting']; ?>
</a><br /><a href="setting.php?action=front"><?php echo $this->_tpl_vars['lan']['frontsetting']; ?>
</a><br /><a href="setting.php?action=user"><?php echo $this->_tpl_vars['lan']['usersetting']; ?>
</a><br /><a href="setting.php?action=attach"><?php echo $this->_tpl_vars['lan']['attachsetting']; ?>
</a></td></tr></table><?php endif;  if ($this->_tpl_vars['iscreator'] == 1): ?><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header" align="center"><td><?php echo $this->_tpl_vars['lan']['tools']; ?>
</td></tr><tr><td><a href="welcome.php?action=optimize"><?php echo $this->_tpl_vars['lan']['optimize']; ?>
</a><br /><a href="welcome.php?action=updatecache"><?php echo $this->_tpl_vars['lan']['updatecache']; ?>
</a><br /><a href="welcome.php?action=checkwritable"><?php echo $this->_tpl_vars['lan']['checkwritable']; ?>
</a><br /><a href="db.php?action=export"><?php echo $this->_tpl_vars['lan']['backupdb']; ?>
</a><br /><a href="db.php?action=import"><?php echo $this->_tpl_vars['lan']['restoredb']; ?>
</a><br /><a href="welcome.php?action=runsql"><?php echo $this->_tpl_vars['lan']['runsql']; ?>
</a></td></tr></table><?php endif; ?></body></html>