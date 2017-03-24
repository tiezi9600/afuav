<?php
require_once './include/common.inc.php';
require_once('install/install.sql.php');
if(substr_count($_SERVER['SCRIPT_NAME'], '/') < 2) exit('<a href="http://www.akcms.com/manual/197.htm" target="_blank">please move akcms to a folder before install it.</a>');
if(ifinstalled()) exit('<a href="http://www.akcms.com/manual/198.htm" target="_blank">akcms installed!<br>if you want to reinstall it please remove /configs/install.lock first!<br><b style="color:red">Notice:reinstall will destory all data!</b></a>');
$language = 'english';
if(!empty($get_language)) $language = $get_language;
if(!empty($post_language)) $language = $post_language;
$nodb = 1;
require_once AK_ROOT.'include/admin.inc.php';
if(!empty($post_charset)) $charset = $post_charset;
$array_files = array(
	'..',
	'cache',
	'templates',
	'cache/templates',
	'configs',
	'logs'
);
$message = '';
foreach($array_files as $file) {
	if(!is_writable($file)) $message .= '"'.$file.'"'.$lan['isunwritable'].'<br>';
}
if(!empty($message)) aexit('<a href="http://www.akcms.com/manual/196.htm" target="_blank">'.$message.'</a>');
if(isset($post_installsubmit)) {
	if(!preg_match('/^[0-9a-zA-Z]+$/i', $post_tablepre_)) adminmsg($lan['tablepreerror'], 'back', 3, 1);
	createconfig();
	require(AK_ROOT.'configs/config.inc.php');
	$db = db();
	if(strpos($post_dbtype_, 'mysql') !== false) {
		if(!empty($db->error) && strpos($db->error, 'Access denied for user') !== false) adminmsg($lan['dbpwerror'], 'back', 3, 1);
		$query = $db->query("SHOW DATABASES;");
		while($d = $db->fetch_array($query)) {
			if($d['Database'] == $post_dbname_) {
				$dbexists = 1;
				break;
			}
		}
		if(empty($dbexists)) {
			$createdatabasesql = 'CREATE DATABASE `'.$post_dbname_.'`';
			if($db->version > '4.1') {
				if($post_charset_ == 'utf8') {
					$mysql_charset = ' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci';
				} elseif($post_charset_ == 'gbk') {
					$mysql_charset = ' DEFAULT CHARACTER SET gbk COLLATE gbk_chinese_ci';
				} elseif($post_charset_ == 'english') {
					$mysql_charset = ' DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci';
				}
				$createdatabasesql = $createdatabasesql.$mysql_charset;
			}
			$db->query($createdatabasesql);
			$dbexists = 1;
			$db->close();
		}
		$db = db(array(), 1);
		foreach($createtablesql as $key => $value) {
			$value['charset'] = $post_charset_;
			$createtablesql = table2mysql($tablepre.'_'.$key, $value);
			$_sqls = explode(";\n", $createtablesql);
			foreach($_sqls as $_sql) {
				$db->query($_sql);
			}
		}
	} elseif(strpos($post_dbtype_, 'sqlite') !== false) {
		foreach($createtablesql as $key => $value) {
			$value['charset'] = $post_charset_;
			$createtablesql = table2sqlite($tablepre.'_'.$key, $value);
			$db->query($createtablesql);
		}
	}
	foreach($insertsql as $key => $value) {
		$tablename = str_replace('ak_', $tablepre.'_', $value['tablename']);
		if($value['tablename'] == 'settings' && $value['value']['variable'] == 'language') $value['value']['value'] = $language;
		$db->insert($tablename, $value['value']);
	}
	setinstalled();
	adminmsg($lan['installsuccess'], 'login.php?first=1');
} elseif(!isset($_GET['language'])) {
	displaytemplate('chooselanguage.htm');
} elseif(!isset($_GET['dbtype'])) {
	if(isset($_GET['agree'])) {
		$drivers = array();
		if(function_exists('mysql_connect')) $drivers['mysql'] = 'MySQL';
		if(function_exists('sqlite_open')) $drivers['sqlite'] = 'SQLite'.substr(sqlite_libversion(), 0, 1);
		if(function_exists('pdo_drivers')) {
			$pdodrivers = pdo_drivers();
			foreach($pdodrivers as $d) {
				$drivers['pdo:'.$d] = 'pdo:'.$d;
			}
		}
		$smarty->assign('drivers', $drivers);
		displaytemplate('choosedb.htm');
	} else {
		$language = $get_language;
		displaytemplate('license.htm');
	}
} else {
	$smarty->assign('servertime', date('Y-m-d H:i:s', time()));
	$smarty->assign('timedifference', $timedifference);
	if($language == 'chinese') {
		$languagecharset = array(
			'key' => 'gbk',
			'value' => 'GBK'
		);
	} elseif($language == 'english') {
		$languagecharset = array(
			'key' => 'english',
			'value' => 'English'
		);
	}
	if(file_exists("configs/config.inc.php")) {
		include("configs/config.inc.php");
		$smarty->assign('charset', $charset);
	}
	$smarty->assign('languagecharset', $languagecharset);
	if(strpos($get_dbtype, 'mysql') !== false) {
		displaytemplate('install_mysql.htm');
	} else {
		$dbname = 'data/'.random(6).'.db.php';
		$smarty->assign('dbname', $dbname);
		displaytemplate('install_sqlite.htm');
	}
}
runinfo();
aexit();

function createconfig() {
	$str_config = '';
	$array_config = array('dbtype', 'dbhost', 'dbuser', 'dbpw', 'dbname', 'tablepre', 'charset', 'timedifference');
	foreach($array_config as $config) {
		$c = $config.'_';
		if(isset($_POST[$c])) $str_config .= '$'.$config.' = "'.$_POST[$c]."\";\n";
	}
	$str_config .= "\$ifdebug = 0;\n\$template_path = 'ak';\n\$codekey = '".random(6)."';\n\$cookiepre = 'akcms';\n";
	$str_config = "<?php\n".$str_config."?>";
	writetofile($str_config, 'configs/config.inc.php');
}
?>