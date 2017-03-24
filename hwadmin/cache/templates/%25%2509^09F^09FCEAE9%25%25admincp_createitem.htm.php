<?php /* Smarty version 2.6.13, created on 2013-03-23 12:42:41
         compiled from admincp_createitem.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['header_charset']; ?>
"><link href="images/admin/admin.css" rel="stylesheet" type="text/css"><?php if ($this->_tpl_vars['url_forward'] != 'stop'): ?><meta http-equiv="refresh" content="<?php echo $this->_tpl_vars['timeout']; ?>
 url=<?php echo $this->_tpl_vars['url_forward']; ?>
"><?php endif; ?></head><body><div class="block"></div><table align="center" cellpadding="4" cellspacing="1" class="commontable"><tr class="header"><td colspan="2"><?php echo $this->_tpl_vars['lan']['createitembatch']; ?>
</td></tr><form action="admincp.php" method="get" name="batchform"><tr><td><?php echo $this->_tpl_vars['lan']['choosecategory']; ?>
</td><td><select name="category"><option value="-1"><?php echo $this->_tpl_vars['lan']['allcategory']; ?>
+<?php echo $this->_tpl_vars['lan']['page']; ?>
</option><option value="0"><?php echo $this->_tpl_vars['lan']['allcategory']; ?>
</option><?php echo $this->_tpl_vars['categories']; ?>
</select></td></tr><tr><td><?php echo $this->_tpl_vars['lan']['choosestep']; ?>
</td> <td><select name="step"><option value="1">1</option><option value="5">5</option><option value="10">10</option><option value="40">40</option><option value="50">50</option><option value="60">60</option><option value="70">70</option><option value="100">100</option></select></td></tr><tr><td colspan="2"><input type="hidden" name="action" value="createitem"><div align="center"><input type="submit" name="createitemsubmit" value="<?php echo $this->_tpl_vars['lan']['start']; ?>
"></div></td></tr></form></table></body></html>