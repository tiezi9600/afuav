<?php /* Smarty version 2.6.13, created on 2011-10-22 13:22:51
         compiled from admincp_allcomments.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script language="javascript">function confirmdelete() {if(!confirm('<?php echo $this->_tpl_vars['lan']['suredelcomment']; ?>
')) {return false;}}function confirmdenyip() {if(!confirm('<?php echo $this->_tpl_vars['lan']['suredenycommentip']; ?>
')) {return false;}}function review(obj) {$('#review' + obj).show();$('#save' + obj).focus();$('#textarea' + obj).focus();}</script><style>.reviewdiv{display:none;}</style><body><div class="block"></div><iframe name="work" style="display:none"></iframe><table border="0" align="center" cellpadding="4" cellspacing="1" class="commontable width100"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['comment']; ?>
</td></tr><?php echo $this->_tpl_vars['comments']; ?>
<form action="<?php echo $this->_tpl_vars['indexurl']; ?>
" method="post"><tr class="header"><td><form action="admincp.php?action=allcomments" method="post"><ul class="index"><?php echo $this->_tpl_vars['str_index']; ?>
</ul></form></td></tr></form></table></body></html>