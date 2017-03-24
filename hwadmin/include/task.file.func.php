<?php
define('TASKFILE', AK_ROOT.'cache/tasks/[key]');
define('TASKFILEOFFSET', AK_ROOT.'cache/tasks/[key].offset');

function gettask($key, $num = 1) {
	$file = str_replace('[key]', $key, TASKFILE);
	if(!file_exists($file)) return '';
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	if(!file_exists($offsetfile)) touch($offsetfile);
	$task = '';
	($fo = @fopen($offsetfile, 'r+')) || ($fo = @fopen($offsetfile, 'w'));
	flock($fo, LOCK_EX);
	fseek($fo, 0);
	$offset = fgets($fo);
	$offset = (int)$offset;
	if(!$fp = fopen($file, 'r')) {
		flock($fo, LOCK_UN);
		fclose($fo);
		@unlink($file);
		@unlink($offsetfile);
		return '';
	}
	fseek($fp, $offset);
	$i = 0;
	$tasks = array();
	while(!feof($fp)) {
		$task = fgets($fp);
		$offset += strlen($task);
		$task = substr($task, 0, -1);
		if($task != '') {
			$i ++;
			$tasks[] = $task;
			if($i >= $num) break;
		}
	}
	fclose($fp);
	rewind($fo);
	fwrite($fo, $offset);
	flock($fo, LOCK_UN);
	fclose($fo);
	if(empty($tasks)) {
		@unlink($file);
		@unlink($offsetfile);
	}
	foreach($tasks as $k => $v) {
		$tasks[$k] = str_replace('#\n#', "\n", $v);
	}
	if($num > 1) {
		return $tasks;
	} else {
		return current($tasks);
	}
}

function addtask($key, $task) {
	$file = str_replace('[key]', $key, TASKFILE);
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	if(!file_exists($offsetfile)) touch($offsetfile);
	$fp = fopen($file, 'a');
	flock($fp, LOCK_EX);
	$task = str_replace("\n", '#\n#', $task);
	fwrite($fp, $task."\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}

function addtasks($key, $tasks) {
	if(empty($tasks)) return false;
	$file = str_replace('[key]', $key, TASKFILE);
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	if(!file_exists($offsetfile)) touch($offsetfile);
	$fp = fopen($file, 'a');
	flock($fp, LOCK_EX);
	foreach($tasks as $task) {
		$task = str_replace("\n", '#\n#', $task);
		fwrite($fp, $task."\n");
	}
	flock($fp, LOCK_UN);
	fclose($fp);
}

function gettaskpercent($key) {
	$file = str_replace('[key]', $key, TASKFILE);
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	$total = filesize($file);
	if(!file_exists($offsetfile)) return 0;
	$current = readfromfile($offsetfile);
	if($current >= $total) {
		@unlink($file);
		@unlink($offsetfile);
		return 100; 
	}
	return number_format($current * 100 / $total, 2);
}

function deletetask($key) {
	$file = str_replace('[key]', $key, TASKFILE);
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	@unlink($file);
	@unlink($offsetfile);
}
?>