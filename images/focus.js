function focus(pics,links,texts) {
var interval_time=0; //ͼƬͣ��ʱ�䣬��λΪ�룬Ϊ0��ֹͣ�Զ��л�
var focus_width=220;
var focus_height=180;
var text_height=0;
var text_align="center" //�������ֶ��뷽ʽ(left��center��right)
var swf_height=focus_height+text_height; //���֮�������ż��,�������ֻ����ģ��ʧ�������
var pics=pics;
var links=links;
var texts=texts;
document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
document.write('<param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="/images/focus.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff">');
document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
document.write('<embed src="/images/focus.swf" wmode="opaque" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'" menu="false" bgcolor="#F0F0F0" quality="high" width="'+ focus_width +'" height="'+ focus_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
document.write('</object>');
}