<?php /* Smarty version 2.6.13, created on 2013-03-23 12:42:51
         compiled from admincp_process.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admincp_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script>function runprocess() {$.get('<?php echo $this->_tpl_vars['processurl']; ?>
&rand=' + Math.random(), recall);}function recall(strers) {percent = strers;if(percent < 100 && percent > 0) {$("#percentspan").html(percent);$("#processdiv").width(percent + "%");} else if(percent == 100){$("#percentspan").html("100");$("#processdiv").width("100%");<?php if ($this->_tpl_vars['targeturl']): ?>document.location.href = "<?php echo $this->_tpl_vars['targeturl']; ?>
";<?php else: ?>alert("<?php echo $this->_tpl_vars['lan']['operatesuccess']; ?>
");<?php endif; ?>return true;}setTimeout("runprocess()", <?php echo $this->_tpl_vars['timeout']; ?>
);}</script><body><div class="block"></div><table cellspacing="1" cellpadding="4" align="center" class="commontable" style="width:560px;"><tr class="header"><td colspan="3"><?php echo $this->_tpl_vars['title']; ?>
</td></tr><tr><td style="padding:30px;"><div style="border:1px solid #555;padding:1px;width:100%;height:15px;background:#FFF;"><div id="processdiv" style="width:0px;background:#9EB6D8;height:15px;"></div></div><div style='text-align:center;margin-top:10px;'><?php echo $this->_tpl_vars['lan']['finished']; ?>
 <span id="percentspan">0.00</span> %&nbsp;[<a href="javascript:document.location.reload();"><?php echo $this->_tpl_vars['lan']['refresh']; ?>
</a>]</div></td></tr></table><script>runprocess();</script></body></html>