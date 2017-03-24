<?php
function writeindexs($se, $data) {
	$keywords = array();
	foreach($data as $d) {
		if(isset($keywords[$d['keyword']])) {
			$keywords[$d['keyword']] .= inttobin($d['itemid'], 3).inttobin($d['count'], 1).inttobin($d['time'], 4);
		} else {
			$keywords[$d['keyword']] = inttobin($d['itemid'], 3).inttobin($d['count'], 1).inttobin($d['time'], 4);
		}
	}
	unset($data);
	foreach($keywords as $keyword => $value) {
		if(strlen($value) % 8 != 0) error_log($keyword."\n", 3, AK_ROOT.'logs/8size.error');
		$index = hashindex($se, $keyword);
		ak_touch($index);
		if($fp = fopen($index, 'ab')) {
			flock($fp, LOCK_EX);
			fwrite($fp, $value);
			flock($fp, LOCK_UN);
			fclose($fp);
		}
	}
}

function readindex($sid, $keywords, $offset = 0, $num = 0) {
	$return = array();
	$ses = getcache('ses');
	$se = $ses[$sid];
	foreach($keywords as $keyword) {
		$index = hashindex($se, $keyword);
		if(!file_exists($index)) return $return;
		if($fp = fopen($index, 'rb')) {
			if($offset > 0) fseek($fp, $offset * 8);
			$i = 0;
			while(!feof($fp)) {
				$line = fread($fp, 8);
				if(empty($line)) continue;
				$itemid = bintoint(substr($line, 0, 3));
				$count = bintoint(substr($line, 3, 1));
				$dateline = bintoint(substr($line, 4));
				$return[$keyword][] = array(
					'itemid' => $itemid,
					'count' => $count,
					'time' => $dateline
				);
				$i ++;
				if($num > 0 && $i >= $num) break;
			}
			fclose($fp);
		}
	}
	return $return;
}

function readsortedindex($se, $keywords, $orderby, $offset = 0, $num = 0) {
	$return = array();
	if(count($keywords) == 1) {
		$keyword = current($keywords);
		$index = hashindex($se, $keyword, $orderby);
		if(!file_exists($index)) return false;
		$return['count'] = filesize($index) / 3;
		if($fp = fopen($index, 'rb')) {
			if($offset > 0) fseek($fp, $offset * 3);
			$i = 0;
			while(!feof($fp)) {
				$line = fread($fp, 3);
				if(empty($line)) continue;
				$return['value'][] = bintoint(substr($line, 0, 3));
				$i ++;
				if($num > 0 && $i >= $num) break;
			}
			fclose($fp);
		}
	} else {
		foreach($keywords as $keyword) {
			$indexfile[$keyword] = hashindex($se, $keyword, $orderby);
			if(!file_exists($indexfile[$keyword])) {
				return array('count' => 0,'value' => array());
			}
		}
		$index = array();
		foreach($keywords as $keyword) {
			$fp = fopen($indexfile[$keyword], 'rb');
			while(!feof($fp)) {
				$line = fread($fp, 3);
				if(empty($line)) continue;
				$index[$keyword][] = bintoint($line);
			}
			fclose($fp);
		}
		$return = array_shift($index);
		while(count($index) >= 1) {
			$return = array_intersect($return, array_shift($index));
		}
		$return = array('count' => count($return), 'value' => array_slice($return, $offset, $num));
	}
	return $return;
}

function readindexcount($se, $keyword) {
	$index = hashindex($se, $keyword);
	if(!file_exists($index)) return 0;
	return filesize($index) / 8;
}

function inttobin($int, $length = 0) {
	$i = $int;
	if($length == 1 && $int > 255) $int = 255;
	if($length == 2 && $int > 65535) $int = 65535;
	if($length == 3 && $int > 16777215) $int = 16777215;
	$return = '';
	while($i > 0) {
		$return = chr($i % 256).$return;
		$i = floor($i / 256);
	}
	if($length > 0 && $length > strlen($return)) {
		$return = str_repeat(chr(0), $length - strlen($return)).$return;
	}
	if($length > 0 && $length < strlen($return)) $return = substr($return, 0, $length);
	return $return;
}

function bintoint($str) {
	$len = strlen($str);
	$return = 0;
	for($i = 0; $i < $len; $i ++) {
		$return = $return * 256 + ord($str[$i]);
	}
	return $return;
}

function hashindex($se, $keyword, $type = '') {
	$md5 = md5($keyword);
	$path = '';
	for($i = 0; $i < 2; $i ++) {
		$path .= $md5[$i].'/';
	}
	$basepath = calindexpath($se);
	if($type == '') {
		return $basepath.'/'.$path.$md5.'.aki';
	} else {
		return $basepath.'/'.$path.$md5.".{$type}.aki";
	}
}

function calindexpath($se) {
	$basepath = str_replace('\\', '/', $se['data']['path']);
	if(substr($basepath, 0, 1) != '/' && strpos($basepath, ':') === false) $basepath = AK_ROOT.'index/'.$basepath;
	if(substr($basepath, -1) == '/') $basepath = substr($basepath, 0, -1);
	return $basepath;
}

function deleteindex($sid) {
	global $se, $thetime;
	if($se['id'] != $sid) {
		$ses = getcache('ses');
		$secache = $ses[$sid];
	} else {
		$secache = $se;
	}
	$indexpath = calindexpath($secache);
	@rename($indexpath, $indexpath.'/../indexbak-'.$thetime);
}

function readkeywords($dic) {
	$keywords = array();
	if(strpos($dic, ':') === false && substr($dic, 0, 1) != '/') $dic = AK_ROOT.$dic;
	if($fp = fopen($dic, 'r')) {
		while(!feof($fp)) {
			$line = trim(fgets($fp, 1024));
			if($line == '') continue;
			if(substr($line, 0, 1) == '#') continue;
			$keywords[] = $line;
		}
	}
	return $keywords;
}

function sortindex($se, $keyword) {
	global $db;
	$batchnum = 10000;
	$countflag = in_array('count', $se['data']['orderby']);
	$timeflag = in_array('time', $se['data']['orderby']);
	$index = hashindex($se, $keyword);
	if(!file_exists($index)) return false;
	$indexsize = filesize($index);
	if($indexsize > $batchnum * 8) {//索引太大，分组排序再归并
		if($fp = fopen($index, 'rb')) {
			$i = 0;
			$batchcountdata = array();
			$batchtimedata = array();
			while(!feof($fp)) {
				$line = fread($fp, 8);
				if(empty($line)) break;
				$itemid = bintoint(substr($line, 0, 3));
				if($countflag) $batchcountdata[$itemid] = bintoint(substr($line, 3, 1));
				if($timeflag) $batchtimedata[$itemid] = bintoint(substr($line, 4));
				$i ++;
				if($i % $batchnum == 0 || $i == $indexsize / 8) {
					if($countflag) {
						$sorted = '';
						arsort($batchcountdata);
						foreach($batchcountdata as $k => $v) {
							$sorted .= inttobin($k, 3).inttobin($v, 1);
						}
						writetofile($sorted, $index.'.count.'.ceil($i / $batchnum));
						$sorted = '';
						$batchcountdata = array();
					}
					if($timeflag) {
						$sorted = '';
						arsort($batchtimedata);
						foreach($batchtimedata as $k => $v) {
							$sorted .= inttobin($k, 3).inttobin($v, 4);
						}
						writetofile($sorted, $index.'.time.'.ceil($i / $batchnum));
						$sorted = '';
						$batchtimedata = array();
						echo '#';
					}
				}
			}
			fclose($fp);
			$maxindexid = ceil($i / $batchnum);
			if($countflag) {
				$fp = array();
				$current = array();
				$itemids = array();
				for($j = 1; $j <= $maxindexid; $j ++) {
					$fp[$j] = fopen($index.'.count.'.$j, 'rb');
					$line = fread($fp[$j], 4);
					$itemid = bintoint(substr($line, 0, 3));
					$count = bintoint(substr($line, 3, 1));
					$current[$j] = $count;
					$itemids[$j] = $itemid;
				}
				$i = 1;
				$countsortindex = hashindex($se, $keyword, 'count');
				$sortfp = fopen($countsortindex, 'wb');
				while(1) {
					$max = max($current);
					if($max == 0) break;
					$key = array_search($max, $current);
					fwrite($sortfp, inttobin($itemids[$key], 3));
					$i ++;
					if(!feof($fp[$key])) {
						$line = fread($fp[$key], 4);
						$itemid = bintoint(substr($line, 0, 3));
						$count = bintoint(substr($line, 3, 1));
						$current[$key] = $count;
						$itemids[$key] = $itemid;
					}
				}
				fclose($sortfp);
				for($j = 1; $j <= $maxindexid; $j ++) {
					@fclose($fp[$j]);
					unlink($index.'.count.'.$j);
				}
			}
			if($timeflag) {
				$fp = array();
				$current = array();
				$itemids = array();
				for($j = 1; $j <= $maxindexid; $j ++) {
					$fp[$j] = fopen($index.'.time.'.$j, 'rb');
					$line = fread($fp[$j], 7);
					$itemid = bintoint(substr($line, 0, 3));
					$time = bintoint(substr($line, 3));
					$current[$j] = $time;
					$itemids[$j] = $itemid;
				}
				$i = 1;
				$timesortindex = hashindex($se, $keyword, 'time');
				$sortfp = fopen($timesortindex, 'wb');
				while(1) {
					$max = max($current);
					if($max == 0) break;
					$key = array_search($max, $current);
					fwrite($sortfp, inttobin($itemids[$key], 3));
					$i ++;
					if(!feof($fp[$key])) {
						$line = fread($fp[$key], 7);
						$itemid = bintoint(substr($line, 0, 3));
						$time = bintoint(substr($line, 3));
						$current[$key] = $time;
						$itemids[$key] = $itemid;
					}
				}
				fclose($sortfp);
				for($j = 1; $j <= $maxindexid; $j ++) {
					@fclose($fp[$j]);
					//unlink($index.'.time.'.$j);
				}
			}
		}
	} else {//索引小，直接在内存中排序
		if($fp = fopen($index, 'rb')) {
			$i = 0;
			$batchcountdata = array();
			$batchtimedata = array();
			while(!feof($fp)) {
				$line = fread($fp, 8);
				if(empty($line)) break;
				$itemid = bintoint(substr($line, 0, 3));
				if($countflag) $batchcountdata[$itemid] = bintoint(substr($line, 3, 1));
				if($timeflag) $batchtimedata[$itemid] = bintoint(substr($line, 4));
			}
			fclose($fp);
			if($countflag) {
				$countsortindex = hashindex($se, $keyword, 'count');
				arsort($batchcountdata);
				$sorted = '';
				foreach($batchcountdata as $k => $v) {
					$sorted .= inttobin($k, 3);
				}
				writetofile($sorted, $countsortindex);
			}
			if($timeflag) {
				$timesortindex = hashindex($se, $keyword, 'time');
				arsort($batchtimedata);
				$sorted = '';
				foreach($batchtimedata as $k => $v) {
					$sorted .= inttobin($k, 3);
				}
				writetofile($sorted, $timesortindex);
			}
		}
	}
	$db->update('keywords', array('flag' => 0), "keyword='".$db->addslashes($keyword)."' AND sid='{$se['id']}'");
}

function touchse($id, $time = 0) {
	global $db, $thetime;
	$se = $db->get_by('*', 'ses', "id='$id'");
	$value = unserialize($se['value']);
	$value['lastupdate'] = $thetime;
	$value = serialize($value);
	$db->update('ses', array('value' => $value), "id='$id'");
	updatecache('ses');
}
?>