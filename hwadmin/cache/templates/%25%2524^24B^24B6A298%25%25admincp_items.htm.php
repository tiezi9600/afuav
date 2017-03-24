<?php /* Smarty version 2.6.13, created on 2011-10-22 12:29:49
         compiled from admincp_items.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script language="javascript">function confirmdelete() {if(!confirm('<?php echo $this->_tpl_vars['lan']['suredelitem']; ?>
')) {return false;}}function invertselection() {for(i = 0; i < document.batchform.elements.length; i++) {if(document.batchform.elements[i].type == 'checkbox' && document.batchform.elements[i].name == 'batch[]') {if(document.batchform.elements[i].checked == true) {document.batchform.elements[i].checked = false;} else {document.batchform.elements[i].checked = true;}}}}function batch() {batchtype = document.batchform.batchtype;$("#neworder").hide();$("#newcategory").hide();if(batchtype.value == "setorder") {$("#neworder").show();}if(batchtype.value == "setcategory") {$("#newcategory").show();}}</script><body><div class="block"></div><iframe name="work" style="display:none"></iframe><table border="0" align="center" cellpadding="4" cellspacing="1" class="commontable width100"><form action="admincp.php" method="get"><input type="hidden" name="module" value="<?php echo $this->_tpl_vars['moduleid']; ?>
"><input type="hidden" name="action" value="items"><tr class="header"><td colspan="99"><div class="righttop"><a href="admincp.php?action=modules&job=editmodule&id=<?php echo $this->_tpl_vars['moduleid']; ?>
"><?php echo $this->_tpl_vars['lan']['modifyfield']; ?>
</a></div><?php echo $this->_tpl_vars['lan']['query']; ?>
</td></tr><tr><td colspan="99">ID&nbsp;<input type="text" value="<?php echo $this->_tpl_vars['get']['id']; ?>
" name="id" size="5"><?php echo $this->_tpl_vars['lan']['key']; ?>
&nbsp;<input type="text" value="<?php echo $this->_tpl_vars['get']['key']; ?>
" name="key" size="10"><?php echo $this->_tpl_vars['lan']['editor']; ?>
&nbsp;<input type="text" value="<?php echo $this->_tpl_vars['get']['editor']; ?>
" name="editor" size="7"><?php if ($this->_tpl_vars['selectcategories']):  echo $this->_tpl_vars['lan']['category']; ?>
&nbsp;<select name="category" id="querycategory"><?php echo $this->_tpl_vars['selectcategories']; ?>
</select><?php else:  echo $this->_tpl_vars['lan']['category'];  echo $this->_tpl_vars['lan']['space']; ?>
ID&nbsp;<input type="text" size="6" name="category" value="" /><?php endif;  echo $this->_tpl_vars['lan']['section']; ?>
&nbsp;<select name="section" id="querysection"><option value=""><?php echo $this->_tpl_vars['lan']['allsection']; ?>
</option><?php echo $this->_tpl_vars['selectsections']; ?>
</select><?php echo $this->_tpl_vars['lan']['orderby']; ?>
&nbsp;<select name="orderby" id="queryorderby"><option value="dateline"><?php echo $this->_tpl_vars['lan']['time']; ?>
</option><option value="orderby"><?php echo $this->_tpl_vars['lan']['order']; ?>
</option><option value="pageview"><?php echo $this->_tpl_vars['lan']['pvs']; ?>
</option></select><script>$("#querycategory").val("<?php echo $this->_tpl_vars['get']['category']; ?>
");$("#querysection").val("<?php echo $this->_tpl_vars['get']['section']; ?>
");$("#queryorderby").val("<?php if ($this->_tpl_vars['get']['orderby'] == ""): ?>orderby<?php else:  echo $this->_tpl_vars['get']['orderby'];  endif; ?>");</script><input type="submit" value="<?php echo $this->_tpl_vars['lan']['query']; ?>
"></td></tr></form><tr class="header"><td>ID</td><?php echo $this->_tpl_vars['fieldsheader']; ?>
<td align="center"><?php echo $this->_tpl_vars['lan']['delete']; ?>
</td><?php if ($this->_tpl_vars['page'] > 0): ?><td align="center"><?php echo $this->_tpl_vars['lan']['preview']; ?>
</td><td align="center"><?php echo $this->_tpl_vars['lan']['realurl']; ?>
</td><?php endif;  if ($this->_tpl_vars['page'] > 0 && $this->_tpl_vars['html'] > 0): ?><td align="center"><?php echo $this->_tpl_vars['lan']['createhtml']; ?>
</td><?php endif; ?></tr><form name="batchform" action="admincp.php?action=items" method="post" onSubmit="return checkbatch()"><?php echo $this->_tpl_vars['str_items']; ?>
<tr><td colspan="99"><script>function checkbatch() {if($('#batchtype').val() == '') {alert('<?php echo $this->_tpl_vars['lan']['pleasechoose']; ?>
');return false;}}</script><input name="button" type="button" onClick="invertselection()" value="<?php echo $this->_tpl_vars['lan']['invertselection']; ?>
">&nbsp;<select name="batchtype" id="batchtype" onChange="batch()"><option value=""><?php echo $this->_tpl_vars['lan']['pleasechoose']; ?>
</option><option value="delete"><?php echo $this->_tpl_vars['lan']['delete']; ?>
</option><option value="createhtml"><?php echo $this->_tpl_vars['lan']['createhtml']; ?>
</option><option value="setorder"><?php echo $this->_tpl_vars['lan']['modifyorder']; ?>
</option><option value="setcategory"><?php echo $this->_tpl_vars['lan']['modifycategory']; ?>
</option></select>&nbsp;<span style="display:none" id="neworder"><?php echo $this->_tpl_vars['lan']['neworder']; ?>
<input type="text" name="neworder" value="0" size="10"></span><span style="display:none" id="newcategory"><?php echo $this->_tpl_vars['lan']['newcategory']; ?>
<select name="newcategory"><option value="0"><?php echo $this->_tpl_vars['lan']['pleasechoose']; ?>
</option><?php echo $this->_tpl_vars['selectcategories']; ?>
</select></span>&nbsp;<input type="submit" value="<?php echo $this->_tpl_vars['lan']['batch']; ?>
" name="batchsubmit"></td></tr></form><form action="<?php echo $this->_tpl_vars['indexurl']; ?>
" method="post"><tr class="header"><td colspan="99"><ul class="index"><?php echo $this->_tpl_vars['str_index']; ?>
</ul></td></tr></form></table></body></html>