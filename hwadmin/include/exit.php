<?php
callruntime('after');
if(isset($db)) $db->close();
if(isset($slowopen)) {
	$etime = explode(' ', microtime());
	$taketime = $etime[0] + $etime[1] - $mtime[0] - $mtime[1];
	if($taketime > $slowopen) error_log(date('m-d H:i:s', $thetime)."\t".number_format($taketime, 4, '.', '')."\t$currenturl\n", 3, AK_ROOT.'logs/slowopen');
}
?>