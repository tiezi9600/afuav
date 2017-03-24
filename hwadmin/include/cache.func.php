<?php
if(empty($cachetype)) $cachetype = 'file';
require_once(AK_ROOT.'include/cache.'.$cachetype.'.func.php');
function updatecache($cachename = '', $designate = array()) {
	global $db, $tablepre, $settings;
	if(empty($cachename) || $cachename == 'settings') {
		$return = array();
		$sql = "SELECT * FROM {$tablepre}_settings";
		$query = $db->query($sql);
		while($var = $db->fetch_array($query)) {
			$return[$var['variable']] = $var['value'];
		}
		global $settings;
		$settings = $return;
		setcache('settings', $return);
	}
	if(empty($cachename) || substr($cachename, 0, 8) == 'category') {
		$return = array();
		if(empty($cachename) || strlen($cachename) == 8) {
			$query = $db->query_by('categoryup,id', 'categories', '1', 'categoryup DESC');
			$subcategories = array();
			while($category = $db->fetch_array($query)) {
				if($category['categoryup'] != 0) $subcategories[$category['categoryup']][] = $category['id'];
			}
			$query = $db->query_by('*', 'categories', '1', 'categoryup DESC');
			while($category = $db->fetch_array($query)) {
				$id = $category['id'];
				$category['subcategories'] = array();
				if(!empty($subcategories[$id])) {
					$category['subcategories'] = $subcategories[$id];
					unset($subcategories[$id]);
				}
				$extvalaue = updatecategoryextvalue($id);
				$category = array_merge($category, $extvalaue);
				setcache('category-'.$id, $category);
			}
			unset($subcategories);
			$query = $db->query_by('id', 'categories', '1', 'categoryup,id');
			while($category = $db->fetch_array($query)) {
				$id = $category['id'];
				$category = getcategorycache($id);
				$extvalaue = updatecategoryextvalue($id, $category);
				$db->queries = array();
				$category = array_merge($category, $extvalaue);
				setcache('category-'.$id, $category);
			}
		} else {
			$id = substr($cachename, 8);
			if(!a_is_int($id)) return false;
			if(!$category = $db->get_by('*', 'categories', "id='$id'")) return false;
			$query = $db->query_by('id', 'categories', "categoryup='$id'");
			while($subcategory = $db->fetch_array($query)) {
				$category['subcategories'][] = $subcategory['id'];
			}
			$extvalaue = updatecategoryextvalue($id);
			$category = array_merge($category, $extvalaue);
			setcache('category-'.$id, $category);
		}
		unset($return, $extvalaue, $category, $subcategory);
		if($cachename != '') updatecache('categoriesselect');
		deletecache('categorytree');
	}
	if(empty($cachename) || $cachename == 'categoriesselect') {
		$select = rendercategoryselect();
		setcache('categoriesselect', $select);
	}
	if(empty($cachename) || $cachename == 'sections') {
		$return = array();
		$sql = "SELECT * FROM {$tablepre}_sections";
		$query = $db->query($sql);
		while($var = $db->fetch_array($query)) {
			$return[$var['id']] = $var;
		}
		setcache('sections', $return);
	}
	if(empty($cachename) || $cachename == 'templates') {
		global $template_path;
		$return = array();
		$dir = AK_ROOT.'configs/templates/'.$template_path.'/';
		$dh  = opendir($dir);
		while (false !== ($filename = readdir($dh))) {
			if($filename != '.' && $filename != '..' && substr($filename, 0, 1) == ',') {
				$return[] = substr($filename, 1);
			}
		}
		sort($return);
		setcache('templates', $return);
	}
	if(empty($cachename) || $cachename == 'globalvariables') {
		$return = array();
		$sql = "SELECT * FROM {$tablepre}_variables ORDER BY variable";
		$query = $db->query($sql);
		while($var = $db->fetch_array($query)) {
			$return[$var['variable']] = $var['value'];
		}
		setcache('globalvariables', $return);
	}
	if((empty($cachename) || $cachename == 'infos')) {
		$return = array();
		$items = $db->get_by('COUNT(*)', 'items', 'category>0');
		$pvs1 = $db->get_by('SUM(pageview)', 'items');
		$pvs2 = $db->get_by('SUM(pv)', 'categories');
		$editors = $db->get_field("SELECT COUNT(*) FROM {$tablepre}_admins WHERE freeze=0");
		$attachmentsizes = $db->get_field("SELECT SUM(filesize) FROM {$tablepre}_attachments");
		$attachments = $db->get_field("SELECT COUNT(*) FROM {$tablepre}_attachments");
		$return = array(
			'items' => $items,
			'pvs' => $pvs1 + $pvs2,
			'editors' => $editors,
			'attachmentsizes' => $attachmentsizes,
			'attachments' => $attachments
		);
		setcache('infos', $return);
	}
	if(empty($cachename) || $cachename == 'plugins') {
		$paths = readpathtoarray(AK_ROOT.'/plugins');
		$return = array();
		foreach($paths as $path) {
			if(is_dir($path)) continue;
			if(!is_readable($path)) continue;
			if(fileext($path) == 'php') $return[] = calfilenamefromurl($path);
		}
		setcache('plugins', $return);
	}
	if(empty($cachename) || $cachename == 'modules') {
		$query = $db->query_by('*', 'modules', '1', 'id');
		$return = array();
		while($module = $db->fetch_array($query)) {
			$module['data'] = ak_unserialize($module['data']);
			$return[$module['id']] = $module;
		}
		$_query = $db->query_by('id,category,module', 'categories');
		while($_category = $db->fetch_array($_query)) {
			$moduleid = $_category['module'];
			if($moduleid <= 0) $moduleid = 1;
			if(!isset($return[$moduleid])) continue;
			if(!isset($return[$moduleid]['categories'])) $return[$moduleid]['categories'] = array();
			$return[$moduleid]['categories'][$_category['id']] = $_category['category'];
		}
		setcache('modules', $return);
	}
	if(empty($cachename) || $cachename == 'ses') {
		$query = $db->query_by('*', 'ses', '1', 'id');
		$return = array();
		while($se = $db->fetch_array($query)) {
			$se['data'] = ak_unserialize($se['value']);
			$return[$se['id']] = $se;
		}
		setcache('ses', $return);
	}
	if(empty($cachename) || $cachename == 'spiders') {
		$query = $db->query_by('*', 'spider_contentrules', '1', 'id');
		while($rule = $db->fetch_array($query)) {
			$value = ak_unserialize($rule['value']);
			$value['id'] = $rule['id'];
			setcache('spidercontentrule'.$rule['id'], $value);
		}
		$query = $db->query_by('*', 'spider_listrules', '1', 'id');
		while($rule = $db->fetch_array($query)) {
			$value = ak_unserialize($rule['value']);
			$value['id'] = $rule['id'];
			setcache('spiderlistrule'.$rule['id'], $value);
		}
	}
}

function getcategorycache($id) {
	return getcache('category-'.$id);
}
?>