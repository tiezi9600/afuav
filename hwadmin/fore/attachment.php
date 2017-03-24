<?php
require_once $mypath.$system_root.'/include/common.inc.php';
if(!isset($_GET['id']) || !a_is_int($_GET['id'])) exit();
$id = $_GET['id'];
require_once(AK_ROOT.'include/global.func.php');
require_once(AK_ROOT.'include/fore.inc.php');
$attachment = $db->get_by('*', 'attachments', "id='$id'");
if($attachment == false) fore404();
if(!file_exists($attachment['filename']))  fore404();
header("Content-type:application/octet-stream");
header("Accept-Ranges:bytes");
header("Accept-Length:{$attachment['filesize']}");
header("Content-Disposition:attachment;filename={$attachment['originalname']}");
$fp = fopen($attachment['filename'], 'r');
while(!feof($fp)) {
	$buffer = fread($fp, 1024);
	echo $buffer;
}
fclose($fp);
require_once(AK_ROOT.'include/exit.php');
?>