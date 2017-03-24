<?php
require_once(AK_ROOT.'include/db.class.php');
class pdomysqlstuff extends dbstuff{
	var $querynum = 0;
	var $queries = array();
	var $version = '';
	var $dbname;
	var $db;
	function pdomysqlstuff($config = array()) {
		global $currenturl, $dbexists;
		$dsn = "mysql:host={$config['dbhost']}";
		if(strpos($currenturl, '/install.php') === false || isset($dbexists)) $dsn .= ";dbname={$config['dbname']}";
		try {
			$this->db = new PDO($dsn, $config['dbuser'], $config['dbpw']);
		} catch (Exception $e) {
			$this->error = $e->getMessage();
			return;
		}
		$this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
		$this->version = $this->version();
		$this->dbname = $config['dbname'];
		if($this->version > '4.1') $this->db->query("SET NAMES '{$config['charset']}'");
		if($this->version > '5.0') $this->db->query("SET sql_mode=''");
		$this->db->beginTransaction();
	}
	function _commit() {
		$this->db->commit();
	}
	function _fetch_array($query) {
		return $query->fetch(2);
	}
	function _query($sql) {
		$query = $this->db->query($sql);
		return $query;
	}
	function _close() {
		$this->db = null;
	}
	function version() {
		return $this->db->getAttribute(4);
	}
	function error() {
		$error = $this->db->errorInfo();
		return $error[2];
	}
	function addslashes($string) {
		return mysql_addslashes($string);
	}
	function insert_id() {
		return $this->db->lastInsertId();
	}
}
?>