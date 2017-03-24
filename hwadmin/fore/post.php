<?php
require_once $mypath.$system_root.'/include/common.inc.php';
require_once AK_ROOT.'include/global.func.php';
isset($title) || $title = empty($post_title) ? '' : $post_title;
isset($content) || $content = empty($post_content) ? '' : $post_content;
isset($digest) || $digest = empty($post_digest) ? '' : $post_digest;
isset($category) || $category = empty($post_category) ? '' : $post_category;
isset($author) || $author = empty($post_author) ? '' : $post_author;
isset($keywords) || $keywords = empty($post_keywords) ? '' : $post_keywords;
isset($aimurl) || $aimurl = empty($post_aimurl) ? '' : $post_aimurl;
if(trim($title) == '') exit('1');
if(empty($category)) exit('2');
if(empty($allowcategories) && empty($denycategories)) exit('3');
if(!empty($allowcategories) && !in_array($category, $allowcategories)) exit('4');
if(!empty($denycategories) && in_array($category, $denycategories)) exit('4');
require_once AK_ROOT.'include/fore.inc.php';
if(empty($nocaptcha)) verifycaptcha();
$value = array(
	'title' => $title,
	'digest' => $digest,
	'category' => $category,
	'dateline' => $thetime,
	'author' => $author,
	'keywords' => $keywords,
	'aimurl' => $aimurl
);
$db->insert('items', $value);
$id = $db->insert_id();
$value = array(
	'itemid' => $id,
	'text' => nl2br($content)
);
$db->insert('texts', $value);
aexit('0');
?>