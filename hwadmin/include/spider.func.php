<?php
function spiderlist($rule, $write = 1, $listurl = '') {
	global $db;
	if($listurl == '') {
		$u = $rule['listurl'];
	} else {
		$u = $listurl;
	}
	$item_urls = array();
	if(substr($u, -1) == '/') {
		$url_path = $u;
	} else {
		$pathinfo = pathinfo($u);
		$url_path = $pathinfo['dirname'].'/';
	}
	$us = array();
	if(strpos($u, '(*)') !== false && isset($rule['startid']) && isset($rule['endid'])) {
		for($i = $rule['startid']; $i <= $rule['endid']; $i ++) {
			$id = $i;
			if(!empty($rule['idwidth'])) $id = str_repeat('0', $rule['idwidth'] - strlen((string)$i));
			$us[] = str_replace('(*)', $id, $u);
		}
	} else {
		$us[] = $u;
	}
	if(!empty($rule['replace'])) {
		$_r = explode("\n", $rule['replace']);
		$replace = $to = array();
		foreach($_r as $__r) {
			$__r = trim($__r);
			if(strpos($__r, '|') === false) continue;
			list($r, $t) = explode('|', $__r);
			$replace[] = $r;
			$to[] = $t;
		}
	}
	foreach($us as $url) {
		$domaininfo = parse_url($url);
		$domain = $domaininfo['scheme'].'://'.$domaininfo['host'];
		$text = readfromurl($url, 1);
		$text = str_replace("\r", '', $text);
		if(!empty($replace)) $text = ak_replace($replace, $to, $text);
		$text = getfield($rule['start'], $rule['end'], $text, '###');
		$texts = explode('###', $text);
		foreach($texts as $text) {
			$_text = $text;
			$text = strip_tags($text, '<a>');
			preg_match_all("'<\s*a.*?href\s*=(.+?)(\s+.*?)?>(.*?)<\s*/a\s*>'isx",$text,$matchs);
			$urls = array();
			foreach($matchs[1] as $key => $link) {
				$link = str_replace('\'', '', $link);
				$link = str_replace('"', '', $link);
				$title = $matchs[3][$key];
				$urlcharacters = explode("\n", $rule['urlcharacter']);
				$titlecharacters = explode("\n", $rule['titlecharacter']);
				$urlskips = explode("\n", $rule['urlskip']);
				$titleskips = explode("\n", $rule['titleskip']);
				foreach($urlcharacters as $character) {
					$character = trim($character);
					if($character == '') continue;
					if(strpos($link, $character) === false) continue 2;
				}
				foreach($titlecharacters as $character) {
					$character = trim($character);
					if($character == '') continue;
					if(strpos($title, $character) === false) continue 2;
				}
				if((count($urlskips) > 1 || !empty($urlskips[0])) && in_string($link, $urlskips) == 1) continue;
				if((count($titleskips) > 1 || !empty($titleskips[0])) && in_string($title, $titleskips) == 1) continue;
				if(strpos($link, 'http://') === false) {
					if(substr($link, 0, 1) == '/') {
						$link = $domain.$link;
					} else {
						$link = $url_path.'/'.$link;
					}
				}
				if(!in_array($link, $urls)) {
					$urls[] = $link;
					$title = strip_tags(trim($title));
					$title = str_replace("\n", '', $title);
					$title = str_replace("\r", '', $title);
					$item_urls[$link] = array(
						'title' => $title,
						'html' => ''
					);
					if(!empty($rule['append'])) $item_urls[$link]['html'] = $_text;
				}
			}
		}
	}
	foreach($item_urls as $key => $_item) {
		if($catched = $db->get_by('itemid', 'spider_catched', "`key`='".ak_md5($key, 1)."'")) {
			if($rule['update'] == 0) {
				unset($item_urls[$key]);
			} else {
				$itemid[$key] = $catched;
			}
		}
	}
	$item_urls = array_reverse($item_urls);
	$hookfunction = "hook_spidelist_{$rule['id']}";
	if(function_exists($hookfunction)) $item_urls = $hookfunction($item_urls);
	if(!empty($write)) {
		foreach($item_urls as $key => $item) {
			$_item = implode('{#}', $item);
			$task = $rule['id']."\t".$rule['rule']."\t".$key."\t";
			if(!empty($itemid[$key])) $task .= $itemid[$key];
			$task .= "\t".implode('{#}', $item);
			addtask('spideritem', $task);
		}
	}
	return $item_urls;
}

function spiderurl($rule, $url, $listrule = array(), $linktext = '', $append_html = '') {
	global $db, $charset;
	$return = array();
	$html = '';
	if(!empty($url) && substr($url, 0, 1) != '#') {
		$html = readfromurl($url, 1);
		if($html == '') return false;
	}
	$content = "<url:{$url}>\n<title:{$linktext}>\n".$html.$append_html;
	if(!empty($rule['pagebreakfield'])) {
		if($rule['pagebreakstart'] != '' && $rule['pagebreakend'] != '') {
			$pagehtml = getfield($rule['pagebreakstart'], $rule['pagebreakend'], $content);
		} else {
			$pagehtml = $content;
		}
		$pagehtml = strip_tags($pagehtml, '<a>');
		preg_match_all("'<\s*a.*?href\s*=(.+?)(\s+.*?)?>(.*?)<\s*/a\s*>'isx", $pagehtml, $matchs);
		$pageurls = array();
		if(!empty($rule['pagebreakreplace'])) {
			list($replace, $to) = explode('|', $rule['pagebreakreplace']);
			$match = str_replace($replace, $to, $url);
			$match = str_replace('[page]', '[0-9]+', $match);
			$match = str_replace('/', '\/', $match);
		}
		foreach($matchs[1] as $key => $link) {
			$link = str_replace('\'', '', $link);
			$link = str_replace('"', '', $link);
			$link = calrealurl($link, $url);
			if(!empty($rule['pagebreakcharacter']) && strpos($link, $rule['pagebreakcharacter']) === false) continue;
			if(!preg_match("/{$match}/is", $link)) continue;
			if($link != $url) $pageurls[] = $link;
		}
		$pageurls = array_unique($pageurls);
		$pagehtmls = array();
		foreach($pageurls as $pageurl) {
			$pagehtmls[$pageurl] = readfromurl($pageurl, 1);
		}
	}
	$content = str_replace("\r\n", "\n", $content);
	if(!empty($rule['character'])) {
		$characters = explode("\n", $rule['character']);
		foreach($characters as $character) {
			$character = trim($character);
			if(strpos($content, (string)$character) !== false) {
				$characterflag = 1;
				break;
			}
		}
		if(empty($characterflag)) return array();
	}
	if(!empty($rule['skip'])) {
		$skips = explode("\n", $rule['skip']);
		foreach($skips as $skip) {
			$skip = trim($skip);
			if(strpos($content, (string)$skip) !== false) return array();
		}
	}
	if(!empty($rule['replace'])) {
		$replaces = explode("\n", $rule['replace']);
		foreach($replaces as $replace) {
			$replace = trim($replace);
			if(substr_count($replace, '|') != 1) continue;
			list($replace, $to) = explode('|', $replace);
			if(strpos($replace, '(*)') === false) {
				$content = str_replace($replace, $to, $content);
			} else {
				$replace = str_replace('(*)', '(.*?)', $replace);
				$replace = str_replace('/', '\/', $replace);
				$replace = str_replace('"', '\"', $replace);
				$content = preg_replace("/{$replace}/is", $to, $content);
			}
		}
	}
	$array_replace = array('[linktext]');
	$array_to = array($linktext);
	for($i = 1; $i <= 20; $i ++) {
		$field_start = $rule["start{$i}"];
		$field_end = $rule["end{$i}"];
		$repeat = $rule["repeat{$i}"];
		if(!empty($field_start) && !empty($field_end)) {
			$field[$i] = getfield($field_start, $field_end, $content, empty($rule['repeat'.$i]) ? '' : '<!--akcmsspidersplit-->');
			$array_replace[] = "[field{$i}]";
			if($field[$i] === false) {
				$array_to[] = '';
			} else {
				empty($listrule) ? $category = 0 : $category = $listrule['category'];
				$config = array(
					'itemurl' => $url,
					'html2txt' => !empty($rule['html2txt'.$i]),
					'keeptag' => $rule['keeptag'.$i],
					'killrepeatspace' => !empty($rule['killrepeatspace'.$i]),
					'trim' => !empty($rule['trim'.$i]),
					'spiderpic' => !empty($rule['spiderpic'.$i]),
					'repeat' => $rule['repeat'.$i],
					'category' => $category
				);
				if(!empty($rule["trim{$i}"])) $field[$i] = trim($field[$i]);
				$spiderfield = calspiderfield($field[$i], $config, $url, !empty($rule['finish']));
				if(isset($rule['pagebreakfield']) && $rule['pagebreakfield'] == $i) {
					foreach($pagehtmls as $url => $html) {
						$_field = getfield($field_start, $field_end, $html, empty($rule['repeat'.$i]) ? '' : '<!--akcmsspidersplit-->');
						if(!empty($rule["trim{$i}"])) $_field = trim($_field);
						$_field = calspiderfield($_field, $config, $url, !empty($rule['finish']));
						$spiderfield .= $_field;
					}
				}
				$array_to[] = $spiderfield;
			}
		}
	}
	if(!empty($rule['skipwhere'])) {
		$skipwhere = ak_replace($array_replace, $array_to, $rule['skipwhere']);
		if($db->get_by('id', 'items', $skipwhere)) return array();
	}
	if(!empty($rule['dateline'])) {
		for($i = 1; $i <= 20; $i ++) {
			if(strpos($rule['dateline'], "[field{$i}]") !== false) {
				$array_to[$i] = ak_strtotime($array_to[$i]);
			}
		}
	}
	foreach(array('title', 'aimurl', 'shorttitle', 'dateline', 'author', 'source', 'editor', 'data', 'keywords', 'digest', 'picture', 'orderby', 'orderby2', 'orderby3', 'orderby4', 'comment', 'filename', 'pageview') as $field) {
		//借四干嘛捏？
		$offset = strpos($rule[$field], '//');
		if($offset !== false) $rule[$field] = substr($rule[$field], 0, $offset);
		//借四干嘛捏？
		$return[$field] = ak_replace($array_replace, $array_to, $rule[$field]);
		if($field == 'dateline') $return[$field] = eval('return '.$return[$field].';');
	}
	if(empty($return['title'])) return false;
	if(strpos($return['picture'], '<') !== false) $return['picture'] = pickpicture($return['picture'], $url);
	if(substr($return['keywords'], 0, 6) == '[auto]') {
		$keywords = cloudkeywords($return['title'], substr($return['keywords'], 6));
		$return['keywords'] = '';
		if(!empty($keywords)) $return['keywords'] = implode(',', $keywords);
	}
	for($i = 1; $i <= 20; $i ++) {
		if(empty($rule['extname'.$i]) || empty($rule['extvalue'.$i])) continue;
		$return['_'.$rule['extname'.$i]] = ak_replace($array_replace, $array_to, $rule['extvalue'.$i]);
	}
	$hookfunction = "hook_spiderurl_{$rule['id']}";
	if(function_exists($hookfunction)) $return = $hookfunction($return);
	return $return;
}

function getspiderpicturetask() {
	$task = gettask('spiderpicture');
	return $task;
}

function calspiderfield($html, $config, $url = '', $finish = 0) {
	global $homepage;
	if(!empty($config['html2txt'])) $html = decode_htmlspecialchars($html);
	if(strpos($html, '<!--akcmsspidersplit-->') !== false && !empty($config['repeat'])) {
		$htmls = explode('<!--akcmsspidersplit-->', $html);
		$return = array();
		foreach($htmls as $html) {
			$return[] = calspiderfield($html, $config, $url, $finish);
		}
		return implode($config['repeat'], $return);
	}
	$html = str_replace("\t", '', $html);
	$html = str_replace("\r", '', $html);
	$html = str_replace("\n", '', $html);
	$html = preg_replace("/<script.*?<\/\s*?script>/is", '', $html);
	$html = preg_replace("/<style.*?<\/\s*?style>/is", '', $html);
	//$html = preg_replace("/<\/p>/i", "\n\n", $html);
	$html = preg_replace("/<br.*?>/i", "\n", $html);
	if(empty($config['keeptag'])) {
		$html = strip_tags($html);
	} else {
		$html = strip_tags($html, $config['keeptag']);
	}
	$html = preg_replace("/\n{2,}/i", "\n\n", $html);
	if(!empty($config['killrepeatspace'])) {
		$html = killrepeatspace($html);
	}
	if(!empty($config['trim'])) {
		$html = trim($html);
	}
	if(!empty($config['spiderpic'])) {
		$html = copypicturetolocal($html, $config);
	}
	return $html;
}

function decode_htmlspecialchars($str) {
	$str = str_replace('&nbsp;', ' ', $str);
	$str = str_replace('&#39;', '\'', $str);
	$str = str_replace('&#8216;', '\'', $str);
	$str = str_replace('&#8217;', '\'', $str);
	$str = str_replace('&#8221;', '"', $str);
	return $str;
}

function killrepeatspace($str) {
	return preg_replace("/([ \t]+)/i", ' ', $str);
}

function getspidertask() {
	$task = gettask('spideritem');
	if(empty($task)) return false;
	list($list, $rule, $url, $itemid, $html) = explode("\t", $task, 5);
	list($title, $html) = explode("{#}", $html);
	return array(
		'list' => $list,
		'rule' => $rule,
		'url' => $url,
		'title' => $title,
		'html' => $html,
		'itemid' => $itemid
	);
}

function insertspidereddata($spiderresult, $listrule, $task) {
	global $db, $thetime;
	$itemid = $task['itemid'];
	$modules = getcache('modules');
	$value = $spiderresult;
	unset($value['data'], $value['comment']);
	$value['category'] = $listrule['category'];
	$value['section'] = $listrule['section'];
	if(empty($value['dateline'])) $value['dateline'] = $thetime;
	$extvalue = array();
	$category = getcategorycache($value['category']);
	$module = $modules[$category['module']];
	foreach($value as $k => $v) {
		if(isset($module['data']['fields'][$k]['type']) && $module['data']['fields'][$k]['type'] == 'rich') $v = nl2br($v);
		if(substr($k, 0, 1) == '_') {
			$extvalue[$k] = $v;
			unset($value[$k]);
		}
	}
	if(!empty($extvalue)) $value['ext'] = 1;
	if($module['data']['fields']['data']['type'] == 'rich') $spiderresult['data'] = nl2br($spiderresult['data']);
	if(!empty($itemid)) {
		$db->update('items', $value, "id='$itemid'");
		if(!empty($spiderresult['data'])) {
			$db->update('texts', array('text' => $spiderresult['data']), "itemid='$itemid'");
		}
		if(!empty($extvalue)) {
			$db->update('item_exts', array('value' => serialize($extvalue)), "id='$itemid'");
		}
	} else {
		$db->insert('items', $value);
		$itemid = $db->insert_id();
		if(!empty($spiderresult['data'])) {
			$db->insert('texts', array('itemid' => $itemid, 'text' => $spiderresult['data']));
		}
		if(!empty($extvalue)) {
			$db->insert('item_exts', array('id' => $itemid, 'value' => serialize($extvalue)));
		}
		if(empty($task['norecord'])) {
			$key = ak_md5($task['url'], 1);
			if(!$db->get_by('id', 'spider_catched', "`key`='$key'")) {
				$catched = array(
					'key' => $key,
					'url' => $task['url'],
					'dateline' => $thetime,
					'rule' => $task['list'],
					'itemid' => $itemid
				);
				$db->insert('spider_catched', $catched);
			}
		}
		if(!empty($spiderresult['comment'])) {
			$contentrule = getcache('spidercontentrule'.$listrule['rule']);
			$commentfiledid = getfield('[field', ']', $contentrule['comment']);
			$comments = explode($contentrule['repeat'.$commentfiledid], $spiderresult['comment']);
			if(strpos($contentrule['comment'], '[random]')) shuffle($comments);
			foreach($comments as $comment) {
				$value = array(
					'itemid' => $itemid,
					'message' => $comment,
					'dateline' => $thetime
				);
				$db->insert('comments', $value);
			}
		}
	}
	return $itemid;
}

function ifcatched($task) {
	global $db;
	$key = ak_md5($task['url'], 1);
	$row = $db->get_by('*', 'spider_catched', "`key`='$key' AND rule='{$task['list']}'");
	if($row !== false) {
		return $row['itemid'];
	} else {
		return 0;
	}
}
?>