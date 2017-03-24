<?php /* Smarty version 2.6.13, created on 2011-10-22 12:29:53
         compiled from admincp_category_edit.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script>function delcategory() {if(confirm('<?php echo $this->_tpl_vars['lan']['suredelpage']; ?>
')) {document.location = "admincp.php?action=deletecategory&id=<?php echo $this->_tpl_vars['id']; ?>
&vc=<?php echo $this->_tpl_vars['vc']; ?>
";}}</script><body><div class="block"></div><table cellpadding="4" cellspacing="1" class="commontable width100"><form action="admincp.php?action=editcategory&id=<?php echo $this->_tpl_vars['id']; ?>
" method="post" name="categoryedit"><tr class="header"><td colspan="9"><?php echo $this->_tpl_vars['lan']['category_edit']; ?>
</td></tr><tr><td width="100"><?php echo $this->_tpl_vars['lan']['category_name']; ?>
</td><td><input type="text" name="category" value="<?php echo $this->_tpl_vars['category']; ?>
" class="mustoffer">&nbsp;<input type="button" value="<?php echo $this->_tpl_vars['lan']['delete']; ?>
" name="delete" class="alert" onclick="delcategory()"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['alias']; ?>
</td><td><input type="text" name="alias" value="<?php echo $this->_tpl_vars['alias']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['categoryup']; ?>
</td><td><?php if ($this->_tpl_vars['selectcategories']): ?><select name="categoryup"><option value="0"><?php echo $this->_tpl_vars['lan']['rootcategory']; ?>
</option><?php echo $this->_tpl_vars['selectcategories']; ?>
</select><?php else: ?><input type="text" size="6" name="categoryup" value="0"><?php endif; ?></td></tr><script language="javascript">document.categoryedit.categoryup.value = <?php echo $this->_tpl_vars['categoryup']; ?>
;</script><tr><td><?php echo $this->_tpl_vars['lan']['bindmodule']; ?>
</td><td><select name="module"><?php echo $this->_tpl_vars['selectmodules']; ?>
</select></td></tr><script language="javascript">document.categoryedit.module.value = <?php echo $this->_tpl_vars['module']; ?>
;</script><tr><td><?php echo $this->_tpl_vars['lan']['description']; ?>
</td><td><textarea name="description" cols="80" rows="3"><?php echo $this->_tpl_vars['description']; ?>
</textarea></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['keywords']; ?>
</td><td><textarea name="keywords" cols="80" rows="3"><?php echo $this->_tpl_vars['keywords']; ?>
</textarea></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['order']; ?>
</td><td><input type="text" name="order" value="<?php echo $this->_tpl_vars['orderby']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['path']; ?>
</td><td><input type="text" name="path" value="<?php echo $this->_tpl_vars['path']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['itemtemplate']; ?>
</td><td><select name="itemtemplate"><option value=""><?php echo $this->_tpl_vars['lan']['default']; ?>
</option><?php echo $this->_tpl_vars['selecttemplates']; ?>
</select></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['defaulttemplate']; ?>
</td><td><select name="defaulttemplate"><option value=""><?php echo $this->_tpl_vars['lan']['default']; ?>
</option><?php echo $this->_tpl_vars['selecttemplates']; ?>
</select></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['listtemplate']; ?>
</td><td><select name="listtemplate"><option value=""><?php echo $this->_tpl_vars['lan']['default']; ?>
</option><?php echo $this->_tpl_vars['selecttemplates']; ?>
</select></td></tr><script>document.categoryedit.itemtemplate.value = "<?php echo $this->_tpl_vars['itemtemplate']; ?>
";document.categoryedit.defaulttemplate.value = "<?php echo $this->_tpl_vars['defaulttemplate']; ?>
";document.categoryedit.listtemplate.value = "<?php echo $this->_tpl_vars['listtemplate']; ?>
";</script> <tr><td><?php echo $this->_tpl_vars['lan']['ifcreatehtml']; ?>
</td><td><input type="radio" name="html" value="0"<?php if ($this->_tpl_vars['html'] == 0): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['withglobal']; ?>
<input type="radio" name="html" value="1"<?php if ($this->_tpl_vars['html'] == 1): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['yes']; ?>
<input type="radio" name="html" value="-1"<?php if ($this->_tpl_vars['html'] == -1): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['no']; ?>
<script language="javascript">document.categoryedit.html.value = "<?php echo $this->_tpl_vars['html']; ?>
";</script></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['iffilename']; ?>
</td><td><input type="radio" name="usefilename" value="0"<?php if ($this->_tpl_vars['usefilename'] == 0): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['withglobal']; ?>
<input type="radio" name="usefilename" value="1"<?php if ($this->_tpl_vars['usefilename'] == 1): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['yes']; ?>
<input type="radio" name="usefilename" value="-1"<?php if ($this->_tpl_vars['usefilename'] == -1): ?> checked<?php endif; ?>><?php echo $this->_tpl_vars['lan']['no']; ?>
<script language="javascript">document.categoryedit.usefilename.value = "<?php echo $this->_tpl_vars['usefilename']; ?>
";</script></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['storemethod']; ?>
</td><td><input type="text" value="<?php echo $this->_tpl_vars['storemethod']; ?>
" name="storemethod" size="50"><br>(<?php echo $this->_tpl_vars['lan']['leaveempty']; ?>
:"<?php echo $this->_tpl_vars['setting_storemethod']; ?>
"&nbsp;<a href="setting.php?action=generally"><?php echo $this->_tpl_vars['lan']['modifyglobalsetting']; ?>
</a>)<br><?php echo $this->_tpl_vars['lan']['storemethod_description']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['categoryhomemethod']; ?>
</td><td><input type="text" value="<?php echo $this->_tpl_vars['categoryhomemethod']; ?>
" name="categoryhomemethod" size="50"><br>(<?php echo $this->_tpl_vars['lan']['leaveempty']; ?>
:"<?php echo $this->_tpl_vars['setting_categoryhomemethod']; ?>
"&nbsp;<a href="setting.php?action=generally"><?php echo $this->_tpl_vars['lan']['modifyglobalsetting']; ?>
</a>)<br><?php echo $this->_tpl_vars['lan']['categoryhomemethod_description']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['categorypagemethod']; ?>
</td><td><input type="text" value="<?php echo $this->_tpl_vars['categorypagemethod']; ?>
" name="categorypagemethod" size="50"><br>(<?php echo $this->_tpl_vars['lan']['leaveempty']; ?>
:"<?php echo $this->_tpl_vars['setting_categorypagemethod']; ?>
"&nbsp;<a href="setting.php?action=generally"><?php echo $this->_tpl_vars['lan']['modifyglobalsetting']; ?>
</a>)<br><?php echo $this->_tpl_vars['lan']['pagemethod_description']; ?>
</td></tr><tr><td colspan="9" align="center"><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
" name="category_edit_submit"></td></tr></form></table></body></html>