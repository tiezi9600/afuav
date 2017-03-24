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
require_once AK_ROOT.'include/spider.func.php';
eventlog('start spider');
$db = db();

if(!empty($_SERVER['argv'][1])) {
	$id = $_SERVER['argv'][1];
	$rule = getcache('spiderlistrule'.$id);
	if(!empty($_SERVER['argv'][2])) {
		$url = $_SERVER['argv'][2];
		$task = $id."\t".$rule['rule']."\t".$url."\t\t";
		addtask('spideritem', $task);
		debug('add task:'.$task);
	} else {
		$result = spiderlist($rule, 1);
		debug('add all tasks');
	}
}
while($task = getspidertask()) {
	$rule = getcache('spidercontentrule'.$task['rule']);
	$listrule = getcache('spiderlistrule'.$task['list']);
	$result = spiderurl($rule, $task['url'], $listrule, $task['title'], $task['html']);
	if(empty($result)) {
		debug('empty!skip!'.$task['url']);
		continue;
	}
	$id = insertspidereddata($result, $listrule, $task);
	batchhtml($id);
	debug($id."\t".$result['title']);
}
while($task = gettask('spiderpicture')) {
	list($url, $filename) = explode("\t", $task);
	$picturedata = readfromurl($url);
	writetofile($picturedata, $filename);
	require_once(AK_ROOT.'include/image.func.php');
	operateuploadpicture($filename);
	debug($url);
}
eventlog('end spider');
?>