<?php /* Smarty version 2.6.13, created on 2011-12-28 15:12:21
         compiled from admincp_ses.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "xmlhttp.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script>function indexnum(id) {$.get('se.php?action=indexnum&rand=' + Math.random() + '&id=' + id, recall);}function recall(strers) {num = strers.split('#');$("#index_"+num[0]).html(num[1]);$("#unindexed_"+num[0]).html(num[2]);}</script><body><div class="block"></div><table cellspacing="1" cellpadding="4" align="center" class="commontable"><tr class="header"><td colspan="3"><div class="righttop"></div><?php echo $this->_tpl_vars['lan']['searchengine']; ?>
</td></tr><tr><td><table border="0" cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td width="35">ID</td><td><?php echo $this->_tpl_vars['lan']['searchengine'];  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['name']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['itemnum']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['unindexednum']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['index'];  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['update'];  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['time']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['updateindex']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['rebuildindex']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['del']; ?>
</td></tr><?php echo $this->_tpl_vars['seslist']; ?>
<tr><td colspan="10"><input type="button" onclick="document.location='se.php?action=add'" value="<?php echo $this->_tpl_vars['lan']['add'];  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['searchengine']; ?>
"></td></tr></table></td></tr></table></body></html>