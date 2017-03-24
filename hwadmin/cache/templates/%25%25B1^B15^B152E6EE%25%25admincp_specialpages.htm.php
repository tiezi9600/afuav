<?php /* Smarty version 2.6.13, created on 2011-10-22 12:44:52
         compiled from admincp_specialpages.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script language="javascript">function confirmdelete() {if(!confirm('<?php echo $this->_tpl_vars['lan']['suredelitem']; ?>
')) {return false;}}</script><body><div class="block"></div><iframe name="work" width="1" height="1" src="" style="display:none"></iframe><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td width="20">ID</td><td width="160"><?php echo $this->_tpl_vars['lan']['pagename']; ?>
</td><td width="100"><?php echo $this->_tpl_vars['lan']['template']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['filename']; ?>
</td><td align="center">PV</td><td align="center"><?php echo $this->_tpl_vars['lan']['preview']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['lan']['realurl']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['lan']['delete']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['lan']['createhtml']; ?>
</td></tr><?php echo $this->_tpl_vars['str_pages']; ?>
</table><div class="block"></div><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td colspan="2"><?php echo $this->_tpl_vars['lan']['add']; ?>
</td></tr><form name="newpage" action="admincp.php?action=specialpages&job=newpage" method="POST"><tr><td width="50"><?php echo $this->_tpl_vars['lan']['pagename']; ?>
</td><td><input type="text" name="pagename" size="20" class="mustoffer"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['template']; ?>
</td><td><select name="template" class="mustoffer"><?php echo $this->_tpl_vars['str_templates']; ?>
</select></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['filename']; ?>
</td><td><input type="text" name="filename" size="20" class="mustoffer" value="/"></td></tr><tr><td style="text-align:center" colspan="2"><input type="submit" name="savenewpage" size="20" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
"></td></tr></form></table></body></html>