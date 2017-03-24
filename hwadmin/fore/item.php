<?php
if(!isset($_GET['id'])) exit();
require_once $mypath.$system_root.'/include/common.inc.php';
if(!a_is_int($_GET['id'])) exit();
require_once AK_ROOT.'include/forecache.func.php';
$forecache = getforecache($currenturl);
require_once(AK_ROOT.'include/global.func.php');
require_once(AK_ROOT.'include/fore.inc.php');
if(!isset($template)) $template = '';
$html = foredisplay($get_id, 'item', $template);
if($forecache === false) setforecache($currenturl, $html);
if(substr($html, 0, 5) == '<?xml') header('Content-Type:text/xml;charset='.$header_charset);
echo $html;
require_once(AK_ROOT.'include/exit.php');
?>