<?php
if($offset = strrpos($_SERVER['PHP_SELF'], '\\')) {
	$path = substr($_SERVER['PHP_SELF'], 0, $offset + 1);
} elseif($offset = strrpos($_SERVER['PHP_SELF'], '/')) {
	$path = substr($_SERVER['PHP_SELF'], 0, $offset + 1);
}
if(!empty($path)) chdir($path);
require_once '../include/common.inc.php';
require_once AK_ROOT.'include/global.func.php';
require_once AK_ROOT.'include/task.file.func.php';
$db = db();

if(empty($_SERVER['argv'][1])) debug('params empty.', 1);
$field = $_SERVER['argv'][1];
$where = '1';
$split = ',';
if(!empty($_SERVER['argv'][2])) $where = $_SERVER['argv'][2];
if(!empty($_SERVER['argv'][3])) $split = $_SERVER['argv'][3];
$query = $db->query_by('id,'.$field, 'items', $where, 'id');
$keywords = array();
while($item = $db->fetch_array($query)) {
	$id = $item['id'];
	unset($item['id']);
	$string = implode($split, $item);
	debug($id."\t".$string);
	$ks = explode($split, $string);
	foreach($ks as $k) {
		$k = trim($k);
		if($k == '') continue;
		if(in_array($k, $keywords)) continue;
		$keywords[] = $k;
	}
	usleep(1000);
}
foreach($keywords as $keyword) {
	error_log($keyword."\n", 3, 'words.txt');
}
debug('finished!');
?>