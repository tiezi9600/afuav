<?php
if($offset = strrpos($_SERVER['PHP_SELF'], '\\')) {
	$path = substr($_SERVER['PHP_SELF'], 0, $offset + 1);
} elseif($offset = strrpos($_SERVER['PHP_SELF'], '/')) {
	$path = substr($_SERVER['PHP_SELF'], 0, $offset + 1);
}
if(!empty($path)) chdir($path);
require_once '../include/common.inc.php';
require_once AK_ROOT.'include/global.func.php';
require_once AK_ROOT.'include/se.func.php';
require_once AK_ROOT.'include/task.file.func.php';
$db = db();
$ses = getcache('ses');
if(empty($_SERVER['argv'][1])) exit("search engine id can't be empty\n");
$id = $_SERVER['argv'][1];
$se = $ses[$id];
$rebuild = in_array('rebuild', $_SERVER['argv']);
$continue = in_array('continue', $_SERVER['argv']);
$keywords = readkeywords($se['data']['dic']);

$fields = explode(',', $se['data']['field']);
$itemfields = $extfield = array();
foreach($fields as $field) {
	$field = trim($field);
	if(in_array($field, array('title', 'aimurl', 'shorttitle', 'author', 'source', 'keywords', 'digest'))) {
		$itemfields[] = $field;
	} elseif(substr($field, 0, 1) == '_') {
		$extfield[] = $field;
	} elseif($field == 'text') {
		$iftext = 1;
	}
}
if(empty($continue)) prepareindextask($id, $rebuild);
$indexbuffer = array();
while($task = gettask('buildindex_'.$id, 10)) {
	if(empty($task)) break;
	$ids = implode(',', $task);
	$query = $db->query_by('id,dateline,'.implode(',', $itemfields), 'items', "id IN ($ids)");
	while($item = $db->fetch_array($query)) {
		$fulltext = '';
		foreach($itemfields as $f) {
			$fulltext .= $item[$f].' ';
		}
		if(isset($iftext)) {
			$fulltext .= $db->get_by('text', 'texts', "itemid='{$item['id']}'").' ';
		}
		if(!empty($extfield)) {
			$ext = $db->get_by('value', 'item_exts', "id='{$item['id']}'");
			if(!empty($ext) && $extvalue = @unserialize($ext)) {
				foreach($extfield as $f) {
					$fulltext .= $extvalue[$f].' ';
				}
			}
		}
		foreach($keywords as $keyword) {
			if(strpos($fulltext, $keyword) !== false) {
				$count = substr_count($fulltext, $keyword);
				$fulltext = str_replace($keyword, ' ', $fulltext);
				$indexbuffer[] = array(
					'keyword' => $keyword,
					'itemid' => $item['id'],
					'count' => $count,
					'time' => $item['dateline']
				);
			}
		}
	}
	if(count($indexbuffer) > 10000) {
		writeindexs($se, $indexbuffer);
		echo gettaskpercent('buildindex_'.$id).'%';
		$indexbuffer = array();
	}
	process_sleep();
}
if(!empty($indexbuffer)) writeindexs($se, $indexbuffer);
echo "\nIndex Created.\n";
$i = 0;
foreach($keywords as $keyword) {
	$i ++;
	$num = readindexcount($se, $keyword);
	if($num <= 0) continue;
	if($row = $db->get_by('keyword,flag', 'keywords', "sid='$id' AND keyword='".$db->addslashes($keyword)."'")) {
		if($row['flag'] == 0) $db->update('keywords', array('flag' => 1, 'num' => $num), "sid='$id' AND keyword='".$db->addslashes($keyword)."'");
	} else {
		$db->insert('keywords', array('keyword' => $keyword, 'hash' => ak_md5($keyword, 1), 'flag' => 1, 'sid' => $id, 'num' => $num));
	}
	if($i % 100 == 0) process_sleep();
}
echo "\nDatabase updated.\n";
$query = $db->query_by('keyword', 'keywords', "sid=$id AND flag=1");
$i = 0;
while($row = $db->fetch_array($query)) {
	$i ++;
	sortindex($se, $row['keyword']);
	if($i % 10 == 0) process_sleep();
}
touchse($id);
debug("\ncreate index successfully.");

function process_sleep() {
	echo '#';
	usleep(100000);
}

function prepareindextask($id, $rebuild) {
	global $db, $se;
	$lastupdate = 0;
	if(empty($rebuild) && !empty($se['data']['lastupdate'])) $lastupdate = $se['data']['lastupdate'];
	if(!empty($rebuild)) {
		deleteindex($id);
		$db->delete('keywords', "sid='$id'");
	}
	$query = $db->query_by('id', 'items', "(dateline>='$lastupdate' OR lastupdate>='$lastupdate') AND ".$se['data']['where']);
	$ids = array();
	deletetask('buildindex_'.$id);
	while($item = $db->fetch_array($query)) {
		$ids[] = $item['id'];
		if(count($ids) > 5000) {
			addtasks('buildindex_'.$id, $ids);
			process_sleep();
			$ids = array();
		}
	}
	addtasks('buildindex_'.$id, $ids);
	$indexpath = calindexpath($se);
	for($i = 0; $i <= 15; $i ++) {
		for($j = 0; $j <= 15; $j ++) {
			ak_mkdir($indexpath.'/'.dechex($i).'/'.dechex($j).'/');
		}
	}
	echo "Prepare OK.\n";
}
?>
