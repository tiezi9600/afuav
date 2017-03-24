var oEditor = window.parent.InnerDialogLoaded();
var FCK = oEditor.FCK;
var FCKLang = oEditor.FCKLang;
var FCKConfig = oEditor.FCKConfig;
var oImage = FCK.Selection.GetSelectedElement() ;
if(oImage && oImage.tagName != 'IMG') oImage = null;
window.onload = function() {
	oEditor.FCKLanguageManager.TranslatePage(document) ;
	LoadSelection() ;
	window.parent.SetAutoSize(true);
	window.parent.SetOkButton(true);
}
function LoadSelection() {
	if(!oImage) return;
	GetE('txtUrl').value = GetAttribute(oImage, 'src', '');
	GetE('txtAlt').value = GetAttribute(oImage, 'alt', '');
	GetE('cmbAlign').value = GetAttribute(oImage, 'align', '');
	GetE('txtWidth').value = GetAttribute(oImage, "width", '');
	GetE('txtHeight').value = GetAttribute(oImage, "height", '');
}
function Ok() {
	if(GetE('txtUrl').value.length == 0) {
		GetE('txtUrl').focus();
		alert(FCKLang.DlgImgAlertUrl);
		return false;
	}
	oImage = FCK.CreateElement('IMG');
	UpdateImage(oImage);
	return true;
}
function UpdateImage(e) {
	SetAttribute(e, "src", GetE('txtUrl').value);
	SetAttribute(e, "alt", GetE('txtAlt').value);
	SetAttribute(e, "width", GetE('txtWidth').value);
	SetAttribute(e, "height", GetE('txtHeight').value);
	SetAttribute(e, "align", GetE('cmbAlign').value);
}