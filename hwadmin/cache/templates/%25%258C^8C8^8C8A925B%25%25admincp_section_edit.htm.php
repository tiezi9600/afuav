<?php /* Smarty version 2.6.13, created on 2011-12-31 12:08:21
         compiled from admincp_section_edit.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="commontable"><form action="admincp.php?action=editsection&id=<?php echo $this->_tpl_vars['id']; ?>
" method="post" name="sectionedit"><tr class="header"><td colspan="10"><?php echo $this->_tpl_vars['lan']['section_edit']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['section_name']; ?>
</td><td><input type="text" name="section" value="<?php echo $this->_tpl_vars['section']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['alias']; ?>
</td><td><input type="text" name="alias" value="<?php echo $this->_tpl_vars['alias']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['description']; ?>
</td><td><textarea name="description" cols="60" rows="10"><?php echo $this->_tpl_vars['description']; ?>
</textarea></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['keywords']; ?>
</td><td><textarea name="keywords" cols="60" rows="3"><?php echo $this->_tpl_vars['keywords']; ?>
</textarea></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['defaulttemplate']; ?>
</td><td><select name="defaulttemplate"><option value=""><?php echo $this->_tpl_vars['lan']['default']; ?>
</option><?php echo $this->_tpl_vars['selecttemplates']; ?>
</select></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['listtemplate']; ?>
</td><td><select name="listtemplate"><option value=""><?php echo $this->_tpl_vars['lan']['default']; ?>
</option><?php echo $this->_tpl_vars['selecttemplates']; ?>
</select></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['ifcreatehtml']; ?>
</td><td><input type="radio" name="html" value="0"<?php if ($this->_tpl_vars['html'] == 0): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['withglobal']; ?>
<input type="radio" name="html" value="1"<?php if ($this->_tpl_vars['html'] == 1): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['yes']; ?>
<input type="radio" name="html" value="-1"<?php if ($this->_tpl_vars['html'] == -1): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['no']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['sectionhomemethod']; ?>
</td><td><input type="text" value="<?php echo $this->_tpl_vars['sectionhomemethod']; ?>
" name="sectionhomemethod" size="50"><br>(<?php echo $this->_tpl_vars['lan']['leaveempty']; ?>
:"<?php echo $this->_tpl_vars['setting_sectionhomemethod']; ?>
"&nbsp;<a href="setting.php?action=generally"><?php echo $this->_tpl_vars['lan']['modifyglobalsetting']; ?>
</a>)<br><?php echo $this->_tpl_vars['lan']['sectionhomemethod_description']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['sectionpagemethod']; ?>
</td><td><input type="text" value="<?php echo $this->_tpl_vars['sectionpagemethod']; ?>
" name="sectionpagemethod" size="50"><br>(<?php echo $this->_tpl_vars['lan']['leaveempty']; ?>
:"<?php echo $this->_tpl_vars['setting_sectionpagemethod']; ?>
"&nbsp;<a href="setting.php?action=generally"><?php echo $this->_tpl_vars['lan']['modifyglobalsetting']; ?>
</a>)<br><?php echo $this->_tpl_vars['lan']['sectionpagemethod_description']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['order']; ?>
</td><td><input type="text" name="order" value="<?php echo $this->_tpl_vars['orderby']; ?>
"></td></tr><script>document.sectionedit.html.value = "<?php echo $this->_tpl_vars['html']; ?>
";document.sectionedit.defaulttemplate.value = "<?php echo $this->_tpl_vars['defaulttemplate']; ?>
";document.sectionedit.listtemplate.value = "<?php echo $this->_tpl_vars['listtemplate']; ?>
";document.sectionedit.sectionpagemethod.value = "<?php echo $this->_tpl_vars['sectionpagemethod']; ?>
";document.sectionedit.sectionhomemethod.value = "<?php echo $this->_tpl_vars['sectionhomemethod']; ?>
";</script><tr><td colspan="10" align="center"><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
" name="section_edit_submit"></td></tr></form></table></body></html>