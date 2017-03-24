<?php
require_once './include/common.inc.php';
require_once './include/admin.inc.php';
require_once './include/image.func.php';
if(empty($xheditor)) {
	$filename = $file_uploadfile['name'];	
	if(!ispicture($filename)) debug($lan['pictureexterror'], 1, 1);
	$newfilename = get_upload_filename($filename, 0, 0, 'image');
	uploadfile($file_uploadfile['tmp_name'], FORE_ROOT.$newfilename);
	$modules = getcache('modules');
	eventlog('#'.akgetcookie('lastmoduleid'));
	operateuploadpicture(FORE_ROOT.$newfilename, $modules[akgetcookie('lastmoduleid')]);
	$picurl = $homepage.$newfilename;
?>
<script>
parent.document.getElementById("txtUrl").value = "<?php echo $picurl;?>";
parent.document.getElementById("preview").src = "<?php echo $picurl;?>";
</script>
<?php
} else {
	$filename = $file_filedata['name'];
	if(!ispicture($filename)) debug($lan['pictureexterror'], 1, 1);
	$newfilename = get_upload_filename($filename, 0, 0, 'image');
	uploadfile($file_filedata['tmp_name'], FORE_ROOT.$newfilename);
	$modules = getcache('modules');
	eventlog('#'.akgetcookie('lastmoduleid'));
	operateuploadpicture(FORE_ROOT.$newfilename, $modules[akgetcookie('lastmoduleid')]);
	$picurl = $homepage.$newfilename;
	$msg = "{'url':'".$picurl."','localname':'".$newfilename."','id':'1'}";
	exit("{'err':'','msg':".$msg."}");
}
?>