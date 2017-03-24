<?php
if('qqwblogin' == $a) {
	//QQ微博账号登陆
	include(AK_ROOT.'include/qqwb.func.php');
	$result = getrequesttoken();
	if(isset($result['oauth_token'])) {
		$_SESSION['qqrequesttoken'] = $result['oauth_token'];
		$_SESSION['qqrequestsecret'] = $result['oauth_token_secret'];
		$url = 'http://open.t.qq.com/cgi-bin/authorize?oauth_token='.$result['oauth_token'];
		akheader("location:$url");
	} else {
		aexit('error');
	}
} elseif('qqwbcallback' == $a) {
	if(!isset($_SESSION['qqrequesttoken']) || !isset($_SESSION['qqrequestsecret'])) {
		aexit('error1');
	} else {
		include(AK_ROOT.'include/qqwb.func.php');
		$result = getaccesstoken($_GET['oauth_verifier']);
		if(!empty($result['oauth_token'])) {
			$_SESSION['qqaccesstoken'] = $result['oauth_token'];
			$_SESSION['qqaccesssecret'] = $result['oauth_token_secret'];
			$record = $db->get_by('*', 'users', "source='qqwb' AND sourceid='{$result['name']}'");
			if(empty($record)) {
				$oauth = qqoauth();
				$userinfo = getuserinfo();
				$email = $userinfo['email'];
				if(empty($email)) $email = '#'.random(10);
				$username = $userinfo['name'].'@qqwb';
				$uid = $user->register($username, $email, random(6), array('qqaccesstoken' => $result['oauth_token'], 'qqaccesssecret' => $result['oauth_token_secret']), array('source' => 'qqwb', 'sourceid' => $result['name']));
			} else {
				$uid  = $record['id'];
				$username  = $record['username'];
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
} elseif('qqwbweibo' == $a) {
	include(AK_ROOT.'include/qqwb.func.php');
	//postweibo('北京遭遇特大暴雨！！！http://news.qq.com/a/20110623/001077.htm');
	$userinfo = getuserinfo();
	debug($userinfo);
}
?>