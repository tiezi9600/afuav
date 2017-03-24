<?php
require_once 'include/common.inc.php';
require_once 'include/admin.inc.php';
!isset($get_action) && $get_action = '';
if($get_action == 'phpinfo') {
	if(function_exists('phpinfo')) {
		phpinfo();exit;
	} else {
		exit('phpinfo() is disabled');
	}
} elseif($get_action == 'checkwritable') {
	$array_files = array(
		FORE_ROOT,
		'cache',
		'templates',
		'cache/templates',
		'configs',
	);
	$message = '';
	foreach($array_files as $file) {
		if(!is_writable($file)) $message .= '"'.$file.'"'.$lan['isunwritable'].'<br>';
	}
	if(!empty($message)) {
		adminmsg($lan['writableerror'].'<br>'.$message, 'welcome.php?action=welcome', 3, 1);
	} else {
		adminmsg($lan['writableok'], 'welcome.php');
	}
} elseif($get_action == 'optimize') {
	if(strpos($dbtype, 'sqlite') !== false) adminmsg($lan['sqliteunsupport'], 'welcome.php', 3, 1);
	$db->query("OPTIMIZE TABLE `{$tablepre}_admins` , `{$tablepre}_attachments` , `{$tablepre}_categories` , `{$tablepre}_filenames` , `{$tablepre}_items` , `{$tablepre}_sections` , `{$tablepre}_settings` , `{$tablepre}_texts` , `{$tablepre}_variables`");
	adminmsg($lan['operatesuccess'], 'welcome.php');
} elseif($get_action == 'updatecache') {
	updatecache();
	adminmsg($lan['operatesuccess'], 'welcome.php');
} elseif($get_action == 'copyfront') {
	createfore();
	adminmsg($lan['operatesuccess'], 'welcome.php');
} elseif($get_action == 'runsql') {
	if(isset($post_sql)) {
		$query = $db->query($post_sql);
		$body = '';
		if($query !== true && !empty($query)) {
			while($result = $db->fetch_array($query)) {
				if(empty($header)) {
					$header = '<tr class="header">';
					foreach(array_keys($result) as $field) {
						$header .= '<td>'.htmlspecialchars($field).'</td>';
					}
					$header .= '</tr>';
				}
				$body .= "<tr>";
				foreach($result as $value) {
					$body .= "<td>".htmlspecialchars($value)."</td>";
				}
				$body .= "</tr>";
			}
			if($body != '') {
				$result = "<table class=\"commontable\" cellspacing=\"1\" cellpadding=\"4\">{$header}{$body}</table><br>";
				$smarty->assign('result', $result);
			}
		}
		$smarty->assign('sql', $post_sql);
	}
	displaytemplate('admincp_runsql.htm');
} elseif($get_action == 'updatefilenames') {
	$db->delete('filenames');
	if(!empty($setting_usefilename)) {
		$query = $db->query_by('*', 'items');
		while($item = $db->fetch_array($query)) {
			$filename = htmlname($item['id'], $item['category'], $item['dateline'], $item['filename']);
			if(empty($filename)) continue;
			$value = array(
				'filename' => $filename,
				'type' => 'item',
				'dateline' => $thetime,
				'id' => $item['id'],
				'page' => 0
			);
			$db->insert('filenames', $value);
		}
	}
	$query = $db->query_by('*', 'categories', '1', 'categoryup,id');
	while($category = $db->fetch_array($query)) {
		$extvalaue = updatecategoryextvalue($category['id'], $category);
	}
	adminmsg($lan['operatesuccess']);
} elseif($get_action == 'checknew') {
	if(!file_exists(AK_ROOT.'cache/update')) {
		$apiurl = 'http://www.akcms.com/api/checknew.php?ver='.$sysedition;
		if(!empty($ifdebug)) $apiurl .= "&debug=1";
		$result = readfromurl($apiurl);
		if($result == '1') touch(AK_ROOT.'cache/update');
	}
} elseif($get_action == 'update') {
	if(empty($get_sure)) {
		$smarty->assign('to', $get_to);
		displaytemplate('update.htm');
		eventlog('sure?');
	} elseif($get_sure == '1') {
		include AK_ROOT.'include/files.inc.php';
		$result = checkfiles($files);
		if(!empty($result)) {
			debug($lan['makefileswritable']."\n".$result, 1);
		}
		$zip = readfromurl('http://www.akcms.com/download/packages/akcms'.$get_to.'.zip');
		writetofile($zip, AK_ROOT.'cache/_akcms.zip');
		eventlog('sure?1');
		go('welcome.php?action=update&to='.$get_to.'&sure=2');
	} elseif($get_sure == '2') {
		$php = readfromurl('http://www.akcms.com/api/update.php?from='.$sysedition.'&to='.$get_to);
		$phps = explode("\n", $php);
		$output = '';
		foreach($phps as $php) {
			if(substr($php, 0, 4) == '<!--') continue;
			$output .= "\n".$php;
		}
		writetofile("<?php\n".$output."\n?>", AK_ROOT.'cache/_akcms.php');
		eventlog('sure?2');
		go('welcome.php?action=update&to='.$get_to.'&sure=3');
	} elseif($get_sure == '3') {
		unzip(AK_ROOT.'cache/_akcms.zip');
		include(AK_ROOT.'cache/_akcms.php');
		unlink(AK_ROOT.'cache/update');
		unlink(AK_ROOT.'cache/_akcms.zip');
		unlink(AK_ROOT.'cache/_akcms.php');
		$caches = readpathtoarray(AK_ROOT.'cache/templates');
		foreach($caches as $cache) {
			if(substr($cache, -8) != '.htm.php') continue;
			unlink($cache);
		}
		eventlog('sure?3');
		adminmsg($lan['operatesuccess'], 'welcome.php?updated=1');
	} elseif($get_sure == '4') {
		include(AK_ROOT.'cache/_akcms.php');
		eventlog('sure?4');
		go('welcome.php?action=update&to='.$get_to.'&sure=5');
	} elseif($get_sure == '5') {
		eventlog('sure?5');
		unlink(AK_ROOT.'cache/update');
		unlink(AK_ROOT.'cache/_akcms.zip');
		unlink(AK_ROOT.'cache/_akcms.php');
		$caches = readpathtoarray(AK_ROOT.'cache/templates');
		foreach($caches as $cache) {
			if(substr($cache, -8) != '.htm.php') continue;
			unlink($cache);
		}
		adminmsg($lan['operatesuccess'], 'welcome.php');
	}
} elseif($get_action == 'phpmodules') {
	$options = array();
	$options['curl'] = $options['mb'] = $options['iconv'] = $options['mem'] = 0;
	if(function_exists('curl_init') && function_exists('curl_exec')) $options['curl'] = 1;
	if(function_exists('mb_strpos')) $options['mb'] = 1;
	if(function_exists('iconv')) $options['iconv'] = 1;
	if(function_exists('memory_get_usage')) $options['mem'] = 1;
	$smarty->assign('options', $options);
	displaytemplate('phpmodules.htm');
} elseif($get_action == 'checkauth') {
	touch(AK_ROOT.'configs/auth.php');
	akheader('location:welcome.php');
} else {
	if(!empty($_GET['updated'])) writetofile("<?php//{$sysedition}?>", AK_ROOT.'configs/version.php');
	$apiurl = 'http://www.akcms.com/api/changelog.php?ver='.$sysedition.'&akpath=http://'.$_SERVER['HTTP_HOST'].substr(AK_URL, 0, -1);
	if(!empty($ifdebug)) $apiurl .= '&debug=1';
	if(file_exists(AK_ROOT.'cache/update')) $smarty->assign('updateurl', $apiurl);
	$infos = getcache('infos');
	$servertime = date('Y-m-d H:i:s', time());
	$correcttime = date('Y-m-d H:i:s', $thetime);
	isset($_ENV['TERM']) && $os = $_ENV['TERM'];
	$max_upload = ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'Disabled';
	$maxexetime = ini_get('max_execution_time');
	$smarty->assign('items', $infos['items']);
	$smarty->assign('pvs', $infos['pvs']);
	$smarty->assign('editors', $infos['editors']);
	$smarty->assign('attachmentsizes', empty($infos['attachmentsizes']) ? 0 : $infos['attachmentsizes']);
	$smarty->assign('attachments', $infos['attachments']);
	$smarty->assign('admin_id', $admin_id);
	$smarty->assign('os', $os);
	$smarty->assign('phpversion', PHP_VERSION);
	$smarty->assign('dbversion', $db->version());
	$smarty->assign('akversion', $sysedition);
	$smarty->assign('authsuccess', $authsuccess);
	$smarty->assign('iscreator', iscreator());
	$smarty->assign('maxupload', $max_upload);
	$smarty->assign('maxexetime', $maxexetime);
	$smarty->assign('servertime', $servertime);
	$smarty->assign('correcttime', $correcttime);
	$smarty->assign('dbtype', $dbtype);
	displaytemplate('admincp_welcome.htm');
}
runinfo();
aexit();
?>