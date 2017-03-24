<?php
require_once $mypath.$system_root.'/include/common.inc.php';
require_once AK_ROOT.'include/global.func.php';
require_once AK_ROOT.'include/fore.inc.php';
$config_timeout = 10;
$statcachefilename = AK_ROOT.'cache/visit.txt';
//统计开始
if(empty($setting_forbidstat)) {
	dealwithstatcache();
	if(isset($get_i) && a_is_int($get_i)) {
		$request = $get_i;
		if(!isset($cookie_sid)) {
			$cookie_sid = ak_md5($onlineip.$thetime, 1);
			aksetcookie('sid', $cookie_sid);
		}
		addtostatcache($request, $cookie_sid, $thetime, $onlineip);
	}
}
//统计结束
aexit('0');
function addtostatcache($id, $sid = '', $thetime = 0, $ip) {
	global $statcachefilename;
	$log = $id."\t".$sid."\t".$thetime."\t".$ip."\n";
	error_log($log, 3, $statcachefilename);
}

function dealwithstatcache() {
	global $statcachefilename, $db, $tablepre, $setting_statcachesize, $timedifference;
	if(!file_exists($statcachefilename)) return;
	$lastmodified = filemtime($statcachefilename) + $timedifference * 3600;
	if(filesize($statcachefilename) > $setting_statcachesize) {
		rename($statcachefilename, $statcachefilename.'.tmp');
		$cache = readfromfile($statcachefilename.'.tmp');
		unlink($statcachefilename.'.tmp');
		$array_cache = explode("\n", $cache);
		$array_cache_operated = array();
		foreach($array_cache as $cache) {
			$array_field = explode("\t", $cache);
			if(count($array_field) >= 4) {
				$array_cache_operated[] = $array_field[0];
				if(substr($array_field[0], 0, 1) == 'c') {
					$type = 'category';
					$itemid = substr($array_field[0], 1);
				} else {
					$type = 'item';
					$itemid = $array_field[0];
				}
			}
		}
		$visit = array_count_values($array_cache_operated);
		foreach($visit as $id => $count) {
			if(empty($id)) continue;
			if(substr($id, 0, 1) == 'c') {
				$id = substr($id, 1);
				$db->update('categories', array('pv' => "+{$count}"), "id='$id'");
			} else {
				$db->update('items', array('pageview' => "+{$count}"), "id='$id'");
			}
		}
	}
}
?>