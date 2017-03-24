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
if(empty($_SERVER['argv'][1])) exit("Where can't be empty\n");
$where = $_SERVER['argv'][1];
$rest = 10000;
if(isset($_SERVER['argv'][2])) $rest = $_SERVER['argv'][2];
if(substr($where, 0, 1) == '"') $where = substr($where, 1);
if(substr($where, -1) == '"') $where = substr($where, 0, -1);
$query = $db->query_by('id,title', 'items', $where);
while($item = $db->fetch_array($query)) {
	addtask('createhtmls', "{$item['id']}\t{$item['title']}");
}
debug('prepared');
while($task = gettask('createhtmls')) {
	list($id, $title) = explode("\t", $task);
	batchhtml($id);
	debug($task);
	usleep($rest);
}
debug('finish');
?>