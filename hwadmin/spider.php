<?php
require_once 'include/common.inc.php';
require_once 'include/admin.inc.php';
require_once 'include/task.file.func.php';
require_once 'include/spider.func.php';
checkcreator();
if(empty($get_action)) {
	$listrules = '';
	$contentrules = '';
	$query = $db->query_by('*', 'spider_listrules', '1', 'id');
	while($rule = $db->fetch_array($query)) {
		$value = unserialize($rule['value']);
		$listrules .= "<tr><td>{$rule['id']}</td><td><a href='spider.php?action=editspiderlist&id={$rule['id']}'>{$value['name']}</a></td><td><a href='spider.php?action=previewspiderlist&id={$rule['id']}'>{$lan['preview']}</a></td><td><a href='spider.php?action=spiderlist&id={$rule['id']}'>{$lan['spidernow']}</a></td><td><a href='spider.php?action=exportlistrule&id={$rule['id']}'>{$lan['export']}</a></td><td><a href='spider.php?action=deletespiderlist&id={$rule['id']}'>{$lan['delete']}</a></td></tr>";
	}
	$query = $db->query_by('*', 'spider_contentrules', '1', 'id');
	while($rule = $db->fetch_array($query)) {
		$value = unserialize($rule['value']);
		$contentrules .= "<tr><td>{$rule['id']}</td><td><a href='spider.php?action=editspidercontent&id={$rule['id']}'>{$value['name']}</a></td><td><a href='spider.php?action=previewspidercontent&id={$rule['id']}'>{$lan['preview']}</a></td><td><a href='spider.php?action=exportcontentrule&id={$rule['id']}'>{$lan['export']}</a></td><td><a href='spider.php?action=deletespidercontent&id={$rule['id']}'>{$lan['delete']}</a></td></tr>";
	}
	$smarty->assign('listrules', $listrules);
	$smarty->assign('contentrules', $contentrules);
	displaytemplate('admincp_spiders.htm');
} elseif($get_action == 'newspidercontent') {
	$smarty->assign('ids', array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20));
	displaytemplate('admincp_spidercontent.htm');
} elseif($get_action == 'editspidercontent') {
	$rule = $db->get_by('value', 'spider_contentrules', "id='$get_id'");
	$value = unserialize($rule);
	foreach($value as $k => $v) {
		$smarty->assign($k, htmlspecialchars($v));
	}
	foreach(array('start', 'end', 'html2txt', 'keeptag', 'killrepeatspace', 'trim', 'spiderpic', 'extname', 'extvalue', 'repeat') as $tag) {
		$v = array();
		for($i = 1; $i <= 20; $i ++) {
			if(isset($value[$tag.$i])) $v[$i] = htmlspecialchars($value[$tag.$i]);
		}
		$smarty->assign($tag, $v);
	}
	$smarty->assign('id', $get_id);
	$smarty->assign('ids', array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20));
	displaytemplate('admincp_spidercontent.htm');
} elseif($get_action == 'savespidercontent') {
	$id = $post_id;
	$value = array('value' => serialize($_POST));
	if(!empty($post_id)) {
		$db->update('spider_contentrules', $value, "id='$id'");
	} else {
		$db->insert('spider_contentrules', $value);
		$id = $db->insert_id();
		$_POST['id'] = $id;
	}
	setcache('spidercontentrule'.$id, $_POST);
	adminmsg($lan['operatesuccess'], 'spider.php?action=editspidercontent&id='.$id);
} elseif($get_action == 'newspiderlist') {
	$query = $db->query_by('id,value', 'spider_contentrules');
	$select = '';
	while($rule = $db->fetch_array($query)) {
		$value = unserialize($rule['value']);
		$select .= "<option value='{$rule['id']}'>{$value['name']}</option>";
	}
	$smarty->assign('select', $select);
	displaytemplate('admincp_spiderlist.htm');
} elseif($get_action == 'editspiderlist') {
	$rule = $db->get_by('value', 'spider_listrules', "id='$get_id'");
	$value = unserialize($rule);
	foreach($value as $k => $v) {
		$smarty->assign($k, htmlspecialchars($v));
	}
	$smarty->assign('id', $get_id);
	$select = '';
	$query = $db->query_by('id,value', 'spider_contentrules');
	while($rule = $db->fetch_array($query)) {
		$value = unserialize($rule['value']);
		$select .= "<option value='{$rule['id']}'>{$value['name']}</option>";
	}
	$smarty->assign('select', $select);
	displaytemplate('admincp_spiderlist.htm');
} elseif($get_action == 'savespiderlist') {
	$id = $post_id;
	$value = array('value' => serialize($_POST));
	if(!empty($post_id)) {
		$db->update('spider_listrules', $value, "id='$id'");
	} else {
		$db->insert('spider_listrules', $value);
		$id = $db->insert_id();
		$_POST['id'] = $id;
	}
	setcache('spiderlistrule'.$id, $_POST);
	adminmsg($lan['operatesuccess'], 'spider.php?action=editspiderlist&id='.$id);
} elseif($get_action == 'previewspidercontent') {
	$rule = getcache('spidercontentrule'.$get_id);
	$result = spiderurl($rule, $rule['url']);
	debug($result);
} elseif($get_action == 'previewspiderlist') {
	$rule = getcache('spiderlistrule'.$get_id);
	$result = spiderlist($rule, 0);
	debug($result);
} elseif($get_action == 'spiderlist') {
	$rule = getcache('spiderlistrule'.$get_id);
	deletetask('spideritem');
	$result = spiderlist($rule, 1);
	header('location:spider.php?action=spider&r='.random(6));
} elseif($get_action == 'deletespidercontent') {
	$db->delete('spider_contentrules', "id='$get_id'");
	adminmsg($lan['operatesuccess'], 'spider.php');
} elseif($get_action == 'deletespiderlist') {
	$db->delete('spider_listrules', "id='$get_id'");
	adminmsg($lan['operatesuccess'], 'spider.php');
} elseif($get_action == 'spider') {
	while($task = getspidertask()) {
		$rule = getcache('spidercontentrule'.$task['rule']);
		$listrule = getcache('spiderlistrule'.$task['list']);
		$result = spiderurl($rule, $task['url'], $listrule, $task['title'], $task['html']);
		$id = insertspidereddata($result, $listrule, $task);
		batchhtml($id);
		debug($id.','.$result['title']);
		refreshself(1000);
	}
	while($task = gettask('spiderpicture')) {
		list($url, $filename) = explode("\t", $task);
		$picturedata = readfromurl($url);
		writetofile($picturedata, $filename);
		require_once(AK_ROOT.'include/image.func.php');
		operateuploadpicture($filename);
		debug($url);
		refreshself(1000);
	}
	debug('finished!');
} elseif($get_action == 'spiderpage') {
	if(!empty($post_url)) {
		$listrule = getcache('spiderlistrule'.$post_rule);
		$contentrule = getcache('spidercontentrule'.$listrule['rule']);
		$contentrule['finish'] = 1;
		$result = spiderurl($contentrule, $post_url, $listrule);
		aksetcookie('spiderpagerule', $post_rule);
		if($result === false) {
			adminmsg($lan['spidererror'], 'spider.php?action=spiderpage');
		} else {
			$task = array(
				'itemid' => 0,
				'url' => $post_url,
				'list' => $post_rule,
				'norecord' => 1
			);
			$id = insertspidereddata($result, $listrule, $task);
			batchhtml($id);
			header('location:admincp.php?action=edititem&id='.$id);
		}
	} else {
		$query = $db->query_by('id,value', 'spider_listrules');
		$select = '';
		while($rule = $db->fetch_array($query)) {
			$value = unserialize($rule['value']);
			$select .= "<option value='{$rule['id']}'>{$value['name']}</option>";
		}
		if(!empty($cookie_spiderpagerule)) $smarty->assign('lastrule', $cookie_spiderpagerule);
		$smarty->assign('select', $select);
		displaytemplate('admincp_spiderpage.htm');
	}
} elseif($get_action == 'exportcontentrule') {
	$rule = getcache('spidercontentrule'.$get_id);
	unset($rule['id']);
	$smarty->assign('data', base64_encode(serialize($rule)));
	$smarty->assign('actiontitle', $lan['export']);
	displaytemplate('admincp_importexport.htm');
} elseif($get_action == 'exportlistrule') {
	$rule = getcache('spiderlistrule'.$get_id);
	unset($rule['id']);
	$smarty->assign('data', base64_encode(serialize($rule)));
	$smarty->assign('actiontitle', $lan['export']);
	displaytemplate('admincp_importexport.htm');
} elseif($get_action == 'importcontentrule') {
	if(empty($_POST)) {
		$smarty->assign('actiontitle', $lan['import']);
		$smarty->assign('action', 'spider.php?action=importcontentrule');
		displaytemplate('admincp_importexport.htm');
	} else {
		$value = base64_decode($post_data);
		if($value === false) debug('error', 1);
		$insertvalue = array(
			'value' => $value
		);
		$db->insert('spider_contentrules', $insertvalue);
		$id = $db->insert_id();
		setcache('spidercontentrule'.$id, unserialize($value));
		adminmsg($lan['operatesuccess'], 'spider.php?action=editspidercontent&id='.$id);
	}
} elseif($get_action == 'importlistrule') {
	if(empty($_POST)) {
		$smarty->assign('actiontitle', $lan['import']);
		$smarty->assign('action', 'spider.php?action=importlistrule');
		displaytemplate('admincp_importexport.htm');
	} else {
		$value = base64_decode($post_data);
		if($value === false) debug('error', 1);
		$insertvalue = array(
			'value' => $value
		);
		$db->insert('spider_listrules', $insertvalue);
		$id = $db->insert_id();
		setcache('spiderlistrule'.$id, unserialize($value));
		adminmsg($lan['operatesuccess'], 'spider.php?action=editspiderlist&id='.$id);
	}
}
runinfo();
aexit();
?>