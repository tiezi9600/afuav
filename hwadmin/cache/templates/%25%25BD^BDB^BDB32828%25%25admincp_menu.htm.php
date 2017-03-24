<?php /* Smarty version 2.6.13, created on 2011-10-22 12:26:18
         compiled from admincp_menu.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_xheader.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<base target="mainFrame">
<body>
<div class="block"></div>
<table cellspacing="1" cellpadding="4" class="commontable width100">
	<tr class="header">
		<td align="center"><?php echo $this->_tpl_vars['lan']['content']; ?>
</td>
	</tr>
	<tr>
		<td>
			<a href="admincp.php?action=specialpages"><?php echo $this->_tpl_vars['lan']['page']; ?>
</a><br />
			<div class="r"><a href="admincp.php?action=newitem">+</a></div><a href="admincp.php?action=items"><?php echo $this->_tpl_vars['defaultmodule']['modulename']; ?>
</a><br />
<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
<?php if ($this->_tpl_vars['module']['id'] != 1): ?>
<div class="r"><a href="admincp.php?action=newitem&module=<?php echo $this->_tpl_vars['module']['id']; ?>
">+</a></div><a href="admincp.php?action=items&module=<?php echo $this->_tpl_vars['module']['id']; ?>
"><?php echo $this->_tpl_vars['module']['modulename']; ?>
</a><br />
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
			<a href="spider.php?action=spiderpage"><?php echo $this->_tpl_vars['lan']['spiderpage']; ?>
</a><br />
			<a href="admincp.php?action=users"><?php echo $this->_tpl_vars['lan']['user']; ?>
</a><br />
			<a href="admincp.php?action=allcomments"><?php echo $this->_tpl_vars['lan']['comment']; ?>
</a>
		</td>
	</tr>
</table>
<?php if ($this->_tpl_vars['iscreator'] == 1): ?>
<div class="block"></div>
<table cellspacing="1" cellpadding="4" class="commontable width100">
	<tr class="header">
		<td align="center"><?php echo $this->_tpl_vars['lan']['system']; ?>
</td>
	</tr>
	<tr>
		<td>
			<a href="admincp.php?action=categories"><?php echo $this->_tpl_vars['lan']['category']; ?>
</a><br />
			<a href="admincp.php?action=sections"><?php echo $this->_tpl_vars['lan']['section']; ?>
</a><br />
			<a href="admincp.php?action=templates"><?php echo $this->_tpl_vars['lan']['template']; ?>
</a><br />
			<a href="admincp.php?action=variables"><?php echo $this->_tpl_vars['lan']['variable']; ?>
</a><br />
			<a href="admincp.php?action=modules"><?php echo $this->_tpl_vars['lan']['module']; ?>
</a><br />
			<a href="se.php"><?php echo $this->_tpl_vars['lan']['searchengine']; ?>
</a><br />
			<a href="spider.php"><?php echo $this->_tpl_vars['lan']['spider']; ?>
</a><br />
		</td>
	</tr>
</table>
<?php endif; ?>
<div class="block"></div>
<table cellspacing="1" cellpadding="4" class="commontable width100">
	<tr class="header">
		<td align="center"><?php echo $this->_tpl_vars['lan']['batchcreatehtml']; ?>
</td>
	</tr>
	<tr>
		<td>
			<a href="admincp.php?action=createcategory"><?php echo $this->_tpl_vars['lan']['createcategory']; ?>
</a><br />
			<a href="admincp.php?action=createitem"><?php echo $this->_tpl_vars['lan']['createitem']; ?>
</a>
		</td>
	</tr>
</table>
<div class="block"></div>
<table cellspacing="1" cellpadding="4" class="commontable width100">
	<tr class="header">
		<td align="center"><?php echo $this->_tpl_vars['lan']['account']; ?>
</td>
	</tr>
	<tr>
		<td>
			<?php if ($this->_tpl_vars['iscreator'] == 1): ?><a href="account.php?action=manageaccounts"><?php echo $this->_tpl_vars['lan']['accountmanage']; ?>
</a><br /><?php endif; ?>
			<a href="account.php?action=changepassword"><?php echo $this->_tpl_vars['lan']['changepassword']; ?>
</a><br />
			<a href="account.php?action=logout" target="_parent"><?php echo $this->_tpl_vars['lan']['logout']; ?>
</a>
		</td>
	</tr>
</table>
</body>
</html>