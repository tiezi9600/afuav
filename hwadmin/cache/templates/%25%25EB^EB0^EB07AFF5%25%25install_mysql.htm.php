<?php /* Smarty version 2.6.13, created on 2011-10-22 12:25:48
         compiled from install_mysql.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_xheader.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block2"></div><form name="loginform" method="post" action="install.php"><input type="hidden" name="dbtype_" value="<?php echo $_GET['dbtype']; ?>
"><input type="hidden" name="action" id="action" value="login"><input type="hidden" name="language" value="<?php echo $_GET['language']; ?>
"><table border="0" cellspacing="1" cellpadding="4" class="commontable"><tr class="header"><td colspan="2"><?php echo $this->_tpl_vars['sysname']; ?>
 <?php echo $this->_tpl_vars['sysedition']; ?>
 <?php echo $this->_tpl_vars['lan']['install']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['dbhost']; ?>
</td><td><input name="dbhost_" type="text" id="dbhost" value="localhost" class="mustoffer"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['dbuser']; ?>
</td><td><input name="dbuser_" type="text" id="dbuser" class="mustoffer" value="root"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['dbpw']; ?>
</td><td><input name="dbpw_" type="password" id="dbpw" class="mustoffer" value=""></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['dbname']; ?>
</td><td><input name="dbname_" type="text" id="dbname" class="mustoffer" value=""></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['tablepre']; ?>
</td><td><input name="tablepre_" type="text" id="tablepre" value="ak" class="mustoffer"></td></tr><?php if ($this->_tpl_vars['charset']): ?><input type="hidden" name="charset_" value="<?php echo $this->_tpl_vars['charset']; ?>
"><?php else: ?><tr><td><?php echo $this->_tpl_vars['lan']['charset']; ?>
</td><td><select name="charset_" class="mustoffer"><option value="<?php echo $this->_tpl_vars['languagecharset']['key']; ?>
"><?php echo $this->_tpl_vars['languagecharset']['value']; ?>
</option><option value="utf8">UTF-8</option></select></td></tr><?php endif; ?><tr><td><?php echo $this->_tpl_vars['lan']['timedifference']; ?>
</td><td><input type="text" name="timedifference_" class="mustoffer" value="<?php echo $this->_tpl_vars['timedifference']; ?>
" size="3"><br><?php echo $this->_tpl_vars['lan']['timedifference_description']; ?>
<br><?php echo $this->_tpl_vars['lan']['servertime']; ?>
:<?php echo $this->_tpl_vars['servertime']; ?>
</td></tr></table><center><br><input type="submit" name="installsubmit" value="<?php echo $this->_tpl_vars['lan']['install']; ?>
"></center></form></body></html>