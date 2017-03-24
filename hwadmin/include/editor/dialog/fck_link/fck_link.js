var oEditor = window.parent.InnerDialogLoaded();
var FCK = oEditor.FCK;
var FCKLang = oEditor.FCKLang;
var FCKConfig = oEditor.FCKConfig;

var oRegex = new Object();
oRegex.UriProtocol = new RegExp('');
oRegex.UriProtocol.compile('^(((http|https|ftp|news):\/\/)|mailto:)', 'gi');
oRegex.UrlOnChangeProtocol = new RegExp('');
oRegex.UrlOnChangeProtocol.compile('^(http|https|ftp|news)://(?=.)', 'gi');
oRegex.UrlOnChangeTestOther = new RegExp('');
oRegex.UrlOnChangeTestOther.compile('^((javascript:)|[#/\.])', 'gi'); 
oRegex.ReserveTarget = new RegExp('');
oRegex.ReserveTarget.compile('^_(blank|self|top|parent)$', 'i');

var oLink = FCK.Selection.MoveToAncestorNode('A');
if(oLink) FCK.Selection.SelectNode(oLink);
window.onload = function() {
	oEditor.FCKLanguageManager.TranslatePage(document);
	LoadSelection();
	window.parent.SetOkButton(true);
}
function LoadSelection() {
	if(!oLink) return;
	var sHRef = oLink.getAttribute('_fcksavedurl');
	if (!sHRef || sHRef.length == 0) sHRef = oLink.getAttribute('href', 2) + '';
	var sProtocol = oRegex.UriProtocol.exec(sHRef);
	if(sProtocol) {
		sProtocol = sProtocol[0].toLowerCase();
		GetE('cmbLinkProtocol').value = sProtocol;
		var sUrl = sHRef.replace(oRegex.UriProtocol, '');
		GetE('txtUrl').value = sUrl;
	} else {
		GetE('cmbLinkProtocol').value = '';
		GetE('txtUrl').value = sHRef;
	}
	var sTarget = oLink.target;
	if(sTarget && sTarget.length > 0) {
		if(oRegex.ReserveTarget.test(sTarget)) {
			sTarget = sTarget.toLowerCase();
			GetE('cmbTarget').value = sTarget;
		} else
			GetE('cmbTarget').value = 'frame';
		GetE('txtTargetFrame').value = sTarget;
	}
}

function SetTarget(targetType) {
	switch(targetType) {
		case "_blank":
		case "_self":
		case "_parent":
		case "_top":
			GetE('txtTargetFrame').value = targetType;
			break;
		case "":
			GetE('txtTargetFrame').value = '';
			break;
	}
}
function OnUrlChange() {
	var sUrl = GetE('txtUrl').value;
	var sProtocol = oRegex.UrlOnChangeProtocol.exec(sUrl);
	if(sProtocol) {
		sUrl = sUrl.substr( sProtocol[0].length);
		GetE('txtUrl').value = sUrl;
		GetE('cmbLinkProtocol').value = sProtocol[0].toLowerCase();
	} else if( oRegex.UrlOnChangeTestOther.test(sUrl)) {
		GetE('cmbLinkProtocol').value = '';
	}
}
function OnTargetNameChange() {
	var sFrame = GetE('txtTargetFrame').value;
	if(sFrame.length == 0)
		GetE('cmbTarget').value = '';
	else if(oRegex.ReserveTarget.test(sFrame))
		GetE('cmbTarget').value = sFrame.toLowerCase();
	else
		GetE('cmbTarget').value = 'frame';
}
function Ok() {
	var sUri;
	sUri = GetE('txtUrl').value;
	if(sUri.length == 0) {
		alert(FCKLang.DlnLnkMsgNoUrl);
		return false;
	}
	sUri = GetE('cmbLinkProtocol').value + sUri;
	if(oLink) {
		oLink.href = sUri;
	} else {
		oLink = oEditor.FCK.CreateLink(sUri);
		if(!oLink) return true;
	}	
	SetAttribute(oLink, '_fcksavedurl', sUri);
	SetAttribute(oLink, 'target', GetE('txtTargetFrame').value);
	return true;
}