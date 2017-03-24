<?php /* Smarty version 2.6.13, created on 2011-10-22 12:25:39
         compiled from chooselanguage.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block2"></div><table cellspacing="0" cellpadding="0" align="center" class="commontable"><tr><td><table border="0" cellspacing="1" cellpadding="4" width="100%"><tr class="header"><td colspan="4"><?php echo $this->_tpl_vars['sysname']; ?>
 <?php echo $this->_tpl_vars['sysedition']; ?>
 Install</td></tr><tr><td><select onchange="document.location='install.php?language='+this.value"><option value="">Please choose language</option><option value="english">English</option><option value="chinese">Chinese</option></select></td></tr></table></td></tr></table></body></html>