<?php
$i = strpos(__FILE__, 'include.php');
$mypath = substr(__FILE__, 0, $i);
include $mypath.'config.php';
include $mypath.$system_root.'/fore/include.php';
?>