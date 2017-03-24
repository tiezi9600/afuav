<?php
if('baidulogin' == $a) {
	include(AK_ROOT.'include/baidu.func.php');
	$result = getrequesttoken();
	if(isset($result['oauth_token'])) {
		$_SESSION['baidurequesttoken'] = $result['oauth_token'];
		$_SESSION['baidurequestsecret'] = $result['oauth_token_secret'];
		$url = 'http://openapi.baidu.com/oauth/1.0/authorize?oauth_token='.$result['oauth_token'].'&req_perms=email&display=popup';
		akheader("location:$url");
	} else {
		aexit('error');
	}
} elseif('baiducallback' == $a) {
	if(!isset($_SESSION['baidurequesttoken']) || !isset($_SESSION['baidurequestsecret'])) {
		aexit('error1');
	} else {
		include(AK_ROOT.'include/baidu.func.php');
		$result = getaccesstoken($_GET['oauth_verifier']);
		if(!empty($result['oauth_token'])) {
			$_SESSION['baiduaccesstoken'] = $result['oauth_token'];
			$_SESSION['baiduaccesssecret'] = $result['oauth_token_secret'];
			$record = $db->get_by('*', 'users', "source='baidu' AND sourceid='{$result['uid']}'");
			$result['uname'] = fromutf8($result['uname']);
			if(empty($record)) {
				$email = '#'.random(10);
				$username = $result['uname'].'@baidu';
				$uid = $user->register($username, $email, random(6), array('baiduaccesstoken' => $result['oauth_token'], 'baiduaccesssecret' => $result['oauth_token_secret']), array('source' => 'baidu', 'sourceid' => $result['uid']));
			} else {
				$uid  = $record['id'];
				$username = $record['username'];
			}
			$user->login($uid, $username);
			$target = akgetcookie('loginreturn');
			aksetcookie('loginreturn', '');
			if(empty($target)) $target = $userphpname;
			akheader("location:$target");
		} else {
			aexit('error2');
		}
	}
}
?>