<?php /* Smarty version 2.6.13, created on 2011-10-22 17:00:39
         compiled from G:%5CProgram+Files%5Cwamp%5Cwww%5Chwadmin%5Ctemplates/%2Clogin.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312" /><title></title><link href="http://cdn.akcms.com/css/user.css" rel="stylesheet" type="text/css"><script language="javascript" src="http://cdn.akcms.com/js/jquery.js"></script></head><body><div class="ak_nav"><a href="?action=login"><?php echo $this->_tpl_vars['lan']['login']; ?>
</a><a href="?action=reg"><?php echo $this->_tpl_vars['lan']['register']; ?>
</a></div><div class="ak_body"><h2 class="ak_bodytitle"><?php echo $this->_tpl_vars['lan']['login']; ?>
</h2><form action="" method="post"><input type="hidden" name="action" value="login"><div class="ak_line"><div class="ak_label"><?php echo $this->_tpl_vars['accounttitle']; ?>
:</div><div class="ak_input"><input type="text" class="ak_inputtext" name="username"></div></div><div class="ak_line"><div class="ak_label"><?php echo $this->_tpl_vars['lan']['password']; ?>
:</div><div class="ak_input"><input type="password" class="ak_inputtext" name="password"><a href="?action=resetpassword"><?php echo $this->_tpl_vars['lan']['forgetpassword']; ?>
</a></div></div><div class="ak_line"><div class="ak_label"></div><div class="ak_input"><input type="submit" class="ak_inputbutton" value="<?php echo $this->_tpl_vars['lan']['login']; ?>
"></div></div><div class="ak_line"><div class="ak_label"></div><div class="ak_input"><a href="?action=qqwblogin"><img src="http://www.akcms.com/images/cdn/qqwb.gif" border="0" /></a></div></div><div><a href="?action=reg"><?php echo $this->_tpl_vars['lan']['noaccount']; ?>
</a></div></form></div><div class="ak_footer">[powered]</div></body></html>