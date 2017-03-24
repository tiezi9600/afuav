<?php
require_once AK_ROOT.'include/global.func.php';
require_once AK_ROOT.'include/admin.func.php';
if(file_exists(AK_ROOT.'configs/cp.config.php')) require_once(AK_ROOT.'configs/cp.config.php');
$templatedir = AK_ROOT.'configs/templates/'.$template_path.'/';
require_once AK_ROOT.'include/smarty/libs/Smarty.class.php';
$smarty = new Smarty;
$vc = $_vc;
if(empty($jquery)) $jquery = 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js';
$smarty->assign('vc', $vc);
$smarty->assign('jquery', $jquery);

if(file_exists('./resetpassword.php')) aexit('please remove resetpassword.php first.');
if($__callmode == 'web') {
	if(empty($admin_id) && strpos($currenturl, 'login.php') === false && strpos($currenturl, 'install.php') === false) {
		go($systemurl."login.php");
	}
}
if(!isset($language)) $language = isset($setting_language) ? $setting_language : 'english';
$lan = lan($charset, $language);
if(file_exists(AK_ROOT.'configs/language/custom.lan')) {
	$fp = fopen(AK_ROOT.'configs/language/custom.lan', 'r');
	while(!feof($fp)) {
		$line = trim(fgets($fp, 1024));
		if($line == '') continue;
		if(strpos($line, "\t") === false) continue;
		list($_k, $_l) = explode("\t", $line);
		$lan[$_k] = $_l;
	}
	fclose($fp);
}
if(empty($nodb)) $db = db();
if(empty($nolog)) eventlog("$admin_id\t$currenturl", 'admin');
?>