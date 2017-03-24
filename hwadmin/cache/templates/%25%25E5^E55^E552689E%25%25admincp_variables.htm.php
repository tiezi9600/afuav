<?php /* Smarty version 2.6.13, created on 2011-12-20 08:41:29
         compiled from admincp_variables.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script language="javascript">function deletevariable(variable) {if(confirm('<?php echo $this->_tpl_vars['lan']['suredelvariable']; ?>
')) {document.location='admincp.php?action=variables&job=delete&vc=<?php echo $this->_tpl_vars['vc']; ?>
&variable=' + variable;}}</script><body><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td colspan="3"><div class="righttop"></div><?php echo $this->_tpl_vars['lan']['system_variables']; ?>
</td></tr><tr><td><table cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td width="30">ID</td><td width="100"><?php echo $this->_tpl_vars['lan']['variable']; ?>
</td><td width="100"><?php echo $this->_tpl_vars['lan']['description']; ?>
</td><td width="30"><?php echo $this->_tpl_vars['lan']['value']; ?>
</td><td width="30"><?php echo $this->_tpl_vars['lan']['edit']; ?>
</td><td width="30"><?php echo $this->_tpl_vars['lan']['delete']; ?>
</td></tr><?php echo $this->_tpl_vars['variables']; ?>
</table><div class="block"></div><form action="admincp.php?action=variables&job=new" method="post"><table cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td colspan="2"><?php echo $this->_tpl_vars['lan']['addnewvariable']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['variable']; ?>
</td><td><input type="text" name="variable" size="20" class="mustoffer"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['description']; ?>
</td><td><textarea name="description" cols="60" rows="3" class="mustoffer"></textarea></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['value']; ?>
</td><td><textarea name="value" cols="60" rows="3" class="mustoffer"></textarea></td></tr><tr><td colspan="2" align="center"><input type="submit" name="addnewtemplate" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
"></td></tr></table></form></td></tr></table></body></html>