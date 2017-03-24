<?php
require_once $mypath.$system_root.'/include/common.inc.php';
require_once AK_ROOT.'include/global.func.php';
require_once AK_ROOT.'include/fore.inc.php';
if(empty($setting_ifcomment)) fore404();
if($charset == 'gbk') {
	$_POST = utf8togbk($_POST);
	extract($_POST, EXTR_PREFIX_ALL, 'post');
}
(empty($post_itemid) || !a_is_int($post_itemid)) && exit('1');
empty($post_comment) && aexit('2');
if(!empty($setting_commentneedcaptcha)) verifycaptcha();
require_once AK_ROOT.'include/user.class.php';
$user = new user();
$uid = $user->uid;
$username = $user->username;
if(empty($uid)) {
	if(empty($setting_ifguestcomment)) {
		aexit('4');
	} else {
		if(isset($post_username)) $username = $post_username;
	}
}
$title = isset($post_title) ? $post_title : '';
$itemid = $post_itemid;
$comment = $post_comment;
if(!$item = $db->get_by('id', 'items', "id='$itemid'")) aexit('3');
$value = array(
	'itemid' => $itemid,
	'username' => $username,
	'uid' => $uid,
	'title' => $title,
	'message' => $comment,
	'dateline' => $thetime,
	'category' => $item['category'],
	'section' => $item['section'],
	'ip' => $onlineip
);
$db->insert('comments', $value);
refreshcommentnum($itemid, 1);
aexit('0');
?>