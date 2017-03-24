<?php /* Smarty version 2.6.13, created on 2011-10-22 15:24:37
         compiled from admincp_welcome.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><base target="_blank"><body><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td><div class="righttop"><?php echo $this->_tpl_vars['lan']['welcome']; ?>
,<?php echo $this->_tpl_vars['admin_id']; ?>
</div><?php echo $this->_tpl_vars['lan']['siteinfo']; ?>
</td></tr><tr><td>
<?php echo $this->_tpl_vars['lan']['siteitems']; ?>
:<?php echo $this->_tpl_vars['items']; ?>
<br><?php echo $this->_tpl_vars['lan']['sitepvs']; ?>
:<?php echo $this->_tpl_vars['pvs']; ?>
<br><?php echo $this->_tpl_vars['lan']['siteeditors']; ?>
:<?php echo $this->_tpl_vars['editors']; ?>
<br><?php echo $this->_tpl_vars['lan']['siteattachments']; ?>
:<?php echo $this->_tpl_vars['attachments']; ?>
<br><?php echo $this->_tpl_vars['lan']['siteattachmentsizes']; ?>
:<?php echo $this->_tpl_vars['attachmentsizes']; ?>
<br></td></tr></table><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['systeminfo']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['os']; ?>
:<?php echo $this->_tpl_vars['os']; ?>
<br><?php echo $this->_tpl_vars['lan']['phpversion']; ?>
:<a href="welcome.php?action=phpinfo" target="_self"><?php echo $this->_tpl_vars['phpversion']; ?>
 phpinfo()</a> (<a href="welcome.php?action=phpmodules" target='_self'><?php echo $this->_tpl_vars['lan']['phpmodule']; ?>
</a>)<br><?php echo $this->_tpl_vars['lan']['dbtype']; ?>
:<?php echo $this->_tpl_vars['dbtype']; ?>
(<?php echo $this->_tpl_vars['lan']['version']; ?>
:<?php echo $this->_tpl_vars['dbversion']; ?>
)<br><?php echo $this->_tpl_vars['lan']['akversion']; ?>
:<?php echo $this->_tpl_vars['akversion']; ?>
&nbsp;<br><?php echo $this->_tpl_vars['lan']['maxupload']; ?>
:<?php echo $this->_tpl_vars['maxupload']; ?>
<br><?php echo $this->_tpl_vars['lan']['maxexetime']; ?>
:<?php echo $this->_tpl_vars['maxexetime']; ?>
S<br><?php echo $this->_tpl_vars['lan']['servertime']; ?>
:<?php echo $this->_tpl_vars['servertime']; ?>
<br><?php echo $this->_tpl_vars['lan']['correcttime']; ?>
:<?php echo $this->_tpl_vars['correcttime']; ?>
<br></td></tr></table><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['supportinfo']; ?>
</td></tr><tr><td><?php echo $this->_tpl_vars['lan']['officialsite']; ?>
:<a href="http://www.huiland.net/">http://www.huiland.net/</a><br><?php echo $this->_tpl_vars['lan']['email']; ?>
:<a href="mailto:huiland@live.com">huiland@live.com</a></td></tr></table><div style="display:none"><img src='welcome.php?action=checknew'></div></body></html>