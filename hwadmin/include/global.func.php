<?php
require_once(AK_ROOT.'include/cache.func.php');
require_once(AK_ROOT.'include/section.func.php');
require_once(AK_ROOT.'include/category.func.php');
function db($config = array(), $forcenew = 0) {
	global $dbtype, $db;
	if(!empty($db) && empty($forcenew)) return $db;
	if(empty($config)) {
		global $dbname, $dbhost, $dbuser, $dbpw, $charset;
		if($dbtype == 'mysql') {
			$config['type'] = 'mysql';
			$config['dbname'] = $dbname;
			$config['dbhost'] = $dbhost;
			$config['dbuser'] = $dbuser;
			$config['dbpw'] = $dbpw;
			$config['charset'] = $charset;
		} elseif($dbtype == 'sqlite') {
			$config['type'] = 'sqlite';
			$config['dbname'] = $dbname;
		} elseif($dbtype == 'pdo:sqlite2') {
			$config['type'] = 'pdo:sqlite';
			$config['version'] = 2;
			$config['dbname'] = $dbname;
		} elseif($dbtype == 'pdo:sqlite') {
			$config['type'] = 'pdo:sqlite';
			$config['version'] = 3;
			$config['dbname'] = $dbname;
		} elseif($dbtype == 'pdo:mysql') {
			$config['type'] = 'pdo:mysql';
			$config['dbname'] = $dbname;
			$config['dbhost'] = $dbhost;
			$config['dbuser'] = $dbuser;
			$config['dbpw'] = $dbpw;
			$config['charset'] = $charset;
		}
	}
	if($config['type'] == 'mysql') {
		require_once(AK_ROOT.'include/db.mysql.php');
		$db = new mysqlstuff($config);
	} elseif($config['type'] == 'sqlite') {
		require_once(AK_ROOT.'include/db.sqlite.php');
		$db = new sqlitestuff($config);
	} elseif($config['type'] == 'pdo:sqlite') {
		require_once(AK_ROOT.'include/db.pdo.sqlite.php');
		$db = new pdosqlitestuff($config);
	} elseif($config['type'] == 'pdo:mysql') {
		require_once(AK_ROOT.'include/db.pdo.mysql.php');
		$db = new pdomysqlstuff($config);
	}
	return $db;
}
function akinclude($params) {
	global $template_path;
	if(!isset($params['pagevariables'])) {
		$pagevariables = array();
	} else {
		$pagevariables = $params['pagevariables'];
	}
	$pagevariables['subtemplate'] = 1;
	if(empty($params['expire'])) {
		echo render_template($pagevariables, $params['file']);
	} else {
		$params['type'] = 'template';
		$data = getcachedata($params);
		if($data == '') {
			$data = render_template($pagevariables, $params['file']);
			setcachedata($params, $data);
		}
		echo $data;
	}
}
function akincludeurl($params) {
	global $host;
	if(!isset($params['url'])) return;
	if(substr($params['url'], 0, 1) == '/') $params['url'] = 'http://'.$host.$params['url'];
	if(strpos($params['url'], 'http://') === false) return;
	if(!isset($params['expire'])) echo readfromurl($params['url']);
	if(isset($params['expire'])) {
		$params['type'] = 'url';
		$data = getcachedata($params);
		if($data == '') {
			$data = readfromurl($params['url']);
			setcachedata($params, $data);
		}
		echo $data;
	}
}

function includetemplateplugins() {
	global $html_smarty, $plugins;
	$plugins = getcache('plugins');
	if(empty($plugins)) return;
	foreach($plugins as $plugin) {
		$pluginkey = str_replace('.template.php', '', $plugin);
		require_once(AK_ROOT.'plugins/'.$plugin);
		$html_smarty->register_function($pluginkey, $pluginkey);
	}
}

function render_template($pagevariables, $template = '', $createhtml = 0) {
	if($template == '') {
		if(isset($pagevariables['template'])) {
			$template = $pagevariables['template'];
		} else {
			return false;
		}
	}
	global $template_path, $smarty, $thetime, $lr, $header_charset, $globalvariables, $sections, $setting_storemethod, $html_smarty, $homepage, $setting_defaultfilename, $sysname, $sysedition;
	if(empty($pagevariables['subtemplate']) && empty($pagevariables['systemplate'])) $template = ','.$template;
	$templatefile = $template;
	if(strpos($template, '/') === false) $templatefile = AK_ROOT."configs/templates/$template_path/".$template;
	if(!file_exists($templatefile)) {
		if(substr($template, 0, 1) == ',') $template = substr($template, 1);
		aexit($template.' lose.<br /><a href="http://www.akcms.com/manual/template-lose.htm" target="_blank">help</a>');
	}
	require_once AK_ROOT.'include/smarty/libs/Smarty.class.php';
	$html_smarty = new Smarty;
	$sections = getcache('sections');
	$globalvariables = getcache('globalvariables');
	require_once AK_ROOT.'include/getdata.func.php';
	$html_smarty->template_dir = AK_ROOT."configs/templates/$template_path";
	$html_smarty->compile_dir = AK_ROOT."cache/templates";
	$html_smarty->config_dir = AK_ROOT."configs/";
	$html_smarty->cache_dir = AK_ROOT."cache/";
	$html_smarty->left_delimiter = "<{";
	$html_smarty->right_delimiter = "}>";
	$html_smarty->assign('charset', $header_charset);
	$html_smarty->assign('pagevariables', $pagevariables);
	$html_smarty->assign('thetime', $thetime);
	$html_smarty->register_function('akinclude', 'akinclude');
	$html_smarty->register_function('akincludeurl', 'akincludeurl');
	$html_smarty->register_function('getitems', 'getitems');
	$html_smarty->register_function('getcategories', 'getcategories');
	$html_smarty->register_function('getcomments', 'getcomments');
	$html_smarty->register_function('getlists', 'getlists');
	$html_smarty->register_function('monitor', 'monitor');
	$html_smarty->register_function('getindexs', 'getindexs');
	$html_smarty->register_function('ifhassubcategories', 'ifhassubcategories');
	$html_smarty->register_function('getattachments', 'getattachments');
	$html_smarty->register_function('getkeywords', 'getkeywords');
	$html_smarty->register_function('getsqls', 'getsqls');
	$html_smarty->register_function('getinfo', 'getinfo');
	$html_smarty->register_function('getuser', 'getuser');
	$html_smarty->register_function('getpictures', 'getpictures');
	includetemplateplugins();
	$html_smarty->assign('home', substr($homepage, 0, -1));
	if(!empty($globalvariables)) {
		foreach($globalvariables as $key => $v) {
			$html_smarty->assign('v_'.$key, $v);
		}
	}
	foreach($pagevariables as $key => $value) {
		$html_smarty->assign($key, $value);
	}
	foreach($_GET as $key => $value) {
		$html_smarty->assign('get_'.$key, htmlspecialchars($value));
		$html_smarty->assign('get_d_'.$key, $value);
	}
	foreach($_COOKIE as $key => $value) {
		$html_smarty->assign('cookie_'.$key, htmlspecialchars($value));
		$html_smarty->assign('cookie_d_'.$key, $value);
	}
	if(isset($_GET['page'])) $html_smarty->assign('page', htmlspecialchars($_GET['page']));
	$text = $html_smarty->text($template);
	if(empty($pagevariables['subtemplate'])) $text = renderhtml($text, $pagevariables);
	if(!empty($pagevariables['html']) && !empty($createhtml)) {
		$filename = $pagevariables['htmlfilename'];
		$_s = calfilenamefromurl($filename);
		if(strpos($_s, '.') === false) {
			$filename .= '/'.$setting_defaultfilename;
		} elseif(substr($_s, -1) == '/') {
			$filename .= $setting_defaultfilename;
		}
		writetofile($text, $filename);
	}
	return $text;
}

function get_item_data($id, $template = '') {
	global $template_path, $smarty, $db, $tablepre, $lan, $thetime, $system_root, $lr, $header_charset, $setting_homepage, $setting_ifhtml, $sections, $setting_storemethod, $html_smarty, $setting_richtext, $homepage, $attachurl;
	if(!a_is_int($id)) return false;
	$variables['_pagetype'] = 'item';
	$variables['_pageid'] = $id;
	if(!$item = $db->get_by('*', 'items', "id='$id'")) return array();
	$categorycache = getcategorycache($item['category']);
	if(!empty($template)) {
		$variables['template'] = $template;
	} elseif($item['template'] == '') {
		$variables['template'] = $categorycache['itemtemplate'];
	} else {
		$variables['template'] = $item['template'];
	}
	$templatehtml = readfromfile(AK_ROOT.'configs/templates/'.$template_path.'/,'.$variables['template']);
	$sql = "SELECT text FROM {$tablepre}_texts WHERE itemid='{$id}' AND page='0'";
	$text = $db->get_field($sql);
	$texttitle = $item['title'];
	$textshorttitle = empty($item['shorttitle']) ? $texttitle : $item['shorttitle'];
	$title = htmltitle($texttitle, $item['titlecolor'], $item['titlestyle']);
	$shorttitle = htmltitle($textshorttitle, $item['titlecolor'], $item['titlestyle']);
	$text = renderkeywords($text, $item['keywords']);
	$categorycache = !empty($item['category']) ? getcategorycache($item['category']) : array();
	$modules = getcache('modules');
	if(!empty($categorycache)) $module = $modules[$categorycache['module']];
	$sections = getcache('sections');
	$section = !empty($sections[$item['section']]) ? $sections[$item['section']] : array();
	if(empty($item['dateline'])) $item['dateline'] = 0;
	list($y, $m, $d, $h, $i, $s) = explode(',', date('Y,m,d,H,i,s', $item['dateline']));
	if($item['lastupdate'] == 0) $item['lastupdate'] = $item['dateline'];
	list($last_y, $last_m, $last_d, $last_h, $last_i, $last_s) = explode(',', date('Y,m,d,H,i,s', $item['lastupdate']));
	$url = itemurl($id, $item['category'], $item['dateline'], $item['filename']);
	if(!empty($item['ext'])) {
		$itemextvalues = ak_unserialize($db->get_by('value', 'item_exts', "id='{$id}'"));
		if(is_array($itemextvalues)) {
			$variables = array_merge($variables, $itemextvalues);
		}
	}
	if($item['category'] == 0 || $categorycache['html'] == 1 || ($categorycache['html'] == 0 && $setting_ifhtml == 1)) {
		$variables['html'] = 1;
	}
	$variables['id'] = $id;
	$variables['title'] = $title;
	$variables['shorttitle'] = $shorttitle;
	$variables['texttitle'] = $texttitle;
	$variables['textshorttitle'] = $textshorttitle;
	if(!empty($module) && $module['data']['fields']['data']['type'] == 'plain') {
		$variables['data'] = nl2br($text);
	} else {
		$variables['data'] = $text;
	}
	$variables['keywords'] = tidyitemlist($item['keywords'], ',', 0);
	$variables['category'] = $item['category'];
	if(!empty($item['category']) && $item['category'] > 0) {
		$variables['categoryname'] = $categorycache['category'];
		$variables['categorypath'] = $categorycache['path'];
		$variables['categoryalias'] = $categorycache['alias'];
		$variables['categorydescription'] = $categorycache['description'];
		$variables['categorykeywords'] = $categorycache['keywords'];
		$variables['categoryup'] = $categorycache['categoryup'];
	}
	$variables['section'] = $item['section'];
	if(!empty($item['section'])) {
		$variables['sectionname'] = $section['section'];
		$variables['sectionalias'] = $section['alias'];
		$variables['sectiondescription'] = $section['description'];
		$variables['sectionkeywords'] = $section['keywords'];
	}
	$variables['editor'] = $item['editor'];
	$variables['author'] = $item['author'];
	if(strpos($templatehtml, '$author_encode') !== false) $variables['author_encode'] = urlencode($item['author']);
	$variables['source'] = $item['source'];
	$variables['picture'] = $item['picture'];
	if(!empty($item['picture']) && substr($item['picture'], 0, 7) !== 'http://') {
		if(!isset($attachurl)) $attachurl = $homepage;
		$variables['picture'] = $attachurl.$item['picture'];
	}	
	$variables['pageview'] = $item['pageview'];
	$variables['url'] = $url;
	$variables['digest'] = $item['digest'];
	if(empty($module['data']['fields']['digest']['richtext'])) $variables['digest'] = nl2br($item['digest']);
	$variables['aimurl'] = $item['aimurl'];
	$variables['y'] = $y;
	$variables['m'] = $m;
	$variables['d'] = $d;
	$variables['h'] = $h;
	$variables['i'] = $i;
	$variables['s'] = $s;
	$variables['last_y'] = $last_y;
	$variables['last_m'] = $last_m;
	$variables['last_d'] = $last_d;
	$variables['last_h'] = $last_h;
	$variables['last_i'] = $last_i;
	$variables['last_s'] = $last_s;
	$variables['commentnum'] = $item['commentnum'];
	$variables['scorenum'] = $item['scorenum'];
	$variables['aimurl'] = $item['aimurl'];
	$variables['totalscore'] = $item['totalscore'];
	$variables['avgscore'] = $item['avgscore'];
	$variables['attach'] = $item['attach'];
	$variables['orderby'] = $item['orderby'];
	$variables['orderby2'] = $item['orderby2'];
	$variables['orderby3'] = $item['orderby3'];
	$variables['orderby4'] = $item['orderby4'];
	$variables['htmlfilename'] = FORE_ROOT.htmlname($item['id'], $item['category'], $item['dateline'], $item['filename']);
	return $variables;
}

function batchhtml($ids) {
	if(is_numeric($ids)) $ids = array($ids);
	$categories = array();
	$GLOBALS['batchcreateitemflag'] = 1;
	require_once(AK_ROOT.'include/task.file.func.php');
	deletetask('indextask');
	foreach($ids as $id) {
		addtask('indextask', "item\n".$id."\n\n0");
	}
	while($task = gettask('indextask')) {
		list($type, $id, $filename, $page) = explode("\n", $task);
		if(strpos($filename, '?') !== false) continue;
		if($type != 'item') continue;
		$variables = get_item_data($id);
		if(!empty($filename)) $variables['htmlfilename'] = $filename;
		$variables['page'] = $page;
		$c = $variables['category'];
		if(empty($variables)) continue;
		if(!empty($c) && empty($categories[$c])) $categories[$c] = getcategorycache($c);
		if(empty($c) || $categories[$c]['html'] > 0) {
			if($page < 1) $GLOBALS['index_work'] = "item\n".$id."\n".$variables['htmlfilename'];
			render_template($variables, '', 1);
		}
		unset($GLOBALS['index_work']);
	}
	unset($GLOBALS['batchcreateitemflag']);
}

function getkeywordscache() {
	global $codekey;
	$_keywords = array();
	if($fp = @fopen(AK_ROOT.'configs/keywords.txt', 'r')) {
		while(!feof($fp)) {
			$_line = trim(fgets($fp));
			if(empty($_line)) continue;
			$_f = explode("\t", $_line);
			if(!isset($_f[0]) || !isset($_f[1])) continue;
			if(!isset($_f[2])) $_f[2] = '';
			$_keywords[] = $_f;
		}
		fclose($fp);
	}
	return $_keywords;
}

function core_htmlname($id, $category = 0, $dateline = 0, $filename = '') {//获得文件存放地址
	global $setting_htmlexpand;
	$categorycache = getcategorycache($category);
	if($category > 0 && empty($categorycache)) return false;
	$dateline = empty($dateline) ? time() : $dateline;
	list($year, $month, $day) = explode(' ', date('Y m d', $dateline));
	if($category == 0) {
		$path = '.';
	} else {
		$path = $categorycache['fullpath'];
	}
	$storemethod = $categorycache['storemethod'];
	$path = str_replace('[categorypath]', $path, $storemethod);
	$path = str_replace('[y]', $year, $path);
	$path = str_replace('[m]', $month, $path);
	$path = str_replace('[d]', $day, $path);
	$path = str_replace('[id]', $id, $path);
	if(empty($filename)) {
		$filename = "{$id}{$setting_htmlexpand}";
	} else {
		if(preg_match('/^\//i', $filename)) {
			return substr($filename, 1);
		}
	}
	$path = str_replace('[f]', $filename, $path);
	return $path;
}

function htmlname($id, $category = 0, $dateline = 0, $filename = '') {
	$html = core_htmlname($id, $category, $dateline, $filename);
	return $html;
}

function itemurl($id, $category = 0, $dateline = 0, $filename = '') {
//本方法获得文章的URL
	global $homepage;
	return $homepage.core_htmlname($id, $category, $dateline, $filename);
}
function aexit($text = '') {
	global $db;
	if(isset($db)) $db->close();
	exit(''.$text);
}
function renderkeywords($text, $keywords) {
	global $setting_keywordslink, $setting_globalkeywordstemplate;
	$replace = array();
	$to = array();
	if(!empty($setting_globalkeywordstemplate)) {
		$globalkeywords = getkeywordscache();
		foreach($globalkeywords as $_k) {
			$replace[] = $_k[0];
			$_to = str_replace('[url]', $_k[1], $setting_globalkeywordstemplate);
			$_to = str_replace('[keyword]', $_k[0], $_to);
			$_to = str_replace('[digest]', $_k[2], $_to);
			$to[] = $_to;
		}
	}
	if(!empty($setting_keywordslink)) {
		if($keywords != '') {
			$keywords = tidyitemlist($keywords, ',', 0);
			$keywords = explode(',', $keywords);
			$keywords = sortbylength($keywords);
		} else {
			$keywords = array();
		}
		foreach($keywords as $keyword) {
			$keyword = trim($keyword);
			if(empty($keyword)) continue;
			if(in_array($keyword, $replace)) continue;
			$_to = ak_replace('[keywordinurl]', urlencode($keyword), $setting_keywordslink);
			$_to = ak_replace('[keyword]', $keyword, $_to);
			$replace[] = $keyword;
			$to[] = $_to;
		}
	}
	foreach($replace as $_k => $_v) {
		$text = replacekeyword($text, $_v, $to[$_k], 1, 1);
	}
	return $text;
}

function refreshcommentnum($id, $refreshtime = 0) {
	global $db, $thetime;
	$commentnum = $db->get_by('COUNT(*) as c', 'comments', "itemid='$id'");
	$value = array('commentnum' => $commentnum);
	if($refreshtime) $value['lastcomment'] = $thetime;
	$db->update('items', $value, "id='$id'");
}

function getidbyfilename($filename) {
	global $db;
	$id = $db->get_by('id', 'filenames', "filename='$filename'");
	return $id;
}

function updateitemscore($id) {
	global $db;
	$result = $db->get_by('AVG(score) as a,SUM(score) as s, COUNT(*) as c', 'scores', "itemid=$id");
	if(empty($result['s'])) $result['s'] = 0;
	if(empty($result['a'])) $result['a'] = 0;
	$value = array(
		'totalscore' => $result['s'],
		'scorenum' => $result['c'],
		'avgscore' => $result['a']
	);
	$db->update('items', $value, "id=$id");
}

function encodeip($ip) {
	$d = explode('.', $ip);
	if(!isset($d[3])) return 'wrong ip';
	$d[3] = '*';
	return implode('.', $d);
}

function cloudkeywords($title, $content) {
	$cloudurl = 'http://service.akcms.com/cal_keywords.php';
	$result = post_request($cloudurl, array('title' => $title, 'content' => $content));
	return unserialize($result['result']);
}

function changeuserpassword($uid, $password) {
	global $db;
	$db->update('users', array('password' => ak_md5($password, 1, 2)), "id='$uid'");
}

function deleteuser($uid) {
	global $db;
	$db->delete('users', "id='$uid'");
}

function pickpicture($html, $baseurl = '') {
	preg_match_all("/<img(.*?)src=(.+?)['\" >]+/is", $html, $match);
	$pics = array();
	foreach($match[2] as $pic) {
		$pic = str_replace('"', '', $pic);
		$pic = str_replace('\'', '', $pic);
		if(!empty($pic)) break;
	}
	return calrealurl($pic, $baseurl);
}

function copypicturetolocal($html, $config, $task = 0) {
	global $homepage;
	$category = $config['category'];
	preg_match_all("/<img(.*?)src=(.+?)['\" >]+/is", $html, $match);
	$pics = array();
	foreach($match[2] as $pic) {
		$pic = str_replace('"', '', $pic);
		$pic = str_replace('\'', '', $pic);
		$pics[] = $pic;
	}
	$pics = array_unique($pics);
	foreach($pics as $pic) {
		$picname = get_upload_filename($pic, 0, $category, 'image');
		$pictureurl = calrealurl($pic, $config['itemurl']);
		if(!empty($task)) {
			require_once(AK_ROOT.'include/task.file.func.php');
			addtask('spiderpicture', $pictureurl."\t".FORE_ROOT.$picname);
		} else {
			$picturedata = readfromurl($pictureurl);
			writetofile($picturedata, FORE_ROOT.$picname);
			require_once(AK_ROOT.'include/image.func.php');
			operateuploadpicture(FORE_ROOT.$picname, $category);
		}
		$html = str_replace($pic, $homepage.$picname, $html);
	}
	return $html;
}

function calrealurl($target, $baseurl = '') {
	if(strpos($target, '://') !== false) return $target;
	if(substr($target, 0, 1) == '/') {
		$domain = getdomain($baseurl);
		return 'http://'.$domain.'/'.substr($target, 1);
	} else {
		$urlpath = geturlpath($baseurl);
		return $urlpath.$target;
	}
}

function calspiderpicturename($picture) {
	global $thetime, $setting_imagemethod;
	$return = str_replace('[id]', '0', $setting_imagemethod);
	$return = str_replace('[y]', date('Y', $thetime), $return);
	$return = str_replace('[m]', date('m', $thetime), $return);
	$return = str_replace('[d]', date('d', $thetime), $return);
	$filename = random(6).'.'.fileext($picture);
	$return = str_replace('[f]', $filename, $return);
	return $return;
}

function get_upload_filename($filename, $id, $category, $type = 'attach') {
	global $setting_attachmethod, $setting_imagemethod, $setting_previewmethod, $setting_attachthumbmethod, $thetime;
	if($type == 'attach') {
		$return = $setting_attachmethod;
	} elseif($type == 'image') {
		$return = $setting_imagemethod;
	} elseif($type == 'preview') {
		$return = $setting_previewmethod;
	} elseif($type == 'thumb') {
		$return = $setting_attachthumbmethod;
	}
	list($y, $m, $d) = explode('-', date('Y-m-d', $thetime));
	$categorypath = $path = get_category_path($category);
	if($type != 'thumb') {
		$filename = random(6).'.'.fileext($filename);
	} else {
		$filename = basename($filename);
	}
	$return = str_replace('[y]', $y, $return);
	$return = str_replace('[m]', $m, $return);
	$return = str_replace('[d]', $d, $return);
	$return = str_replace('[f]', $filename, $return);
	$return = str_replace('[id]', $id, $return);
	$return = str_replace('[categorypath]', $categorypath, $return);
	return $return;
}
?>