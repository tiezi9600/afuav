<?php /* Smarty version 2.6.13, created on 2011-12-28 15:12:25
         compiled from admincp_se.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><form action="se.php?action=save" method="post"><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"><table border="0" cellspacing="1" cellpadding="4" class="commontable" align="center"><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"><tr class="header"><td colspan="2"><div class="righttop"></div><?php if ($this->_tpl_vars['name'] == ''):  echo $this->_tpl_vars['lan']['add'];  else:  echo $this->_tpl_vars['lan']['edit'];  endif;  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['searchengine']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['searchengine'];  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['name']; ?>
</td><td><input type="text" name="name" size="15" value="<?php echo $this->_tpl_vars['name']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['indexfield']; ?>
</td><td><input type="text" name="field" size="40" value="<?php echo $this->_tpl_vars['field']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['indexwhere']; ?>
</td><td><input type="text" name="where" size="40" value="<?php echo $this->_tpl_vars['where']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['dic']; ?>
</td><td><input type="text" name="dic" size="20" value="<?php echo $this->_tpl_vars['dic']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['indexpath']; ?>
</td><td><input type="text" name="path" size="20" value="<?php echo $this->_tpl_vars['path']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['orderby']; ?>
</td><td><input type="checkbox" id="time" name="orderby[]" size="20" value="time"><label for="time"><?php echo $this->_tpl_vars['lan']['time']; ?>
</label><input type="checkbox" id="count" name="orderby[]" size="20" value="count"><label for="count"><?php echo $this->_tpl_vars['lan']['keywords'];  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['count']; ?>
</label></td></tr></table><?php $_from = $this->_tpl_vars['orderby']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['o']):
?><script>$("#<?php echo $this->_tpl_vars['o']; ?>
").attr("checked", true);</script><?php endforeach; endif; unset($_from); ?><br><center><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
"></center></form></body></html>