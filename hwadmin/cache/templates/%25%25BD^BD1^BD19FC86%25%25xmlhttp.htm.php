<?php /* Smarty version 2.6.13, created on 2011-10-22 15:30:57
         compiled from xmlhttp.htm */ ?>
<script language="javascript" type="text/javascript">
var xmlhttp = function() {
	var xmlObj = null;
	if(window.XMLHttpRequest) {
		xmlObj = new XMLHttpRequest();
	} else if(window.ActiveXObject){
		xmlObj = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		return;
	}
	return xmlObj;
}
function iposts(purl, data2, callback) {
	var nxmlhttp = new xmlhttp();
	nxmlhttp.onreadystatechange = function() {
		if (nxmlhttp.readyState == 4) {
			if(nxmlhttp.status == 200 || nxmlhttp.status == 304) {
				callback(nxmlhttp.responseText);
			} else {
				callback("$error$");
			}
		}
	}
	
	nxmlhttp.open("post", purl, true);
	nxmlhttp.setRequestHeader("Content-Length", data2.length);
	nxmlhttp.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
	nxmlhttp.send(data2);
}
function igets(gurl, callback) {
	var nxmlhttp = new xmlhttp();
	nxmlhttp.onreadystatechange = function() {
		if (nxmlhttp.readyState == 4) {
			if(nxmlhttp.status == 200 || nxmlhttp.status == 304) {
				callback(nxmlhttp.responseText);
			} else {
				callback("$error$");
			}
		}
	}
	
	nxmlhttp.open("get", gurl, true);
	nxmlhttp.setRequestHeader("Content-Length", 0);
	nxmlhttp.send("");
}
</script>