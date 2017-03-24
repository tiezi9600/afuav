<?php /* Smarty version 2.6.13, created on 2011-10-22 17:01:05
         compiled from G:%5CProgram+Files%5Cwamp%5Cwww%5Chwadmin%5Ctemplates/%2Cresetpassword.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312" /><title></title><link href="http://cdn.akcms.com/css/user.css" rel="stylesheet" type="text/css"><script language="javascript" src="http://cdn.akcms.com/js/jquery.js"></script></head><body><div class="ak_nav"><a href="?action=login"><?php echo $this->_tpl_vars['lan']['login']; ?>
</a><a href="?action=reg"><?php echo $this->_tpl_vars['lan']['register']; ?>
</a></div><div class="ak_body"><h2 class="ak_bodytitle"><?php echo $this->_tpl_vars['lan']['resetpassword']; ?>
</h2><form action="<?php echo $this->_tpl_vars['userphpname']; ?>
?action=resetpassword" method="post"><div class="ak_line"><div class="ak_label">Email:</div><div class="ak_input"><input type="text" name="email"></div></div><div class="ak_line"><div class="ak_label"></div><div class="ak_input"><input type="submit" class="ak_inputbutton" value="<?php echo $this->_tpl_vars['lan']['save']; ?>
"></div></div></form></div><div class="ak_footer">[powered]</div></body></html>