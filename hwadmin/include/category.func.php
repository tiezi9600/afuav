<?php
function get_category_data($id, $template = 'default') {
	global $db, $lan, $thetime, $setting_ifhtml;
	$variables = array();
	$variables['_pagetype'] = 'category';
	if(!a_is_int($id)) return false;
	$variables['_pageid'] = $id;
	$categorycache = getcategorycache($id);
	if(!$category = $db->get_by('*', 'categories', "id='{$id}'")) return array();
	$variables['defaulttemplate'] = $categorycache['defaulttemplate'];
	$variables['template'] = $categorycache['defaulttemplate'];
	$variables['listtemplate'] = $categorycache['listtemplate'];
	if(!empty($categorycache['subcategories'])) {
		$variables['subcategories'] = $categorycache['subcategories'];
	} else {
		$variables['subcategories'] = array();
	}
	$variables['category'] = $category['id'];
	$variables['alias'] = $category['alias'];
	$variables['categoryname'] = $category['category'];
	$variables['path'] = $category['path'];
	$variables['categoryup'] = $category['categoryup'];
	$variables['orderby'] = $category['orderby'];
	$variables['keywords'] = $category['keywords'];
	$variables['description'] = $category['description'];
	$variables['items'] = $category['items'];
	$variables['allitems'] = $category['allitems'];
	$variables['pv'] = $category['pv'];
	if($category['html'] == 0) {
		$variables['html'] = $setting_ifhtml;
	} else {
		$variables['html'] = $category['html'];
	}
	$variables['storemethod'] = $category['storemethod'];
	$total = $db->get_by('COUNT(*) as c', 'items', "category='$id'");
	$variables['total'] = $total['c'];
	$path = $categorycache['fullpath'];
	$_homemethod = FORE_ROOT.$categorycache['categoryhomemethod'];
	$_homemethod = str_replace('[categorypath]', $path, $_homemethod);
	$variables['htmlfilename'] = $_homemethod;
	$variables['url'] = getcategoryurl($id);
	$variables['pagetemplate'] = $categorycache['itemtemplate'];
	$variables['categoryhomemethod'] = $categorycache['categoryhomemethod'];
	$variables['categorypagemethod'] = $categorycache['categorypagemethod'];
	return $variables;
}

function batchcategoryhtml($ids) {
	if(!is_array($ids)) $ids = array($ids);
	foreach($ids as $id) {
		$variables = get_category_data($id);
		$GLOBALS['index_work'] = "category\n".$id."\n".$variables['htmlfilename'];
		render_template($variables, '', 1);
	}
}

function operatecreatecategoryprocess() {
	require_once(AK_ROOT.'include/task.file.func.php');
	unset($GLOBALS['index_work']);
	$tasks = gettask('indextask', 50);
	if(empty($tasks)) return true;
	foreach($tasks as $task) {
		list($type, $id, $filename, $page) = explode("\n", $task);
		if($type != 'category') continue;
		$variables = get_category_data($id);
		if($page > 1) $variables['template'] = $variables['listtemplate'];
		$variables['page'] = $page;
		$variables['htmlfilename'] = $filename;
		render_template($variables, '', 1);
	}
}

function get_category_homemethod($id) {
	global $setting_categoryhomemethod;
	$categorycache = getcategorycache($id);
	$categoryhomemethod = $categorycache['categoryhomemethod'];
	if($categoryhomemethod == '') $categoryhomemethod = $setting_categoryhomemethod;
	return $categoryhomemethod;
}
function get_category_path($id) {//这和下面这两个鸟函数的区别是什么？
	if($id == 0) return '';
	$categorycache = getcategorycache($id);
	$path = $categorycache['fullpath'];
	return substr($path, 1);
}

function getcategoryurl($id) {//本方法返回分类的url访问位置
	global $homepage;
	if($id == 0) return '';
	$categorycache = getcategorycache($id);
	$url = $categorycache['categoryhomemethod'];
	$url = str_replace('[id]', $id, $url);
	if(strpos($url, '[categorypath]') !== false) {
		$url = str_replace('[categorypath]', $categorycache['fullpath'], $url);
	}
	if(substr($url, 0, 7) != 'http://') $url = $homepage.$url;
	return $url;
}

function includesubcategories($stringcategories) {
	$stringcategories = tidyitemlist($stringcategories, ',', 0);
	$outputcategories = explode(',',$stringcategories);
	$outputcategories = array_unique($outputcategories);
	for($i = 0; $i < count($outputcategories); $i ++) {
		$id = $outputcategories[$i];
		$categorycache = getcategorycache($id);
		if(!empty($categorycache['subcategories'])) {
			$outputcategories = array_merge($outputcategories, $categorycache['subcategories']);
		}
	}
	return implode(',', $outputcategories);
}

function getidbyfullpath($path) {
	$paths = explode('/', $path);
	$paths = array_reverse($paths);
	foreach($paths as $path) {
		$where = "path='$path'";
		if(a_is_int($path)) $where = "(id='$path' AND path='') OR ";
		$query = $db->query_by('id,path,category,categoryup', 'categories', $where);
	}
}

function rendercategorytree() {
	global $db, $lan;
	$cachekey = 'categorytree';
	if($tree = getcache($cachekey)) return $tree;
	$branches = array();
	$query = $db->query_by('id,category,categoryup,items', 'categories', '1', 'categoryup DESC,id');
	while($category = $db->fetch_array($query)) {
		$id = $category['id'];
		$subcategories[$category['categoryup']][] = $id;
		$categories[$id] = $category;
	}
	foreach($categories as $category) {
		$id = $category['id'];
		if(!empty($subcategories[$id])) $category['subcategories'] = $subcategories[$id];
		$branches[$id] = rendercategorybranch($category);
	}
	foreach($categories as $category) {
		$id = $category['id'];
		if(!empty($subcategories[$id])) {
			$branches[$id] .= "<div id='c{$id}'>";
			foreach($subcategories[$id] as $sub) {
				if(substr($branches[$sub], 0, 16) != "<div class='ci'>") $branches[$sub] = "<div class='ci'>".$branches[$sub].'</div>';
				$branches[$sub] = str_replace("\n", "\n\r", $branches[$sub]);
				$branches[$id] .= $branches[$sub];
				unset($branches[$sub]);
			}
			$branches[$id] .= "</div>";
			unset($subcategories[$id]);
		}
		if(isset($branches[$id])) $branches[$id] = "<div class='ci'>".$branches[$id].'</div>';
	}
	unset($category, $id, $subcategories);
	$tree = "<div class='treeroot'></div>{$lan['allcategory']}[<a href='admincp.php?action=newcategory&parent=0'>{$lan['addsubcategory']}</a>]";
	$keys = array_keys($branches);
	foreach($keys as $key) {
		$tree .= $branches[$key];
		$branches[$key] = null;
		unset($branches[$key]);
	}
	$tree = str_replace("\n", '<br />', $tree);
	unset($branches, $key, $keys);
	if(strlen($tree) > 102400) setcache($cachekey, $tree);
	return $tree;
}

function rendercategorybranch($category) {
	global $lan;
	$id = $category['id'];
	if(!empty($category['subcategories'])) {
		$branch = "<div id='f$id' class='f2'></div><div class='i'><a href='javascript:i($id)' class='w9'></a></div><span class='w20'></span>";
	} else {
		$branch = "<div class='f'></div>";
	}
	$branch .= "{$id}. <a href='?action=editcategory&id={$id}'>{$category['category']}</a> [<a href='?action=newcategory&parent={$id}'>+{$lan['subcategory']}</a>] [<a href='?action=newitem&category={$id}'>+{$lan['item']}</a>] [<a href='?action=items&category={$id}'>{$lan['item']}</a>] [<a href='javascript:d({$id})'>{$lan['del']}</a>]";
	if($category['items'] > 0) $branch .= " ({$category['items']})";
	return $branch;
}

function rendercategoryselect($id = 0, $layer = 0) {
	global $db, $categories;
	if(!empty($GLOBALS['nocategoryselect'])) return '';
	$cachekey = 'categoryselect';
	if($id == 0 && $categoryselect = getcache($cachekey)) return $categoryselect;
	$_tree = '';
	$_sub = '';
	static $categories;
	if(empty($categories)) {
		$query = $db->query_by('id,category,categoryup,items', 'categories', '', 'categoryup,id');
		while($category = $db->fetch_array($query)) {
			$categories[$category['id']] = $category;
			$categories[$category['categoryup']]['subcategories'][] = $category['id'];
		}
	}
	if(!empty($categories[$id]['subcategories']) && is_array($categories[$id]['subcategories'])) {
		foreach($categories[$id]['subcategories'] as $category) {
			$_sub .= rendercategoryselect($category, $layer + 1);
		}
	}
	if($id > 0) {
		$_tree .= "<option value=\"$id\">".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $layer).htmlspecialchars($categories[$id]['category'])."</option>\n".$_sub;
	} else {
		$_tree .= $_sub;
	}
	if($id == 0) setcache($cachekey, $_tree);
	return $_tree;
}

function ifhassubcategories($id) {
	$categorycache = getcategorycache($id);
	if(empty($categorycache['subcategories'])) return false;
}

function updatecategoryextvalue($id, $category = array()) {//更新指定分类的扩展属性，扩展属性都是根据主属性计算出来的缓存属性
	//1 计算多级分类完整路径（信任老爹的缓存）
	//2 分析首页、分页、正文页的存储方式
	//3 分析首页、分页、正文页的模板
	//4 是否生成静态页
	global $db, $thetime, $settings;
	$fullpath = '';
	if(empty($category)) $category = $db->get_by('categoryup,path,html,storemethod,categoryhomemethod,categorypagemethod,defaulttemplate,listtemplate,itemtemplate,value', 'categories', "id='$id'");
	$extvalue = @unserialize($category['value']);
	if(empty($extvalue)) $extvalue = array();
	if(!empty($category['storemethod'])) $extvalue['storemethod'] = $category['storemethod'];
	if(!empty($category['categoryhomemethod'])) $extvalue['categoryhomemethod'] = $category['categoryhomemethod'];
	if(!empty($category['categorypagemethod'])) $extvalue['categorypagemethod'] = $category['categorypagemethod'];
	if(!empty($category['defaulttemplate'])) $extvalue['defaulttemplate'] = $category['defaulttemplate'];
	if(!empty($category['listtemplate'])) $extvalue['listtemplate'] = $category['listtemplate'];
	if(!empty($category['itemtemplate'])) $extvalue['itemtemplate'] = $category['itemtemplate'];
	if($category['html'] != 0) $extvalue['html'] = $category['html'];
	if($category['categoryup'] > 0) {
		$categoryupcache = getcategorycache($category['categoryup']);
		if(!empty($categoryupcache['fullpath'])) $fullpath = $categoryupcache['fullpath'];
		if(empty($category['storemethod'])) $extvalue['storemethod'] = $categoryupcache['storemethod'];
		if(empty($category['categoryhomemethod'])) $extvalue['categoryhomemethod'] = $categoryupcache['categoryhomemethod'];
		if(empty($category['categorypagemethod'])) $extvalue['categorypagemethod'] = $categoryupcache['categorypagemethod'];
		if(empty($category['defaulttemplate'])) $extvalue['defaulttemplate'] = $categoryupcache['defaulttemplate'];
		if(empty($category['listtemplate'])) $extvalue['listtemplate'] = $categoryupcache['listtemplate'];
		if(empty($category['itemtemplate'])) $extvalue['itemtemplate'] = $categoryupcache['itemtemplate'];
		if(empty($category['html'])) $extvalue['html'] = $categoryupcache['html'];
	} else {
		if(empty($category['storemethod'])) $extvalue['storemethod'] = $settings['storemethod'];
		if(empty($category['categoryhomemethod'])) $extvalue['categoryhomemethod'] = $settings['categoryhomemethod'];
		if(empty($category['categorypagemethod'])) $extvalue['categorypagemethod'] = $settings['categorypagemethod'];
		if(empty($category['defaulttemplate'])) $extvalue['defaulttemplate'] = 'category_home.htm';
		if(empty($category['listtemplate'])) $extvalue['listtemplate'] = 'category_list.htm';
		if(empty($category['itemtemplate'])) $extvalue['itemtemplate'] = 'item_display.htm';
		if(empty($category['html'])) $extvalue['html'] = $settings['ifhtml'];
	}
	if($category['path'] != '') {
		$fullpath .= '/'.$category['path'];
	} else {
		$fullpath .= '/'.$id;
	}
	if(substr($fullpath, 0, 1) == '/') $fullpath = substr($fullpath, 1);
	$extvalue['fullpath'] = $fullpath;
	if($filename = $db->get_by('filename,id,htmlid', 'filenames', "id='$id' AND type='category'")) {
		$db->update('filenames', array('filename' => $fullpath, 'dateline' => $thetime), "id='$id' AND type='category'");
	} else {
		$db->insert('filenames', array('filename' => $fullpath, 'dateline' => $thetime, 'id' => $id, 'type' => 'category'));
	}
	$category = array();
	$category['value'] = serialize($extvalue);
	$db->update('categories', $category, "id='$id'");
	return $extvalue;
}

function attachcategoryextvalue($category) {//将扩展属性的值附到分类属性中
	if(!empty($category['value']) && $value = @unserialize($category['value'])) {
		unset($category['value']);
		$category = array_merge($category, $value);
	}
	return $category;
}
?>