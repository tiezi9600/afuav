<?php
if(empty($_GET['sid']) || strlen($_GET['sid']) > 6) exit;
$sid = $_GET['sid'];
require_once $mypath.$system_root.'/include/common.inc.php';
require_once(AK_ROOT.'include/global.func.php');
require_once(AK_ROOT.'include/fore.inc.php');
if(empty($setting_ifcomment)) fore404();
captcha($sid);
require_once(AK_ROOT.'include/exit.php');
?>