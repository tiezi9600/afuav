<?php /* Smarty version 2.6.13, created on 2011-10-22 16:21:54
         compiled from admincp_module.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><body><div class="block"></div><form action="admincp.php?action=modules&job=savemodule" method="post"><table border="0" cellspacing="1" cellpadding="4" class="commontable" align="center"><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"><tr class="header"><td colspan="2"><div class="righttop"></div><?php if ($this->_tpl_vars['modulename'] == ''):  echo $this->_tpl_vars['lan']['add'];  else:  echo $this->_tpl_vars['lan']['edit'];  endif;  echo $this->_tpl_vars['lan']['space'];  echo $this->_tpl_vars['lan']['module']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['modulename']; ?>
</td><td><input type="text" name="modulename" size="9" value="<?php echo $this->_tpl_vars['modulename']; ?>
"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['ifcreatehtml']; ?>
</td><td><input type="radio" id="html0" name="html" value="0"<?php if ($this->_tpl_vars['html'] == 0): ?> checked<?php endif; ?>><label for="html0"><?php echo $this->_tpl_vars['lan']['withglobal']; ?>
</label>&nbsp;<input type="radio" id="html1" name="html" value="1"<?php if ($this->_tpl_vars['html'] == 1): ?> checked<?php endif; ?>><label for="html1"><?php echo $this->_tpl_vars['lan']['yes']; ?>
</label>&nbsp;<input type="radio" id="html-1" name="html" value="-1"<?php if ($this->_tpl_vars['html'] == -1): ?> checked<?php endif; ?>><label for="html-1"><?php echo $this->_tpl_vars['lan']['no']; ?>
</label></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['ispage']; ?>
</td><td><input type="radio" id="page1" name="page" value="1"<?php if ($this->_tpl_vars['page'] == 1): ?> checked<?php endif; ?>><label for="page1"><?php echo $this->_tpl_vars['lan']['yes']; ?>
</label>&nbsp;<input type="radio" id="page-1" name="page" value="-1"<?php if ($this->_tpl_vars['page'] == -1): ?> checked<?php endif; ?>><label for="page-1"><?php echo $this->_tpl_vars['lan']['no']; ?>
</label></td></tr><!--<tr><td><?php echo $this->_tpl_vars['lan']['isgoods']; ?>
</td><td><input type="radio" id="goods1" name="goods" value="1"<?php if ($this->_tpl_vars['goods'] == 1): ?> checked<?php endif; ?>><label for="goods1"><?php echo $this->_tpl_vars['lan']['yes']; ?>
</label>&nbsp;<input type="radio" id="goods-1" name="goods" value="-1"<?php if ($this->_tpl_vars['goods'] == -1): ?> checked<?php endif; ?>><label for="goods-1"><?php echo $this->_tpl_vars['lan']['no']; ?>
</label></td></tr>--><tr><td><?php echo $this->_tpl_vars['lan']['numperpage']; ?>
</td><td><input type="text" name="numperpage" value="<?php echo $this->_tpl_vars['numperpage']; ?>
" size="9"></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['picturemaxsize']; ?>
</td><td><input type="text" name="picturemaxsize" value="<?php echo $this->_tpl_vars['picturemaxsize']; ?>
" size="9"></td></tr><tr><td colspan="2"><table border="0" cellspacing="1" cellpadding="5" class="commontable" align="center" id="fieldslist"><tr class="header"><td colspan="8"><?php echo $this->_tpl_vars['lan']['fieldsetting']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['field']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['alias']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['order']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['listorder']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['description']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['default']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['fieldsize']; ?>
</td><td><?php echo $this->_tpl_vars['lan']['type']; ?>
</td></tr><?php echo $this->_tpl_vars['fieldshtml']; ?>
</table><div class="block2"></div><center><input type="submit" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
" /></center></td></tr></table></form><script>function addfield() {var trid = fieldslist.rows.length;var objRow = fieldslist.insertRow(trid);var objCel = objRow.insertCell(0);objCel.innerHTML = "<input type='text' name='extfield" + trid + "' value='' size='12'>";var objCel = objRow.insertCell(1);objCel.innerHTML = "<input type='text' name='extfield_alias" + trid + "' value='' size='10'>";var objCel = objRow.insertCell(2);objCel.innerHTML = "<input type='text' name='extfield_order" + trid + "' value='' size='3'>";var objCel = objRow.insertCell(3);objCel.innerHTML = "<input type='text' name='extfield_listorder" + trid + "' value='' size='3'>";var objCel = objRow.insertCell(4);objCel.innerHTML = "<input type='text' name='extfield_description" + trid + "' value='' size='16'>";var objCel = objRow.insertCell(5);objCel.innerHTML = "<input type='text' name='extfield_default" + trid + "' value='' size='10'>";var objCel = objRow.insertCell(6);objCel.innerHTML = "<input type='text' name='extfield_size" + trid + "' value='' size='9'>";var objCel = objRow.insertCell(7);objCel.innerHTML = "<select name='extfield_type" + trid + "' id='extfield_type" + trid + "' ><option value='plain'><?php echo $this->_tpl_vars['lan']['plaintext']; ?>
</option><option value='rich'><?php echo $this->_tpl_vars['lan']['richtext']; ?>
</option></select>";}</script></body></html>