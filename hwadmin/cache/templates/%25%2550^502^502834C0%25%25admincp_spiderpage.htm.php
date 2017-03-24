<?php /* Smarty version 2.6.13, created on 2011-10-22 16:59:11
         compiled from admincp_spiderpage.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><form name="editspider" action="spider.php?action=spiderpage" method="POST"><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"><table border="0" align="center" cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td colspan="10"><div class="righttop"></div><?php echo $this->_tpl_vars['lan']['spiderpage']; ?>
</td></tr><tr><td width="120">URL</td><td><input type="text" value="" name="url" class="mustoffer" style="width:500px;"></td></tr><tr><td width="120"><?php echo $this->_tpl_vars['lan']['spiderlistrule']; ?>
</td><td><select id="rule" name="rule"><?php echo $this->_tpl_vars['select']; ?>
</select></td></tr><script>if("<?php echo $this->_tpl_vars['lastrule']; ?>
" != "") $("#rule").val("<?php echo $this->_tpl_vars['lastrule']; ?>
");</script></table><div class="block"></div><center><input type="submit" value="<?php echo $this->_tpl_vars['lan']['spidernow']; ?>
"></center></form></body></html>