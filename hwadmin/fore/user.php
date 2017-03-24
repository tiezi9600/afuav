<?php
require_once $mypath.$system_root.'/include/common.inc.php';
require_once AK_ROOT.'include/global.func.php';
require_once AK_ROOT.'include/buy.inc.php';
if(empty($setting_ifuser)) {
	require_once(AK_ROOT.'include/fore.inc.php');
	fore404();
}
require_once AK_ROOT.'include/user.class.php';
$db = db();
$user = new user();
$userphpname = basename($_SERVER['SCRIPT_NAME']);
$lan = userlan($charset, $language);
$a = '';
$params = array('systemplate' => 1, 'userphpname' => $userphpname, 'lan' => $lan);
if(empty($logintype) || $logintype == 'both') {
	$accounttitle = $lan['username'].' / Email';
	$logintype = 'both';
} elseif($logintype == 'email') {
	$accounttitle = 'Email';
} elseif($logintype == 'username') {
	$accounttitle = $lan['username'];
}
if(isset($get_action)) $a = $get_action;
if('login' == $a) {
	if(isset($post_username)) {
		$r = $user->verifypassword($post_username, $post_password, $logintype);
		if(!empty($r['id'])) {
			$user->login($r['id'], $post_username);
		} elseif(1 == $r) {
			showmessage($lan['passworderror'], '?action=login');
		} elseif(2 == $r) {
			showmessage($lan['passworderror'], '?action=login');
		} elseif(3 == $r) {
			showmessage($lan['accountforbidden'], '?action=login');
		} elseif(4 == $r) {
			showmessage($lan['unverified'], '?action=login');
		}
		$target = akgetcookie('loginreturn');
		aksetcookie('loginreturn', '');
		if(empty($target)) $target = $userphpname;
		showmessage($lan['successlogin'], $target);
	} else {
		if(!empty($get_return)) aksetcookie('loginreturn', $_SERVER['HTTP_REFERER']);
		$params['accounttitle'] = $accounttitle;
		$html = render_template($params, AK_ROOT.'templates/,login.htm');
		echo $html;
	}
} elseif('iframelogin' == $a) {
	if(isset($post_username)) {
		$r = $user->verifypassword($post_username, $post_password, $logintype);
		if(!empty($r['id'])) {
			$user->login($r['id'], $post_username);
		} elseif(1 == $r) {
			showmessage($lan['passworderror'], '?action=login');
		} elseif(2 == $r) {
			showmessage($lan['passworderror'], '?action=login');
		} elseif(3 == $r) {
			showmessage($lan['accountforbidden'], '?action=login');
		} elseif(4 == $r) {
			showmessage($lan['unverified'], '?action=login');
		}
		echo "<script>window.parent.akcms_iframelogin('$post_username', '{$r['id']}');</script>";
	} else {
		$params['accounttitle'] = $accounttitle;
		$html = render_template($params, AK_ROOT.'templates/,iframelogin.htm');
		echo $html;
	}
} elseif('logout' == $a) {
	$user->logout();
	$target = $userphpname;
	if(!empty($get_return)) $target = $_SERVER['HTTP_REFERER'];
	akheader('location:'.$target);
} elseif('ajaxlogout' == $a) {
	$user->logout();
} elseif('reg' == $a) {
	if(empty($_POST)) {
		$html = render_template($params, AK_ROOT.'templates/,reg.htm');
		echo $html;
	} else {
		if(empty($post_username)) showmessage($lan['usernameempty']);
		if(empty($post_email)) showmessage($lan['emailempty']);
		if(empty($post_password)) showmessage($lan['passwordempty']);
		if($post_password != $post_password2) showmessage($lan['passwordnotmatch']);
		if(strpos($post_username, '@') !== false) showmessage($lan['usernameat']);
		if(!isemail($post_email)) showmessage($lan['emailerror']);
		unset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password2']);
		$result = $user->register($post_username, $post_email, $post_password, $_POST);
		if(isset($result['errno'])) {
			if(1 == $result['errno']) showmessage($lan['usernameexist'], '?action=reg');
			if(2 == $result['errno']) showmessage($lan['emailexist'], '?action=reg');
		}
		showmessage($lan['success'], $userphpname);
	}
} elseif('setting' == $a) {
	$userinfo = $user->userinfo();
	if(empty($_POST)) {
		foreach($userinfo as $k => $v) {
			$params[$k] = $v;
			$params[$k.'_htmlspecialchars'] = htmlspecialchars($v);
		}
		$template = 'setting.htm';
		if(isset($setting_groupkey) && isset($setting_groups[$setting_groupkey])) $template = $setting_groups[$setting_groupkey]['template'];
		$html = render_template($params, AK_ROOT.'templates/,'.$template);
		echo $html;
	} else {
		$value = array();
		if(isset($setting_groupkey) && isset($setting_groups[$setting_groupkey])) {
			$fields = explode(',', $setting_groups[$setting_groupkey]['fields']);
			foreach($fields as $field) {
				if(isset($_POST[$field])) $value[$field] = $_POST[$field];
			}
		} else {
			foreach($_POST as $k => $v) {
				$value[$k] = $v;
			}
		}
		$user->changesetting($value);
		showmessage($lan['success'], $userphpname);
	}
} elseif('changepassword' == $a) {
	$userinfo = $user->userinfo();
	if(empty($userinfo)) showmessage($lan['pleaselogin']);
	if(empty($_POST)) {
		foreach($userinfo as $k => $v) {
			$params[$k] = $v;
			$params[$k.'_htmlspecialchars'] = htmlspecialchars($v);
		}
		$html = render_template($params, AK_ROOT.'templates/,changepassword.htm');
		echo $html;
	} else {
		if($post_newpassword1 != $post_newpassword2) showmessage('new password discord');
		if(md5($post_password) != $userinfo['password']) showmessage('old password error');
		$user->changepassword($post_newpassword1);
		showmessage('change password successful');
	}
} elseif('resetpassword' == $a) {
	if(empty($_POST)) {
		$html = render_template($params, AK_ROOT.'templates/,resetpassword.htm');
		echo $html;
	} else {
		$reseturl = $user->getreseturl($post_email);
		if($reseturl === false) showmessage($lan['resetpassworderror']);
		debug($userphpname.$reseturl);
	}
} elseif('verifyresetpassword' == $a) {
	if(empty($_POST)) {
		if(!$user->verifyreseturl($get_email, $get_expire, $get_verify)) showmessage('verify failed');
		$params['email'] = $get_email;
		$params['expire'] = $get_expire;
		$params['verify'] = $get_verify;
		$html = render_template($params, AK_ROOT.'templates/,newpassword.htm');
		echo $html;
	} else {
		if(!isset($post_password1)) showmessage('password can not empty');
		if(!$user->verifyreseturl($post_email, $post_expire, $post_verify)) showmessage('verify failed');
		$user->resetpasswordbyemail($post_password1, $post_email);
		showmessage('password reset ok');
	}
} elseif('verifyemail' == $a) {
	$email = $get_email;
	$user = $db->get_by('*', 'users', "email='".$db->addslashes($get_email)."'");
	if(empty($user)) aexit('0');
	aexit('1');
} elseif('addtocart' == $a) {
	//将商品添加到购物车中
	aexit();
	$num = intval($get_num);
	$goodsid = intval($get_goodsid);
	addtoorder(array($goodsid => $num));
} elseif('cart' == $a) {
	//显示购物车
	aexit();
	$cartinfo = getcart();
	//debug($cartinfo);
	$amount = calorderamount($cartinfo['id'], $cartinfo);
	var_dump($amount);
	foreach($cartinfo as $k => $v) {
		//if($k == 'goods') continue;
		$params[$k] = $v;
	}
	$html = render_template($params, AK_ROOT.'templates/,cart.htm');
	echo $html;
} elseif('paycart' == $a) {
	//支付购物车中的商品
} elseif('charge' == $a) {
	//通过第三方支付支付
} elseif('confirmorder' == $a) {
	//确认订单信息
} elseif('deletefromorder' == $a) {
	//从购物车中删除某一商品
} elseif('changenum' == $a) {
	//修改购物车中某一商品的数量
} elseif(substr($a, 0, 4) == 'qqwb') {
	include(AK_ROOT.'fore/user.qqwb.php');
} elseif(substr($a, 0, 5) == 'baidu') {
	include(AK_ROOT.'fore/user.baidu.php');
} else {
	if($user->uid == 0) {
		akheader('location:'.$userphpname.'?action=login');
	} else {
		foreach($user->session as $k => $v) {
			$params[$k] = $v;
			$params[$k.'_htmlspecialchars'] = htmlspecialchars($v);
		}
		$html = render_template($params, AK_ROOT.'templates/,user.htm');
		echo $html;
	}
}

function showmessage($message, $url = '', $flag = 0) {
	global $params;
	$params['message'] = $message;
	$params['url'] = $url;
	$html = render_template($params, AK_ROOT.'templates/,message.htm');
	aexit($html);
}
?>