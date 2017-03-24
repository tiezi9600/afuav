<?php
include '../include/common.inc.php';
include AK_ROOT.'include/global.func.php';
include AK_ROOT.'include/admin.inc.php';
$html = 1;
if(empty($setting_ifhtml)) $html = 0;
$htmlcategories = array(0);
$query = $db->query_by('id,category,html', 'categories');
while($category = $db->fetch_array($query)) {
	if($category['html'] + $html > 0) $htmlcategories[] = $category['id'];
}
$where = 'category IN ('.implode(',', $htmlcategories).')';
$_sql = "SELECT COUNT(*) FROM {$tablepre}_items WHERE {$where}";
$count = $db->get_field($_sql);
$_query = $db->query_by('*', 'items', $where, 'id');
$i = 1;
$ids = array();
while($item = $db->fetch_array($_query)) {
	$percent = number_format($i * 100 / $count, 2, '.', '');
	$ids[] = $item['id'];
	if(count($ids) > 20) {
		batchhtml($ids);
		$ids = array();
	}
	$cache_memory = array();
	debug("$percent%\t".$item['id']."\t".$item['title']." [ OK ]");
	$i ++;
/*
	if($i == 10) {
		$arr = get_defined_vars();
		debug($arr);exit;
	}
*/
}
debug("All article html created.");
?>
