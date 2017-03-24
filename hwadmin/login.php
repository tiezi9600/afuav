<?php
require_once './include/common.inc.php';
require_once AK_ROOT.'include/admin.inc.php';
if(!empty($get_first)) {
	if(!$db->get_by('*', 'modules', "id='1'")) {
		$language = $db->get_by('value', 'settings', "variable='language'");
		$lan = lan($charset, $language);
		$db->update('categories', array('category' => $lan['default'].$lan['space'].$lan['category']), "id=1");
		$data = array();
		$data['html'] = 0;
		$data['page'] = 1;
		$data['numperpage'] = 10;
		$data['picturemaxsize'] = 999;
		$data['fields']['title'] = array('order' => 128, 'listorder' => 128, 'size' => 320);
		$data['fields']['category'] = array('order' => 100, 'listorder' => 100);
		$data['fields']['data'] = array('order' => 50, 'size' => '100%,264', 'type' => 'plain');
		$data = serialize($data);
		$value = array(
			'modulename' => $lan['content'],
			'data' => $data
		);
		$db->insert('modules', $value);
		createfore();
		updatecache();
	}
	if(file_exists(AK_ROOT.'install/custom.config.php')) {
		header('location:install/custom.install.php');
	} else {
		header('location:login.php');
	}
	aexit();
}
if(isset($post_loginsubmit)) {
	if($editor = $db->get_by('*', 'admins', "editor='".$db->addslashes($post_username)."'")) {
		if(ak_md5($post_password, 0, 2) == $editor['password']) {
			if($editor['freeze'] == 1) adminmsg($lan['youarefreeze'], 'admincp.php', 3, 1);
			$encoded = authcode($post_username, 'ENCODE');
			if(!empty($post_rememberlogin)) {
				//aksetcookie('auth', $encoded, $thetime + 24 * 3600 * 365 * 10);
				setcookie('auth', $encoded, $thetime + 24 * 3600 * 365 * 10);
			} else {
				//aksetcookie('auth', $encoded);
				setcookie('auth', $encoded);
			}
			$preurl = 'admincp.php';
			if(!empty($post_preurl)) {
				$preurl = 'admincp.php?preurl='.urlencode($post_preurl);
			}
			adminmsg($lan['login_success'], $preurl);
		} else {
			adminmsg($lan['login_failed'], 'login.php', 3, 1);
		}
	} else {
		adminmsg($lan['login_failed'], 'login.php', 3, 1);
	}
} else {
	displaytemplate('login.htm');
}
?>