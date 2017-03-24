<?php
require_once './include/common.inc.php';
require_once './include/admin.inc.php';
checkcreator();
if(!isset($post_setting_submit)) {
	empty($get_action) && $get_action = '';
	$settings = array();
	$query = $db->query_by('*', 'settings');
	while($setting = $db->fetch_array($query)) {
		$settings[$setting['variable']] = $setting;
	}
	$settings['html']['type'] = 'bin';
	$settings['html']['standby'] = '1,0';
	$str_settings = '';
	if($get_action == 'generally') {
		$str_settings .= table_start($lan['generallysetting']);
		$str_settings .= inputshow($settings, array('sitename', 'language', 'htmlexpand', 'statcachesize', 'defaultfilename', 'homepage', 'systemurl', 'storemethod', 'categoryhomemethod', 'categorypagemethod', 'sectionhomemethod', 'sectionpagemethod', 'attachmethod', 'previewmethod', 'imagemethod', 'thumbmethod'));
		$str_settings .= table_end();
	}
	if($get_action == 'functions') {
		$str_settings .= table_start($lan['functionssetting']);
		$str_settings .= inputshow($settings, array('ifhtml', 'usefilename', 'forbidstat'));
		$str_settings .= table_end();
	}
	if($get_action == 'front') {
		$str_settings .= table_start($lan['frontsetting']);
		$str_settings .= inputshow($settings, array('keywordslink', 'globalkeywordstemplate'));
		$str_settings .= table_end();
	}
	if($get_action == 'user') {
		$str_settings .= table_start($lan['usersetting']);
		$str_settings .= inputshow($settings, array('ifuser', 'ifcomment', 'ifguestcomment', 'commentneedcaptcha'));
		$str_settings .= table_end();
	}
	if($get_action == 'attach') {
		$str_settings .= table_start($lan['attachsetting']);
		$str_settings .= inputshow($settings, array('attachimagequality', 'attachwatermarkposition', 'maxattachsize'));
		$str_settings .= table_end();
	}
	$smarty->assign('action', $get_action);
	$smarty->assign('str_settings', $str_settings);
	displaytemplate('admincp_setting.htm');
} else {
	$query = $db->query_by('variable,value', 'settings');
	$update = array();
	while($row = $db->fetch_array($query)) {
		$variable = $row['variable'];
		$setting = $row['value'];
		$post_variable = 'post_'.$variable;
		if(isset($$post_variable) && $setting != $$post_variable) $update[$variable] = array('value' => $$post_variable);
	}
	foreach($update as $k => $v) {
		$db->update('settings', $v, "variable='$k'");
	}
	updatecache('settings');
	adminmsg($lan['operatesuccess'], 'setting.php?action='.$post_action);
}
runinfo();
aexit();
?>