<?php /* Smarty version 2.6.13, created on 2011-10-22 15:30:50
         compiled from admincp_sections.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script language="javascript">function deletesection(id) {if(confirm('<?php echo $this->_tpl_vars['lan']['suredelsection']; ?>
')) {document.location='admincp.php?action=deletesection&vc=<?php echo $this->_tpl_vars['vc']; ?>
&id='+id;}}</script><body><div class="block"></div><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td width="35">ID</td><td width="90"><?php echo $this->_tpl_vars['lan']['section_name']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['description']; ?>
</td><td width="60"><?php echo $this->_tpl_vars['lan']['item_num']; ?>
</td><td width="60"><?php echo $this->_tpl_vars['lan']['createdefault']; ?>
</td><td width="80"><div align="center"><strong><?php echo $this->_tpl_vars['lan']['order']; ?>
</strong></div></td><td width="50"><div align="center"><strong><?php echo $this->_tpl_vars['lan']['delete']; ?>
</strong></div></td></tr><?php echo $this->_tpl_vars['str_sections']; ?>
</table><div class="block"></div><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="commontable"><form action="admincp.php?action=newsection" method="post"><tr class="header"><td colspan="10"><?php echo $this->_tpl_vars['lan']['section_new']; ?>
</td></tr><tr><td width="50"><?php echo $this->_tpl_vars['lan']['section_name']; ?>
</td><td><input type="text" value="" name="section" class="mustoffer"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['alias']; ?>
</td><td><input type="text" value="" name="alias"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['description']; ?>
</td><td><textarea name="description" cols="60" rows="5"></textarea></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['keywords']; ?>
</td><td><textarea name="keywords" cols="60" rows="3"></textarea></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['defaulttemplate']; ?>
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
</td><td><input type="text" value="" name="sectionhomemethod" size="50"><br>(<?php echo $this->_tpl_vars['lan']['leaveempty']; ?>
:"<?php echo $this->_tpl_vars['setting_sectionhomemethod']; ?>
"&nbsp;<a href="setting.php?action=generally"><?php echo $this->_tpl_vars['lan']['modifyglobalsetting']; ?>
</a>)<br><?php echo $this->_tpl_vars['lan']['sectionhomemethod_description']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['sectionpagemethod']; ?>
</td><td><input type="text" value="" name="sectionpagemethod" size="50"><br>(<?php echo $this->_tpl_vars['lan']['leaveempty']; ?>
:"<?php echo $this->_tpl_vars['setting_sectionpagemethod']; ?>
"&nbsp;<a href="setting.php?action=generally"><?php echo $this->_tpl_vars['lan']['modifyglobalsetting']; ?>
</a>)<br><?php echo $this->_tpl_vars['lan']['sectionpagemethod_description']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['order']; ?>
</td><td><input type="text" value="0" name="order"></td></tr><tr><td colspan="10" align="center"><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
" name="section_new_submit"></td></tr></form></table></body></html>