<?php /* Smarty version 2.6.13, created on 2011-10-22 12:26:08
         compiled from message.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['header_charset']; ?>
"><title><?php echo $this->_tpl_vars['sitename']; ?>
 <?php echo $this->_tpl_vars['lan']['cp']; ?>
</title><link href="<?php echo $this->_tpl_vars['ak_url']; ?>
/images/admin/admin.css" rel="stylesheet" type="text/css"><?php if ($this->_tpl_vars['url_forward'] != '' && $this->_tpl_vars['url_forward'] != 'back'): ?><meta http-equiv="refresh" content="<?php echo $this->_tpl_vars['timeout']; ?>
 url=<?php echo $this->_tpl_vars['url_forward']; ?>
"><?php endif; ?><script>function backurl() {history.go(-1);}</script></head><body><div class="block"></div><table border="0" cellspacing="1" cellpadding="4" width="400" class="commontable"><tr class="header"><td><?php echo $this->_tpl_vars['sitename'];  echo $this->_tpl_vars['lan']['cp']; ?>
</td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr height="80"><td width="80" align="center"><img src="<?php echo $this->_tpl_vars['ak_url']; ?>
images/admin/icon_<?php echo $this->_tpl_vars['flag']; ?>
.gif"></td><td><?php echo $this->_tpl_vars['message']; ?>
<br><?php if ($this->_tpl_vars['url_forward'] == 'back'): ?><a href="javascript:backurl()"><?php echo $this->_tpl_vars['lan']['clickfortarget']; ?>
</a><?php elseif ($this->_tpl_vars['url_forward'] != ''): ?><a href="<?php echo $this->_tpl_vars['url_forward']; ?>
"><?php echo $this->_tpl_vars['lan']['clickfortarget']; ?>
</a><?php endif; ?></td></tr></table></td></tr></table><?php if ($this->_tpl_vars['url_forward'] == 'back'): ?><script>setTimeout("backurl()", <?php echo $this->_tpl_vars['timeout_micro']; ?>
);</script><?php endif; ?></body></html>