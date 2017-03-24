<?php /* Smarty version 2.6.13, created on 2011-10-22 12:25:42
         compiled from license.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script>function checkagree() {if(document.getElementById("agree").checked == true) {document.location = "install.php?language=<?php echo $this->_tpl_vars['language']; ?>
&agree=1";} else {alert("<?php echo $this->_tpl_vars['lan']['mustagree']; ?>
");document.getElementById("agree").focus();}}</script><base target="_blank"><body><div class="block"></div><table cellspacing="1" cellpadding="4" class="commontable width100"><tr class="header"><td><?php echo $this->_tpl_vars['lan']['install']; ?>
</td></tr><tr><td><iframe scrolling="no" frameborder="0" style="height:260px;width:100%;" src="http://www.akcms.com/license/install.htm"></iframe><?php echo $this->_tpl_vars['lan']['offlinelicense']; ?>
(http://www.akcms.com/license/install.htm)<br /><input type="checkbox" id="agree" value="1"><label for="agree"><?php echo $this->_tpl_vars['lan']['agree']; ?>
</label><center><input type="button" value="<?php echo $this->_tpl_vars['lan']['next']; ?>
" onclick="checkagree()"></center></td></tr></table></body></html>