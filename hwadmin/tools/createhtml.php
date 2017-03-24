<?php
if($offset = strrpos($_SERVER['PHP_SELF'], '\\')) {
	$path = substr($_SERVER['PHP_SELF'], 0, $offset + 1);
} elseif($offset = strrpos($_SERVER['PHP_SELF'], '/')) {
	$path = substr($_SERVER['PHP_SELF'], 0, $offset + 1);
}
if(!empty($path)) chdir($path);
require_once '../include/common.inc.php';
require_once AK_ROOT.'include/global.func.php';
$db = db();
if(empty($_SERVER['argv'][1])) exit("Item id can't be empty\n");
$id = $_SERVER['argv'][1];
if(strpos($id, ',') !== false) {
	$ids = explode(',', $id);
	foreach($ids as $key => $id) {
		$id = trim($id);
		if(a_is_int($id)) {
			$ids[$key] = $id;
		} else {
			unset($ids[$key]);
		}
	}
	$id = $ids;
}
batchhtml($id);
?>