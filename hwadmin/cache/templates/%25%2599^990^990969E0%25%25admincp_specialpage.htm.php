<?php /* Smarty version 2.6.13, created on 2011-10-22 13:46:19
         compiled from admincp_specialpage.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td colspan="2"><?php echo $this->_tpl_vars['lan']['specialpage_edit']; ?>
</td></tr><form name="editpage" action="admincp.php?action=specialpages&id=<?php echo $this->_tpl_vars['id']; ?>
" method="POST"><tr><td width="60"><?php echo $this->_tpl_vars['lan']['pagename']; ?>
</td><td><input type="text" name="pagename" size="20" value="<?php echo $this->_tpl_vars['pagename']; ?>
" class="mustoffer"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['template']; ?>
</td><td><select name="template" class="mustoffer"><?php echo $this->_tpl_vars['str_templates']; ?>
</select></td></tr><script>document.editpage.template.value = '<?php echo $this->_tpl_vars['template']; ?>
';</script><tr><td><?php echo $this->_tpl_vars['lan']['filename']; ?>
</td><td><input type="text" name="filename" size="20" value="<?php echo $this->_tpl_vars['filename']; ?>
" class="mustoffer"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['data']; ?>
</td><td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_richtext_editor.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr><tr><td colspan="2" align="center"><input type="submit" name="saveeditpage" size="20" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
"></td></tr></form></table></body></html>