<?php
if(file_exists('resetpassword.php')) exit('please remove resetpassword.php first.');
require_once 'configs/config.inc.php';
if(!isset($akpath)) $akpath = './';
require_once $akpath.'include/common.inc.php';
if(ifinstalled()) {
	$file = 'admincp.php';
	if(!empty($_GET['file'])) $file = $_GET['file'];
	include($akpath."admincp.php");
} else {
	include("install.php");
}
?>