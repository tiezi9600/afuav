<?php /* Smarty version 2.6.13, created on 2011-12-21 06:56:10
         compiled from %2Csitemap.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getitems', ',sitemap.htm', 8, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
-<?php echo $this->_tpl_vars['v_siteName']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php echo getitems(array('category' => "1,2",'includesubcategory' => '1','num' => '100','orderby' => 'id_reverse','template' => "<a href=()[url]()>[title]</a><br/>"), $this);?>

</body>
</html>