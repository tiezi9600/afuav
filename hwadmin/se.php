<?php
require_once 'include/common.inc.php';
require_once 'include/admin.inc.php';
require_once 'include/se.func.php';
checkcreator();
if(empty($_GET)) {
	$query = $db->query_by('*', 'ses', '1', 'id');
	$seslist = '';
	while($se = $db->fetch_array($query)) {
		$value = @unserialize($se['value']);
		$updatetime = '-';
		if(!empty($value['lastupdate'])) $updatetime = date('Y-m-d', $value['lastupdate']);
		$seslist .= "<tr><td>{$se['id']}</td><td><a href='se.php?id={$se['id']}'>{$se['name']}</a></td><td id='index_{$se['id']}' class='tdnum'>-</td><td id='unindexed_{$se['id']}' class='tdnum'>-</td><td>{$updatetime}</td><td><a href='se.php?action=updateindex&id={$se['id']}'>{$lan['updateindex']}</a></td><td><a href='se.php?action=updateindex&id={$se['id']}&rebuild=1'>{$lan['rebuildindex']}</a></td><td><a href='se.php?action=del&id={$se['id']}'>{$lan['del']}</a></td></tr>";
		$seslist .= "<script>indexnum({$se['id']});</script>";
	}
	$smarty->assign('seslist', $seslist);
	displaytemplate('admincp_ses.htm');
} elseif(empty($get_action) && !empty($get_id)) {
	$se = $db->get_by('*', 'ses', "id='$get_id'");
	$smarty->assign('id', $get_id);
	$smarty->assign('name', $se['name']);
	$value = unserialize($se['value']);
	$smarty->assign('field', $value['field']);
	$smarty->assign('where', $value['where']);
	$smarty->assign('dic', $value['dic']);
	$smarty->assign('path', $value['path']);
	$smarty->assign('orderby', $value['orderby']);
	displaytemplate('admincp_se.htm');
} elseif($get_action == 'add') {
	$smarty->assign('field', 'title,digest,text');
	$smarty->assign('where', 'category=1');
	$smarty->assign('dic', 'configs/dic/words.txt');
	$smarty->assign('path', random(6).'/');
	displaytemplate('admincp_se.htm');
} elseif($get_action == 'del') {
	$db->delete('ses', "id='$get_id'");
	adminmsg($lan['operatesuccess'], 'se.php');
} elseif($get_action == 'save') {
	if(empty($post_name)) adminmsg($lan['senamemustoffer'], 'back', 3, 1);
	if(empty($post_orderby)) adminmsg($lan['seorderbymastoffer'], 'back', 3, 1);
	$value = array(
		'field' => $post_field,
		'where' => $post_where,
		'dic' => $post_dic,
		'orderby' => $post_orderby,
		'path' => $post_path
	);
	if(!empty($post_id) && $row = $db->get_by('value', 'ses', "id='$post_id'")) {
		$original = unserialize($row);
		empty($original['lastupdate']) && $original['lastupdate'] = 0;
		$value['lastupdate'] = $original['lastupdate'];
	}
	$value = array(
		'name' => $post_name,
		'value' => serialize($value)
	);
	if(empty($post_id)) {
		$db->insert('ses', $value);
	} else {
		$db->update('ses', $value, "id='$post_id'");
	}
	updatecache('ses');
	adminmsg($lan['operatesuccess'], 'se.php');
} elseif($get_action == 'updateindex') {
	require_once(AK_ROOT.'include/task.file.func.php');
	$ses = getcache('ses');
	$se = $ses[$get_id];
	if(!empty($get_process)) $keywords = readkeywords($se['data']['dic']);
	if(empty($get_process)) {
		if(empty($get_start)) {
			$smarty->assign('id', $get_id);
			$smarty->assign('rebuild', isset($get_rebuild));
			displaytemplate('admincp_seindex.htm');
		} else {
			$lastupdate = 0;
			if(empty($get_rebuild) && !empty($se['data']['lastupdate'])) $lastupdate = $se['data']['lastupdate'];
			if(!empty($get_rebuild)) {
				deleteindex($get_id);
				$db->delete('keywords', "sid='$get_id'");
			}
			$query = $db->query_by('id', 'items', "(dateline>'$lastupdate' OR lastupdate>'$lastupdate') AND ".$se['data']['where']);
			$ids = array();
			deletetask('buildindex_'.$get_id);
			deletetask('write_index_log'.$get_id);
			deletetask('index_limit'.$get_id);
			deletetask('index_keywords'.$get_id);
			setcache('build_index_level', 0);
			while($item = $db->fetch_array($query)) {
				$ids[] = $item['id'];
				if(count($ids) > 1000) {
					addtasks('buildindex_'.$get_id, $ids);
					$ids = array();
				}
			}
			addtasks('buildindex_'.$get_id, $ids);
			header('location:se.php?action=updateindex&frame=1&process=1&id='.$get_id.'&timeout='.$get_timeout.'&per='.$get_per);
		}
	} elseif(!empty($get_frame)) {
		$timeout = 200;
		$per = 1000;
		if(!empty($get_timeout)) $timeout = $get_timeout;
		if(!empty($get_per)) $per = $get_per;
		showprocess($lan['createindex'], 'se.php?action=updateindex&id='.$get_id.'&process=1&per='.$per, 'se.php', $timeout);
	} else {
		$level = getcache('build_index_level');
		if(empty($level) || $level == 1) {//写索引
			$startparcent = 0;
			$endparcent = 60;
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
			$task = gettask('buildindex_'.$get_id, $get_per);
			if(empty($task)) {
				echo($endparcent);
				setcache('build_index_level', 2);
			} else {
				if(!is_array($task)) $task = array($task);
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
						$extvalue = unserialize($ext);
						foreach($extfield as $f) {
							$fulltext .= $extvalue[$f].' ';
						}
					}
					$indexbuffer = array();
					foreach($keywords as $keyword) {
						if(strpos($fulltext, $keyword) !== false) {
							$count = substr_count($fulltext, $keyword);
							$indexbuffer[] = array(
								'keyword' => $keyword,
								'itemid' => $item['id'],
								'count' => $count,
								'time' => $item['dateline']
							);
							addtask('write_index_log'.$get_id, $keyword);
						}
					}
					writeindexs($se, $indexbuffer);
				}
				echo(number_format($endparcent / 100 * gettaskpercent('buildindex_'.$get_id), 2));
			}
		} elseif($level == 2) {//处理流水账
			$startparcent = 60;
			$endparcent = 90;
			$task = gettask('write_index_log'.$get_id, $get_per);
			if(empty($task)) {
				echo($endparcent);
				setcache('build_index_level', 3);
			} else {
				if(!is_array($task)) $task = array($task);
				$task = array_unique($task);
				foreach($task as $keyword) {
					if($row = $db->get_by('keyword,flag', 'keywords', "sid='$get_id' AND keyword='".$db->addslashes($keyword)."'")) {
						if($row['flag'] == 0) $db->update('keywords', array('flag' => 1), "sid='$get_id' AND keyword='".$db->addslashes($keyword)."'");
					} else {
						$db->insert('keywords', array('keyword' => $keyword, 'flag' => 1, 'sid' => $get_id));
					}
				}
				echo(number_format($startparcent + ($endparcent - $startparcent) / 100 * gettaskpercent('write_index_log'.$get_id), 2));
			}
		} elseif($level == 3) {//将待排序关键词
			$startparcent = 90;
			$endparcent = 95;
			$task = gettask('index_limit'.$get_id);
			var_dump($task);
			if($task == '') {
				$count = $db->get_by('COUNT(*) as c', 'keywords', "sid=$get_id AND flag=1");
				var_dump($count);
				for($i = 0; $i < $count; $i += 100) {
					addtask('index_limit'.$get_id, $i);
				}
				echo $startparcent.'.01';
			} else {
				$query = $db->query_by('keyword', 'keywords', "sid=$get_id AND flag=1", 'keyword', "$task,100");
				$i = 0;
				while($row = $db->fetch_array($query)) {
					$i ++;
					addtask('index_keywords'.$get_id, $row['keyword']);
				}
				$percent = gettaskpercent('index_limit'.$get_id);
				if($i == 0 || $percent == 100) {
					echo($endparcent.'.00');
					setcache('build_index_level', 4);
				} else {
					echo(number_format($startparcent + ($endparcent - $startparcent) / 100 *  $percent, 2));
				}
			}
		} elseif($level == 4) {//排序关键词索引
			$startparcent = 95;
			$endparcent = 100;
			$keywords = gettask('index_keywords'.$get_id, $get_per);
			if(empty($keywords)) {
				touchse($get_id);
				setcache('build_index_level', 5);
				echo('100');
			} else {
				if(!is_array($keywords)) $keywords = array($keywords);
				foreach($keywords as $keyword) {
					sortindex($se, $keyword);
				}
				$percent = number_format($startparcent + ($endparcent - $startparcent) / 100 * gettaskpercent('index_keywords'.$get_id), 2);
				if($percent == '100.00') $percent = '99.99';
				echo($percent);
			}
		}
		aexit();
	}
} elseif($get_action == 'indexnum') {
	$ses = getcache('ses');
	if(empty($ses[$get_id])) exit;
	$se = $ses[$get_id];
	$where = $se['data']['where'];
	$num = $db->get_by('COUNT(*) as c', 'items', $where);
	echo($get_id.'#'.$num);
	$lastupdate = 0;
	if(!empty($se['data']['lastupdate'])) $lastupdate = $se['data']['lastupdate'];
	$num = $db->get_by('COUNT(*) as c', 'items', "(dateline>$lastupdate OR lastupdate>$lastupdate) AND ".$where);
	echo('#'.$num);
	aexit();
}
runinfo();
aexit();
?>