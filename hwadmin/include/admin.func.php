<?php
function checkcreator() {
	global $lan, $admin_id;
	if(iscreator($admin_id) != 1) adminmsg($lan['forcreatoronly'], '', 0, 1);
}
function iscreator($id = '') {
	if($id == '') $id = $GLOBALS['admin_id'];
	if(strtolower($id) == 'admin') return 1;
	return 0;
}
function vc() {
	if(empty($_GET['vc']) || $GLOBALS['_vc'] != $_GET['vc']) aexit('error');
}
function go($url, $crumb = 1) {
	if($crumb) {
		$join = '&';
		if(strpos($url, '?') === false) $join = '?';
		header("location:{$url}{$join}crumb=".random(6));
	} else {
		header("location:{$url}");
	}
	aexit();
}

function adminmsg($message, $url_forward = '', $timeout = 1, $flag = 0) {
	global $smarty;
	if($flag == 0) {
		$flag = 'info';
	} else {
		$flag = 'warning';
	}
	if($url_forward == 'back') $url_forward = $_SERVER['HTTP_REFERER'];
	$smarty->assign('flag', $flag);
	$smarty->assign('message', $message);
	$smarty->assign('url_forward', $url_forward);
	$smarty->assign('timeout', $timeout);
	$smarty->assign('timeout_micro', $timeout * 1000);
	displaytemplate('message.htm');
	runinfo();
	aexit();
}

function get_select($type, $root = 0) {
	if($type == 'category') {
		return rendercategoryselect();
	} elseif($type == 'section') {
		global $sections;
		$selectsections = '';
		foreach($sections as $section) {
			$selectsections .= "<option value=\"$section[id]\">".htmlspecialchars($section['section'])."</option>\n";
		}
		return $selectsections;
	} elseif($type == 'modules') {
		global $modules;
		$modules = getcache('modules');
		$selectmodules = '';
		foreach($modules as $module) {
			$selectmodules .= "<option value=\"{$module['id']}\">".$module['modulename']."</option>\n";
		}
		return $selectmodules;
	}
}

function get_select_templates() {
	global $templates;
	$templates = getcache('templates');
	$selecttemplates = '';
	foreach($templates as $template) {
		$selecttemplates .= "<option value=\"$template\">".$template."</option>\n";
	}
	return $selecttemplates;
}

function multi($count, $perpage, $page, $url) {
	global $lan;
	$num = ceil($count / $perpage);//total page num
	$str_index = '<ul class="index">';
	$page > 4 ? $start = $page - 4 : $start = 1;
	$num - $page > 4 ? $end = $page + 4 : $end = $num;
	for($i = $start; $i <= $end; $i ++) {
		if($i == $page) {
			$str_index .= "<li class='page'><a href={$url}&page={$i}>{$i}</a></li>";
			continue;
		}
		$str_index .= "<li><a href={$url}&page={$i}>{$i}</a></li>";
	}
	$str_index .= '</ul><div style="clear:both;">'.$lan['total'].$count.'&nbsp;/&nbsp;'.$lan['pagenum'].$num.'&nbsp;<input type="text" size="3" name="page"></div>';
	return $str_index;
}

function inputshow($settings, $variable) {
	global $lan, $db;
	$output = '';
	$cs = array();
	$cs['ifhtml']['type'] = 'bin';
	$cs['ifhtml']['standby'] = '1,0';
	$cs['usefilename']['type'] = 'bin';
	$cs['usefilename']['standby'] = '1,0';
	$cs['commentneedcaptcha']['type'] = 'bin';
	$cs['commentneedcaptcha']['standby'] = '1,0';
	$cs['forbidstat']['type'] = 'bin';
	$cs['forbidstat']['standby'] = '0,1';
	$cs['ifuser']['type'] = 'bin';
	$cs['ifuser']['standby'] = '1,0';
	$cs['ifcomment']['type'] = 'bin';
	$cs['ifcomment']['standby'] = '1,0';
	$cs['ifguestcomment']['type'] = 'bin';
	$cs['ifguestcomment']['standby'] = '1,0';
	$cs['language']['type'] = 'select';
	$cs['language']['standby'] = 'chinese,english';
	$cs['attachimagequality']['type'] = 'select';
	$cs['attachimagequality']['standby'] = '10,20,30,40,50,60,70,80,90,100';
	$cs['attachwatermarkposition']['type'] = 'select';
	$cs['attachwatermarkposition']['standby'] = '-1,0,1,2,3,4,5,6,7,8,9';
	foreach($variable as $v) {
		if(!isset($settings[$v])) {
			list($value,) = explode(',', $cs[$v]['standby']);
			$db->insert('settings', array('variable' => $v, 'value' => $value));
			$settings[$v]['value'] = $value;
		}
	}
	foreach($variable as $v) {
		list($title, $description, $standby) = explode('|', $lan['s_'.$v]);
		$input = '';
		$setting = $settings[$v];
		if(empty($cs[$v])) {
			$c['type'] = 'char';
		} else {
			$c = $cs[$v];
		}
		if($c['type'] == 'char') {
			$input = '<input type="text" name="'.$v.'" value="'.htmlspecialchars($setting['value']).'" size="50">';
		} elseif($c['type'] == 'int') {
			$input = '<input type="text" name="'.$v.'" value="'.htmlspecialchars($setting['value']).'" size="15">';
		} elseif($c['type'] == 'pass') {
			$input = '<input type="password" name="'.$v.'" value="'.$setting['value'].'" size="50">';
		} elseif($c['type'] == 'bin') {
			$array_text = explode(',', $standby);
			$array_value = explode(',', $cs[$v]['standby']);
			$i = 0;
			foreach($array_value as $value) {
				$i ++;
				if($setting['value'] == $value) {
					$input .= '<input type="radio" name="'.$v.'" id="'.$v.$i.'" value="'.$value.'" checked>&nbsp;<label for="'.$v.$i.'">'.current($array_text).'</label>&nbsp;';
				} else {
					$input .= '<input type="radio" name="'.$v.'" id="'.$v.$i.'" value="'.$value.'">&nbsp;<label for="'.$v.$i.'">'.current($array_text).'</label>&nbsp;';
				}
				next($array_text);
			}
		} elseif($c['type'] == 'select') {
			$array_text = explode(',', $standby);
			$array_value = explode(',', $cs[$v]['standby']);
			$input = "<select name=\"{$v}\">";
			foreach($array_value as $value) {
				if($setting['value'] == $value) {
					$input .= '<option value="'.$value.'" selected>'.current($array_text).'</option>';
				} else {
					$input .= '<option value="'.$value.'">'.current($array_text).'</option>';
				}
				next($array_text);
			}
			$input .= "</select>";
		}
		$input = "<tr><td><b>{$title}</b><br>{$description}</td><td valign=\"top\" width=\"300\">{$input}</td></tr>\n";
		$output .= $input;
	}
	return $output;
}

function checkcategorypath($path, $up = 0) {
	global $lan, $system_root, $db, $tablepre;
	if(!empty($path)) {
		if(!preg_match('/^[_0-9a-zA-Z\-_]*$/i', $path)) return $lan['pathspecialcharacter'];
		if($db->get_by('id', 'categories', "categoryup='$up' AND path='$path'")) return $lan['categorypathused'];
	}
	return '';
}

function runinfo($message = '') {
	global $db, $ifdebug, $sysname, $sysedition, $mtime, $systemurl;
	$str_debug = $message;
	$endmtime = explode(' ', microtime());
	$exetime = number_format($endmtime[1] + $endmtime[0] - $mtime[1] - $mtime[0], 3);
	if(isset($db)) {
		if(empty($ifdebug)) {
			$str_debug .= "<center><div style='margin-top: 10px;' class='mininum'>".$db->querynum.'&nbsp;queries&nbsp;Time:'.$exetime.'</div>';
		} else {
			$str_debug .= "<center><div style='margin-top: 10px;' class='mininum' onclick='show_query_debug()'>".$db->querynum.'&nbsp;queries&nbsp;Time:'.$exetime;
			if($memused = ak_memused()) {
				$str_debug .= '&nbsp;Mem:'.$memused;
				unset($memused);
			}
			$str_debug .= "</div><div style='display: none;margin-top: 10px;' id='query_debug'>\n";
			$str_debug .= "<span>".count($db->queries)." queries:</span>";
			foreach($db->queries as $query) {
				$str_debug .= "<li>".htmlspecialchars($query)."</li>\n";
			}
			$str_debug .= "</div></center>\n";
			$js = "<script language='javascript'>\n";
			$js .= "function show_query_debug() {\n";
			$js .= "var debug = document.getElementById('query_debug');\n";
			$js .= "if(debug.style.display == 'block') {\n";
			$js .= "	debug.style.display = 'none';\n";
			$js .= "} else {\n";
			$js .= "	debug.style.display = 'block';\n";
			$js .= "}\n";
			$js .= "}\n";
			$js .= "</script>\n";
			$str_debug .= $js;
		}
	}
	$str_debug = ak_replace("</body>", "$str_debug\n".getcopyrightinfo()."\n</body>", ob_get_contents());
	ob_end_clean();
	echo($str_debug);
}

function createfore() {
	global $system_root;
	$config_data = "<?php\n$"."system_root = '{$system_root}';\n$"."foreload = 1;\n?>";
	writetofile($config_data, '../akcms_config.php');
	$files = readpathtoarray(AK_ROOT.'install', 1);
	foreach($files as $file) {
		if($file == 'custom.install.php') continue;
		if($file == 'install.sql.php') continue;
		if(strpos($file, '.php') !== false) ak_copy(AK_ROOT.'install/'.$file, FORE_ROOT.$file);
	}
}

function getsysteminfos($variable) {
	global $infos;
	$infos = getcache('infos');
	return $infos[$variable];
}

function updateitemfilename($ids) {//未完成
	global $db, $tablepre;
	$_ids = implode(',', $ids);
	$query = $db->query("SELECT * FROM {$tablepre}_items WHERE id IN ($_ids)");
	while($item = $db->fetch_array($query)) {
		$filename = htmlname($item['id'], $item['category'], $item['dateline'], $item['filename']);
		$sql = "UPDATE {$tablepre}_filenames SET filename=''";
	}
}

function deletecommentbyip($ip) {
	global $db, $tablepre;
	$sql = "DELETE FROM {$tablepre}_comments WHERE ip='$ip'";
	$db->query($sql);
}

function extfieldinput($field) {
	$type = $field['type'];
	$standby = htmlspecialchars($field['standby']);
	if($type == 'string' || $type == 'number') {
		return "<input type='text' name='ext_{$field['alias']}' id='ext_{$field['alias']}' value='{$field['standby']}' size='60'>";
	} elseif($type == 'select') {
		$return = '';
		$items = explode("\n", $standby);
		foreach($items as $item) {
			$f = explode(',', trim($item));
			$v = $t = $f[0];
			if(isset($f[1])) $t = $f[1];
			$return .= "<option value=\"{$v}\">{$t}</option>\n";
		}
		return "<select name=\"ext_{$field['alias']}\">{$return}</select>";
	} elseif($type == 'radio') {
		$return = '';
		$items = explode("\n", $standby);
		$i = 0;
		foreach($items as $item) {
			$i ++;
			$f = explode(',', trim($item));
			$v = $t = $f[0];
			if(isset($f[1])) $t = $f[1];
			$id = "{$field['alias']}_{$i}";
			$return .= "<input type=\"radio\" id=\"$id\" name=\"ext_{$field['alias']}\" value=\"{$v}\"><label for=\"{$id}\">{$t}</label>\n";
		}
		return $return;
	}
}

function rendermodulefield($key, $data, $value = '') {
	global $lan;
	if(!empty($data['alias'])) {
		$alias = $data['alias'];
	} elseif(substr($key, 0, 7) == 'orderby') {
		$alias = $lan['order'].substr($key, 7);
	} elseif(isset($lan[$key])) {
		$alias = $lan[$key];
	} elseif($key == 'dateline') {
		$alias = $lan['time'];
		if(!empty($value)) $value = date('Y-m-d H:i:s', $value);
	} else {
		if(empty($extfields)) $extfields = getcache('extfields');
		$alias = $extfields[$key]['name'];
	}
	$htmlfields = "<tr><td width='50' valign='top'>{$alias}</td>";
	if(!empty($data['size'])) {
		if(strpos($data['size'], ',') === false) {
			$width = $data['size'];
		} else {
			list($width, $height) = explode(',', $data['size']);
		}
	}
	if($key == 'data' || $key == 'digest' || (isset($data['type']) && $data['type'] == 'rich')) {
		if(empty($width)) $width = '100%';
		if(empty($height)) $height = '400';
	}
	if(!empty($height)) {
		if(substr($width, -1) != '%') $width .= 'px';
		if(substr($height, -1) != '%') $height .= 'px';
		if($data['type'] == 'plain') {
			$value = br2nl($value);
			$htmlfields .= "<td><textarea name='{$key}' style='width:{$width};height:{$height};'>".htmlspecialchars($value)."</textarea>";
		} elseif($data['type'] == 'rich') {
			if(empty($GLOBALS['xheditor'])) {
				$htmlfields .= "<td><div>
	<input type=\"hidden\" id=\"{$key}\" name=\"{$key}\" value=\"".htmlspecialchars($value)."\">
	<input type=\"hidden\" id=\"{$key}___Config\" value=\"\" style=\"display:none\" />
	<iframe id=\"{$key}___Frame\" src=\"include/editor/fckeditor.html?InstanceName={$key}&amp;Toolbar=Default\" style='width:{$width};height:{$height}' frameborder=\"0\" scrolling=\"no\"></iframe>
	</div>";
				$htmlfields .= "<input type='checkbox' value='1' name='{$key}_copypic' id='{$key}_copypic'><label for='{$key}_copypic'>".$lan['copypicturetolocal'].'</label>';
				$htmlfields .= "<br /><input type='checkbox' value='1' name='{$key}_pickpicture' id='{$key}_pickpicture'><label for='{$key}_pickpicture'>".$lan['pickpicture'].'</label>';
			} else {
				$htmlfields .= "<td><textarea name='{$key}' id='{$key}' style='width:{$width};height:{$height};' class=\"xheditor {upImgUrl:'upload.php',upImgExt:'jpg,jpeg,gif,png',tools:'Source,Pastetext,|,Blocktag,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Hr,Table',loadCSS:'<style>body{font-size:14px;}</style>'}\">".htmlspecialchars($value)."</textarea>";
			}
		} else {
			$htmlfields .= "<td><input type=\"text\" name=\"$key\" value=\"".htmlspecialchars($value)."\" style='width:{$width}'>";
		}
	} elseif($key == 'picture') {
		$htmlfields .= "<td><table><tr><td>{$lan['pictureurl']}:<input type='text' name='picture' value='{$value}' size='50'></td></tr><tr><td>{$lan['or']}</td></tr><tr><td>{$lan['uploadpicture']}:<input type='file' name='uploadpicture' value=''></td></tr></table>";
	} elseif($key == 'attach') {
		$htmlfields .= "<div style='display:none'><div id='firstattach'>{$lan['attach']}<input type='file' name='attach[]' value='' /><br />{$lan['description']}({$lan['limit255']})<br /><textarea name='description[]' cols='60' rows='3'></textarea><br /></div></div><script>function addattach() {adddiv = $('#firstattach').html();$(adddiv).appendTo('#otherattach');}</script><td>";
		if($value > 0) $htmlfields .= "<iframe id='attachments' onload='Javascript:SetframeHeight(\"attachments\")' src='admincp.php?action=attachments&id=[itemid]&r=".random(6)."' frameborder='0' style='overflow-x:hidden;overflow-y:hidden;margin:0px auto;width:100%;margin-bottom:8px;'></iframe>";
		$htmlfields .= "<div id='otherattach'></div><input type='button' value='{$lan['add']}{$lan['space']}{$lan['attach']}' onclick='addattach()'><script>addattach();</script>";
	} elseif($key == 'title') {
		$width = empty($data['size']) ? '240' : $data['size'];
		if(substr($width, -1) != '%') $width .= 'px';
		$value = htmlspecialchars($value);
		$htmlfields .= "<td><input type='text' id='title' name='$key' value=\"{$value}\" style='width:{$width}' class='mustoffer'>";
		if(!empty($data['iftitlestyle'])) {
			$htmlfields .= "&nbsp;<select id='titlecolor' name='titlecolor'><option value=''>{$lan['color']}</option>";
			for($i = 0; $i < 3; $i ++) {
				for($j = 0; $j < 3; $j ++) {
					for($k = 0; $k < 3; $k ++) {
						$c = (string)$i.(string)$j.(string)$k;
						$c = str_replace('0', '00', $c);
						$c = str_replace('1', '80', $c);
						$c = str_replace('2', 'FF', $c);
						$htmlfields .= "<option value='$c' style='background-color:$c'>&nbsp;</option>";
					}
				}
			}
			$htmlfields .= "</select>&nbsp;<select id='titlestyle' name='titlestyle'><option value=''>{$lan['style']}</option><option value='b'>{$lan['bold']}</option><option value='i'>{$lan['italic']}</option></select>";
			if(!empty($value)) $htmlfields .= "&nbsp;<input type='button' style='background:red;color:#FFF' value='{$lan['delete']}' onclick='return confirmdelete();'>";
		}
	} else {
		if(strpos($data['default'], ';') === false) {
			$width = empty($data['size']) ? '240' : $data['size'];
			if(substr($width, -1) != '%') $width .= 'px';
			if(empty($value))$value = $data['default'];
			$htmlfields .= "<td><input type=\"text\" name=\"$key\" value=\"".htmlspecialchars($value)."\" style='width:{$width}'>";
		} else {
			$options = explode(';', $data['default']);
			$optionshtml = '';
			foreach($options as $_k => $option) {
				if(strpos($option, ',') === false) {
					$optionshtml .= "<option value=\"$option\">$option</option>";
				} elseif(substr_count($option, ',') == 1) {
					list($t, $v) = explode(',', $option);
					$optionshtml .= "<option value=\"$v\">$t</option>";
				}
			}
			$htmlfields .= "<td><select id=\"$key\" name=\"$key\">{$optionshtml}</select>";
			if(!empty($value)) $htmlfields .= "<script>$('#{$key}').val(\"".htmlspecialchars($value)."\");</script>";
		}
	}
	if(!empty($data['description'])) $htmlfields .= ' '.$data['description'];
	$htmlfields .= "</td></tr>";
	return $htmlfields;
}

function getcategoriesbymodule($module){
	global $db;
	if($module == 0 || $module == -1) {
		$query = $db->query_by('id', 'categories', "module>0");
	} else {
		$query = $db->query_by('id', 'categories', "module='$module'");
	}
	$return = array();
	while($category = $db->fetch_array($query)) {
		$return[] = $category['id'];
	}
	return $return;
}

function ifitemtemplateexist($category, $template = '') {//判断一个item的模板是否存在
	global $template_path;
	$categorycache = getcategorycache($category);
	if(empty($template)) $template = $categorycache['itemtemplate'];
 	$templatefile = AK_ROOT."configs/templates/$template_path/,".$template;
	if(!file_exists($templatefile)) return false;
	return true;
}

function table_start($title = '', $colspan = 10) {
	global $lan;
	return "<table cellpadding=\"4\" cellspacing=\"1\" class=\"commontable width100\"><tr class=\"header\">\n".
	"<td colspan=\"{$colspan}\"><div class=\"righttop\"></div>{$title}</td>\n".
	"</tr>";
}

function table_end() {
	return "</table>\n<div class=\"block2\"></div>";
}

function table_next($title = '', $colspan = 10) {
	$output = table_end();
	$output .= table_start($title, $colspan);
	return $output;
}

function modulefields($data = array()) {
	global $itemfields, $lan, $settings;
	$fieldshtml = '';
	$trid = 0;
	foreach($itemfields as $field) {
		if(strpos($field, 'orderby') !== false) {
			$l = str_replace('orderby', $lan['order'], $field);
		} elseif($field == 'dateline') {
			$l = $lan['time'];
		} else {
			$l = isset($lan[$field]) ? $lan[$field] : $field;
		}
		$setting = '';
		if($field == 'data' || $field == 'digest') {
			$setting = "<select name='{$field}_type' id='{$field}_type'>".returnmodulefieldtype()."</select>";
			if(!empty($data[$field]['type'])) $setting .= "<script>$('#{$field}_type option[value={$data[$field]['type']}]').attr('selected',true);</script>";
		}
		if($field == 'title') {
			$setting .= "<input type='checkbox' name='iftitlestyle' id='iftitlestyle' value='1'><label for='iftitlestyle'>{$lan['style']}</label>";
			if(!empty($data['title']['iftitlestyle'])) $setting .= "<script>$('#iftitlestyle').attr('checked', true); </script>";
		}
		$_alias = isset($data[$field]['alias']) ? $data[$field]['alias'] : '';
		$_order = isset($data[$field]['order']) ? $data[$field]['order'] : '';
		$_listorder = isset($data[$field]['listorder']) ? $data[$field]['listorder'] : '';
		$_description = isset($data[$field]['description']) ? $data[$field]['description'] : '';
		$_default = isset($data[$field]['default']) ? $data[$field]['default'] : '';
		$_size = isset($data[$field]['size']) ? $data[$field]['size'] : '';
		$fieldshtml .= "
<tr>
<td>{$l}</td>
<td><input type='text' name='{$field}_alias' size='10' value='{$_alias}'></td>
<td><input type='text' name='{$field}_order' size='3' value='{$_order}'></td>
<td><input type='text' name='{$field}_listorder' size='3' value='{$_listorder}'></td>
<td><input type='text' name='{$field}_description' size='16' value='{$_description}'></td>
<td><input type='text' name='{$field}_default' size='10' value='{$_default}'></td>";
		$trid ++;
		if($field == 'category' || $field == 'section' || $field == 'attach' || $field == 'picture' || $field == 'comment') {
			$fieldshtml .= "<td>-</td><td>-</td></tr>\n";
		} else {
			$fieldshtml .= "<td><input type='text' name='{$field}_size' size='9' value='{$_size}'></td><td>{$setting}</td></tr>\n";
		}
	}
	$trid += 4;
	$fieldshtml .= "<tr class='header'><td colspan='8'>{$lan['extfields']}&nbsp;(<a href=\"javascript:addfield()\">+{$lan['add']}</a>)</td></tr>";
	$fieldshtml .= "<tr><td>{$lan['field']}({$lan['letterornum']})</td><td>{$lan['alias']}</td><td>{$lan['order']}</td><td>{$lan['listorder']}</td><td>{$lan['description']}</td><td>{$lan['default']}</td><td>{$lan['fieldsize']}</td><td>{$lan['type']}</td></tr>";
	foreach($data as $_k => $_v) {
		if(substr($_k, 0, 1) != '_') continue;
		$k = substr($_k, 1);
		$field = $_k;
		$setting = "<select id='extfield_type{$trid}' name='extfield_type{$trid}'>".returnmodulefieldtype()."</select>";
		if($data[$_k]['type']) $setting .= "<script>$('#extfield_type{$trid}').val('{$data[$_k]['type']}');</script>";
		$_data = isset($data[$_k]) ? $data[$_k] : '';
		$_alias = isset($data[$field]['alias']) ? $data[$field]['alias'] : '';
		$_order = isset($_data['order']) ? $_data['order'] : '';
		$_listorder = isset($_data['listorder']) ? $_data['listorder'] : '';
		$_description = isset($_data['description']) ? $_data['description'] : '';
		$_default = isset($_data['default']) ? $_data['default'] : '';
		$_size = isset($_data['size']) ? $_data['size'] : '';
		$fieldshtml .= "<tr><td><input name='extfield{$trid}' type='text' size='12' value='".htmlspecialchars($k)."'></td><td><input type='text' name='extfield_alias{$trid}' size='10' value='".htmlspecialchars($_alias)."'></td><td><input type='text' name='extfield_order{$trid}' size='3' value='".htmlspecialchars($_order)."'></td>
	<td><input type='text' name='extfield_listorder{$trid}' size='3' value='".htmlspecialchars($_listorder)."'></td>
	<td><input type='text' name='extfield_description{$trid}' size='15' value='".htmlspecialchars($_description)."'></td>
	<td><input type='text' name='extfield_default{$trid}' size='10' value='".htmlspecialchars($_default)."'></td><td><input type='text' name='extfield_size{$trid}' size='9' value='{$_size}'></td><td>{$setting}</td></tr>";
		$trid ++;
	}
	return $fieldshtml;
}

function renderitemfield($moduleid, $itemvalue = array()) {
	global $db, $lan;
	$modules = getcache('modules');
	$data = $modules[$moduleid]['data'];
	$fields = array();
	if(empty($modules[$moduleid]['categories'])) return false;
	foreach($data['fields'] as $key => $value) {
		$fields[$key] = $value['order'];
	}
	arsort($fields);
	$categoryalias = $lan['category'];
	if(!empty($modules[$moduleid]['data']['fields']['category']['alias'])) $categoryalias = $modules[$moduleid]['data']['fields']['category']['alias'];
	empty($categoryalias) && $categoryalias = $lan['category'];
	if($data['fields']['category']['order'] <= 0) {
		$_category = each($modules[$moduleid]['categories']);
		$categoryfield = "<input type='hidden' name='category' value='{$_category[0]}'>";
	} elseif(empty($GLOBALS['nocategoryselect'])) {
		$categoryfield = "<tr><td>{$categoryalias}</td><td class='categoryselect'><select id=\"category0\" onchange=\"javascript:selectcategory(1, this.value)\"></select><select id=\"category1\" onchange=\"javascript:selectcategory(2, this.value)\"></select><select id=\"category2\" onchange=\"javascript:selectcategory(3, this.value)\"></select><select id=\"category3\" onchange=\"javascript:selectcategory(4, this.value)\"></select><select id=\"category4\" onchange=\"javascript:selectcategory(5, this.value)\"></select><select id=\"category5\" onchange=\"javascript:selectcategory(6, this.value)\"></select><select id=\"category6\" onchange=\"javascript:selectcategory(7, this.value)\"></select><select id=\"category7\" onchange=\"javascript:selectcategory(8, this.value)\"></select><select id=\"category8\" onchange=\"javascript:selectcategory(9, this.value)\"></select><select id=\"category9\" onchange=\"javascript:selectcategory(10, this.value)\"></select><input type=\"hidden\" id=\"category\" name=\"category\"><script language=\"javascript\" type=\"text/javascript\">selectcategory(0, 0);</script></td></tr>";
	} else {
		$categoryfield = "<tr><td>{$categoryalias}</td><td><input name='category' size='6' id='category' class='mustoffer' /></td></tr>";
	}
	$htmlfields = '';
	foreach($fields as $key => $value) {
		if($data['fields'][$key]['order'] <= 0 && $key != 'category') continue;
		$itemfieldvalue = '';
		if(isset($itemvalue[$key])) $itemfieldvalue = $itemvalue[$key];
		if($key == 'category') {
			$htmlfields .= $categoryfield;
			if(isset($itemvalue['category'])) $htmlfields .= "<script>$('#category').val({$itemvalue['category']});</script>";
		} elseif($key == 'section') {
			$sectionalias = $modules[$moduleid]['data']['fields']['section']['alias'];
			empty($sectionalias) && $sectionalias = $lan['section'];
			$htmlfields .= "<tr><td>{$sectionalias}</td><td><select name='section' id='section'>".get_select('section')."</select></td></tr>";
			if(isset($itemvalue['section'])) $htmlfields .= "<script>$('#section').val({$itemvalue['section']});</script>";
		} elseif($key == 'template') {
			$templatealias = $modules[$moduleid]['data']['fields']['template']['alias'];
			empty($templatealias) && $templatealias = $lan['template'];
			$htmlfields .= "<tr><td>{$templatealias}</td><td><select name='template' id='template'><option value=''>{$lan['default']}</option>".get_select_templates()."</select></td></tr>";
			if(isset($itemvalue['template'])) $htmlfields .= "<script>$('#template').val('{$itemvalue['template']}');</script>";
		} elseif($key == 'comment') {
			if(empty($itemvalue['id'])) continue;
			$commentalias = $modules[$moduleid]['data']['fields']['comment']['alias'];
			empty($commentalias) && $commentalias = $lan['comment'];
			$htmlfields .= "<tr><td>{$commentalias}</td><td><iframe id='comments' onload='Javascript:SetframeHeight(\"comments\")' src='admincp.php?action=comments&id={$itemvalue['id']}&r=".random(6)."' frameborder='0' style='overflow-x:hidden;overflow-y:hidden;margin:0px auto;width:100%;'></iframe></td></tr>";
		} else {
			$modulefield = rendermodulefield($key, $data['fields'][$key], $itemfieldvalue);
			if($key == 'title') {
				if(!empty($itemvalue['titlestyle'])) $modulefield .= "<script>$('#titlestyle').val('{$itemvalue['titlestyle']}');</script>";
				if(!empty($itemvalue['titlecolor'])) $modulefield .= "<script>$('#titlecolor').val('{$itemvalue['titlecolor']}');</script>";
			}
			if(isset($itemvalue['id'])) $modulefield = ak_replace('[itemid]', $itemvalue['id'], $modulefield);
			$htmlfields .= $modulefield;
		}
	}
	return $htmlfields;
}

function batchdeleteitem($array_id) {
	global $db, $tablepre;
	$ids = implode(',', $array_id);
	$db->delete('texts', "itemid IN ({$ids})");
	$query = $db->query_by('*', 'attachments', "itemid IN ({$ids})");
	while($attach = $db->fetch_array($query)) {
		@unlink(FORE_ROOT.$attach['filename']);
	}
	$db->delete('attachments', "itemid IN ({$ids})");
	$db->delete('filenames', "id IN ({$ids})");
	$array_sections = array();
	$array_categories = array();
	$array_editors = array();
	$query = $db->query_by('*', 'items', "id IN ($ids)");
	while($item = $db->fetch_array($query)) {
		$array_sections[] = $item['section'];
		$array_categories[] = $item['category'];
		$array_editors[] = $item['editor'];
		@unlink(FORE_ROOT.htmlname($item['id'], $item['category'], $item['dateline'], $item['filename']));
		if(!empty($item['picture'])) @unlink(FORE_ROOT.$item['picture']);
	}
	$db->delete('items', "id IN ({$ids})");
	refreshitemnum($array_categories, 'category');
	refreshitemnum($array_sections, 'section');
	refreshitemnum($array_editors, 'editor');
}

function refreshitemnum($ids, $type = 'category') {
	global $tablepre, $db;
	static $categories;
	if(is_array($ids)) {
		$ids = array_unique($ids);
	} else {
		$ids = array($ids);
	}
	if($type == 'category') {
		foreach($ids as $id) {
			if($id == 0) continue;
			if(empty($categories[$id])) $categories[$id] = getcategorycache($id);
			$allitems = $items = $db->get_by('COUNT(*)', 'items', "category='$id'");
			if(!empty($categories[$id]['subcategories'])) {
				foreach($categories[$id]['subcategories'] as $subcategory) {
					if(empty($categories[$subcategory])) $categories[$subcategory] = getcategorycache($subcategory);
					$allitems += $categories[$subcategory]['items'];
				}
			}
			$db->update('categories', array('items' => $items, 'allitems' => $allitems), "id='$id'");
		}
	} elseif($type == 'section') {
		foreach($ids as $id) {
			$items = $db->get_by('COUNT(*)', 'items', "section='$id'");
			$db->update('sections', array('items' => $items), "id='$id'");
		}
	} elseif($type == 'editor') {
		if(count($ids) == 0) {
			$ids = array();
			$query = $db->query_by('editor', 'admins');
			while($editor = $db->fetch_array($query)) {
				$ids[] = $editor['editor'];
			}
		}
		foreach($ids as $id) {
			$items = $db->get_by('COUNT(*)', 'items', "editor='$id'");
			$db->update('admins', array('items' => $items), "editor='$id'");
		}
	}
}

function showprocess($title, $processurl, $targeturl = '', $timeout = 100) {
	global $smarty;
	$smarty->assign('title', $title);
	$smarty->assign('processurl', $processurl);
	$smarty->assign('targeturl', $targeturl);
	$smarty->assign('timeout', $timeout);
	displaytemplate('admincp_process.htm');
	runinfo();
	aexit();
}

function returnmodulefieldtype() {
	global $lan;
	return "<option value='plain'>{$lan['plaintext']}</option><option value='rich'>{$lan['richtext']}</option>";
}

function freezeuser($uid, $freeze = 1) {
	global $db;
	$db->update('users', array('freeze' => $freeze), "id='$uid'");
}
?>